<?php
/**
 * 会员资金管理认证中心
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('foreground');
pc_base::load_sys_class('format', '', 0);
pc_base::load_sys_class('form', '', 0);

class fund_manage extends foreground {

	private $times_db;
	
	function __construct() {
		parent::__construct();
		$this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	/**
	 * 帐户详情
	 */
	public function init()
	{
	    error_reporting(1);
	    error_reporting(E_ALL);
	    $assign=array();
	    $module='member';
	    $dir=rfwTplPath($module);
	    $otherConfig['dir']=$dir.'tpl';
	    $template='account_info.tpl';
	    $content=rfwFastTpl($template, $assign, $otherConfig);
	    $borrow=pc_base::load_sys_class('borrow');
	    $data=array('user_id'=>$this->memberinfo['userid']);
	    $result=$borrow->GetUserLog($data);
	    
	    $memberinfo=$this->memberinfo;
	    include template('member', 'fund_mangage_index');
	}
	
	/**
	 * 银行卡管理
	 */
	public function bank()
	{
	    $accout_bank_model=pc_base::load_model('account_bank_model');
	    if (isset($_POST['account'])){
	        $var = array("user_id","account","bank","branch");
	        $data = post_var($var);
	        $data['user_id']=$this->memberinfo['userid'];
	        $result = $accout_bank_model->ActionBank($data);
	        if ($result!==true){
	            $msg = array('操作失败,请稍后重试',HTTP_REFERER);
	        }else{
	            $msg = array("操作成功",HTTP_REFERER);
	        }
	        showmessage($msg[0],$msg[1]);
	        die();
	    }else{
	        $data['user_id'] = $this->memberinfo['userid'];
	        $result = $accout_bank_model->GetBankOne($data);
	        if(isset($result['bank']) && !empty($result['bank']))
	        {
	            $result['bank_name']=linkage($result['bank']);
	        }else{
	            $result['bank_name']='';
	        }
	        $_U['account_bank_result'] = $result;
	        $siteid=$this->memberinfo['siteid'];
	        $seo=seo($siteid);
	        $assign=array('_U'=>$_U,'_G'=>array('system'=>array('con_webname'=>$seo['site_title'])));
	    }
	    $module='member';
	    $dir=rfwTplPath($module);
	    $otherConfig['dir']=$dir.'tpl';
	    $template='account_bank.tpl';
	    $content=rfwFastTpl($template, $assign, $otherConfig);
	    $memberinfo=$this->memberinfo;
	    include template('member', 'fund_mangage_back');
	}
	
	
}