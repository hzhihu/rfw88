<?php
/**
 * 管理员后台会员模型分类字段操作类
*/

defined('IN_PHPCMS') or exit('No permission resources.');
//模型原型存储路径
pc_base::load_app_class('admin', 'admin', 0);


class member_type extends admin {

    function __construct() {
		parent::__construct();
		$this->db = pc_base::load_model('member_type_model');
		
    }
    
    
    /**
     * 模型分类首页
     */
    public function init()
    {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $member_group_list = $this->db->listinfo('', 'sort ASC', $page, 15);
        $pages = $this->db->pages;
        
        $big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?m=member&c=member_type&a=add\', title:\''.L('MEMBER_TYPE_ADD').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);', L('MEMBER_TYPE_ADD'));
        
        include $this->admin_tpl('member_type_init');
    }
    
    /**
     * 模型分类新增
     */
    public function add()
    {
        if(isset($_POST['dosubmit'])) {
            $info = array();
            if(!$this->_checkname($_POST['info']['name'])){
                showmessage(L('TYPE_NAME_ALREADY_EXIST'));
            }
            $info = $_POST['info'];
            
            $this->db->insert($info);
            if($this->db->insert_id()){
                $this->_updatecache();
                showmessage(L('operation_success'),'?m=member&c=member_type', '', 'add');
            }
        }else{
            include $this->admin_tpl('member_type_add');
        }
    }
    
    /**
     * 模型分类修改
     */
    public function edit()
    {
        if(isset($_POST['dosubmit'])) {
            $info = array();
            $info = $_POST['info'];
            $info['id']=intval($info['id']);
            
            $this->db->update($info, array('id'=>$info['id']));
            	
            $this->_updatecache();
            showmessage(L('operation_success'), '?m=member&c=member_type', '', 'edit');
        }else{
            
            $show_header = $show_scroll = true;
            $typeid = isset($_GET['id']) ? $_GET['id'] : showmessage(L('illegal_parameters'), HTTP_REFERER);
            	
            $info = $this->db->get_one(array('id'=>$typeid));
            include $this->admin_tpl('member_type_edit');
        }
    }
    
    /**
     * 排序会员组
     */
    function sort() {
        if(isset($_POST['sort'])) {
            foreach($_POST['sort'] as $k=>$v) {
                $this->db->update(array('sort'=>$v), array('id'=>$k));
            }
            	
            $this->_updatecache();
            showmessage(L('operation_success'), HTTP_REFERER);
        } else {
            showmessage(L('operation_failure'), HTTP_REFERER);
        }
    }
    
    /**
     * 模型分类删除 
     */
    public function delete()
    {
        $groupidarr = isset($_POST['id']) ? $_POST['id'] : showmessage(L('illegal_parameters'), HTTP_REFERER);
        $where = to_sqls($groupidarr, '', 'id');
        if ($this->db->delete($where)) {
            $this->_updatecache();
            showmessage(L('operation_success'), HTTP_REFERER);
        } else {
            showmessage(L('operation_failure'), HTTP_REFERER);
        }
    }
    
    /**
     * 检查用户名是否合法
     * @param string $name
     */
    private function _checkname($name = NULL) {
        if(empty($name)) return false;
        if ($this->db->get_one(array('name'=>$name),'id')){
            return false;
        }
        return true;
    }
    
    /**
     * 更新会员组列表缓存
     */
    private function _updatecache() {
        $typelist = $this->db->listinfo('', '', 1, 1000, 'id');
        setcache('membertype', $typelist);
    }
    
    public function public_checkname_ajax() {
        $name = isset($_GET['name']) && trim($_GET['name']) ? trim($_GET['name']) : exit(0);
        $name = iconv('utf-8', CHARSET, $name);
        
        $oldid=isset($_GET['oldid'])?intval($_GET['oldid']):0;
    
        $info=$this->db->checkeditName($name,$oldid);
        if ($info){
            exit('0');
        } else {
            exit('1');
        }
    }
    
}