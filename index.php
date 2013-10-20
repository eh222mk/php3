<?php

require_once("src/controller/ApplicationController.php");
require_once("src/model/LoginModel.php");
require_once("src/model/TimeModel.php");
require_once("src/view/LoginView.php");
require_once("src/view/Cookies.php");

ini_set("session.cookie_path", "/php/php3");

session_start(ini_get("session.cookie_path"));

$applicationController = new ApplicationController();
echo $applicationController->masterController();
