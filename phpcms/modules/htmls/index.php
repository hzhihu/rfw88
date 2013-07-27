<?php
/**
 * 常用HTML
 */
defined('IN_PHPCMS') or exit('No permission resources.');
class index{
    function __construct() {
        $this->db = pc_base::load_model('content_model');
        $this->_userid = param::get_cookie('_userid');
        $this->_username = param::get_cookie('_username');
        $this->_groupid = param::get_cookie('_groupid');
    }
    
    /**
     * 民 族
     */
    public function linkage_nation()
    {
        $_REQUEST['nid']='nation';
        $_REQUEST['name']='nation';
        pc_base::load_sys_func('linkage');
    }
    
    /**
     * 证件类别
     */
    public function linkage_card_type()
    {
        $_REQUEST['nid']='card_type';
        $_REQUEST['name']='card_type';
        $_REQUEST['isid']='false';
        $_REQUEST['value']='1';
        pc_base::load_sys_func('linkage');
    }
    
    /**
     * 籍贯
     */
    public function area()
    {
        pc_base::load_sys_func('area');
    }
}