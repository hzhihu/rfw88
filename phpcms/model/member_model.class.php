<?php
defined('IN_PHPCMS') or exit('No permission resources.');
if(!defined('CACHE_MODEL_PATH')) define('CACHE_MODEL_PATH',PHPCMS_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);

pc_base::load_sys_class('model', '', 0);
class member_model extends model {
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'member';
		parent::__construct();
	}

	/**
	 * 重置模型操作表表
	 * @param string $modelid 模型id
	 */
	public function set_model($modelid = '') {
		if($modelid) {
			$model = getcache('member_model', 'commons');
			$this->table_name = $this->db_tablepre.$model[$modelid]['tablename'];
		} else {
			$this->table_name = $this->db_tablepre.'member';
		}
	}
	
	
	/**
	 * 检查身份证
	 *
	 * @param array $data
	 * @return array
	 */
	function CheckIdcard($data = array()){
	    global $mysql;
	    $card_id  = $data['card_id'];
	    $_sql = "card_id  = '{$card_id}'";
	    if (isset($data['user_id']) && $data['user_id']!=""){
	        $_sql .= " and userid!= {$data['user_id']}";
	    }
	    $result = $this->get_one($_sql);
	    if ($result == false) return false;
	    return true;
	}
	
	
	/**
	 * 修改用户的各种信息
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function UpdateUserAll($data = array()){
	    if(!isset($data['user_id']) || empty($data['user_id']))
	    {
	        return false;
	    }
	    $user_id = $data['user_id'];
	    unset($data['user_id']);
	    if ($user_id == "" )	return false;
	    $where .= " `userid` = {$user_id}";
	    return $this->update($data,$where);
	}


}
?>