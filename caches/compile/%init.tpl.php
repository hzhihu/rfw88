<!--子栏目 开始-->

<?
$this->magic_vars['_G']['uurl'] = url_format($this->magic_vars['_G']['nowurl'],"order");
$this->magic_vars['_G']['epurl'] = url_format($this->magic_vars['_G']['nowurl'],"epage");
?>

<!--子栏目 结束-->
<? if (!isset($_REQUEST['type'])) $_REQUEST['type']=''; ;if (  $_REQUEST['type']==late): ?>

<div class="wrap950 invest">
	<div class="invest_order"> 
		<div class="floatl">
			<strong>逾期的借款人</strong>
		</div>
		<div class="floatr">
			显示： <a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=20"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_20.gif" align="absmiddle" /></a> 
			<a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=40"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_40.gif" align="absmiddle" /></a> 
			<a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=60"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_60.gif" align="absmiddle" /></a> &nbsp;&nbsp;
		</div>
	</div>
	<div class="invest_list">
		
		<table  border="0"  cellspacing="0"  width="100%">
			<tr  class="title">
			  <td width="18%" class="tou">头像</td>
			  <td  >资料</td>
			  <td >联系方式</td>
			   <td >公开财务</td>
			</tr>
			<?  if(!isset($this->magic_vars['loop']['list']) || $this->magic_vars['loop']['list']=='') $this->magic_vars['loop']['list'] = array();  $_from = $this->magic_vars['loop']['list']; 
 if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); } 
if (count($_from)>0):
;    foreach ($_from as $this->magic_vars['key'] =>  $this->magic_vars['var']):
?>
			<tr  class="tr1">
			  <td align="center" >
			  	<div style="margin-left:20px;" >
					<a href="/u/<? if (!isset($this->magic_vars['var']['user_id'])) $this->magic_vars['var']['user_id'] = ''; echo $this->magic_vars['var']['user_id']; ?>" target="_blank" ><img src="<? if (!isset($this->magic_vars['var']['user_id'])) $this->magic_vars['var']['user_id'] = '';$_tmp = $this->magic_vars['var']['user_id'];$_tmp = $this->magic_modifier("avatar",$_tmp,"middle");$_tmp = $this->magic_modifier("imgurl_format",$_tmp,"");echo $_tmp;unset($_tmp); ?>" border="0" class="picborder"/></a>
				</div>
			  </td>
			  <td >
			  	<ul class="li">
					<li class="cu" style="height:30px; overflow:hidden"><a href="/u/<? if (!isset($this->magic_vars['var']['user_id'])) $this->magic_vars['var']['user_id'] = ''; echo $this->magic_vars['var']['user_id']; ?>" title="<? if (!isset($this->magic_vars['var']['realname'])) $this->magic_vars['var']['realname'] = ''; echo $this->magic_vars['var']['realname']; ?>"><? if (!isset($this->magic_vars['var']['realname'])) $this->magic_vars['var']['realname'] = ''; echo $this->magic_vars['var']['realname']; ?></a></li>
					<li>性别：<? if (!isset($this->magic_vars['var']['sex'])) $this->magic_vars['var']['sex']=''; ;if (  $this->magic_vars['var']['sex']==1): ?>男<? else: ?>女<? endif; ?></li>
					<li>身份证号:<? if (!isset($this->magic_vars['var']['card_id'])) $this->magic_vars['var']['card_id'] = ''; echo $this->magic_vars['var']['card_id']; ?></li>
					<li>所 在 地：<? if (!isset($this->magic_vars['var']['area'])) $this->magic_vars['var']['area'] = '';$_tmp = $this->magic_vars['var']['area'];$_tmp = $this->magic_modifier("area",$_tmp,"");echo $_tmp;unset($_tmp); ?></li>
				</ul>
			  </td>
			  <td ><ul class="li">
			  	<li class="cu"><font color="#FF0000">欠款总额：￥<? if (!isset($this->magic_vars['var']['late_account'])) $this->magic_vars['var']['late_account'] = ''; echo $this->magic_vars['var']['late_account']; ?></font></li>
					<li >Email：<? if (!isset($this->magic_vars['var']['email'])) $this->magic_vars['var']['email'] = ''; echo $this->magic_vars['var']['email']; ?></li>
					<li>电话：<? if (!isset($this->magic_vars['var']['phone'])) $this->magic_vars['var']['phone'] = ''; echo $this->magic_vars['var']['phone']; ?></li>
					<li>QQ:<? if (!isset($this->magic_vars['var']['qq'])) $this->magic_vars['var']['qq'] = ''; echo $this->magic_vars['var']['qq']; ?></li>
				</ul></td>
			   <td >
			   <ul class="li">
					<li class="cu"><font color="#FF0000">逾期笔数：<? if (!isset($this->magic_vars['var']['late_num'])) $this->magic_vars['var']['late_num'] = ''; echo $this->magic_vars['var']['late_num']; ?>笔</font></li>
					<li>网站代还笔数：<? if (!isset($this->magic_vars['var']['late_webnum'])) $this->magic_vars['var']['late_webnum'] = '';$_tmp = $this->magic_vars['var']['late_webnum'];$_tmp = $this->magic_modifier("default",$_tmp,"0");echo $_tmp;unset($_tmp); ?></li>
					<li>最长逾期天数:<? if (!isset($this->magic_vars['var']['late_numdays'])) $this->magic_vars['var']['late_numdays'] = ''; echo $this->magic_vars['var']['late_numdays']; ?>天</li>
					<li >更新时间：<? if (!isset($this->magic_vars['_G']['nowtime'])) $this->magic_vars['_G']['nowtime'] = '';$_tmp = $this->magic_vars['_G']['nowtime'];$_tmp = $this->magic_modifier("date_format",$_tmp,"Y-m-d H:i:s");echo $_tmp;unset($_tmp); ?></li>
				</ul></td>
			   
			</tr>
			<? endforeach; endif; unset($_from); ?>
		</table> 
		
	</div>
	<!--分页开始-->
				<div>
					<table align="center" class="list_table_page">
						<tr align="center">
							<td height="25" ><Div align="center" ><? if (!isset($this->magic_vars['loop']['showpage'])) $this->magic_vars['loop']['showpage'] = ''; echo $this->magic_vars['loop']['showpage']; ?></Div></td>
						</tr>
					</table>
				</div>
				<!--分页结束-->
	

