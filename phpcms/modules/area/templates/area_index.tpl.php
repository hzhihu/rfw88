<?php 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1; 
include $this->admin_tpl('header', 'admin');
?>
<link href="/statics/css/admin_rfw.css" rel="stylesheet" type="text/css" />
<?php echo  rfwFastTpl('',array('_A'=>$_A),array('autoLoadNowDir'=>__FILE__));?>


