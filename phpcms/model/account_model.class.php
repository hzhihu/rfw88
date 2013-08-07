<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class account_model extends model
{
    public function __construct ()
    {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'account';
        parent::__construct();
    }
    
    /**
     * 列表
     *
     * @return Array
     */
    function GetList ($data = array())
    {
        $mysql = $this;
        $page = empty($data ['page']) ? 1 : $data ['page'];
        $epage = empty($data ['epage']) ? 10 : $data ['epage'];
        
        $_sql = "where 1=1 ";
        
        if (isset($data ['user_id']) && $data ['user_id'] != "") {
            $_sql .= " and p2.user_id = '{$data['user_id']}'";
        }
        
        if (isset($data ['username']) && $data ['username'] != "") {
            $_sql .= " and p2.username like '%{$data['username']}%'";
        }
        
        $sql = "select SELECT from {account} as p1
        left join {user} as p2 on p1.user_id=p2.user_id
        $_sql ORDER LIMIT";
        $_select = "p1.*,p2.username,p2.realname";
        // 是否显示全部的信息
        if (isset($data ['limit'])) {
            $_limit = "";
            if ($data ['limit'] != "all") {
                $_limit = "  limit " . $data ['limit'];
            }
            $list = $mysql->db_fetch_arrays(str_replace(array (
                    'SELECT', 
                    'ORDER', 
                    'LIMIT' 
            ), array (
                    $_select, 
                    'order by p1.id desc', 
                    $_limit 
            ), $sql));
            
            return $list;
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
                $_select, 
                'order by p1.id desc', 
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
     * 查看
     *
     * @param Array $data
     * @return Array
     */
    public static function GetOne($data = array()){
        $mysql=$this;
        $user_id = $data['user_id'];
        $sql = "select p2.username,p3.*,p1.* from `{account}` as p1
        left join {user} as p2 on p1.user_id=p2.user_id
        left join {account_bank} as p3 on p1.user_id=p3.user_id
        where p1.user_id=$user_id
        ";
        $result = $mysql->db_fetch_array($sql);
        if ($result == false){
            $sql = "insert into `{account}` set user_id = '{$user_id}'";
            $mysql ->db_query($sql);
            $result = self:: GetOne($data);
    }
    		return $result;
    	}
    
    
    public  function GetUserLog($data = array()){
        $mysql=$this;
        $user_id = $data['user_id'];
        $sql = "select type,sum(money) as num from `{account_log}` where userid = '{$user_id}' group by type ";
        $result = $mysql->db_fetch_arrays($sql);
        $_result = "";
        foreach ($result as $key => $value){
            $_result[$value['type']] = $value['num'];
        }
    
        $sql = "select * from `{account}` where user_id = '{$user_id}'  ";
        $result = $mysql->db_fetch_array($sql);
        if($result!=false){
            foreach ($result as $key => $value){
                $_result[$key] = $value;
            }
        }
    
        //借款额度
        $sql = "select borrow_amount from `{member_cache}` where userid = {$user_id} ";
        $result = $mysql -> db_fetch_array($sql);
        $_result['amount'] = $result['borrow_amount'];//借款总额
    
    
    
    
        //充值的统计
        /*$sql = "select type,sum(money) as num from `{account_recharge}` where user_id = '{$user_id}' and status=1 group by type ";
        $result = $mysql->db_fetch_arrays($sql);
        foreach ($result as $key => $value){
            if ( $value['type']==0){
                $key = "recharge_shoudong";
            }elseif ( $value['type']==1){
                $key = "recharge_online";
            }else{
                $key = "recharge_downline";
            }
            $_result[$key] = $value['num'];
        }
        $sql = "select sum(money) as num from `{account_recharge}` where user_id = '{$user_id}' and status=1  ";
        $result = $mysql->db_fetch_array($sql);
        $_result['recharge_success'] = $result['num'];
        $_result['recharge'] =  $result['num'];
        $sql = "select sum(money) as num from `{account_recharge}` where user_id = '{$user_id}' and status=0  ";
        $result = $mysql->db_fetch_array($sql);
        $_result['recharge_false'] = $result['num'];
    
        //提现的统计
        $sql = "select status,sum(total) as num,sum(credited) as cnum,sum(fee) as fnum from `{account_cash}` where user_id = '{$user_id}'  group by status ";
        $result = $mysql->db_fetch_arrays($sql);
        foreach ($result as $key => $value){
            if ( $value['status']==2){
                $key = "cash_false";
            }elseif ( $value['status']==1){
                $key = "cash_success";
            }elseif ( $value['status']==3){
                $key = "cash_cancel";
            }else{
                $key = "cash_wait";
            }
            $_result[$key] = array("money"=>$value['num'],"credited"=>$value['cnum'],"fee"=>$value['fnum']);
        }
    */
        return $_result;
    }
}