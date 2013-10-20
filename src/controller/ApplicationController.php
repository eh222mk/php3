<?php

require_once("/src/model/LoginValues.php");

class ApplicationController{
	
	private $View;
	private $Model;
	private $Cookies;
	
	public function __construct(){
		$this->View = new LoginView();
		$this->Model = new LoginModel();
		$this->Cookies = new Cookies($this->View);
	}
	
	/**
	 * @return html
	 */
	public function masterController(){

		$this->loginController();
		$HTML = $this->loggedinCheck();
		return $HTML;
	
	}
	

	private function loginController(){
		$loginValues = $this->getLoginValues();
		if($this->View->isLoggedInAttempt() || $this->View->isLoggedOutAttempt()){
			$this->Model->checkUserCredential($loginValues);	
		}
		
		$this->cookieController();
	}
	
	private function cookieController(){
		if($this->Model->getIfSetCookies()){
			$this->Cookies->setCookies();
			$this->Model->setIfSetCookies();
		}
		else if($this->Model->getIfUnsetCookies()){
			$this->Cookies->unsetCookies();
			$this->Model->setIfUnsetCookies();
		}
	}

	/**
	 * @return html
	 */
	private function loggedinCheck(){
		$cookieTimeFile = $this->Model->getCookieTimeFile();
		
		$feedbackMessage = $this->View->translateFeedback(LoginModel::$feedbackMessage);
		if($this->Model->ifLoggedin()){
			return $this->getPage(TRUE, $feedbackMessage);
		}
		else if($this->Cookies->checkValidCookies($cookieTimeFile)){
			$this->Model->startSession();
			return $this->getPage(TRUE);
		}
		return $this->getPage(FALSE, $feedbackMessage);
	}
	
	/**
	 * @return HTML
	 * @param boolean $isLoggedIn
	 * @param string $feedbackMessage
	 */
	private function getPage($isLoggedIn, $feedbackMessage = ""){
		
		if($feedbackMessage != ""){
			$this->View->setFeedbackMessage($feedbackMessage);
		}
		$formValues = $this->View->getForm($isLoggedIn);
		
		$HTML = $this->View->getHTML($formValues[0], $formValues[1], $this->getTime());
		return $HTML;
	}
	
	
	/**
	 * @return array $formValues
	 */
	private function getLoginValues(){
		$loginValues = new LoginValues();
		
		$loginValues->setUsername($this->View->getUsername());
		$loginValues->setPassword($this->View->getPassword());
		$loginValues->setAutologin($this->View->getAutologin());
		$loginValues->setLogout($this->View->getLogout());
			
		return $loginValues;
	}
	
	/**
	 * @return string $time
	 */
	private function getTime(){
		
		$timeControl = new TimeModel();
		
		$year = $timeControl->yearControl();
		$month = $timeControl->monthControl();
		$day = $timeControl->dayControl();
		$weekday = $timeControl->weekdayControl();
		$time = $timeControl->timeControl();
		
		$returnValue =  "<p>$weekday, den $day $month år $year. Klockan är [$time] </p>";
		
		return $returnValue;
	}

}//end of class
