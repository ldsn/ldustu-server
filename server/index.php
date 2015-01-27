<?php
define("APP_PATH",dirname(__FILE__).'/LdsnCMS');
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
require(APP_PATH."/config.php");
require(SP_PATH."/SpeedPHP.php");
import(APP_PATH.'/include/functions.php');
spRun();