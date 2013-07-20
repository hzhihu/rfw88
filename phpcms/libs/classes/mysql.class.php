<?php
/**
 *  mysql.class.php 数据库实现类
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-6-1
 */

final class mysql {
	
	/**
	 * 数据库配置信息
	 */
	private $config = null;
	
	/**
	 * 数据库连接资源句柄
	 */
	public $link = null;
	
	/**
	 * 最近一次查询资源句柄
	 */
	public $lastqueryid = null;
	
	/**
	 *  统计数据库查询次数
	 */
	public $querycount = 0;
	
	/**
	 *
	 * 当前数据库连接
	 * @var object
	 */
	private $conn;
	
	private $query;
	
	/**
	 *
	 * 当前操作的sql
	 * @var string
	 */
	private $sql;
	
	/**
	 *
	 * 当前操作的错误信息
	 * @var string
	 */
	private $error = '';
	
	public $lastInsertID;
	
	/**
	 *
	 * 事务是否开启
	 * @var int
	 */
	private $tranBool = false;
	
	
	public function __construct() {

	}
	
	/**
	 * 打开数据库连接,有可能不真实连接数据库
	 * @param $config	数据库连接参数
	 * 			
	 * @return void
	 */
	public function open($config) {
		$this->config = $config;
		if($config['autoconnect'] == 1) {
			$this->connect();
		}
	}

	/**
	 * 真正开启数据库连接
	 * 			
	 * @return void
	 */
	public function connect() {
		$func = $this->config['pconnect'] == 1 ? 'mysql_pconnect' : 'mysql_connect';
		if(!$this->link = @$func($this->config['hostname'], $this->config['username'], $this->config['password'], 1)) {
			$this->halt('Can not connect to MySQL server');
			return false;
		}

		if($this->version() > '4.1') {
			$charset = isset($this->config['charset']) ? $this->config['charset'] : '';
			$serverset = $charset ? "character_set_connection='$charset',character_set_results='$charset',character_set_client=binary" : '';
			$serverset .= $this->version() > '5.0.1' ? ((empty($serverset) ? '' : ',')." sql_mode='' ") : '';
			$serverset && mysql_query("SET $serverset", $this->link);		
		}

		if($this->config['database'] && !@mysql_select_db($this->config['database'], $this->link)) {
			$this->halt('Cannot use database '.$this->config['database']);
			return false;
		}
		$this->database = $this->config['database'];
		$this->conn=$this->link;
		return $this->link;
	}

	/**
	 * 数据库查询执行方法
	 * @param $sql 要执行的sql语句
	 * @return 查询资源句柄
	 */
	private function execute($sql) {
		if(!is_resource($this->link)) {
			$this->connect();
		}
		
		$this->lastqueryid = mysql_query($sql, $this->link) or $this->halt(mysql_error(), $sql);

		$this->querycount++;
		return $this->lastqueryid;
	}

	/**
	 * 执行sql查询
	 * @param $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @param $table 		数据表
	 * @param $where 		查询条件[例`name`='$name']
	 * @param $limit 		返回结果范围[例：10或10,10 默认为空]
	 * @param $order 		排序方式	[默认按数据库默认方式排序]
	 * @param $group 		分组方式	[默认为空]
	 * @param $key 			返回数组按键名排序
	 * @return array		查询结果集数组
	 */
	public function select($data, $table, $where = '', $limit = '', $order = '', $group = '', $key = '') {
		$where = $where == '' ? '' : ' WHERE '.$where;
		$order = $order == '' ? '' : ' ORDER BY '.$order;
		$group = $group == '' ? '' : ' GROUP BY '.$group;
		$limit = $limit == '' ? '' : ' LIMIT '.$limit;
		$field = explode(',', $data);
		array_walk($field, array($this, 'add_special_char'));
		$data = implode(',', $field);

		$sql = 'SELECT '.$data.' FROM `'.$this->config['database'].'`.`'.$table.'`'.$where.$group.$order.$limit;
		$this->execute($sql);
		if(!is_resource($this->lastqueryid)) {
			return $this->lastqueryid;
		}

		$datalist = array();
		while(($rs = $this->fetch_next()) != false) {
			if($key) {
				$datalist[$rs[$key]] = $rs;
			} else {
				$datalist[] = $rs;
			}
		}
		$this->free_result();
		return $datalist;
	}

