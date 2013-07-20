<?php
/**
 * 地区表 area
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class area_model extends model
{
    public function __construct ()
    {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'area';
        parent::__construct();
    }
    
    /**
     * 获得列表
     *
     * @return Array
     */
    function GetList ($data = array())
    {
        $mysql = $this->db;
        
        $pid = isset($data ['pid']) ? $data ['pid'] : "";
        $page = empty($data ['page']) ? 1 : $data ['page'];
        $epage = empty($data ['epage']) ? pc_base::load_config('default_config','default_page') : $data ['epage'];
        
        $_sql = " where 1=1 ";
        
        if (isset($data ['name']) && $data ['name'] != "") {
            $_sql .= " and `name` like '%{$data['name']}%'";
        }
        if (isset($data ['pid']) && $data ['pid'] !== "") {
            $_sql .= " and `pid` = '{$data['pid']}'";
        }
        $sql = "select SELECT from {$this->getTable('area')}
	    {$_sql}   ORDER LIMIT";
        
        // 是否显示全部的信息
        if (isset($data ['limit'])) {
            $_limit = "";
            if ($data ['limit'] != "all") {
                $_limit = "  limit " . $data ['limit'];
            }
            $sql = str_replace(array (
                    'SELECT', 
                    'ORDER', 
                    'LIMIT' 
            ), array (
                    '*', 
                    ' order by `id` asc', 
                    $_limit 
            ), $sql);
            return $mysql->db_fetch_arrays();
        }
        
        $row = $mysql->db_fetch_array(str_replace(array (
                'SELECT', 
                'ORDER', 
                'LIMIT' 
        ), array (
                'count(1) as num', 
                '', 
                '' 
        ), $sql));
        
        $total = $row ['num'];
        $total_page = ceil($total / $epage);
        $index = $epage * ($page - 1);
        $limit = " limit {$index}, {$epage}";
        
        
        $list = $mysql->db_fetch_arrays(str_replace(array (
                'SELECT', 
                'ORDER', 
                'LIMIT' 
        ), array (
                ' * ', 
                'order by `order` desc,`id` desc', 
                $limit 
        ), $sql));
        $list = $list ? $list : array ();
        
        return array (
                'list' => $list, 
                'total' => $total, 
                'page' => $page, 
                'epage' => $epage, 
                'total_page' => $total_page 
        );
    }
    
    /**
     * 查看用户
     *
     * @param Array $data
     * @return Array
     */
    public  function GetOne($data = array()){
        $mysql= $this->db;
        $id = $data['id'];
        if($id == "") return self::ERROR;
        $id = $data['id'];
        $sql = "select * from {$this->getTable('area')} where id=$id";
        return $mysql->db_fetch_array($sql);
    }
    
    
    /**
     * 添加
     *
     * @param Array $data
     * @return Boolen
     */
    function adds($data = array()){
        $mysql= $this->db;
        if ($data['name'] == "" ) {
            return self::ERROR;
        }
    
        $_sql = "";
        $sql = "insert into `{$this->getTable('area')}` set ";
        foreach($data as $key => $value){
            $_sql[] = "`$key` = '$value'";
        }
        $mysql->db_query($sql.join(",",$_sql));
        $id = $mysql->db_insert_id();
        return true;
    }
    
    
    /**
     * 添加
     *
     * @param Array $data
     * @return Boolen
     */
    function updates($data = array()){
        $mysql= $this->db;
        if ($data['name'] == ""  || $data['id'] == "") {
            return self::ERROR;
        }
        $id = $data['id'];
    
        $sql = "update `{$this->getTable('area')}` set ";
        $_sql = "";
        foreach($data as $key => $value){
            $_sql[] .= "`$key` = '$value'";
        }
        $sql .= join(",",$_sql)." where id = '$id'";
        $mysql->db_query($sql);
        return true;
    
    }
    
    
    

}
?>