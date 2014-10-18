<?php
class User extends BaseModel {
    private $id;
    private $name;
    private $status;
    private $address;
    private $phone;
    public $username;
    public $password;

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
    public function setPhone($value) {
      $this->phone = $value;
    }
    public function setName($value) {
      $this->name = $value;
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

    public function readDatabase($where=null,$params=null) {
      $this->setSQL('select * from tbuser '.$where);
      $result= $this->excuteSql(null,$params);
      return $result;
    }
    public function insertDatabase() {
      $options = ['cost' => 12];
      $params = array(
        $this->name,
        $this->status,
        $this->address,
        $this->phone,
        $this->username,
        password_hash($this->password, PASSWORD_BCRYPT, $options)
      );
      $this->excuteInsert("tbuser",
            "`name`, `status`, `address`, `phone`, `username`, `password`",
            $params,$this);
    }

    public function isExist() {
      /*$options = ['cost' => 12];
      $this->setSQL("UPDATE `tbuser` SET `password` = '".password_hash('123', PASSWORD_BCRYPT, $options)."' WHERE `tbuser`.`id` = 1");
      $result= $this->excuteSql(null,$params);*/
      $username = $this->username;
      $password = $this->password;
      $result = $this->readDatabase('where username=?',array($username));
      $this->prepare($result);
      if (!empty($result)) {
        if ( $this->username == $username && password_verify($password , $this->password) ) {
          setcookie('user', serialize($this), time() + (900), "/"); //900s = 15m
          //echo "add cookies";
          return TRUE; //true
        }
         return FALSE; //true
      } else {
        return FALSE; //false
      }
    }
    public function isLogin() {
      if (isset($_COOKIE['user'])) {
        $user = unserialize($_COOKIE['user']);
        //echo "islogin:true<br>";
        return TRUE;//$user->isExist();
      }
      //echo "islogin:false<br>";
      return FALSE;
    }
    public function prepare($result) {
      $this->id = $result['id'];
      $this->name = $result['name'];
      $this->status = $result['status'];
      $this->address = $result['address'];
      $this->password = $result['password'];
      $this->username = $result['username'];
    }

}
?>