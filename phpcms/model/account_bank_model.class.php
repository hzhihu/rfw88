<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class account_bank_model extends model
{
    public function __construct ()
    {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'account_bank';
        parent::__construct();
    }
    
    public function ActionAccount($data=array()){
        $mysql=$this;
    
        if (isset($data['user_id'])){
            $user_id = $data['user_id'];
    
            unset($data['user_id']);
            $sql = "select * from {account} where user_id=$user_id";
            $result = $mysql->db_fetch_array($sql);
            if ($result == false){
                $sql = "insert into `{account}` set `user_id` = '$user_id'";
                foreach($data as $key => $value){
                    $sql .= ",`$key` = '$value'";
                }
            }else{
                $sql = "update `{account}` set `user_id` = '$user_id'";
                foreach($data as $key => $value){
                    $sql .= ",`$key` = '$value'";
                }
                $sql .= " where user_id=$user_id";
            }
            return $mysql->db_query($sql);
        }else{
            return false;
        }
    
    }
    
    /**
     * 查看银行信息
     *
     * @param Array $data
     * @return Array
     */
    public  function GetBankOne($data = array()){
        $mysql=$this;
        $user_id = $data['user_id'];
        $sql = "select p1.username,p1.email,p1.realname,'' as paypassword,p2.*,p3.* from {member} as p1
        left join {account_bank} as p2 on p1.userid=p2.user_id
        left join {account} as p3 on p3.user_id=p1.userid
        where p1.userid=$user_id
        ";
        return $mysql->db_fetch_array($sql);
    }
    
    
    /**
     * 添加或修改银行账号
     *
     * @param Array $data
     * @return Boolen
     */
    public function ActionBank($data = array()){
        $mysql=$this;
        $user_id = isset($data['user_id'])?$data['user_id']:"";
        if (empty($user_id)) return false;
         
        $sql = "select * from {account_bank} where user_id = $user_id";
        $result = $mysql->db_fetch_array($sql);
        if ($result == false){
            $sql = "insert into `{account_bank}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
            foreach($data as $key => $value){
                $sql .= ",`$key` = '$value'";
            }
        }else{
            $sql = "update `{account_bank}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
            foreach($data as $key => $value){
                $sql .= ",`$key` = '$value'";
            }
            $sql .= " where user_id=$user_id";
        }
        return $mysql->db_query($sql);
    }
}