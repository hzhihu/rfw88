
<div class="module_add">

	<form action="" method="post" onsubmit="return check_form()" name="form1">
	<div class="module_title"><strong><? if (!isset($this->magic_vars['_A']['query_type'])) $this->magic_vars['_A']['query_type']=''; ;if (  $this->magic_vars['_A']['query_type'] == "edit"): ?>编辑<? else: ?>添加<? endif; ?><? if (!isset($this->magic_vars['_A']['list_title'])) $this->magic_vars['_A']['list_title'] = ''; echo $this->magic_vars['_A']['list_title']; ?></strong></div>
	
	<div class="module_border">
		<div class="l"><? if (!isset($this->magic_vars['_A']['list_title'])) $this->magic_vars['_A']['list_title'] = ''; echo $this->magic_vars['_A']['list_title']; ?>名称：</div>
		<div class="c">
			<input type="text" name="name"  class="input_border" value="<? if (!isset($this->magic_vars['_A']['area_result']['name'])) $this->magic_vars['_A']['area_result']['name'] = ''; echo $this->magic_vars['_A']['area_result']['name']; ?>" size="30" />  
		</div>
	</div>
	
	<div class="module_border">
		<div class="l"><? if (!isset($this->magic_vars['_A']['list_title'])) $this->magic_vars['_A']['list_title'] = ''; echo $this->magic_vars['_A']['list_title']; ?>标识名：</div>
		<div class="c">
			<input type="text" name="nid"  class="input_border" value="<? if (!isset($this->magic_vars['_A']['area_result']['nid'])) $this->magic_vars['_A']['area_result']['nid'] = ''; echo $this->magic_vars['_A']['area_result']['nid']; ?>" size="30" />
		</div>
	</div>
	
	<!--
	<div class="module_border">
		<div class="l">省份二级域名：</div>
		<div class="c">
			<input type="text" name="domain"  class="input_border" value="<? if (!isset($this->magic_vars['_A']['area_result']['domain'])) $this->magic_vars['_A']['area_result']['domain'] = '';$_tmp = $this->magic_vars['_A']['area_result']['domain'];$_tmp = $this->magic_modifier("default",$_tmp,".xiuw.org");echo $_tmp;unset($_tmp); ?>" size="30" /> 比如：beijing.hycms.com
		</div>
	</div>
	-->
	<div class="module_border">
		<div class="l">排序：</div>
		<div class="c">
			<input type="text" name="order"  class="input_border" value="<? if (!isset($this->magic_vars['_A']['area_result']['order'])) $this->magic_vars['_A']['area_result']['order'] = '';$_tmp = $this->magic_vars['_A']['area_result']['order'];$_tmp = $this->magic_modifier("default",$_tmp,"10");echo $_tmp;unset($_tmp); ?>" size="10" />
		</div>
	</div>
	
	<div class="module_submit border_b" >
		<input type="hidden" name="pid" value="<? if (!isset($_REQUEST['pid'])) $_REQUEST['pid'] = '';$_tmp = $_REQUEST['pid'];$_tmp = $this->magic_modifier("default",$_tmp,"0");echo $_tmp;unset($_tmp); ?>" />
		<? if (!isset($this->magic_vars['_A']['query_type'])) $this->magic_vars['_A']['query_type']=''; ;if (  $this->magic_vars['_A']['query_type'] == "edit"): ?><input type="hidden" name="id" value="<? if (!isset($this->magic_vars['_A']['area_result']['id'])) $this->magic_vars['_A']['area_result']['id'] = ''; echo $this->magic_vars['_A']['area_result']['id']; ?>" /><? endif; ?>
		<input type="submit"  name="submit" value="确认提交" />
		<input type="button" onclick="javascript:location.href='<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>&action=<? if (!isset($_REQUEST['action'])) $_REQUEST['action'] = ''; echo $_REQUEST['action']; ?>&pid=<? if (!isset($_REQUEST['pid'])) $_REQUEST['pid'] = ''; echo $_REQUEST['pid']; ?>'" value="添加<? if (!isset($this->magic_vars['_A']['list_title'])) $this->magic_vars['_A']['list_title'] = ''; echo $this->magic_vars['_A']['list_title']; ?>" />
	</div>
	</form>
</div>
<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
	<form action="<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>/action" method="post">
	<tr >
		<td class="main_td">ID</td>
		<td class="main_td">地区类型</td>
		<td class="main_td">标识名</td>
		<td class="main_td">类型</td>
		<td class="main_td">排序</td>
		<td class="main_td">操作</td>
	</tr>
	<?  if(!isset($this->magic_vars['_A']['area_list']) || $this->magic_vars['_A']['area_list']=='') $this->magic_vars['_A']['area_list'] = array();  $_from = $this->magic_vars['_A']['area_list']; 
 if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); } 
