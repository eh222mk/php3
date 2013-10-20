<?php

class LoginView{
	
	//Variables to avoid string dependancy
	private static $username = "username";
	private static $password = "password";
	private static $autologin = "autologin";
	private static $logout = "logout";
	private static $loginButton = "loginButton";
	private static $logoutButton = "logoutButton";

	private $feedbackMessage = "";
	private $userName = "";
	
	public function setFeedbackMessage($feedbackMessage){
		$this->feedbackMessage = $feedbackMessage;
	}
	
	/**
	 * @return Boolean
	 */
	public function isLoggedInAttempt(){
		if(isset($_GET[self::$loginButton])){
			return TRUE;
		}
		return FALSE;
	}//end of method
	 
	 /**
	 * @return Boolean
	 */	
	public function isLoggedOutAttempt(){
		if(isset($_GET[self::$logoutButton])){
			return TRUE;
		}
		return FALSE;
	}//end of method

	/**
	 * @return String
	 */
	public function getUsername(){
		if(isset($_GET[self::$username])){
			$this->userName = $_GET[self::$username];
			return $_GET[self::$username];
		}
	}
	
	/**
	 * @return String
	 */	
	public function getPassword(){
		if(isset($_GET[self::$password])){
			return $_GET[self::$password];
		}	
	}
	
	/**
	 * @return String
	 */	
	public function getAutologin(){
		if(isset($_GET[self::$autologin])){
			return $_GET[self::$autologin];	
		}
	}
	
	/**
	 * @return Boolean
	 */	
	public function getLogout(){
		if(isset($_GET[self::$logout])){
			return TRUE;
		}
	}
	
	/**
	 * @param html $formValue1
	 * @param html $formValue2
	 * @param string $timeView
	 * @return html
	 */
	public function getHTML($formValue1, $formValue2, $timeView){
		$this->feedbackMessage = "";
		return "<!DOCTYPE html>
			<html lang='sv'>
			<head>
				<meta charset='utf-8' />
			</head>
			<body>
				<h1>Laboration 1 </h1>
				<h2>$formValue1</h2>
				<p>$formValue2</p>
			</body>
			<footer>
			$timeView
			<script>    
			    if(typeof window.history.pushState == 'function') {
			        window.history.pushState({}, 'Hide', 'http://194.47.104.113/php/php3/');
			    }
			</script>
			</footer>";	//script taken from internet.
	}
	
	/**
	 * @param boolean $isLoggedIn
	 * @param string $usernameOutput
	 * @return html
	 */
	public function getForm($isLoggedIn){
		$returnValues;
		if($isLoggedIn){
			$returnValues[0] = "Inloggad som Admin";
			$returnValues[1] = "<form id='logoutForm' method='GET' action=''>
									<p>$this->feedbackMessage</p>
									<input type='hidden' name='logout' value='Du har nu loggat ut'></input>
									<input type ='submit' value='Logga ut' name=" . self::$logoutButton . "></input>
								</form>";
		} else{
			$returnValues[0] = "Ej Inloggad";
			$returnValues[1] = $returnValues[1] = "
			<form id='loginForm' method='GET' action=''>
			<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend> 
				<p>$this->feedbackMessage</p>
				<p>Användarnamn: <input type='text' id='usernameID' name=" . self::$username . " value='$this->userName'> </input>
				 Lösenord: <input type='password' id='passwordID' name=" . self::$password ."></input> 
				 Håll mig inloggad: <input type='checkbox' id='autologinID' name=" . self::$autologin ." value='value1'></input> 
				 <input type='submit' value='Logga in' name=" . self::$loginButton . "></input>
				</fieldset>
			</form>	";
		}//end of else
		return $returnValues;
	}//end of method

	/**
	 * @param int $feedback
	 */
	public function translateFeedback($feedback){
		switch ($feedback) {
			case 1: $this->feedbackMessage = "<p>Användarnamn saknas</p>"; break;
			case 2: $this->feedbackMessage = "<p>Lösenord saknas</p>"; break;
			case 3: $this->feedbackMessage = "<p>Felaktigt användarnamn och/eller lösenord</p>"; break;
			case 4: $this->feedbackMessage = "<p>Du har nu loggat in och vi kommer ihåg dig nästa gång</p>"; break;			
			case 5: $this->feedbackMessage = "<p>Du har nu loggat in</p>"; break;
			case 6: $this->feedbackMessage = "<p>Du har nu loggat ut"; break;
			
		}//end of switch
	}

}//end of class
