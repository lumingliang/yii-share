<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = '属于你的青春纪念旅';
?>

<div class="container">
    <div><img src="<?= Url::to('/wechatShare/img/2-2.png') ?>" style="width:100%;"/></div>
    <div class="text">
        <p class="title">快来开启属于你的青春纪念旅，赢取活动大奖吧！<p>
        <p class="content">（在框内输入你的班级或个人昵称，点击生成，并分享你的专属页面至朋友圈，即可参与抽奖活动哦~）<p>
    </div>
    <div class="input-area">
        <form id="share" action="" method="post">
        <div>
           <input type="text" name="nick_name" required placeholder="班级或个人呢称" onfocus="this.style.color='#000';" id="input-text"/>
           <input type="hidden" name="_csrf" value=" <?php echo Yii::$app->request->csrfToken; ?>" />  
        </div>
        <div >
<?php if(isset($weChatErr)): ?>
		   <button disabled>生成</button>
<?php else: ?>
		   <button type="submit" >生成</button>
<?php endif ?>
        </div>
        </form>
    </div>

<?php if(isset($err)): ?>
<h1 style="color:white" class="input-error"><?= $err ?></h1>
<?php endif ?>
<?php if(isset($weChatErr)): ?>
<h1 style="color:white" class="input-error"><?= $weChatErr ?></h1>
<?php endif ?>

    <div class="footer"><p id="footer-p">本活动最终解释权归海投网所有</p></div>
</div>

<!--
<script>
     var id= document.getElementById("input-text");
function b(){ if(id.value==""){id.value="班级或个人昵称";id.style.color="#b9b9b9";}}
function a(){ if(id.value==(""||"班级或个人昵称")){id.value="";id.style.color="#000";} }
</script>
-->

