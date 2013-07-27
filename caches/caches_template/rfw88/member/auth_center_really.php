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
		<?php if($memberinfo['avatar_status']==1) { ?> 
		<div class="user_help">注意：您已经通过了实名认证，如要修改请跟客服联系。</div>
		<div class="user_right_border">
			<div class="l">用户名：</div>
			<div class="c">
				<?php echo $memberinfo['username'];?> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">真实姓名：</div>
			<div class="c">
				<?php echo $memberinfo['realname'];?> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">性 别 ：</div>
			<div class="c">
				<?php if($memberinfo['sex']==1) { ?>男<?php } else { ?>女<?php } ?> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">民 族：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=linkage_nation&value=<?php echo $memberinfo['nation'];?>" ></script>  
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">出生日期：</div>
			<div class="c">
				<?php echo FORMAT::date(strtotime($memberinfo['birthday']),0);?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">证件类别：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=linkage_card_type&value={$memberinfo.card_type}" ></script> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">证件号码：</div>
			<div class="c">
				<?php echo $memberinfo['card_id'];?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">籍贯：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=area&area=<?php echo $memberinfo['area'];?>" ></script>
			</div>
		</div>
		<div class="user_right_border">
			<div class="l">身份证图片：</div>
			<div class="c">
				<a href="<?php echo $memberinfo['card_pic1'];?>" target="_blank">正面</a> | <a href="<?php echo $memberinfo['card_pic2'];?>" target="_blank">反面</a>
			</div>
		</div>
		<?php } else { ?>
		
		<form action="" id="myform" name="myform" method="post"  enctype="multipart/form-data">
		<div class="user_help">注意：请认真填写以下的内容，一旦通过实名认证以下信息将不能修改。认证费用国家统一5元!（应广大用户要求，现认证由网站垫付。）</div>
		<div class="user_right_border">
			<div class="l">用户名：</div>
			<div class="c">
				<?php echo $memberinfo['username'];?> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">真实姓名：</div>
			<div class="c">
				<input type="text" id="realname" name="realname" value="<?php echo $memberinfo['realname'];?>" /><?php echo $memberinfo['realname'];?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">性 别 ：</div>
			<div class="c">
				<input type="radio" name="sex" value="1" <?php if($memberinfo['sex']=="1" || $memberinfo['sex']=="") { ?>checked="checked" <?php } ?> />男 <input type="radio" name="sex" value="2"  <?php if($memberinfo['sex']=="2") { ?>checked="checked" <?php } ?> />女 			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">民 族：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=linkage_nation&value=<?php echo $memberinfo['nation'];?>" ></script>  
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">出生日期：</div>
			<div class="c">
			<?php echo form::date('birthday',$memberinfo['birthday']);?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">证件类别：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=linkage_card_type&value={$memberinfo.card_type}" ></script> 
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">证件号码：</div>
			<div class="c">
				<input type="text" id="card_id" name="card_id" value="<?php echo $memberinfo['card_id'];?>" />  			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">籍贯：</div>
			<div class="c">
				<script type="text/javascript" src="index.php?m=htmls&c=index&a=area&area=<?php echo $memberinfo['area'];?>" ></script>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">身份证正面上传：</div>
			<div class="c">
				<input type="file" name="card_pic1" size="20" class="input_border"/> <?php if($memberinfo['card_pic1']!="") { ?><a href="./<?php echo $memberinfo['card_pic1'];?>" target="_blank" title="有图片"><img src="statics/images/ico_yes.gif" border="0"  /></a><?php } ?> 
			</div>
		</div>
		
		
	<div class="user_right_border">
			<div class="l">身份证背面上传：</div>
			<div class="c">
				<input type="file" name="card_pic2" size="20" class="input_border"/> <?php if($memberinfo['card_pic2']!="") { ?><a href="./<?php echo $memberinfo['card_pic2'];?>" target="_blank" title="有图片"><img src="statics/images/ico_yes.gif" border="0"  /></a><?php } ?>  
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
	$("#realname").formValidator({onshow:"请输入真实姓名",onfocus:"真实姓名为2-5位之间"}).inputValidator({min:4,max:10,onerror:"真实姓名为2-5位之间"});
	$("#birthday").formValidator({onshow:"请输入生日",onfocus:"生日格式错误"}).regexValidator({regexp:"date",datatype:"enum",onerror:"生日格式错误"});
	$("#card_id").formValidator({onshow:"请输入证件号码",onfocus:"证件号码为2-20位这间"}).inputValidator({min:2,max:20,onerror:"证件号码应该为2-20位之间"});
	$("#province").formValidator({onshow:"请选择籍贯"});
	
})
		</script>
		<?php } ?>
		<div class="user_right_foot">
		* 温馨提示：我们将严格对用户的所有资料进行保密
		</div>
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>