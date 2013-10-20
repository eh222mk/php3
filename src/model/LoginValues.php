<?php

class LoginValues{
	
	private $username = null;
	private $password = null;
	private $autologin = null;
	private $logout = null;
	
	public function getUsername(){
		return $this->username;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getAutologin(){
		return $this->autologin;
	}
	public function getlogout(){
		return $this->logout;
	}
	
	public function setUsername($username){
		$this->username = $username;
	}
	public function setPassword($password){
		$this->password = $password;
	}
	public function setAutologin($autologin){
		$this->autologin = $autologin;
	}
	public function setLogout($logout){
		$this->logout = $logout;
	}
}
