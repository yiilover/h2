<?php
 
class session_files {
function __construct() {
$path = h5_base::load_config('system','session_n') >0 ?h5_base::load_config('system','session_n').';'.h5_base::load_config('system','session_savepath')  : h5_base::load_config('system','session_savepath');
ini_set('session.save_handler','files');
session_save_path($path);
session_start();
}
}
?>