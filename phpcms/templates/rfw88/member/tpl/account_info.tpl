<div class="user_main_title" style="height:30px; padding-top:7px;"> 
		发布时间：<input type="text" name="dotime1" id="dotime1" value="{$magic.request.dotime1|default:"$day7"|date_format:"Y-m-d"}" size="15" onclick="change_picktime()"/> 到 <input type="text"  name="dotime2" value="{$magic.request.dotime2|default:"$nowtime"|date_format:"Y-m-d"}" id="dotime2" size="15" onclick="change_picktime()"/>   
		<input value="搜索" type="submit" onclick="sousuo('{$_U.query_url}/publish')" />
		</div>	
		{article module="borrow" function="GetUserLog" user_id="0"}
				<div style="line-height:30px; font-size:15px; font-weight:bold">个人资金详情</div>
				<div class="user_right_border">
					<div class="linvest">账户总额：<strong>￥{$var.total|default:0}</strong></div>
					
					<div class="linvest">可用余额：<font color="#FF0000">￥{$var.use_money|default:0}</font></div>
					
					<div class="linvest">冻结金额：￥{$var.no_use_money|default:0}</div>
					
				</div><div class="user_right_border">
					<div class="linvest">投标冻结总额：￥{$var.tender|default:0}</div>
					<div class="linvest">充值成功总额：￥{$var.recharge_success|default:0}</div>
					<div class="linvest">提现成功总额：￥{$var.cash_success.money|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">在线充值总额：￥{$var.recharge_online|default:0}</div>
					<div class="linvest">线下充值总额：￥{$var.recharge_downline|default:0}</div>
					<div class="linvest">手动充值总额：￥{$var.recharge_shoudong|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">总手续费：￥{$var.fee+$var.recharge_fee|default:0}</div>
					<div class="linvest">充值手续费：￥{$var.fee|default:0}</div>
					<div class="linvest">提现手续费：￥{$var.recharge_fee|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">最高额度：￥{$var.amount|default:0}</div>
					<div class="linvest">最低额度：￥500</div>
					<div class="linvest">可用额度：￥{$var.use_amount|default:0}</div>
				</div>
				<div style="line-height:30px; font-size:15px; font-weight:bold">投资资金详情</div>
			
				<div class="user_right_border">
					<div class="linvest">投标总额：￥{$var.invest_account|round:"2"|default:0}</div>
					<div class="linvest">借出总额：￥{$var.success_account|round:"2"|default:0}</div>
					<div class="linvest">奖励收入总额：￥{$var.award_add|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">待回收总额：￥{$var.collection_wait|default:0}</div>
					<div class="linvest">待回收金额：￥{$var.collection_capital0|default:0}</div>
					<div class="linvest">待回收利息：￥{$var.collection_interest0|round:"2"|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">已回收总额：￥{$var.collection_yes|default:0}</div>
					<div class="linvest">已回收金额：￥{$var.collection_capital1|default:0}</div>
					<div class="linvest">已回收利息：￥{$var.collection_interest1|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">网站垫付总额：￥{$var.num_late_repay_account|default:0}</div>
					<div class="linvest">逾期罚金收入：￥{$var.late_collection|default:0}</div>
					<div class="linvest">损失利息总额：￥{$var.num_late_interes|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">最近收款日期：{$var.collection_repaytime|date_format:"Y-m-d"|default:-}</div>
				</div>
				<div style="line-height:30px; font-size:15px; font-weight:bold">贷款资金详情</div>
			

				<div class="user_right_border">
					<div class="linvest">借款总额：￥{$var.borrow_num|default:0}</div>
					<div class="linvest">已还总额：￥{$var.borrow_num1|default:0}</div>
					<div class="linvest">未还总额：￥{$var.wait_payment|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">发标次数：{$var.borrow_times|default:0}</div>
					<div class="linvest">还款标数：{$var.payment_times|default:0}</div>
					<div class="linvest">待还笔数：{$var.borrow_repay0|default:0}</div>
				</div>
				<div class="user_right_border">
					<div class="linvest">最近还款日期：{$var.new_repay_time|date_format:"Y-m-d"}</div>
					<div class="linvest">最近应还款金额：￥{$var.new_repay_account|default:0}</div>
				</div>
				{/article}
				<!--
			<table  border="0"  cellspacing="1" class="user_list_table">
				<tr class="head">
					{loop module="account" function="GetLogGroup" var="var" user_id=0 }
					<td>{ $var.name}</td>
					{/loop}
				</tr>
				
				<tr >
					{loop module="account" function="GetLogGroup" var="var" user_id=0  }
					<td>￥{ $var.num}</td>
					{/loop}
				</tr>
		</table>
		-->
		<table  border="0"  cellspacing="1" class="user_list_table" width="300">
		<tr class="head"  width="300">
		<td>日期</td>
		<td>成功借款+</td>
		<td>借款手续费-</td>
		<td>借款保证金-</td>
		<td>借款奖励-</td>
		<td>投标-</td>
		<td>待收总额+</td>
		<td>投标奖励+</td>
		<td>还款-</td>
		<td>充值+</td>
		<td>提现-</td>
		</tr>
			{loop module="account" function="GetLogCount" var="var" user_id=0 dotime1="$magic.request.dotime1"  dotime2="$magic.request.dotime2" }
				<tr  {if $var.i%2==1} class="tr1"{/if}>
				
					<td>{ $key}</td>
					<td {if $var.borrow_success!=""} style="color:#FF0000"{/if}>￥{ $var.borrow_success|default:0}</td>
					<td {if $var.borrow_fee!=""} style="color:#FF0000"{/if}>￥{ $var.borrow_fee|default:0}</td>
					<td  {if $var.margin!=""} style="color:#FF0000"{/if}>￥{ $var.margin|default:0}</td>
					<td  {if $var.award_lower!=""} style="color:#FF0000"{/if}>￥{ $var.award_lower|default:0}</td>
					<td {if $var.tender!=""} style="color:#FF0000"{/if}>￥{ $var.tender|default:0}</td>
					<td {if $var.collection!=""} style="color:#FF0000"{/if}>￥{ $var.collection|default:0}</td>
					<td {if $var.award_add!=""} style="color:#FF0000"{/if}>￥{ $var.award_add|default:0}</td>
					<td {if $var.invest_repayment!=""} style="color:#FF0000"{/if}>￥{ $var.invest_repayment|default:0}</td>
					<td {if $var.recharge!=""} style="color:#FF0000"{/if}>￥{ $var.recharge|default:0}</td>
					<td {if $var.recharge_success!=""} style="color:#FF0000"{/if}>￥{ $var.recharge_success|default:0}</td>
					
				</tr>
				{/loop}
				
		</table>