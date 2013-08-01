<!--银行账号 开始-->
<div class="user_help"><? if (!isset($this->magic_vars['_G']['system']['con_webname'])) $this->magic_vars['_G']['system']['con_webname'] = ''; echo $this->magic_vars['_G']['system']['con_webname']; ?>禁止信用卡套现、虚假交易等行为,一经发现将予以处罚,包括但不限于：限制收款、冻结账户、永久停止服务,并有可能影响相关信用记录。
</div>
		<div class="user_right_border">
			<div class="l">真实姓名：</div>
			<div class="c">
				<? if (!isset($this->magic_vars['_U']['account_bank_result']['realname'])) $this->magic_vars['_U']['account_bank_result']['realname'] = ''; echo $this->magic_vars['_U']['account_bank_result']['realname']; ?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">账号：</div>
			<div class="c">
				<? if (!isset($this->magic_vars['_U']['account_bank_result']['email'])) $this->magic_vars['_U']['account_bank_result']['email'] = ''; echo $this->magic_vars['_U']['account_bank_result']['email']; ?>
			</div>
		</div>
		
		<? if (!isset($this->magic_vars['_U']['account_bank_result']['bank'])) $this->magic_vars['_U']['account_bank_result']['bank']=''; ;if (  $this->magic_vars['_U']['account_bank_result']['bank']!=""): ?>
		<div class="user_right_border">
			<div class="l">开户银行：</div>
			<div class="c">
				<? if (!isset($this->magic_vars['_U']['account_bank_result']['bank_name'])) $this->magic_vars['_U']['account_bank_result']['bank_name'] = ''; echo $this->magic_vars['_U']['account_bank_result']['bank_name']; ?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">开户行名称：</div>
			<div class="c">
				<? if (!isset($this->magic_vars['_U']['account_bank_result']['branch'])) $this->magic_vars['_U']['account_bank_result']['branch'] = ''; echo $this->magic_vars['_U']['account_bank_result']['branch']; ?>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">银行账号：</div>
			<div class="c">
				<? if (!isset($this->magic_vars['_U']['account_bank_result']['account'])) $this->magic_vars['_U']['account_bank_result']['account'] = ''; echo $this->magic_vars['_U']['account_bank_result']['account']; ?>
			</div>
		</div>
		<? endif; ?>
		<form action="" method="post">
		<div class="user_right_border">
			<div class="l">开户银行：</div>
			<div class="c">
				<script src="index.php?m=htmls&c=index&a=bank&value=<? if (!isset($this->magic_vars['_U']['account_bank_result']['bank'])) $this->magic_vars['_U']['account_bank_result']['bank'] = ''; echo $this->magic_vars['_U']['account_bank_result']['bank']; ?>"></script>
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">开户行支行名称：</div>
			<div class="c">
				<input type="text" name="branch" value="<? if (!isset($this->magic_vars['_U']['account_bank_result']['branch'])) $this->magic_vars['_U']['account_bank_result']['branch'] = ''; echo $this->magic_vars['_U']['account_bank_result']['branch']; ?>" />
			</div>
		</div>
		
		<div class="user_right_border">
			<div class="l">银行账号：</div>
			<div class="c">
				<input type="text" name="account" value="<? if (!isset($this->magic_vars['_U']['account_bank_result']['account'])) $this->magic_vars['_U']['account_bank_result']['account'] = ''; echo $this->magic_vars['_U']['account_bank_result']['account']; ?>" /><span>特别提醒：上述银行卡号的开户人姓名必须为“<? if (!isset($this->magic_vars['_U']['account_bank_result']['realname'])) $this->magic_vars['_U']['account_bank_result']['realname'] = ''; echo $this->magic_vars['_U']['account_bank_result']['realname']; ?>”</span>
			</div>
			

		</div>
		
		<div class="user_right_border">
			<div class="l"></div>
			<div class="c">
				<input type="hidden" name="user_id" value="<? if (!isset($this->magic_vars['_G']['user_id'])) $this->magic_vars['_G']['user_id'] = ''; echo $this->magic_vars['_G']['user_id']; ?>" />
				<input type="submit" name="name"  value="确认提交" size="30" /> 
			</div>
		</div>
		</form>
		<div class="user_right_foot">
		* 温馨提示：禁止信用卡套现
		</div>
		<!--银行账号 结束-->
