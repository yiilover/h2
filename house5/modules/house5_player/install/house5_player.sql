DROP TABLE IF EXISTS `h5_player`;
CREATE TABLE IF NOT EXISTS `h5_player` (
	`id` tinyint(1) not null default '1',
	`video_type` tinyint(1) NOT NULL default '0',
	`video_default_status` tinyint(1) NOT NULL default '1',
	`ck_http_set` tinyint(1) NOT NULL default '0',
	`video_url` char(255) NULL,
	`ck_style` char(100) NULL,
	`thumb_load` varchar(100) NULL,
	`thumb_pause_ad` varchar(100) NULL,
	`url_pause_ad` char(255) NULL,
	`thumb_qz_ad` varchar(100) NULL,
	`url_qz_ad` char(255) NULL,
	`time_qz_ad` char(50) NULL,
	`beff_ad` char(255) NULL,
	`text_ad` text null,
	`ck_volume` char(2) not NULL default '80',
	`ck_size` char(10) not NULL default '600|400',
	`ck_html5` tinyint(1) NOT NULL default '0'
) TYPE=MyISAM;

INSERT INTO  `h5_player` (
`id`,
`video_type` ,
`video_default_status` ,
`ck_http_set` ,
`video_url` ,
`ck_style` ,
`thumb_load` ,
`thumb_pause_ad` ,
`url_pause_ad`,
`thumb_qz_ad` ,
`url_qz_ad` ,
`time_qz_ad` ,
`beff_ad` ,
`text_ad`,
`ck_volume` ,
`ck_size` ,
`ck_html5`
)
VALUES (
1,1, 1,0, NULL , NULL , NULL , NULL , NULL , NULL, NULL , NULL , NULL , NULL ,  80,  '600|400',0
)