</div>



<? else: ?>
<!--投资搜索  开始-->
<div class="wrap950 list_1">
	<form action="" method="get">
	<div class="title"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_4.gif" /> 详细搜索</div>
	<div class="content">
		<div class="bor">
			<div class="bo_t">关键字：</div>
			<div class="bo_c">
				<input type="text" name="keywords" size="20" value="<? if (!isset($_REQUEST['keywords'])) $_REQUEST['keywords'] = '';$_tmp = $_REQUEST['keywords'];$_tmp = $this->magic_modifier("urldecode",$_tmp,"");echo $_tmp;unset($_tmp); ?>" />
			</div>
			<div class="bo_t">还款方式：</div>
			<div class="bo_c">
				<? $result = $this->magic_vars['_G']['_linkage']['borrow_style']; echo "<select name='style' id=style >"; echo "<option value=''>没有限制</option>"; if ($result!=''): foreach ($result as $key => $val): if ($_REQUEST['style']==$val['id'] ) { echo "<option value='{$val['id']}' selected>{$val['name']}</option>"; }else{echo "<option value='{$val['id']}' >{$val['name']}</option>";} endforeach;echo "</select>";endif; ?> 
			</div>
			<div class="bo_t">借款目的：</div>
			<div class="bo_c">
				<? $result = $this->magic_vars['_G']['_linkage']['borrow_use']; echo "<select name='use' id=use >"; echo "<option value=''>没有限制</option>"; if ($result!=''): foreach ($result as $key => $val): if ($_REQUEST['use']==$val['id'] ) { echo "<option value='{$val['id']}' selected>{$val['name']}</option>"; }else{echo "<option value='{$val['id']}' >{$val['name']}</option>";} endforeach;echo "</select>";endif; ?>  
			</div>
		</div>
		
		<div class="bor">
			<div class="bo_t">金额范围：</div>
			<div class="bo_c">
				<? $result = $this->magic_vars['_G']['_linkage']['account_amange']; echo "<select name='account1' id=account1 >"; if ($result!=''): foreach ($result as $key => $val): if ($_REQUEST['account1']==$val['value']) { echo "<option value='{$val['value']}' selected>{$val['name']}</option>"; }else{echo "<option value='{$val['value']}' >{$val['name']}</option>";} endforeach;echo "</select>";endif; ?>  
				
				到 
				<? $result = $this->magic_vars['_G']['_linkage']['account_amange']; echo "<select name='account2' id=account2 >"; echo "<option value=''>没有限制</option>"; if ($result!=''): foreach ($result as $key => $val): if ($_REQUEST['account2']==$val['value']) { echo "<option value='{$val['value']}' selected>{$val['name']}</option>"; }else{echo "<option value='{$val['value']}' >{$val['name']}</option>";} endforeach;echo "</select>";endif; ?>  
				
			</div>
			<div class="bo_t">期 限：</div>
			<div class="bo_c">
				
				<? $result = $this->magic_vars['_G']['_linkage']['borrow_time_limit']; echo "<select name='limittime' id=limittime >"; echo "<option value=''>没有限制</option>"; if ($result!=''): foreach ($result as $key => $val): if ($_REQUEST['limittime']==$val['value']) { echo "<option value='{$val['value']}' selected>{$val['name']}</option>"; }else{echo "<option value='{$val['value']}' >{$val['name']}</option>";} endforeach;echo "</select>";endif; ?>  
				
			</div>
			<div class="bo_t">奖 励：</div>
			<div class="bo_c">
				<select name="award">
					<option value="">无限制</option>
					<option value="1" <? if (!isset($_REQUEST['award'])) $_REQUEST['award']=''; ;if (  $_REQUEST['award']=="1"): ?> selected="selected"<? endif; ?>>只显示有奖励的</option>
					<option value="2" <? if (!isset($_REQUEST['award'])) $_REQUEST['award']=''; ;if (  $_REQUEST['award']=="2"): ?> selected="selected"<? endif; ?>>只显示没奖励的</option>
				</select> 
			</div>
		</div>
		
		<div class="bor">
			<div class="bo_t">所在地区：</div>
			<div class="bo_c" style="width:230px;">
				<script src="index.php?q=area&type=p,c&area=<? if (!isset($_REQUEST['city'])) $_REQUEST['city'] = ''; echo $_REQUEST['city']; ?>"></script> 
			</div>
			
			<div class="bo_c">
				<input type="image" src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/sousuo.gif"> <input type="hidden" name="type" value="<? if (!isset($_REQUEST['type'])) $_REQUEST['type'] = ''; echo $_REQUEST['type']; ?>" />
			</div>
		</div>
	</div>
	</form>
	<div class="foot"></div>
