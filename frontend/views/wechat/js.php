<?php

$this->title = 'echo js';
?>

测试js输出

<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'), true) ?>);
</script>

<script>

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
