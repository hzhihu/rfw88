<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('content', 'header'); ?>
<!--main-->
<div class="main">
	<div class="col-left">
    	<div class="crumbs"><a href="<?php echo APP_PATH;?>">首页</a><span> > </span>公告</div>
        <div id="Article">
        	<h1><?php echo $title;?><br />
<span></span></h1>
			<div class="content">
			  <?php echo $content;?>
			</div>
      </div>
  </div>
    <div class="col-auto">
        <div class="box pd_b0">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"comment\" data=\"op=comment&tag_md5=f96eff7c12a07eee88c5cd43c712bf7e&action=bang&cache=3600\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$tag_cache_name = md5(implode('&',array()).'f96eff7c12a07eee88c5cd43c712bf7e');if(!$data = tpl_cache($tag_cache_name,3600)){$comment_tag = pc_base::load_app_class("comment_tag", "comment");if (method_exists($comment_tag, 'bang')) {$data = $comment_tag->bang(array('limit'=>'20',));}if(!empty($data)){setcache($tag_cache_name, $data, 'tpl_data');}}?>
            <ul class="itemli">
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li><a href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 26);?></a></li>
            <?php $n++;}unset($n); ?>
            </ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        </div>
    </div>
</div>
<?php include template('content', 'footer'); ?>