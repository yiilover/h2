DROP TABLE IF EXISTS `v9_reviews_check`;
CREATE TABLE IF NOT EXISTS `v9_reviews_check` (
  `id` int(10) NOT NULL auto_increment,
  `reviews_data_id` int(10) default '0',
  `siteid` smallint(5) NOT NULL default '0',
  `tableid` mediumint(8) default '0',
  PRIMARY KEY  (`id`),
  KEY `siteid` (`siteid`),
  KEY `reviews_data_id` (`reviews_data_id`)
) TYPE=MyISAM;
