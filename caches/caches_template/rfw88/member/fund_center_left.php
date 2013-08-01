<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>	<div class="col-left col-1 left-memu">
        	<h5 class="title">资金管理</h5>
            <ul>
                <li<?php if(ROUTE_A=="init") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=fund_manage&a=init&t=2"><img src="<?php echo IMG_PATH;?>icon/user_edit.png" width="16" /> 账户详情</a></li>
             <li<?php if(ROUTE_A=="bank") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=fund_manage&a=bank&t=2"><img src="<?php echo IMG_PATH;?>icon/user_edit.png" width="16" />银行账户</a></li>
               	<li<?php if(ROUTE_A=="pay" && ROUTE_C=="deposit") { ?> class="on"<?php } ?>><a href="index.php?m=pay&c=deposit&a=pay&t=2"><img src="<?php echo IMG_PATH;?>icon/m_4.png" width="15" height="16" /> <?php echo L('online_charge');?></a></li>
                <li<?php if(ROUTE_A!="pay" && ROUTE_C=="deposit") { ?> class="on"<?php } ?>><a href="index.php?m=pay&c=deposit&a=init&t=2"><img src="<?php echo IMG_PATH;?>icon/m_8.png" width="16" height="16" /> <?php echo L('pay_log');?></a></li>
                <li<?php if(ROUTE_A!="pay" && ROUTE_C=="spend_list") { ?> class="on"<?php } ?>><a href="index.php?m=pay&c=spend_list&a=init&t=2"><img src="<?php echo IMG_PATH;?>icon/table-information.png" width="16" height="16" /> <?php echo L('cost_log');?></a></li>
				<li<?php if(ROUTE_A=="change_credit") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=index&a=change_credit&t=2"><img src="<?php echo IMG_PATH;?>icon/coins_add.png" width="16" height="16" /> <?php echo L('credit_change');?></a></li>          
                
            </ul>
        <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
    </div>