</div>
<!--投资搜索 结束-->

<div class="wrap950 invest">
	<div class="invest_order"> 
		<div class="floatl">
		<? if (!isset($this->magic_vars['var']['is_vouch'])) $this->magic_vars['var']['is_vouch']=''; ;if (  $this->magic_vars['var']['is_vouch']!=1): ?>
			<span><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/order.gif" align="absmiddle" /></span> 
			<span>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;if (  $_REQUEST['order']=='account_up'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=account_down"><font color="#FF0000">金额↑</font></a>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;elseif (  $_REQUEST['order']=='account_down'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=account_up"><font color="#FF0000">金额↓</font></a>
				<? else: ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=account_up">金额</a><? endif; ?>
			</span> 
			<span>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;if (  $_REQUEST['order']=='apr_up'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=apr_down"><font color="#FF0000">利率↑</font></a>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;elseif (  $_REQUEST['order']=='apr_down'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=apr_up"><font color="#FF0000">利率↓</font></a>
				<? else: ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=apr_up">利率</a><? endif; ?>
			</span> 
			<span>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;if (  $_REQUEST['order']=='jindu_up'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=jindu_down"><font color="#FF0000">进度↑</font></a>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;elseif (  $_REQUEST['order']=='jindu_down'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=jindu_up"><font color="#FF0000">进度↓</font></a>
				<? else: ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=jindu_up">进度</a><? endif; ?>
			</span> 
			<span>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;if (  $_REQUEST['order']=='credit_up'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=credit_down"><font color="#FF0000">信用↑</font></a>
				<? if (!isset($_REQUEST['order'])) $_REQUEST['order']=''; ;elseif (  $_REQUEST['order']=='credit_down'): ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=credit_up"><font color="#FF0000">信用↓</font></a>
				<? else: ?><a href="<? if (!isset($this->magic_vars['_G']['uurl'])) $this->magic_vars['_G']['uurl'] = ''; echo $this->magic_vars['_G']['uurl']; ?>&order=credit_up">信用</a><? endif; ?>
			</span>  
			<? endif; ?>
		</div>
		<div class="floatr">
			显示： <a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=20"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_20.gif" align="absmiddle" /></a> 
			<a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=40"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_40.gif" align="absmiddle" /></a> 
			<a href="<? if (!isset($this->magic_vars['_G']['epurl'])) $this->magic_vars['_G']['epurl'] = ''; echo $this->magic_vars['_G']['epurl']; ?>&epage=60"><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/ico_60.gif" align="absmiddle" /></a> &nbsp;&nbsp;
		</div>
	</div>
	<div class="invest_list">
		
		<table  border="0"  cellspacing="0"  width="100%">
			<tr  class="title">
			  <td width="18%" class="tou">头像</td>
			  <td width="16%" >标题/借款者</td>
			  <td width="16%" >金额/利率/用途</td>
			   <td width="24%" >进度/状态</td>
			   <td width="16%" >期限/所在地/等级</td>
			   <td width="*" ></td>
			</tr>
			<?  if(!isset($this->magic_vars['loop']['list']) || $this->magic_vars['loop']['list']=='') $this->magic_vars['loop']['list'] = array();  $_from = $this->magic_vars['loop']['list']; 
 if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); } 
if (count($_from)>0):
;    foreach ($_from as $this->magic_vars['key'] =>  $this->magic_vars['var']):
?>
			<tr  class="tr1">
			  <td align="center" >
			  	<div style="margin-left:20px;" >
					<a href="a<? if (!isset($this->magic_vars['var']['id'])) $this->magic_vars['var']['id'] = ''; echo $this->magic_vars['var']['id']; ?>.html" ><img src="<? if (!isset($this->magic_vars['var']['user_id'])) $this->magic_vars['var']['user_id'] = '';$_tmp = $this->magic_vars['var']['user_id'];$_tmp = $this->magic_modifier("avatar",$_tmp,"middle");$_tmp = $this->magic_modifier("imgurl_format",$_tmp,"");echo $_tmp;unset($_tmp); ?>" border="0" class="picborder" width="100px" height="90px"/></a>
				</div>
			  </td>
			  <td >
			  	<ul class="li">
					<li class="cu" style="height:30px; overflow:hidden"><a href="a<? if (!isset($this->magic_vars['var']['id'])) $this->magic_vars['var']['id'] = ''; echo $this->magic_vars['var']['id']; ?>.html" title="<? if (!isset($this->magic_vars['var']['name'])) $this->magic_vars['var']['name'] = ''; echo $this->magic_vars['var']['name']; ?>"><? if (!isset($this->magic_vars['var']['name'])) $this->magic_vars['var']['name'] = ''; echo $this->magic_vars['var']['name']; ?></a> </li>
					<li>贷款号：<? if (!isset($this->magic_vars['var']['id'])) $this->magic_vars['var']['id'] = ''; echo $this->magic_vars['var']['id']; ?><? if (!isset($this->magic_vars['var']['is_vouch'])) $this->magic_vars['var']['is_vouch']=''; ;if (  $this->magic_vars['var']['is_vouch']==1): ?><img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/danbao.gif" /><? endif; ?> <? if (!isset($this->magic_vars['var']['flag'])) $this->magic_vars['var']['flag']=''; ;if (  $this->magic_vars['var']['flag']==1): ?> <img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/tuijian.gif" align="absmiddle" /><? if (!isset($this->magic_vars['var']['flag'])) $this->magic_vars['var']['flag']=''; ;elseif (   $this->magic_vars['var']['flag']==2): ?> <img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/danbao.gif" align="absmiddle"/><? if (!isset($this->magic_vars['var']['flag'])) $this->magic_vars['var']['flag']=''; ;elseif (   $this->magic_vars['var']['flag']==3): ?> <img src="<? if (!isset($this->magic_vars['tpldir'])) $this->magic_vars['tpldir'] = ''; echo $this->magic_vars['tpldir']; ?>/images/diya.gif" align="absmiddle"/><? endif; ?></li>
					<li>发布者：<a href="/u/<? if (!isset($this->magic_vars['var']['user_id'])) $this->magic_vars['var']['user_id'] = ''; echo $this->magic_vars['var']['user_id']; ?>" target="_blank"><? if (!isset($this->magic_vars['var']['username'])) $this->magic_vars['var']['username'] = ''; echo $this->magic_vars['var']['username']; ?></a></li>
					<li>客 &nbsp;服：<? if (!isset($this->magic_vars['var']['kefu_username'])) $this->magic_vars['var']['kefu_username'] = '';$_tmp = $this->magic_vars['var']['kefu_username'];$_tmp = $this->magic_modifier("default",$_tmp,"-");echo $_tmp;unset($_tmp); ?></li>
				</ul>
			  </td>
			  <td ><ul class="li">
					<li class="cu"><font color="#FF0000">￥<? if (!isset($this->magic_vars['var']['account'])) $this->magic_vars['var']['account'] = ''; echo $this->magic_vars['var']['account']; ?> 元</font></li>
					<li>年利率：<? if (!isset($this->magic_vars['var']['apr'])) $this->magic_vars['var']['apr'] = ''; echo $this->magic_vars['var']['apr']; ?>%</li>
					<li><? if (!isset($this->magic_vars['var']['use'])) $this->magic_vars['var']['use'] = '';$_tmp = $this->magic_vars['var']['use'];$_tmp = $this->magic_modifier("linkage",$_tmp,"");echo $_tmp;unset($_tmp); ?></li>
					<li><? if (!isset($this->magic_vars['var']['style'])) $this->magic_vars['var']['style'] = '';$_tmp = $this->magic_vars['var']['style'];$_tmp = $this->magic_modifier("linkage",$_tmp,"borrow_style");echo $_tmp;unset($_tmp); ?></li>
				</ul></td>
				
				<? if (!isset($this->magic_vars['var']['is_vouch'])) $this->magic_vars['var']['is_vouch']=''; ;if (  $this->magic_vars['var']['is_vouch']==1): ?>
				<td ><ul class="li">
					<li >
						<div class="rate_bg ">
							<div class="rate_tiao" style="width:<? if (!isset($this->magic_vars['var']['scale'])) $this->magic_vars['var']['scale'] = '';$_tmp = $this->magic_vars['var']['scale'];$_tmp = $this->magic_modifier("default",$_tmp,"0");echo $_tmp;unset($_tmp); ?>%"></div>
						</div>
					</li>
					<li>
					投资完成：<span >&nbsp;<? if (!isset($this->magic_vars['var']['scale'])) $this->magic_vars['var']['scale'] = ''; echo $this->magic_vars['var']['scale']; ?>% （<? if (!isset($this->magic_vars['var']['account_yes'])) $this->magic_vars['var']['account_yes'] = ''; echo $this->magic_vars['var']['account_yes']; ?>元）</span></li>
					<li>
					<div class="rate_bg ">
							<div class="rate_tiao" style="width:<? if (!isset($this->magic_vars['var']['vouch_scale'])) $this->magic_vars['var']['vouch_scale'] = '';$_tmp = $this->magic_vars['var']['vouch_scale'];$_tmp = $this->magic_modifier("default",$_tmp,"0");echo $_tmp;unset($_tmp); ?>%"></div>
						</div></li>
					<li>担保完成：<span >&nbsp;<? if (!isset($this->magic_vars['var']['vouch_scale'])) $this->magic_vars['var']['vouch_scale'] = ''; echo $this->magic_vars['var']['vouch_scale']; ?>% （<? if (!isset($this->magic_vars['var']['vouch_account'])) $this->magic_vars['var']['vouch_account'] = ''; echo $this->magic_vars['var']['vouch_account']; ?>元）</span></li></li>
				</ul></td>
				<? else: ?>
			   <td ><ul class="li">
					<li >
						<div class="rate_bg ">
							<div class="rate_tiao" style=" width:<? if (!isset($this->magic_vars['var']['scale'])) $this->magic_vars['var']['scale'] = '';$_tmp = $this->magic_vars['var']['scale'];$_tmp = $this->magic_modifier("default",$_tmp,"0");echo $_tmp;unset($_tmp); ?>%"></div>
						</div>
					</li>
					<li>
					已经完成：
						
						<span >&nbsp;<? if (!isset($this->magic_vars['var']['scale'])) $this->magic_vars['var']['scale'] = ''; echo $this->magic_vars['var']['scale']; ?>%</span></li>
					<li>已完成投标：<? if (!isset($this->magic_vars['var']['account_yes'])) $this->magic_vars['var']['account_yes'] = ''; echo $this->magic_vars['var']['account_yes']; ?></li>
					<li>投标的状态：<? if (!isset($this->magic_vars['var']['status'])) $this->magic_vars['var']['status']=''; ;if (  $this->magic_vars['var']['status']==3): ?>成功招标<? if (!isset($this->magic_vars['var']['scale'])) $this->magic_vars['var']['scale']=''; ;elseif (  $this->magic_vars['var']['scale']==100): ?>满标审核中<? else: ?>正在招标中<? endif; ?></li>
				</ul></td>
				<? endif; ?>
				
			   <td  ><ul class="li">
					<li class="cu"><img src="<? if (!isset($this->magic_vars['_G']['system']['con_credit_picurl'])) $this->magic_vars['_G']['system']['con_credit_picurl'] = ''; echo $this->magic_vars['_G']['system']['con_credit_picurl']; ?><? if (!isset($this->magic_vars['var']['credit_pic'])) $this->magic_vars['var']['credit_pic'] = ''; echo $this->magic_vars['var']['credit_pic']; ?>" title="<? if (!isset($this->magic_vars['var']['credit_jifen'])) $this->magic_vars['var']['credit_jifen'] = ''; echo $this->magic_vars['var']['credit_jifen']; ?>分"  /></li>
					<li>招标期限：<? if (!isset($this->magic_vars['var']['time_limit'])) $this->magic_vars['var']['time_limit'] = ''; echo $this->magic_vars['var']['time_limit']; ?>个月</li>
					<li>所 在 地：<? if (!isset($this->magic_vars['var']['user_area'])) $this->magic_vars['var']['user_area'] = '';$_tmp = $this->magic_vars['var']['user_area'];$_tmp = $this->magic_modifier("area",$_tmp,"p,c");echo $_tmp;unset($_tmp); ?></li>
					<li>信用积分：<? if (!isset($this->magic_vars['var']['credit_jifen'])) $this->magic_vars['var']['credit_jifen'] = ''; echo $this->magic_vars['var']['credit_jifen']; ?>分</li>
				</ul></td>
			   <td  valign="top">
			   <? if (!isset($this->magic_vars['var']['status'])) $this->magic_vars['var']['status']=''; ;if (  $this->magic_vars['var']['status']==3): ?>
					<? if (!isset($this->magic_vars['var']['repayment_account'])) $this->magic_vars['var']['repayment_account']='';if (!isset($this->magic_vars['var']['repayment_yesaccount'])) $this->magic_vars['var']['repayment_yesaccount']=''; ;if (  $this->magic_vars['var']['repayment_account'] ==  $this->magic_vars['var']['repayment_yesaccount']): ?>
					<img src="<? if (!isset($this->magic_vars['tempdir'])) $this->magic_vars['tempdir'] = ''; echo $this->magic_vars['tempdir']; ?>/images/tender_achieve.jpg" />
					<? else: ?>
					<img src="<? if (!isset($this->magic_vars['tempdir'])) $this->magic_vars['tempdir'] = ''; echo $this->magic_vars['tempdir']; ?>/images/loan_repayment.jpg" />
					<? endif; ?>
				<? if (!isset($this->magic_vars['var']['status'])) $this->magic_vars['var']['status']=''; ;elseif (  $this->magic_vars['var']['status']==5): ?>
				用户取消
				<? if (!isset($this->magic_vars['var']['status'])) $this->magic_vars['var']['status']=''; ;elseif (  $this->magic_vars['var']['status']==4): ?>
				<? if (!isset($this->magic_vars['var']['account'])) $this->magic_vars['var']['account']='';if (!isset($this->magic_vars['var']['account_yes'])) $this->magic_vars['var']['account_yes']=''; ;elseif (  $this->magic_vars['var']['account']> $this->magic_vars['var']['account_yes']): ?>
				<a href="/invest/a<? if (!isset($this->magic_vars['var']['id'])) $this->magic_vars['var']['id'] = ''; echo $this->magic_vars['var']['id']; ?>.html?detail=true">
				<img src="<? if (!isset($this->magic_vars['tempdir'])) $this->magic_vars['tempdir'] = ''; echo $this->magic_vars['tempdir']; ?>/images/tender.gif" /></a>
				<? else: ?>
				<img src="<? if (!isset($this->magic_vars['tempdir'])) $this->magic_vars['tempdir'] = ''; echo $this->magic_vars['tempdir']; ?>/images/tender_wait.jpg" />
				<? endif; ?></a>
</td>
			</tr>
			<? endforeach; endif; unset($_from); ?>
		</table> 
		
	</div>
	<!--分页开始-->
				<div>
					<table align="center" class="list_table_page">
						<tr align="center">
							<td height="25" ><Div align="center" ><? if (!isset($this->magic_vars['loop']['showpage'])) $this->magic_vars['loop']['showpage'] = ''; echo $this->magic_vars['loop']['showpage']; ?></Div></td>
						</tr>
					</table>
				</div>
				<!--分页结束-->
	

</div>
<? endif; ?>