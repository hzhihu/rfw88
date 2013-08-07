<!--子栏目 开始-->
{literal}
<?
$this->magic_vars['_G']['uurl'] = url_format($this->magic_vars['_G']['nowurl'],"order");
$this->magic_vars['_G']['epurl'] = url_format($this->magic_vars['_G']['nowurl'],"epage");
?>
{/literal}
<!--子栏目 结束-->
{if $magic.request.type==late}

<div class="wrap950 invest">
	<div class="invest_order"> 
		<div class="floatl">
			<strong>逾期的借款人</strong>
		</div>
		<div class="floatr">
			显示： <a href="{$_G.epurl}&epage=20"><img src="{$tpldir}/images/ico_20.gif" align="absmiddle" /></a> 
			<a href="{$_G.epurl}&epage=40"><img src="{$tpldir}/images/ico_40.gif" align="absmiddle" /></a> 
			<a href="{$_G.epurl}&epage=60"><img src="{$tpldir}/images/ico_60.gif" align="absmiddle" /></a> &nbsp;&nbsp;
		</div>
	</div>
	<div class="invest_list">
		{list module="borrow" function="GetLateList" var="loop"  late_day="1"}
		<table  border="0"  cellspacing="0"  width="100%">
			<tr  class="title">
			  <td width="18%" class="tou">头像</td>
			  <td  >资料</td>
			  <td >联系方式</td>
			   <td >公开财务</td>
			</tr>
			{foreach from="$loop.list" item="var" }
			<tr  class="tr1">
			  <td align="center" >
			  	<div style="margin-left:20px;" >
					<a href="/u/{$var.user_id}" target="_blank" ><img src="{$var.user_id|avatar:"middle"|imgurl_format}" border="0" class="picborder"/></a>
				</div>
			  </td>
			  <td >
			  	<ul class="li">
					<li class="cu" style="height:30px; overflow:hidden"><a href="/u/{$var.user_id}" title="{$var.realname}">{$var.realname}</a></li>
					<li>性别：{if $var.sex==1 }男{else}女{/if}</li>
					<li>身份证号:{$var.card_id }</li>
					<li>所 在 地：{$var.area|area}</li>
				</ul>
			  </td>
			  <td ><ul class="li">
			  	<li class="cu"><font color="#FF0000">欠款总额：￥{$var.late_account}</font></li>
					<li >Email：{$var.email}</li>
					<li>电话：{$var.phone}</li>
					<li>QQ:{$var.qq}</li>
				</ul></td>
			   <td >
			   <ul class="li">
					<li class="cu"><font color="#FF0000">逾期笔数：{$var.late_num}笔</font></li>
					<li>网站代还笔数：{$var.late_webnum|default:0}</li>
					<li>最长逾期天数:{$var.late_numdays}天</li>
					<li >更新时间：{$_G.nowtime|date_format:"Y-m-d H:i:s"}</li>
				</ul></td>
			   
			</tr>
			{/foreach}
		</table> 
		
	</div>
	<!--分页开始-->
				<div>
					<table align="center" class="list_table_page">
						<tr align="center">
							<td height="25" ><Div align="center" >{$loop.showpage}</Div></td>
						</tr>
					</table>
				</div>
				<!--分页结束-->
	
{/list}
</div>



