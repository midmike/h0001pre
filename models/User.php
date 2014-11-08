<?php
require_once ("BaseModel.php");

/*
 * Author midmike
 */
class User extends BaseModel {
	const TABLENAME = "tbuser";
	const STATUS_ADMIN = "0";
	private $name;
	private $status;
	private $address;
	private $phone;
	private $username;
	private $password;
	public function setUsername($value) {
		$this->username = $value;
	}
	public function setPassword($value) {
		$this->password = $value;
	}
	public function setStatus($value) {
		$this	->status = $value;
	}
	public function setAddress($value) {
		$this->address = $value;
	}
	public function setPhone($value) {
		$this->phone = $value;
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
	public function readDatabase($where = null, $params = null) {
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteRead ( $params );
		$this->prepare ( $result );
		return $result;
	}
	public function readDatabaseAll($where = null, $params = null) {
		$this->setSQL ( 'select * from tbuser ' . $where );
		$result = $this->excuteRead ( null, $params );
		return $this->prepareAll ( $result );
	}
	public function insertDatabase($user) {
		$options = [ 
				'cost' => 12 
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteInsert ( "tbuser", get_object_vars ( $this ), $user );
	}
	public function UpdateDatabase($user) {
		$options = [ 
				'cost' => 12 
		];
		$this->password = password_hash ( $this->password, PASSWORD_BCRYPT, $options );
		$this->excuteUpdate ( "tbuser", get_object_vars ( $this ), $user );
	}
	public function isExist() {
		$username = $this->username;
		$password = $this->password;
		// return to result to check name have in record or not
		$result = $this->readDatabase ( 'where username = ?', array (
				$username 
		) );
		if (! empty ( $result )) {
			if ($this->username == $username && password_verify ( $password, $this->password )) {
				setcookie ( 'user', serialize ( $this ), time () + (900), "/" ); // 900s = 15m
				                                                                 // echo "add cookies";
				return TRUE; // true
			}
			echo "password incorrect";
			return FALSE; // false
		} else {
			echo "\$result empty in isExist()";
			return FALSE; // false
		}
	}
	public function isLogin() {
		if (isset ( $_COOKIE ['user'] )) {
			$user = unserialize ( $_COOKIE ['user'] );
			setcookie ( 'user', serialize ( $user ), time () + (900), "/" );
			// echo "islogin:true<br>";
			return TRUE; // $user->isExist();
		}
		// echo "islogin:false<br>";
		return FALSE;
	}
	public function prepare($result) {
		$this->id = $result ['id'];
		$this->name = $result ['name'];
		$this->status = $result ['status'];
		$this->address = $result ['address'];
		$this->password = $result ['password'];
		$this->username = $result ['username'];
		$this->cache = $result ['cache'];
		$this->modifydate = $result ['modifydate'];
		$this->createdate = $result ['createdate'];
		$this->editedby = $result ['editedby'];
	}
	public function getStringStatus($value) {
		if (self::STATUS_ADMIN == $value) {
			return "Administrator";
		}
		return null;
	}
	public function dataTable() {
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
							return "<input type='radio' value='$d' class='i-grey' name='i-grey-radio' checked>";
						}
						
				),
				array (
						'db' => 'name',
						'dt' => 1 
				),
				array (
						'db' => 'status',
						'dt' => 2,
						'formatter' => function ($d, $row) {
							return $this->getStringStatus ( $d );
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
		// SQL server connection information
		$sql_details = array (
				'user' => DB_USERNAME,
				'pass' => DB_PASSWORD,
				'db' => DB_DATABASE,
				'host' => DB_SERVER 
		);
		require( 'ssp.class.php' );
		echo json_encode(
				SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	}
}
?>