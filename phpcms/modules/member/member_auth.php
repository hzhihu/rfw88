<?php
/**
 * 会员实名认证
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin', 'admin', 0);

class member_auth extends admin {

    private $admin_member_auth;

    function __construct() {
        parent::__construct();
        $this->admin_member_auth = pc_base::load_model('admin_member_auth');
    }
    
    /**
     * 实名认证管理
     */
    function manage()
    {
        $data['epage'] = pc_base::load_config('default_config','default_page');
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        if (isset($_GET['real_status'])){
            if ($_GET['real_status']==1){
                $data['real_status'] = "1";
            }else{
                $data['real_status'] = "2";
            }
        }else{
            $data['real_status'] = "1,2";
        }
        if (isset($_GET['username'])){
            $data['username'] = $_REQUEST['username'];
        }
        $data['page'] = $page;
        $result = $this->admin_member_auth->getList($data);
        
        include $this->admin_tpl('member_auth_list');
        
        
    }
    
    /**
     * 用户相关的认证信息
     */
    function all()
    {

        $_A['list_title'] = "用户相关的认证信息";
        
        $data['page'] = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $data['epage'] = pc_base::load_config('default_config','default_page');
        if (isset($_REQUEST['username'])){
            $data['username'] = $_REQUEST['username'];
        }
        if (isset($_REQUEST['realname'])){
            $data['realname'] = $_REQUEST['realname'];
        }
        if (isset($_REQUEST['type'])){
            if ($_REQUEST['type']=="phone"){
                $data['phone_status'] = 1;
            }elseif ($_REQUEST['type']=="video"){
                $data['video_status'] = 1;
            }elseif ($_REQUEST['type']=="email"){
                $data['email_status'] = 1;
            }elseif ($_REQUEST['type']=="scene"){
                $data['scene_status'] = 1;
            }elseif ($_REQUEST['type']=="realname"){
                $data['real_status'] = 1;
            }
        }
        $result = $this->admin_member_auth->getList($data);
        debug($result);
    }
    
    
    /**
     * 查看所有的信息
     */
    function viewall()
    {

        $_A['list_title'] = "查看所有的信息";
        
        if (isset($_REQUEST['username']) && $_REQUEST['username']!=""){
            $data['username'] = $_REQUEST['username'];
        }
        if (isset($_REQUEST['realname']) && $_REQUEST['realname']!=""){
            $data['realname'] = $_REQUEST['realname'];
        }
        if (isset($_REQUEST['keywords']) && $_REQUEST['keywords']!=""){
            $data['username'] = $_REQUEST['keywords'];
        }
        $data['page'] = isset($_GET['page']) ? intval($_GET['page']) : 1;;
        $data['epage'] = pc_base::load_config('default_config','default_page');
        $result = $this->admin_member_auth->getList($data);
        
        debug($result);
        
    }
    
    
    
}