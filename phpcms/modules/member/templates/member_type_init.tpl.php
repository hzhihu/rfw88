<?php defined('IN_ADMIN') or exit('No permission resources.');?>
<?php include $this->admin_tpl('header', 'admin');?>

<form name="myform" id="myform" action="?m=member&c=member_type&a=delete" method="post" onsubmit="check();return false;">
<div class="pad-lr-10">
<div class="table-list">

<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left" width="30px"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
			<th align="left">ID</th>
			<th><?php echo L('sort')?></th>
			<th><?php echo L('TYPE_NAME')?></th>
			<th><?php echo L('TYPE_VIEW')?></th>
			<th><?php echo L('operation')?></th>
		</tr>
	</thead>
<tbody>
<?php
	foreach($member_group_list as $k=>$v) {
?>
    <tr>
		<td align="left"><?php if(!$v['issystem']) {?><input type="checkbox" value="<?php echo $v['id']?>" name="id[]"><?php }?></td>
		<td align="left"><?php echo $v['id']?></td>
		<td align="center"><input type="text" name="sort[<?php echo $v['id']?>]" class="input-text" size="1" value="<?php echo $v['sort']?>"></th>
		<td align="center" title="<?php echo $v['desc']?>"><?php echo $v['name']?></td>
		<td align="center"><?php echo $v['disable'] ? L('icon_unlock') : L('icon_locked')?></td>
		<td align="center"><a href="javascript:edit(<?php echo $v['id']?>, '<?php echo $v['name']?>')">[<?php echo L('edit')?>]</a></td>
    </tr>
<?php
	}
?>
</tbody>
 </table>

<div class="btn"><label for="check_box"><?php echo L('select_all')?>/<?php echo L('cancel')?></label> <input type="submit" class="button" name="dosubmit" value="<?php echo L('delete')?>" onclick="return confirm('<?php echo L('sure_delete')?>')"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action='?m=member&c=member_type&a=sort'" value="<?php echo L('sort')?>"/>
</div> 
<div id="pages"><?php echo $pages?></div>
</div>
</div>
</form>
<div id="PC__contentHeight" style="display:none">160</div>
<script language="JavaScript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'<?php echo L('edit').L('MEMBER_TYPE')?>《'+name+'》',id:'edit',iframe:'?m=member&c=member_type&a=edit&id='+id,width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

function check() {
	if(myform.action == '?m=member&c=member_type&a=delete') {
		var ids='';
		$("input[name='id[]']:checked").each(function(i, n){
			ids += $(n).val() + ',';
		});
		if(ids=='') {
			window.top.art.dialog({content:'<?php echo L('plsease_select').L('MEMBER_TYPE')?>',lock:true,width:'200',height:'50',time:1.5},function(){});
			return false;
		}
	}
	myform.submit();
}
//-->
</script>
</body>
</html>