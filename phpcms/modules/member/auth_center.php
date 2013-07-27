<?php
/**
 * 会员认证中心
 */

defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('foreground');
pc_base::load_sys_class('format', '', 0);
pc_base::load_sys_class('form', '', 0);

class auth_center extends foreground {

	private $times_db;
	
	function __construct() {
		parent::__construct();
		$this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
	}
	
	function index()
	{
	    $memberinfo=$this->memberinfo;
	    include template('member', 'auth_center_index');
	    
	}
	
	/**
	 * 实名认证
	 */
	function really()
	{
	    if($_SERVER['REQUEST_METHOD']=='POST')
	    {
	        
	        $var = array("realname","sex","card_type","card_id","province","city","province","city","area","nation");
	        $data = post_var($var);
	        $data['user_id'] = intval($this->memberinfo['userid']);
	        $data['birthday'] = $_POST['birthday'];
	        $data['real_status'] = 2;
	        $mysql=pc_base::load_model('member_model');
	        
	        $result = $mysql->CheckIdcard(array("user_id"=>$data['user_id'],"card_id"=>$data['card_id']));
	        if(!isIdCard($data['card_id'])){
	            $msg = array("身份证号码格式不正确",HTTP_REFERER);
	        }elseif($result == true){
	            $msg = array("身份证号码已经存在",HTTP_REFERER);
	        }else{
	            $upload=pc_base::load_sys_class('upload');
	            $_G['upimg']['file'] = "card_pic1";
	            $_G['upimg']['code'] = "user";
	            $_G['upimg']['user_id'] = $this->memberinfo['userid'];
	            $_G['upimg']['siteid'] = $this->memberinfo['siteid'];
	            $defaultConfig=pc_base::load_config('default_config','auth_images_config');
	            $_G['upimg']=array_merge($defaultConfig,$_G['upimg']);
	            $pic_result = $upload->upfile($_G['upimg']);
	            if ($pic_result!=""){
	                $data['card_pic1'] = $pic_result['filename'];
	            }
	            $_G['upimg']['file'] = "card_pic2";
	            $pic_result = $upload->upfile($_G['upimg']);
	            if ($pic_result!=""){
	                $data['card_pic2'] = $pic_result['filename'];
	            }
	            $result = $mysql->UpdateUserAll($data);
	            if ($result == false){
	                $msg = array('实名认证信息失败,请重试',HTTP_REFERER);
	            }else{
	                $msg = array("实名认证添加成功，请等待管理员审核",HTTP_REFERER);
	            }
	        }
	        showmessage($msg[0],$msg[1]);
	    }
	    $memberinfo=$this->memberinfo;
	    include template('member', 'auth_center_really');
	}
	
	/**
	 * 邮箱认证
	 */
	function email()
	{
	    if($_SERVER['REQUEST_METHOD']=='POST')
	    {
	        $email=$_POST['email'];
	        $member_setting = getcache('member_setting');
	        $userid=$this->memberinfo['userid'];
	        $userinfo=$this->memberinfo;
	        $password = $userinfo['password'];
	        pc_base::load_sys_func('mail');
	        $phpcms_auth_key = md5(pc_base::load_config('system', 'auth_key'));
	        $code = sys_auth($userid.'|'.$phpcms_auth_key, 'ENCODE', $phpcms_auth_key);
	        $url = APP_PATH."index.php?m=member&c=index&a=register&code=$code&verify=1";
	        $message = $member_setting['registerverifymessage'];
	        $message = str_replace(array('{click}','{url}','{username}','{email}','{password}'), array('<a href="'.$url.'">'.L('please_click').'</a>',$url,$userinfo['username'],$userinfo['email'],$password), $message);
	        sendmail($email, L('reg_verify_email'), $message);
	    }
	    $memberinfo=$this->memberinfo;
	    include template('member', 'auth_center_email');
	}
	
	/**
	 * 手机认证
	 */
	function mobile()
	{
	    if($_SERVER['REQUEST_METHOD']=='POST')
	    {
	        $mysql=pc_base::load_model('member_model');
	        $mobile=$_POST['phone'];
	        if(!preg_match('/^1([0-9]{9})/',$mobile)) {
	            showmessage('请提供正确的手机号码！', HTTP_REFERER);
	        }
	        $data=array('user_id'=>$this->memberinfo['userid'],'phone'=>$mobile,'phone_status'=>1);
	        $result = $mysql->UpdateUserAll($data);
	        if ($result == false){
	            $msg = array('手机认证失败,请稍后重试',HTTP_REFERER);
	        }else{
	            $msg = array("手机认证成功",HTTP_REFERER);
	        }
	        showmessage($msg[0],$msg[1]);
	    }
	    $memberinfo=$this->memberinfo;
	    include template('member', 'auth_center_mobile');
	}
}