if (count($_from)>0):
;    foreach ($_from as $this->magic_vars['key'] =>  $this->magic_vars['item']):
?>
	<tr <? if (!isset($this->magic_vars['key'])) $this->magic_vars['key']=''; ;if (  $this->magic_vars['key']%2==1): ?> class="tr2"<? endif; ?>>
		<td class="main_td1" align="center"><? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?></td>
		<td class="main_td1" align="center" ><? if (!isset($this->magic_vars['item']['name'])) $this->magic_vars['item']['name'] = ''; echo $this->magic_vars['item']['name']; ?></td>
		<td class="main_td1" align="center" ><? if (!isset($this->magic_vars['item']['nid'])) $this->magic_vars['item']['nid'] = ''; echo $this->magic_vars['item']['nid']; ?></td>
		<td class="main_td1" align="center" ><? if (!isset($this->magic_vars['_A']['list_title'])) $this->magic_vars['_A']['list_title'] = ''; echo $this->magic_vars['_A']['list_title']; ?></td>
		<td class="main_td1" align="center" ><input type="text" value="<? if (!isset($this->magic_vars['item']['order'])) $this->magic_vars['item']['order'] = '';$_tmp = $this->magic_vars['item']['order'];$_tmp = $this->magic_modifier("default",$_tmp,"10");echo $_tmp;unset($_tmp); ?>" name="order[]" size="5" /><input type="hidden" name="id[]" value="<? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?>" /></td>
		<td class="main_td1" align="center" width="130"><? if (!isset($_REQUEST['action'])) $_REQUEST['action']='';if (!isset($_REQUEST['action'])) $_REQUEST['action']=''; ;if (  $_REQUEST['action']=='' ||  $_REQUEST['action']=='province'): ?><a href="<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>&action=city&pid=<? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?><? if (!isset($this->magic_vars['_A']['site_url'])) $this->magic_vars['_A']['site_url'] = ''; echo $this->magic_vars['_A']['site_url']; ?>">城市</a> /<? if (!isset($_REQUEST['action'])) $_REQUEST['action']=''; ;elseif (  $_REQUEST['action']=='city'): ?> <a href="<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>&action=area&pid=<? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?><? if (!isset($this->magic_vars['_A']['site_url'])) $this->magic_vars['_A']['site_url'] = ''; echo $this->magic_vars['_A']['site_url']; ?>">地区</a> / <? endif; ?><a href="<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>/edit&action=<? if (!isset($_REQUEST['action'])) $_REQUEST['action'] = '';$_tmp = $_REQUEST['action'];$_tmp = $this->magic_modifier("default",$_tmp,"province");echo $_tmp;unset($_tmp); ?>&pid=<? if (!isset($this->magic_vars['item']['pid'])) $this->magic_vars['item']['pid'] = ''; echo $this->magic_vars['item']['pid']; ?>&id=<? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?><? if (!isset($this->magic_vars['_A']['site_url'])) $this->magic_vars['_A']['site_url'] = ''; echo $this->magic_vars['_A']['site_url']; ?>">修改</a> / <a href="#" onClick="javascript:if(confirm('确定要删除吗?删除后将不可恢复')) location.href='<? if (!isset($this->magic_vars['_A']['query_url'])) $this->magic_vars['_A']['query_url'] = ''; echo $this->magic_vars['_A']['query_url']; ?>/del&id=<? if (!isset($this->magic_vars['item']['id'])) $this->magic_vars['item']['id'] = ''; echo $this->magic_vars['item']['id']; ?><? if (!isset($this->magic_vars['_A']['site_url'])) $this->magic_vars['_A']['site_url'] = ''; echo $this->magic_vars['_A']['site_url']; ?>'">删除</a></td>
	</tr>
	<? endforeach; endif; unset($_from); ?>
	<tr >
		<td colspan="8" class="submit"  height="30">
			<input type="submit" name="submit" value="修改排序" /><input type="hidden" name="type" value="0" />
		</td>
	</tr>
	<tr >
		<td colspan="8" class="page"  height="30">
			<? if (!isset($this->magic_vars['_A']['showpage'])) $this->magic_vars['_A']['showpage'] = ''; echo $this->magic_vars['_A']['showpage']; ?>
		</td>
	</tr>
	</form>	
</table>



<script>
function check_form(){
	 var frm = document.forms['form1'];
	 var title = frm.elements['name'].value;
	 var nid = frm.elements['nid'].value;
	 var errorMsg = '';
	  if (title.length == 0 ) {
		errorMsg += '名称必须填写' + '\n';
	  }
	  if (nid.length == 0 ) {
		errorMsg += '标识名必须填写' + '\n';
	  }
	  if (errorMsg.length > 0){
		alert(errorMsg); return false;
	  } else{  
		return true;
	  }
}
</script>

