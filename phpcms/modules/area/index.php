<?php 
/**
 * 地区模块
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_sys_class('form', '', 0);

class index extends admin{
    
    const ERROR = '操作有误，请不要乱操作';
    
    function __construct() {
        $this->db = pc_base::load_model('area_model');
        
    }
    
    
    
    public function init()
    {
        $pages=pc_base::load_sys_class('pages');
        $_A=get_query_url('area','index','',array());
        $_A['list_title'] = "省份";
        $data['page'] =isset($_GET['page'])?intval($_GET['page']): 1;
        $data['pid'] = isset($_GET['pid'])?intval($_GET['pid']):"0";
        if (isset($_REQUEST['action'])  ){
            if ($_REQUEST['action'] =="city"){
                $_A['list_title'] = "城市";
                $data['pid'] = $_REQUEST['pid'];
            }elseif ($_REQUEST['action'] =="area"){
                $_A['list_title'] = "地区";
                $data['pid'] = $_REQUEST['pid'];
            }
            
        }
        $result = $this->db->GetList($data);
        if (is_array($result)){
            $pages->set_data($result);
            $_A['area_list'] = $result['list'];
            $_A['showpage'] = $pages->show(4);
        }else{
            $msg = array($result);
        }
        
        if (isset($_POST['name']) && $_POST['name']!=""){
            $var = array("name","pid","nid","order");
            $data = post_var($var);
            if ($_A['query_type'] == "edit"){
                $data['id'] = $_POST['id'];
                $result = $this->db->updates($data);
            }else{
                $result = $this->db->adds($data);
            }
            
            if ($result !== true){
                $msg = array($result);
            }else{
                $msg = "操作成功";
                showmessage($msg);
            }
        }else{
            if ($_A['query_type'] == "edit"){
                $data['id'] = $_REQUEST['id'];
                $_A['area_result'] =  $this->db->GetOne($data);
            }
        }
        include $this->admin_tpl('area_index');
    }
    
}