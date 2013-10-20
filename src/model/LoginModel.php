<?php

class LoginModel{
	
	//Variables to avoid string dependancy
	private static $cookieTimeFile = "CookieTime.txt";
	
	private $ifSetCookies = false;
	private $ifUnsetCookies = false;
	
	private static $sessionUser = "username";
	
	private static $username = "username";
	private static $password = "password";
	private static $autologin = "autologin";
	private static $logout = "logout";
	
	public static $feedbackMessage = 0; 
	
	
	public function getIfSetCookies(){
		return $this->ifSetCookies;
	}
	
	public function getIfUnsetCookies(){
		return $this->ifUnsetCookies;
	}
	
	public function setIfSetCookies(){
		$this->ifSetCookies = false;
	}

	public function setIfUnsetCookies(){
		$this->ifUnsetCookies = false;
	}
	
	public function getCookieTimeFile(){
		return self::$cookieTimeFile;
	}
	
	
	/**
	 * @param Array $loginValues
	 * check the user form input
	 */	
	public function checkUserCredential(LoginValues $loginValues){
	
		if($loginValues->getLogout() == true){
			$this->logout();
		}
		else{
			if($loginValues->getUsername() == ""){				
				self::$feedbackMessage = 1;
			}
			else if($loginValues->getPassword() == ""){
					self::$feedbackMessage = 2;
			}
			else if($loginValues->getUsername() == "Admin" 
					&& $loginValues->getPassword() == "Password"){
				$this->LoginUser($loginValues);
			}
			else{
				self::$feedbackMessage = 3;
			}
		}
		
	}//end of method
	
	/**
	 * set cookies and session values
	 * @param array $loginValues
	 */	
	private function loginUser($loginValues){
		if($loginValues->getAutologin() == true){
			self::$feedbackMessage = 4;
			
			$this->ifSetCookies = true;
			$endTime = time()+120;
			file_put_contents(self::$cookieTimeFile, $endTime);
		}
		else{
			self::$feedbackMessage = 5;	
		}
		$_SESSION["userClient"] = $_SERVER["HTTP_USER_AGENT"];
		$_SESSION["userIp"] = $_SERVER["REMOTE_ADDR"];
		$this->startSession();
	}//end of method
	
	public function startSession(){
		$_SESSION[self::$sessionUser] = self::$sessionUser;
	}
	
	/**
	 * removes cookies and session
	 */
	private function logout(){
		self::$feedbackMessage = 6;
		$this->ifUnsetCookies = true;
		unset($_SESSION[self::$sessionUser]);
	}

	/**
	 * @return boolean
	 */
	public function ifLoggedIn(){
		if($this->checkSessionTheft() == FALSE){
			return false;
		}	
		if(isset($_SESSION[self::$sessionUser])){
			return true;
		}	
		return false;
	}//end of method

	/**
	 * @return boolen
	 */
	private function checkSessionTheft(){
		
		if(isset($_SESSION["userClient"]) 
			&& $_SESSION["userClient"] 
			!= $_SERVER["HTTP_USER_AGENT"]){
				
			return false;
		}
		else if(isset($_SESSION["userIp"]) 
				&& $_SESSION["userIp"] 
				!= $_SERVER["REMOTE_ADDR"]){
					
			return false;
		}
		else{
			return true;
		}
	}
	
}//end of class
