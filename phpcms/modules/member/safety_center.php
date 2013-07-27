<?php
/**
 * 会员安全中心,包括修改密码,修改支付密码,密码保护
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('foreground');
pc_base::load_sys_class('format', '', 0);
pc_base::load_sys_class('form', '', 0);

class safety_center extends foreground {

	private $times_db;
	
	function __construct() {
		parent::__construct();
		$this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	public function init()
	{
	    $show_validator = true;
	    $memberinfo = $this->memberinfo;
	    
	    include template('member', 'safety_manage_password');
	}
	
	
	public function account_manage_password() {
	    if(isset($_POST['dosubmit'])) {
	        $updateinfo = array();
	        if(!is_password($_POST['info']['password'])) {
	            showmessage(L('password_format_incorrect'), HTTP_REFERER);
	        }
	        if($this->memberinfo['password'] != password($_POST['info']['password'], $this->memberinfo['encrypt'])) {
	            showmessage(L('old_password_incorrect'), HTTP_REFERER);
	        }
	        //修改会员邮箱
	        if($this->memberinfo['email'] != $_POST['info']['email'] && is_email($_POST['info']['email'])) {
	            $email = $_POST['info']['email'];
	            $updateinfo['email'] = $_POST['info']['email'];
	        } else {
	            $email = '';
	        }
	        $newpassword = password($_POST['info']['newpassword'], $this->memberinfo['encrypt']);
	        $updateinfo['password'] = $newpassword;
	        	
	        $this->db->update($updateinfo, array('userid'=>$this->memberinfo['userid']));
	        if(pc_base::load_config('system', 'phpsso')) {
	            //初始化phpsso
	            $this->_init_phpsso();
	            $res = $this->client->ps_member_edit('', $email, $_POST['info']['password'], $_POST['info']['newpassword'], $this->memberinfo['phpssouid'], $this->memberinfo['encrypt']);
	            $message_error = array('-1'=>L('user_not_exist'), '-2'=>L('old_password_incorrect'), '-3'=>L('email_already_exist'), '-4'=>L('email_error'), '-5'=>L('param_error'));
	            if ($res) showmessage($message_error[$res]);
	        }
	
	        showmessage(L('operation_success'), HTTP_REFERER);
	    } else {
	        $show_validator = true;
	        $memberinfo = $this->memberinfo;
	        	
	        include template('member', 'safety_manage_password');
	    }
	}
}