<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('member', 'header'); ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidatorregex.js" charset="UTF-8"></script>
<div id="memberArea">
<?php include template('member', 'auth_center_left'); ?>
<div class="col-auto">
	<div class="bk10"></div>	
	<div class="col-1 ">
		<h5 class="title"><?php echo L('more_configuration');?>：</h5>
		<div class="content">
		<!--手机认证 开始-->
		<?php if($memberinfo['phone_status']==1) { ?>
		<div class="user_help">您的手机已经通过认证，认证的手机号码为：<b><?php echo $memberinfo['phone'];?></b></div>
		<?php } else { ?>
		<div class="user_help">
		<?php if($memberinfo['phone_status']!=0) { ?>您的手机客服正在审核中，请耐心等待。手机号：<font color="#FF0000"><?php echo $memberinfo['phone'];?></font>。<?php } else { ?>您的手机还没通过认证。<?php } ?></b></div>
		<?php } ?>
		<div class="user_right_border">
		
			<div class="c">
			<form id="myform" name="myform" action="" method="post">
			<div class="user_right_border">
				<div class="l">手机号码：</div>
				<div class="c">
				<input type="text" id="phone" name="phone" value="<?php if($memberinfo['phone_status']==0 ||  $memberinfo['phone_status']==1) { ?><?php echo $memberinfo['phone'];?><?php } else { ?><?php echo $memberinfo['phone_status'];?><?php } ?>" />
				</div>
			</div>
			<div class="user_right_border">
				<div class="e"></div>
				<div class="c">
				<input type="submit" name="dosubmit"  id="dosubmit" value="确认提交" class="button" size="30" /></div>
			</div>
			</form>
				<script>
			$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#phone").formValidator({onshow:"请输入您的手机号码",onfocus:"手机号码格式错误"}).regexValidator({regexp:"mobile",datatype:"enum",onerror:"手机号码格式错误"});
	
})
		</script>
			</div>
		</div>
		<!--手机认证 结束-->
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>