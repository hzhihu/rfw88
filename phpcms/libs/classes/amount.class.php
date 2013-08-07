<?
/*
1,用户中心页面，需要读取所有的额度，程序在borrow.class.php function GetUserLog

2,用户中心 -额度申请页面
*/
class amount{


	
	//添加额度的记录（member_amountlog）
	//user_id 用户id
	//type 操作的类型 
	//amount_type 额度的类型 ，credit 信用额度  borrow_vouch 借款额度  tender 投资额度
	//account  额度操作的金额
	//account_all 总的额度
	//account_use 可用额度
	//account_nouse 不可用额度
	//remark 额度的记录
	function  AddAmountLog($data){
		$mysql=pc_base::load_model('member_model');
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		$sql = "insert into `{member_amountlog}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
        $result = $mysql->db_query($sql);
    	 
		//如果记录添加成功，则相应的改变信息
		if ($result == true){
			$_data["user_id"] = $user_id;
			if ($data['amount_type'] == "credit"){
				$_data["credit"] = $data['account_all'];
				$_data["credit_use"] = $data['account_use'];
				$_data["credit_nouse"] = $data['account_nouse'];
			}
			elseif ($data['amount_type'] == "borrow_vouch"){
				$_data["borrow_vouch"] = $data['account_all'];
				$_data["borrow_vouch_use"] = $data['account_use'];
				$_data["borrow_vouch_nouse"] = $data['account_nouse'];
			}
			elseif ($data['amount_type'] == "tender_vouch"){
				$_data["tender_vouch"] = $data['account_all'];
				$_data["tender_vouch_use"] = $data['account_use'];
				$_data["tender_vouch_nouse"] = $data['account_nouse'];
			}
			self::UpdateAmount($_data);
			return 1;
		}
	}
	
	//获得用户的额度（member_amount）
	//user_id 用户id 
	function GetAmountOne($user_id,$type = ""){
		$mysql=pc_base::load_model('member_model');
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		$sql = "select * from `{member_amount}` where userid={$user_id}";
		$result = $mysql ->db_fetch_array($sql);
		if ($result == false){
			self::AddAmount($user_id);//添加记录
			return self::GetAmountOne($user_id);
		}
		if ($type!=""){
			if ($type == "credit"){
				$result['account_all'] = $result["credit"];
				$result['account_use'] = $result["credit_use"];
				$result['account_nouse'] = $result["credit_nouse"];
			}
			elseif ($type == "borrow_vouch"){
				$result['account_all'] = $result["borrow_vouch"];
				$result['account_use'] = $result["borrow_vouch_use"];
				$result['account_nouse'] = $result["borrow_vouch_nouse"];
			}
			elseif ($type == "tender_vouch"){
				$result['account_all'] = $result["tender_vouch"];
				$result['account_use'] = $result["tender_vouch_use"];
				$result['account_nouse'] = $result["tender_vouch_nouse"];
			}
		}
		return $result;
	}
	
	//更新用户的额度信息（member_amount）
	//user_id 用户id 
	function  UpdateAmount($data){
		$mysql=pc_base::load_model('member_model');
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		
		self::AddAmount($user_id);//添加记录
		
		$sql = "update `{member_amount}` set userid={$user_id}";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
		$sql .= " where userid = {$user_id}";
        return $mysql->db_query($sql);
	}
	
	
	
	//添加用户的额度信息（member_amount）
	//user_id 用户id 
	function  AddAmount($user_id){
		$mysql=pc_base::load_model('member_model');
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		
		$credit = isset($_G['system']['con_user_amount'])?$_G['system']['con_user_amount']:2000;//开始的最低额度
		$sql = "select * from `{member_amount}` where userid={$user_id}";
		$result = $mysql ->db_fetch_array($sql);
		if ($result == false){
		$sql = "insert into `{member_amount}` set  userid = {$user_id},credit ={$credit},credit_use ={$credit} ";
        return $mysql->db_query($sql);
		}
		return 1;
	}
	
	
	 /**
	 * 添加用户的额度申请（user_amountapply）
	 *
	 * @param Array $data
	 * @return Boolen
	 */
	function AddAmountApply($data = array()){
		$mysql=pc_base::load_model('member_model');
        $user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		
		//获取旧数据
		$result = self::GetAmountOne($user_id);
		if ($data['type'] == "credit"){
			$data["account_old"] = $result['credit'];
		}
		elseif ($data['type'] == "borrow_vouch"){
			$data["account_old"] = $result['borrow_vouch'];
		}
		elseif ($data['type'] == "tender_vouch"){
			$data["account_old"] = $result['tender_vouch'];
		}
		$sql = "insert into `{member_amountapply}` set `addtime` = '".time()."',`addip` = '".ip_address()."'";
		foreach($data as $key => $value){
			$sql .= ",`$key` = '$value'";
		}
        return $mysql->db_query($sql);
	}
	
