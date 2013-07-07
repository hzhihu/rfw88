<?php
/**
 * 模型分类表 _member_type
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class member_type_model extends model {
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'member_type';
		parent::__construct();
	}
	
	public function checkeditName($name,$id='0')
	{
	    if(!empty($id))
	    {
	        $sql="select id from {$this->table_name} where id<>{$id} and name = '{$name}'";
	    }else{
	        $sql="select id from {$this->table_name} where  name = '{$name}'";
	    }
	    $count=$this->db->num_rows($sql);
	    return $count;
	}
	
}
?>