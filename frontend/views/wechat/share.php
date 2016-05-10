<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name.'喊你来抽奖|海投网青春纪念旅';
?>

<div class="container">
<div><img src="<?= Url::to('/wechatShare/img/1-1.png?1') ?>" style="width:100%;"/></div>
   <div class="ind-text">
        <p class="title">--活动介绍--<p>
        <p class="content">你将如何纪念你的毕业？<br/>
                          除了载歌载舞，通宵狂欢，不如趁着最后的学生假期，躲过旅游出行高峰，趁着生活未被苟且吞没，去寻找诗和远方。<br/>
                          海投网联合武汉青年国际旅行社，定制了三条毕业旅专属路线
                          走过招聘季，我们离毕业还差一场说嗨就嗨的旅行<br/>
                          <strong>本次旅行亮点:</strong><br/>
                          * Route：纯玩团，将传统路线学生化，全程开心游玩无负担<br/>
                          * Price：追求最佳性价比，磨嘴砍价，因为我们也曾是学生<br/>
                          * Taste：只属于还年轻的你和我，你的同伴就是你的同龄<br/>
                          除了好路线，还有好礼品：<br/>
                          帐篷套装/VR眼镜/品质公仔/定制戒指/可以吹气球的某物...<br/>
                          当然，我不会告诉你还可能免单旅行的！！！<br/>
                          怎么样，心动不如行动咯(～￣▽￣)～*
        </p>
		<p class="title">--参与方式--</p>
		<p class="content">点击下方原文链接（也可在微信搜索海投网小助手，回复“青春纪念旅”获得链接），点击文末的阅读原文，进入炫酷的ID生成页<br/>
                          输入ID（班级输入如“华科电信1201”，个人输入如“宋仲基的小老婆”），点击生成<br/>
                          点击右上角按钮，分享至你的票圈，个人奖将从所有生成的ID中随机抽取，而点击量最多的ID所在班级则获班级奖<br/>
                          抽奖项目先抽公仔，倒序抽出，并依次在公众号中公布<br/>
                           注：<br/>
                           1）同一手机点击多次只记录一次<br/>
                           2）个人专属ID页面点击量只要超过五次就可以视为有效ID<br/>
                           3）抽奖结果将陆续在公众号推文内公布<br/>
                          另外，免单方式嘛，有两种哦~(●'?'●)具体戳原文链接呗~~
		</p>
   </div>
   <div class="button-area">
        <div>
        <button id="button1" onclick="location='http://mp.weixin.qq.com/s?__biz=MzAxMDYwMTI5Mw==&mid=502119905&idx=1&sn=836d7f30f7b84098b43b8a44b7d2f65f#rd' ">原文链接</button>
        </div>
		 <div>
		   <button id="button2" onclick="location='http://bylx.haitou.cc'">活动官网</button>
        </div>
   </div>
   <div class="footer"><p>本活动最终解释权归海投网所有</p></div>
</div>
