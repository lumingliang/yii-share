<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ShareUser;
use frontend\models\ViewPeople;
use frontend\models\ShareUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ShareUserController implements the CRUD actions for ShareUser model.
 */
class ShareUserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ShareUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShareUserSearch(); //借助模型属性生成查询的视图
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //这里是真正的数据过滤和查询提供

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 分享创建 
     *
     *
     */
    public function actionShare()
    {
        $model = new ShareUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 考虑MD5加密
            $id = $model->id;
            // $hash = urlencode(( string )$id.'iii');
            // echo $hash;
            // exit;
            return $this->redirect(['share-view', 'id' => $model->id]);
        } else {
            return $this->render('share', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 分享被查看
     *
     * 
     */
    public function actionShareView($id)
    {

        $viewPeopleModel = new ViewPeople();
        $shareUserModle = $this->findModel($id);

        $cookies = Yii::$app->request->cookies; 
        $shareToken = $cookies->getValue('shareToken', null );

        if($this->isFirstVisit($shareToken, $id)) {
           $key = $this->addCookie();
           // echo $key;
           $viewPeopleModel->shareuserId = $id;
           $viewPeopleModel->mobileMime = $key; 
           // echo '创建新的一个user';
           $t = $viewPeopleModel->save();
           // var_dump($t);
           if($t) {
                $shareUserModle->viewTimes++;
                $shareUserModle->save();
           } 

           // echo '第一次浏览', 这里有点多余了，因为存在这个cookie的都是已经来过这个链接的了;
        } else if( $this->isFirstViewLink($shareToken, $id) ) {

           $viewPeopleModel->shareuserId = $id;
           $viewPeopleModel->mobileMime = $shareToken; 
           // echo '创建新的一个user';
           $t = $viewPeopleModel->save();
           var_dump($t);
           if($t) {
                $shareUserModle->viewTimes++;
                $shareUserModle->save();
           } 
             
        }
        return $this->render('share-view', [
           'model' => $shareUserModle,
        ]);
    }

    
    public function addCookie() {

        $key = Yii::$app->getSecurity()->generateRandomString();

        $cookie = Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie( [
            'name' => 'shareToken',
            'value' => $key,
        ] ));
        return $key;

    }

    // 检查是否第一次访问网站
    public function isFirstVisit($shareToken, $id) {

        if(ViewPeople::hasMobileMime($shareToken, $id)) {

            return false;
        } else {
            return true;
        }
    }

    public function isFirstViewLink($shareToken, $id) {
        $result = ViewPeople::findOne(['mobileMime' => $shareToken, 'shareuserId' => $id]);
        // 如果不存在，就是第一次访问该链接
        if($result) {
            return false;
        }else {
            return true;
        }
    }
    
    

    /**
     * Displays a single ShareUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // $shareUser = ShareUser::findOne($id);
        // var_dump($shareUser->viewPeoples);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // 一条链接对应多个浏览者
    public function actionViewPeoples($id) {

        $shareUser = ViewPeople::find()->where(['shareuserId' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $shareUser,
            'pagination' => [ 'pageSize' => 20, ],
        ]);
        return $this->render('view-peoples', [ 'dataProvider' => $dataProvider]);
    }

    /**
     * Creates a new ShareUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShareUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ShareUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShareUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // return $this->redirect(['view-peoples', 'id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the ShareUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShareUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShareUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