	//获得用户的申请记录（user_amountapply）
	//id id 
	//user_id 用户id 
	function GetAmountApplyOne($data){
		$mysql=pc_base::load_model('member_model');
		$sql = " where 1=1 ";
		if (isset($data['user_id'])){
			$sql .= " and p1.userid={$data['user_id']}  ";
		}
		if (isset($data['id'])){
			$sql .= " and p1.id={$data['id']} ";
		}
		if (isset($data['type'])){
			$sql .= " and p1.type='{$data['type']}' ";
		}
		$sql = "select p1.*,p2.username from `{member_amountapply}` as  p1 left join `{user}` as p2 on p1.userid=p2.userid " . $sql ." order by p1.id desc";
		$result = $mysql ->db_fetch_array($sql);
		
		return $result;
	}
	
	/**
	 * 列表
	 *
	 * @return Array
	 */
	function GetAmountList($data = array()){
		$mysql=pc_base::load_model('member_model');
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status = {$data['status']}";
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p1.userid = {$data['user_id']}";
		}
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p2.username like '%{$data['username']}%' ";
		}
		if (isset($data['type']) && $data['type']!=""){
			$_sql .= " and p1.type like '%{$data['type']}%' ";
		}
		$_select = 'p1.*,p2.username';
		$sql = "select SELECT from {member_amount} as p1 
				left join {user} as p2 on p1.userid=p2.userid
				$_sql ORDER LIMIT";
				 
		//是否显示全部的信息
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
		}	
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		
		
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
	
	
	
	function CheckAmountApply($data){
		global $mysql,$_G;
		
		$user_id = $data['user_id'];
		if (!isset($user_id)) return -1;//如果用户不存在，则返回
		
		$result = self::GetAmountApplyOne(array("id",$data['id']));//获取额度的信息，看是否已经操作过
		
		/*
		if ($result['status']!=2){
			return "此额度已经通过审核，请不要重复操作";
		}
		*/
		
		if ($data['status']==1){
		
			//添加额度记录
			$_result = self::GetAmountOne($user_id,$data["type"]);
			$_data["user_id"] = $user_id;
			$_data["type"] = "apply_add";
			$_data["amount_type"] = $data['type'];
			$_data["account"] = $data['account'];
			$_data["account_all"] = $data['account'];
			$_data["account_use"] = $data['account'] - $_result['account_nouse'];
			$_data["account_nouse"] = $_result['account_nouse'];//type 操作的类型 
			$_data["remark"] = "申请额度审核通过";//type 操作的类型 
			self::AddAmountLog($_data);
		}
		
		//更新信息
		$sql = "update `{member_amountapply}` set status={$data['status']},verify_time='".time()."',verify_user=".$_G['user_id'].",verify_remark='{$data['verify_remark']}',account_new='{$data['account']}' where id = {$data['id']}";
		$mysql ->db_query($sql);
		return 1;
	
	}
	
	
	/**
	 * 列表
	 *
	 * @return Array
	 */
	function GetAmountApplyList($data = array()){
		$mysql=pc_base::load_model('member_model');
		
		$page = empty($data['page'])?1:$data['page'];
		$epage = empty($data['epage'])?10:$data['epage'];
		
		$_sql = "where 1=1 ";		 
		
		if (isset($data['status']) && $data['status']!=""){
			$_sql .= " and p1.status = {$data['status']}";
		}
		if (isset($data['user_id']) && $data['user_id']!=""){
			$_sql .= " and p1.userid = {$data['user_id']}";
		}
		if (isset($data['username']) && $data['username']!=""){
			$_sql .= " and p2.username like '%{$data['username']}%' ";
		}
		if (isset($data['type']) && $data['type']!=""){
			$_sql .= " and p1.type like '%{$data['type']}%' ";
		}
		$_select = 'p1.*,p2.username';
		$sql = "select SELECT from {member_amountapply} as p1 
				left join {user} as p2 on p1.userid=p2.userid
				$_sql ORDER LIMIT";
				 
		//是否显示全部的信息
		if (isset($data['limit']) ){
			$_limit = "";
			if ($data['limit'] != "all"){
				$_limit = "  limit ".$data['limit'];
			}
			return $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select,  'order by p1.`order` desc,p1.id desc', $_limit), $sql));
		}	
		
		$row = $mysql->db_fetch_array(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array('count(1) as num', '', ''), $sql));
		
		$total = $row['num'];
		$total_page = ceil($total / $epage);
		$index = $epage * ($page - 1);
		$limit = " limit {$index}, {$epage}";
		
		$list = $mysql->db_fetch_arrays(str_replace(array('SELECT', 'ORDER', 'LIMIT'), array($_select, 'order by p1.id desc', $limit), $sql));		
		$list = $list?$list:array();
		
		
		return array(
            'list' => $list,
            'total' => $total,
            'page' => $page,
            'epage' => $epage,
            'total_page' => $total_page
        );
		
	}
}
?>