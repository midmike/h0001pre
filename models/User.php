<?php
require_once ("BaseModel.php");
require_once 'UserOnline.php';
/*
 * Author midmike
 */
class User extends BaseModel {
	const TABLENAME = "tbuser";
	//login user get from session
	const SESSION_USER = "log_user";
	//login event status
	const LOGIN_EVENT = "login_event";
	const LOGIN_FAIL = "0";
	const LOGIN_NO_USERNAME = "1";
	const LOGIN_NO_PASSWORD = "2";
	//user type status
	const STATUS_ADMIN = "1";
	const STATUS_USER = "2";
	//cache status
	const CACHE_HIDE = "1";
	const CACHE_SHOW = "0";
	
	private $name;
	private $status;
	private $address;
	private $phone;
	private $username;
	private $password;
	private $dbpassword;
	public function setUsername($value) {
		$this->username = $value;
	}
	public function setPassword($value) {
		$this->password = $value;
	}
	public function setStatus($value) {
		$this->status = $value;
	}
	public function setAddress($value) {
		$this->address = $value;
	}
	public function getAddress() {
		return $this->address;
	}
	public function setPhone($value) {
		$this->phone = $value;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function setName($value) {
		$this->name = $value;
	}
	public function getName() {
		return $this->name;
	}
	public function getStatus() {
		return $this->status;
	}
	public function getId() {
		return $this->id;
	}
	public function getUserName() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getStatusValues() {
		$array = [
			self::STATUS_ADMIN,
			self::STATUS_USER
		];
		return $array;
	}
	public function getStatusTexts() {
		$array = [
				i18n::getLabelWithoutWrite("user.status.administrator"),
				i18n::getLabelWithoutWrite("user.status.user")
		];
		return $array;
	}
	public function getStringStatus($value) {
		if (self::STATUS_ADMIN == $value) {
			return i18n::getLabelWithoutWrite("user.status.administrator");
		} else if (self::STATUS_USER == $value) {
			return i18n::getLabelWithoutWrite("user.status.user");
		}
		return null;
	}
	public function readDatabase($where = null, $params = null) {
		if($where == null ) {
			if (!Tool::isEmpty(self::getId())) {
				$where = "where id =".self::getId();
			}
		}
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		return $result;
	}
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteReadAll ();
		return $this->prepareAll ( $result , "User" );
	}
	public function insertDatabase($user) {
		$options = [ 
				'cost' => 12 
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteInsert ( User::TABLENAME, get_object_vars ( $this ), $user );
		$useronline = new UserOnline ();
		$useronline->excuteInsert ( UserOnline::TABLENAME, get_object_vars ( $useronline ), $user );
	}
	public function UpdateDatabase($user) {
		$options = [ 
				'cost' => 12 
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteUpdate ( "tbuser", $this->prepareUpdate() , $user ); 
	}
	 private function prepareUpdate() {
		$sqlData = "`name` = '".$this->getName()."', `status` = '".$this->getStatus()."', 
		`address` = '".$this->getAddress()."', `phone` = '".$this->getPhone()."', 
		`username` = '".$this->getUserName()."', `password` = '".$this->getPassword()."',
		`cache` = b'".$this->getCache()."'";
		return $sqlData;
	} 
	public function isExist() {
		$username = $this->username;
		$password = $this->password;
		// return to result to check name have in record or not
		$result = $this->readDatabase ( 'where username = ?', array (
				$username 
		) );
		if (! empty ( $result )) {
			if ($this->username == $username && password_verify ( $password, $this->dbpassword )) {
				// update time in cookies
				// setcookie ( self::SESSION_USER, serialize ( $this ), time () + (900), "/" ); // 900s = 15m
				SessionHandlers::saveSession ( $this, self::SESSION_USER ); // echo "add cookies";
				return TRUE; // true
			}
			//echo "password incorrect";
			$_POST [self::LOGIN_EVENT] = self::LOGIN_FAIL;
			return FALSE; // false
		} else {
			if(isset($_POST [self::LOGIN_EVENT])) {
				$_POST [self::LOGIN_EVENT] = $_POST [self::LOGIN_EVENT];
			}
			//Tool::pageError(User::LOGIN_FAIL);
			//echo "\$result empty in isExist()";
			return FALSE; // false
		}
	}
	public function isLogin() {
		if (!SessionHandlers::isSetSession ( self::SESSION_USER ) && isset ( $_COOKIE [self::SESSION_USER] )) {
			$log_user = Tool::decodeObj( $_COOKIE [self::SESSION_USER] ); // 900s = 15m
			setcookie ( self::SESSION_USER, Tool::encodeObj( $log_user ), time () + (900), "/" ); // 900s = 15m
		} else if (!SessionHandlers::isSetSession ( self::SESSION_USER )) {
			return false;
		} else {
			$log_user = SessionHandlers::getObjSession ( self::SESSION_USER );
		}	
		if ($log_user->isExist ()) {
			return true;
		}
		// check with cookies
		/*
		 * if (isset ( $_COOKIE ['user'] )) {
		 * $user = unserialize ( $_COOKIE ['user'] );
		 * setcookie ( 'user', serialize ( $user ), time () + (900), "/" );
		 * // echo "islogin:true<br>";
		 * return TRUE; // $user->isExist();
		 * }
		 */
		// echo "islogin:false<br>";
		return false;
	}
	//Every Model need to have this method because prepareAll Method depand on this method
	public function prepare($result) {
		$this->id = $result ['id'];
		$this->name = $result ['name'];
		$this->phone = $result ['phone'];
		$this->status = $result ['status'];
		$this->address = $result ['address'];
		$this->dbpassword = $result ['password'];
		$this->username = $result ['username'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
	public function getSession() {
		SessionHandlers::getObjSession(self::SESSION_USER);
	}
	public function dataTable($cache) {
		/*
		 * DataTables example server-side processing script.
		 *
		 * Please note that this script is intentionally extremely simply to show how
		 * server-side processing can be implemented, and probably shouldn't be used as
		 * the basis for a large complex system. It is suitable for simple use cases as
		 * for learning.
		 */
		
		// DB table to use
		$table = self::TABLENAME;
		
		// Table's primary key
		$primaryKey = 'id';
		
		// Array of database columns which should be read and sent back to DataTables.
		// The `db` parameter represents the column name in the database, while the `dt`
		// parameter represents the DataTables column identifier. In this case simple
		// indexes
		$columns = array (
				array (
						'db' => 'id',
						'dt' => 0,
						'formatter' => function ($d, $row) {
							return "<input type='radio' value='$d' class='i-grey' name='id' checked>";
						} 
				)
				,
				array (
						'db' => 'name',
						'dt' => 1 
				),
				array (
						'db' => 'status',
						'dt' => 2,
						'formatter' => function ($d, $row) {
							return self::getStringStatus ( $d );
						} 
				),
				array (
						'db' => 'address',
						'dt' => 3 
				),
				array (
						'db' => 'phone',
						'dt' => 4 
				),
				array (
						'db' => 'username',
						'dt' => 5 
				)
						
		);
		require ('DataTable.php');
		echo json_encode ( DataTable::simple ( $_POST, $table, $primaryKey, $columns,$cache ) );
	}
	public function createUserTest() {
		//$this->TestSql( "INSERT INTO `resmanag`.`tbuser` (`id`, `name`, `status`, `address`, `phone`, `username`, `password`, `createdate`, `modifydate`, `editedby`, `cache`) VALUES (NULL, 'asd', '2', '12312312312', '(234) 234-23', 'adasd', '12312', '2014-11-29', '2014-11-04', '149', b'0');");
	}
}
?>