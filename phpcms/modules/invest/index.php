<?php
defined('IN_PHPCMS') or exit('No permission resources.');
class index
{
    function __construct ()
    {
        pc_base::load_app_func('global');
        $siteid = isset($_GET ['siteid']) ? intval($_GET ['siteid']) : get_siteid();
        define("SITEID", $siteid);
    }
    
    public function init()
    {
        $top_parentid=$catid=23;
        $siteid=SITEID;
        $CATEGORYS = getcache('category_content_'.$siteid,'commons');
        if(!isset($CATEGORYS[$catid])) showmessage(L('category_not_exists'),'blank');
        $CAT = $CATEGORYS[$catid];
        $siteid = $GLOBALS['siteid'] = $CAT['siteid'];
        extract($CAT);
        
        $assign=array('tpldir'=>'statics');
        $module='invest';
        $dir=rfwTplPath($module);
        $otherConfig['dir']=$dir;
        $template='init.tpl';
        $content=rfwFastTpl($template, $assign, $otherConfig);
        $memberinfo=$this->memberinfo;
        include template('invest', 'init');
    }
}