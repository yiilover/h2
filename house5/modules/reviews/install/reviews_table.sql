DROP TABLE IF EXISTS `v9_reviews_table`;
CREATE TABLE IF NOT EXISTS `v9_reviews_table` (
  `tableid` mediumint(8) NOT NULL auto_increment,
  `total` int(10) unsigned default '0',
  `creat_at` int(10) default '0',
  PRIMARY KEY  (`tableid`)
) TYPE=MyISAM;
INSERT INTO `v9_reviews_table` (`tableid`, `total`, `creat_at`) VALUES (1, 0, 0);
