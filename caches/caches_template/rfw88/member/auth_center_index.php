<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('member', 'header'); ?>
<div id="memberArea">
<?php include template('member', 'auth_center_left'); ?>
<div class="col-auto">
	<div class="col-1 ">
		<h5 class="title"><?php echo L('memberinfo');?>：</h5>
		<div class="content">
		<div class="col-1 member-info">
		<div class="content">
			<div class="col-left himg">
				<a title="<?php echo L('modify').L('avatar');?>" href="index.php?m=member&c=index&a=account_manage_avatar&t=1"><img src="<?php echo $avatar['90'];?>" width="60" height="60" onerror="this.src='<?php echo $phpsso_api_url;?>/statics/images/member/nophoto.gif'"></a>
			</div>
			<div class="col-auto">
				<h5><?php if($memberinfo['vip']) { ?><img src="<?php echo IMG_PATH;?>icon/vip.gif"><?php } elseif ($memberinfo['overduedate']) { ?><img src="<?php echo IMG_PATH;?>icon/vip-expired.gif" title="<?php echo L('overdue');?>，<?php echo L('overduedate');?>：<?php echo format::date($memberinfo['overduedate'],1);?>"><?php } ?>
				<font color="<?php echo $grouplist[$memberinfo['groupid']]['usernamecolor'];?>">
				<?php if($memberinfo['nickname']) { ?> <?php echo $memberinfo['nickname'];?> <?php } else { ?> <?php echo $memberinfo['username'];?><?php } ?> 
				</font>
				<?php if($memberinfo['email']) { ?>（<?php echo $memberinfo['email'];?>）<?php } ?></h5>
				<p class="blue">
				<?php echo L('account_remain');?>：<font style="color:#F00; font-size:22px;font-family:Georgia,Arial; font-weight:700"><?php echo $memberinfo['amount'];?></font> <?php echo L('unit_yuan');?>，
				<?php echo L('point');?>：<font style="color:#F00; font-size:12px;font-family:Georgia,Arial; font-weight:700"><?php echo $memberinfo['point'];?></font> <?php echo L('unit_point');?><?php if($memberinfo['vip']) { ?>，vip<?php echo L('overduedate');?>：<font style="color:#F00; font-size:12px;font-family:Georgia,Arial; font-weight:700"><?php echo format::date($memberinfo['overduedate']);?></font><?php } ?>
				</p>
			</div>
		</div>
	</div>

	<div class="bk10"></div>	
	<div class="col-1 ">
		<h5 class="title"><?php echo L('more_configuration');?>：</h5>
		<div class="content">
				<table width="100%" cellspacing="0" class="table_form">
					<tr>
						<th width="120"><?php echo L('username');?></th>        
						<td><?php echo $memberinfo['username'];?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('regtime');?>：</th>        
						<td><?php echo FORMAT::date($memberinfo['regdate'] ,1);?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('lastlogintime');?>：</th>        
						<td><?php echo FORMAT::date($memberinfo['lastdate'] ,1);?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('regip');?>：</th>        
						<td><?php echo $memberinfo['regip'];?></td>
					</tr>
					<tr>
						<th width="120"><?php echo L('lastip');?>：</th>        
						<td><?php echo $memberinfo['lastip'];?></td>
					</tr>
					<tr>
						<th width="120">是否实名认证：</th>        
						<td><?php if($memberinfo['avatar_status']) { ?> 是<?php } else { ?><a href="index.php?m=member&c=auth_center&a=really&t=6">否</a> <?php } ?></td>
					</tr>
					<tr>
						<th width="120">是否邮箱认证：</th>        
						<td><?php if($memberinfo['email_status']) { ?> 是<?php } else { ?><a href="index.php?m=member&c=auth_center&a=email&t=6">否</a> <?php } ?></td>
					</tr>
					<tr>
						<th width="120">是否手机认证：</th>        
						<td><?php if($memberinfo['phone_status']) { ?> 是<?php } else { ?><a href="index.php?m=member&c=auth_center&a=mobile&t=6">否</a> <?php } ?></td>
					</tr>
				</table>
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>