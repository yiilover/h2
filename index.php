<?php

define('HOUSE5_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
include HOUSE5_PATH.'/house5/base.php';
if(!file_exists(CACHE_PATH.'install.lock')) header('location:install/');
h5_base::creat_app();
?>