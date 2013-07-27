<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>	<div class="col-left col-1 left-memu">
        	<h5 class="title">认证中心</h5>
            <ul>
                <li<?php if(ROUTE_A=="really") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=auth_center&a=really&t=6"><img src="<?php echo IMG_PATH;?>icon/vcard.png" width="16" /> 实名认证</a></li>
                 <li<?php if(ROUTE_A=="email") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=auth_center&a=email&t=6"><img src="<?php echo IMG_PATH;?>icon/vcard.png" width="16" /> 邮箱认证</a></li>
                 <li<?php if(ROUTE_A=="mobil") { ?> class="on"<?php } ?>><a href="index.php?m=member&c=auth_center&a=mobile&t=6"><img src="<?php echo IMG_PATH;?>icon/vcard.png" width="16" /> 手机认证</a></li>

            </ul>
        <span class="o1"></span><span class="o2"></span><span class="o3"></span><span class="o4"></span>
    </div>