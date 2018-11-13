<?php
class User {
	public $id;
	public $firstname;
	public $lastname;
	public $password;
	public function Update(){
		$conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
		mysqli_query($conn,"update users set firstname='{$this->firstname}',lastname='{$this->lastname}',password='{$this->password}' where id = {$this->id}");
	}
	public function Insert(){
		$conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
		mysqli_query($conn,"insert into users values(null,'{$this->firstname}','{$this->lastname}','{$this->password}')");
	}
	public static function CheckUser($username,$password){
		$conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
		$res = mysqli_query($conn,"select * from users where firstname='{$username}' and password = '{$password}' limit 1 ");
		$user = mysqli_fetch_object($res,"User");
		return $user;
	}
}
