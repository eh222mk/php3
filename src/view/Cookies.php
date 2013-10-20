<?php

class Cookies{
		
	private static $salt = "orewaErikudesu93";
	private static $usernameCookie = "usernameCookie";
	private static $passwordCookie = "passwordCookie";
	private static $cookieLocation = "/php/php3";
		
	private $view;
		
	public function __construct(LoginView $view){
		$this->view = $view;
	}	
	
	public function setCookies(){
		$tempPassword = "";
		$tempPassword = crypt($this->view->getPassword().$this->view->getUsername(), self::$salt);
		
		setcookie(self::$usernameCookie, $this->view->getUsername(), time()+120, self::$cookieLocation);
		setcookie(self::$passwordCookie, $tempPassword, time()+120, self::$cookieLocation);
	}
	
	public function unsetCookies(){
		setcookie(self::$usernameCookie, "", time()-100, self::$cookieLocation);
		setcookie(self::$passwordCookie, "", time()-100, self::$cookieLocation);
		unset($_COOKIE[self::$usernameCookie]);
		unset($_COOKIE[self::$passwordCookie]);
	}
	
	/**
	 * @return boolean
	 */
	public function checkValidCookies($cookieTimeFile){
		
		if(isset($_COOKIE[self::$usernameCookie]) && isset($_COOKIE[self::$passwordCookie])){
			if($_COOKIE[self::$passwordCookie] == crypt("Password"."Admin", self::$salt)){ //better solution? = $this->view->getPassword().$this->view->getUsername()
				if(time() <=  file_get_contents($cookieTimeFile)){
					$this->view->setFeedbackMessage("Inloggning lyckades med Cookies");
					return true;
				}
			}
			$this->view->setFeedbackMessage("Felaktig information i cookie");	
			$this->unsetCookies();	
		}	
		
		return false;
	}//end of method 
}
