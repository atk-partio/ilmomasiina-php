<?php

/* Requirements */ 
require_once("classes/Configurations.php");
require_once("classes/Page.php");
require_once("classes/SignupGadgets.php");
require_once("classes/Debugger.php");
require_once("classes/SignupGadget.php");
require_once("classes/CommonTools.php");
require_once("classes/SignupGadgetEditFormatter.php");

/* Implementations of the most critical classes */
$configurations		= new Configurations();
$page				= new Page(2);
$debugger			= new Debugger();
$database			= new Database();

/* The code */

$signupId = $request->getSignupId();
$signupGadget = new SignupGadget($signupId);

$page->addHeader("<script type=\"text/javascript\" src=\"../question_script.js\"></script>");

$page->addContent(SignupGadgetEditFormater::getSignupGadgetEditInPrintableFormat($signupGadget, true));

$page->printPage();

?>