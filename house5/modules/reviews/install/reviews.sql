DROP TABLE IF EXISTS `v9_reviews`;
CREATE TABLE IF NOT EXISTS `v9_reviews` (
  `reviewsid` char(30) NOT NULL,
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `total` int(8) unsigned DEFAULT '0',
  `star1` tinyint(1) unsigned DEFAULT '0',
  `star2` tinyint(1) unsigned DEFAULT '0',
  `star3` tinyint(1) unsigned DEFAULT '0',
  `star4` tinyint(1) unsigned DEFAULT '0',
  `star5` tinyint(1) unsigned DEFAULT '0',
  `star6` tinyint(1) unsigned DEFAULT '0',
  `allstar` tinyint(1) unsigned DEFAULT '0',
  `startype` tinyint(1) unsigned  NOT NULL DEFAULT '1',
  `starnum` tinyint(1) unsigned  NOT NULL DEFAULT '1',
  `tableid` mediumint(8) unsigned DEFAULT '0',
  `lastupdate` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`reviewsid`),
  KEY `lastupdate` (`lastupdate`),
  KEY `siteid` (`siteid`)
) TYPE=MyISAM;