	/**
	 * 获取单条记录查询
	 * @param $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
	 * @param $table 		数据表
	 * @param $where 		查询条件
	 * @param $order 		排序方式	[默认按数据库默认方式排序]
	 * @param $group 		分组方式	[默认为空]
	 * @return array/null	数据查询结果集,如果不存在，则返回空
	 */
	public function get_one($data, $table, $where = '', $order = '', $group = '') {
		$where = $where == '' ? '' : ' WHERE '.$where;
		$order = $order == '' ? '' : ' ORDER BY '.$order;
		$group = $group == '' ? '' : ' GROUP BY '.$group;
		$limit = ' LIMIT 1';
		$field = explode( ',', $data);
		array_walk($field, array($this, 'add_special_char'));
		$data = implode(',', $field);

		$sql = 'SELECT '.$data.' FROM `'.$this->config['database'].'`.`'.$table.'`'.$where.$group.$order.$limit;
		$this->execute($sql);
		$res = $this->fetch_next();
		$this->free_result();
		return $res;
	}
	
	/**
	 * 遍历查询结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @return array
	 */
	public function fetch_next($type=MYSQL_ASSOC) {
		$res = mysql_fetch_array($this->lastqueryid, $type);
		if(!$res) {
			$this->free_result();
		}
		return $res;
	}
	
	/**
	 * 释放查询资源
	 * @return void
	 */
	public function free_result() {
		if(is_resource($this->lastqueryid)) {
			mysql_free_result($this->lastqueryid);
			$this->lastqueryid = null;
		}
	}
	
	/**
	 * 直接执行sql查询
	 * @param $sql							查询sql语句
	 * @return	boolean/query resource		如果为查询语句，返回资源句柄，否则返回true/false
	 */
	public function query($sql) {
		return $this->execute($sql);
	}
	
	/**
	 * 执行添加记录操作
	 * @param $data 		要增加的数据，参数为数组。数组key为字段值，数组值为数据取值
	 * @param $table 		数据表
	 * @return boolean
	 */
	public function insert($data, $table, $return_insert_id = false, $replace = false) {
		if(!is_array( $data ) || $table == '' || count($data) == 0) {
			return false;
		}
		
		$fielddata = array_keys($data);
		$valuedata = array_values($data);
		array_walk($fielddata, array($this, 'add_special_char'));
		array_walk($valuedata, array($this, 'escape_string'));
		
		$field = implode (',', $fielddata);
		$value = implode (',', $valuedata);

		$cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
		$sql = $cmd.' `'.$this->config['database'].'`.`'.$table.'`('.$field.') VALUES ('.$value.')';
		$return = $this->execute($sql);
		return $return_insert_id ? $this->insert_id() : $return;
	}
	
	/**
	 * 获取最后一次添加记录的主键号
	 * @return int 
	 */
	public function insert_id() {
		return mysql_insert_id($this->link);
	}
	
	/**
	 * 执行更新记录操作
	 * @param $data 		要更新的数据内容，参数可以为数组也可以为字符串，建议数组。
	 * 						为数组时数组key为字段值，数组值为数据取值
	 * 						为字符串时[例：`name`='phpcms',`hits`=`hits`+1]。
	 *						为数组时[例: array('name'=>'phpcms','password'=>'123456')]
	 *						数组可使用array('name'=>'+=1', 'base'=>'-=1');程序会自动解析为`name` = `name` + 1, `base` = `base` - 1
	 * @param $table 		数据表
	 * @param $where 		更新数据时的条件
	 * @return boolean
	 */
	public function update($data, $table, $where = '') {
		if($table == '' or $where == '') {
			return false;
		}

		$where = ' WHERE '.$where;
		$field = '';
		if(is_string($data) && $data != '') {
			$field = $data;
		} elseif (is_array($data) && count($data) > 0) {
			$fields = array();
			foreach($data as $k=>$v) {
				switch (substr($v, 0, 2)) {
					case '+=':
						$v = substr($v,2);
						if (is_numeric($v)) {
							$fields[] = $this->add_special_char($k).'='.$this->add_special_char($k).'+'.$this->escape_string($v, '', false);
						} else {
							continue;
						}
						
						break;
					case '-=':
						$v = substr($v,2);
						if (is_numeric($v)) {
							$fields[] = $this->add_special_char($k).'='.$this->add_special_char($k).'-'.$this->escape_string($v, '', false);
						} else {
							continue;
						}
						break;
					default:
						$fields[] = $this->add_special_char($k).'='.$this->escape_string($v);
				}
			}
			$field = implode(',', $fields);
		} else {
			return false;
		}

		$sql = 'UPDATE `'.$this->config['database'].'`.`'.$table.'` SET '.$field.$where;
		return $this->execute($sql);
	}
	
