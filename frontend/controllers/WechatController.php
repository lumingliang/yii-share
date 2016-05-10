<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use EasyWeChat\Foundation\Application;
use frontend\models\ShareUser;
use frontend\models\ViewPeople;
use yii\helpers\Url;

class WechatController extends Controller
{

    public $layout = 'wechatLayout';
    // 配置
    public $config = [
        'debug' => false,
        'app_id'  => 'wxa012100dbdcd7acc',         // AppID
        'secret'  => '1f08eacf9017e2d8112190d222af485f',     // AppSecret
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            // 'scopes'   => ['snsapi_base'],
            'callback' => '/wechat/login-callback',
            ],
        ];

    public function wechatLogin() {

        $app = new Application($this->config);
        $oauth = $app->oauth;
        // echo $oauth->redirect();
        $oauth->redirect()->send();
        exit;
    }

    public function actionLoginCallback() {

        $app = new Application($this->config);
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();

        // 如果用户拒绝登录
        if(!$user->getId()) {

            Yii::$app->session->setFlash('weChatErr', '您拒绝了我们的登录，请重新参与!');
            // 重定向到原来页面，并附加error项目
            return $this->redirect(Url::toRoute(['get-share-id']));
        }

        // 如果用户已经分享过了，删除了cookie 
        $shareUser = ShareUser::findOne(['open_id' => $user->getId()]);
        if($shareUser){

            // 则重新产生cookie
            $key = $this->addCookie('share_cookie');
            $shareUser->share_cookie = $key; 
            $shareUser->save();

            Yii::$app->session->setFlash('shareUserName', $shareUser->nick_name);
            return $this->redirect(Url::toRoute(['get-share-view', 'id' => $shareUser->id]));
        }


        // 对于第一次分享的人
        // 创建cookie

        $key = $this->addCookie('share_cookie');

        // 向数据库中插入该shareuser
        $shareUser = new ShareUser();
        $shareUser->nick_name = Yii::$app->session->getFlash('wechatNickName');
        $shareUser->open_id = $user->getId();
        $shareUser->weixin_nick_name = $user->getNickname();
        $shareUser->share_cookie = $key; 
        $shareUser->save();


        // echo $shareUser->id;
        // 重定向到产生页面,结束
        // Yii::$app->session->setFlash('shareUserName', $shareUser->nick_name);
        return $this->redirect(Url::toRoute(['get-share-view', 'id' => $shareUser->id]));
         
    }

    public function addCookie($name) {

        $key = Yii::$app->getSecurity()->generateRandomString().time();
        $cookie = Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie( [
            'name' => $name,
            'value' => $key,
            'expire' => time() + 60*60*24*30, //设定时间为30天
        ] ));
        return $key;
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    // public function actionJs(){

        // $app = new Application($this->config);
        // $js = $app->js;
        // return $this->render('js', ['js' => $js]);
    // }

    public function actionGetShareId(){

        if(!$this->is_weixin_browser()) {
            echo $this->is_not_weixin_browser();
            exit;
        } 

        // 检查登录cookie是否存在且正确
        $cookies = Yii::$app->request->cookies;
        $shareUser = ShareUser::findOne(['share_cookie' => $cookies['share_cookie']]);

        // 如果存在，说明已经访问且登录过
        if($shareUser) {
            // echo 'hi !'.$shareUser->nick_name.' 欢迎回来';
            // 重定向到特定的分享查看页面
            return $this->redirect(Url::toRoute(['get-share-view', 'id' => $shareUser->id]));
        } 

        $model = new ShareUser();

        // 如果不是post请求，就返回请求id界面
        $nickName = Yii::$app->request->post('nick_name');
        $model->nick_name = $nickName;
        // echo $nickName;
        // exit;
        if( !$nickName ) {

            return $this->render('index');
        }

        // 如果是post, 但验证规则不成功，就返回报错

        if( !$model->validate() ) {

            $err = $model->errors['nick_name'][0];
            return $this->render('index', ['err' => $err]);
        }

        // 如果没有cookie，说明没有登录,则缓存呢称，并调用微信登录
        Yii::$app->session->setFlash('wechatNickName', $nickName);
        $this->wechatLogin();
    }

        // 判断是否是微信客户端
    public function is_weixin_browser(){ 

        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
                return true;
        }	
        return false;
    }

    public function is_not_weixin_browser() {

        return $this->render('index', ['name' => '海投网', 'weChatErr' => '请在微信浏览器中打开才能参与我们的分享哦']);
    }

    public function actionGetShareView($id) {

        if(!$this->is_weixin_browser()) {
            echo $this->is_not_weixin_browser();
            exit;
        }

        //如果id不存在
        if(!ShareUser::findOne(['id' => $id])) {

            throw new \yii\web\ForbiddenHttpException('id错误，请不要修改链接id');
        }

        // 如果已经浏览过，会有cookie,检验特定cookie对应的id是否存在//如果用户是先浏览了别人的，再浏览自己的，是不回立刻记录他自己的
        $viewCookie = Yii::$app->request->cookies['view_cookie'];
        if(isset($viewCookie)) {

            $viewPeople = ViewPeople::findOne(['share_user_id' => $id, 'view_cookie' => $viewCookie]);
            if($viewPeople) {
                $name = ShareUser::findOne(['id' => $id])->nick_name;
                return $this->render('share', ['name' => $name]); //返回视图
            }
        } 


        // 如果是认证成功的浏览,这个有点多余，因为cookie关
        $name = Yii::$app->session->getFlash('shareUserName');

        if($name) {

            return $this->render('share', ['name' => $name]); //返回视图
        }

        // 如果是初次浏览,则缓存该分享者页面id
        Yii::$app->session->setFlash('shareViewId', $id);
        $this->getWeChatOpenId();
    }

    public function getWeChatOpenId() {

        $this->config['oauth']['scopes'] = ['snsapi_base'];
        $this->config['oauth']['callback'] = 'wechat/open-id-callback';
        $app = new Application($this->config);
        $oauth = $app->oauth;
        // echo $oauth->redirect();
        $oauth->redirect()->send();
        exit;
    }

    public function actionOpenIdCallback() {

        $app = new Application($this->config);
        $oauth = $app->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();

        // 查看者openId
        $openId = $user->getId();
        // 如果为空,
        if(!$openId) {

            throw new \yii\web\ForbiddenHttpException('网络错误，请刷新后操作');
            // Yii::$app->session->setFlash('weChatErr', '网络错误!');
            // return $this->redirect(Url::toRoute(['get-share-id']) ;
        }

        // 取出分享者id
        $shareUserId = Yii::$app->session->getFlash('shareViewId');

        $shareUser = ShareUser::findOne(['id' => $shareUserId]);

        $viewPeople = ViewPeople::findOne(['share_user_id' => $shareUserId, 'open_id' => $openId]);

        if($viewPeople) {
            // 如果已经存在，说明已经看过，返回警告删除cookie, 没做警告
            // 重新设定cookie
            $key = $this->addCookie('view_cookie');
            // 防止设置cookie 失效时用
            Yii::$app->session->setFlash('shareUserName', $shareUser->nick_name);
            return $this->redirect(Url::toRoute(['get-share-view', 'id' => $shareUserId]));
        }

        // 设定 cookie
        $key = $this->addCookie('view_cookie');

        // 如果不存在
        $viewPeople = new ViewPeople();
        $viewPeople->share_user_id = $shareUserId;
        $viewPeople->open_id = $openId;
        $viewPeople->view_cookie = $key;
        $viewPeople->save();

        // 存在弊端，
        $shareUser->view_times ++;
        $shareUser->save();


        // echo '返回查看界面视图';, 这里有点多余，因为cookie
        Yii::$app->session->setFlash('shareUserName', $shareUser->nick_name);
        return $this->redirect(Url::toRoute(['get-share-view', 'id' => $shareUser->id]));
    }

}
