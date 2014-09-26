<?php

////////////////////////////////////////////Don't change these settings unless you know what you're doing !///////////////////////////////////////////////
$os = ((strpos(strtolower(PHP_OS), 'win') === 0) || (strpos(strtolower(PHP_OS), 'cygwin') !== false)) ? 'w' : 'u';
switch ($os) {
    case 'w': define('DS','/');break;
    default : define('DS','\\');break;}
    define('ROOT_PATH', __DIR__.DS);
    define("CORE_PATH",ROOT_PATH."CORE".DS);
    define("CIA_PATH",ROOT_PATH."CIA".DS);
    define("CORE_LOG",ROOT_PATH."LOG/ScriptLog.log");
//////////////////////////////////////////Don't change these settings unless you know what you're doing !////////////////////////////////////////////////////////
    

// FINAL USER CONFIGURATION

/**
 * Site name, only the name of your site ( 'll need in case you decide to do to receive emails from the system control )
 */
define("SITE_NAME","TEST SITE 2014");     
/**
 * RAP => Root Application Path (is the root folder of the application you want to control).
 */
define("RAP",ROOT_PATH."TEST_APP".DS);
/**
 * FIRST_LAUCH => is the "switch" that MUST be active (true) during the first launch of the script Dip_Scan.php .
 */
define("CREATE_OR_UPDATE",false);

/**
 * PERSONAL KEY => Define a 32-byte (64 character) hexadecimal encryption key 
 * VERY IMPORTANT:Don't change the hash algoritm, only the key string
 * 
 * Caution:
    The secret key must be the same one used to create the ultimate control file.
    You can change the secret key, but ONLY BEFORE the creation of a new control file
    Then follows a scheme to better understand the operation:
    
    How to create a control file:
        1-Decide the secret key and put it in the config file (PERSONAL_SECRET_KEY)
        2-Set true the value of the constant "CREATE_OR_UPDATE"
        3-Launch the script (Dip_Scan.php).
        4-Remove the secret key from the config file for security
    
    How to control:
        1-I enter in the config file the secret key used to create the control file
        2-I modify the value of the constant to false "CREATE_OR_UPDATE"
        3-Launch the script (Dip_Scan.php).
        4-gate the secret key from the config file for security
 */
define("PERSONAL_SECRET_KEY",hash('sha256',"THIS IS MY INCREDIBLE SECURE KEY"));

/**
 *    In case of error what action to take? 
 *       Select one of the following: 
 *
 *      LOGIT => Create an error log in the path of the log 
 *      SENDMAIL => Send an email to the specified accounts 
 *      LOGNSEND => Create an error log and sends an email 
 *      LOGNSENDNPATCHIT => Create an error log, sends an email and put online the emergency page (In this case, select the emergency page)
 *          Please note: if you select this last option, in case of error, the emergency page will be copied to the root of your application and renamed in index.php
 *                       This will create a copy of your index renamed "index.<ext>.bak", make sure the script has the necessary rights.
 */
define("ERROR_ACTION","LOGNSENDNPATCHIT");
define("EMERGENCY_PAGE",ROOT_PATH."EmergencyPage.php");
define("APP_INDEX_PAGE",RAP."index.php");

/**
 * Path where the log are created
 */
define("LOG_PATH",ROOT_PATH."LOG".DS);

/**
 * Email addresses, if you choose to receive the alerts via email.
 */
define("EMAIL_ADDRESSES","test@test.com;test2@test.com");
define("EMAIL_FROM","webmaster@example.com");
define("EMAIL_REPLYTO","webmaster@example.com");
define("EMAIL_SUBJECT","Defacing detected for the site:".SITE_NAME);
