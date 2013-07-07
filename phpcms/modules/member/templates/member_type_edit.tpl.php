<?php defined('IN_ADMIN') or exit('No permission resources.');?>
<?php include $this->admin_tpl('header', 'admin');?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"<?php echo L('input').L('TYPE_NAME')?>",onfocus:"<?php echo L('TYPE_NAME').L('between_2_to_8')?>"}).inputValidator({min:2,max:15,onerror:"<?php echo L('TYPE_NAME').L('between_2_to_8')?>"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"m=member&c=member_type&a=public_checkname_ajax&oldid=<?php echo $info['id']?>",
		datatype : "html",
		async:'false',
		success : function(data){	
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "<?php echo L('TYPE_NAME_ALREADY_EXIST')?>",
		onwait : "<?php echo L('connecting_please_wait')?>"
	}).defaultPassed();
});
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?m=member&c=member_type&a=edit" method="post" id="myform">
<input type="hidden" name="info[id]"value="<?php echo $info['id']?>">
<fieldset>
	<legend><?php echo L('basic_configuration')?></legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80"><?php echo L('TYPE_NAME')?></td> 
			<td><input type="text" name="info[name]" value="<?php echo $info['name']?>"  class="input-text" id="name"></input></td>
		</tr>
		<tr>
			<td><?php echo L('TYPE_DESC')?></td> 
			<td><input type="text" name="info[desc]" value="<?php echo $info['desc']?>" class="input-text" id="desc" value=""></input></td>
		</tr>
		<tr>
			<td><?php echo L('TYPE_VIEW')?></td> 
			<td>
			<input type="radio" name="info[disable]" id="disable_yes" value="1" <?php if($info['disable']) echo "checked";?>><label for="disable_yes"><?php echo L('TYPE_YES');?></label>
			<input type="radio" name="info[disable]" id="disable_no" value="0" <?php if(!$info['disable']) echo "checked";?>><label for="disable_no"><?php echo L('TYPE_NO');?></label>
			</td>
		</tr>
	</table>
</fieldset>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" id="dosubmit" value="<?php echo L('submit')?>" class="dialog">
</form>
</div>
</div>
</body>
</html>