<?php defined('IN_ADMIN') or exit('No permission resources.');?>
<?php include $this->admin_tpl('header', 'admin');?>

<table  border="0"  cellspacing="1" bgcolor="#CCCCCC" width="100%">
		<tr >
			<td width="*" class="main_td">用户名称</td>
			<td class="main_td">真实姓名</td>
			<td class="main_td">性别</td>
			<td class="main_td">民族</td>
			<td class="main_td">生日</td>
			<td class="main_td">证件类型</td>
			<td class="main_td">证件号码</td>
			<td class="main_td">籍贯</td>
			<td class="main_td">身份证图片</td>
			<td class="main_td">状态</td>
			<td class="main_td">操作</td>
		</tr>
		<?php foreach ($result['list'] as $key=>$item){?>
		<tr  <?php if ($key%2==1): ?> class="tr2" <?php endif; ?>>
			<td class="main_td1" align="center"><a href="javascript:void(0)" onclick='tipsWindown("用户详细信息查看","url:get?{$_A.admin_url}&q=module/user/view&user_id={$item.user_id}&type=scene",500,230,"true","","true","text");'><?php echo $item['username'] ?></a></td>
			<td class="main_td1" align="center" >{$item.realname}</td>
			<td class="main_td1" align="center" >{if $item.sex==1}男{else}女{/if}</td>
			<td class="main_td1" align="center" >{$item.nation|linkage}</td>
			<td class="main_td1" align="center" >{$item.birthday|date_format:"Y-m-d "}</td>
			<td class="main_td1" align="center" >{$item.card_type|linkage:"card_type"}</td>
			<td class="main_td1" align="center" >{$item.card_id}</td>
			<td class="main_td1" align="center" >{$item.area|area}</td>
			<td class="main_td1" align="center" >{if $item.card_pic1!=""}<a href="{$item.card_pic1}" target="_blank">正面</a>{else}无{/if}| {if $item.card_pic2!=""}<a  href="{$item.card_pic2}" target="_blank">背面</a>{else}无{/if}</td>
			<!--
			<td class="main_td1" align="center" >{if $item.card_pic1!=""}<a href="{$item.card_pic1}"  onclick='tipsWindown("身份证正面图片","img:{$item.card_pic1}",500,430,"true","","true","img")'>正面</a>{else}无{/if}| {if $item.card_pic2!=""}<a  href="#"  onclick='tipsWindown("身份证反面图片","img:{$item.card_pic2}",500,430,"true","","true","img")'>背面</a>{else}无{/if}</td>
			-->
			<td class="main_td1" align="center" >{if $item.real_status==2}<font color="#00ffff">等待审核</font>{else}<font color="#009900">审核通过</font>{/if}</td>
			<td class="main_td1" align="center" >{if $item.real_status!=1}<a href="javascript:void(0)" onclick='tipsWindown("真实姓名审核","url:get?{$_A.query_url}/audit&user_id={$item.user_id}&type=realname",500,230,"true","","true","text");'>审核</a>{else}-{/if} </td>
		</tr>
		<?php }?>
		<tr>
		<td colspan="11" class="action">
		<div class="floatl">
		
		</div>
		<div class="floatr">
			用户名：<input type="text" name="username" id="username" value="{$magic.request.username}"/> 状态<select id="status" ><option value="">全部</option><option value="1" {if $magic.request.real_status==1} selected="selected"{/if}>已通过</option><option value="0" {if $magic.request.real_status=="0"} selected="selected"{/if}>未通过</option></select> <input type="button" value="搜索" / onclick="sousuo()">
		</div>
		</td>
	</tr>
	</form>	
</table>
<div class="btn"><label for="check_box"><?php echo L('select_all')?>/<?php echo L('cancel')?></label> <input type="submit" class="button" name="dosubmit" value="<?php echo L('delete')?>" onclick="return confirm('<?php echo L('sure_delete')?>')"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action='?m=member&c=member_group&a=sort'" value="<?php echo L('sort')?>"/>
</div> 
<div id="pages"><?php echo empty($result['pages_htmls'])?'':$result['pages_htmls'];?></div>
</div>
</div>
<script>
var url = '{$_A.query_url}/realname';
{literal}
function sousuo(){
	var sou = "";
	var username = $("#username").val();
	if (username!=""){
		sou += "&username="+username;
	}
	var status = $("#status").val();
	if (status!=""){
		sou += "&real_status="+status;
	}
	
	location.href=url+sou;
	
}
</script>