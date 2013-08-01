<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('member', 'header'); ?>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidator.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo JS_PATH;?>formvalidatorregex.js" charset="UTF-8"></script>
<div id="memberArea">
<?php include template('member', 'fund_center_left'); ?>
<div class="col-auto">
	<div class="bk10"></div>	
	<div class="col-1 ">
		<h5 class="title">账户详情：</h5>
		<div class="content">
		<?php echo $content;?>
		</div>
	</div>
</div>
</div>
</div>
<div class="clear"></div>
<?php include template('member', 'footer'); ?>