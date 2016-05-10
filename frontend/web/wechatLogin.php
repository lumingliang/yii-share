<?php

$appid = 'wxa012100dbdcd7acc';
require_once "jssdk.php";

$jssdk = new JSSDK("wxa012100dbdcd7acc", "1f08eacf9017e2d8112190d222af485f ");

$random = $jssdk->createNonceStr();
session_start();
// 储存微信登录时的state 
$_SESSION['wx']['state'] = $random;

// $redirect_uri = urlencode('http://bylx.haitou.cc/wechatLoginCallback.php');
$redirect_uri = urlencode('http://api.local.haitou.cc/wechatLoginCallback.php');
// $redirect_uri = 'bylx.haitou.cc/wechatLoginCallback.php';

// 仅获取openId
// header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state='.$random.'#wechat_redirect');

// 全部信息
header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state='.$random.'#wechat_redirect');
