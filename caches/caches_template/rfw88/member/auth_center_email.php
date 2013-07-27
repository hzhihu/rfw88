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
		<!--邮箱认证 开始-->
		<?php if($memberinfo['email_status']==1) { ?>
		<div class="user_help">您的邮箱已经通过认证：<b><?php echo $memberinfo['email'];?></b> </div>
		
		<?php } else { ?>
		<div class="user_help">您的邮箱还没通过认证：<b><?php echo $memberinfo['email'];?></b></div>
		<div class="user_right_border">
			<div class="c">
				<form action="" method="post" onsubmit="this.elements['submit'].disabled='disabled';return true;">
				认证邮箱：<input type="text" name="email" value="<?php echo $memberinfo['email'];?>"  readonly=""/>  <input type="submit" name="submit" value="重新激活"  />
				</form>
			</div>
		</div>
		<?php } ?>
		<!--邮箱认证 结束-->
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>