	/**
	 * 执行删除记录操作
	 * @param $table 		数据表
	 * @param $where 		删除数据条件,不充许为空。
	 * 						如果要清空表，使用empty方法
	 * @return boolean
	 */
	public function delete($table, $where) {
		if ($table == '' || $where == '') {
			return false;
		}
		$where = ' WHERE '.$where;
		$sql = 'DELETE FROM `'.$this->config['database'].'`.`'.$table.'`'.$where;
		return $this->execute($sql);
	}
	
	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */
	public function affected_rows() {
		return mysql_affected_rows($this->link);
	}
	
	/**
	 * 获取数据表主键
	 * @param $table 		数据表
	 * @return array
	 */
	public function get_primary($table) {
		$this->execute("SHOW COLUMNS FROM $table");
		while($r = $this->fetch_next()) {
			if($r['Key'] == 'PRI') break;
		}
		return $r['Field'];
	}

	/**
	 * 获取表字段
	 * @param $table 		数据表
	 * @return array
	 */
	public function get_fields($table) {
		$fields = array();
		$this->execute("SHOW COLUMNS FROM $table");
		while($r = $this->fetch_next()) {
			$fields[$r['Field']] = $r['Type'];
		}
		return $fields;
	}

	/**
	 * 检查不存在的字段
	 * @param $table 表名
	 * @return array
	 */
	public function check_fields($table, $array) {
		$fields = $this->get_fields($table);
		$nofields = array();
		foreach($array as $v) {
			if(!array_key_exists($v, $fields)) {
				$nofields[] = $v;
			}
		}
		return $nofields;
	}

