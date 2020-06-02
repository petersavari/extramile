 <?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
/// Test test
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Set flag that this is a parent file.
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);
error_reporting(0);
if (file_exists(dirname(__FILE__) . '/defines.php')) {
	include_once dirname(__FILE__) . '/defines.php';
}
if (!defined('_JDEFINES')) {
	define('JPATH_BASE', dirname(__FILE__));
	require_once JPATH_BASE.'/includes/defines.php';
}
require_once JPATH_BASE.'/includes/framework.php';

// Mark afterLoad in the profiler.
JDEBUG ? $_PROFILER->mark('afterLoad') : null;
	// student array declaration
	$data=$_POST;
	$arrayValues=(array) $data;
//	print_r($data);
//	exit("123");
	/**
	$arrayValues['ano']="632";	$arrayValues['adate']="";	$arrayValues['firstname']="nelson api";	$arrayValues['middlename']="";
	$arrayValues['lastename']="";	$arrayValues['initial']="";	$arrayValues['dob']="";	$arrayValues['gender']="";	$arrayValues['caste']="";
	$arrayValues['bloodgroup']="";	$arrayValues['mothertongue']="";	$arrayValues['religion']="";	$arrayValues['identification1']="";
	$arrayValues['fathername']="";	$arrayValues['fatherocc']="";	$arrayValues['fathermobile']="9620657203";	$arrayValues['fatheremail']="";
	$arrayValues['mothername']="";	$arrayValues['motherocc']="";	$arrayValues['mothermobile']="";	$arrayValues['motheremail']="";
	$arrayValues['address']="";	$arrayValues['place']="";	$arrayValues['city']="";	$arrayValues['pincode']="";	$arrayValues['district']="";
	$arrayValues['state']="";	$arrayValues['country']="";	$arrayValues['courseid']="61";	$arrayValues['pphoto']="";	$arrayValues['guardian']="";
	$arrayValues['groupid']="3";**/
	
	if($arrayValues['task']=="sendmail")
	{
		$name=$arrayValues['name'];
		$mobileno=$arrayValues['mobileno'];
		$emailid=$arrayValues['emailid'];
		$message=$arrayValues['message'];
	//	print_r($arrayValues);
	   	sendmail($name,$emailid,$mobileno,$message);
//	exit();
	}
		$name=$data['dj_name'];
                $mobileno=$data['dj_mobileno'];
                $emailid=$data['dj_emailid'];
                $message=$data['dj_message'];
        //      print_r($arrayValues);
                sendmail($name,$emailid,$mobileno,$message);

	

	function sendmail($name,$emailid,$mobileno,$message)
	{
		$m=JFactory::getMailer();
		$subject=$name." - Admission Enquiry";
		$config = JFactory::getConfig();
		$sender = array( 
					$config->get('mailfrom'),
					$config->get('fromname')
					);
//		echo '<pre>';print_r($m);
//		print_r($config);exit;
		$m->setSender($sender);
		$toaddress=$emailid;
		$to = array($toaddress);
		$m->addRecipient($to);
		$subject=$subject;
		$m->setSubject('Email Id: '.$emailid.' Mobile No: '.$mobileno.' - '.$subject); 
		$m->isHTML(true);
		$m->Encoding='base64';
		$m->setBody($message);
		$send = $m->Send();
print_r($send);exit;
		if($send != TRUE)
		{
			//echo "Message Send Succesfully";	
			echo "Could Not Send Succesfully";	
		}else{
			//return 1;		
			//echo "Could Not Send Succesfully";	
			echo "Message Send Succesfully";	
		}
	}

   ?>


