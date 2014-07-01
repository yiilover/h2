DROP TABLE IF EXISTS `v9_reviews_setting`;
CREATE TABLE IF NOT EXISTS `v9_reviews_setting` (
  `siteid` smallint(5) NOT NULL default '0',
  `guest` tinyint(1) default '0',
  `check` tinyint(1) default '0',
  `code` tinyint(1) default '0',
  `add_point`  tinyint(3) UNSIGNED NULL DEFAULT '0',
  `del_point`  tinyint(3) UNSIGNED NULL DEFAULT '0',
  PRIMARY KEY  (`siteid`)
) TYPE=MyISAM;
INSERT INTO `v9_reviews_setting` (`siteid`, `guest`, `check`, `code`, `add_point`, `del_point`) VALUES (1, 0, 0, 0, 0, 0);