	/**
	 * 检查表是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function table_exists($table) {
		$tables = $this->list_tables();
		return in_array($table, $tables) ? 1 : 0;
	}
	
	public function list_tables() {
		$tables = array();
		$this->execute("SHOW TABLES");
		while($r = $this->fetch_next()) {
			$tables[] = $r['Tables_in_'.$this->config['database']];
		}
		return $tables;
	}

	/**
	 * 检查字段是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function field_exists($table, $field) {
		$fields = $this->get_fields($table);
		return array_key_exists($field, $fields);
	}

	public function num_rows($sql) {
		$this->lastqueryid = $this->execute($sql);
		return mysql_num_rows($this->lastqueryid);
	}

	public function num_fields($sql) {
		$this->lastqueryid = $this->execute($sql);
		return mysql_num_fields($this->lastqueryid);
	}

	public function result($sql, $row) {
		$this->lastqueryid = $this->execute($sql);
		return @mysql_result($this->lastqueryid, $row);
	}

	public function error() {
		return @mysql_error($this->link);
	}

	public function errno() {
		return intval(@mysql_errno($this->link)) ;
	}

	public function version() {
		if(!is_resource($this->link)) {
			$this->connect();
		}
		return mysql_get_server_info($this->link);
	}

	public function close() {
		if (is_resource($this->link)) {
			@mysql_close($this->link);
		}
	}
	
	public function halt($message = '', $sql = '') {
		if($this->config['debug']) {
			$this->errormsg = "<b>MySQL Query : </b> $sql <br /><b> MySQL Error : </b>".$this->error()." <br /> <b>MySQL Errno : </b>".$this->errno()." <br /><b> Message : </b> $message <br /><a href='http://faq.phpcms.cn/?errno=".$this->errno()."&msg=".urlencode($this->error())."' target='_blank' style='color:red'>Need Help?</a>";
			$msg = $this->errormsg;
			echo '<div style="font-size:12px;text-align:left; border:1px solid #9cc9e0; padding:1px 4px;color:#000000;font-family:Arial, Helvetica,sans-serif;"><span>'.$msg.'</span></div>';
			exit;
		} else {
			return false;
		}
	}

	/**
	 * 对字段两边加反引号，以保证数据库安全
	 * @param $value 数组值
	 */
	public function add_special_char(&$value) {
		if('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos ( $value, '`')) {
			//不处理包含* 或者 使用了sql方法。
		} else {
			$value = '`'.trim($value).'`';
		}
		if (preg_match("/\b(select|insert|update|delete)\b/i", $value)) {
			$value = preg_replace("/\b(select|insert|update|delete)\b/i", '', $value);
		}
		return $value;
	}
	
	/**
	 * 对字段值两边加引号，以保证数据库安全
	 * @param $value 数组值
	 * @param $key 数组key
	 * @param $quotation 
	 */
	public function escape_string(&$value, $key='', $quotation = 1) {
		if ($quotation) {
			$q = '\'';
		} else {
			$q = '';
		}
		$value = $q.$value.$q;
		return $value;
	}
	
	/**
	 * 
	 * @todo 此处为新加的数据库操作方法,方便操作数据库
	 */
	
	/**
	 *
	 * 创建sql
	 * @param string $sql
	 */
	public function createCommand ($sql)
	{
	    if(!is_resource($this->link)) {
	        $this->connect();
	    }
	    
	    $this->sql = $sql;
	    return $this;
	}
	/**
	 *绑定参数方法
	 *@param string $source
	 *@param string $replace
	 */
	public function bindParam($source,$replace){
	    $this->sql = str_replace($source,$replace,$this->sql);
	    return $this;
	}
	
	/**
	 * 执行 mysql_query 并返回其结果.
	 */
	public function querys ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $error = '未传入sql,请先执行createCommand ($sql)方法';
	        $this->error($error);
	        throw new Exception($error);
	        return $this;
	    }
	    $this->query = mysql_query($this->sql, $this->conn);
	    if ($this->query === false) {
	        $error='sql执行失败,失败信息为:' . mysql_error($this->conn);
	        $this->errors($error);
	        throw new Exception($error);
	        return $this;
	    }
	
	    return $this;
	}
	
	/**
	 *
	 * 返回一条记录
	 */
	public function read ()
	{
	    if (! isset($this->query) || empty($this->query)) {
	        $this->error('query执行失败或者没有执行,请先执行createCommand ($sql)->query()方法');
	        return false;
	    }
	
	    return mysql_fetch_assoc($this->query);
	}
	
	/**
	 *
	 * 返回多条记录
	 */
	public function queryAll ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $this->error('未传入sql,请先执行createCommand ($sql)方法');
	        return $this;
	    }
	
	    $this->querys();
	    
	    if ($this->query) {
	        $count = mysql_num_rows($this->query);
	    } else {
	        return array();
	    }
	
	    $return = array ();
	    if ($count > 0) {
	        while ( $row = mysql_fetch_assoc($this->query) ) {
	            $return [] = $row;
	        }
	    }
	    return $return;
	}
	
	
	/**
	 * 方便合并,增加新的获取方式
	 * @param string $sql
	 * @return Ambigous <mysql, multitype:, multitype:multitype: >
	 */
	public function db_fetch_array($sql)
	{
	    return $this->createCommand($sql)->querys()->read();
	}
	
	/**
	 * 方便合并,增加新的获取方式
	 * @param string $sql
	 * @return Ambigous <mysql, multitype:, multitype:multitype: >
	 */
	public function db_fetch_arrays($sql)
	{
	    return $this->createCommand($sql)->queryAll();
	}
	
	/**
	 * 方便合并,增加新的获取方式
	 * @param string $sql
	 * @return Ambigous <mysql, multitype:, multitype:multitype: >
	 */
	public function db_query($sql)
	{
	    return $this->createCommand($sql)->querys();
	}
	
	/**
	 * 方便合并,增加新的获取方式
	 * @param string $sql
	 * @return Ambigous <mysql, multitype:, multitype:multitype: >
	 */
	public function db_querys($sql)
	{
	    return $this->createCommand($sql)->querys();
	}
	
	/**
	 * 方便合并,增加新的获取方式
	 * @param string $sql
	 * @return Ambigous <mysql, multitype:, multitype:multitype: >
	 */
	function db_insert_id(){
	    return $this->last_insert_id();
	}
	
	/**
	 *
	 * 执行无查询 SQL
	 */
	public function executes ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $this->error('未传入sql,请先执行createCommand ($sql)方法');
	        return false;
	    }
	
	    /**
	     * @todo 由于mysql_query一次不能执行多条语句
	     * 所以分成循环执行,但这样无法保证,每条都成功
	     */
	    if (substr_count($this->sql, ';') >= 2) {
	        $sqlAry = explode(';', $this->sql);
	        foreach ( $sqlAry as $key => $sql ) {
	            $sql = trim($sql);
	            if (! empty($sql)) {
	                $query = mysql_query($sql, $this->conn);
	                /**
	                 * 多语句执行，如果有失败，抛出异常
	                */
	                if ($query===false) {
	                    $error = mysql_error($this->conn);
	                    throw new Exception($error);
	                    return false;
	                }
	                $this->last_insert_id();
	            }
	        }
	    } else {
	        $query = mysql_query($this->sql, $this->conn);
	        if ($query===false) {
	            $error = mysql_error($this->conn);
	            throw new Exception($error);
	            return false;
	        }
	        $this->last_insert_id();
	    }
	    return $query;
	}
	
	/**
	 * 查询并返回结果中的第一行
	 */
	public function queryRow ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $this->error('未传入sql,请先执行createCommand ($sql)方法');
	        return false;
	    }
	
	    $this->querys();
	
	    return mysql_fetch_array($this->query);
	}
	
	/**
	 *
	 * 查询并返回结果中第一行的第一个字段
	 */
	public function queryScalar ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $this->error('未传入sql,请先执行createCommand ($sql)方法');
	        return false;
	    }
	
	    $this->querys();
	
	    $count = mysql_num_rows($this->query);
	
	    if ($count > 0) {
	        $row = mysql_fetch_array($this->query);
	
	        if ($row != false) {
	            return array_shift($row);
	        }
	    }
	    return false;
	}
	
	/**
	 *
	 * 查询并返回结果中的第一列
	 */
	public function queryColumn ()
	{
	    if (! isset($this->sql) || empty($this->sql)) {
	        $this->error('未传入sql,请先执行createCommand ($sql)方法');
	        return false;
	    }
	
	    $return = array ();
	    $result = $this->queryAll();
	    if (! empty($result)) {
	        foreach ( $result as $key => $val ) {
	            $return [] = array_shift($val);
	        }
	    }
	    return $return;
	}
	
	public function last_insert_id ()
	{
	    $this->lastInsertID = mysql_insert_id($this->conn);
	    return $this->lastInsertID;
	}
	
	/**
	 * 计数.
	 */
	public function count ($sql)
	{
	    if (! isset($this->query) || empty($this->query)) {
	        $this->error('query执行失败或者没有执行,请先执行createCommand ($sql)->query()方法');
	        return false;
	    }
	
	    return mysql_num_rows($this->query);
	}
	
	/**
	 * 开始一个事务.
	 */
	public function beginTransaction ()
	{
	    if ($this->tranBool === true) {
	        $msg = '事务不能开启多次';
	        $this->error($msg);
	        throw new Exception($msg);
	    }
	    $query = mysql_query('begin');
	    $this->tranBool = true;
	    return $this;
	}
	
	/**
	 * 提交一个事务.
	 */
	public function commit ()
	{
	    if ($this->tranBool != true) {
	        return false;
	    }
	    mysql_query('commit');
	    $this->tranBool = false;
	}
	
	/**
	 * 回滚一个事务.
	 */
	public function rollBack ()
	{
	    if ($this->tranBool != true) {
	        return false;
	    }
	    mysql_query('rollback');
	    $this->tranBool = false;
	}
	
	/**
	 * 保存一条记录, 调用后, id被设置.
	 * @param object $row
	 */
	function save ($table, &$row)
	{
	    $sqlA = '';
	    foreach ( $row as $k => $v ) {
	        $sqlA .= "`$k` = '$v',";
	    }
	
	    $sqlA = substr($sqlA, 0, strlen($sqlA) - 1);
	    $sql = "insert into `{$table}` set $sqlA";
	    $this->querys($sql);
	    if (is_object($row)) {
	        $row->id = $this->last_insert_id();
	    } else if (is_array($row)) {
	        $row ['id'] = $this->last_insert_id();
	    }
	    return $row;
	}
	
	/**
	 * 更新$arr[id]所指定的记录.
	 * @param array $row 要更新的记录, 键名为id的数组项的值指示了所要更新的记录.
	 * @return int 影响的行数.
	 * @param string $field 字段名, 默认为'id'.
	 */
	function updates ($table, &$row, $field = 'id')
	{
	    $sqlA = '';
	    foreach ( $row as $k => $v ) {
	        $sqlA .= "`$k` = '$v',";
	    }
	
	    $sqlA = substr($sqlA, 0, strlen($sqlA) - 1);
	    if (is_object($row)) {
	        $id = $row->{$field};
	    } else if (is_array($row)) {
	        $id = $row [$field];
	    }
	    $sql = "update `{$table}` set $sqlA where `{$field}`='$id'";
	    return $this->querys($sql);
	}
	
	/**
	 * 删除一条记录.
	 * @param int $id 要删除的记录编号.
	 * @return int 影响的行数.
	 * @param string $field 字段名, 默认为'id'.
	 */
	function deletes ($table, $id, $field = 'id')
	{
	    $sql = "delete from `{$table}` where `{$field}`='{$id}'";
	    return $this->querys($sql);
	}
	
	public function errors ($msg)
	{
	    $this->error [] = $msg;
	}
	
	public function __destruct ()
	{
	    if ($this->tranBool === true) {
	        $this->rollBack();
	    }
	}
}
?>