{else}
<!--投资搜索  开始-->
<div class="wrap950 list_1">
	<form action="" method="get">
	<div class="title"><img src="{$tpldir}/images/ico_4.gif" /> 详细搜索</div>
	<div class="content">
		<div class="bor">
			<div class="bo_t">关键字：</div>
			<div class="bo_c">
				<input type="text" name="keywords" size="20" value="{$magic.request.keywords|urldecode}" />
			</div>
			<div class="bo_t">还款方式：</div>
			<div class="bo_c">
				{linkages name="style" nid="borrow_style" value="$magic.request.style" default="没有限制"} 
			</div>
			<div class="bo_t">借款目的：</div>
			<div class="bo_c">
				{linkages name="use" nid="borrow_use" value="$magic.request.use" default="没有限制"}  
			</div>
		</div>
		
		<div class="bor">
			<div class="bo_t">金额范围：</div>
			<div class="bo_c">
				{linkages name="account1" nid="account_amange" type="value" value="$magic.request.account1" }  
				
				到 
				{linkages name="account2" nid="account_amange" type="value" value="$magic.request.account2" default="没有限制"}  
				
			</div>
			<div class="bo_t">期 限：</div>
			<div class="bo_c">
				
				{linkages name="limittime" nid="borrow_time_limit" type="value" value="$magic.request.limittime" default="没有限制"}  
				
			</div>
			<div class="bo_t">奖 励：</div>
			<div class="bo_c">
				<select name="award">
					<option value="">无限制</option>
					<option value="1" {if $magic.request.award=="1"} selected="selected"{/if}>只显示有奖励的</option>
					<option value="2" {if $magic.request.award=="2"} selected="selected"{/if}>只显示没奖励的</option>
				</select> 
			</div>
		</div>
		
		<div class="bor">
			<div class="bo_t">所在地区：</div>
			<div class="bo_c" style="width:230px;">
				<script src="index.php?q=area&type=p,c&area={$magic.request.city}"></script> 
			</div>
			
			<div class="bo_c">
				<input type="image" src="{$tpldir}/images/sousuo.gif"> <input type="hidden" name="type" value="{$magic.request.type}" />
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
		{if $var.is_vouch!=1}
			<span><img src="{$tpldir}/images/order.gif" align="absmiddle" /></span> 
			<span>
				{if $magic.request.order=='account_up'}<a href="{$_G.uurl}&order=account_down"><font color="#FF0000">金额↑</font></a>
				{elseif $magic.request.order=='account_down'}<a href="{$_G.uurl}&order=account_up"><font color="#FF0000">金额↓</font></a>
				{else}<a href="{$_G.uurl}&order=account_up">金额</a>{/if}
			</span> 
			<span>
				{if $magic.request.order=='apr_up'}<a href="{$_G.uurl}&order=apr_down"><font color="#FF0000">利率↑</font></a>
				{elseif $magic.request.order=='apr_down'}<a href="{$_G.uurl}&order=apr_up"><font color="#FF0000">利率↓</font></a>
				{else}<a href="{$_G.uurl}&order=apr_up">利率</a>{/if}
			</span> 
			<span>
				{if $magic.request.order=='jindu_up'}<a href="{$_G.uurl}&order=jindu_down"><font color="#FF0000">进度↑</font></a>
				{elseif $magic.request.order=='jindu_down'}<a href="{$_G.uurl}&order=jindu_up"><font color="#FF0000">进度↓</font></a>
				{else}<a href="{$_G.uurl}&order=jindu_up">进度</a>{/if}
			</span> 
			<span>
				{if $magic.request.order=='credit_up'}<a href="{$_G.uurl}&order=credit_down"><font color="#FF0000">信用↑</font></a>
				{elseif $magic.request.order=='credit_down'}<a href="{$_G.uurl}&order=credit_up"><font color="#FF0000">信用↓</font></a>
				{else}<a href="{$_G.uurl}&order=credit_up">信用</a>{/if}
			</span>  
			{/if}
		</div>
		<div class="floatr">
			显示： <a href="{$_G.epurl}&epage=20"><img src="{$tpldir}/images/ico_20.gif" align="absmiddle" /></a> 
			<a href="{$_G.epurl}&epage=40"><img src="{$tpldir}/images/ico_40.gif" align="absmiddle" /></a> 
			<a href="{$_G.epurl}&epage=60"><img src="{$tpldir}/images/ico_60.gif" align="absmiddle" /></a> &nbsp;&nbsp;
		</div>
	</div>
	<div class="invest_list">
		{list module="borrow" function="GetList" var="loop"  site_id="0"  keywords="request" type="request"  use="request" account1="request" account2 = "request" limittime="request" award="request" province="request" city="request" epage="request" order="$magic.request.order"  }
		<table  border="0"  cellspacing="0"  width="100%">
			<tr  class="title">
			  <td width="18%" class="tou">头像</td>
			  <td width="16%" >标题/借款者</td>
			  <td width="16%" >金额/利率/用途</td>
			   <td width="24%" >进度/状态</td>
			   <td width="16%" >期限/所在地/等级</td>
			   <td width="*" ></td>
			</tr>
			{foreach from="$loop.list" item="var" }
			<tr  class="tr1">
			  <td align="center" >
			  	<div style="margin-left:20px;" >
					<a href="a{$var.id}.html" ><img src="{$var.user_id|avatar:"middle"|imgurl_format}" border="0" class="picborder" width="100px" height="90px"/></a>
				</div>
			  </td>
			  <td >
			  	<ul class="li">
					<li class="cu" style="height:30px; overflow:hidden"><a href="a{$var.id}.html" title="{$var.name}">{$var.name}</a> </li>
					<li>贷款号：{$var.id}{if $var.is_vouch==1}<img src="{$tpldir}/images/danbao.gif" />{/if} {if $var.flag==1} <img src="{$tpldir}/images/tuijian.gif" align="absmiddle" />{elseif  $var.flag==2} <img src="{$tpldir}/images/danbao.gif" align="absmiddle"/>{elseif  $var.flag==3} <img src="{$tpldir}/images/diya.gif" align="absmiddle"/>{/if}</li>
					<li>发布者：<a href="/u/{$var.user_id}" target="_blank">{$var.username}</a></li>
					<li>客 &nbsp;服：{$var.kefu_username|default:"-"}</li>
				</ul>
			  </td>
			  <td ><ul class="li">
					<li class="cu"><font color="#FF0000">￥{$var.account} 元</font></li>
					<li>年利率：{$var.apr}%</li>
					<li>{$var.use|linkage}</li>
					<li>{$var.style|linkage:"borrow_style"}</li>
				</ul></td>
				
				{if $var.is_vouch==1}
				<td ><ul class="li">
					<li >
						<div class="rate_bg ">
							<div class="rate_tiao" style="width:{$var.scale|default:0}%"></div>
						</div>
					</li>
					<li>
					投资完成：<span >&nbsp;{$var.scale}% （{$var.account_yes}元）</span></li>
					<li>
					<div class="rate_bg ">
							<div class="rate_tiao" style="width:{$var.vouch_scale|default:0}%"></div>
						</div></li>
					<li>担保完成：<span >&nbsp;{$var.vouch_scale}% （{$var.vouch_account}元）</span></li></li>
				</ul></td>
				{else}
			   <td ><ul class="li">
					<li >
						<div class="rate_bg ">
							<div class="rate_tiao" style=" width:{$var.scale|default:0}%"></div>
						</div>
					</li>
					<li>
					已经完成：
						
						<span >&nbsp;{$var.scale}%</span></li>
					<li>已完成投标：{$var.account_yes}</li>
					<li>投标的状态：{if $var.status==3}成功招标{elseif $var.scale==100}满标审核中{else}正在招标中{/if}</li>
				</ul></td>
				{/if}
				
			   <td  ><ul class="li">
					<li class="cu"><img src="{$_G.system.con_credit_picurl}{ $var.credit_pic}" title="{$var.credit_jifen}分"  /></li>
					<li>招标期限：{$var.time_limit}个月</li>
					<li>所 在 地：{$var.user_area|area:"p,c"}</li>
					<li>信用积分：{$var.credit_jifen}分</li>
				</ul></td>
			   <td  valign="top">
			   {if $var.status==3}
					{if $var.repayment_account == $var.repayment_yesaccount  }
					<img src="{$tempdir}/images/tender_achieve.jpg" />
					{else}
					<img src="{$tempdir}/images/loan_repayment.jpg" />
					{/if}
				{elseif $var.status==5}
				用户取消
				{elseif $var.status==4}
				{elseif $var.account>$var.account_yes}
				<a href="/invest/a{$var.id}.html?detail=true">
				<img src="{$tempdir}/images/tender.gif" /></a>
				{else}
				<img src="{$tempdir}/images/tender_wait.jpg" />
				{/if}</a>
</td>
			</tr>
			{/foreach}
		</table> 
		
	</div>
	<!--分页开始-->
				<div>
					<table align="center" class="list_table_page">
						<tr align="center">
							<td height="25" ><Div align="center" >{$loop.showpage}</Div></td>
						</tr>
					</table>
				</div>
				<!--分页结束-->
	
{/list}
</div>
{/if}