<?php

class TimeModel{
	
	/**
	 * @return string
	 */
	public function yearControl(){
		return 2000 + date('y' , time()); //2000 + makes so its year 2013 instead of 13		
	}
	
	/**
	 * changes month number to swedish month name
	 * @return string
	 */
	public function monthControl(){
		$month = date('m', time());
				
		//remakes $month to the month's name
		switch ($month) {
			case 1:	$month = "Januari";		break;
			case 2:	$month = "Februari";	break;
			case 3:	$month = "Mars";		break;
			case 4:	$month = "April";		break;
			case 5:	$month = "Maj";			break;
			case 6:	$month = "Juni";		break;
			case 7:	$month = "Juli";		break;
			case 8:	$month = "Augusti";		break;
			case 9:	$month = "September";	break;
			case 10:$month = "Oktober";		break;
			case 11:$month = "November";	break;	
			case 12:$month = "December";	break;
		}
		
		return $month;
	}//end of method
	
	/**
	 * @return string
	 */
	public function dayControl(){
		$day = date('d', time());
		//if the first character in $day is 0 that character is removed
		if($day[0] == "0"){
			$day = ltrim($day, '0');	
		}
			
		return $day;
	}//end of method
	
	/**
	 * Changes weekday number to swedish weekday name
	 * @return string
	 */
	public function weekdayControl(){
		$weekday = date('w', time());
		//remakes $weekday to the weekdays name
		switch($weekday){
			case 0:	$weekday = "Söndag"; break;
			case 1:	$weekday = "Måndag"; break;
			case 2:	$weekday = "Tisdag"; break;	
			case 3:	$weekday = "Onsdag"; break;
			case 4:	$weekday = "Torsdag";break;
			case 5:	$weekday = "Fredag"; break;
			case 6:	$weekday = "Lördag"; break;
		}			
		
		return $weekday; 
	}//end of method
	
	/**
	 * @return string
	 */
	public function timeControl(){
		return date('H:i:s', time()+7200);//+7200 adds 2 hours so the time is correct for the timezone
	}//end of method
}
