<!--银行账号 开始-->
<div class="user_help">{$_G.system.con_webname}禁止信用卡套现、虚假交易等行为,一经发现将予以处罚,包括但不限于：限制收款、冻结账户、永久停止服务,并有可能影响相关信用记录。
</div>
		<div class="user_right_border">
			<div class="l">真实姓名：</div>
			<div class="c">
				{$_U.account_bank_result.realname}
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">账号：</div>
			<div class="c">
				{$_U.account_bank_result.email}
			</div>
		</div>
		
		{if $_U.account_bank_result.bank!=""}
		<div class="user_right_border">
			<div class="l">开户银行：</div>
			<div class="c">
				{$_U.account_bank_result.bank_name}
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">开户行名称：</div>
			<div class="c">
				{$_U.account_bank_result.branch}
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">银行账号：</div>
			<div class="c">
				{$_U.account_bank_result.account}
			</div>
		</div>
		{/if}
		<form action="" method="post">
		<div class="user_right_border">
			<div class="l">开户银行：</div>
			<div class="c">
				<script src="index.php?m=htmls&c=index&a=bank&value={$_U.account_bank_result.bank}"></script>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">开户行支行名称：</div>
			<div class="c">
				<input type="text" name="branch" value="{$_U.account_bank_result.branch}" />
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">银行账号：</div>
			<div class="c">
				<input type="text" name="account" value="{$_U.account_bank_result.account}" /><span>特别提醒：上述银行卡号的开户人姓名必须为“{$_U.account_bank_result.realname}”</span>
			</div>
			

		</div>
		
		<div class="user_right_border">
			<div class="l"></div>
			<div class="c">
				<input type="hidden" name="user_id" value="{$_G.user_id}" />
				<input type="submit" name="name"  value="确认提交" size="30" /> 
			</div>
		</div>
		</form>
		<div class="user_right_foot">
		* 温馨提示：禁止信用卡套现
		</div>
		<!--银行账号 结束-->
