<?php

defined('IN_ADMIN') or exit('No permission resources.');
$defaultvalue = isset($_POST['setting']['defaultvalue']) ?$_POST['setting']['defaultvalue'] : '';
$minnumber = isset($_POST['setting']['minnumber']) ?$_POST['setting']['minnumber'] : 1;
$decimaldigits = isset($_POST['setting']['decimaldigits']) ?$_POST['setting']['decimaldigits'] : '';
switch($field_type) {
case 'varchar':
if(!$maxlength) $maxlength = 255;
$maxlength = min($maxlength,255);
$sql = "ALTER TABLE `$tablename` ADD `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$defaultvalue'";
if (!$unrunsql) $this->db->query($sql);
break;
case 'tinyint':
if(!$maxlength) $maxlength = 3;
$minnumber = intval($minnumber);
$defaultvalue = intval($defaultvalue);
$sql = "ALTER TABLE `$tablename` ADD `$field` TINYINT( $maxlength ) ".($minnumber >= 0 ?'UNSIGNED': '')." NOT NULL DEFAULT '$defaultvalue'";
if (!$unrunsql) $this->db->query($sql);
break;
case 'number':
$minnumber = intval($minnumber);
$defaultvalue = $decimaldigits == 0 ?intval($defaultvalue) : floatval($defaultvalue);
$sql = "ALTER TABLE `$tablename` ADD `$field` ".($decimaldigits == 0 ?'INT': 'FLOAT')." ".($minnumber >= 0 ?'UNSIGNED': '')." NOT NULL DEFAULT '$defaultvalue'";
if (!$unrunsql) $this->db->query($sql);
break;
case 'smallint':
$minnumber = intval($minnumber);
$sql = "ALTER TABLE `$tablename` ADD `$field` SMALLINT ".($minnumber >= 0 ?'UNSIGNED': '')." NOT NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'int':
$minnumber = intval($minnumber);
$defaultvalue = intval($defaultvalue);
$sql = "ALTER TABLE `$tablename` ADD `$field` INT ".($minnumber >= 0 ?'UNSIGNED': '')." NOT NULL DEFAULT '$defaultvalue'";
if (!$unrunsql) $this->db->query($sql);
break;
case 'mediumint':
$minnumber = intval($minnumber);
$defaultvalue = intval($defaultvalue);
$sql = "ALTER TABLE `$tablename` ADD `$field` INT ".($minnumber >= 0 ?'UNSIGNED': '')." NOT NULL DEFAULT '$defaultvalue'";
if (!$unrunsql) $this->db->query($sql);
break;
case 'mediumtext':
$sql = "ALTER TABLE `$tablename` ADD `$field` MEDIUMTEXT NOT NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'text':
$sql = "ALTER TABLE `$tablename` ADD `$field` TEXT NOT NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'date':
$sql = "ALTER TABLE `$tablename` ADD `$field` DATE NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'datetime':
$sql = "ALTER TABLE `$tablename` ADD `$field` DATETIME NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'timestamp':
$sql = "ALTER TABLE `$tablename` ADD `$field` TIMESTAMP NOT NULL";
if (!$unrunsql) $this->db->query($sql);
break;
case 'pages':
$this->db->query("ALTER TABLE `$tablename` ADD `paginationtype` TINYINT( 1 ) NOT NULL DEFAULT '0'");
$this->db->query("ALTER TABLE `$tablename` ADD `maxcharperpage` MEDIUMINT( 6 ) NOT NULL DEFAULT '0'");
break;
case 'readpoint':
$defaultvalue = intval($defaultvalue);
$this->db->query("ALTER TABLE `$tablename` ADD `readpoint` smallint(5) unsigned NOT NULL default '$defaultvalue'");
$this->db->query("ALTER TABLE `$tablename` ADD `paytype` tinyint(1) unsigned NOT NULL default '0'");
break;
}
?>