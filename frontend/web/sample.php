<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wxa012100dbdcd7acc", "1f08eacf9017e2d8112190d222af485f ");
$signPackage = $jssdk->GetSignPackage($force = true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
//signature: '<?php echo $signPackage["signature"];?>',
   */

wx.config({
debug: true,
appId: '<?php echo $signPackage["appId"];?>',
timestamp: <?php echo $signPackage["timestamp"];?>,
nonceStr: '<?php echo $signPackage["nonceStr"];?>',
signature: '<?php echo $signPackage["signature"];?>',
jsApiList: [
    // 所有要调用的 API 都要加到这个列表中

        'onMenuShareTimeline',
        'onMenuShareAppMessage',
],
});
wx.ready(function () {
    wx.onMenuShareTimeline({
        title: '测试的啦', // 分享标题
        link: 'www.haitou.cc', // 分享链接
        imgUrl: 'http://bylx.haitou.cc/Public/img/index/3.png', // 分享图标
        success: function () { 
            alert('成功');
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            alert('您取消了');
            // 用户取消分享后执行的回调函数
        }
    });

    wx.onMenuShareAppMessage({
        title: '分享到朋友', // 分享标题
        link: 'www.haitou.cc', // 分享链接
        imgUrl: 'http://bylx.haitou.cc/Public/img/index/3.png', // 分享图标
        success: function () { 
            alert('成功');
            // 用户确认分享后执行的回调函数
        },
        cancel: function () { 
            alert('您取消了');
            // 用户取消分享后执行的回调函数
        }
    });

});

</script>
</html>
