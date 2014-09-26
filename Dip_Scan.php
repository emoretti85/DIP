<?php
include_once 'cfg.php';
require_once CORE_PATH.'Dip.class.php';
require_once CORE_PATH.'Dip.action.class.php';


// Insert OUR PERSONAL SECRET KEY BEFORE LAUCH in "cfg.php" file, 

$D = new DIP(PERSONAL_SECRET_KEY);
$Repo=$D->getResult();

if(is_string($Repo)){
    DipAction::_DO(0, $Repo);
}elseif (is_array($Repo)){
    DipAction::_DO(ERROR_ACTION, $Repo);
}

/*
 * Only for debug ;)
 * echo "<pre>";
	print_r($Repo);
 */

