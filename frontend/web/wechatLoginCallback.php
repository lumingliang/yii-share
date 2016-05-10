<?php
echo '回调';

$code = $_GET['code'];
$state = $_GET['state'];

$appid = 'wxa012100dbdcd7acc';
$appsecret = '1f08eacf9017e2d8112190d222af485f';

session_start();
$state0 = $_SESSION['wx']['state'];
if($state !== $state0) {
    echo '返回码错误';
    exit;
}

if(empty($code)) {
    echo '授权失败,用户不允许';
    exit;
}

$token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
$access_token = json_decode(file_get_contents($token_url));
if (isset($access_token->errcode)) {
    echo '<h1>错误：</h1>'.$access_token->errcode;
    echo '<br/><h2>错误信息：</h2>'.$access_token->errmsg;
    exit;
}

echo '已经获得openid:'.$access_token->openid;
echo '<pre>';
print_r($access_token);
echo '</pre>';
echo '下一步，获取用户信息:';

$user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token->access_token.'&openid='.$access_token->openid.'&lang=zh_CN';
//转成对象
$user_info = json_decode(file_get_contents($user_info_url));
if (isset($user_info->errcode)) {
    echo '<h1>错误：</h1>'.$user_info->errcode;
    echo '<br/><h2>错误信息：</h2>'.$user_info->errmsg;
    exit;
}
//打印用户信息
echo '<pre>';
print_r($user_info);
echo '</pre>';
?>

echo '最后可以跳转到其他页面';
