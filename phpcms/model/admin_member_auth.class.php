<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class admin_member_auth extends model
{
    public function __construct ()
    {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'attestation';
        parent::__construct();
    }
    
    /**
     * 得到实名认证列表
     * 
     * @param unknown_type $data            
     * @return multitype:Ambigous <multitype:, unknown> number Ambigous <number,
     *         unknown> unknown
     */
    public function getList ($data = array())
    {
        $type = isset($data ['type']) ? $data ['type'] : "";
        $page = empty($data ['page']) ? 1 : $data ['page'];
        $epage = empty($data ['epage']) ? 20 : $data ['epage'];
        
        $type_id = isset($data ['groupid']) ? $data ['groupid'] : "";
        $username = isset($data ['username']) ? $data ['username'] : "";
        
        $_sql = "";
        if ($type_id != "") {
            $_sql .= " and {$this->db_tablepre}.member_group in ($type_id)";
        }
        if ($type != "") {
            $_sql .= " and uy.groupid=$type";
        }
        
        if ($username != "") {
            $_sql .= " and u.username like '%$username%'";
        }
        if (isset($data ['realname'])) {
            $_sql .= " and u.nickname like '%{$data['realname']}%'";
        }
        if (isset($data ['email']) && $data ['email'] != "") {
            $_sql .= " and u.email like '%{$data['email']}%'";
        }
        if (isset($data ['avatar_status'])) {
            $_sql .= " and u.avatar_status = {$data['avatar_status']}";
        }
        if (isset($data ['phone_status'])) {
            $_sql .= " and u.phone_status = {$data['phone_status']}";
        }
        $_select = " u.*,uy.name as typename ";
        $_order = 'order by u.userid desc';
        
        if (isset($data ['order'])) {
            if ($data ['order'] == "new") {
                $_order = " order by u.addtime desc";
            } elseif ($data ['order'] == "integral") {
                $_order = " order by u.integral desc";
            } elseif ($data ['order'] == "hits") {
                $_order = " order by u.hits desc";
            } elseif ($data ['order'] == "real_status") {
                $_order = " order by u.real_status desc";
            }
        }
        
        $countsql = "SELECT count(*) FROM `{$this->getTable('member')}` as u
                     LEFT JOIN `{$this->getTable('member_group')}` as uy on uy.groupid=u.groupid
                     WHERE 1=1 {$_sql} {$_order} ";
        
        $row = $this->db->createCommand($countsql)->queryScalar();
        
        $total=$total_page=0;
        $pages='';
        if ($row > 0) {
            $total = $row ? $row : 0;
            
            $total_page = ceil($total / $epage);
            $index = $epage * ($page-1) ;
            $limit = " limit {$index}, {$epage}";
            
            $pages = pages($total, $page, $epage, '', '', '');
            
            $sql = "SELECT {$_select} FROM `{$this->getTable('member')}` as u
                    LEFT JOIN `{$this->getTable('member_group')}` as uy on uy.groupid=u.groupid
                    WHERE 1=1 {$_sql} {$_order} {$limit}";
            
            $list = $this->db->createCommand($sql)->queryAll();
        }
        $list = $list ? $list : array ();
        
        return array (
                'list' => $list, 
                'total' => $total, 
                'page' => $page, 
                'epage' => $epage, 
                'total_page' => $total_page,
                'pages_htmls'=>$pages 
        );
    }
}
?>