-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 07 月 01 日 08:07
-- 服务器版本: 5.1.32
-- PHP 版本: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `house_2`
--

-- --------------------------------------------------------

--
-- 表的结构 `h5_admin`
--

CREATE TABLE IF NOT EXISTS `h5_admin` (
  `userid` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `encrypt` varchar(6) DEFAULT NULL,
  `lastloginip` varchar(15) DEFAULT NULL,
  `lastlogintime` int(10) unsigned DEFAULT '0',
  `email` varchar(40) DEFAULT NULL,
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `card` varchar(255) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_admin`
--

INSERT INTO `h5_admin` (`userid`, `username`, `password`, `roleid`, `encrypt`, `lastloginip`, `lastlogintime`, `email`, `nickname`, `realname`, `card`, `lang`, `disabled`) VALUES
(1, 'admin', 'b8a66bc2ad045e5dbe3acf40152f146a', 1, 'aQ9bH6', '127.0.0.1', 1404198867, 'admin@house5.net', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_admin_panel`
--

CREATE TABLE IF NOT EXISTS `h5_admin_panel` (
  `menuid` mediumint(8) unsigned NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` char(32) DEFAULT NULL,
  `url` char(255) DEFAULT NULL,
  `datetime` int(10) unsigned DEFAULT '0',
  UNIQUE KEY `userid` (`menuid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_admin_panel`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_admin_role`
--

CREATE TABLE IF NOT EXISTS `h5_admin_role` (
  `roleid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`roleid`),
  KEY `listorder` (`listorder`),
  KEY `disabled` (`disabled`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `h5_admin_role`
--

INSERT INTO `h5_admin_role` (`roleid`, `rolename`, `description`, `listorder`, `disabled`) VALUES
(1, '超级管理员', '超级管理员', 0, 0),
(2, '站点管理员', '站点管理员', 0, 0),
(3, '运营总监', '运营总监', 1, 0),
(4, '总编', '总编', 5, 0),
(5, '编辑', '编辑', 1, 0),
(7, '发布人员', '发布人员', 0, 0),
(8, '新房主编', '', 9, 0),
(9, '新房编辑', '', 6, 0),
(10, '新闻主编', '', 10, 0),
(11, '新闻编辑', '', 7, 0),
(12, '管理员', '分站管理员', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_admin_role_priv`
--

CREATE TABLE IF NOT EXISTS `h5_admin_role_priv` (
  `roleid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(30) NOT NULL DEFAULT '',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  KEY `roleid` (`roleid`,`m`,`c`,`a`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_admin_role_priv`
--

INSERT INTO `h5_admin_role_priv` (`roleid`, `m`, `c`, `a`, `data`, `siteid`) VALUES
(10, 'message', 'message', 'message_send', '', 1),
(10, 'content', 'content', 'delete', '', 1),
(9, 'content', 'push', 'init', '', 1),
(9, 'link', 'link', 'add', '', 1),
(9, 'special', 'special', 'html', '', 1),
(9, 'release', 'html', 'init', '', 1),
(9, 'special', 'content', 'init', '', 1),
(9, 'special', 'special', 'import', '', 1),
(9, 'attachment', 'address', 'init', '', 1),
(9, 'content', 'content', 'move', '', 1),
(9, 'special', 'special', 'init', '', 1),
(9, 'admin', 'module', '', '', 1),
(9, 'special', 'special', 'elite', '', 1),
(9, 'special', 'content', 'edit', '', 1),
(9, 'special', 'content', 'init', '', 1),
(9, 'release', 'index', 'del', '', 1),
(9, 'content', 'content', 'init', '', 1),
(9, 'attachment', 'manage', 'dir', '', 1),
(9, 'content', 'content', 'delete', '', 1),
(9, 'special', 'content', 'listorder', '', 1),
(9, 'special', 'content', 'add', '', 1),
(9, 'release', 'index', 'failed', '', 1),
(9, 'special', 'special', 'add', '', 1),
(9, 'attachment', 'manage', 'init', '', 1),
(9, 'content', 'create_html', 'show', '', 1),
(9, 'special', 'content', 'delete', '', 1),
(9, 'admin', 'module', 'init', '', 1),
(9, 'admin', 'cache_all', 'init', '', 1),
(9, 'admin', 'index', 'public_main', '', 1),
(9, 'special', 'special', 'listorder', '', 1),
(9, 'release', 'index', 'init', '', 1),
(9, 'special', 'special', 'create_special_list', '', 1),
(9, 'link', 'link', 'edit', '', 1),
(9, 'attachment', 'manage', 'init', '', 1),
(9, 'special', 'special', 'init', '', 1),
(9, 'content', 'content', 'batch_show', '', 1),
(9, 'attachment', 'address', 'update', '', 1),
(9, 'content', 'content', 'init', '', 1),
(9, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(9, 'content', 'create_html', 'category', '', 1),
(9, 'admin', 'module', 'init', '', 1),
(9, 'content', 'content', 'listorder', '', 1),
(9, 'content', 'content', 'init', '', 1),
(9, 'formguide', 'formguide_info', 'init', 'formid=17&menuid=1546', 1),
(9, 'content', 'content', 'add', '', 1),
(8, 'link', 'link', 'delete', '', 1),
(8, 'admin', 'badword', 'delete', '', 1),
(8, 'link', 'link', 'edit', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'content', 'content', 'copyinfo', '', 1),
(8, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(8, 'release', 'html', 'init', '', 1),
(8, 'release', 'index', 'del', '', 1),
(8, 'admin', 'category', 'batch_edit', '', 1),
(8, 'special', 'special', 'edit', '', 1),
(8, 'comment', 'check', 'checks', '', 1),
(8, 'release', 'index', 'init', '', 1),
(8, 'special', 'special', 'import', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'special', 'special', 'add', '', 1),
(8, 'content', 'content', 'remove', '', 1),
(8, 'content', 'content', 'move', '', 1),
(8, 'release', 'index', 'failed', '', 1),
(8, 'admin', 'position', 'init', '', 1),
(8, 'content', 'create_html', 'public_index', '', 1),
(8, 'attachment', 'manage', 'init', '', 1),
(8, 'attachment', 'manage', 'init', '', 1),
(8, 'special', 'special', 'delete', '', 1),
(8, 'content', 'create_html', 'category', '', 1),
(8, 'special', 'content', 'listorder', '', 1),
(8, 'special', 'content', 'delete', '', 1),
(8, 'special', 'content', 'init', '', 1),
(8, 'content', 'content', 'delete', '', 1),
(8, 'content', 'create_html_opt', 'index', '', 1),
(8, 'admin', 'cache_all', 'init', '', 1),
(8, 'link', 'link', 'init', '', 1),
(8, 'content', 'create_html', 'public_index', '', 1),
(8, 'special', 'special', 'elite', '', 1),
(8, 'content', 'content', 'add_othors', '', 1),
(8, 'formguide', 'formguide_info', 'init', 'formid=20&menuid=1546', 1),
(8, 'admin', 'module', 'init', '', 1),
(8, 'content', 'content', 'listorder', '', 1),
(8, 'special', 'special', 'init', '', 1),
(8, 'content', 'create_html', 'update_urls', '', 1),
(8, 'content', 'content', 'batch_show', '', 1),
(8, 'attachment', 'address', 'init', '', 1),
(8, 'poster', 'poster', 'edit', '', 1),
(8, 'formguide', 'formguide_info', 'init', 'formid=17&menuid=1546', 1),
(8, 'admin', 'badword', 'edit', '', 1),
(8, 'special', 'content', 'add', '', 1),
(8, 'poster', 'poster', 'add', '', 1),
(8, 'admin', 'index', 'public_main', '', 1),
(8, 'content', 'content', 'init', '', 1),
(8, 'content', 'push', 'init', '', 1),
(9, 'content', 'content', 'edit', '', 1),
(9, 'content', 'content', 'add_othors', '', 1),
(9, 'link', 'link', 'init', '', 1),
(9, 'content', 'content', 'pass', '', 1),
(9, 'admin', 'admin_manage', 'init', '', 1),
(9, 'admin', 'extend', 'init_extend', '', 1),
(8, 'content', 'content', 'pass', '', 1),
(8, 'special', 'content', 'edit', '', 1),
(10, 'special', 'special', 'listorder', '', 1),
(10, 'special', 'content', 'init', '', 1),
(10, 'special', 'content', 'delete', '', 1),
(10, 'message', 'message', 'send_one', '', 1),
(10, 'content', 'create_html', 'update_urls', '', 1),
(10, 'admin', 'category', 'count_items', '', 1),
(10, 'content', 'create_html_opt', 'index', '', 1),
(10, 'admin', 'cache_all', 'init', '', 1),
(10, 'attachment', 'address', 'init', '', 1),
(10, 'content', 'content', 'move', '', 1),
(10, 'poster', 'poster', 'edit', '', 1),
(10, 'admin', 'index', 'public_main', '', 1),
(10, 'content', 'create_html', 'public_index', '', 1),
(10, 'content', 'create_html', 'show', '', 1),
(10, 'special', 'special', 'init', '', 1),
(10, 'special', 'content', 'listorder', '', 1),
(10, 'content', 'content', 'remove', '', 1),
(10, 'content', 'content_settings', 'init', '', 1),
(10, 'special', 'special', 'edit', '', 1),
(10, 'special', 'special', 'add', '', 1),
(10, 'content', 'push', 'init', '', 1),
(10, 'content', 'content', 'init', '', 1),
(10, 'content', 'content', 'pass', '', 1),
(10, 'content', 'content', 'edit', '', 1),
(10, 'comment', 'check', 'checks', '', 1),
(10, 'release', 'html', 'init', '', 1),
(10, 'special', 'special', 'init', '', 1),
(10, 'content', 'content', 'add_othors', '', 1),
(10, 'admin', 'category', 'public_cache', 'module=admin', 1),
(10, 'poster', 'poster', 'init', '', 1),
(10, 'admin', 'admin_manage', 'init', '', 1),
(10, 'content', 'content', 'init', '', 1),
(10, 'special', 'special', 'delete', '', 1),
(10, 'attachment', 'address', 'update', '', 1),
(10, 'message', 'message', 'delete', '', 1),
(10, 'content', 'content', 'init', '', 1),
(10, 'content', 'create_html', 'public_index', '', 1),
(10, 'content', 'content', 'listorder', '', 1),
(10, 'content', 'create_html', 'batch_show', '', 1),
(10, 'comment', 'comment_admin', 'listinfo', '', 1),
(10, 'poster', 'poster', 'delete', '', 1),
(10, 'message', 'message', 'message_group_manage', '', 1),
(10, 'content', 'content', 'add', '', 1),
(10, 'admin', 'position', 'init', '', 1),
(10, 'admin', 'position', 'edit', '', 1),
(10, 'content', 'content', 'init', 'catid=6', 1),
(10, 'special', 'special', 'html', '', 1),
(10, 'admin', 'module', '', '', 1),
(10, 'link', 'link', 'init', '', 1),
(10, 'link', 'link', 'add', '', 1),
(10, 'poster', 'poster', 'add', '', 1),
(10, 'content', 'create_html', 'category', '', 1),
(10, 'special', 'special', 'import', '', 1),
(10, 'admin', 'module', 'init', '', 1),
(10, 'poster', 'space', 'init', '', 1),
(11, 'content', 'content', 'add_othors', '', 1),
(11, 'admin', 'index', 'public_main', '', 1),
(11, 'admin', 'admin_manage', 'init', '', 1),
(11, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(11, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(11, 'link', 'link', 'init', '', 1),
(11, 'special', 'special', 'delete', '', 1),
(11, 'attachment', 'manage', 'init', '', 1),
(11, 'attachment', 'address', 'update', '', 1),
(11, 'attachment', 'manage', 'dir', '', 1),
(11, 'content', 'content', 'init', '', 1),
(11, 'content', 'content', 'init', '', 1),
(11, 'admin', 'cache_all', 'init', '', 1),
(11, 'content', 'content', 'delete', '', 1),
(11, 'special', 'content', 'listorder', '', 1),
(11, 'content', 'content', 'listorder', '', 1),
(11, 'content', 'content', 'add', '', 1),
(11, 'content', 'content', 'edit', '', 1),
(11, 'admin', 'module', 'init', '', 1),
(11, 'content', 'content', 'pass', '', 1),
(11, 'special', 'special', 'create_special_list', '', 1),
(11, 'special', 'special', 'listorder', '', 1),
(11, 'release', 'index', 'del', '', 1),
(11, 'content', 'create_html', 'show', '', 1),
(11, 'special', 'content', 'init', '', 1),
(11, 'release', 'index', 'init', '', 1),
(11, 'content', 'push', 'init', '', 1),
(11, 'poster', 'poster', 'add', '', 1),
(11, 'special', 'special', 'init', '', 1),
(11, 'link', 'link', 'delete', '', 1),
(11, 'release', 'html', 'init', '', 1),
(11, 'special', 'special', 'elite', '', 1),
(11, 'content', 'create_html', 'category', '', 1),
(11, 'content', 'create_html', 'update_urls', '', 1),
(11, 'attachment', 'address', 'init', '', 1),
(11, 'release', 'index', 'failed', '', 1),
(11, 'poster', 'space', 'init', '', 1),
(11, 'message', 'message', 'init', '', 1),
(11, 'content', 'content', 'init', '', 1),
(11, 'poster', 'poster', 'delete', '', 1),
(11, 'comment', 'comment_admin', 'listinfo', '', 1),
(11, 'special', 'special', 'html', '', 1),
(11, 'special', 'content', 'add', '', 1),
(11, 'special', 'special', 'init', '', 1),
(11, 'content', 'content', 'move', '', 1),
(11, 'content', 'create_html', 'public_index', '', 1),
(11, 'content', 'content', 'batch_show', '', 1),
(11, 'comment', 'check', 'checks', '', 1),
(11, 'message', 'message', 'delete', '', 1),
(11, 'special', 'content', 'delete', '', 1),
(11, 'message', 'message', 'send_one', '', 1),
(11, 'special', 'special', 'edit', '', 1),
(11, 'special', 'special', 'import', '', 1),
(11, 'special', 'content', 'init', '', 1),
(11, 'special', 'content', 'edit', '', 1),
(11, 'special', 'special', 'add', '', 1),
(8, 'comment', 'comment_admin', 'listinfo', '', 1),
(8, 'special', 'special', 'listorder', '', 1),
(8, 'content', 'create_html', 'show', '', 1),
(8, 'content', 'content', 'edit', '', 1),
(8, 'admin', 'extend_all', 'init', '', 1),
(10, 'special', 'special', 'create_special_list', '', 1),
(10, 'message', 'message', 'init', '', 1),
(8, 'poster', 'space', 'init', '', 1),
(8, 'special', 'special', 'create_special_list', '', 1),
(10, 'admin', 'category', 'batch_edit', '', 1),
(10, 'attachment', 'manage', 'init', '', 1),
(8, 'special', 'special', 'html', '', 1),
(10, 'special', 'content', 'add', '', 1),
(10, 'link', 'link', 'edit', '', 1),
(10, 'content', 'content', 'init', '', 1),
(10, 'admin', 'admin_manage', 'init', '', 1),
(10, 'special', 'content', 'edit', '', 1),
(10, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(10, 'content', 'content', 'copyinfo', '', 1),
(8, 'admin', 'category', 'count_items', '', 1),
(8, 'admin', 'extend', 'init_extend', '', 1),
(8, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(8, 'admin', 'badword', 'add', '', 1),
(8, 'admin', 'module', '', '', 1),
(8, 'content', 'content', 'add', '', 1),
(10, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(8, 'admin', 'badword', 'import', '', 1),
(8, 'special', 'special', 'init', '', 1),
(8, 'attachment', 'manage', 'dir', '', 1),
(8, 'link', 'link', 'add', '', 1),
(8, 'content', 'content_settings', 'init', '', 1),
(8, 'admin', 'admin_manage', 'init', '', 1),
(8, 'admin', 'category', 'public_cache', 'module=admin', 1),
(3, 'content', 'create_html', 'public_index', '', 1),
(3, 'admin', 'extend', 'init_extend', '', 1),
(3, 'member', 'member_verify', 'manage', 's=0', 1),
(3, 'admin', 'category', 'count_items', '', 1),
(3, 'content', 'content', 'batch_show', '', 1),
(3, 'content', 'content', 'add_othors', '', 1),
(3, 'content', 'content', 'remove', '', 1),
(3, 'content', 'content', 'edit', '', 1),
(3, 'content', 'content', 'listorder', '', 1),
(8, 'special', 'content', 'init', '', 1),
(8, 'attachment', 'address', 'update', '', 1),
(8, 'admin', 'category', 'init', 'module=admin', 1),
(3, 'content', 'create_html_opt', 'index', '', 1),
(3, 'special', 'content', 'listorder', '', 1),
(3, 'special', 'special', 'create_special_list', '', 1),
(3, 'content', 'create_html', 'update_urls', '', 1),
(3, 'special', 'special', 'import', '', 1),
(3, 'special', 'special', 'html', '', 1),
(3, 'release', 'html', 'init', '', 1),
(3, 'content', 'create_html', 'category', '', 1),
(3, 'comment', 'check', 'checks', '', 1),
(3, 'special', 'special', 'edit', '', 1),
(3, 'special', 'special', 'init', '', 1),
(3, 'special', 'content', 'edit', '', 1),
(3, 'special', 'content', 'delete', '', 1),
(3, 'special', 'special', 'add', '', 1),
(3, 'special', 'content', 'init', '', 1),
(3, 'special', 'content', 'add', '', 1),
(3, 'special', 'content', 'init', '', 1),
(3, 'special', 'special', 'listorder', '', 1),
(3, 'special', 'special', 'elite', '', 1),
(3, 'special', 'special', 'init', '', 1),
(3, 'comment', 'comment_admin', 'listinfo', '', 1),
(3, 'content', 'create_html', 'show', '', 1),
(8, 'admin', 'position', 'edit', '', 1),
(8, 'poster', 'poster', 'init', '', 1),
(3, 'admin', 'extend_all', 'init', '', 1),
(8, 'admin', 'module', 'init', '', 1),
(3, 'message', 'message', 'send_one', '', 1),
(3, 'message', 'message', 'init', '', 1),
(3, 'member', 'member_verify', 'manage', 's=1', 1),
(3, 'member', 'member', 'manage', '', 1),
(3, 'member', 'member_verify', 'manage', 's=2', 1),
(3, 'admin', 'cache_all', 'init', '', 1),
(3, 'member', 'member', 'init', '', 1),
(3, 'mood', 'mood_admin', 'init', '', 1),
(3, 'member', 'member', 'edit', '', 1),
(3, 'member', 'member', 'move', '', 1),
(3, 'link', 'link', 'list_type', '', 1),
(3, 'link', 'link', 'add', '', 1),
(3, 'link', 'link', 'init', '', 1),
(3, 'vote', 'vote', 'add', '', 1),
(3, 'vote', 'vote', 'statistics_userlist', '', 1),
(3, 'vote', 'vote', 'statistics', '', 1),
(3, 'vote', 'vote', 'setting', '', 1),
(3, 'vote', 'vote', 'create_js', '', 1),
(3, 'vote', 'vote', 'edit', '', 1),
(3, 'announce', 'admin_announce', 'init', 's=3', 1),
(3, 'link', 'link', 'edit', '', 1),
(3, 'comment', 'comment_admin', 'lists', '', 1),
(3, 'link', 'link', 'add_type', '', 1),
(3, 'vote', 'vote', 'init', '', 1),
(3, 'comment', 'comment_admin', 'init', '', 1),
(3, 'member', 'member_verify', 'manage', 's=3', 1),
(3, 'member', 'member_verify', 'manage', 's=5', 1),
(3, 'member', 'member_verify', 'modelinfo', '', 1),
(3, 'member', 'member', 'manage', '', 1),
(3, 'member', 'member_verify', 'reject', '', 1),
(3, 'member', 'member_verify', 'manage', 's=4', 1),
(3, 'member', 'member', 'add', '', 1),
(3, 'member', 'member_verify', 'ignore', '', 1),
(3, 'member', 'member_verify', 'delete', '', 1),
(3, 'member', 'member_verify', 'pass', '', 1),
(3, 'content', 'content', 'init', '', 1),
(3, 'content', 'content', 'init', '', 1),
(3, 'content', 'content', 'init', '', 1),
(3, 'poster', 'poster', 'edit', '', 1),
(3, 'poster', 'poster', 'init', '', 1),
(3, 'poster', 'space', 'init', '', 1),
(3, 'poster', 'poster', 'add', '', 1),
(3, 'mood', 'mood_admin', 'setting', '', 1),
(3, 'content', 'content', 'add', '', 1),
(3, 'content', 'content', 'pass', '', 1),
(3, 'announce', 'admin_announce', 'edit', 's=1', 1),
(3, 'admin', 'admin_manage', 'init', '', 1),
(3, 'admin', 'module', 'init', '', 1),
(3, 'admin', 'module', '', '', 1),
(3, 'announce', 'admin_announce', 'add', '', 1),
(3, 'announce', 'admin_announce', 'init', 's=1', 1),
(3, 'announce', 'admin_announce', 'init', 's=2', 1),
(3, 'admin', 'module', 'init', '', 1),
(3, 'content', 'create_html', 'public_index', '', 1),
(3, 'admin', 'category', 'init', 'module=admin', 1),
(3, 'admin', 'position', 'add', '', 1),
(3, 'admin', 'position', 'init', '', 1),
(3, 'admin', 'category', 'public_cache', 'module=admin', 1),
(3, 'content', 'content_settings', 'init', '', 1),
(3, 'member', 'member', 'lock', '', 1),
(3, 'member', 'member', 'search', '', 1),
(3, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(3, 'admin', 'index', 'public_main', '', 1),
(3, 'member', 'member_setting', 'manage', '', 1),
(3, 'admin', 'admin_manage', 'init', '', 1),
(3, 'admin', 'admin_manage', 'public_edit_info', '', 1),
(3, 'member', 'member', 'memberinfo', '', 1),
(3, 'message', 'message', 'message_send', '', 1),
(3, 'message', 'message', 'message_group_manage', '', 1),
(3, 'message', 'message', 'delete', '', 1),
(8, 'admin', 'badword', 'init', '', 1),
(12, 'upgrade', 'index', 'checkfile', '', 2),
(12, 'upgrade', 'index', 'init', '', 2),
(12, 'member', 'member_menu', 'delete', '', 2),
(12, 'member', 'member_menu', 'edit', '', 2),
(12, 'member', 'member_menu', 'add', '', 2),
(12, 'member', 'member_menu', 'manage', '', 2),
(12, 'cnzz', 'index', 'init', '', 2),
(12, 'admin', 'copyfrom', 'init', '', 2),
(12, 'scan', 'index', 'md5_creat', '', 2),
(12, 'scan', 'index', 'scan_report', '', 2),
(12, 'scan', 'index', 'init', '', 2),
(12, 'admin', 'log', 'delete', '', 2),
(12, 'admin', 'log', 'init', '', 2),
(12, 'admin', 'downservers', 'init', '', 2),
(12, 'admin', 'ipbanned', 'delete', '', 2),
(12, 'admin', 'ipbanned', 'add', '', 2),
(12, 'admin', 'ipbanned', 'init', '', 2),
(12, 'admin', 'keylink', 'edit', '', 2),
(12, 'admin', 'keylink', 'delete', '', 2),
(12, 'admin', 'keylink', 'add', '', 2),
(12, 'admin', 'keylink', 'init', '', 2),
(12, 'admin', 'googlesitemap', 'set', '', 2),
(12, 'admin', 'urlrule', 'delete', '', 2),
(12, 'admin', 'urlrule', 'edit', '', 2),
(12, 'admin', 'urlrule', 'add', '', 2),
(12, 'admin', 'urlrule', 'init', '', 2),
(12, 'admin', 'database', 'import', '', 2),
(12, 'admin', 'database', 'export', '', 2),
(12, 'admin', 'database', 'export', '', 2),
(12, 'content', 'workflow', 'delete', '', 2),
(12, 'content', 'workflow', 'edit', '', 2),
(12, 'content', 'workflow', 'add', '', 2),
(12, 'content', 'workflow', 'init', '', 2),
(12, 'admin', 'linkage', 'add', '', 2),
(12, 'admin', 'linkage', 'init', '', 2),
(12, 'admin', 'badword', 'delete', '', 2),
(12, 'admin', 'badword', 'edit', '', 2),
(12, 'admin', 'badword', 'add', '', 2),
(12, 'admin', 'badword', 'import', '', 2),
(12, 'admin', 'badword', 'export', '', 2),
(12, 'admin', 'badword', 'init', '', 2),
(12, 'admin', 'menu', 'delete', '', 2),
(12, 'admin', 'menu', 'edit', '', 2),
(12, 'admin', 'menu', 'add', '', 2),
(12, 'admin', 'menu', 'init', '', 2),
(12, 'admin', 'extend_all', 'init', '', 2),
(12, 'admin', 'extend', 'init_extend', '', 2),
(12, 'content', 'create_html', 'public_index', '', 2),
(12, 'content', 'create_html_opt', 'index', '', 2),
(12, 'message', 'message', 'message_group_manage', '', 2),
(12, 'message', 'message', 'message_send', '', 2),
(12, 'message', 'message', 'delete', '', 2),
(12, 'message', 'message', 'send_one', '', 2),
(12, 'message', 'message', 'init', '', 2),
(12, 'admin', 'admin_manage', 'public_edit_info', '', 2),
(12, 'admin', 'admin_manage', 'public_edit_pwd', '', 2),
(12, 'admin', 'admin_manage', 'init', '', 2),
(12, 'admin', 'index', 'public_main', '', 2),
(12, 'member', 'member_group', 'sort', '', 2),
(12, 'member', 'member_group', 'delete', '', 2),
(12, 'member', 'member_group', 'edit', '', 2),
(12, 'member', 'member_group', 'add', '', 2),
(12, 'member', 'member_group', 'manage', '', 2),
(12, 'member', 'member_group', 'manage', '', 2),
(12, 'member', 'member_setting', 'manage', '', 2),
(12, 'member', 'member', 'memberinfo', '', 2),
(12, 'member', 'member', 'edit', '', 2),
(12, 'member', 'member', 'search', '', 2),
(12, 'member', 'member', 'delete', '', 2),
(12, 'member', 'member', 'move', '', 2),
(12, 'member', 'member', 'unlock', '', 2),
(12, 'member', 'member', 'lock', '', 2),
(12, 'member', 'member', 'add', '', 2),
(12, 'member', 'member', 'manage', '', 2),
(12, 'member', 'member_verify', 'modelinfo', '', 2),
(12, 'member', 'member_verify', 'reject', '', 2),
(12, 'member', 'member_verify', 'ignore', '', 2),
(12, 'member', 'member_verify', 'delete', '', 2),
(12, 'member', 'member_verify', 'pass', '', 2),
(12, 'member', 'member_verify', 'manage', 's=5', 2),
(12, 'member', 'member_verify', 'manage', 's=4', 2),
(12, 'member', 'member_verify', 'manage', 's=3', 2),
(12, 'member', 'member_verify', 'manage', 's=1', 2),
(12, 'member', 'member_verify', 'manage', 's=2', 2),
(12, 'member', 'member_verify', 'manage', 's=0', 2),
(12, 'member', 'member', 'manage', '', 2),
(12, 'member', 'member', 'init', '', 2),
(12, 'admin', 'cache_all', 'init', '', 2),
(12, 'content', 'type_manage', 'edit', '', 2),
(12, 'content', 'type_manage', 'delete', '', 2),
(12, 'content', 'type_manage', 'add', '', 2),
(12, 'content', 'type_manage', 'init', '', 2),
(12, 'content', 'sitemodel', 'export', '', 2),
(12, 'content', 'sitemodel', 'delete', '', 2),
(12, 'content', 'sitemodel', 'disabled', '', 2),
(12, 'content', 'sitemodel', 'edit', '', 2),
(12, 'content', 'sitemodel_field', 'init', '', 2),
(12, 'content', 'sitemodel', 'import', '', 2),
(12, 'content', 'sitemodel', 'add', '', 2),
(12, 'content', 'sitemodel', 'init', '', 2),
(12, 'admin', 'category', 'batch_edit', '', 2),
(12, 'admin', 'category', 'count_items', '', 2),
(12, 'admin', 'category', 'add', 's=2', 2),
(12, 'admin', 'category', 'add', 's=1', 2),
(12, 'admin', 'category', 'public_cache', 'module=admin', 2),
(12, 'admin', 'category', 'edit', '', 2),
(12, 'admin', 'category', 'add', 's=0', 2),
(12, 'admin', 'category', 'init', 'module=admin', 2),
(12, 'admin', 'position', 'delete', '', 2),
(12, 'admin', 'position', 'edit', '', 2),
(12, 'admin', 'position', 'add', '', 2),
(12, 'admin', 'position', 'init', '', 2),
(12, 'content', 'content_settings', 'init', '', 2),
(12, 'content', 'create_html', 'public_index', '', 2),
(12, 'content', 'create_html', 'category', '', 2),
(12, 'content', 'create_html', 'update_urls', '', 2),
(12, 'content', 'create_html', 'show', '', 2),
(12, 'release', 'index', 'del', '', 2),
(12, 'release', 'index', 'failed', '', 2),
(12, 'release', 'index', 'init', '', 2),
(12, 'release', 'html', 'init', '', 2),
(12, 'comment', 'check', 'checks', '', 2),
(12, 'comment', 'comment_admin', 'listinfo', '', 2),
(12, 'collection', 'node', 'import_content', '', 2),
(12, 'collection', 'node', 'import_program_del', '', 2),
(12, 'collection', 'node', 'import_program_add', '', 2),
(12, 'collection', 'node', 'content_del', '', 2),
(12, 'collection', 'node', 'copy', '', 2),
(12, 'collection', 'node', 'import', '', 2),
(12, 'collection', 'node', 'col_content', '', 2),
(12, 'collection', 'node', 'export', '', 2),
(12, 'collection', 'node', 'node_import', '', 2),
(12, 'collection', 'node', 'publist', '', 2),
(12, 'collection', 'node', 'col_url_list', '', 2),
(12, 'collection', 'node', 'del', '', 2),
(12, 'collection', 'node', 'edit', '', 2),
(12, 'collection', 'node', 'add', '', 2),
(12, 'collection', 'node', 'manage', '', 2),
(12, 'block', 'block_admin', 'history_del', '', 2),
(12, 'block', 'block_admin', 'history_restore', '', 2),
(12, 'block', 'block_admin', 'block_update', '', 2),
(12, 'block', 'block_admin', 'del', '', 2),
(12, 'block', 'block_admin', 'edit', '', 2),
(12, 'block', 'block_admin', 'add', '', 2),
(12, 'block', 'block_admin', 'init', '', 2),
(12, 'special', 'special', 'create_special_list', '', 2),
(12, 'special', 'special', 'html', '', 2),
(12, 'special', 'special', 'import', '', 2),
(12, 'special', 'content', 'listorder', '', 2),
(12, 'special', 'content', 'delete', '', 2),
(12, 'special', 'content', 'edit', '', 2),
(12, 'special', 'content', 'init', '', 2),
(12, 'special', 'content', 'add', '', 2),
(12, 'special', 'content', 'init', '', 2),
(12, 'special', 'special', 'listorder', '', 2),
(12, 'special', 'special', 'delete', '', 2),
(12, 'special', 'special', 'elite', '', 2),
(12, 'special', 'special', 'init', '', 2),
(12, 'special', 'special', 'edit', '', 2),
(12, 'special', 'special', 'add', '', 2),
(12, 'special', 'special', 'init', '', 2),
(12, 'attachment', 'address', 'update', '', 2),
(12, 'attachment', 'address', 'init', '', 2),
(12, 'attachment', 'manage', 'init', '', 2),
(12, 'attachment', 'manage', 'dir', '', 2),
(12, 'attachment', 'manage', 'init', '', 2),
(12, 'content', 'content', 'remove', '', 2),
(12, 'content', 'content', 'listorder', '', 2),
(12, 'content', 'content', 'batch_show', '', 2),
(12, 'content', 'content', 'delete', '', 2),
(12, 'content', 'content', 'add_othors', '', 2),
(12, 'content', 'content', 'move', '', 2),
(12, 'content', 'push', 'init', '', 2),
(12, 'content', 'content', 'edit', '', 2),
(12, 'content', 'content', 'pass', '', 2),
(12, 'content', 'content', 'add', '', 2),
(12, 'content', 'content', 'init', '', 2),
(12, 'content', 'content', 'init', '', 2),
(12, 'content', 'content', 'init', '', 2),
(8, 'admin', 'admin_manage', 'init', '', 1),
(10, 'link', 'link', 'delete', '', 1),
(11, 'attachment', 'manage', 'init', '', 1),
(11, 'admin', 'module', '', '', 1),
(11, 'admin', 'module', 'init', '', 1),
(11, 'link', 'link', 'add', '', 1),
(11, 'poster', 'poster', 'init', '', 1),
(11, 'link', 'link', 'edit', '', 1),
(11, 'admin', 'admin_manage', 'init', '', 1),
(11, 'poster', 'poster', 'edit', '', 1),
(11, 'message', 'message', 'message_send', '', 1),
(11, 'message', 'message', 'message_group_manage', '', 1),
(11, 'content', 'create_html_opt', 'index', '', 1),
(11, 'content', 'create_html', 'public_index', '', 1),
(10, 'attachment', 'manage', 'init', '', 1),
(10, 'attachment', 'manage', 'dir', '', 1),
(10, 'special', 'special', 'elite', '', 1),
(10, 'special', 'content', 'init', '', 1),
(9, 'content', 'create_html', 'update_urls', '', 1),
(9, 'admin', 'admin_manage', 'public_edit_pwd', '', 1),
(9, 'admin', 'admin_manage', 'init', '', 1),
(9, 'content', 'create_html', 'public_index', '', 1),
(9, 'content', 'create_html', 'public_index', '', 1),
(8, 'admin', 'keylink', 'init', '', 1),
(8, 'admin', 'keylink', 'add', '', 1),
(8, 'admin', 'keylink', 'edit', '', 1),
(9, 'content', 'create_html_opt', 'index', '', 1),
(9, 'special', 'special', 'edit', '', 1),
(9, 'special', 'special', 'delete', '', 1),
(9, 'admin', 'extend_all', 'init', '', 1),
(9, 'admin', 'keylink', 'init', '', 1),
(9, 'admin', 'keylink', 'add', '', 1),
(9, 'admin', 'keylink', 'edit', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `h5_announce`
--

CREATE TABLE IF NOT EXISTS `h5_announce` (
  `aid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL,
  `content` text NOT NULL,
  `starttime` date NOT NULL DEFAULT '0000-00-00',
  `endtime` date NOT NULL DEFAULT '0000-00-00',
  `username` varchar(40) NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` smallint(5) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `style` char(15) NOT NULL,
  `show_template` char(30) NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `siteid` (`siteid`,`passed`,`endtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_announce`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_ask`
--

CREATE TABLE IF NOT EXISTS `h5_ask` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `isreply` varchar(255) NOT NULL DEFAULT '0',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `xglp` int(10) unsigned NOT NULL DEFAULT '0',
  `housename` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_ask`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_ask_data`
--

CREATE TABLE IF NOT EXISTS `h5_ask_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` mediumtext NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `question` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_ask_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_attachment`
--

CREATE TABLE IF NOT EXISTS `h5_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(15) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `filename` char(50) NOT NULL,
  `filepath` char(200) NOT NULL,
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileext` char(10) NOT NULL,
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isthumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uploadtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uploadip` char(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `authcode` char(32) NOT NULL,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `authcode` (`authcode`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_attachment`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_attachment_index`
--

CREATE TABLE IF NOT EXISTS `h5_attachment_index` (
  `keyid` char(30) NOT NULL,
  `aid` char(10) NOT NULL,
  KEY `keyid` (`keyid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_attachment_index`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_badword`
--

CREATE TABLE IF NOT EXISTS `h5_badword` (
  `badid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `badword` char(20) NOT NULL,
  `level` tinyint(5) NOT NULL DEFAULT '1',
  `replaceword` char(20) NOT NULL DEFAULT '0',
  `lastusetime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`badid`),
  UNIQUE KEY `badword` (`badword`),
  KEY `usetimes` (`replaceword`,`listorder`),
  KEY `hits` (`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_badword`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_block`
--

CREATE TABLE IF NOT EXISTS `h5_block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `name` char(50) DEFAULT NULL,
  `pos` char(30) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0',
  `data` text,
  `template` text,
  PRIMARY KEY (`id`),
  KEY `pos` (`pos`),
  KEY `type` (`type`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_block`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_block_history`
--

CREATE TABLE IF NOT EXISTS `h5_block_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `blockid` int(10) unsigned DEFAULT '0',
  `data` text,
  `creat_at` int(10) unsigned DEFAULT '0',
  `userid` mediumint(8) unsigned DEFAULT '0',
  `username` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_block_history`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_block_priv`
--

CREATE TABLE IF NOT EXISTS `h5_block_priv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleid` tinyint(3) unsigned DEFAULT '0',
  `siteid` smallint(5) unsigned DEFAULT '0',
  `blockid` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `blockid` (`blockid`),
  KEY `roleid` (`roleid`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_block_priv`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_building`
--

CREATE TABLE IF NOT EXISTS `h5_building` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `unit` int(10) unsigned NOT NULL DEFAULT '0',
  `floor` int(10) unsigned NOT NULL DEFAULT '0',
  `hushu` int(10) unsigned NOT NULL DEFAULT '0',
  `xszt` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `progress` varchar(255) NOT NULL DEFAULT '',
  `opentime` varchar(255) NOT NULL DEFAULT '',
  `jfdate` varchar(255) NOT NULL DEFAULT '',
  `fix` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `license` varchar(255) NOT NULL DEFAULT '',
  `shapan` varchar(255) NOT NULL DEFAULT '',
  `dongtai` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `h5_building`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_building_data`
--

CREATE TABLE IF NOT EXISTS `h5_building_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` int(10) unsigned NOT NULL DEFAULT '0',
  `pictureurls` mediumtext NOT NULL,
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_building_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_cache`
--

CREATE TABLE IF NOT EXISTS `h5_cache` (
  `filename` char(50) NOT NULL,
  `path` char(50) NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`filename`,`path`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_cache`
--

INSERT INTO `h5_cache` (`filename`, `path`, `data`) VALUES
('category_items_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  6 => ''0'',\n  16 => ''8742'',\n  24 => ''2150'',\n  21 => ''112'',\n  23 => ''945'',\n  25 => ''0'',\n  26 => ''741'',\n  27 => ''132'',\n  28 => ''419'',\n  41 => ''47'',\n  29 => ''234'',\n  30 => ''165'',\n  31 => ''91'',\n  32 => ''11'',\n  33 => ''235'',\n  34 => ''24'',\n  35 => ''990'',\n  36 => ''18'',\n  37 => ''23'',\n  38 => ''100'',\n  39 => ''311'',\n  40 => ''605'',\n  42 => ''10'',\n  43 => ''24'',\n  44 => ''0'',\n  46 => ''0'',\n  48 => ''0'',\n  49 => ''99'',\n  53 => ''0'',\n  54 => ''760'',\n  55 => ''117'',\n  56 => ''4'',\n  57 => ''28'',\n  58 => ''758'',\n  59 => ''137'',\n  60 => ''555'',\n  62 => ''0'',\n  63 => ''206'',\n  64 => ''4'',\n  65 => ''0'',\n  66 => ''524'',\n  67 => ''1004'',\n  68 => ''0'',\n  72 => ''0'',\n  114 => ''3'',\n);\n?>'),
('category_items_3.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  8 => ''873'',\n  13 => ''570'',\n);\n?>'),
('category_items_13.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  9 => ''0'',\n  14 => ''504'',\n);\n?>'),
('category_items_14.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_15.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  11 => ''508'',\n);\n?>'),
('category_items_16.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  12 => ''577'',\n);\n?>'),
('category_items_18.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  15 => ''39'',\n);\n?>'),
('category_items_26.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  80 => ''79'',\n);\n?>'),
('category_items_28.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  99 => ''267'',\n);\n?>'),
('category_items_34.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  107 => ''2'',\n);\n?>'),
('category_items_37.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  108 => ''2'',\n);\n?>'),
('category_items_39.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  111 => ''0'',\n  112 => ''15'',\n);\n?>'),
('category_items_40.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  110 => ''12'',\n);\n?>'),
('category_items_41.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  113 => ''2'',\n);\n?>'),
('category_items_4.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  7 => ''0'',\n  70 => ''12'',\n  69 => ''28'',\n);\n?>'),
('category_items_5.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  10 => ''4'',\n  45 => ''12'',\n  50 => ''1'',\n  51 => ''0'',\n);\n?>'),
('category_items_29.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  19 => ''10'',\n);\n?>'),
('category_items_30.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  20 => ''4'',\n);\n?>'),
('category_items_23.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_21.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_22.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_24.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_items_25.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('category_content.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  6 => ''1'',\n  14 => ''1'',\n  112 => ''1'',\n  113 => ''1'',\n  8 => ''1'',\n  13 => ''1'',\n  110 => ''1'',\n  11 => ''1'',\n  12 => ''1'',\n  7 => ''1'',\n  9 => ''1'',\n  10 => ''1'',\n  111 => ''1'',\n  15 => ''1'',\n  16 => ''1'',\n  99 => ''1'',\n  19 => ''1'',\n  20 => ''1'',\n  21 => ''1'',\n  23 => ''1'',\n  24 => ''1'',\n  25 => ''1'',\n  26 => ''1'',\n  49 => ''1'',\n  27 => ''1'',\n  28 => ''1'',\n  29 => ''1'',\n  30 => ''1'',\n  31 => ''1'',\n  32 => ''1'',\n  33 => ''1'',\n  34 => ''1'',\n  35 => ''1'',\n  36 => ''1'',\n  37 => ''1'',\n  64 => ''1'',\n  38 => ''1'',\n  39 => ''1'',\n  40 => ''1'',\n  41 => ''1'',\n  42 => ''1'',\n  43 => ''1'',\n  44 => ''1'',\n  45 => ''1'',\n  46 => ''1'',\n  53 => ''1'',\n  50 => ''1'',\n  51 => ''1'',\n  54 => ''1'',\n  55 => ''1'',\n  56 => ''1'',\n  57 => ''1'',\n  58 => ''1'',\n  59 => ''1'',\n  63 => ''1'',\n  60 => ''1'',\n  68 => ''1'',\n  65 => ''1'',\n  66 => ''1'',\n  67 => ''1'',\n  48 => ''1'',\n  62 => ''1'',\n  69 => ''1'',\n  70 => ''1'',\n  72 => ''1'',\n  1 => ''1'',\n  80 => ''1'',\n  2 => ''1'',\n  3 => ''1'',\n  4 => ''1'',\n  5 => ''1'',\n  107 => ''1'',\n  108 => ''1'',\n  114 => ''1'',\n);\n?>');
INSERT INTO `h5_cache` (`filename`, `path`, `data`) VALUES
('category_content_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  6 => \n  array (\n    ''catid'' => ''6'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''6,16,24,25,26,49,27,28,29,30,31,32,33,34,35,36,37,80,38,64,39,40,44,21,46,23,41,42,43,60,53,54,55,56,57,58,59,114,63,65,66,67,48,62'',\n    ''catname'' => ''资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''news'',\n    ''url'' => ''http://localhost:7030/news/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''房地产信息\\'',\n  \\''meta_keywords\\'' => \\''房地产信息,新闻网,房地产新闻,房产网,信息港,信息门户\\'',\n  \\''meta_description\\'' => \\''房地产网()新闻资讯频道提供最新、最权威的房产信息资讯。\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''1'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''zixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''1'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  14 => \n  array (\n    ''catid'' => ''14'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''13'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''14'',\n    ''catname'' => ''新盘'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''xinfang'',\n    ''url'' => ''http://demo1.house5.net/list{$lst}-g1.html'',\n    ''items'' => ''504'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_house\\'',\n  \\''show_template\\'' => \\''show_house\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''房价,楼市,买房,新房,购房,业主论坛,新房,写字楼,商铺,团购,楼盘对比,地图找房,买房就来\\'',\n  \\''meta_description\\'' => \\''新房频道收集整理地区的最新楼盘,房价趋势,买房资讯,房产新闻,楼市动态等相关内容，让地区的广大网友朋友们了解最新的最全的新房,房价,楼盘相关资讯,帮助广大网友朋友们选房、购房、买房等。\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''30\\'',\n  \\''show_ruleid\\'' => \\''33\\'',\n)'',\n    ''listorder'' => ''1'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''xinpan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''30'',\n    ''show_ruleid'' => ''33'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  112 => \n  array (\n    ''catid'' => ''112'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''39'',\n    ''parentid'' => ''111'',\n    ''arrparentid'' => ''0,111'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''112'',\n    ''catname'' => ''二手房出售'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''esf/'',\n    ''catdir'' => ''sale'',\n    ''url'' => ''http://demo1.house5.net/list{$lst}-g1.html'',\n    ''items'' => ''15'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_esf\\'',\n  \\''show_template\\'' => \\''show_esf\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''30\\'',\n  \\''show_ruleid\\'' => \\''13\\'',\n)'',\n    ''listorder'' => ''1'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''ershoufangchushou'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''30'',\n    ''show_ruleid'' => ''13'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  8 => \n  array (\n    ''catid'' => ''8'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''3'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''8'',\n    ''catname'' => ''图片'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''pps'',\n    ''url'' => ''http://demo1.house5.net/xclist{$lst}-p1.html'',\n    ''items'' => ''873'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category_picture\\'',\n  \\''list_template\\'' => \\''list_xiangce\\'',\n  \\''show_template\\'' => \\''show_picture\\'',\n  \\''meta_title\\'' => \\''楼盘实景图|楼盘效果图|楼盘活动图|楼盘样板间|楼盘鸟瞰图|楼盘沙盘图\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''45\\'',\n  \\''show_ruleid\\'' => \\''37\\'',\n)'',\n    ''listorder'' => ''2'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''tupian'',\n    ''usable_type'' => '',12,13,14,15,16,17,'',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''45'',\n    ''show_ruleid'' => ''37'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  113 => \n  array (\n    ''catid'' => ''113'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''41'',\n    ''parentid'' => ''111'',\n    ''arrparentid'' => ''0,111'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''113'',\n    ''catname'' => ''二手房出租'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''esf/'',\n    ''catdir'' => ''rent'',\n    ''url'' => ''http://demo1.house5.net/rent-list{$lst}-g1.html'',\n    ''items'' => ''2'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_rent\\'',\n  \\''show_template\\'' => \\''show_esf_rent\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''48\\'',\n  \\''show_ruleid\\'' => \\''14\\'',\n)'',\n    ''listorder'' => ''2'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''ershoufangchuzu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''48'',\n    ''show_ruleid'' => ''14'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  13 => \n  array (\n    ''catid'' => ''13'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''3'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''13'',\n    ''catname'' => ''户型'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''unit'',\n    ''url'' => ''http://demo1.house5.net/hxlist{$lst}-p1.html'',\n    ''items'' => ''570'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category_picture\\'',\n  \\''list_template\\'' => \\''list_huxing\\'',\n  \\''show_template\\'' => \\''show_picture\\'',\n  \\''meta_title\\'' => \\''楼盘户型图\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''43\\'',\n  \\''show_ruleid\\'' => \\''35\\'',\n)'',\n    ''listorder'' => ''3'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''huxing'',\n    ''usable_type'' => '',18,19,20,21,22,'',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''43'',\n    ''show_ruleid'' => ''35'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  110 => \n  array (\n    ''catid'' => ''110'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''40'',\n    ''parentid'' => ''111'',\n    ''arrparentid'' => ''0,111'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''110'',\n    ''catname'' => ''小区'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''esf/'',\n    ''catdir'' => ''community'',\n    ''url'' => ''http://demo1.house5.net/xiaoqu-list{$lst}-g1.html'',\n    ''items'' => ''12'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_xq\\'',\n  \\''show_template\\'' => \\''show_xiaoqu_index\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''49\\'',\n  \\''show_ruleid\\'' => \\''15\\'',\n)'',\n    ''listorder'' => ''3'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''xiaoqu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''49'',\n    ''show_ruleid'' => ''15'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  11 => \n  array (\n    ''catid'' => ''11'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''15'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''11'',\n    ''catname'' => ''价格明细'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''price'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/11'',\n    ''items'' => ''508'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''38\\'',\n)'',\n    ''listorder'' => ''5'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''jiagemingxi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''38'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  12 => \n  array (\n    ''catid'' => ''12'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''16'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''12'',\n    ''catname'' => ''公司简介'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''company'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/12'',\n    ''items'' => ''577'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''公司简介,\\'',\n  \\''meta_keywords\\'' => \\''公司简介,\\'',\n  \\''meta_description\\'' => \\''新房频道收集整理地区的最新楼盘,房价趋势,买房资讯,房产新闻,楼市动态等相关内容，让地区的广大网友朋友们了解最新的最全的新房,房价,楼盘相关资讯,帮助广大网友朋友们选房、购房、买房等。\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''34\\'',\n)'',\n    ''listorder'' => ''6'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''gongsijianjie'',\n    ''usable_type'' => '',8,9,10,11,'',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''34'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  7 => \n  array (\n    ''catid'' => ''7'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''4'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''7,69,70'',\n    ''catname'' => ''图库'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''pic'',\n    ''url'' => ''http://localhost:7030/news/pic/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_picture\\'',\n  \\''list_template\\'' => \\''list_picture\\'',\n  \\''show_template\\'' => \\''show_picture\\'',\n  \\''meta_title\\'' => \\''图库\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''7'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''tuku'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  9 => \n  array (\n    ''catid'' => ''9'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''13'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''9,14,8,13,11,12,15,99,19,20,107'',\n    ''catname'' => ''房产'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''house'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/9'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''\\'',\n  \\''list_template\\'' => \\''list_house\\'',\n  \\''show_template\\'' => \\''show_house\\'',\n  \\''meta_title\\'' => \\''新房|新楼盘|购房中心\\'',\n  \\''meta_keywords\\'' => \\''新房,楼盘信息,楼盘地图,楼盘报价,楼盘价格,别墅,写字楼,商铺,公寓,经济适用房,热销楼盘\\'',\n  \\''meta_description\\'' => \\''新房购房中心是一个强大、准确的地区楼盘信息库,包含了最新楼盘信息、房价信息、新房价格、楼盘地图等权威信息库\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''33\\'',\n)'',\n    ''listorder'' => ''9'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''fangchan'',\n    ''usable_type'' => '',64,63,55,56,57,58,59,60,61,62,'',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''33'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  10 => \n  array (\n    ''catid'' => ''10'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''5'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''10,45,50,51'',\n    ''catname'' => ''视频'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''video'',\n    ''url'' => ''http://localhost:7030/news/video/'',\n    ''items'' => ''4'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_video\\'',\n  \\''list_template\\'' => \\''list_video\\'',\n  \\''show_template\\'' => \\''show_video\\'',\n  \\''meta_title\\'' => \\''视频看房\\'',\n  \\''meta_keywords\\'' => \\''视频看房、房产视频\\'',\n  \\''meta_description\\'' => \\''视频看房、房产视频\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''10'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''shipin'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  111 => \n  array (\n    ''catid'' => ''111'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''39'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''111,112,113,110'',\n    ''catname'' => ''二手房'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''esf'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/111'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''16\\'',\n)'',\n    ''listorder'' => ''11'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''ershoufang'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''16'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  15 => \n  array (\n    ''catid'' => ''15'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''18'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''15'',\n    ''catname'' => ''问房'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''ask'',\n    ''url'' => ''http://demo1.house5.net/wenfang{$lst}-p1.html'',\n    ''items'' => ''39'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_wenfang\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''31\\'',\n  \\''show_ruleid\\'' => \\''41\\'',\n)'',\n    ''listorder'' => ''15'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''wenfang'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''31'',\n    ''show_ruleid'' => ''41'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  99 => \n  array (\n    ''catid'' => ''99'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''28'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''99'',\n    ''catname'' => ''编辑点评'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''dianping'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/99'',\n    ''items'' => ''267'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''新房|新楼盘|购房中心\\'',\n  \\''meta_keywords\\'' => \\''新房,楼盘信息,楼盘地图,楼盘报价,楼盘价格,别墅,写字楼,商铺,公寓,经济适用房,热销楼盘\\'',\n  \\''meta_description\\'' => \\''新房购房中心是一个强大、准确的地区楼盘信息库,包含了最新楼盘信息、房价信息、新房价格、楼盘地图等权威信息库\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''44\\'',\n)'',\n    ''listorder'' => ''16'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''bianjidianping'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''44'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  16 => \n  array (\n    ''catid'' => ''16'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''16'',\n    ''catname'' => ''全国楼市'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''quanguo'',\n    ''url'' => ''http://localhost:7030/news/quanguo/'',\n    ''items'' => ''8742'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''16'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''quanguoloushi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  19 => \n  array (\n    ''catid'' => ''19'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''29'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''19'',\n    ''catname'' => ''楼栋'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''building'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/19'',\n    ''items'' => ''10'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''16\\'',\n)'',\n    ''listorder'' => ''19'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''loudong'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''16'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  20 => \n  array (\n    ''catid'' => ''20'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''30'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''20'',\n    ''catname'' => ''房间'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''room'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/20'',\n    ''items'' => ''4'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''16\\'',\n)'',\n    ''listorder'' => ''20'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''fangjian'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''16'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  21 => \n  array (\n    ''catid'' => ''21'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''44'',\n    ''arrparentid'' => ''0,6,44'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''21'',\n    ''catname'' => ''行业动态'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/trip/'',\n    ''catdir'' => ''dongtai'',\n    ''url'' => ''http://localhost:7030/news/trip/dongtai/'',\n    ''items'' => ''112'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''21'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xingyedongtai'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  23 => \n  array (\n    ''catid'' => ''23'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''46'',\n    ''arrparentid'' => ''0,6,46'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''23'',\n    ''catname'' => ''商业动态'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/shop/'',\n    ''catdir'' => ''shopzixun'',\n    ''url'' => ''http://localhost:7030/news/shop/shopzixun/'',\n    ''items'' => ''945'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''23'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''shangyedongtai'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  24 => \n  array (\n    ''catid'' => ''24'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''24'',\n    ''catname'' => ''关注'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''bendi'',\n    ''url'' => ''http://localhost:7030/news/bendi/'',\n    ''items'' => ''2150'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''24'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''guanzhu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  25 => \n  array (\n    ''catid'' => ''25'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''25,26,49,27,28,29,30,31,32,33,34,35,36,37,80'',\n    ''catname'' => ''楼市'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''loushi'',\n    ''url'' => ''http://localhost:7030/news/loushi/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''25'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''loushi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  26 => \n  array (\n    ''catid'' => ''26'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''26'',\n    ''catname'' => ''楼市快报'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''kuaibao'',\n    ''url'' => ''http://localhost:7030/news/loushi/kuaibao/'',\n    ''items'' => ''741'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''26'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''loushikuaibao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  49 => \n  array (\n    ''catid'' => ''49'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''49'',\n    ''catname'' => ''楼市预告'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''yugao'',\n    ''url'' => ''http://localhost:7030/news/loushi/yugao/'',\n    ''items'' => ''99'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''26'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''loushiyugao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  27 => \n  array (\n    ''catid'' => ''27'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''27'',\n    ''catname'' => ''行情播报'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''bobao'',\n    ''url'' => ''http://localhost:7030/news/loushi/bobao/'',\n    ''items'' => ''132'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''27'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xingqingbobao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  28 => \n  array (\n    ''catid'' => ''28'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''28'',\n    ''catname'' => ''项目进度'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''jindu'',\n    ''url'' => ''http://localhost:7030/news/loushi/jindu/'',\n    ''items'' => ''419'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''28'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xiangmujindu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  29 => \n  array (\n    ''catid'' => ''29'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''29'',\n    ''catname'' => ''优惠信息'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''youhui'',\n    ''url'' => ''http://localhost:7030/news/loushi/youhui/'',\n    ''items'' => ''234'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''29'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''youhuixinxi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  30 => \n  array (\n    ''catid'' => ''30'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''30'',\n    ''catname'' => ''市场分析'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''diaocha'',\n    ''url'' => ''http://localhost:7030/news/loushi/diaocha/'',\n    ''items'' => ''165'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''30'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''shichangfenxi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  31 => \n  array (\n    ''catid'' => ''31'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''31'',\n    ''catname'' => ''看房日记'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''riji'',\n    ''url'' => ''http://localhost:7030/news/loushi/riji/'',\n    ''items'' => ''91'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''31'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''kanfangriji'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  32 => \n  array (\n    ''catid'' => ''32'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''32'',\n    ''catname'' => ''地产招聘'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''job'',\n    ''url'' => ''http://localhost:7030/news/loushi/job/'',\n    ''items'' => ''11'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''32'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''dichanzhaopin'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  33 => \n  array (\n    ''catid'' => ''33'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''33'',\n    ''catname'' => ''土地交易'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''tudi'',\n    ''url'' => ''http://localhost:7030/news/loushi/tudi/'',\n    ''items'' => ''235'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''33'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''tudijiaoyi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  34 => \n  array (\n    ''catid'' => ''34'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''34'',\n    ''catname'' => ''楼市周报'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''zhoubao'',\n    ''url'' => ''http://localhost:7030/news/loushi/zhoubao/'',\n    ''items'' => ''24'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''34'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''loushizhoubao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  35 => \n  array (\n    ''catid'' => ''35'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''35'',\n    ''catname'' => ''购房宝典'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''baodian'',\n    ''url'' => ''http://localhost:7030/news/loushi/baodian/'',\n    ''items'' => ''990'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''35'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''goufangbaodian'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  36 => \n  array (\n    ''catid'' => ''36'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''36'',\n    ''catname'' => ''小V探盘'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''tanpan'',\n    ''url'' => ''http://localhost:7030/news/loushi/tanpan/'',\n    ''items'' => ''18'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''36'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xiaovtanpan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  37 => \n  array (\n    ''catid'' => ''37'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''37'',\n    ''catname'' => ''新房导购'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''daogou'',\n    ''url'' => ''http://localhost:7030/news/loushi/daogou/'',\n    ''items'' => ''23'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''37'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xinfangdaogou'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  38 => \n  array (\n    ''catid'' => ''38'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''38'',\n    ''catname'' => ''地产人物'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''renwu'',\n    ''url'' => ''http://localhost:7030/news/renwu/'',\n    ''items'' => ''100'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''38'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''dichanrenwu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  64 => \n  array (\n    ''catid'' => ''64'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''64'',\n    ''catname'' => ''楼市佳人'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''jiaren'',\n    ''url'' => ''http://localhost:7030/news/jiaren/'',\n    ''items'' => ''4'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''38'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''loushijiaren'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  39 => \n  array (\n    ''catid'' => ''39'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''39'',\n    ''catname'' => ''娱乐地产'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''yule'',\n    ''url'' => ''http://localhost:7030/news/yule/'',\n    ''items'' => ''311'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''39'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''yuledichan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  40 => \n  array (\n    ''catid'' => ''40'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''40'',\n    ''catname'' => ''社会热点'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''shehui'',\n    ''url'' => ''http://localhost:7030/news/shehui/'',\n    ''items'' => ''605'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''40'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''shehuiredian'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  41 => \n  array (\n    ''catid'' => ''41'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''46'',\n    ''arrparentid'' => ''0,6,46'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''41'',\n    ''catname'' => ''投资案例'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/shop/'',\n    ''catdir'' => ''touzi'',\n    ''url'' => ''http://localhost:7030/news/shop/touzi/'',\n    ''items'' => ''47'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''41'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''touzianli'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  42 => \n  array (\n    ''catid'' => ''42'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''46'',\n    ''arrparentid'' => ''0,6,46'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''42'',\n    ''catname'' => ''优惠活动'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/shop/'',\n    ''catdir'' => ''youhui'',\n    ''url'' => ''http://localhost:7030/news/shop/youhui/'',\n    ''items'' => ''10'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''42'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''youhuihuodong'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  43 => \n  array (\n    ''catid'' => ''43'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''46'',\n    ''arrparentid'' => ''0,6,46'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''43'',\n    ''catname'' => ''商业选购'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/shop/'',\n    ''catdir'' => ''xuangou'',\n    ''url'' => ''http://localhost:7030/news/shop/xuangou/'',\n    ''items'' => ''24'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''43'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''shangyexuangou'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  44 => \n  array (\n    ''catid'' => ''44'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''44,21'',\n    ''catname'' => ''旅游地产'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''trip'',\n    ''url'' => ''http://localhost:7030/news/trip/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''旅游地产\\'',\n  \\''meta_keywords\\'' => \\''旅游,旅游地产,海景房,海边楼房,房价\\'',\n  \\''meta_description\\'' => \\''旅游地产是(房地产网)旗下专门针对旅游地产开设的旅游地产频道\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''44'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''lvyoudichan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  45 => \n  array (\n    ''catid'' => ''45'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''5'',\n    ''parentid'' => ''10'',\n    ''arrparentid'' => ''0,10'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''45'',\n    ''catname'' => ''天天看房'',\n    ''style'' => '''',\n    ''image'' => ''http://demo1.house5.net/uploadfile/2013/0817/20130817034443123.jpg'',\n    ''description'' => '''',\n    ''parentdir'' => ''video/'',\n    ''catdir'' => ''ttkf'',\n    ''url'' => ''http://localhost:7030/news/video/ttkf/'',\n    ''items'' => ''12'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_video\\'',\n  \\''list_template\\'' => \\''list_video\\'',\n  \\''show_template\\'' => \\''show_video\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''45'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''tiantiankanfang'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  46 => \n  array (\n    ''catid'' => ''46'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''46,23,41,42,43,60'',\n    ''catname'' => ''商业地产'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''shop'',\n    ''url'' => ''http://localhost:7030/news/shop/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''商业地产\\'',\n  \\''meta_keywords\\'' => \\''商铺,写字楼,商铺价格,写字楼出租,写字楼出售\\'',\n  \\''meta_description\\'' => \\''商业地产是旗下针对商铺、写字楼等商业信息设置的频道\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''46'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''shangyedichan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  53 => \n  array (\n    ''catid'' => ''53'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''53,54,55,56,57,58,59,114'',\n    ''catname'' => ''家居'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''home'',\n    ''url'' => ''http://localhost:7030/news/home/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_home\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''47'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''jiaju'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  50 => \n  array (\n    ''catid'' => ''50'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''5'',\n    ''parentid'' => ''10'',\n    ''arrparentid'' => ''0,10'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''50'',\n    ''catname'' => ''面对面'',\n    ''style'' => '''',\n    ''image'' => ''http://demo1.house5.net/uploadfile/2013/0817/20130817034516263.jpg'',\n    ''description'' => '''',\n    ''parentdir'' => ''video/'',\n    ''catdir'' => ''mdm'',\n    ''url'' => ''http://localhost:7030/news/video/mdm/'',\n    ''items'' => ''1'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_video\\'',\n  \\''list_template\\'' => \\''list_video\\'',\n  \\''show_template\\'' => \\''show_video\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''50'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''mianduimian'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  51 => \n  array (\n    ''catid'' => ''51'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''5'',\n    ''parentid'' => ''10'',\n    ''arrparentid'' => ''0,10'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''51'',\n    ''catname'' => ''品牌展'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''video/'',\n    ''catdir'' => ''ppz'',\n    ''url'' => ''http://localhost:7030/news/video/ppz/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_video\\'',\n  \\''list_template\\'' => \\''list_video\\'',\n  \\''show_template\\'' => \\''show_video\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''51'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''pinpaizhan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  54 => \n  array (\n    ''catid'' => ''54'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''54'',\n    ''catname'' => ''家装资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''zixun'',\n    ''url'' => ''http://localhost:7030/news/home/zixun/'',\n    ''items'' => ''760'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''54'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''jiazhuangzixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  55 => \n  array (\n    ''catid'' => ''55'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''55'',\n    ''catname'' => ''行业热点'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''redian'',\n    ''url'' => ''http://localhost:7030/news/home/redian/'',\n    ''items'' => ''117'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''55'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''xingyeredian'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  56 => \n  array (\n    ''catid'' => ''56'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''56'',\n    ''catname'' => ''团购时报'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''tuangou'',\n    ''url'' => ''http://localhost:7030/news/home/tuangou/'',\n    ''items'' => ''4'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n)'',\n    ''listorder'' => ''56'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''tuangoushibao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  57 => \n  array (\n    ''catid'' => ''57'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''57'',\n    ''catname'' => ''促销信息'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''cuxiao'',\n    ''url'' => ''http://localhost:7030/news/home/cuxiao/'',\n    ''items'' => ''28'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''57'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''cuxiaoxinxi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  58 => \n  array (\n    ''catid'' => ''58'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''58'',\n    ''catname'' => ''装饰百科'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''baike'',\n    ''url'' => ''http://localhost:7030/news/home/baike/'',\n    ''items'' => ''758'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''58'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''zhuangshibaike'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  59 => \n  array (\n    ''catid'' => ''59'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''59'',\n    ''catname'' => ''家装日记'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''zhuangxiu'',\n    ''url'' => ''http://localhost:7030/news/home/zhuangxiu/'',\n    ''items'' => ''137'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''59'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''jiazhuangriji'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  60 => \n  array (\n    ''catid'' => ''60'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''46'',\n    ''arrparentid'' => ''0,6,46'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''60'',\n    ''catname'' => ''别墅'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/shop/'',\n    ''catdir'' => ''bieshu'',\n    ''url'' => ''http://localhost:7030/news/shop/bieshu/'',\n    ''items'' => ''555'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''60'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''bieshu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  63 => \n  array (\n    ''catid'' => ''63'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''63'',\n    ''catname'' => ''风水漫谈'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''fengshui'',\n    ''url'' => ''http://localhost:7030/news/fengshui/'',\n    ''items'' => ''206'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''60'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''fengshuimantan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  68 => \n  array (\n    ''catid'' => ''68'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''68,72,108'',\n    ''catname'' => ''看房团首页'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''kanfang'',\n    ''url'' => ''http://demo1.house5.net/{$categorydir}{$catdir}/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category_kanfang\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''60'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''kanfangtuanshouye'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''1'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  65 => \n  array (\n    ''catid'' => ''65'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''65,66'',\n    ''catname'' => ''二手房'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''esf'',\n    ''url'' => ''http://localhost:7030/news/esf/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''65'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''ershoufang'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  66 => \n  array (\n    ''catid'' => ''66'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''65'',\n    ''arrparentid'' => ''0,6,65'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''66'',\n    ''catname'' => ''二手房资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/esf/'',\n    ''catdir'' => ''zixun'',\n    ''url'' => ''http://localhost:7030/news/esf/zixun/'',\n    ''items'' => ''524'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''66'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''ershoufangzixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  67 => \n  array (\n    ''catid'' => ''67'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''67'',\n    ''catname'' => ''分析评论'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''pinglun'',\n    ''url'' => ''http://localhost:7030/news/pinglun/'',\n    ''items'' => ''1004'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''66'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''fenxipinglun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  48 => \n  array (\n    ''catid'' => ''48'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''48'',\n    ''catname'' => ''即时资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''latest'',\n    ''url'' => ''http://demo1.house5.net/list-1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''32\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''67'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''jishizixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''32'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  62 => \n  array (\n    ''catid'' => ''62'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''6'',\n    ''arrparentid'' => ''0,6'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''62'',\n    ''catname'' => ''图片资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/'',\n    ''catdir'' => ''pic'',\n    ''url'' => ''http://demo1.house5.net/piclist-1.html'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''40\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''68'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''tupianzixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''40'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  69 => \n  array (\n    ''catid'' => ''69'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''4'',\n    ''parentid'' => ''7'',\n    ''arrparentid'' => ''0,7'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''69'',\n    ''catname'' => ''精彩美图'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''pic/'',\n    ''catdir'' => ''meitu'',\n    ''url'' => ''http://localhost:7030/news/pic/meitu/'',\n    ''items'' => ''28'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_picture\\'',\n  \\''list_template\\'' => \\''list_picture\\'',\n  \\''show_template\\'' => \\''show_picture\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''69'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''jingcaimeitu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  70 => \n  array (\n    ''catid'' => ''70'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''4'',\n    ''parentid'' => ''7'',\n    ''arrparentid'' => ''0,7'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''70'',\n    ''catname'' => ''精美壁纸'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''pic/'',\n    ''catdir'' => ''wallpaper'',\n    ''url'' => ''http://localhost:7030/news/pic/wallpaper/'',\n    ''items'' => ''12'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_picture\\'',\n  \\''list_template\\'' => \\''list_picture\\'',\n  \\''show_template\\'' => \\''show_picture\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''70'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''jingmeibizhi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  72 => \n  array (\n    ''catid'' => ''72'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''68'',\n    ''arrparentid'' => ''0,68'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''72'',\n    ''catname'' => ''资讯'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''kanfang/'',\n    ''catdir'' => ''kanfangzixun'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/72'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''16\\'',\n)'',\n    ''listorder'' => ''72'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''zixun'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''16'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  1 => \n  array (\n    ''catid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''0'',\n    ''arrparentid'' => ''0'',\n    ''child'' => ''1'',\n    ''arrchildid'' => ''1,2,3,4,5'',\n    ''catname'' => ''网站介绍'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''about'',\n    ''url'' => ''http://localhost:7030/news/about/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''ishtml\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''page_template\\'' => \\''page\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n)'',\n    ''listorder'' => ''80'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''wangzhanjieshao'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  80 => \n  array (\n    ''catid'' => ''80'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''26'',\n    ''parentid'' => ''25'',\n    ''arrparentid'' => ''0,6,25'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''80'',\n    ''catname'' => ''成交数据'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/loushi/'',\n    ''catdir'' => ''data'',\n    ''url'' => ''http://localhost:7030/news/loushi/data/'',\n    ''items'' => ''79'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''80'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''chengjiaoshuju'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  2 => \n  array (\n    ''catid'' => ''2'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''1'',\n    ''arrparentid'' => ''0,1'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''2'',\n    ''catname'' => ''关于我们'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''aboutus'',\n    ''url'' => ''http://localhost:7030/news/about/aboutus/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''ishtml\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''page_template\\'' => \\''page\\'',\n  \\''meta_title\\'' => \\''关于我们\\'',\n  \\''meta_keywords\\'' => \\''关于我们\\'',\n  \\''meta_description\\'' => \\''关于我们\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n)'',\n    ''listorder'' => ''81'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''guanyuwomen'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  3 => \n  array (\n    ''catid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''1'',\n    ''arrparentid'' => ''0,1'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''3'',\n    ''catname'' => ''联系方式'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''contactus'',\n    ''url'' => ''http://localhost:7030/news/about/contactus/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''ishtml\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''page_template\\'' => \\''page\\'',\n  \\''meta_title\\'' => \\''联系方式\\'',\n  \\''meta_keywords\\'' => \\''联系方式\\'',\n  \\''meta_description\\'' => \\''联系方式\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n)'',\n    ''listorder'' => ''82'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''lianxifangshi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  4 => \n  array (\n    ''catid'' => ''4'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''1'',\n    ''arrparentid'' => ''0,1'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''4'',\n    ''catname'' => ''版权声明'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''copyright'',\n    ''url'' => ''http://localhost:7030/news/about/copyright/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''ishtml\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''page_template\\'' => \\''page\\'',\n  \\''meta_title\\'' => \\''版权声明\\'',\n  \\''meta_keywords\\'' => \\''版权声明\\'',\n  \\''meta_description\\'' => \\''版权声明\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n)'',\n    ''listorder'' => ''83'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''banquanshengming'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  5 => \n  array (\n    ''catid'' => ''5'',\n    ''siteid'' => ''1'',\n    ''type'' => ''1'',\n    ''modelid'' => ''0'',\n    ''parentid'' => ''1'',\n    ''arrparentid'' => ''0,1'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''5'',\n    ''catname'' => ''招聘信息'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''about/'',\n    ''catdir'' => ''hr'',\n    ''url'' => ''http://localhost:7030/news/about/hr/'',\n    ''items'' => ''0'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''ishtml\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''page_template\\'' => \\''page\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n)'',\n    ''listorder'' => ''84'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''zhaopinxinxi'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => NULL,\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => NULL,\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => '''',\n    ''workflowid'' => NULL,\n    ''isdomain'' => ''0'',\n  ),\n  107 => \n  array (\n    ''catid'' => ''107'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''34'',\n    ''parentid'' => ''9'',\n    ''arrparentid'' => ''0,9'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''107'',\n    ''catname'' => ''新房'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''house/'',\n    ''catdir'' => ''fangyuan'',\n    ''url'' => ''http://demo1.house5.net/index.php?s=content/index/lists/catid/107'',\n    ''items'' => ''2'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''1\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_fangyuan\\'',\n  \\''show_template\\'' => \\''show_fangyuan\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''6\\'',\n  \\''show_ruleid\\'' => \\''46\\'',\n)'',\n    ''listorder'' => ''107'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''0'',\n    ''letter'' => ''xinfang'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''6'',\n    ''show_ruleid'' => ''46'',\n    ''workflowid'' => ''1'',\n    ''isdomain'' => ''0'',\n  ),\n  108 => \n  array (\n    ''catid'' => ''108'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''37'',\n    ''parentid'' => ''68'',\n    ''arrparentid'' => ''0,68'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''108'',\n    ''catname'' => ''看房团'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => '''',\n    ''catdir'' => ''kanfangtuan'',\n    ''url'' => ''http://demo1.house5.net/{$categorydir}{$catdir}/'',\n    ''items'' => ''2'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''0\\'',\n  \\''content_ishtml\\'' => \\''0\\'',\n  \\''create_to_html_root\\'' => \\''1\\'',\n  \\''template_list\\'' => \\''default\\'',\n  \\''category_template\\'' => \\''category\\'',\n  \\''list_template\\'' => \\''list_kanfangtuan\\'',\n  \\''show_template\\'' => \\''show_kanfangtuan\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''47\\'',\n)'',\n    ''listorder'' => ''108'',\n    ''ismenu'' => ''0'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''kanfangtuan'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''1'',\n    ''ishtml'' => ''0'',\n    ''content_ishtml'' => ''0'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''47'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n  114 => \n  array (\n    ''catid'' => ''114'',\n    ''siteid'' => ''1'',\n    ''type'' => ''0'',\n    ''modelid'' => ''1'',\n    ''parentid'' => ''53'',\n    ''arrparentid'' => ''0,6,53'',\n    ''child'' => ''0'',\n    ''arrchildid'' => ''114'',\n    ''catname'' => ''精品装修'',\n    ''style'' => '''',\n    ''image'' => '''',\n    ''description'' => '''',\n    ''parentdir'' => ''news/home/'',\n    ''catdir'' => ''jpzx'',\n    ''url'' => ''http://localhost:7030/news/home/jpzx/'',\n    ''items'' => ''3'',\n    ''hits'' => ''0'',\n    ''setting'' => ''array (\n  \\''workflowid\\'' => \\''\\'',\n  \\''ishtml\\'' => \\''1\\'',\n  \\''content_ishtml\\'' => \\''1\\'',\n  \\''create_to_html_root\\'' => \\''0\\'',\n  \\''template_list\\'' => \\''house5-style1\\'',\n  \\''category_template\\'' => \\''category_news\\'',\n  \\''list_template\\'' => \\''list\\'',\n  \\''show_template\\'' => \\''show\\'',\n  \\''meta_title\\'' => \\''\\'',\n  \\''meta_keywords\\'' => \\''\\'',\n  \\''meta_description\\'' => \\''\\'',\n  \\''presentpoint\\'' => \\''1\\'',\n  \\''defaultchargepoint\\'' => \\''0\\'',\n  \\''paytype\\'' => \\''0\\'',\n  \\''repeatchargedays\\'' => \\''1\\'',\n  \\''category_ruleid\\'' => \\''1\\'',\n  \\''show_ruleid\\'' => \\''11\\'',\n)'',\n    ''listorder'' => ''114'',\n    ''ismenu'' => ''1'',\n    ''sethtml'' => ''1'',\n    ''letter'' => ''jingpinzhuangxiu'',\n    ''usable_type'' => '''',\n    ''create_to_html_root'' => ''0'',\n    ''ishtml'' => ''1'',\n    ''content_ishtml'' => ''1'',\n    ''category_ruleid'' => ''1'',\n    ''show_ruleid'' => ''11'',\n    ''workflowid'' => '''',\n    ''isdomain'' => ''0'',\n  ),\n);\n?>');
INSERT INTO `h5_cache` (`filename`, `path`, `data`) VALUES
('type_content.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  8 => \n  array (\n    ''typeid'' => ''8'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''开发商'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''1'',\n    ''description'' => '''',\n  ),\n  9 => \n  array (\n    ''typeid'' => ''9'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''投资商'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''2'',\n    ''description'' => '''',\n  ),\n  10 => \n  array (\n    ''typeid'' => ''10'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''代理公司'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''3'',\n    ''description'' => '''',\n  ),\n  11 => \n  array (\n    ''typeid'' => ''11'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''物业公司'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''4'',\n    ''description'' => '''',\n  ),\n  12 => \n  array (\n    ''typeid'' => ''12'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''实景图'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''5'',\n    ''description'' => '''',\n  ),\n  13 => \n  array (\n    ''typeid'' => ''13'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''效果图'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''6'',\n    ''description'' => '''',\n  ),\n  14 => \n  array (\n    ''typeid'' => ''14'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''交通图'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''7'',\n    ''description'' => '''',\n  ),\n  15 => \n  array (\n    ''typeid'' => ''15'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''配套图'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''8'',\n    ''description'' => '''',\n  ),\n  16 => \n  array (\n    ''typeid'' => ''16'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''样板间'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''9'',\n    ''description'' => '''',\n  ),\n  17 => \n  array (\n    ''typeid'' => ''17'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''活动图'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''10'',\n    ''description'' => '''',\n  ),\n  18 => \n  array (\n    ''typeid'' => ''18'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''一室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''11'',\n    ''description'' => '''',\n  ),\n  19 => \n  array (\n    ''typeid'' => ''19'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''两室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''12'',\n    ''description'' => '''',\n  ),\n  20 => \n  array (\n    ''typeid'' => ''20'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''三室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''13'',\n    ''description'' => '''',\n  ),\n  21 => \n  array (\n    ''typeid'' => ''21'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''四室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''14'',\n    ''description'' => '''',\n  ),\n  22 => \n  array (\n    ''typeid'' => ''22'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''五室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''15'',\n    ''description'' => '''',\n  ),\n  23 => \n  array (\n    ''typeid'' => ''23'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''六室'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''16'',\n    ''description'' => '''',\n  ),\n  24 => \n  array (\n    ''typeid'' => ''24'',\n    ''siteid'' => ''1'',\n    ''module'' => ''content'',\n    ''modelid'' => ''0'',\n    ''name'' => ''复式'',\n    ''parentid'' => ''0'',\n    ''typedir'' => '''',\n    ''url'' => '''',\n    ''template'' => '''',\n    ''listorder'' => ''17'',\n    ''description'' => '''',\n  ),\n);\n?>'),
('sitelist.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''siteid'' => ''1'',\n    ''name'' => ''house5演示站'',\n    ''dirname'' => '''',\n    ''domain'' => ''http://localhost:7030/'',\n    ''site_title'' => ''house5演示站--最专业的房地产网站程序'',\n    ''keywords'' => ''house5演示站--最专业的房地产网站程序'',\n    ''description'' => ''house5演示站--最专业的房地产网站程序'',\n    ''copyright'' => ''Copyright 2003-2012 House5.cn <a href="http://www.house5.cn/">House5.cn</a> 版权所有\r\n\r\n<br />\r\n\r\n鲁ICP备11018261号-3'',\n    ''map_key'' => ''a55bf8eb974dbf451984ba73a902ed18c5026e0704931db3f13c6b1f59fc87fb6c5dedc8a5745cd0'',\n    ''default_city'' => ''威海'',\n    ''city_map'' => ''122.1|37.5'',\n    ''release_point'' => '''',\n    ''default_style'' => ''house5-style1'',\n    ''template'' => ''house5-style1'',\n    ''setting'' => ''array (\n  \\''upload_maxsize\\'' => \\''4096\\'',\n  \\''upload_allowext\\'' => \\''jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf|flv|mp3\\'',\n  \\''watermark_enable\\'' => \\''1\\'',\n  \\''watermark_minwidth\\'' => \\''300\\'',\n  \\''watermark_minheight\\'' => \\''300\\'',\n  \\''watermark_img\\'' => \\''statics/images/water//mark.png\\'',\n  \\''watermark_pct\\'' => \\''85\\'',\n  \\''watermark_quality\\'' => \\''80\\'',\n  \\''watermark_pos\\'' => \\''9\\'',\n)'',\n    ''uuid'' => ''b059547a-382a-11e1-bf51-74649bdb78c7'',\n    ''url'' => ''http://localhost:7030/'',\n  ),\n);\n?>'),
('downservers.cache.php', 'caches_commons/caches_data/', '<?php\nreturn NULL;\n?>'),
('badword.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('ipbanned.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('keylink.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('position.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''posid'' => ''1'',\n    ''modelid'' => ''0'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页焦点图推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''99'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  57 => \n  array (\n    ''posid'' => ''57'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页焦点图推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''99'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  58 => \n  array (\n    ''posid'' => ''58'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''90'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  2 => \n  array (\n    ''posid'' => ''2'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''90'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  35 => \n  array (\n    ''posid'' => ''35'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''89'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  59 => \n  array (\n    ''posid'' => ''59'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''89'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  36 => \n  array (\n    ''posid'' => ''36'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条3'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''88'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  60 => \n  array (\n    ''posid'' => ''60'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条3'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''88'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  37 => \n  array (\n    ''posid'' => ''37'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条1_下5条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''87'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  61 => \n  array (\n    ''posid'' => ''61'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条1_下5条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''87'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  62 => \n  array (\n    ''posid'' => ''62'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条2_下4条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''86'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  38 => \n  array (\n    ''posid'' => ''38'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条2_下4条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''86'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  63 => \n  array (\n    ''posid'' => ''63'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条3_下4条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''85'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  39 => \n  array (\n    ''posid'' => ''39'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_头条3_下4条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''85'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  28 => \n  array (\n    ''posid'' => ''28'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_推荐楼盘1（7图）'',\n    ''maxnum'' => ''7'',\n    ''extention'' => '''',\n    ''listorder'' => ''82'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  55 => \n  array (\n    ''posid'' => ''55'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''首页_推荐楼盘1（7图）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''82'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  29 => \n  array (\n    ''posid'' => ''29'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_推荐楼盘2（7图）'',\n    ''maxnum'' => ''21'',\n    ''extention'' => '''',\n    ''listorder'' => ''81'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  56 => \n  array (\n    ''posid'' => ''56'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''首页_推荐楼盘2（7图）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''81'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  26 => \n  array (\n    ''posid'' => ''26'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_精品楼盘1（2图）'',\n    ''maxnum'' => ''2'',\n    ''extention'' => '''',\n    ''listorder'' => ''80'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  7 => \n  array (\n    ''posid'' => ''7'',\n    ''modelid'' => ''5'',\n    ''catid'' => ''0'',\n    ''name'' => ''视频首页焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''80'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  64 => \n  array (\n    ''posid'' => ''64'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_精品楼盘1（2图）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''80'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  79 => \n  array (\n    ''posid'' => ''79'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_推荐楼盘1（7图）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''80'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  27 => \n  array (\n    ''posid'' => ''27'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_精品楼盘2（8条）'',\n    ''maxnum'' => ''10'',\n    ''extention'' => '''',\n    ''listorder'' => ''79'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  65 => \n  array (\n    ''posid'' => ''65'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_精品楼盘2（8条）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''79'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  80 => \n  array (\n    ''posid'' => ''80'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_推荐楼盘2（7图）'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''79'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  9 => \n  array (\n    ''posid'' => ''9'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_搜索框下推荐楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''77'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  66 => \n  array (\n    ''posid'' => ''66'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_搜索框下推荐楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''77'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  81 => \n  array (\n    ''posid'' => ''81'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''首页_搜索框下推荐楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''75'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  15 => \n  array (\n    ''posid'' => ''15'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''14'',\n    ''name'' => ''新房首页_推荐楼盘'',\n    ''maxnum'' => ''100'',\n    ''extention'' => '''',\n    ''listorder'' => ''70'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  16 => \n  array (\n    ''posid'' => ''16'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''14'',\n    ''name'' => ''新房首页_推荐户型'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''65'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  17 => \n  array (\n    ''posid'' => ''17'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''14'',\n    ''name'' => ''新房首页_推荐样板间'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''64'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  18 => \n  array (\n    ''posid'' => ''18'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''46'',\n    ''name'' => ''商业地产_首页焦点图'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''59'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  5 => \n  array (\n    ''posid'' => ''5'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''20'',\n    ''name'' => ''旅游地产_首页焦点图'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''58'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  75 => \n  array (\n    ''posid'' => ''75'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''新房首页推荐楼盘'',\n    ''maxnum'' => ''100'',\n    ''extention'' => '''',\n    ''listorder'' => ''58'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  45 => \n  array (\n    ''posid'' => ''45'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''新房首页推荐楼盘'',\n    ''maxnum'' => ''100'',\n    ''extention'' => '''',\n    ''listorder'' => ''58'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  48 => \n  array (\n    ''posid'' => ''48'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''首页_精品楼盘1（2图）'',\n    ''maxnum'' => ''2'',\n    ''extention'' => '''',\n    ''listorder'' => ''57'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  49 => \n  array (\n    ''posid'' => ''49'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''首页_精品楼盘2（8条）'',\n    ''maxnum'' => ''8'',\n    ''extention'' => '''',\n    ''listorder'' => ''56'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  46 => \n  array (\n    ''posid'' => ''46'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''新房首页推荐户型'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''55'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  47 => \n  array (\n    ''posid'' => ''47'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''新房首页推荐样板间'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''54'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  76 => \n  array (\n    ''posid'' => ''76'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''新房首页推荐户型'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''52'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  77 => \n  array (\n    ''posid'' => ''77'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''新房首页推荐样板间'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''51'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  78 => \n  array (\n    ''posid'' => ''78'',\n    ''modelid'' => ''29'',\n    ''catid'' => ''0'',\n    ''name'' => ''推广楼盘'',\n    ''maxnum'' => ''4'',\n    ''extention'' => '''',\n    ''listorder'' => ''50'',\n    ''siteid'' => ''3'',\n    ''thumb'' => '''',\n  ),\n  67 => \n  array (\n    ''posid'' => ''67'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''栏目首页推荐'',\n    ''maxnum'' => ''100'',\n    ''extention'' => '''',\n    ''listorder'' => ''42'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  10 => \n  array (\n    ''posid'' => ''10'',\n    ''modelid'' => ''0'',\n    ''catid'' => ''0'',\n    ''name'' => ''栏目首页推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''40'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  19 => \n  array (\n    ''posid'' => ''19'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''在售商业地产推荐'',\n    ''maxnum'' => ''8'',\n    ''extention'' => '''',\n    ''listorder'' => ''30'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  69 => \n  array (\n    ''posid'' => ''69'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''0'',\n    ''name'' => ''在售商业地产推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''30'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  21 => \n  array (\n    ''posid'' => ''21'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''精品商业地产Ⅰ'',\n    ''maxnum'' => ''2'',\n    ''extention'' => '''',\n    ''listorder'' => ''28'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  23 => \n  array (\n    ''posid'' => ''23'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''精品商业地产Ⅱ'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''26'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  54 => \n  array (\n    ''posid'' => ''54'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯_首页焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''25'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  20 => \n  array (\n    ''posid'' => ''20'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''在售旅游地产推荐'',\n    ''maxnum'' => ''8'',\n    ''extention'' => '''',\n    ''listorder'' => ''25'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  22 => \n  array (\n    ''posid'' => ''22'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''精品旅游地产Ⅰ'',\n    ''maxnum'' => ''2'',\n    ''extention'' => '''',\n    ''listorder'' => ''24'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  24 => \n  array (\n    ''posid'' => ''24'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''精品旅游地产Ⅱ'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''23'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  71 => \n  array (\n    ''posid'' => ''71'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''14'',\n    ''name'' => ''新房楼盘超市页_推广楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''22'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  43 => \n  array (\n    ''posid'' => ''43'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''看房团首页_优惠打折信息'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''22'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  44 => \n  array (\n    ''posid'' => ''44'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''看房团首页_热点楼盘团购'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''21'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  83 => \n  array (\n    ''posid'' => ''83'',\n    ''modelid'' => ''13'',\n    ''catid'' => ''0'',\n    ''name'' => ''看房团-备选楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''21'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  25 => \n  array (\n    ''posid'' => ''25'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯_首页焦点图'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''20'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  42 => \n  array (\n    ''posid'' => ''42'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯_首页精品推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''19'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  12 => \n  array (\n    ''posid'' => ''12'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯首页_图片新闻焦点图'',\n    ''maxnum'' => ''5'',\n    ''extention'' => '''',\n    ''listorder'' => ''18'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  30 => \n  array (\n    ''posid'' => ''30'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯_右侧图片推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''17'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  50 => \n  array (\n    ''posid'' => ''50'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 推荐1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''16'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  14 => \n  array (\n    ''posid'' => ''14'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 推荐1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''16'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  51 => \n  array (\n    ''posid'' => ''51'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 推荐2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''15'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  31 => \n  array (\n    ''posid'' => ''31'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 推荐2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''15'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  32 => \n  array (\n    ''posid'' => ''32'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 图1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''14'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  52 => \n  array (\n    ''posid'' => ''52'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 图1'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''14'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  33 => \n  array (\n    ''posid'' => ''33'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 图2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''13'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  53 => \n  array (\n    ''posid'' => ''53'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''内容_标题下 图2'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''13'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  68 => \n  array (\n    ''posid'' => ''68'',\n    ''modelid'' => ''4'',\n    ''catid'' => ''0'',\n    ''name'' => ''图库_首页焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''11'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  40 => \n  array (\n    ''posid'' => ''40'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''右侧视频推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''10'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  70 => \n  array (\n    ''posid'' => ''70'',\n    ''modelid'' => ''4'',\n    ''catid'' => ''0'',\n    ''name'' => ''图库内页_推荐组图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''10'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  74 => \n  array (\n    ''posid'' => ''74'',\n    ''modelid'' => ''4'',\n    ''catid'' => ''0'',\n    ''name'' => ''图库_播放结束推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''10'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  13 => \n  array (\n    ''posid'' => ''13'',\n    ''modelid'' => ''82'',\n    ''catid'' => ''0'',\n    ''name'' => ''栏目页焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  11 => \n  array (\n    ''posid'' => ''11'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''53'',\n    ''name'' => ''家居首页_头条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  8 => \n  array (\n    ''posid'' => ''8'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''53'',\n    ''name'' => ''家居首页_焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  41 => \n  array (\n    ''posid'' => ''41'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''[新1]大头条下3条'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  84 => \n  array (\n    ''posid'' => ''84'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''6'',\n    ''name'' => ''二手房首页焦点图'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  72 => \n  array (\n    ''posid'' => ''72'',\n    ''modelid'' => ''21'',\n    ''catid'' => ''74'',\n    ''name'' => ''新房_楼盘超市_推广楼盘'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  82 => \n  array (\n    ''posid'' => ''82'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''6'',\n    ''name'' => ''微信专栏'',\n    ''maxnum'' => ''100'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n  73 => \n  array (\n    ''posid'' => ''73'',\n    ''modelid'' => ''23'',\n    ''catid'' => ''0'',\n    ''name'' => ''资讯_首页精品推荐'',\n    ''maxnum'' => ''20'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''2'',\n    ''thumb'' => '''',\n  ),\n  34 => \n  array (\n    ''posid'' => ''34'',\n    ''modelid'' => ''1'',\n    ''catid'' => ''0'',\n    ''name'' => ''[新1]大头条'',\n    ''maxnum'' => ''1'',\n    ''extention'' => '''',\n    ''listorder'' => ''0'',\n    ''siteid'' => ''1'',\n    ''thumb'' => '''',\n  ),\n);\n?>'),
('role_siteid.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  3 => \n  array (\n    0 => 1,\n  ),\n  8 => \n  array (\n    0 => 1,\n  ),\n  9 => \n  array (\n    0 => 1,\n  ),\n  10 => \n  array (\n    0 => 1,\n  ),\n  11 => \n  array (\n    0 => 1,\n  ),\n  12 => \n  array (\n    0 => 2,\n  ),\n);\n?>'),
('role.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''超级管理员'',\n  2 => ''站点管理员'',\n  3 => ''运营总监'',\n  4 => ''总编'',\n  5 => ''编辑'',\n  7 => ''发布人员'',\n  8 => ''新房主编'',\n  9 => ''新房编辑'',\n  10 => ''新闻主编'',\n  11 => ''新闻编辑'',\n  12 => ''管理员'',\n);\n?>'),
('urlrules_detail.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''urlruleid'' => ''1'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''1'',\n    ''urlrule'' => ''{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html'',\n    ''example'' => ''news/china/1000.html'',\n  ),\n  6 => \n  array (\n    ''urlruleid'' => ''6'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''index.php?s=content/index/lists/catid/{$catid}|index.php?s=content/index/lists/catid/{$catid}/page/{$page}'',\n    ''example'' => ''index.php?s=content/index/lists/catid/1/page/1'',\n  ),\n  11 => \n  array (\n    ''urlruleid'' => ''11'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''1'',\n    ''urlrule'' => ''{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html'',\n    ''example'' => ''2010/catdir_0720/1_2.html'',\n  ),\n  12 => \n  array (\n    ''urlruleid'' => ''12'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''1'',\n    ''urlrule'' => ''{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html'',\n    ''example'' => ''it/product/2010/0720/1_2.html'',\n  ),\n  16 => \n  array (\n    ''urlruleid'' => ''16'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''index.php?s=content/index/show/catid/{$catid}/id/{$id}|index.php?s=content/index/show/catid/{$catid}/id/{$id}/page/{$page}'',\n    ''example'' => ''index.php?s=content/index/show/catid/1/id/1'',\n  ),\n  17 => \n  array (\n    ''urlruleid'' => ''17'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''show-{$catid}-{$id}-{$page}.html'',\n    ''example'' => ''show-1-2-1.html'',\n  ),\n  18 => \n  array (\n    ''urlruleid'' => ''18'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''content-{$catid}-{$id}-{$page}.html'',\n    ''example'' => ''content-1-2-1.html'',\n  ),\n  30 => \n  array (\n    ''urlruleid'' => ''30'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''list{$lst}-g{$page}.html'',\n    ''example'' => ''list-g1.html'',\n  ),\n  31 => \n  array (\n    ''urlruleid'' => ''31'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''wenfang{$lst}-p{$page}.html'',\n    ''example'' => ''wenfang-p1.html'',\n  ),\n  32 => \n  array (\n    ''urlruleid'' => ''32'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''list-{$page}.html'',\n    ''example'' => ''list-1.html'',\n  ),\n  33 => \n  array (\n    ''urlruleid'' => ''33'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$id}'',\n    ''example'' => ''{$id}'',\n  ),\n  34 => \n  array (\n    ''urlruleid'' => ''34'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}company-{$id}.html'',\n    ''example'' => ''company-1.html'',\n  ),\n  35 => \n  array (\n    ''urlruleid'' => ''35'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$relation}/huxing.html'',\n    ''example'' => ''1/huxing.html'',\n  ),\n  36 => \n  array (\n    ''urlruleid'' => ''36'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$relation}/dongtai.html'',\n    ''example'' => ''1/dongtai.html'',\n  ),\n  37 => \n  array (\n    ''urlruleid'' => ''37'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$relation}/xiangce.html'',\n    ''example'' => ''1/xiangce.html'',\n  ),\n  38 => \n  array (\n    ''urlruleid'' => ''38'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$relation}/jiage.html'',\n    ''example'' => ''1/jiage.html'',\n  ),\n  40 => \n  array (\n    ''urlruleid'' => ''40'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''piclist-{$page}.html'',\n    ''example'' => ''piclist-1.html'',\n  ),\n  41 => \n  array (\n    ''urlruleid'' => ''41'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$xglp}/wenfang-p1.html'',\n    ''example'' => ''1/wenfang-p1.html'',\n  ),\n  42 => \n  array (\n    ''urlruleid'' => ''42'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''ybjlist{$lst}-p{$page}.html'',\n    ''example'' => ''ybjlist.html'',\n  ),\n  43 => \n  array (\n    ''urlruleid'' => ''43'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''hxlist{$lst}-p{$page}.html'',\n    ''example'' => ''hxlist.html'',\n  ),\n  44 => \n  array (\n    ''urlruleid'' => ''44'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}{$relation}/dianping.html'',\n    ''example'' => ''1/dianping.html'',\n  ),\n  45 => \n  array (\n    ''urlruleid'' => ''45'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''xclist{$lst}-p{$page}.html'',\n    ''example'' => ''xclist.html'',\n  ),\n  46 => \n  array (\n    ''urlruleid'' => ''46'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$house_path}fangyuan/{$id}.html'',\n    ''example'' => ''fangyuan/1.html'',\n  ),\n  47 => \n  array (\n    ''urlruleid'' => ''47'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$tuan_path}route_{$id}.html'',\n    ''example'' => ''route_1.html'',\n  ),\n  48 => \n  array (\n    ''urlruleid'' => ''48'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''rent-list{$lst}-g{$page}.html'',\n    ''example'' => ''rent-list-g1.html'',\n  ),\n  49 => \n  array (\n    ''urlruleid'' => ''49'',\n    ''module'' => ''content'',\n    ''file'' => ''category'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''xiaoqu-list{$lst}-g{$page}.html'',\n    ''example'' => ''xiaoqu-list-g1.html'',\n  ),\n  13 => \n  array (\n    ''urlruleid'' => ''13'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$esf_path}show-{$id}.html'',\n    ''example'' => ''esf/show-1.html'',\n  ),\n  14 => \n  array (\n    ''urlruleid'' => ''14'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$esf_path}rent-show-{$id}.html'',\n    ''example'' => ''esf/rent-show-1.html'',\n  ),\n  15 => \n  array (\n    ''urlruleid'' => ''15'',\n    ''module'' => ''content'',\n    ''file'' => ''show'',\n    ''ishtml'' => ''0'',\n    ''urlrule'' => ''{$esf_path}xiaoqu-show-{$id}.html'',\n    ''example'' => ''esf/xiaoqu-show-1.html'',\n  ),\n);\n?>'),
('urlrules.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => ''{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html'',\n  6 => ''index.php?s=content/index/lists/catid/{$catid}|index.php?s=content/index/lists/catid/{$catid}/page/{$page}'',\n  11 => ''{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html'',\n  12 => ''{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html'',\n  16 => ''index.php?s=content/index/show/catid/{$catid}/id/{$id}|index.php?s=content/index/show/catid/{$catid}/id/{$id}/page/{$page}'',\n  17 => ''show-{$catid}-{$id}-{$page}.html'',\n  18 => ''content-{$catid}-{$id}-{$page}.html'',\n  30 => ''list{$lst}-g{$page}.html'',\n  31 => ''wenfang{$lst}-p{$page}.html'',\n  32 => ''list-{$page}.html'',\n  33 => ''{$house_path}{$id}'',\n  34 => ''{$house_path}company-{$id}.html'',\n  35 => ''{$house_path}{$relation}/huxing.html'',\n  36 => ''{$house_path}{$relation}/dongtai.html'',\n  37 => ''{$house_path}{$relation}/xiangce.html'',\n  38 => ''{$house_path}{$relation}/jiage.html'',\n  40 => ''piclist-{$page}.html'',\n  41 => ''{$house_path}{$xglp}/wenfang-p1.html'',\n  42 => ''ybjlist{$lst}-p{$page}.html'',\n  43 => ''hxlist{$lst}-p{$page}.html'',\n  44 => ''{$house_path}{$relation}/dianping.html'',\n  45 => ''xclist{$lst}-p{$page}.html'',\n  46 => ''{$house_path}fangyuan/{$id}.html'',\n  47 => ''{$tuan_path}route_{$id}.html'',\n  48 => ''rent-list{$lst}-g{$page}.html'',\n  49 => ''xiaoqu-list{$lst}-g{$page}.html'',\n  13 => ''{$esf_path}show-{$id}.html'',\n  14 => ''{$esf_path}rent-show-{$id}.html'',\n  15 => ''{$esf_path}xiaoqu-show-{$id}.html'',\n);\n?>');
INSERT INTO `h5_cache` (`filename`, `path`, `data`) VALUES
('modules.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  ''admin'' => \n  array (\n    ''module'' => ''admin'',\n    ''name'' => ''admin'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  \\''admin_email\\'' => \\''admin@house5.net\\'',\n  \\''maxloginfailedtimes\\'' => \\''8\\'',\n  \\''minrefreshtime\\'' => \\''2\\'',\n  \\''mail_type\\'' => \\''1\\'',\n  \\''mail_server\\'' => \\''smtp.exmail.qq.com\\'',\n  \\''mail_port\\'' => \\''25\\'',\n  \\''category_ajax\\'' => \\''0\\'',\n  \\''mail_user\\'' => \\''\\'',\n  \\''mail_auth\\'' => \\''1\\'',\n  \\''mail_from\\'' => \\''\\'',\n  \\''mail_password\\'' => \\''\\'',\n  \\''errorlog_size\\'' => \\''20\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-10-18'',\n    ''updatedate'' => ''2010-10-18'',\n  ),\n  ''member'' => \n  array (\n    ''module'' => ''member'',\n    ''name'' => ''会员'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  \\''allowregister\\'' => \\''1\\'',\n  \\''choosemodel\\'' => \\''1\\'',\n  \\''enablemailcheck\\'' => \\''0\\'',\n  \\''registerverify\\'' => \\''1\\'',\n  \\''showapppoint\\'' => \\''0\\'',\n  \\''rmb_point_rate\\'' => \\''10\\'',\n  \\''defualtpoint\\'' => \\''0\\'',\n  \\''defualtamount\\'' => \\''0\\'',\n  \\''firstloginpoint\\'' => \\''\\'',\n  \\''showregprotocol\\'' => \\''0\\'',\n  \\''regprotocol\\'' => \\''		 欢迎您注册成为house5用户\r\n请仔细阅读下面的协议，只有接受协议才能继续进行注册。 \r\n1．服务条款的确认和接纳\r\n　　house5用户服务的所有权和运作权归house5拥有。house5所提供的服务将按照有关章程、服务条款和操作规则严格执行。用户通过注册程序点击“我同意” 按钮，即表示用户与house5达成协议并接受所有的服务条款。\r\n2． house5服务简介\r\n　　house5通过国际互联网为用户提供新闻及文章浏览、图片浏览、软件下载、网上留言和BBS论坛等服务。\r\n　　用户必须： \r\n　　1)购置设备，包括个人电脑一台、调制解调器一个及配备上网装置。 \r\n　　2)个人上网和支付与此服务有关的电话费用、网络费用。\r\n　　用户同意： \r\n　　1)提供及时、详尽及准确的个人资料。 \r\n　　2)不断更新注册资料，符合及时、详尽、准确的要求。所有原始键入的资料将引用为注册资料。 \r\n　　3)用户同意遵守《中华人民共和国保守国家秘密法》、《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》等有关计算机及互联网规定的法律和法规、实施办法。在任何情况下，house5合理地认为用户的行为可能违反上述法律、法规，house5可以在任何时候，不经事先通知终止向该用户提供服务。用户应了解国际互联网的无国界性，应特别注意遵守当地所有有关的法律和法规。\r\n3． 服务条款的修改\r\n　　house5会不定时地修改服务条款，服务条款一旦发生变动，将会在相关页面上提示修改内容。如果您同意改动，则再一次点击“我同意”按钮。 如果您不接受，则及时取消您的用户使用服务资格。\r\n4． 服务修订\r\n　　house5保留随时修改或中断服务而不需知照用户的权利。house5行使修改或中断服务的权利，不需对用户或第三方负责。\r\n5． 用户隐私制度\r\n　　尊重用户个人隐私是house5的 基本政策。house5不会公开、编辑或透露用户的注册信息，除非有法律许可要求，或house5在诚信的基础上认为透露这些信息在以下三种情况是必要的： \r\n　　1)遵守有关法律规定，遵从合法服务程序。 \r\n　　2)保持维护house5的商标所有权。 \r\n　　3)在紧急情况下竭力维护用户个人和社会大众的隐私安全。 \r\n　　4)符合其他相关的要求。 \r\n6．用户的帐号，密码和安全性\r\n　　一旦注册成功成为house5用户，您将得到一个密码和帐号。如果您不保管好自己的帐号和密码安全，将对因此产生的后果负全部责任。另外，每个用户都要对其帐户中的所有活动和事件负全责。您可随时根据指示改变您的密码，也可以结束旧的帐户重开一个新帐户。用户同意若发现任何非法使用用户帐号或安全漏洞的情况，立即通知house5。\r\n7． 免责条款\r\n　　用户明确同意网站服务的使用由用户个人承担风险。 　　 \r\n　　house5不作任何类型的担保，不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。用户理解并接受：任何通过house5服务取得的信息资料的可靠性取决于用户自己，用户自己承担所有风险和责任。 \r\n8．有限责任\r\n　　house5对任何直接、间接、偶然、特殊及继起的损害不负责任。\r\n9． 不提供零售和商业性服务 \r\n　　用户使用网站服务的权利是个人的。用户只能是一个单独的个体而不能是一个公司或实体商业性组织。用户承诺不经house5同意，不能利用网站服务进行销售或其他商业用途。\r\n10．用户责任 \r\n　　用户单独承担传输内容的责任。用户必须遵循： \r\n　　1)从中国境内向外传输技术性资料时必须符合中国有关法规。 \r\n　　2)使用网站服务不作非法用途。 \r\n　　3)不干扰或混乱网络服务。 \r\n　　4)不在论坛BBS或留言簿发表任何与政治相关的信息。 \r\n　　5)遵守所有使用网站服务的网络协议、规定、程序和惯例。\r\n　　6)不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益。\r\n　　7)不得利用本站制作、复制和传播下列信息： \r\n　　　1、煽动抗拒、破坏宪法和法律、行政法规实施的；\r\n　　　2、煽动颠覆国家政权，推翻社会主义制度的；\r\n　　　3、煽动分裂国家、破坏国家统一的；\r\n　　　4、煽动民族仇恨、民族歧视，破坏民族团结的；\r\n　　　5、捏造或者歪曲事实，散布谣言，扰乱社会秩序的；\r\n　　　6、宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；\r\n　　　7、公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；\r\n　　　8、损害国家机关信誉的；\r\n　　　9、其他违反宪法和法律行政法规的；\r\n　　　10、进行商业广告行为的。\r\n　　用户不能传输任何教唆他人构成犯罪行为的资料；不能传输长国内不利条件和涉及国家安全的资料；不能传输任何不符合当地法规、国家法律和国际法 律的资料。未经许可而非法进入其它电脑系统是禁止的。若用户的行为不符合以上的条款，house5将取消用户服务帐号。\r\n11．网站内容的所有权\r\n　　house5定义的内容包括：文字、软件、声音、相片、录象、图表；在广告中全部内容；电子邮件的全部内容；house5为用户提供的商业信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在house5和广告商授权下才能使用这些内容，而不能擅自复制、篡改这些内容、或创造与内容有关的派生产品。\r\n12．附加信息服务\r\n　　用户在享用house5提供的免费服务的同时，同意接受house5提供的各类附加信息服务。\r\n13．解释权\r\n　　本注册协议的解释权归house5所有。如果其中有任何条款与国家的有关法律相抵触，则以国家法律的明文规定为准。 \\'',\n  \\''registerverifymessage\\'' => \\'' 欢迎您注册成为house5用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}\r\n或者将网址复制到浏览器：{url}\\'',\n  \\''forgetpassword\\'' => \\''house5密码找回，请在一小时内点击下面链接进行操作：{click}\r\n或者将网址复制到浏览器：{url}\\'',\n  \\''broker_check\\'' => \\''0\\'',\n  \\''esf_check\\'' => \\''0\\'',\n  \\''refresh_times\\'' => \\''2\\'',\n  \\''tags_valid\\'' => \\''\\'',\n  \\''overtime\\'' => \\''\\'',\n  \\''add_esf_point\\'' => \\''\\'',\n  \\''add_rent_point\\'' => \\''\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''pay'' => \n  array (\n    ''module'' => ''pay'',\n    ''name'' => ''支付'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''digg'' => \n  array (\n    ''module'' => ''digg'',\n    ''name'' => ''顶一下'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''special'' => \n  array (\n    ''module'' => ''special'',\n    ''name'' => ''专题'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''content'' => \n  array (\n    ''module'' => ''content'',\n    ''name'' => ''内容模块'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''search'' => \n  array (\n    ''module'' => ''search'',\n    ''name'' => ''全站搜索'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  \\''fulltextenble\\'' => \\''1\\'',\n  \\''relationenble\\'' => \\''1\\'',\n  \\''suggestenable\\'' => \\''1\\'',\n  \\''sphinxenable\\'' => \\''0\\'',\n  \\''sphinxhost\\'' => \\''10.228.134.102\\'',\n  \\''sphinxport\\'' => \\''9312\\'',\n  1 => \n  array (\n    \\''fulltextenble\\'' => \\''1\\'',\n    \\''relationenble\\'' => \\''1\\'',\n    \\''suggestenable\\'' => \\''0\\'',\n    \\''sphinxenable\\'' => \\''0\\'',\n    \\''sphinxhost\\'' => \\''\\'',\n    \\''sphinxport\\'' => \\''\\'',\n  ),\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''scan'' => \n  array (\n    ''module'' => ''scan'',\n    ''name'' => ''木马扫描'',\n    ''url'' => ''scan'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''attachment'' => \n  array (\n    ''module'' => ''attachment'',\n    ''name'' => ''附件'',\n    ''url'' => ''attachment'',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''block'' => \n  array (\n    ''module'' => ''block'',\n    ''name'' => ''碎片'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''collection'' => \n  array (\n    ''module'' => ''collection'',\n    ''name'' => ''采集模块'',\n    ''url'' => ''collection'',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''dbsource'' => \n  array (\n    ''module'' => ''dbsource'',\n    ''name'' => ''数据源'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => '''',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''template'' => \n  array (\n    ''module'' => ''template'',\n    ''name'' => ''模板风格'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''release'' => \n  array (\n    ''module'' => ''release'',\n    ''name'' => ''发布点'',\n    ''url'' => '''',\n    ''iscore'' => ''1'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-01'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''cnzz'' => \n  array (\n    ''module'' => ''cnzz'',\n    ''name'' => ''CNZZ统计'',\n    ''url'' => ''cnzz/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''CNZZ统计'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-15'',\n    ''updatedate'' => ''2010-09-15'',\n  ),\n  ''announce'' => \n  array (\n    ''module'' => ''announce'',\n    ''name'' => ''公告'',\n    ''url'' => ''announce/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''公告'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''comment'' => \n  array (\n    ''module'' => ''comment'',\n    ''name'' => ''评论'',\n    ''url'' => ''comment/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''评论'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''link'' => \n  array (\n    ''module'' => ''link'',\n    ''name'' => ''友情链接'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\n  1 => \n  array (\n    \\''is_post\\'' => \\''1\\'',\n    \\''enablecheckcode\\'' => \\''0\\'',\n  ),\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''vote'' => \n  array (\n    ''module'' => ''vote'',\n    ''name'' => ''投票'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => ''array (\r\n  1 => \r\n  array (\r\n    \\''default_style\\'' => \\''default\\'',\r\n    \\''vote_tp_template\\'' => \\''vote_tp\\'',\r\n    \\''allowguest\\'' => \\''1\\'',\r\n    \\''enabled\\'' => \\''1\\'',\r\n    \\''interval\\'' => \\''1\\'',\r\n    \\''credit\\'' => \\''1\\'',\r\n  ),\r\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''message'' => \n  array (\n    ''module'' => ''message'',\n    ''name'' => ''短消息'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-09-06'',\n    ''updatedate'' => ''2010-09-06'',\n  ),\n  ''mood'' => \n  array (\n    ''module'' => ''mood'',\n    ''name'' => ''新闻心情'',\n    ''url'' => ''mood/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''新闻心情'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''poster'' => \n  array (\n    ''module'' => ''poster'',\n    ''name'' => ''广告模块'',\n    ''url'' => ''poster/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''广告模块'',\n    ''setting'' => ''array (\n  \\''enablehits\\'' => \\''1\\'',\n  \\''ext\\'' => \\''\\'',\n  \\''maxsize\\'' => \\''\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''formguide'' => \n  array (\n    ''module'' => ''formguide'',\n    ''name'' => ''表单向导'',\n    ''url'' => ''formguide/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''formguide'',\n    ''setting'' => ''array (\n  \\''allowmultisubmit\\'' => \\''1\\'',\n  \\''interval\\'' => \\''\\'',\n  \\''allowunreg\\'' => \\''1\\'',\n  \\''mailmessage\\'' => \\''\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-10-20'',\n    ''updatedate'' => ''2010-10-20'',\n  ),\n  ''wap'' => \n  array (\n    ''module'' => ''wap'',\n    ''name'' => ''手机门户'',\n    ''url'' => ''wap/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''手机门户'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''upgrade'' => \n  array (\n    ''module'' => ''upgrade'',\n    ''name'' => ''在线升级'',\n    ''url'' => '''',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => '''',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2011-05-18'',\n    ''updatedate'' => ''2011-05-18'',\n  ),\n  ''tag'' => \n  array (\n    ''module'' => ''tag'',\n    ''name'' => ''标签向导'',\n    ''url'' => ''tag/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''标签向导'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-01-06'',\n    ''updatedate'' => ''2012-01-06'',\n  ),\n  ''sms'' => \n  array (\n    ''module'' => ''sms'',\n    ''name'' => ''短信平台'',\n    ''url'' => ''sms/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''短信平台'',\n    ''setting'' => ''array (\n  \\''sms_enable\\'' => \\''1\\'',\n  \\''userid\\'' => \\''1590\\'',\n  \\''productid\\'' => \\''33646\\'',\n  \\''sms_key\\'' => \\''828622a8dc3922394791d23ebcafe4ba\\'',\n)'',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2011-09-02'',\n    ''updatedate'' => ''2011-09-02'',\n  ),\n  ''reviews'' => \n  array (\n    ''module'' => ''reviews'',\n    ''name'' => ''点评'',\n    ''url'' => ''reviews/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''点评'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2010-10-30'',\n    ''updatedate'' => ''2010-10-30'',\n  ),\n  ''ssi'' => \n  array (\n    ''module'' => ''ssi'',\n    ''name'' => ''模版碎片标签'',\n    ''url'' => ''ssi/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.0'',\n    ''description'' => ''模版碎片标签向导'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2012-09-23'',\n    ''updatedate'' => ''2012-09-23'',\n  ),\n  ''house5_player'' => \n  array (\n    ''module'' => ''house5_player'',\n    ''name'' => ''House5 player'',\n    ''url'' => ''house5_player/'',\n    ''iscore'' => ''0'',\n    ''version'' => ''1.1'',\n    ''description'' => ''House5 player 模块配置'',\n    ''setting'' => '''',\n    ''listorder'' => ''0'',\n    ''disabled'' => ''0'',\n    ''installdate'' => ''2013-06-01'',\n    ''updatedate'' => ''2013-06-01'',\n  ),\n);\n?>'),
('model.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''modelid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''name'' => ''文章模型'',\n    ''description'' => '''',\n    ''tablename'' => ''news'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  3 => \n  array (\n    ''modelid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''name'' => ''图片模型'',\n    ''description'' => '''',\n    ''tablename'' => ''picture'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_picture'',\n    ''list_template'' => ''list_picture'',\n    ''show_template'' => ''show_picture'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  13 => \n  array (\n    ''modelid'' => ''13'',\n    ''siteid'' => ''1'',\n    ''name'' => ''房产模型'',\n    ''description'' => '''',\n    ''tablename'' => ''house'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_house'',\n    ''list_template'' => ''list_house'',\n    ''show_template'' => ''show_house'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  14 => \n  array (\n    ''modelid'' => ''14'',\n    ''siteid'' => ''1'',\n    ''name'' => ''销售动态'',\n    ''description'' => '''',\n    ''tablename'' => ''dynamic'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  15 => \n  array (\n    ''modelid'' => ''15'',\n    ''siteid'' => ''1'',\n    ''name'' => ''价格明细'',\n    ''description'' => '''',\n    ''tablename'' => ''price'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  16 => \n  array (\n    ''modelid'' => ''16'',\n    ''siteid'' => ''1'',\n    ''name'' => ''公司库'',\n    ''description'' => '''',\n    ''tablename'' => ''company'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  18 => \n  array (\n    ''modelid'' => ''18'',\n    ''siteid'' => ''1'',\n    ''name'' => ''问房'',\n    ''description'' => '''',\n    ''tablename'' => ''ask'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  26 => \n  array (\n    ''modelid'' => ''26'',\n    ''siteid'' => ''1'',\n    ''name'' => ''成交数据'',\n    ''description'' => ''每日成交数据'',\n    ''tablename'' => ''selldata'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  28 => \n  array (\n    ''modelid'' => ''28'',\n    ''siteid'' => ''1'',\n    ''name'' => ''编辑点评'',\n    ''description'' => '''',\n    ''tablename'' => ''dianping'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  34 => \n  array (\n    ''modelid'' => ''34'',\n    ''siteid'' => ''1'',\n    ''name'' => ''房源'',\n    ''description'' => '''',\n    ''tablename'' => ''housesell'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  37 => \n  array (\n    ''modelid'' => ''37'',\n    ''siteid'' => ''1'',\n    ''name'' => ''看房团'',\n    ''description'' => '''',\n    ''tablename'' => ''kanfang'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  39 => \n  array (\n    ''modelid'' => ''39'',\n    ''siteid'' => ''1'',\n    ''name'' => ''二手房出售'',\n    ''description'' => '''',\n    ''tablename'' => ''esf'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  40 => \n  array (\n    ''modelid'' => ''40'',\n    ''siteid'' => ''1'',\n    ''name'' => ''小区'',\n    ''description'' => '''',\n    ''tablename'' => ''community'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  41 => \n  array (\n    ''modelid'' => ''41'',\n    ''siteid'' => ''1'',\n    ''name'' => ''二手房出租'',\n    ''description'' => '''',\n    ''tablename'' => ''esf_rent'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  4 => \n  array (\n    ''modelid'' => ''4'',\n    ''siteid'' => ''1'',\n    ''name'' => ''图库模型'',\n    ''description'' => '''',\n    ''tablename'' => ''pic'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''house5-style1'',\n    ''category_template'' => ''category_picture'',\n    ''list_template'' => ''list_picture'',\n    ''show_template'' => ''show_picture'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  5 => \n  array (\n    ''modelid'' => ''5'',\n    ''siteid'' => ''1'',\n    ''name'' => ''视频模型'',\n    ''description'' => '''',\n    ''tablename'' => ''video'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''house5-style1'',\n    ''category_template'' => ''category_video'',\n    ''list_template'' => ''list_video'',\n    ''show_template'' => ''show_video'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  29 => \n  array (\n    ''modelid'' => ''29'',\n    ''siteid'' => ''1'',\n    ''name'' => ''楼栋'',\n    ''description'' => '''',\n    ''tablename'' => ''building'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''house5-style1'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  30 => \n  array (\n    ''modelid'' => ''30'',\n    ''siteid'' => ''1'',\n    ''name'' => ''房间'',\n    ''description'' => '''',\n    ''tablename'' => ''room'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''house5-style1'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  23 => \n  array (\n    ''modelid'' => ''23'',\n    ''siteid'' => ''2'',\n    ''name'' => ''资讯'',\n    ''description'' => '''',\n    ''tablename'' => ''ytnews'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_news'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  21 => \n  array (\n    ''modelid'' => ''21'',\n    ''siteid'' => ''2'',\n    ''name'' => ''新房'',\n    ''description'' => '''',\n    ''tablename'' => ''ythouse'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category_house'',\n    ''list_template'' => ''list_house'',\n    ''show_template'' => ''show_house'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  22 => \n  array (\n    ''modelid'' => ''22'',\n    ''siteid'' => ''2'',\n    ''name'' => ''公司库'',\n    ''description'' => '''',\n    ''tablename'' => ''ytcompany'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show_company'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  24 => \n  array (\n    ''modelid'' => ''24'',\n    ''siteid'' => ''2'',\n    ''name'' => ''图片'',\n    ''description'' => '''',\n    ''tablename'' => ''ytpicture'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''default'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n  25 => \n  array (\n    ''modelid'' => ''25'',\n    ''siteid'' => ''2'',\n    ''name'' => ''问房'',\n    ''description'' => '''',\n    ''tablename'' => ''ytask'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => ''yantai'',\n    ''category_template'' => ''category'',\n    ''list_template'' => ''list'',\n    ''show_template'' => ''show'',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''0'',\n  ),\n);\n?>'),
('workflow_1.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''workflowid'' => ''1'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''1'',\n    ''workname'' => ''一级审核'',\n    ''description'' => ''审核一次'',\n    ''setting'' => ''array (\n  1 => \n  array (\n    0 => \\''yangyy\\'',\n    1 => \\''congdd\\'',\n    2 => \\''zhanghx\\'',\n  ),\n  2 => \\''\\'',\n  3 => \\''\\'',\n  4 => \\''\\'',\n  \\''nocheck_users\\'' => \n  array (\n    0 => \\''yangyy\\'',\n    1 => \\''miaomiao\\'',\n    2 => \\''congdd\\'',\n    3 => \\''zhangh\\'',\n    4 => \\''zhanghx\\'',\n  ),\n)'',\n    ''flag'' => ''0'',\n  ),\n  2 => \n  array (\n    ''workflowid'' => ''2'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''2'',\n    ''workname'' => ''二级审核'',\n    ''description'' => ''审核两次'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n  3 => \n  array (\n    ''workflowid'' => ''3'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''3'',\n    ''workname'' => ''三级审核'',\n    ''description'' => ''审核三次'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n  4 => \n  array (\n    ''workflowid'' => ''4'',\n    ''siteid'' => ''1'',\n    ''steps'' => ''4'',\n    ''workname'' => ''四级审核'',\n    ''description'' => ''四级审核'',\n    ''setting'' => '''',\n    ''flag'' => ''0'',\n  ),\n);\n?>'),
('member_model.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  10 => \n  array (\n    ''modelid'' => ''10'',\n    ''siteid'' => ''1'',\n    ''name'' => ''普通会员'',\n    ''description'' => ''普通会员'',\n    ''tablename'' => ''member_detail'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''2'',\n  ),\n  35 => \n  array (\n    ''modelid'' => ''35'',\n    ''siteid'' => ''1'',\n    ''name'' => ''代理商'',\n    ''description'' => ''楼盘代理商、分销商'',\n    ''tablename'' => ''member_daili'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''1'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''2'',\n  ),\n  36 => \n  array (\n    ''modelid'' => ''36'',\n    ''siteid'' => ''1'',\n    ''name'' => ''开发商'',\n    ''description'' => ''楼盘开发商'',\n    ''tablename'' => ''member_kfs'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''0'',\n    ''type'' => ''2'',\n  ),\n  42 => \n  array (\n    ''modelid'' => ''42'',\n    ''siteid'' => ''1'',\n    ''name'' => ''经纪人'',\n    ''description'' => ''经纪人'',\n    ''tablename'' => ''member_broker'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''0'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''2'',\n    ''type'' => ''2'',\n  ),\n  43 => \n  array (\n    ''modelid'' => ''43'',\n    ''siteid'' => ''1'',\n    ''name'' => ''中介公司'',\n    ''description'' => ''中介公司'',\n    ''tablename'' => ''member_company'',\n    ''setting'' => '''',\n    ''addtime'' => ''0'',\n    ''items'' => ''0'',\n    ''enablesearch'' => ''1'',\n    ''disabled'' => ''1'',\n    ''default_style'' => '''',\n    ''category_template'' => '''',\n    ''list_template'' => '''',\n    ''show_template'' => '''',\n    ''js_template'' => '''',\n    ''admin_list_template'' => '''',\n    ''member_add_template'' => '''',\n    ''member_list_template'' => '''',\n    ''sort'' => ''3'',\n    ''type'' => ''2'',\n  ),\n);\n?>'),
('special.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n);\n?>'),
('common.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  ''admin_email'' => ''admin@house5.net'',\n  ''maxloginfailedtimes'' => ''8'',\n  ''minrefreshtime'' => ''2'',\n  ''mail_type'' => ''1'',\n  ''mail_server'' => ''smtp.exmail.qq.com'',\n  ''mail_port'' => ''25'',\n  ''category_ajax'' => ''0'',\n  ''mail_user'' => '''',\n  ''mail_auth'' => ''1'',\n  ''mail_from'' => '''',\n  ''mail_password'' => '''',\n  ''errorlog_size'' => ''20'',\n);\n?>'),
('vote.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''default_style'' => ''default'',\n    ''vote_tp_template'' => ''vote_tp'',\n    ''allowguest'' => ''1'',\n    ''enabled'' => ''1'',\n    ''interval'' => ''1'',\n    ''credit'' => ''1'',\n  ),\n);\n?>'),
('link.cache.php', 'caches_commons/caches_data/', '<?php\nreturn array (\n  1 => \n  array (\n    ''is_post'' => ''1'',\n    ''enablecheckcode'' => ''0'',\n  ),\n);\n?>');

-- --------------------------------------------------------

--
-- 表的结构 `h5_category`
--

CREATE TABLE IF NOT EXISTS `h5_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` varchar(15) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL,
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `arrchildid` mediumtext NOT NULL,
  `catname` varchar(30) NOT NULL,
  `style` varchar(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `parentdir` varchar(100) NOT NULL,
  `catdir` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `items` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `setting` mediumtext NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sethtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `letter` varchar(30) NOT NULL,
  `usable_type` varchar(255) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `module` (`module`,`parentid`,`listorder`,`catid`),
  KEY `siteid` (`siteid`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=115 ;

--
-- 导出表中的数据 `h5_category`
--

INSERT INTO `h5_category` (`catid`, `siteid`, `module`, `type`, `modelid`, `parentid`, `arrparentid`, `child`, `arrchildid`, `catname`, `style`, `image`, `description`, `parentdir`, `catdir`, `url`, `items`, `hits`, `setting`, `listorder`, `ismenu`, `sethtml`, `letter`, `usable_type`) VALUES
(1, 1, 'content', 1, 0, 0, '0', 1, '1,2,3,4,5', '网站介绍', '', '', '', '', 'about', '/news/about/', 0, 0, 'array (\n  ''ishtml'' => ''1'',\n  ''template_list'' => ''default'',\n  ''page_template'' => ''page'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => '''',\n  ''repeatchargedays'' => ''1'',\n)', 80, 0, 0, 'wangzhanjieshao', ''),
(2, 1, 'content', 1, 0, 1, '0,1', 0, '2', '关于我们', '', '', '', 'about/', 'aboutus', '/news/about/aboutus/', 0, 0, 'array (\n  ''ishtml'' => ''1'',\n  ''template_list'' => ''default'',\n  ''page_template'' => ''page'',\n  ''meta_title'' => ''关于我们'',\n  ''meta_keywords'' => ''关于我们'',\n  ''meta_description'' => ''关于我们'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => '''',\n  ''repeatchargedays'' => ''1'',\n)', 81, 1, 0, 'guanyuwomen', ''),
(3, 1, 'content', 1, 0, 1, '0,1', 0, '3', '联系方式', '', '', '', 'about/', 'contactus', '/news/about/contactus/', 0, 0, 'array (\n  ''ishtml'' => ''1'',\n  ''template_list'' => ''default'',\n  ''page_template'' => ''page'',\n  ''meta_title'' => ''联系方式'',\n  ''meta_keywords'' => ''联系方式'',\n  ''meta_description'' => ''联系方式'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => '''',\n  ''repeatchargedays'' => ''1'',\n)', 82, 1, 0, 'lianxifangshi', ''),
(4, 1, 'content', 1, 0, 1, '0,1', 0, '4', '版权声明', '', '', '', 'about/', 'copyright', '/news/about/copyright/', 0, 0, 'array (\n  ''ishtml'' => ''1'',\n  ''template_list'' => ''default'',\n  ''page_template'' => ''page'',\n  ''meta_title'' => ''版权声明'',\n  ''meta_keywords'' => ''版权声明'',\n  ''meta_description'' => ''版权声明'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => '''',\n  ''repeatchargedays'' => ''1'',\n)', 83, 1, 0, 'banquanshengming', ''),
(5, 1, 'content', 1, 0, 1, '0,1', 0, '5', '招聘信息', '', '', '', 'about/', 'hr', '/news/about/hr/', 0, 0, 'array (\n  ''ishtml'' => ''1'',\n  ''template_list'' => ''default'',\n  ''page_template'' => ''page'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => '''',\n  ''repeatchargedays'' => ''1'',\n)', 84, 1, 0, 'zhaopinxinxi', ''),
(6, 1, 'content', 0, 1, 0, '0', 1, '6,16,24,25,26,49,27,28,29,30,31,32,33,34,35,36,37,80,38,64,39,40,44,21,46,23,41,42,43,60,53,54,55,56,57,58,59,114,63,65,66,67,48,62', '资讯', '', '', '', '', 'news', '/news/', 0, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''1'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => ''房地产信息'',\n  ''meta_keywords'' => ''房地产信息,新闻网,房地产新闻,房产网,信息港,信息门户'',\n  ''meta_description'' => ''房地产网()新闻资讯频道提供最新、最权威的房产信息资讯。'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 1, 1, 1, 'zixun', ''),
(99, 1, 'content', 0, 28, 9, '0,9', 0, '99', '编辑点评', '', '', '', 'house/', 'dianping', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/99', 267, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => ''新房|新楼盘|购房中心'',\n  ''meta_keywords'' => ''新房,楼盘信息,楼盘地图,楼盘报价,楼盘价格,别墅,写字楼,商铺,公寓,经济适用房,热销楼盘'',\n  ''meta_description'' => ''新房购房中心是一个强大、准确的地区楼盘信息库,包含了最新楼盘信息、房价信息、新房价格、楼盘地图等权威信息库'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''44'',\n)', 16, 0, 0, 'bianjidianping', ''),
(8, 1, 'content', 0, 3, 9, '0,9', 0, '8', '图片', '', '', '', 'house/', 'pps', 'http://demo1.house5.net/xclist{$lst}-p1.html', 873, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category_picture'',\n  ''list_template'' => ''list_xiangce'',\n  ''show_template'' => ''show_picture'',\n  ''meta_title'' => ''楼盘实景图|楼盘效果图|楼盘活动图|楼盘样板间|楼盘鸟瞰图|楼盘沙盘图'',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''45'',\n  ''show_ruleid'' => ''37'',\n)', 2, 1, 0, 'tupian', ',12,13,14,15,16,17,'),
(9, 1, 'content', 0, 13, 0, '0', 1, '9,14,8,13,11,12,15,99,19,20,107', '房产', '', '', '', '', 'house', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/9', 0, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => '''',\n  ''list_template'' => ''list_house'',\n  ''show_template'' => ''show_house'',\n  ''meta_title'' => ''新房|新楼盘|购房中心'',\n  ''meta_keywords'' => ''新房,楼盘信息,楼盘地图,楼盘报价,楼盘价格,别墅,写字楼,商铺,公寓,经济适用房,热销楼盘'',\n  ''meta_description'' => ''新房购房中心是一个强大、准确的地区楼盘信息库,包含了最新楼盘信息、房价信息、新房价格、楼盘地图等权威信息库'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''33'',\n)', 9, 1, 0, 'fangchan', ',64,63,55,56,57,58,59,60,61,62,'),
(80, 1, 'content', 0, 26, 25, '0,6,25', 0, '80', '成交数据', '', '', '', 'news/loushi/', 'data', '/news/loushi/data/', 79, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 80, 1, 1, 'chengjiaoshuju', ''),
(11, 1, 'content', 0, 15, 9, '0,9', 0, '11', '价格明细', '', '', '', 'house/', 'price', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/11', 508, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''38'',\n)', 5, 0, 0, 'jiagemingxi', ''),
(12, 1, 'content', 0, 16, 9, '0,9', 0, '12', '公司简介', '', '', '', 'house/', 'company', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/12', 577, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => ''公司简介,'',\n  ''meta_keywords'' => ''公司简介,'',\n  ''meta_description'' => ''新房频道收集整理地区的最新楼盘,房价趋势,买房资讯,房产新闻,楼市动态等相关内容，让地区的广大网友朋友们了解最新的最全的新房,房价,楼盘相关资讯,帮助广大网友朋友们选房、购房、买房等。'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''34'',\n)', 6, 0, 0, 'gongsijianjie', ',8,9,10,11,'),
(13, 1, 'content', 0, 3, 9, '0,9', 0, '13', '户型', '', '', '', 'house/', 'unit', 'http://demo1.house5.net/hxlist{$lst}-p1.html', 570, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category_picture'',\n  ''list_template'' => ''list_huxing'',\n  ''show_template'' => ''show_picture'',\n  ''meta_title'' => ''楼盘户型图'',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''43'',\n  ''show_ruleid'' => ''35'',\n)', 3, 0, 0, 'huxing', ',18,19,20,21,22,'),
(14, 1, 'content', 0, 13, 9, '0,9', 0, '14', '新盘', '', '', '', 'house/', 'xinfang', 'http://demo1.house5.net/list{$lst}-g1.html', 504, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_house'',\n  ''show_template'' => ''show_house'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => ''房价,楼市,买房,新房,购房,业主论坛,新房,写字楼,商铺,团购,楼盘对比,地图找房,买房就来'',\n  ''meta_description'' => ''新房频道收集整理地区的最新楼盘,房价趋势,买房资讯,房产新闻,楼市动态等相关内容，让地区的广大网友朋友们了解最新的最全的新房,房价,楼盘相关资讯,帮助广大网友朋友们选房、购房、买房等。'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''30'',\n  ''show_ruleid'' => ''33'',\n)', 1, 1, 0, 'xinpan', ''),
(15, 1, 'content', 0, 18, 9, '0,9', 0, '15', '问房', '', '', '', 'house/', 'ask', 'http://demo1.house5.net/wenfang{$lst}-p1.html', 39, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_wenfang'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''31'',\n  ''show_ruleid'' => ''41'',\n)', 15, 0, 0, 'wenfang', ''),
(16, 1, 'content', 0, 1, 6, '0,6', 0, '16', '全国楼市', '', '', '', 'news/', 'quanguo', '/news/quanguo/', 8742, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 16, 1, 1, 'quanguoloushi', ''),
(24, 1, 'content', 0, 1, 6, '0,6', 0, '24', '关注', '', '', '', 'news/', 'bendi', '/news/bendi/', 2150, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 24, 1, 1, 'guanzhu', ''),
(21, 1, 'content', 0, 1, 44, '0,6,44', 0, '21', '行业动态', '', '', '', 'news/trip/', 'dongtai', '/news/trip/dongtai/', 112, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 21, 1, 1, 'xingyedongtai', ''),
(23, 1, 'content', 0, 1, 46, '0,6,46', 0, '23', '商业动态', '', '', '', 'news/shop/', 'shopzixun', '/news/shop/shopzixun/', 945, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 23, 1, 1, 'shangyedongtai', ''),
(25, 1, 'content', 0, 1, 6, '0,6', 1, '25,26,49,27,28,29,30,31,32,33,34,35,36,37,80', '楼市', '', '', '', 'news/', 'loushi', '/news/loushi/', 0, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 25, 0, 1, 'loushi', ''),
(26, 1, 'content', 0, 1, 25, '0,6,25', 0, '26', '楼市快报', '', '', '', 'news/loushi/', 'kuaibao', '/news/loushi/kuaibao/', 741, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 26, 0, 1, 'loushikuaibao', ''),
(27, 1, 'content', 0, 1, 25, '0,6,25', 0, '27', '行情播报', '', '', '', 'news/loushi/', 'bobao', '/news/loushi/bobao/', 132, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 27, 1, 1, 'xingqingbobao', ''),
(28, 1, 'content', 0, 1, 25, '0,6,25', 0, '28', '项目进度', '', '', '', 'news/loushi/', 'jindu', '/news/loushi/jindu/', 419, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 28, 1, 1, 'xiangmujindu', ''),
(41, 1, 'content', 0, 1, 46, '0,6,46', 0, '41', '投资案例', '', '', '', 'news/shop/', 'touzi', '/news/shop/touzi/', 47, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 41, 1, 1, 'touzianli', ''),
(29, 1, 'content', 0, 1, 25, '0,6,25', 0, '29', '优惠信息', '', '', '', 'news/loushi/', 'youhui', '/news/loushi/youhui/', 234, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 29, 1, 1, 'youhuixinxi', ''),
(30, 1, 'content', 0, 1, 25, '0,6,25', 0, '30', '市场分析', '', '', '', 'news/loushi/', 'diaocha', '/news/loushi/diaocha/', 165, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 30, 1, 1, 'shichangfenxi', ''),
(31, 1, 'content', 0, 1, 25, '0,6,25', 0, '31', '看房日记', '', '', '', 'news/loushi/', 'riji', '/news/loushi/riji/', 91, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 31, 1, 1, 'kanfangriji', ''),
(32, 1, 'content', 0, 1, 25, '0,6,25', 0, '32', '地产招聘', '', '', '', 'news/loushi/', 'job', '/news/loushi/job/', 11, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 32, 1, 1, 'dichanzhaopin', ''),
(33, 1, 'content', 0, 1, 25, '0,6,25', 0, '33', '土地交易', '', '', '', 'news/loushi/', 'tudi', '/news/loushi/tudi/', 235, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 33, 1, 1, 'tudijiaoyi', ''),
(34, 1, 'content', 0, 1, 25, '0,6,25', 0, '34', '楼市周报', '', '', '', 'news/loushi/', 'zhoubao', '/news/loushi/zhoubao/', 24, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 34, 1, 1, 'loushizhoubao', ''),
(35, 1, 'content', 0, 1, 25, '0,6,25', 0, '35', '购房宝典', '', '', '', 'news/loushi/', 'baodian', '/news/loushi/baodian/', 990, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 35, 1, 1, 'goufangbaodian', ''),
(36, 1, 'content', 0, 1, 25, '0,6,25', 0, '36', '小V探盘', '', '', '', 'news/loushi/', 'tanpan', '/news/loushi/tanpan/', 18, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 36, 1, 1, 'xiaovtanpan', ''),
(37, 1, 'content', 0, 1, 25, '0,6,25', 0, '37', '新房导购', '', '', '', 'news/loushi/', 'daogou', '/news/loushi/daogou/', 23, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 37, 1, 1, 'xinfangdaogou', ''),
(38, 1, 'content', 0, 1, 6, '0,6', 0, '38', '地产人物', '', '', '', 'news/', 'renwu', '/news/renwu/', 100, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 38, 1, 1, 'dichanrenwu', ''),
(39, 1, 'content', 0, 1, 6, '0,6', 0, '39', '娱乐地产', '', '', '', 'news/', 'yule', '/news/yule/', 311, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 39, 1, 1, 'yuledichan', ''),
(40, 1, 'content', 0, 1, 6, '0,6', 0, '40', '社会热点', '', '', '', 'news/', 'shehui', '/news/shehui/', 605, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 40, 1, 1, 'shehuiredian', ''),
(42, 1, 'content', 0, 1, 46, '0,6,46', 0, '42', '优惠活动', '', '', '', 'news/shop/', 'youhui', '/news/shop/youhui/', 10, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 42, 1, 1, 'youhuihuodong', ''),
(43, 1, 'content', 0, 1, 46, '0,6,46', 0, '43', '商业选购', '', '', '', 'news/shop/', 'xuangou', '/news/shop/xuangou/', 24, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 43, 1, 1, 'shangyexuangou', ''),
(44, 1, 'content', 0, 1, 6, '0,6', 1, '44,21', '旅游地产', '', '', '', 'news/', 'trip', '/news/trip/', 0, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => ''旅游地产'',\n  ''meta_keywords'' => ''旅游,旅游地产,海景房,海边楼房,房价'',\n  ''meta_description'' => ''旅游地产是(房地产网)旗下专门针对旅游地产开设的旅游地产频道'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 44, 0, 1, 'lvyoudichan', ''),
(46, 1, 'content', 0, 1, 6, '0,6', 1, '46,23,41,42,43,60', '商业地产', '', '', '', 'news/', 'shop', '/news/shop/', 0, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => ''商业地产'',\n  ''meta_keywords'' => ''商铺,写字楼,商铺价格,写字楼出租,写字楼出售'',\n  ''meta_description'' => ''商业地产是旗下针对商铺、写字楼等商业信息设置的频道'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 46, 1, 1, 'shangyedichan', ''),
(48, 1, 'content', 0, 1, 6, '0,6', 0, '48', '即时资讯', '', '', '', 'news/', 'latest', 'http://demo1.house5.net/list-1.html', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''32'',\n  ''show_ruleid'' => ''11'',\n)', 67, 1, 1, 'jishizixun', ''),
(49, 1, 'content', 0, 1, 25, '0,6,25', 0, '49', '楼市预告', '', '', '', 'news/loushi/', 'yugao', '/news/loushi/yugao/', 99, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 26, 0, 1, 'loushiyugao', ''),
(53, 1, 'content', 0, 1, 6, '0,6', 1, '53,54,55,56,57,58,59,114', '家居', '', '', '', 'news/', 'home', '/news/home/', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_home'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 47, 0, 1, 'jiaju', ''),
(54, 1, 'content', 0, 1, 53, '0,6,53', 0, '54', '家装资讯', '', '', '', 'news/home/', 'zixun', '/news/home/zixun/', 760, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 54, 1, 1, 'jiazhuangzixun', ''),
(55, 1, 'content', 0, 1, 53, '0,6,53', 0, '55', '行业热点', '', '', '', 'news/home/', 'redian', '/news/home/redian/', 117, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 55, 1, 1, 'xingyeredian', ''),
(56, 1, 'content', 0, 1, 53, '0,6,53', 0, '56', '团购时报', '', '', '', 'news/home/', 'tuangou', '/news/home/tuangou/', 4, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n)', 56, 1, 1, 'tuangoushibao', ''),
(57, 1, 'content', 0, 1, 53, '0,6,53', 0, '57', '促销信息', '', '', '', 'news/home/', 'cuxiao', '/news/home/cuxiao/', 28, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 57, 1, 1, 'cuxiaoxinxi', ''),
(58, 1, 'content', 0, 1, 53, '0,6,53', 0, '58', '装饰百科', '', '', '', 'news/home/', 'baike', '/news/home/baike/', 758, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 58, 0, 1, 'zhuangshibaike', ''),
(59, 1, 'content', 0, 1, 53, '0,6,53', 0, '59', '家装日记', '', '', '', 'news/home/', 'zhuangxiu', '/news/home/zhuangxiu/', 137, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 59, 0, 1, 'jiazhuangriji', ''),
(60, 1, 'content', 0, 1, 46, '0,6,46', 0, '60', '别墅', '', '', '', 'news/shop/', 'bieshu', '/news/shop/bieshu/', 555, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 60, 1, 1, 'bieshu', ''),
(62, 1, 'content', 0, 1, 6, '0,6', 0, '62', '图片资讯', '', '', '', 'news/', 'pic', 'http://demo1.house5.net/piclist-1.html', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''40'',\n  ''show_ruleid'' => ''11'',\n)', 68, 1, 1, 'tupianzixun', ''),
(63, 1, 'content', 0, 1, 6, '0,6', 0, '63', '风水漫谈', '', '', '', 'news/', 'fengshui', '/news/fengshui/', 206, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 60, 0, 1, 'fengshuimantan', ''),
(64, 1, 'content', 0, 1, 6, '0,6', 0, '64', '楼市佳人', '', '', '', 'news/', 'jiaren', '/news/jiaren/', 4, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 38, 0, 1, 'loushijiaren', ''),
(65, 1, 'content', 0, 1, 6, '0,6', 1, '65,66', '二手房', '', '', '', 'news/', 'esf', '/news/esf/', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 65, 0, 1, 'ershoufang', ''),
(66, 1, 'content', 0, 1, 65, '0,6,65', 0, '66', '二手房资讯', '', '', '', 'news/esf/', 'zixun', '/news/esf/zixun/', 524, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 66, 0, 1, 'ershoufangzixun', ''),
(67, 1, 'content', 0, 1, 6, '0,6', 0, '67', '分析评论', '', '', '', 'news/', 'pinglun', '/news/pinglun/', 1004, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 66, 0, 1, 'fenxipinglun', ''),
(68, 1, 'content', 0, 1, 0, '0', 1, '68,72,108', '看房团首页', '', '', '', '', 'kanfang', 'http://demo1.house5.net/{$categorydir}{$catdir}/', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''1'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category_kanfang'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 60, 0, 1, 'kanfangtuanshouye', ''),
(72, 1, 'content', 0, 1, 68, '0,68', 0, '72', '资讯', '', '', '', 'kanfang/', 'kanfangzixun', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/72', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''16'',\n)', 72, 0, 1, 'zixun', ''),
(107, 1, 'content', 0, 34, 9, '0,9', 0, '107', '新房', '', '', '', 'house/', 'fangyuan', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/107', 2, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_fangyuan'',\n  ''show_template'' => ''show_fangyuan'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''46'',\n)', 107, 1, 0, 'xinfang', ''),
(108, 1, 'content', 0, 37, 68, '0,68', 0, '108', '看房团', '', '', '', '', 'kanfangtuan', 'http://demo1.house5.net/{$categorydir}{$catdir}/', 2, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''1'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_kanfangtuan'',\n  ''show_template'' => ''show_kanfangtuan'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''47'',\n)', 108, 0, 1, 'kanfangtuan', ''),
(110, 1, 'content', 0, 40, 111, '0,111', 0, '110', '小区', '', '', '', 'esf/', 'community', 'http://demo1.house5.net/xiaoqu-list{$lst}-g1.html', 12, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_xq'',\n  ''show_template'' => ''show_xiaoqu_index'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''49'',\n  ''show_ruleid'' => ''15'',\n)', 3, 1, 0, 'xiaoqu', ''),
(111, 1, 'content', 0, 39, 0, '0', 1, '111,112,113,110', '二手房', '', '', '', '', 'esf', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/111', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''16'',\n)', 11, 1, 0, 'ershoufang', ''),
(112, 1, 'content', 0, 39, 111, '0,111', 0, '112', '二手房出售', '', '', '', 'esf/', 'sale', 'http://demo1.house5.net/list{$lst}-g1.html', 15, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_esf'',\n  ''show_template'' => ''show_esf'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''30'',\n  ''show_ruleid'' => ''13'',\n)', 1, 1, 0, 'ershoufangchushou', ''),
(113, 1, 'content', 0, 41, 111, '0,111', 0, '113', '二手房出租', '', '', '', 'esf/', 'rent', 'http://demo1.house5.net/rent-list{$lst}-g1.html', 2, 0, 'array (\n  ''workflowid'' => ''1'',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''default'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list_rent'',\n  ''show_template'' => ''show_esf_rent'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''48'',\n  ''show_ruleid'' => ''14'',\n)', 2, 1, 0, 'ershoufangchuzu', ''),
(114, 1, 'content', 0, 1, 53, '0,6,53', 0, '114', '精品装修', '', '', '', 'news/home/', 'jpzx', '/news/home/jpzx/', 3, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_news'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 114, 1, 1, 'jingpinzhuangxiu', ''),
(7, 1, 'content', 0, 4, 0, '0', 1, '7,69,70', '图库', '', '', '', '', 'pic', '/news/pic/', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_picture'',\n  ''list_template'' => ''list_picture'',\n  ''show_template'' => ''show_picture'',\n  ''meta_title'' => ''图库'',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 7, 1, 0, 'tuku', '');
INSERT INTO `h5_category` (`catid`, `siteid`, `module`, `type`, `modelid`, `parentid`, `arrparentid`, `child`, `arrchildid`, `catname`, `style`, `image`, `description`, `parentdir`, `catdir`, `url`, `items`, `hits`, `setting`, `listorder`, `ismenu`, `sethtml`, `letter`, `usable_type`) VALUES
(10, 1, 'content', 0, 5, 0, '0', 1, '10,45,50,51', '视频', '', '', '', '', 'video', '/news/video/', 4, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_video'',\n  ''list_template'' => ''list_video'',\n  ''show_template'' => ''show_video'',\n  ''meta_title'' => ''视频看房'',\n  ''meta_keywords'' => ''视频看房、房产视频'',\n  ''meta_description'' => ''视频看房、房产视频'',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 10, 1, 0, 'shipin', ''),
(45, 1, 'content', 0, 5, 10, '0,10', 0, '45', '天天看房', '', 'http://demo1.house5.net/uploadfile/2013/0817/20130817034443123.jpg', '', 'video/', 'ttkf', '/news/video/ttkf/', 12, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_video'',\n  ''list_template'' => ''list_video'',\n  ''show_template'' => ''show_video'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 45, 1, 0, 'tiantiankanfang', ''),
(50, 1, 'content', 0, 5, 10, '0,10', 0, '50', '面对面', '', 'http://demo1.house5.net/uploadfile/2013/0817/20130817034516263.jpg', '', 'video/', 'mdm', '/news/video/mdm/', 1, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_video'',\n  ''list_template'' => ''list_video'',\n  ''show_template'' => ''show_video'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 50, 1, 0, 'mianduimian', ''),
(51, 1, 'content', 0, 5, 10, '0,10', 0, '51', '品牌展', '', '', '', 'video/', 'ppz', '/news/video/ppz/', 0, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_video'',\n  ''list_template'' => ''list_video'',\n  ''show_template'' => ''show_video'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 51, 1, 0, 'pinpaizhan', ''),
(19, 1, 'content', 0, 29, 9, '0,9', 0, '19', '楼栋', '', '', '', 'house/', 'building', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/19', 10, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''16'',\n)', 19, 1, 0, 'loudong', ''),
(20, 1, 'content', 0, 30, 9, '0,9', 0, '20', '房间', '', '', '', 'house/', 'room', 'http://demo1.house5.net/index.php?s=content/index/lists/catid/20', 4, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''0'',\n  ''content_ishtml'' => ''0'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''6'',\n  ''show_ruleid'' => ''16'',\n)', 20, 1, 0, 'fangjian', ''),
(70, 1, 'content', 0, 4, 7, '0,7', 0, '70', '精美壁纸', '', '', '', 'pic/', 'wallpaper', '/news/pic/wallpaper/', 12, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_picture'',\n  ''list_template'' => ''list_picture'',\n  ''show_template'' => ''show_picture'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 70, 1, 0, 'jingmeibizhi', ''),
(69, 1, 'content', 0, 4, 7, '0,7', 0, '69', '精彩美图', '', '', '', 'pic/', 'meitu', '/news/pic/meitu/', 28, 0, 'array (\n  ''workflowid'' => '''',\n  ''ishtml'' => ''1'',\n  ''content_ishtml'' => ''1'',\n  ''create_to_html_root'' => ''0'',\n  ''template_list'' => ''house5-style1'',\n  ''category_template'' => ''category_picture'',\n  ''list_template'' => ''list_picture'',\n  ''show_template'' => ''show_picture'',\n  ''meta_title'' => '''',\n  ''meta_keywords'' => '''',\n  ''meta_description'' => '''',\n  ''presentpoint'' => ''1'',\n  ''defaultchargepoint'' => ''0'',\n  ''paytype'' => ''0'',\n  ''repeatchargedays'' => ''1'',\n  ''category_ruleid'' => ''1'',\n  ''show_ruleid'' => ''11'',\n)', 69, 1, 0, 'jingcaimeitu', '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_category_priv`
--

CREATE TABLE IF NOT EXISTS `h5_category_priv` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `roleid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `action` char(30) NOT NULL,
  KEY `catid` (`catid`,`roleid`,`is_admin`,`action`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_category_priv`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_collection_content`
--

CREATE TABLE IF NOT EXISTS `h5_collection_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nodeid` int(10) unsigned NOT NULL DEFAULT '0',
  `siteid` mediumint(5) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL,
  `title` char(100) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nodeid` (`nodeid`,`siteid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_collection_content`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_collection_history`
--

CREATE TABLE IF NOT EXISTS `h5_collection_history` (
  `md5` char(32) NOT NULL,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`md5`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_collection_history`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_collection_node`
--

CREATE TABLE IF NOT EXISTS `h5_collection_node` (
  `nodeid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sourcecharset` varchar(8) NOT NULL,
  `sourcetype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `urlpage` text NOT NULL,
  `pagesize_start` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pagesize_end` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `page_base` char(255) NOT NULL,
  `par_num` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `url_contain` char(100) NOT NULL,
  `url_except` char(100) NOT NULL,
  `url_start` char(100) NOT NULL DEFAULT '',
  `url_end` char(100) NOT NULL DEFAULT '',
  `title_rule` char(100) NOT NULL,
  `title_html_rule` text NOT NULL,
  `author_rule` char(100) NOT NULL,
  `author_html_rule` text NOT NULL,
  `comeform_rule` char(100) NOT NULL,
  `comeform_html_rule` text NOT NULL,
  `time_rule` char(100) NOT NULL,
  `time_html_rule` text NOT NULL,
  `content_rule` char(100) NOT NULL,
  `content_html_rule` text NOT NULL,
  `content_page_start` char(100) NOT NULL,
  `content_page_end` char(100) NOT NULL,
  `content_page_rule` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content_page` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content_nextpage` char(100) NOT NULL,
  `down_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `watermark` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `coll_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `customize_config` text NOT NULL,
  PRIMARY KEY (`nodeid`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_collection_node`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_collection_program`
--

CREATE TABLE IF NOT EXISTS `h5_collection_program` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `nodeid` int(10) unsigned NOT NULL DEFAULT '0',
  `modelid` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `config` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`),
  KEY `nodeid` (`nodeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `h5_collection_program`
--

INSERT INTO `h5_collection_program` (`id`, `siteid`, `nodeid`, `modelid`, `catid`, `config`) VALUES
(1, 2, 1, 23, 93, 'array (\n  ''add_introduce'' => ''1'',\n  ''auto_thumb'' => ''1'',\n  ''introcude_length'' => ''200'',\n  ''auto_thumb_no'' => ''1'',\n  ''content_status'' => ''99'',\n  ''map'' => \n  array (\n    ''title'' => ''title'',\n    ''copyfrom'' => ''author'',\n    ''updatetime'' => ''time'',\n    ''content'' => ''content'',\n    ''inputtime'' => ''time'',\n    ''username'' => ''author'',\n  ),\n  ''funcs'' => \n  array (\n    ''keywords'' => ''spider_keywords'',\n  ),\n)'),
(2, 2, 2, 23, 91, 'array (\n  ''add_introduce'' => ''1'',\n  ''auto_thumb'' => ''1'',\n  ''introcude_length'' => ''200'',\n  ''auto_thumb_no'' => ''1'',\n  ''content_status'' => ''99'',\n  ''map'' => \n  array (\n    ''title'' => ''title'',\n    ''updatetime'' => ''time'',\n    ''content'' => ''content'',\n    ''inputtime'' => ''time'',\n  ),\n  ''funcs'' => \n  array (\n    ''keywords'' => ''spider_keywords'',\n  ),\n)'),
(3, 2, 3, 23, 92, 'array (\n  ''add_introduce'' => ''1'',\n  ''auto_thumb'' => ''1'',\n  ''introcude_length'' => ''200'',\n  ''auto_thumb_no'' => ''1'',\n  ''content_status'' => ''99'',\n  ''map'' => \n  array (\n    ''title'' => ''title'',\n    ''updatetime'' => ''time'',\n    ''content'' => ''content'',\n    ''inputtime'' => ''time'',\n  ),\n  ''funcs'' => \n  array (\n    ''keywords'' => ''spider_keywords'',\n  ),\n)'),
(4, 1, 9, 1, 39, 'array (\n  ''add_introduce'' => ''0'',\n  ''auto_thumb'' => ''0'',\n  ''introcude_length'' => ''200'',\n  ''auto_thumb_no'' => ''1'',\n  ''content_status'' => ''99'',\n  ''map'' => \n  array (\n    ''title'' => ''title'',\n    ''updatetime'' => ''time'',\n    ''content'' => ''content'',\n    ''inputtime'' => ''time'',\n  ),\n)');

-- --------------------------------------------------------

--
-- 表的结构 `h5_comment`
--

CREATE TABLE IF NOT EXISTS `h5_comment` (
  `commentid` char(30) NOT NULL,
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `total` int(8) unsigned DEFAULT '0',
  `square` mediumint(8) unsigned DEFAULT '0',
  `anti` mediumint(8) unsigned DEFAULT '0',
  `neutral` mediumint(8) unsigned DEFAULT '0',
  `display_type` tinyint(1) DEFAULT '0',
  `tableid` mediumint(8) unsigned DEFAULT '0',
  `lastupdate` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`commentid`),
  KEY `lastupdate` (`lastupdate`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_comment_check`
--

CREATE TABLE IF NOT EXISTS `h5_comment_check` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `comment_data_id` int(10) DEFAULT '0' COMMENT '????ID??',
  `siteid` smallint(5) NOT NULL DEFAULT '0' COMMENT '???ID',
  `tableid` mediumint(8) DEFAULT '0' COMMENT '????洢??ID',
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`),
  KEY `comment_data_id` (`comment_data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_comment_check`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_comment_data_1`
--

CREATE TABLE IF NOT EXISTS `h5_comment_data_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '????ID',
  `commentid` char(30) NOT NULL DEFAULT '' COMMENT '????ID??',
  `siteid` smallint(5) NOT NULL DEFAULT '0' COMMENT '???ID',
  `userid` int(10) unsigned DEFAULT '0' COMMENT '???ID',
  `username` varchar(20) DEFAULT NULL COMMENT '?????',
  `creat_at` int(10) DEFAULT NULL COMMENT '???????',
  `ip` varchar(15) DEFAULT NULL COMMENT '???IP???',
  `status` tinyint(1) DEFAULT '0' COMMENT '??????{0:δ???,-1:δ??????,1:??????}',
  `content` text COMMENT '????????',
  `direction` tinyint(1) DEFAULT '0' COMMENT '???????{0:?????,1:????,2:????,3:????}',
  `support` mediumint(8) unsigned DEFAULT '0' COMMENT '?????',
  `reply` tinyint(1) NOT NULL DEFAULT '0' COMMENT '???????',
  PRIMARY KEY (`id`),
  KEY `commentid` (`commentid`),
  KEY `direction` (`direction`),
  KEY `siteid` (`siteid`),
  KEY `support` (`support`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_comment_data_1`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_comment_setting`
--

CREATE TABLE IF NOT EXISTS `h5_comment_setting` (
  `siteid` smallint(5) NOT NULL DEFAULT '0' COMMENT '???ID',
  `guest` tinyint(1) DEFAULT '0' COMMENT '????????ο?????',
  `check` tinyint(1) DEFAULT '0' COMMENT '?????????',
  `code` tinyint(1) DEFAULT '0' COMMENT '??????????',
  `add_point` tinyint(3) unsigned DEFAULT '0' COMMENT '?????????',
  `del_point` tinyint(3) unsigned DEFAULT '0' COMMENT '??????????',
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_comment_setting`
--

INSERT INTO `h5_comment_setting` (`siteid`, `guest`, `check`, `code`, `add_point`, `del_point`) VALUES
(1, 1, 0, 1, 0, 0),
(2, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_comment_table`
--

CREATE TABLE IF NOT EXISTS `h5_comment_table` (
  `tableid` mediumint(8) NOT NULL AUTO_INCREMENT COMMENT '??ID??',
  `total` int(10) unsigned DEFAULT '0' COMMENT '????????',
  `creat_at` int(10) DEFAULT '0' COMMENT '???????',
  PRIMARY KEY (`tableid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_comment_table`
--

INSERT INTO `h5_comment_table` (`tableid`, `total`, `creat_at`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_community`
--

CREATE TABLE IF NOT EXISTS `h5_community` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `bbs` varchar(255) NOT NULL DEFAULT '',
  `type2` varchar(255) NOT NULL DEFAULT '',
  `jdtime` varchar(255) NOT NULL DEFAULT '',
  `fcznx` varchar(255) NOT NULL DEFAULT '',
  `character` varchar(255) NOT NULL DEFAULT '',
  `jiaotong` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `qqqun` varchar(255) NOT NULL DEFAULT '',
  `opentime` date DEFAULT NULL,
  `jfdate` date DEFAULT NULL,
  `zdmj` int(10) unsigned NOT NULL DEFAULT '0',
  `jzmj` int(10) unsigned NOT NULL DEFAULT '0',
  `far` int(10) unsigned NOT NULL DEFAULT '0',
  `gt` int(10) unsigned NOT NULL DEFAULT '0',
  `lhl` int(10) unsigned NOT NULL DEFAULT '0',
  `kftime` varchar(255) NOT NULL DEFAULT '',
  `cws` varchar(255) NOT NULL DEFAULT '',
  `cwf` varchar(255) NOT NULL DEFAULT '',
  `license` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  `jzdw` varchar(255) NOT NULL DEFAULT '',
  `jgsj` varchar(255) NOT NULL DEFAULT '',
  `siteurl` varchar(255) NOT NULL DEFAULT '',
  `wyf` varchar(255) NOT NULL DEFAULT '',
  `map` varchar(255) NOT NULL DEFAULT '',
  `range` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hot` varchar(255) NOT NULL DEFAULT '',
  `video` varchar(255) NOT NULL DEFAULT '',
  `ename` varchar(255) NOT NULL DEFAULT '',
  `pinyin` varchar(255) NOT NULL DEFAULT '',
  `price_rent` varchar(255) NOT NULL DEFAULT '',
  `price_percent` float unsigned NOT NULL DEFAULT '0',
  `price_rent_percent` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=25 ;

--
-- 导出表中的数据 `h5_community`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_community_avgprice`
--

CREATE TABLE IF NOT EXISTS `h5_community_avgprice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `avgprice` mediumint(8) NOT NULL,
  `percent_change` float NOT NULL,
  `type` tinyint(1) NOT NULL,
  `markdate` char(6) NOT NULL,
  `addtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=30 ;

--
-- 导出表中的数据 `h5_community_avgprice`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_community_data`
--

CREATE TABLE IF NOT EXISTS `h5_community_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `area` varchar(255) NOT NULL DEFAULT '',
  `huxing` varchar(255) NOT NULL DEFAULT '',
  `xglp` varchar(255) NOT NULL DEFAULT '',
  `developer` varchar(255) NOT NULL DEFAULT '',
  `investor` varchar(255) NOT NULL DEFAULT '',
  `agency` varchar(255) NOT NULL DEFAULT '',
  `property` varchar(255) NOT NULL DEFAULT '',
  `zbpt` mediumtext NOT NULL,
  `pic` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_community_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_company`
--

CREATE TABLE IF NOT EXISTS `h5_company` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `siteurl` varchar(255) NOT NULL DEFAULT '',
  `manager` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `fax` varchar(255) NOT NULL DEFAULT '',
  `level` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_company`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_company_data`
--

CREATE TABLE IF NOT EXISTS `h5_company_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` mediumtext NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_company_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_content_check`
--

CREATE TABLE IF NOT EXISTS `h5_content_check` (
  `checkid` char(15) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL,
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `username` (`username`),
  KEY `checkid` (`checkid`),
  KEY `status` (`status`,`inputtime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_content_check`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_copyfrom`
--

CREATE TABLE IF NOT EXISTS `h5_copyfrom` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sitename` varchar(30) NOT NULL,
  `siteurl` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_copyfrom`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_datacall`
--

CREATE TABLE IF NOT EXISTS `h5_datacall` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` char(40) DEFAULT NULL,
  `dis_type` tinyint(1) unsigned DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `module` char(20) DEFAULT NULL,
  `action` char(20) DEFAULT NULL,
  `data` text,
  `template` text,
  `cache` mediumint(8) DEFAULT NULL,
  `num` smallint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_datacall`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dbsource`
--

CREATE TABLE IF NOT EXISTS `h5_dbsource` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `host` varchar(20) NOT NULL,
  `port` int(5) NOT NULL DEFAULT '3306',
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dbname` varchar(50) NOT NULL,
  `dbtablepre` varchar(30) NOT NULL,
  `charset` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_dbsource`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dianping`
--

CREATE TABLE IF NOT EXISTS `h5_dianping` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_dianping`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dianping_data`
--

CREATE TABLE IF NOT EXISTS `h5_dianping_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `advantage` mediumtext NOT NULL,
  `disadvantage` mediumtext NOT NULL,
  `zongjie` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_dianping_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dotime`
--

CREATE TABLE IF NOT EXISTS `h5_dotime` (
  `time` int(11) NOT NULL DEFAULT '0',
  `time2` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_dotime`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_downservers`
--

CREATE TABLE IF NOT EXISTS `h5_downservers` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(100) DEFAULT NULL,
  `siteurl` varchar(255) DEFAULT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_downservers`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dynamic`
--

CREATE TABLE IF NOT EXISTS `h5_dynamic` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_dynamic`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_dynamic_data`
--

CREATE TABLE IF NOT EXISTS `h5_dynamic_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_dynamic_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_esf`
--

CREATE TABLE IF NOT EXISTS `h5_esf` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `fix` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `total_area` varchar(255) NOT NULL DEFAULT '',
  `huxingshi` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `floor` varchar(255) NOT NULL DEFAULT '1',
  `zonglouceng` varchar(255) NOT NULL DEFAULT '',
  `huxingwei` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `house_age` int(10) unsigned NOT NULL DEFAULT '0',
  `huxingting` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `wyf` varchar(255) NOT NULL DEFAULT '',
  `house_toward` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `huxingyang` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `belong` varchar(255) NOT NULL DEFAULT '',
  `flag` varchar(255) NOT NULL DEFAULT '',
  `house_status` smallint(5) unsigned NOT NULL DEFAULT '1',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `assort` varchar(255) NOT NULL DEFAULT '',
  `encode` varchar(6) NOT NULL DEFAULT '',
  `houseno` varchar(255) NOT NULL DEFAULT '',
  `range` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `area_range` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mprice` int(10) unsigned NOT NULL DEFAULT '0',
  `communityname` varchar(255) NOT NULL DEFAULT '',
  `house_downtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remarks` varchar(255) NOT NULL DEFAULT '',
  `refresh` int(10) unsigned NOT NULL DEFAULT '2',
  `recommend` tinyint(3) NOT NULL DEFAULT '0',
  `isbroker` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=40 ;

--
-- 导出表中的数据 `h5_esf`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_esf_data`
--

CREATE TABLE IF NOT EXISTS `h5_esf_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `huxing` varchar(255) NOT NULL DEFAULT '',
  `house_pic` mediumtext NOT NULL,
  `house_room` mediumtext NOT NULL,
  `house_outdoor` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_esf_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_esf_rent`
--

CREATE TABLE IF NOT EXISTS `h5_esf_rent` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `house_age` int(10) unsigned NOT NULL DEFAULT '0',
  `jfdate` date DEFAULT NULL,
  `fix` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `opentime` date DEFAULT NULL,
  `total_area` varchar(255) NOT NULL DEFAULT '',
  `huxingshi` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `floor` varchar(255) NOT NULL DEFAULT '',
  `zonglouceng` varchar(255) NOT NULL DEFAULT '',
  `huxingwei` varchar(255) NOT NULL DEFAULT '',
  `huxingting` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `wyf` varchar(255) NOT NULL DEFAULT '',
  `house_toward` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  `house_num` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `flag` varchar(255) NOT NULL DEFAULT '',
  `house_status` smallint(5) unsigned NOT NULL DEFAULT '1',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `area_range` smallint(5) unsigned NOT NULL,
  `range` smallint(5) unsigned NOT NULL,
  `uid` varchar(255) NOT NULL DEFAULT '',
  `encode` varchar(255) NOT NULL DEFAULT '',
  `rent_type` smallint(5) unsigned NOT NULL,
  `paytype1` varchar(255) NOT NULL DEFAULT '',
  `paytype2` varchar(255) NOT NULL DEFAULT '',
  `communityname` varchar(255) NOT NULL DEFAULT '',
  `roomtype` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `limitsex` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `house_downtime` int(10) unsigned NOT NULL DEFAULT '0',
  `remarks` varchar(255) NOT NULL DEFAULT '',
  `refresh` int(10) unsigned NOT NULL DEFAULT '2',
  `houseno` varchar(255) NOT NULL DEFAULT '',
  `recommend` tinyint(3) NOT NULL DEFAULT '0',
  `isbroker` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `h5_esf_rent`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_esf_rent_data`
--

CREATE TABLE IF NOT EXISTS `h5_esf_rent_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `huxing` varchar(255) NOT NULL DEFAULT '',
  `house_pic` mediumtext NOT NULL,
  `house_room` mediumtext NOT NULL,
  `house_outdoor` mediumtext NOT NULL,
  `assort` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_esf_rent_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_extend_setting`
--

CREATE TABLE IF NOT EXISTS `h5_extend_setting` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(30) NOT NULL,
  `data` mediumtext,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_extend_setting`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_favorite`
--

CREATE TABLE IF NOT EXISTS `h5_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `title` char(100) NOT NULL,
  `url` char(100) NOT NULL,
  `adddate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_favorite`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_form_tuangou`
--

CREATE TABLE IF NOT EXISTS `h5_form_tuangou` (
  `dataid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `datetime` int(10) unsigned NOT NULL,
  `ip` char(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `qq` varchar(255) NOT NULL DEFAULT '',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `regionid` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  `region` varchar(255) NOT NULL DEFAULT '',
  `gender` varchar(255) NOT NULL DEFAULT '0',
  `num` varchar(255) NOT NULL DEFAULT '1',
  `fromurl` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `relatedid` varchar(255) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT '',
  PRIMARY KEY (`dataid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `h5_form_tuangou`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_hits`
--

CREATE TABLE IF NOT EXISTS `h5_hits` (
  `hitsid` char(30) NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `yesterdayviews` int(10) unsigned NOT NULL DEFAULT '0',
  `dayviews` int(10) unsigned NOT NULL DEFAULT '0',
  `weekviews` int(10) unsigned NOT NULL DEFAULT '0',
  `monthviews` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `initialviews` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hitsid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_hits`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_house`
--

CREATE TABLE IF NOT EXISTS `h5_house` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` int(10) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '1',
  `type2` varchar(255) NOT NULL DEFAULT '',
  `type3` varchar(255) NOT NULL DEFAULT '0',
  `fcznx` varchar(255) NOT NULL DEFAULT '70 年',
  `jiaotong` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `qqqun` varchar(255) NOT NULL DEFAULT '',
  `progress` varchar(255) NOT NULL DEFAULT '',
  `opentime` date DEFAULT NULL,
  `jfdate` date DEFAULT NULL,
  `zdmj` int(10) unsigned NOT NULL DEFAULT '0',
  `jzmj` int(10) unsigned NOT NULL DEFAULT '0',
  `far` float unsigned NOT NULL DEFAULT '0',
  `gt` int(10) unsigned NOT NULL DEFAULT '0',
  `lhl` int(10) unsigned NOT NULL DEFAULT '0',
  `kftime` varchar(255) NOT NULL DEFAULT '',
  `cws` varchar(255) NOT NULL DEFAULT '',
  `cwf` varchar(255) NOT NULL DEFAULT '',
  `license` varchar(255) NOT NULL DEFAULT '',
  `office` varchar(255) NOT NULL DEFAULT '',
  `jdtime` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `xszt` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `bbs` varchar(255) NOT NULL DEFAULT '',
  `fix` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `payment` varchar(255) NOT NULL DEFAULT '一次性付款/商业贷款',
  `price` varchar(255) NOT NULL DEFAULT '',
  `jzdw` varchar(255) NOT NULL DEFAULT '',
  `jgsj` varchar(255) NOT NULL DEFAULT '',
  `siteurl` varchar(255) NOT NULL DEFAULT '',
  `wyf` varchar(255) NOT NULL DEFAULT '',
  `character` varchar(255) NOT NULL DEFAULT '0',
  `map` varchar(255) NOT NULL DEFAULT '',
  `range` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `hot` varchar(255) NOT NULL DEFAULT '0',
  `priceunit` varchar(255) NOT NULL DEFAULT '0',
  `video` varchar(255) NOT NULL DEFAULT '',
  `ename` varchar(255) NOT NULL DEFAULT '',
  `pinyin` varchar(255) NOT NULL DEFAULT '',
  `opentimetips` varchar(255) NOT NULL DEFAULT '',
  `jfdatetips` varchar(255) NOT NULL DEFAULT '',
  `dzinfo` varchar(255) NOT NULL DEFAULT '',
  `dzinfodate` date DEFAULT NULL,
  `domain` varchar(50) DEFAULT '',
  `initialviews` int(10) DEFAULT '0',
  `initialtuan` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=517 ;

--
-- 导出表中的数据 `h5_house`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_housesell`
--

CREATE TABLE IF NOT EXISTS `h5_housesell` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `huxing` varchar(255) NOT NULL DEFAULT '',
  `floor` varchar(255) NOT NULL DEFAULT '',
  `zonglouceng` varchar(255) NOT NULL DEFAULT '',
  `huxingshi` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `huxingting` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `huxingwei` varchar(255) NOT NULL DEFAULT '',
  `house_no` varchar(255) NOT NULL DEFAULT '',
  `fix` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `opentime` date DEFAULT NULL,
  `jfdate` date DEFAULT NULL,
  `tel` varchar(255) NOT NULL DEFAULT '',
  `wyf` varchar(255) NOT NULL DEFAULT '',
  `house_toward` varchar(255) NOT NULL DEFAULT '',
  `total_area` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  `house_num` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_housesell`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_housesell_data`
--

CREATE TABLE IF NOT EXISTS `h5_housesell_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `house_pic` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_housesell_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_house_data`
--

CREATE TABLE IF NOT EXISTS `h5_house_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `area` varchar(255) NOT NULL DEFAULT '',
  `huxing` varchar(255) NOT NULL DEFAULT '',
  `xglp` varchar(255) NOT NULL DEFAULT '',
  `developer` varchar(255) NOT NULL DEFAULT '',
  `investor` varchar(255) NOT NULL DEFAULT '',
  `agency` varchar(255) NOT NULL DEFAULT '',
  `property` varchar(255) NOT NULL DEFAULT '',
  `zbpt` mediumtext NOT NULL,
  `pic` mediumtext NOT NULL,
  `etitle` varchar(255) NOT NULL DEFAULT '',
  `shapan` varchar(255) DEFAULT '',
  `xgsp` mediumint(8) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_house_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_impression`
--

CREATE TABLE IF NOT EXISTS `h5_impression` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `impression` varchar(20) DEFAULT NULL,
  `houseid` int(10) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `inputtime` int(10) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_impression`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_ipbanned`
--

CREATE TABLE IF NOT EXISTS `h5_ipbanned` (
  `ipbannedid` smallint(5) NOT NULL AUTO_INCREMENT,
  `ip` char(15) NOT NULL,
  `expires` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ipbannedid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_ipbanned`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_kanfang`
--

CREATE TABLE IF NOT EXISTS `h5_kanfang` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `region` int(10) unsigned NOT NULL DEFAULT '0',
  `character` varchar(255) NOT NULL DEFAULT '',
  `addtime` date DEFAULT NULL,
  `endtime` date DEFAULT NULL,
  `initialtuan` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `h5_kanfang`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_kanfang_data`
--

CREATE TABLE IF NOT EXISTS `h5_kanfang_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_kanfang_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_keylink`
--

CREATE TABLE IF NOT EXISTS `h5_keylink` (
  `keylinkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `word` char(40) NOT NULL,
  `url` char(100) NOT NULL,
  `siteid` smallint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`keylinkid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_keylink`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_link`
--

CREATE TABLE IF NOT EXISTS `h5_link` (
  `linkid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `introduce` text NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `passed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`),
  KEY `typeid` (`typeid`,`passed`,`listorder`,`linkid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_linkage`
--

CREATE TABLE IF NOT EXISTS `h5_linkage` (
  `linkageid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `style` varchar(35) NOT NULL,
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `child` tinyint(1) NOT NULL,
  `arrchildid` mediumtext NOT NULL,
  `keyid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `setting` varchar(255) DEFAULT NULL,
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkageid`,`keyid`),
  KEY `parentid` (`parentid`,`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3430 ;

--
-- 导出表中的数据 `h5_linkage`
--

INSERT INTO `h5_linkage` (`linkageid`, `name`, `style`, `parentid`, `child`, `arrchildid`, `keyid`, `listorder`, `description`, `setting`, `siteid`) VALUES
(1, '中国', '1', 0, 0, '', 0, 0, '', '', 0),
(2, '北京市', '0', 0, 0, '', 1, 0, '', '', 0),
(3, '上海市', '0', 0, 0, '', 1, 0, '', '', 0),
(4, '天津市', '0', 0, 0, '', 1, 0, '', '', 0),
(5, '重庆市', '0', 0, 0, '', 1, 0, '', '', 0),
(6, '河北省', '0', 0, 0, '', 1, 0, '', '', 0),
(7, '山西省', '0', 0, 0, '', 1, 0, '', '', 0),
(8, '内蒙古', '0', 0, 0, '', 1, 0, '', '', 0),
(9, '辽宁省', '0', 0, 0, '', 1, 0, '', '', 0),
(10, '吉林省', '0', 0, 0, '', 1, 0, '', '', 0),
(11, '黑龙江省', '0', 0, 0, '', 1, 0, '', '', 0),
(12, '江苏省', '0', 0, 0, '', 1, 0, '', '', 0),
(13, '浙江省', '0', 0, 0, '', 1, 0, '', '', 0),
(14, '安徽省', '0', 0, 0, '', 1, 0, '', '', 0),
(15, '福建省', '0', 0, 0, '', 1, 0, '', '', 0),
(16, '江西省', '0', 0, 0, '', 1, 0, '', '', 0),
(17, '山东省', '0', 0, 0, '', 1, 0, '', '', 0),
(18, '河南省', '0', 0, 0, '', 1, 0, '', '', 0),
(19, '湖北省', '0', 0, 0, '', 1, 0, '', '', 0),
(20, '湖南省', '0', 0, 0, '', 1, 0, '', '', 0),
(21, '广东省', '0', 0, 0, '', 1, 0, '', '', 0),
(22, '广西', '0', 0, 0, '', 1, 0, '', '', 0),
(23, '海南省', '0', 0, 0, '', 1, 0, '', '', 0),
(24, '四川省', '0', 0, 0, '', 1, 0, '', '', 0),
(25, '贵州省', '0', 0, 0, '', 1, 0, '', '', 0),
(26, '云南省', '0', 0, 0, '', 1, 0, '', '', 0),
(27, '西藏', '0', 0, 0, '', 1, 0, '', '', 0),
(28, '陕西省', '0', 0, 0, '', 1, 0, '', '', 0),
(29, '甘肃省', '0', 0, 0, '', 1, 0, '', '', 0),
(30, '青海省', '0', 0, 0, '', 1, 0, '', '', 0),
(31, '宁夏', '0', 0, 0, '', 1, 0, '', '', 0),
(32, '新疆', '0', 0, 0, '', 1, 0, '', '', 0),
(33, '台湾省', '0', 0, 0, '', 1, 0, '', '', 0),
(34, '香港', '0', 0, 0, '', 1, 0, '', '', 0),
(35, '澳门', '0', 0, 0, '', 1, 0, '', '', 0),
(36, '东城区', '0', 2, 0, '', 1, 0, '', '', 0),
(37, '西城区', '0', 2, 0, '', 1, 0, '', '', 0),
(38, '崇文区', '0', 2, 0, '', 1, 0, '', '', 0),
(39, '宣武区', '0', 2, 0, '', 1, 0, '', '', 0),
(40, '朝阳区', '0', 2, 0, '', 1, 0, '', '', 0),
(41, '石景山区', '0', 2, 0, '', 1, 0, '', '', 0),
(42, '海淀区', '0', 2, 0, '', 1, 0, '', '', 0),
(43, '门头沟区', '0', 2, 0, '', 1, 0, '', '', 0),
(44, '房山区', '0', 2, 0, '', 1, 0, '', '', 0),
(45, '通州区', '0', 2, 0, '', 1, 0, '', '', 0),
(46, '顺义区', '0', 2, 0, '', 1, 0, '', '', 0),
(47, '昌平区', '0', 2, 0, '', 1, 0, '', '', 0),
(48, '大兴区', '0', 2, 0, '', 1, 0, '', '', 0),
(49, '怀柔区', '0', 2, 0, '', 1, 0, '', '', 0),
(50, '平谷区', '0', 2, 0, '', 1, 0, '', '', 0),
(51, '密云县', '0', 2, 0, '', 1, 0, '', '', 0),
(52, '延庆县', '0', 2, 0, '', 1, 0, '', '', 0),
(53, '黄浦区', '0', 3, 0, '', 1, 0, '', '', 0),
(54, '卢湾区', '0', 3, 0, '', 1, 0, '', '', 0),
(55, '徐汇区', '0', 3, 0, '', 1, 0, '', '', 0),
(56, '长宁区', '0', 3, 0, '', 1, 0, '', '', 0),
(57, '静安区', '0', 3, 0, '', 1, 0, '', '', 0),
(58, '普陀区', '0', 3, 0, '', 1, 0, '', '', 0),
(59, '闸北区', '0', 3, 0, '', 1, 0, '', '', 0),
(60, '虹口区', '0', 3, 0, '', 1, 0, '', '', 0),
(61, '杨浦区', '0', 3, 0, '', 1, 0, '', '', 0),
(62, '闵行区', '0', 3, 0, '', 1, 0, '', '', 0),
(63, '宝山区', '0', 3, 0, '', 1, 0, '', '', 0),
(64, '嘉定区', '0', 3, 0, '', 1, 0, '', '', 0),
(65, '浦东新区', '0', 3, 0, '', 1, 0, '', '', 0),
(66, '金山区', '0', 3, 0, '', 1, 0, '', '', 0),
(67, '松江区', '0', 3, 0, '', 1, 0, '', '', 0),
(68, '青浦区', '0', 3, 0, '', 1, 0, '', '', 0),
(69, '南汇区', '0', 3, 0, '', 1, 0, '', '', 0),
(70, '奉贤区', '0', 3, 0, '', 1, 0, '', '', 0),
(71, '崇明县', '0', 3, 0, '', 1, 0, '', '', 0),
(72, '和平区', '0', 4, 0, '', 1, 0, '', '', 0),
(73, '河东区', '0', 4, 0, '', 1, 0, '', '', 0),
(74, '河西区', '0', 4, 0, '', 1, 0, '', '', 0),
(75, '南开区', '0', 4, 0, '', 1, 0, '', '', 0),
(76, '河北区', '0', 4, 0, '', 1, 0, '', '', 0),
(77, '红桥区', '0', 4, 0, '', 1, 0, '', '', 0),
(78, '塘沽区', '0', 4, 0, '', 1, 0, '', '', 0),
(79, '汉沽区', '0', 4, 0, '', 1, 0, '', '', 0),
(80, '大港区', '0', 4, 0, '', 1, 0, '', '', 0),
(81, '东丽区', '0', 4, 0, '', 1, 0, '', '', 0),
(82, '西青区', '0', 4, 0, '', 1, 0, '', '', 0),
(83, '津南区', '0', 4, 0, '', 1, 0, '', '', 0),
(84, '北辰区', '0', 4, 0, '', 1, 0, '', '', 0),
(85, '武清区', '0', 4, 0, '', 1, 0, '', '', 0),
(86, '宝坻区', '0', 4, 0, '', 1, 0, '', '', 0),
(87, '宁河县', '0', 4, 0, '', 1, 0, '', '', 0),
(88, '静海县', '0', 4, 0, '', 1, 0, '', '', 0),
(89, '蓟县', '0', 4, 0, '', 1, 0, '', '', 0),
(90, '万州区', '0', 5, 0, '', 1, 0, '', '', 0),
(91, '涪陵区', '0', 5, 0, '', 1, 0, '', '', 0),
(92, '渝中区', '0', 5, 0, '', 1, 0, '', '', 0),
(93, '大渡口区', '0', 5, 0, '', 1, 0, '', '', 0),
(94, '江北区', '0', 5, 0, '', 1, 0, '', '', 0),
(95, '沙坪坝区', '0', 5, 0, '', 1, 0, '', '', 0),
(96, '九龙坡区', '0', 5, 0, '', 1, 0, '', '', 0),
(97, '南岸区', '0', 5, 0, '', 1, 0, '', '', 0),
(98, '北碚区', '0', 5, 0, '', 1, 0, '', '', 0),
(99, '万盛区', '0', 5, 0, '', 1, 0, '', '', 0),
(100, '双桥区', '0', 5, 0, '', 1, 0, '', '', 0),
(101, '渝北区', '0', 5, 0, '', 1, 0, '', '', 0),
(102, '巴南区', '0', 5, 0, '', 1, 0, '', '', 0),
(103, '黔江区', '0', 5, 0, '', 1, 0, '', '', 0),
(104, '长寿区', '0', 5, 0, '', 1, 0, '', '', 0),
(105, '綦江县', '0', 5, 0, '', 1, 0, '', '', 0),
(106, '潼南县', '0', 5, 0, '', 1, 0, '', '', 0),
(107, '铜梁县', '0', 5, 0, '', 1, 0, '', '', 0),
(108, '大足县', '0', 5, 0, '', 1, 0, '', '', 0),
(109, '荣昌县', '0', 5, 0, '', 1, 0, '', '', 0),
(110, '璧山县', '0', 5, 0, '', 1, 0, '', '', 0),
(111, '梁平县', '0', 5, 0, '', 1, 0, '', '', 0),
(112, '城口县', '0', 5, 0, '', 1, 0, '', '', 0),
(113, '丰都县', '0', 5, 0, '', 1, 0, '', '', 0),
(114, '垫江县', '0', 5, 0, '', 1, 0, '', '', 0),
(115, '武隆县', '0', 5, 0, '', 1, 0, '', '', 0),
(116, '忠县', '0', 5, 0, '', 1, 0, '', '', 0),
(117, '开县', '0', 5, 0, '', 1, 0, '', '', 0),
(118, '云阳县', '0', 5, 0, '', 1, 0, '', '', 0),
(119, '奉节县', '0', 5, 0, '', 1, 0, '', '', 0),
(120, '巫山县', '0', 5, 0, '', 1, 0, '', '', 0),
(121, '巫溪县', '0', 5, 0, '', 1, 0, '', '', 0),
(122, '石柱县', '0', 5, 0, '', 1, 0, '', '', 0),
(123, '秀山县', '0', 5, 0, '', 1, 0, '', '', 0),
(124, '酉阳县', '0', 5, 0, '', 1, 0, '', '', 0),
(125, '彭水县', '0', 5, 0, '', 1, 0, '', '', 0),
(126, '江津区', '0', 5, 0, '', 1, 0, '', '', 0),
(127, '合川区', '0', 5, 0, '', 1, 0, '', '', 0),
(128, '永川区', '0', 5, 0, '', 1, 0, '', '', 0),
(129, '南川区', '0', 5, 0, '', 1, 0, '', '', 0),
(130, '石家庄市', '0', 6, 0, '', 1, 0, '', '', 0),
(131, '唐山市', '0', 6, 0, '', 1, 0, '', '', 0),
(132, '秦皇岛市', '0', 6, 0, '', 1, 0, '', '', 0),
(133, '邯郸市', '0', 6, 0, '', 1, 0, '', '', 0),
(134, '邢台市', '0', 6, 0, '', 1, 0, '', '', 0),
(135, '保定市', '0', 6, 0, '', 1, 0, '', '', 0),
(136, '张家口市', '0', 6, 0, '', 1, 0, '', '', 0),
(137, '承德市', '0', 6, 0, '', 1, 0, '', '', 0),
(138, '沧州市', '0', 6, 0, '', 1, 0, '', '', 0),
(139, '廊坊市', '0', 6, 0, '', 1, 0, '', '', 0),
(140, '衡水市', '0', 6, 0, '', 1, 0, '', '', 0),
(141, '太原市', '0', 7, 0, '', 1, 0, '', '', 0),
(142, '大同市', '0', 7, 0, '', 1, 0, '', '', 0),
(143, '阳泉市', '0', 7, 0, '', 1, 0, '', '', 0),
(144, '长治市', '0', 7, 0, '', 1, 0, '', '', 0),
(145, '晋城市', '0', 7, 0, '', 1, 0, '', '', 0),
(146, '朔州市', '0', 7, 0, '', 1, 0, '', '', 0),
(147, '晋中市', '0', 7, 0, '', 1, 0, '', '', 0),
(148, '运城市', '0', 7, 0, '', 1, 0, '', '', 0),
(149, '忻州市', '0', 7, 0, '', 1, 0, '', '', 0),
(150, '临汾市', '0', 7, 0, '', 1, 0, '', '', 0),
(151, '吕梁市', '0', 7, 0, '', 1, 0, '', '', 0),
(152, '呼和浩特市', '0', 8, 0, '', 1, 0, '', '', 0),
(153, '包头市', '0', 8, 0, '', 1, 0, '', '', 0),
(154, '乌海市', '0', 8, 0, '', 1, 0, '', '', 0),
(155, '赤峰市', '0', 8, 0, '', 1, 0, '', '', 0),
(156, '通辽市', '0', 8, 0, '', 1, 0, '', '', 0),
(157, '鄂尔多斯市', '0', 8, 0, '', 1, 0, '', '', 0),
(158, '呼伦贝尔市', '0', 8, 0, '', 1, 0, '', '', 0),
(159, '巴彦淖尔市', '0', 8, 0, '', 1, 0, '', '', 0),
(160, '乌兰察布市', '0', 8, 0, '', 1, 0, '', '', 0),
(161, '兴安盟', '0', 8, 0, '', 1, 0, '', '', 0),
(162, '锡林郭勒盟', '0', 8, 0, '', 1, 0, '', '', 0),
(163, '阿拉善盟', '0', 8, 0, '', 1, 0, '', '', 0),
(164, '沈阳市', '0', 9, 0, '', 1, 0, '', '', 0),
(165, '大连市', '0', 9, 0, '', 1, 0, '', '', 0),
(166, '鞍山市', '0', 9, 0, '', 1, 0, '', '', 0),
(167, '抚顺市', '0', 9, 0, '', 1, 0, '', '', 0),
(168, '本溪市', '0', 9, 0, '', 1, 0, '', '', 0),
(169, '丹东市', '0', 9, 0, '', 1, 0, '', '', 0),
(170, '锦州市', '0', 9, 0, '', 1, 0, '', '', 0),
(171, '营口市', '0', 9, 0, '', 1, 0, '', '', 0),
(172, '阜新市', '0', 9, 0, '', 1, 0, '', '', 0),
(173, '辽阳市', '0', 9, 0, '', 1, 0, '', '', 0),
(174, '盘锦市', '0', 9, 0, '', 1, 0, '', '', 0),
(175, '铁岭市', '0', 9, 0, '', 1, 0, '', '', 0),
(176, '朝阳市', '0', 9, 0, '', 1, 0, '', '', 0),
(177, '葫芦岛市', '0', 9, 0, '', 1, 0, '', '', 0),
(178, '长春市', '0', 10, 0, '', 1, 0, '', '', 0),
(179, '吉林市', '0', 10, 0, '', 1, 0, '', '', 0),
(180, '四平市', '0', 10, 0, '', 1, 0, '', '', 0),
(181, '辽源市', '0', 10, 0, '', 1, 0, '', '', 0),
(182, '通化市', '0', 10, 0, '', 1, 0, '', '', 0),
(183, '白山市', '0', 10, 0, '', 1, 0, '', '', 0),
(184, '松原市', '0', 10, 0, '', 1, 0, '', '', 0),
(185, '白城市', '0', 10, 0, '', 1, 0, '', '', 0),
(186, '延边', '0', 10, 0, '', 1, 0, '', '', 0),
(187, '哈尔滨市', '0', 11, 0, '', 1, 0, '', '', 0),
(188, '齐齐哈尔市', '0', 11, 0, '', 1, 0, '', '', 0),
(189, '鸡西市', '0', 11, 0, '', 1, 0, '', '', 0),
(190, '鹤岗市', '0', 11, 0, '', 1, 0, '', '', 0),
(191, '双鸭山市', '0', 11, 0, '', 1, 0, '', '', 0),
(192, '大庆市', '0', 11, 0, '', 1, 0, '', '', 0),
(193, '伊春市', '0', 11, 0, '', 1, 0, '', '', 0),
(194, '佳木斯市', '0', 11, 0, '', 1, 0, '', '', 0),
(195, '七台河市', '0', 11, 0, '', 1, 0, '', '', 0),
(196, '牡丹江市', '0', 11, 0, '', 1, 0, '', '', 0),
(197, '黑河市', '0', 11, 0, '', 1, 0, '', '', 0),
(198, '绥化市', '0', 11, 0, '', 1, 0, '', '', 0),
(199, '大兴安岭地区', '0', 11, 0, '', 1, 0, '', '', 0),
(200, '南京市', '0', 12, 0, '', 1, 0, '', '', 0),
(201, '无锡市', '0', 12, 0, '', 1, 0, '', '', 0),
(202, '徐州市', '0', 12, 0, '', 1, 0, '', '', 0),
(203, '常州市', '0', 12, 0, '', 1, 0, '', '', 0),
(204, '苏州市', '0', 12, 0, '', 1, 0, '', '', 0),
(205, '南通市', '0', 12, 0, '', 1, 0, '', '', 0),
(206, '连云港市', '0', 12, 0, '', 1, 0, '', '', 0),
(207, '淮安市', '0', 12, 0, '', 1, 0, '', '', 0),
(208, '盐城市', '0', 12, 0, '', 1, 0, '', '', 0),
(209, '扬州市', '0', 12, 0, '', 1, 0, '', '', 0),
(210, '镇江市', '0', 12, 0, '', 1, 0, '', '', 0),
(211, '泰州市', '0', 12, 0, '', 1, 0, '', '', 0),
(212, '宿迁市', '0', 12, 0, '', 1, 0, '', '', 0),
(213, '杭州市', '0', 13, 0, '', 1, 0, '', '', 0),
(214, '宁波市', '0', 13, 0, '', 1, 0, '', '', 0),
(215, '温州市', '0', 13, 0, '', 1, 0, '', '', 0),
(216, '嘉兴市', '0', 13, 0, '', 1, 0, '', '', 0),
(217, '湖州市', '0', 13, 0, '', 1, 0, '', '', 0),
(218, '绍兴市', '0', 13, 0, '', 1, 0, '', '', 0),
(219, '金华市', '0', 13, 0, '', 1, 0, '', '', 0),
(220, '衢州市', '0', 13, 0, '', 1, 0, '', '', 0),
(221, '舟山市', '0', 13, 0, '', 1, 0, '', '', 0),
(222, '台州市', '0', 13, 0, '', 1, 0, '', '', 0),
(223, '丽水市', '0', 13, 0, '', 1, 0, '', '', 0),
(224, '合肥市', '0', 14, 0, '', 1, 0, '', '', 0),
(225, '芜湖市', '0', 14, 0, '', 1, 0, '', '', 0),
(226, '蚌埠市', '0', 14, 0, '', 1, 0, '', '', 0),
(227, '淮南市', '0', 14, 0, '', 1, 0, '', '', 0),
(228, '马鞍山市', '0', 14, 0, '', 1, 0, '', '', 0),
(229, '淮北市', '0', 14, 0, '', 1, 0, '', '', 0),
(230, '铜陵市', '0', 14, 0, '', 1, 0, '', '', 0),
(231, '安庆市', '0', 14, 0, '', 1, 0, '', '', 0),
(232, '黄山市', '0', 14, 0, '', 1, 0, '', '', 0),
(233, '滁州市', '0', 14, 0, '', 1, 0, '', '', 0),
(234, '阜阳市', '0', 14, 0, '', 1, 0, '', '', 0),
(235, '宿州市', '0', 14, 0, '', 1, 0, '', '', 0),
(236, '巢湖市', '0', 14, 0, '', 1, 0, '', '', 0),
(237, '六安市', '0', 14, 0, '', 1, 0, '', '', 0),
(238, '亳州市', '0', 14, 0, '', 1, 0, '', '', 0),
(239, '池州市', '0', 14, 0, '', 1, 0, '', '', 0),
(240, '宣城市', '0', 14, 0, '', 1, 0, '', '', 0),
(241, '福州市', '0', 15, 0, '', 1, 0, '', '', 0),
(242, '厦门市', '0', 15, 0, '', 1, 0, '', '', 0),
(243, '莆田市', '0', 15, 0, '', 1, 0, '', '', 0),
(244, '三明市', '0', 15, 0, '', 1, 0, '', '', 0),
(245, '泉州市', '0', 15, 0, '', 1, 0, '', '', 0),
(246, '漳州市', '0', 15, 0, '', 1, 0, '', '', 0),
(247, '南平市', '0', 15, 0, '', 1, 0, '', '', 0),
(248, '龙岩市', '0', 15, 0, '', 1, 0, '', '', 0),
(249, '宁德市', '0', 15, 0, '', 1, 0, '', '', 0),
(250, '南昌市', '0', 16, 0, '', 1, 0, '', '', 0),
(251, '景德镇市', '0', 16, 0, '', 1, 0, '', '', 0),
(252, '萍乡市', '0', 16, 0, '', 1, 0, '', '', 0),
(253, '九江市', '0', 16, 0, '', 1, 0, '', '', 0),
(254, '新余市', '0', 16, 0, '', 1, 0, '', '', 0),
(255, '鹰潭市', '0', 16, 0, '', 1, 0, '', '', 0),
(256, '赣州市', '0', 16, 0, '', 1, 0, '', '', 0),
(257, '吉安市', '0', 16, 0, '', 1, 0, '', '', 0),
(258, '宜春市', '0', 16, 0, '', 1, 0, '', '', 0),
(259, '抚州市', '0', 16, 0, '', 1, 0, '', '', 0),
(260, '上饶市', '0', 16, 0, '', 1, 0, '', '', 0),
(261, '济南市', '0', 17, 0, '', 1, 0, '', '', 0),
(262, '青岛市', '0', 17, 0, '', 1, 0, '', '', 0),
(263, '淄博市', '0', 17, 0, '', 1, 0, '', '', 0),
(264, '枣庄市', '0', 17, 0, '', 1, 0, '', '', 0),
(265, '东营市', '0', 17, 0, '', 1, 0, '', '', 0),
(266, '烟台市', '0', 17, 0, '', 1, 0, '', '', 0),
(267, '潍坊市', '0', 17, 0, '', 1, 0, '', '', 0),
(268, '济宁市', '0', 17, 0, '', 1, 0, '', '', 0),
(269, '泰安市', '0', 17, 0, '', 1, 0, '', '', 0),
(270, '威海市', '0', 17, 0, '', 1, 0, '', '', 0),
(271, '日照市', '0', 17, 0, '', 1, 0, '', '', 0),
(272, '莱芜市', '0', 17, 0, '', 1, 0, '', '', 0),
(273, '临沂市', '0', 17, 0, '', 1, 0, '', '', 0),
(274, '德州市', '0', 17, 0, '', 1, 0, '', '', 0),
(275, '聊城市', '0', 17, 0, '', 1, 0, '', '', 0),
(276, '滨州市', '0', 17, 0, '', 1, 0, '', '', 0),
(277, '荷泽市', '0', 17, 0, '', 1, 0, '', '', 0),
(278, '郑州市', '0', 18, 0, '', 1, 0, '', '', 0),
(279, '开封市', '0', 18, 0, '', 1, 0, '', '', 0),
(280, '洛阳市', '0', 18, 0, '', 1, 0, '', '', 0),
(281, '平顶山市', '0', 18, 0, '', 1, 0, '', '', 0),
(282, '安阳市', '0', 18, 0, '', 1, 0, '', '', 0),
(283, '鹤壁市', '0', 18, 0, '', 1, 0, '', '', 0),
(284, '新乡市', '0', 18, 0, '', 1, 0, '', '', 0),
(285, '焦作市', '0', 18, 0, '', 1, 0, '', '', 0),
(286, '濮阳市', '0', 18, 0, '', 1, 0, '', '', 0),
(287, '许昌市', '0', 18, 0, '', 1, 0, '', '', 0),
(288, '漯河市', '0', 18, 0, '', 1, 0, '', '', 0),
(289, '三门峡市', '0', 18, 0, '', 1, 0, '', '', 0),
(290, '南阳市', '0', 18, 0, '', 1, 0, '', '', 0),
(291, '商丘市', '0', 18, 0, '', 1, 0, '', '', 0),
(292, '信阳市', '0', 18, 0, '', 1, 0, '', '', 0),
(293, '周口市', '0', 18, 0, '', 1, 0, '', '', 0),
(294, '驻马店市', '0', 18, 0, '', 1, 0, '', '', 0),
(295, '武汉市', '0', 19, 0, '', 1, 0, '', '', 0),
(296, '黄石市', '0', 19, 0, '', 1, 0, '', '', 0),
(297, '十堰市', '0', 19, 0, '', 1, 0, '', '', 0),
(298, '宜昌市', '0', 19, 0, '', 1, 0, '', '', 0),
(299, '襄樊市', '0', 19, 0, '', 1, 0, '', '', 0),
(300, '鄂州市', '0', 19, 0, '', 1, 0, '', '', 0),
(301, '荆门市', '0', 19, 0, '', 1, 0, '', '', 0),
(302, '孝感市', '0', 19, 0, '', 1, 0, '', '', 0),
(303, '荆州市', '0', 19, 0, '', 1, 0, '', '', 0),
(304, '黄冈市', '0', 19, 0, '', 1, 0, '', '', 0),
(305, '咸宁市', '0', 19, 0, '', 1, 0, '', '', 0),
(306, '随州市', '0', 19, 0, '', 1, 0, '', '', 0),
(307, '恩施土家族苗族自治州', '0', 19, 0, '', 1, 0, '', '', 0),
(308, '仙桃市', '0', 19, 0, '', 1, 0, '', '', 0),
(309, '潜江市', '0', 19, 0, '', 1, 0, '', '', 0),
(310, '天门市', '0', 19, 0, '', 1, 0, '', '', 0),
(311, '神农架林区', '0', 19, 0, '', 1, 0, '', '', 0),
(312, '长沙市', '0', 20, 0, '', 1, 0, '', '', 0),
(313, '株洲市', '0', 20, 0, '', 1, 0, '', '', 0),
(314, '湘潭市', '0', 20, 0, '', 1, 0, '', '', 0),
(315, '衡阳市', '0', 20, 0, '', 1, 0, '', '', 0),
(316, '邵阳市', '0', 20, 0, '', 1, 0, '', '', 0),
(317, '岳阳市', '0', 20, 0, '', 1, 0, '', '', 0),
(318, '常德市', '0', 20, 0, '', 1, 0, '', '', 0),
(319, '张家界市', '0', 20, 0, '', 1, 0, '', '', 0),
(320, '益阳市', '0', 20, 0, '', 1, 0, '', '', 0),
(321, '郴州市', '0', 20, 0, '', 1, 0, '', '', 0),
(322, '永州市', '0', 20, 0, '', 1, 0, '', '', 0),
(323, '怀化市', '0', 20, 0, '', 1, 0, '', '', 0),
(324, '娄底市', '0', 20, 0, '', 1, 0, '', '', 0),
(325, '湘西土家族苗族自治州', '0', 20, 0, '', 1, 0, '', '', 0),
(326, '广州市', '0', 21, 0, '', 1, 0, '', '', 0),
(327, '韶关市', '0', 21, 0, '', 1, 0, '', '', 0),
(328, '深圳市', '0', 21, 0, '', 1, 0, '', '', 0),
(329, '珠海市', '0', 21, 0, '', 1, 0, '', '', 0),
(330, '汕头市', '0', 21, 0, '', 1, 0, '', '', 0),
(331, '佛山市', '0', 21, 0, '', 1, 0, '', '', 0),
(332, '江门市', '0', 21, 0, '', 1, 0, '', '', 0),
(333, '湛江市', '0', 21, 0, '', 1, 0, '', '', 0),
(334, '茂名市', '0', 21, 0, '', 1, 0, '', '', 0),
(335, '肇庆市', '0', 21, 0, '', 1, 0, '', '', 0),
(336, '惠州市', '0', 21, 0, '', 1, 0, '', '', 0),
(337, '梅州市', '0', 21, 0, '', 1, 0, '', '', 0),
(338, '汕尾市', '0', 21, 0, '', 1, 0, '', '', 0),
(339, '河源市', '0', 21, 0, '', 1, 0, '', '', 0),
(340, '阳江市', '0', 21, 0, '', 1, 0, '', '', 0),
(341, '清远市', '0', 21, 0, '', 1, 0, '', '', 0),
(342, '东莞市', '0', 21, 0, '', 1, 0, '', '', 0),
(343, '中山市', '0', 21, 0, '', 1, 0, '', '', 0),
(344, '潮州市', '0', 21, 0, '', 1, 0, '', '', 0),
(345, '揭阳市', '0', 21, 0, '', 1, 0, '', '', 0),
(346, '云浮市', '0', 21, 0, '', 1, 0, '', '', 0),
(347, '南宁市', '0', 22, 0, '', 1, 0, '', '', 0),
(348, '柳州市', '0', 22, 0, '', 1, 0, '', '', 0),
(349, '桂林市', '0', 22, 0, '', 1, 0, '', '', 0),
(350, '梧州市', '0', 22, 0, '', 1, 0, '', '', 0),
(351, '北海市', '0', 22, 0, '', 1, 0, '', '', 0),
(352, '防城港市', '0', 22, 0, '', 1, 0, '', '', 0),
(353, '钦州市', '0', 22, 0, '', 1, 0, '', '', 0),
(354, '贵港市', '0', 22, 0, '', 1, 0, '', '', 0),
(355, '玉林市', '0', 22, 0, '', 1, 0, '', '', 0),
(356, '百色市', '0', 22, 0, '', 1, 0, '', '', 0),
(357, '贺州市', '0', 22, 0, '', 1, 0, '', '', 0),
(358, '河池市', '0', 22, 0, '', 1, 0, '', '', 0),
(359, '来宾市', '0', 22, 0, '', 1, 0, '', '', 0),
(360, '崇左市', '0', 22, 0, '', 1, 0, '', '', 0),
(361, '海口市', '0', 23, 0, '', 1, 0, '', '', 0),
(362, '三亚市', '0', 23, 0, '', 1, 0, '', '', 0),
(363, '五指山市', '0', 23, 0, '', 1, 0, '', '', 0),
(364, '琼海市', '0', 23, 0, '', 1, 0, '', '', 0),
(365, '儋州市', '0', 23, 0, '', 1, 0, '', '', 0),
(366, '文昌市', '0', 23, 0, '', 1, 0, '', '', 0),
(367, '万宁市', '0', 23, 0, '', 1, 0, '', '', 0),
(368, '东方市', '0', 23, 0, '', 1, 0, '', '', 0),
(369, '定安县', '0', 23, 0, '', 1, 0, '', '', 0),
(370, '屯昌县', '0', 23, 0, '', 1, 0, '', '', 0),
(371, '澄迈县', '0', 23, 0, '', 1, 0, '', '', 0),
(372, '临高县', '0', 23, 0, '', 1, 0, '', '', 0),
(373, '白沙黎族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(374, '昌江黎族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(375, '乐东黎族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(376, '陵水黎族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(377, '保亭黎族苗族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(378, '琼中黎族苗族自治县', '0', 23, 0, '', 1, 0, '', '', 0),
(379, '西沙群岛', '0', 23, 0, '', 1, 0, '', '', 0),
(380, '南沙群岛', '0', 23, 0, '', 1, 0, '', '', 0),
(381, '中沙群岛的岛礁及其海域', '0', 23, 0, '', 1, 0, '', '', 0),
(382, '成都市', '0', 24, 0, '', 1, 0, '', '', 0),
(383, '自贡市', '0', 24, 0, '', 1, 0, '', '', 0),
(384, '攀枝花市', '0', 24, 0, '', 1, 0, '', '', 0),
(385, '泸州市', '0', 24, 0, '', 1, 0, '', '', 0),
(386, '德阳市', '0', 24, 0, '', 1, 0, '', '', 0),
(387, '绵阳市', '0', 24, 0, '', 1, 0, '', '', 0),
(388, '广元市', '0', 24, 0, '', 1, 0, '', '', 0),
(389, '遂宁市', '0', 24, 0, '', 1, 0, '', '', 0),
(390, '内江市', '0', 24, 0, '', 1, 0, '', '', 0),
(391, '乐山市', '0', 24, 0, '', 1, 0, '', '', 0),
(392, '南充市', '0', 24, 0, '', 1, 0, '', '', 0),
(393, '眉山市', '0', 24, 0, '', 1, 0, '', '', 0),
(394, '宜宾市', '0', 24, 0, '', 1, 0, '', '', 0),
(395, '广安市', '0', 24, 0, '', 1, 0, '', '', 0),
(396, '达州市', '0', 24, 0, '', 1, 0, '', '', 0),
(397, '雅安市', '0', 24, 0, '', 1, 0, '', '', 0),
(398, '巴中市', '0', 24, 0, '', 1, 0, '', '', 0),
(399, '资阳市', '0', 24, 0, '', 1, 0, '', '', 0),
(400, '阿坝州', '0', 24, 0, '', 1, 0, '', '', 0),
(401, '甘孜州', '0', 24, 0, '', 1, 0, '', '', 0),
(402, '凉山州', '0', 24, 0, '', 1, 0, '', '', 0),
(403, '贵阳市', '0', 25, 0, '', 1, 0, '', '', 0),
(404, '六盘水市', '0', 25, 0, '', 1, 0, '', '', 0),
(405, '遵义市', '0', 25, 0, '', 1, 0, '', '', 0),
(406, '安顺市', '0', 25, 0, '', 1, 0, '', '', 0),
(407, '铜仁地区', '0', 25, 0, '', 1, 0, '', '', 0),
(408, '黔西南州', '0', 25, 0, '', 1, 0, '', '', 0),
(409, '毕节地区', '0', 25, 0, '', 1, 0, '', '', 0),
(410, '黔东南州', '0', 25, 0, '', 1, 0, '', '', 0),
(411, '黔南州', '0', 25, 0, '', 1, 0, '', '', 0),
(412, '昆明市', '0', 26, 0, '', 1, 0, '', '', 0),
(413, '曲靖市', '0', 26, 0, '', 1, 0, '', '', 0),
(414, '玉溪市', '0', 26, 0, '', 1, 0, '', '', 0),
(415, '保山市', '0', 26, 0, '', 1, 0, '', '', 0),
(416, '昭通市', '0', 26, 0, '', 1, 0, '', '', 0),
(417, '丽江市', '0', 26, 0, '', 1, 0, '', '', 0),
(418, '思茅市', '0', 26, 0, '', 1, 0, '', '', 0),
(419, '临沧市', '0', 26, 0, '', 1, 0, '', '', 0),
(420, '楚雄州', '0', 26, 0, '', 1, 0, '', '', 0),
(421, '红河州', '0', 26, 0, '', 1, 0, '', '', 0),
(422, '文山州', '0', 26, 0, '', 1, 0, '', '', 0),
(423, '西双版纳', '0', 26, 0, '', 1, 0, '', '', 0),
(424, '大理', '0', 26, 0, '', 1, 0, '', '', 0),
(425, '德宏', '0', 26, 0, '', 1, 0, '', '', 0),
(426, '怒江', '0', 26, 0, '', 1, 0, '', '', 0),
(427, '迪庆', '0', 26, 0, '', 1, 0, '', '', 0),
(428, '拉萨市', '0', 27, 0, '', 1, 0, '', '', 0),
(429, '昌都', '0', 27, 0, '', 1, 0, '', '', 0),
(430, '山南', '0', 27, 0, '', 1, 0, '', '', 0),
(431, '日喀则', '0', 27, 0, '', 1, 0, '', '', 0),
(432, '那曲', '0', 27, 0, '', 1, 0, '', '', 0),
(433, '阿里', '0', 27, 0, '', 1, 0, '', '', 0),
(434, '林芝', '0', 27, 0, '', 1, 0, '', '', 0),
(435, '西安市', '0', 28, 0, '', 1, 0, '', '', 0),
(436, '铜川市', '0', 28, 0, '', 1, 0, '', '', 0),
(437, '宝鸡市', '0', 28, 0, '', 1, 0, '', '', 0),
(438, '咸阳市', '0', 28, 0, '', 1, 0, '', '', 0),
(439, '渭南市', '0', 28, 0, '', 1, 0, '', '', 0),
(440, '延安市', '0', 28, 0, '', 1, 0, '', '', 0),
(441, '汉中市', '0', 28, 0, '', 1, 0, '', '', 0),
(442, '榆林市', '0', 28, 0, '', 1, 0, '', '', 0),
(443, '安康市', '0', 28, 0, '', 1, 0, '', '', 0),
(444, '商洛市', '0', 28, 0, '', 1, 0, '', '', 0),
(445, '兰州市', '0', 29, 0, '', 1, 0, '', '', 0),
(446, '嘉峪关市', '0', 29, 0, '', 1, 0, '', '', 0),
(447, '金昌市', '0', 29, 0, '', 1, 0, '', '', 0),
(448, '白银市', '0', 29, 0, '', 1, 0, '', '', 0),
(449, '天水市', '0', 29, 0, '', 1, 0, '', '', 0),
(450, '武威市', '0', 29, 0, '', 1, 0, '', '', 0),
(451, '张掖市', '0', 29, 0, '', 1, 0, '', '', 0),
(452, '平凉市', '0', 29, 0, '', 1, 0, '', '', 0),
(453, '酒泉市', '0', 29, 0, '', 1, 0, '', '', 0),
(454, '庆阳市', '0', 29, 0, '', 1, 0, '', '', 0),
(455, '定西市', '0', 29, 0, '', 1, 0, '', '', 0),
(456, '陇南市', '0', 29, 0, '', 1, 0, '', '', 0),
(457, '临夏州', '0', 29, 0, '', 1, 0, '', '', 0),
(458, '甘州', '0', 29, 0, '', 1, 0, '', '', 0),
(459, '西宁市', '0', 30, 0, '', 1, 0, '', '', 0),
(460, '海东地区', '0', 30, 0, '', 1, 0, '', '', 0),
(461, '海州', '0', 30, 0, '', 1, 0, '', '', 0),
(462, '黄南州', '0', 30, 0, '', 1, 0, '', '', 0),
(463, '海南州', '0', 30, 0, '', 1, 0, '', '', 0),
(464, '果洛州', '0', 30, 0, '', 1, 0, '', '', 0),
(465, '玉树州', '0', 30, 0, '', 1, 0, '', '', 0),
(466, '海西州', '0', 30, 0, '', 1, 0, '', '', 0),
(467, '银川市', '0', 31, 0, '', 1, 0, '', '', 0),
(468, '石嘴山市', '0', 31, 0, '', 1, 0, '', '', 0),
(469, '吴忠市', '0', 31, 0, '', 1, 0, '', '', 0),
(470, '固原市', '0', 31, 0, '', 1, 0, '', '', 0),
(471, '中卫市', '0', 31, 0, '', 1, 0, '', '', 0),
(472, '乌鲁木齐市', '0', 32, 0, '', 1, 0, '', '', 0),
(473, '克拉玛依市', '0', 32, 0, '', 1, 0, '', '', 0),
(474, '吐鲁番地区', '0', 32, 0, '', 1, 0, '', '', 0),
(475, '哈密地区', '0', 32, 0, '', 1, 0, '', '', 0),
(476, '昌吉州', '0', 32, 0, '', 1, 0, '', '', 0),
(477, '博尔州', '0', 32, 0, '', 1, 0, '', '', 0),
(478, '巴音郭楞州', '0', 32, 0, '', 1, 0, '', '', 0),
(479, '阿克苏地区', '0', 32, 0, '', 1, 0, '', '', 0),
(480, '克孜勒苏柯尔克孜自治州', '0', 32, 0, '', 1, 0, '', '', 0),
(481, '喀什地区', '0', 32, 0, '', 1, 0, '', '', 0),
(482, '和田地区', '0', 32, 0, '', 1, 0, '', '', 0),
(483, '伊犁州', '0', 32, 0, '', 1, 0, '', '', 0),
(484, '塔城地区', '0', 32, 0, '', 1, 0, '', '', 0),
(485, '阿勒泰地区', '0', 32, 0, '', 1, 0, '', '', 0),
(486, '石河子市', '0', 32, 0, '', 1, 0, '', '', 0),
(487, '阿拉尔市', '0', 32, 0, '', 1, 0, '', '', 0),
(488, '图木舒克市', '0', 32, 0, '', 1, 0, '', '', 0),
(489, '五家渠市', '0', 32, 0, '', 1, 0, '', '', 0),
(490, '台北市', '0', 33, 0, '', 1, 0, '', '', 0),
(491, '高雄市', '0', 33, 0, '', 1, 0, '', '', 0),
(492, '基隆市', '0', 33, 0, '', 1, 0, '', '', 0),
(493, '新竹市', '0', 33, 0, '', 1, 0, '', '', 0),
(494, '台中市', '0', 33, 0, '', 1, 0, '', '', 0),
(495, '嘉义市', '0', 33, 0, '', 1, 0, '', '', 0),
(496, '台南市', '0', 33, 0, '', 1, 0, '', '', 0),
(497, '台北县', '0', 33, 0, '', 1, 0, '', '', 0),
(498, '桃园县', '0', 33, 0, '', 1, 0, '', '', 0),
(499, '新竹县', '0', 33, 0, '', 1, 0, '', '', 0),
(500, '苗栗县', '0', 33, 0, '', 1, 0, '', '', 0),
(501, '台中县', '0', 33, 0, '', 1, 0, '', '', 0),
(502, '彰化县', '0', 33, 0, '', 1, 0, '', '', 0),
(503, '南投县', '0', 33, 0, '', 1, 0, '', '', 0),
(504, '云林县', '0', 33, 0, '', 1, 0, '', '', 0),
(505, '嘉义县', '0', 33, 0, '', 1, 0, '', '', 0),
(506, '台南县', '0', 33, 0, '', 1, 0, '', '', 0),
(507, '高雄县', '0', 33, 0, '', 1, 0, '', '', 0),
(508, '屏东县', '0', 33, 0, '', 1, 0, '', '', 0),
(509, '宜兰县', '0', 33, 0, '', 1, 0, '', '', 0),
(510, '花莲县', '0', 33, 0, '', 1, 0, '', '', 0),
(511, '台东县', '0', 33, 0, '', 1, 0, '', '', 0),
(512, '澎湖县', '0', 33, 0, '', 1, 0, '', '', 0),
(513, '金门县', '0', 33, 0, '', 1, 0, '', '', 0),
(514, '连江县', '0', 33, 0, '', 1, 0, '', '', 0),
(515, '中西区', '0', 34, 0, '', 1, 0, '', '', 0),
(516, '东区', '0', 34, 0, '', 1, 0, '', '', 0),
(517, '南区', '0', 34, 0, '', 1, 0, '', '', 0),
(518, '湾仔区', '0', 34, 0, '', 1, 0, '', '', 0),
(519, '九龙城区', '0', 34, 0, '', 1, 0, '', '', 0),
(520, '观塘区', '0', 34, 0, '', 1, 0, '', '', 0),
(521, '深水埗区', '0', 34, 0, '', 1, 0, '', '', 0),
(522, '黄大仙区', '0', 34, 0, '', 1, 0, '', '', 0),
(523, '油尖旺区', '0', 34, 0, '', 1, 0, '', '', 0),
(524, '离岛区', '0', 34, 0, '', 1, 0, '', '', 0),
(525, '葵青区', '0', 34, 0, '', 1, 0, '', '', 0),
(526, '北区', '0', 34, 0, '', 1, 0, '', '', 0),
(527, '西贡区', '0', 34, 0, '', 1, 0, '', '', 0),
(528, '沙田区', '0', 34, 0, '', 1, 0, '', '', 0),
(529, '大埔区', '0', 34, 0, '', 1, 0, '', '', 0),
(530, '荃湾区', '0', 34, 0, '', 1, 0, '', '', 0),
(531, '屯门区', '0', 34, 0, '', 1, 0, '', '', 0),
(532, '元朗区', '0', 34, 0, '', 1, 0, '', '', 0),
(533, '花地玛堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(534, '市圣安多尼堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(535, '大堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(536, '望德堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(537, '风顺堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(538, '嘉模堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(539, '圣方济各堂区', '0', 35, 0, '', 1, 0, '', '', 0),
(540, '长安区', '0', 130, 0, '', 1, 0, '', '', 0),
(541, '桥东区', '0', 130, 0, '', 1, 0, '', '', 0),
(542, '桥西区', '0', 130, 0, '', 1, 0, '', '', 0),
(543, '新华区', '0', 130, 0, '', 1, 0, '', '', 0),
(544, '井陉矿区', '0', 130, 0, '', 1, 0, '', '', 0),
(545, '裕华区', '0', 130, 0, '', 1, 0, '', '', 0),
(546, '井陉县', '0', 130, 0, '', 1, 0, '', '', 0),
(547, '正定县', '0', 130, 0, '', 1, 0, '', '', 0),
(548, '栾城县', '0', 130, 0, '', 1, 0, '', '', 0),
(549, '行唐县', '0', 130, 0, '', 1, 0, '', '', 0),
(550, '灵寿县', '0', 130, 0, '', 1, 0, '', '', 0),
(551, '高邑县', '0', 130, 0, '', 1, 0, '', '', 0),
(552, '深泽县', '0', 130, 0, '', 1, 0, '', '', 0),
(553, '赞皇县', '0', 130, 0, '', 1, 0, '', '', 0),
(554, '无极县', '0', 130, 0, '', 1, 0, '', '', 0),
(555, '平山县', '0', 130, 0, '', 1, 0, '', '', 0),
(556, '元氏县', '0', 130, 0, '', 1, 0, '', '', 0),
(557, '赵县', '0', 130, 0, '', 1, 0, '', '', 0),
(558, '辛集市', '0', 130, 0, '', 1, 0, '', '', 0),
(559, '藁城市', '0', 130, 0, '', 1, 0, '', '', 0),
(560, '晋州市', '0', 130, 0, '', 1, 0, '', '', 0),
(561, '新乐市', '0', 130, 0, '', 1, 0, '', '', 0),
(562, '鹿泉市', '0', 130, 0, '', 1, 0, '', '', 0),
(563, '路南区', '0', 131, 0, '', 1, 0, '', '', 0),
(564, '路北区', '0', 131, 0, '', 1, 0, '', '', 0),
(565, '古冶区', '0', 131, 0, '', 1, 0, '', '', 0),
(566, '开平区', '0', 131, 0, '', 1, 0, '', '', 0),
(567, '丰南区', '0', 131, 0, '', 1, 0, '', '', 0),
(568, '丰润区', '0', 131, 0, '', 1, 0, '', '', 0),
(569, '滦县', '0', 131, 0, '', 1, 0, '', '', 0),
(570, '滦南县', '0', 131, 0, '', 1, 0, '', '', 0),
(571, '乐亭县', '0', 131, 0, '', 1, 0, '', '', 0),
(572, '迁西县', '0', 131, 0, '', 1, 0, '', '', 0),
(573, '玉田县', '0', 131, 0, '', 1, 0, '', '', 0),
(574, '唐海县', '0', 131, 0, '', 1, 0, '', '', 0),
(575, '遵化市', '0', 131, 0, '', 1, 0, '', '', 0),
(576, '迁安市', '0', 131, 0, '', 1, 0, '', '', 0),
(577, '海港区', '0', 132, 0, '', 1, 0, '', '', 0),
(578, '山海关区', '0', 132, 0, '', 1, 0, '', '', 0),
(579, '北戴河区', '0', 132, 0, '', 1, 0, '', '', 0),
(580, '青龙县', '0', 132, 0, '', 1, 0, '', '', 0),
(581, '昌黎县', '0', 132, 0, '', 1, 0, '', '', 0),
(582, '抚宁县', '0', 132, 0, '', 1, 0, '', '', 0),
(583, '卢龙县', '0', 132, 0, '', 1, 0, '', '', 0),
(584, '邯山区', '0', 133, 0, '', 1, 0, '', '', 0),
(585, '丛台区', '0', 133, 0, '', 1, 0, '', '', 0),
(586, '复兴区', '0', 133, 0, '', 1, 0, '', '', 0),
(587, '峰峰矿区', '0', 133, 0, '', 1, 0, '', '', 0),
(588, '邯郸县', '0', 133, 0, '', 1, 0, '', '', 0),
(589, '临漳县', '0', 133, 0, '', 1, 0, '', '', 0),
(590, '成安县', '0', 133, 0, '', 1, 0, '', '', 0),
(591, '大名县', '0', 133, 0, '', 1, 0, '', '', 0),
(592, '涉县', '0', 133, 0, '', 1, 0, '', '', 0),
(593, '磁县', '0', 133, 0, '', 1, 0, '', '', 0),
(594, '肥乡县', '0', 133, 0, '', 1, 0, '', '', 0),
(595, '永年县', '0', 133, 0, '', 1, 0, '', '', 0),
(596, '邱县', '0', 133, 0, '', 1, 0, '', '', 0),
(597, '鸡泽县', '0', 133, 0, '', 1, 0, '', '', 0),
(598, '广平县', '0', 133, 0, '', 1, 0, '', '', 0),
(599, '馆陶县', '0', 133, 0, '', 1, 0, '', '', 0),
(600, '魏县', '0', 133, 0, '', 1, 0, '', '', 0),
(601, '曲周县', '0', 133, 0, '', 1, 0, '', '', 0),
(602, '武安市', '0', 133, 0, '', 1, 0, '', '', 0),
(603, '桥东区', '0', 134, 0, '', 1, 0, '', '', 0),
(604, '桥西区', '0', 134, 0, '', 1, 0, '', '', 0),
(605, '邢台县', '0', 134, 0, '', 1, 0, '', '', 0),
(606, '临城县', '0', 134, 0, '', 1, 0, '', '', 0),
(607, '内丘县', '0', 134, 0, '', 1, 0, '', '', 0),
(608, '柏乡县', '0', 134, 0, '', 1, 0, '', '', 0),
(609, '隆尧县', '0', 134, 0, '', 1, 0, '', '', 0),
(610, '任县', '0', 134, 0, '', 1, 0, '', '', 0),
(611, '南和县', '0', 134, 0, '', 1, 0, '', '', 0),
(612, '宁晋县', '0', 134, 0, '', 1, 0, '', '', 0),
(613, '巨鹿县', '0', 134, 0, '', 1, 0, '', '', 0),
(614, '新河县', '0', 134, 0, '', 1, 0, '', '', 0),
(615, '广宗县', '0', 134, 0, '', 1, 0, '', '', 0),
(616, '平乡县', '0', 134, 0, '', 1, 0, '', '', 0),
(617, '威县', '0', 134, 0, '', 1, 0, '', '', 0),
(618, '清河县', '0', 134, 0, '', 1, 0, '', '', 0),
(619, '临西县', '0', 134, 0, '', 1, 0, '', '', 0),
(620, '南宫市', '0', 134, 0, '', 1, 0, '', '', 0),
(621, '沙河市', '0', 134, 0, '', 1, 0, '', '', 0),
(622, '新市区', '0', 135, 0, '', 1, 0, '', '', 0),
(623, '北市区', '0', 135, 0, '', 1, 0, '', '', 0),
(624, '南市区', '0', 135, 0, '', 1, 0, '', '', 0),
(625, '满城县', '0', 135, 0, '', 1, 0, '', '', 0),
(626, '清苑县', '0', 135, 0, '', 1, 0, '', '', 0),
(627, '涞水县', '0', 135, 0, '', 1, 0, '', '', 0),
(628, '阜平县', '0', 135, 0, '', 1, 0, '', '', 0),
(629, '徐水县', '0', 135, 0, '', 1, 0, '', '', 0),
(630, '定兴县', '0', 135, 0, '', 1, 0, '', '', 0),
(631, '唐县', '0', 135, 0, '', 1, 0, '', '', 0),
(632, '高阳县', '0', 135, 0, '', 1, 0, '', '', 0),
(633, '容城县', '0', 135, 0, '', 1, 0, '', '', 0),
(634, '涞源县', '0', 135, 0, '', 1, 0, '', '', 0),
(635, '望都县', '0', 135, 0, '', 1, 0, '', '', 0),
(636, '安新县', '0', 135, 0, '', 1, 0, '', '', 0),
(637, '易县', '0', 135, 0, '', 1, 0, '', '', 0),
(638, '曲阳县', '0', 135, 0, '', 1, 0, '', '', 0),
(639, '蠡县', '0', 135, 0, '', 1, 0, '', '', 0),
(640, '顺平县', '0', 135, 0, '', 1, 0, '', '', 0),
(641, '博野县', '0', 135, 0, '', 1, 0, '', '', 0),
(642, '雄县', '0', 135, 0, '', 1, 0, '', '', 0),
(643, '涿州市', '0', 135, 0, '', 1, 0, '', '', 0),
(644, '定州市', '0', 135, 0, '', 1, 0, '', '', 0),
(645, '安国市', '0', 135, 0, '', 1, 0, '', '', 0),
(646, '高碑店市', '0', 135, 0, '', 1, 0, '', '', 0),
(647, '桥东区', '0', 136, 0, '', 1, 0, '', '', 0),
(648, '桥西区', '0', 136, 0, '', 1, 0, '', '', 0),
(649, '宣化区', '0', 136, 0, '', 1, 0, '', '', 0),
(650, '下花园区', '0', 136, 0, '', 1, 0, '', '', 0),
(651, '宣化县', '0', 136, 0, '', 1, 0, '', '', 0),
(652, '张北县', '0', 136, 0, '', 1, 0, '', '', 0),
(653, '康保县', '0', 136, 0, '', 1, 0, '', '', 0),
(654, '沽源县', '0', 136, 0, '', 1, 0, '', '', 0),
(655, '尚义县', '0', 136, 0, '', 1, 0, '', '', 0),
(656, '蔚县', '0', 136, 0, '', 1, 0, '', '', 0),
(657, '阳原县', '0', 136, 0, '', 1, 0, '', '', 0),
(658, '怀安县', '0', 136, 0, '', 1, 0, '', '', 0),
(659, '万全县', '0', 136, 0, '', 1, 0, '', '', 0),
(660, '怀来县', '0', 136, 0, '', 1, 0, '', '', 0),
(661, '涿鹿县', '0', 136, 0, '', 1, 0, '', '', 0),
(662, '赤城县', '0', 136, 0, '', 1, 0, '', '', 0),
(663, '崇礼县', '0', 136, 0, '', 1, 0, '', '', 0),
(664, '双桥区', '0', 137, 0, '', 1, 0, '', '', 0),
(665, '双滦区', '0', 137, 0, '', 1, 0, '', '', 0),
(666, '鹰手营子矿区', '0', 137, 0, '', 1, 0, '', '', 0),
(667, '承德县', '0', 137, 0, '', 1, 0, '', '', 0),
(668, '兴隆县', '0', 137, 0, '', 1, 0, '', '', 0),
(669, '平泉县', '0', 137, 0, '', 1, 0, '', '', 0),
(670, '滦平县', '0', 137, 0, '', 1, 0, '', '', 0),
(671, '隆化县', '0', 137, 0, '', 1, 0, '', '', 0),
(672, '丰宁县', '0', 137, 0, '', 1, 0, '', '', 0),
(673, '宽城县', '0', 137, 0, '', 1, 0, '', '', 0),
(674, '围场县', '0', 137, 0, '', 1, 0, '', '', 0),
(675, '新华区', '0', 138, 0, '', 1, 0, '', '', 0),
(676, '运河区', '0', 138, 0, '', 1, 0, '', '', 0),
(677, '沧县', '0', 138, 0, '', 1, 0, '', '', 0),
(678, '青县', '0', 138, 0, '', 1, 0, '', '', 0),
(679, '东光县', '0', 138, 0, '', 1, 0, '', '', 0),
(680, '海兴县', '0', 138, 0, '', 1, 0, '', '', 0),
(681, '盐山县', '0', 138, 0, '', 1, 0, '', '', 0),
(682, '肃宁县', '0', 138, 0, '', 1, 0, '', '', 0),
(683, '南皮县', '0', 138, 0, '', 1, 0, '', '', 0),
(684, '吴桥县', '0', 138, 0, '', 1, 0, '', '', 0),
(685, '献县', '0', 138, 0, '', 1, 0, '', '', 0),
(686, '孟村县', '0', 138, 0, '', 1, 0, '', '', 0),
(687, '泊头市', '0', 138, 0, '', 1, 0, '', '', 0),
(688, '任丘市', '0', 138, 0, '', 1, 0, '', '', 0),
(689, '黄骅市', '0', 138, 0, '', 1, 0, '', '', 0),
(690, '河间市', '0', 138, 0, '', 1, 0, '', '', 0),
(691, '安次区', '0', 139, 0, '', 1, 0, '', '', 0),
(692, '广阳区', '0', 139, 0, '', 1, 0, '', '', 0),
(693, '固安县', '0', 139, 0, '', 1, 0, '', '', 0),
(694, '永清县', '0', 139, 0, '', 1, 0, '', '', 0),
(695, '香河县', '0', 139, 0, '', 1, 0, '', '', 0),
(696, '大城县', '0', 139, 0, '', 1, 0, '', '', 0),
(697, '文安县', '0', 139, 0, '', 1, 0, '', '', 0),
(698, '大厂县', '0', 139, 0, '', 1, 0, '', '', 0),
(699, '霸州市', '0', 139, 0, '', 1, 0, '', '', 0),
(700, '三河市', '0', 139, 0, '', 1, 0, '', '', 0),
(701, '桃城区', '0', 140, 0, '', 1, 0, '', '', 0),
(702, '枣强县', '0', 140, 0, '', 1, 0, '', '', 0),
(703, '武邑县', '0', 140, 0, '', 1, 0, '', '', 0),
(704, '武强县', '0', 140, 0, '', 1, 0, '', '', 0),
(705, '饶阳县', '0', 140, 0, '', 1, 0, '', '', 0),
(706, '安平县', '0', 140, 0, '', 1, 0, '', '', 0),
(707, '故城县', '0', 140, 0, '', 1, 0, '', '', 0),
(708, '景县', '0', 140, 0, '', 1, 0, '', '', 0),
(709, '阜城县', '0', 140, 0, '', 1, 0, '', '', 0),
(710, '冀州市', '0', 140, 0, '', 1, 0, '', '', 0),
(711, '深州市', '0', 140, 0, '', 1, 0, '', '', 0),
(712, '小店区', '0', 141, 0, '', 1, 0, '', '', 0),
(713, '迎泽区', '0', 141, 0, '', 1, 0, '', '', 0),
(714, '杏花岭区', '0', 141, 0, '', 1, 0, '', '', 0),
(715, '尖草坪区', '0', 141, 0, '', 1, 0, '', '', 0),
(716, '万柏林区', '0', 141, 0, '', 1, 0, '', '', 0),
(717, '晋源区', '0', 141, 0, '', 1, 0, '', '', 0),
(718, '清徐县', '0', 141, 0, '', 1, 0, '', '', 0),
(719, '阳曲县', '0', 141, 0, '', 1, 0, '', '', 0),
(720, '娄烦县', '0', 141, 0, '', 1, 0, '', '', 0),
(721, '古交市', '0', 141, 0, '', 1, 0, '', '', 0),
(722, '城区', '0', 142, 0, '', 1, 0, '', '', 0),
(723, '矿区', '0', 142, 0, '', 1, 0, '', '', 0),
(724, '南郊区', '0', 142, 0, '', 1, 0, '', '', 0),
(725, '新荣区', '0', 142, 0, '', 1, 0, '', '', 0),
(726, '阳高县', '0', 142, 0, '', 1, 0, '', '', 0),
(727, '天镇县', '0', 142, 0, '', 1, 0, '', '', 0),
(728, '广灵县', '0', 142, 0, '', 1, 0, '', '', 0),
(729, '灵丘县', '0', 142, 0, '', 1, 0, '', '', 0),
(730, '浑源县', '0', 142, 0, '', 1, 0, '', '', 0),
(731, '左云县', '0', 142, 0, '', 1, 0, '', '', 0),
(732, '大同县', '0', 142, 0, '', 1, 0, '', '', 0),
(733, '城区', '0', 143, 0, '', 1, 0, '', '', 0),
(734, '矿区', '0', 143, 0, '', 1, 0, '', '', 0),
(735, '郊区', '0', 143, 0, '', 1, 0, '', '', 0),
(736, '平定县', '0', 143, 0, '', 1, 0, '', '', 0),
(737, '盂县', '0', 143, 0, '', 1, 0, '', '', 0),
(738, '城区', '0', 144, 0, '', 1, 0, '', '', 0),
(739, '郊区', '0', 144, 0, '', 1, 0, '', '', 0),
(740, '长治县', '0', 144, 0, '', 1, 0, '', '', 0),
(741, '襄垣县', '0', 144, 0, '', 1, 0, '', '', 0),
(742, '屯留县', '0', 144, 0, '', 1, 0, '', '', 0),
(743, '平顺县', '0', 144, 0, '', 1, 0, '', '', 0),
(744, '黎城县', '0', 144, 0, '', 1, 0, '', '', 0),
(745, '壶关县', '0', 144, 0, '', 1, 0, '', '', 0),
(746, '长子县', '0', 144, 0, '', 1, 0, '', '', 0),
(747, '武乡县', '0', 144, 0, '', 1, 0, '', '', 0),
(748, '沁县', '0', 144, 0, '', 1, 0, '', '', 0),
(749, '沁源县', '0', 144, 0, '', 1, 0, '', '', 0),
(750, '潞城市', '0', 144, 0, '', 1, 0, '', '', 0),
(751, '城区', '0', 145, 0, '', 1, 0, '', '', 0),
(752, '沁水县', '0', 145, 0, '', 1, 0, '', '', 0),
(753, '阳城县', '0', 145, 0, '', 1, 0, '', '', 0),
(754, '陵川县', '0', 145, 0, '', 1, 0, '', '', 0),
(755, '泽州县', '0', 145, 0, '', 1, 0, '', '', 0),
(756, '高平市', '0', 145, 0, '', 1, 0, '', '', 0),
(757, '朔城区', '0', 146, 0, '', 1, 0, '', '', 0),
(758, '平鲁区', '0', 146, 0, '', 1, 0, '', '', 0),
(759, '山阴县', '0', 146, 0, '', 1, 0, '', '', 0),
(760, '应县', '0', 146, 0, '', 1, 0, '', '', 0),
(761, '右玉县', '0', 146, 0, '', 1, 0, '', '', 0),
(762, '怀仁县', '0', 146, 0, '', 1, 0, '', '', 0),
(763, '榆次区', '0', 147, 0, '', 1, 0, '', '', 0),
(764, '榆社县', '0', 147, 0, '', 1, 0, '', '', 0),
(765, '左权县', '0', 147, 0, '', 1, 0, '', '', 0),
(766, '和顺县', '0', 147, 0, '', 1, 0, '', '', 0),
(767, '昔阳县', '0', 147, 0, '', 1, 0, '', '', 0),
(768, '寿阳县', '0', 147, 0, '', 1, 0, '', '', 0),
(769, '太谷县', '0', 147, 0, '', 1, 0, '', '', 0),
(770, '祁县', '0', 147, 0, '', 1, 0, '', '', 0),
(771, '平遥县', '0', 147, 0, '', 1, 0, '', '', 0),
(772, '灵石县', '0', 147, 0, '', 1, 0, '', '', 0),
(773, '介休市', '0', 147, 0, '', 1, 0, '', '', 0),
(774, '盐湖区', '0', 148, 0, '', 1, 0, '', '', 0),
(775, '临猗县', '0', 148, 0, '', 1, 0, '', '', 0),
(776, '万荣县', '0', 148, 0, '', 1, 0, '', '', 0),
(777, '闻喜县', '0', 148, 0, '', 1, 0, '', '', 0),
(778, '稷山县', '0', 148, 0, '', 1, 0, '', '', 0),
(779, '新绛县', '0', 148, 0, '', 1, 0, '', '', 0),
(780, '绛县', '0', 148, 0, '', 1, 0, '', '', 0),
(781, '垣曲县', '0', 148, 0, '', 1, 0, '', '', 0),
(782, '夏县', '0', 148, 0, '', 1, 0, '', '', 0),
(783, '平陆县', '0', 148, 0, '', 1, 0, '', '', 0),
(784, '芮城县', '0', 148, 0, '', 1, 0, '', '', 0),
(785, '永济市', '0', 148, 0, '', 1, 0, '', '', 0),
(786, '河津市', '0', 148, 0, '', 1, 0, '', '', 0),
(787, '忻府区', '0', 149, 0, '', 1, 0, '', '', 0),
(788, '定襄县', '0', 149, 0, '', 1, 0, '', '', 0),
(789, '五台县', '0', 149, 0, '', 1, 0, '', '', 0),
(790, '代县', '0', 149, 0, '', 1, 0, '', '', 0),
(791, '繁峙县', '0', 149, 0, '', 1, 0, '', '', 0),
(792, '宁武县', '0', 149, 0, '', 1, 0, '', '', 0),
(793, '静乐县', '0', 149, 0, '', 1, 0, '', '', 0),
(794, '神池县', '0', 149, 0, '', 1, 0, '', '', 0),
(795, '五寨县', '0', 149, 0, '', 1, 0, '', '', 0),
(796, '岢岚县', '0', 149, 0, '', 1, 0, '', '', 0),
(797, '河曲县', '0', 149, 0, '', 1, 0, '', '', 0),
(798, '保德县', '0', 149, 0, '', 1, 0, '', '', 0),
(799, '偏关县', '0', 149, 0, '', 1, 0, '', '', 0),
(800, '原平市', '0', 149, 0, '', 1, 0, '', '', 0),
(801, '尧都区', '0', 150, 0, '', 1, 0, '', '', 0),
(802, '曲沃县', '0', 150, 0, '', 1, 0, '', '', 0),
(803, '翼城县', '0', 150, 0, '', 1, 0, '', '', 0),
(804, '襄汾县', '0', 150, 0, '', 1, 0, '', '', 0),
(805, '洪洞县', '0', 150, 0, '', 1, 0, '', '', 0),
(806, '古县', '0', 150, 0, '', 1, 0, '', '', 0),
(807, '安泽县', '0', 150, 0, '', 1, 0, '', '', 0),
(808, '浮山县', '0', 150, 0, '', 1, 0, '', '', 0),
(809, '吉县', '0', 150, 0, '', 1, 0, '', '', 0),
(810, '乡宁县', '0', 150, 0, '', 1, 0, '', '', 0),
(811, '大宁县', '0', 150, 0, '', 1, 0, '', '', 0),
(812, '隰县', '0', 150, 0, '', 1, 0, '', '', 0),
(813, '永和县', '0', 150, 0, '', 1, 0, '', '', 0),
(814, '蒲县', '0', 150, 0, '', 1, 0, '', '', 0),
(815, '汾西县', '0', 150, 0, '', 1, 0, '', '', 0),
(816, '侯马市', '0', 150, 0, '', 1, 0, '', '', 0),
(817, '霍州市', '0', 150, 0, '', 1, 0, '', '', 0),
(818, '离石区', '0', 151, 0, '', 1, 0, '', '', 0),
(819, '文水县', '0', 151, 0, '', 1, 0, '', '', 0),
(820, '交城县', '0', 151, 0, '', 1, 0, '', '', 0),
(821, '兴县', '0', 151, 0, '', 1, 0, '', '', 0),
(822, '临县', '0', 151, 0, '', 1, 0, '', '', 0),
(823, '柳林县', '0', 151, 0, '', 1, 0, '', '', 0),
(824, '石楼县', '0', 151, 0, '', 1, 0, '', '', 0),
(825, '岚县', '0', 151, 0, '', 1, 0, '', '', 0),
(826, '方山县', '0', 151, 0, '', 1, 0, '', '', 0),
(827, '中阳县', '0', 151, 0, '', 1, 0, '', '', 0),
(828, '交口县', '0', 151, 0, '', 1, 0, '', '', 0),
(829, '孝义市', '0', 151, 0, '', 1, 0, '', '', 0),
(830, '汾阳市', '0', 151, 0, '', 1, 0, '', '', 0),
(831, '新城区', '0', 152, 0, '', 1, 0, '', '', 0),
(832, '回民区', '0', 152, 0, '', 1, 0, '', '', 0),
(833, '玉泉区', '0', 152, 0, '', 1, 0, '', '', 0),
(834, '赛罕区', '0', 152, 0, '', 1, 0, '', '', 0),
(835, '土默特左旗', '0', 152, 0, '', 1, 0, '', '', 0),
(836, '托克托县', '0', 152, 0, '', 1, 0, '', '', 0),
(837, '和林格尔县', '0', 152, 0, '', 1, 0, '', '', 0),
(838, '清水河县', '0', 152, 0, '', 1, 0, '', '', 0),
(839, '武川县', '0', 152, 0, '', 1, 0, '', '', 0),
(840, '东河区', '0', 153, 0, '', 1, 0, '', '', 0),
(841, '昆都仑区', '0', 153, 0, '', 1, 0, '', '', 0),
(842, '青山区', '0', 153, 0, '', 1, 0, '', '', 0),
(843, '石拐区', '0', 153, 0, '', 1, 0, '', '', 0),
(844, '白云矿区', '0', 153, 0, '', 1, 0, '', '', 0),
(845, '九原区', '0', 153, 0, '', 1, 0, '', '', 0),
(846, '土默特右旗', '0', 153, 0, '', 1, 0, '', '', 0),
(847, '固阳县', '0', 153, 0, '', 1, 0, '', '', 0),
(848, '达尔罕茂明安联合旗', '0', 153, 0, '', 1, 0, '', '', 0),
(849, '海勃湾区', '0', 154, 0, '', 1, 0, '', '', 0),
(850, '海南区', '0', 154, 0, '', 1, 0, '', '', 0),
(851, '乌达区', '0', 154, 0, '', 1, 0, '', '', 0),
(852, '红山区', '0', 155, 0, '', 1, 0, '', '', 0),
(853, '元宝山区', '0', 155, 0, '', 1, 0, '', '', 0),
(854, '松山区', '0', 155, 0, '', 1, 0, '', '', 0),
(855, '阿鲁科尔沁旗', '0', 155, 0, '', 1, 0, '', '', 0),
(856, '巴林左旗', '0', 155, 0, '', 1, 0, '', '', 0),
(857, '巴林右旗', '0', 155, 0, '', 1, 0, '', '', 0),
(858, '林西县', '0', 155, 0, '', 1, 0, '', '', 0),
(859, '克什克腾旗', '0', 155, 0, '', 1, 0, '', '', 0),
(860, '翁牛特旗', '0', 155, 0, '', 1, 0, '', '', 0),
(861, '喀喇沁旗', '0', 155, 0, '', 1, 0, '', '', 0),
(862, '宁城县', '0', 155, 0, '', 1, 0, '', '', 0),
(863, '敖汉旗', '0', 155, 0, '', 1, 0, '', '', 0),
(864, '科尔沁区', '0', 156, 0, '', 1, 0, '', '', 0),
(865, '科尔沁左翼中旗', '0', 156, 0, '', 1, 0, '', '', 0),
(866, '科尔沁左翼后旗', '0', 156, 0, '', 1, 0, '', '', 0),
(867, '开鲁县', '0', 156, 0, '', 1, 0, '', '', 0),
(868, '库伦旗', '0', 156, 0, '', 1, 0, '', '', 0),
(869, '奈曼旗', '0', 156, 0, '', 1, 0, '', '', 0),
(870, '扎鲁特旗', '0', 156, 0, '', 1, 0, '', '', 0),
(871, '霍林郭勒市', '0', 156, 0, '', 1, 0, '', '', 0),
(872, '东胜区', '0', 157, 0, '', 1, 0, '', '', 0),
(873, '达拉特旗', '0', 157, 0, '', 1, 0, '', '', 0),
(874, '准格尔旗', '0', 157, 0, '', 1, 0, '', '', 0),
(875, '鄂托克前旗', '0', 157, 0, '', 1, 0, '', '', 0),
(876, '鄂托克旗', '0', 157, 0, '', 1, 0, '', '', 0),
(877, '杭锦旗', '0', 157, 0, '', 1, 0, '', '', 0),
(878, '乌审旗', '0', 157, 0, '', 1, 0, '', '', 0),
(879, '伊金霍洛旗', '0', 157, 0, '', 1, 0, '', '', 0),
(880, '海拉尔区', '0', 158, 0, '', 1, 0, '', '', 0),
(881, '阿荣旗', '0', 158, 0, '', 1, 0, '', '', 0),
(882, '莫力达瓦达斡尔族自治旗', '0', 158, 0, '', 1, 0, '', '', 0),
(883, '鄂伦春自治旗', '0', 158, 0, '', 1, 0, '', '', 0),
(884, '鄂温克族自治旗', '0', 158, 0, '', 1, 0, '', '', 0),
(885, '陈巴尔虎旗', '0', 158, 0, '', 1, 0, '', '', 0),
(886, '新巴尔虎左旗', '0', 158, 0, '', 1, 0, '', '', 0),
(887, '新巴尔虎右旗', '0', 158, 0, '', 1, 0, '', '', 0),
(888, '满洲里市', '0', 158, 0, '', 1, 0, '', '', 0),
(889, '牙克石市', '0', 158, 0, '', 1, 0, '', '', 0),
(890, '扎兰屯市', '0', 158, 0, '', 1, 0, '', '', 0),
(891, '额尔古纳市', '0', 158, 0, '', 1, 0, '', '', 0),
(892, '根河市', '0', 158, 0, '', 1, 0, '', '', 0),
(893, '临河区', '0', 159, 0, '', 1, 0, '', '', 0),
(894, '五原县', '0', 159, 0, '', 1, 0, '', '', 0),
(895, '磴口县', '0', 159, 0, '', 1, 0, '', '', 0),
(896, '乌拉特前旗', '0', 159, 0, '', 1, 0, '', '', 0),
(897, '乌拉特中旗', '0', 159, 0, '', 1, 0, '', '', 0),
(898, '乌拉特后旗', '0', 159, 0, '', 1, 0, '', '', 0),
(899, '杭锦后旗', '0', 159, 0, '', 1, 0, '', '', 0),
(900, '集宁区', '0', 160, 0, '', 1, 0, '', '', 0),
(901, '卓资县', '0', 160, 0, '', 1, 0, '', '', 0),
(902, '化德县', '0', 160, 0, '', 1, 0, '', '', 0),
(903, '商都县', '0', 160, 0, '', 1, 0, '', '', 0),
(904, '兴和县', '0', 160, 0, '', 1, 0, '', '', 0),
(905, '凉城县', '0', 160, 0, '', 1, 0, '', '', 0),
(906, '察哈尔右翼前旗', '0', 160, 0, '', 1, 0, '', '', 0),
(907, '察哈尔右翼中旗', '0', 160, 0, '', 1, 0, '', '', 0),
(908, '察哈尔右翼后旗', '0', 160, 0, '', 1, 0, '', '', 0),
(909, '四子王旗', '0', 160, 0, '', 1, 0, '', '', 0),
(910, '丰镇市', '0', 160, 0, '', 1, 0, '', '', 0),
(911, '乌兰浩特市', '0', 161, 0, '', 1, 0, '', '', 0),
(912, '阿尔山市', '0', 161, 0, '', 1, 0, '', '', 0),
(913, '科尔沁右翼前旗', '0', 161, 0, '', 1, 0, '', '', 0),
(914, '科尔沁右翼中旗', '0', 161, 0, '', 1, 0, '', '', 0),
(915, '扎赉特旗', '0', 161, 0, '', 1, 0, '', '', 0),
(916, '突泉县', '0', 161, 0, '', 1, 0, '', '', 0),
(917, '二连浩特市', '0', 162, 0, '', 1, 0, '', '', 0),
(918, '锡林浩特市', '0', 162, 0, '', 1, 0, '', '', 0),
(919, '阿巴嘎旗', '0', 162, 0, '', 1, 0, '', '', 0),
(920, '苏尼特左旗', '0', 162, 0, '', 1, 0, '', '', 0),
(921, '苏尼特右旗', '0', 162, 0, '', 1, 0, '', '', 0),
(922, '东乌珠穆沁旗', '0', 162, 0, '', 1, 0, '', '', 0),
(923, '西乌珠穆沁旗', '0', 162, 0, '', 1, 0, '', '', 0),
(924, '太仆寺旗', '0', 162, 0, '', 1, 0, '', '', 0),
(925, '镶黄旗', '0', 162, 0, '', 1, 0, '', '', 0),
(926, '正镶白旗', '0', 162, 0, '', 1, 0, '', '', 0),
(927, '正蓝旗', '0', 162, 0, '', 1, 0, '', '', 0),
(928, '多伦县', '0', 162, 0, '', 1, 0, '', '', 0),
(929, '阿拉善左旗', '0', 163, 0, '', 1, 0, '', '', 0),
(930, '阿拉善右旗', '0', 163, 0, '', 1, 0, '', '', 0),
(931, '额济纳旗', '0', 163, 0, '', 1, 0, '', '', 0),
(932, '和平区', '0', 164, 0, '', 1, 0, '', '', 0),
(933, '沈河区', '0', 164, 0, '', 1, 0, '', '', 0),
(934, '大东区', '0', 164, 0, '', 1, 0, '', '', 0),
(935, '皇姑区', '0', 164, 0, '', 1, 0, '', '', 0),
(936, '铁西区', '0', 164, 0, '', 1, 0, '', '', 0),
(937, '苏家屯区', '0', 164, 0, '', 1, 0, '', '', 0),
(938, '东陵区', '0', 164, 0, '', 1, 0, '', '', 0),
(939, '新城子区', '0', 164, 0, '', 1, 0, '', '', 0),
(940, '于洪区', '0', 164, 0, '', 1, 0, '', '', 0),
(941, '辽中县', '0', 164, 0, '', 1, 0, '', '', 0),
(942, '康平县', '0', 164, 0, '', 1, 0, '', '', 0),
(943, '法库县', '0', 164, 0, '', 1, 0, '', '', 0),
(944, '新民市', '0', 164, 0, '', 1, 0, '', '', 0),
(945, '中山区', '0', 165, 0, '', 1, 0, '', '', 0),
(946, '西岗区', '0', 165, 0, '', 1, 0, '', '', 0),
(947, '沙河口区', '0', 165, 0, '', 1, 0, '', '', 0),
(948, '甘井子区', '0', 165, 0, '', 1, 0, '', '', 0),
(949, '旅顺口区', '0', 165, 0, '', 1, 0, '', '', 0),
(950, '金州区', '0', 165, 0, '', 1, 0, '', '', 0),
(951, '长海县', '0', 165, 0, '', 1, 0, '', '', 0),
(952, '瓦房店市', '0', 165, 0, '', 1, 0, '', '', 0),
(953, '普兰店市', '0', 165, 0, '', 1, 0, '', '', 0),
(954, '庄河市', '0', 165, 0, '', 1, 0, '', '', 0),
(955, '铁东区', '0', 166, 0, '', 1, 0, '', '', 0),
(956, '铁西区', '0', 166, 0, '', 1, 0, '', '', 0),
(957, '立山区', '0', 166, 0, '', 1, 0, '', '', 0),
(958, '千山区', '0', 166, 0, '', 1, 0, '', '', 0),
(959, '台安县', '0', 166, 0, '', 1, 0, '', '', 0),
(960, '岫岩满族自治县', '0', 166, 0, '', 1, 0, '', '', 0);
INSERT INTO `h5_linkage` (`linkageid`, `name`, `style`, `parentid`, `child`, `arrchildid`, `keyid`, `listorder`, `description`, `setting`, `siteid`) VALUES
(961, '海城市', '0', 166, 0, '', 1, 0, '', '', 0),
(962, '新抚区', '0', 167, 0, '', 1, 0, '', '', 0),
(963, '东洲区', '0', 167, 0, '', 1, 0, '', '', 0),
(964, '望花区', '0', 167, 0, '', 1, 0, '', '', 0),
(965, '顺城区', '0', 167, 0, '', 1, 0, '', '', 0),
(966, '抚顺县', '0', 167, 0, '', 1, 0, '', '', 0),
(967, '新宾满族自治县', '0', 167, 0, '', 1, 0, '', '', 0),
(968, '清原满族自治县', '0', 167, 0, '', 1, 0, '', '', 0),
(969, '平山区', '0', 168, 0, '', 1, 0, '', '', 0),
(970, '溪湖区', '0', 168, 0, '', 1, 0, '', '', 0),
(971, '明山区', '0', 168, 0, '', 1, 0, '', '', 0),
(972, '南芬区', '0', 168, 0, '', 1, 0, '', '', 0),
(973, '本溪满族自治县', '0', 168, 0, '', 1, 0, '', '', 0),
(974, '桓仁满族自治县', '0', 168, 0, '', 1, 0, '', '', 0),
(975, '元宝区', '0', 169, 0, '', 1, 0, '', '', 0),
(976, '振兴区', '0', 169, 0, '', 1, 0, '', '', 0),
(977, '振安区', '0', 169, 0, '', 1, 0, '', '', 0),
(978, '宽甸满族自治县', '0', 169, 0, '', 1, 0, '', '', 0),
(979, '东港市', '0', 169, 0, '', 1, 0, '', '', 0),
(980, '凤城市', '0', 169, 0, '', 1, 0, '', '', 0),
(981, '古塔区', '0', 170, 0, '', 1, 0, '', '', 0),
(982, '凌河区', '0', 170, 0, '', 1, 0, '', '', 0),
(983, '太和区', '0', 170, 0, '', 1, 0, '', '', 0),
(984, '黑山县', '0', 170, 0, '', 1, 0, '', '', 0),
(985, '义县', '0', 170, 0, '', 1, 0, '', '', 0),
(986, '凌海市', '0', 170, 0, '', 1, 0, '', '', 0),
(987, '北镇市', '0', 170, 0, '', 1, 0, '', '', 0),
(988, '站前区', '0', 171, 0, '', 1, 0, '', '', 0),
(989, '西市区', '0', 171, 0, '', 1, 0, '', '', 0),
(990, '鲅鱼圈区', '0', 171, 0, '', 1, 0, '', '', 0),
(991, '老边区', '0', 171, 0, '', 1, 0, '', '', 0),
(992, '盖州市', '0', 171, 0, '', 1, 0, '', '', 0),
(993, '大石桥市', '0', 171, 0, '', 1, 0, '', '', 0),
(994, '海州区', '0', 172, 0, '', 1, 0, '', '', 0),
(995, '新邱区', '0', 172, 0, '', 1, 0, '', '', 0),
(996, '太平区', '0', 172, 0, '', 1, 0, '', '', 0),
(997, '清河门区', '0', 172, 0, '', 1, 0, '', '', 0),
(998, '细河区', '0', 172, 0, '', 1, 0, '', '', 0),
(999, '阜新蒙古族自治县', '0', 172, 0, '', 1, 0, '', '', 0),
(1000, '彰武县', '0', 172, 0, '', 1, 0, '', '', 0),
(1001, '白塔区', '0', 173, 0, '', 1, 0, '', '', 0),
(1002, '文圣区', '0', 173, 0, '', 1, 0, '', '', 0),
(1003, '宏伟区', '0', 173, 0, '', 1, 0, '', '', 0),
(1004, '弓长岭区', '0', 173, 0, '', 1, 0, '', '', 0),
(1005, '太子河区', '0', 173, 0, '', 1, 0, '', '', 0),
(1006, '辽阳县', '0', 173, 0, '', 1, 0, '', '', 0),
(1007, '灯塔市', '0', 173, 0, '', 1, 0, '', '', 0),
(1008, '双台子区', '0', 174, 0, '', 1, 0, '', '', 0),
(1009, '兴隆台区', '0', 174, 0, '', 1, 0, '', '', 0),
(1010, '大洼县', '0', 174, 0, '', 1, 0, '', '', 0),
(1011, '盘山县', '0', 174, 0, '', 1, 0, '', '', 0),
(1012, '银州区', '0', 175, 0, '', 1, 0, '', '', 0),
(1013, '清河区', '0', 175, 0, '', 1, 0, '', '', 0),
(1014, '铁岭县', '0', 175, 0, '', 1, 0, '', '', 0),
(1015, '西丰县', '0', 175, 0, '', 1, 0, '', '', 0),
(1016, '昌图县', '0', 175, 0, '', 1, 0, '', '', 0),
(1017, '调兵山市', '0', 175, 0, '', 1, 0, '', '', 0),
(1018, '开原市', '0', 175, 0, '', 1, 0, '', '', 0),
(1019, '双塔区', '0', 176, 0, '', 1, 0, '', '', 0),
(1020, '龙城区', '0', 176, 0, '', 1, 0, '', '', 0),
(1021, '朝阳县', '0', 176, 0, '', 1, 0, '', '', 0),
(1022, '建平县', '0', 176, 0, '', 1, 0, '', '', 0),
(1023, '喀喇沁左翼蒙古族自治县', '0', 176, 0, '', 1, 0, '', '', 0),
(1024, '北票市', '0', 176, 0, '', 1, 0, '', '', 0),
(1025, '凌源市', '0', 176, 0, '', 1, 0, '', '', 0),
(1026, '连山区', '0', 177, 0, '', 1, 0, '', '', 0),
(1027, '龙港区', '0', 177, 0, '', 1, 0, '', '', 0),
(1028, '南票区', '0', 177, 0, '', 1, 0, '', '', 0),
(1029, '绥中县', '0', 177, 0, '', 1, 0, '', '', 0),
(1030, '建昌县', '0', 177, 0, '', 1, 0, '', '', 0),
(1031, '兴城市', '0', 177, 0, '', 1, 0, '', '', 0),
(1032, '南关区', '0', 178, 0, '', 1, 0, '', '', 0),
(1033, '宽城区', '0', 178, 0, '', 1, 0, '', '', 0),
(1034, '朝阳区', '0', 178, 0, '', 1, 0, '', '', 0),
(1035, '二道区', '0', 178, 0, '', 1, 0, '', '', 0),
(1036, '绿园区', '0', 178, 0, '', 1, 0, '', '', 0),
(1037, '双阳区', '0', 178, 0, '', 1, 0, '', '', 0),
(1038, '农安县', '0', 178, 0, '', 1, 0, '', '', 0),
(1039, '九台市', '0', 178, 0, '', 1, 0, '', '', 0),
(1040, '榆树市', '0', 178, 0, '', 1, 0, '', '', 0),
(1041, '德惠市', '0', 178, 0, '', 1, 0, '', '', 0),
(1042, '昌邑区', '0', 179, 0, '', 1, 0, '', '', 0),
(1043, '龙潭区', '0', 179, 0, '', 1, 0, '', '', 0),
(1044, '船营区', '0', 179, 0, '', 1, 0, '', '', 0),
(1045, '丰满区', '0', 179, 0, '', 1, 0, '', '', 0),
(1046, '永吉县', '0', 179, 0, '', 1, 0, '', '', 0),
(1047, '蛟河市', '0', 179, 0, '', 1, 0, '', '', 0),
(1048, '桦甸市', '0', 179, 0, '', 1, 0, '', '', 0),
(1049, '舒兰市', '0', 179, 0, '', 1, 0, '', '', 0),
(1050, '磐石市', '0', 179, 0, '', 1, 0, '', '', 0),
(1051, '铁西区', '0', 180, 0, '', 1, 0, '', '', 0),
(1052, '铁东区', '0', 180, 0, '', 1, 0, '', '', 0),
(1053, '梨树县', '0', 180, 0, '', 1, 0, '', '', 0),
(1054, '伊通满族自治县', '0', 180, 0, '', 1, 0, '', '', 0),
(1055, '公主岭市', '0', 180, 0, '', 1, 0, '', '', 0),
(1056, '双辽市', '0', 180, 0, '', 1, 0, '', '', 0),
(1057, '龙山区', '0', 181, 0, '', 1, 0, '', '', 0),
(1058, '西安区', '0', 181, 0, '', 1, 0, '', '', 0),
(1059, '东丰县', '0', 181, 0, '', 1, 0, '', '', 0),
(1060, '东辽县', '0', 181, 0, '', 1, 0, '', '', 0),
(1061, '东昌区', '0', 182, 0, '', 1, 0, '', '', 0),
(1062, '二道江区', '0', 182, 0, '', 1, 0, '', '', 0),
(1063, '通化县', '0', 182, 0, '', 1, 0, '', '', 0),
(1064, '辉南县', '0', 182, 0, '', 1, 0, '', '', 0),
(1065, '柳河县', '0', 182, 0, '', 1, 0, '', '', 0),
(1066, '梅河口市', '0', 182, 0, '', 1, 0, '', '', 0),
(1067, '集安市', '0', 182, 0, '', 1, 0, '', '', 0),
(1068, '八道江区', '0', 183, 0, '', 1, 0, '', '', 0),
(1069, '抚松县', '0', 183, 0, '', 1, 0, '', '', 0),
(1070, '靖宇县', '0', 183, 0, '', 1, 0, '', '', 0),
(1071, '长白朝鲜族自治县', '0', 183, 0, '', 1, 0, '', '', 0),
(1072, '江源县', '0', 183, 0, '', 1, 0, '', '', 0),
(1073, '临江市', '0', 183, 0, '', 1, 0, '', '', 0),
(1074, '宁江区', '0', 184, 0, '', 1, 0, '', '', 0),
(1075, '前郭尔罗斯蒙古族自治县', '0', 184, 0, '', 1, 0, '', '', 0),
(1076, '长岭县', '0', 184, 0, '', 1, 0, '', '', 0),
(1077, '乾安县', '0', 184, 0, '', 1, 0, '', '', 0),
(1078, '扶余县', '0', 184, 0, '', 1, 0, '', '', 0),
(1079, '洮北区', '0', 185, 0, '', 1, 0, '', '', 0),
(1080, '镇赉县', '0', 185, 0, '', 1, 0, '', '', 0),
(1081, '通榆县', '0', 185, 0, '', 1, 0, '', '', 0),
(1082, '洮南市', '0', 185, 0, '', 1, 0, '', '', 0),
(1083, '大安市', '0', 185, 0, '', 1, 0, '', '', 0),
(1084, '延吉市', '0', 186, 0, '', 1, 0, '', '', 0),
(1085, '图们市', '0', 186, 0, '', 1, 0, '', '', 0),
(1086, '敦化市', '0', 186, 0, '', 1, 0, '', '', 0),
(1087, '珲春市', '0', 186, 0, '', 1, 0, '', '', 0),
(1088, '龙井市', '0', 186, 0, '', 1, 0, '', '', 0),
(1089, '和龙市', '0', 186, 0, '', 1, 0, '', '', 0),
(1090, '汪清县', '0', 186, 0, '', 1, 0, '', '', 0),
(1091, '安图县', '0', 186, 0, '', 1, 0, '', '', 0),
(1092, '道里区', '0', 187, 0, '', 1, 0, '', '', 0),
(1093, '南岗区', '0', 187, 0, '', 1, 0, '', '', 0),
(1094, '道外区', '0', 187, 0, '', 1, 0, '', '', 0),
(1095, '香坊区', '0', 187, 0, '', 1, 0, '', '', 0),
(1096, '动力区', '0', 187, 0, '', 1, 0, '', '', 0),
(1097, '平房区', '0', 187, 0, '', 1, 0, '', '', 0),
(1098, '松北区', '0', 187, 0, '', 1, 0, '', '', 0),
(1099, '呼兰区', '0', 187, 0, '', 1, 0, '', '', 0),
(1100, '依兰县', '0', 187, 0, '', 1, 0, '', '', 0),
(1101, '方正县', '0', 187, 0, '', 1, 0, '', '', 0),
(1102, '宾县', '0', 187, 0, '', 1, 0, '', '', 0),
(1103, '巴彦县', '0', 187, 0, '', 1, 0, '', '', 0),
(1104, '木兰县', '0', 187, 0, '', 1, 0, '', '', 0),
(1105, '通河县', '0', 187, 0, '', 1, 0, '', '', 0),
(1106, '延寿县', '0', 187, 0, '', 1, 0, '', '', 0),
(1107, '阿城市', '0', 187, 0, '', 1, 0, '', '', 0),
(1108, '双城市', '0', 187, 0, '', 1, 0, '', '', 0),
(1109, '尚志市', '0', 187, 0, '', 1, 0, '', '', 0),
(1110, '五常市', '0', 187, 0, '', 1, 0, '', '', 0),
(1111, '龙沙区', '0', 188, 0, '', 1, 0, '', '', 0),
(1112, '建华区', '0', 188, 0, '', 1, 0, '', '', 0),
(1113, '铁锋区', '0', 188, 0, '', 1, 0, '', '', 0),
(1114, '昂昂溪区', '0', 188, 0, '', 1, 0, '', '', 0),
(1115, '富拉尔基区', '0', 188, 0, '', 1, 0, '', '', 0),
(1116, '碾子山区', '0', 188, 0, '', 1, 0, '', '', 0),
(1117, '梅里斯达斡尔族区', '0', 188, 0, '', 1, 0, '', '', 0),
(1118, '龙江县', '0', 188, 0, '', 1, 0, '', '', 0),
(1119, '依安县', '0', 188, 0, '', 1, 0, '', '', 0),
(1120, '泰来县', '0', 188, 0, '', 1, 0, '', '', 0),
(1121, '甘南县', '0', 188, 0, '', 1, 0, '', '', 0),
(1122, '富裕县', '0', 188, 0, '', 1, 0, '', '', 0),
(1123, '克山县', '0', 188, 0, '', 1, 0, '', '', 0),
(1124, '克东县', '0', 188, 0, '', 1, 0, '', '', 0),
(1125, '拜泉县', '0', 188, 0, '', 1, 0, '', '', 0),
(1126, '讷河市', '0', 188, 0, '', 1, 0, '', '', 0),
(1127, '鸡冠区', '0', 189, 0, '', 1, 0, '', '', 0),
(1128, '恒山区', '0', 189, 0, '', 1, 0, '', '', 0),
(1129, '滴道区', '0', 189, 0, '', 1, 0, '', '', 0),
(1130, '梨树区', '0', 189, 0, '', 1, 0, '', '', 0),
(1131, '城子河区', '0', 189, 0, '', 1, 0, '', '', 0),
(1132, '麻山区', '0', 189, 0, '', 1, 0, '', '', 0),
(1133, '鸡东县', '0', 189, 0, '', 1, 0, '', '', 0),
(1134, '虎林市', '0', 189, 0, '', 1, 0, '', '', 0),
(1135, '密山市', '0', 189, 0, '', 1, 0, '', '', 0),
(1136, '向阳区', '0', 190, 0, '', 1, 0, '', '', 0),
(1137, '工农区', '0', 190, 0, '', 1, 0, '', '', 0),
(1138, '南山区', '0', 190, 0, '', 1, 0, '', '', 0),
(1139, '兴安区', '0', 190, 0, '', 1, 0, '', '', 0),
(1140, '东山区', '0', 190, 0, '', 1, 0, '', '', 0),
(1141, '兴山区', '0', 190, 0, '', 1, 0, '', '', 0),
(1142, '萝北县', '0', 190, 0, '', 1, 0, '', '', 0),
(1143, '绥滨县', '0', 190, 0, '', 1, 0, '', '', 0),
(1144, '尖山区', '0', 191, 0, '', 1, 0, '', '', 0),
(1145, '岭东区', '0', 191, 0, '', 1, 0, '', '', 0),
(1146, '四方台区', '0', 191, 0, '', 1, 0, '', '', 0),
(1147, '宝山区', '0', 191, 0, '', 1, 0, '', '', 0),
(1148, '集贤县', '0', 191, 0, '', 1, 0, '', '', 0),
(1149, '友谊县', '0', 191, 0, '', 1, 0, '', '', 0),
(1150, '宝清县', '0', 191, 0, '', 1, 0, '', '', 0),
(1151, '饶河县', '0', 191, 0, '', 1, 0, '', '', 0),
(1152, '萨尔图区', '0', 192, 0, '', 1, 0, '', '', 0),
(1153, '龙凤区', '0', 192, 0, '', 1, 0, '', '', 0),
(1154, '让胡路区', '0', 192, 0, '', 1, 0, '', '', 0),
(1155, '红岗区', '0', 192, 0, '', 1, 0, '', '', 0),
(1156, '大同区', '0', 192, 0, '', 1, 0, '', '', 0),
(1157, '肇州县', '0', 192, 0, '', 1, 0, '', '', 0),
(1158, '肇源县', '0', 192, 0, '', 1, 0, '', '', 0),
(1159, '林甸县', '0', 192, 0, '', 1, 0, '', '', 0),
(1160, '杜尔伯特蒙古族自治县', '0', 192, 0, '', 1, 0, '', '', 0),
(1161, '伊春区', '0', 193, 0, '', 1, 0, '', '', 0),
(1162, '南岔区', '0', 193, 0, '', 1, 0, '', '', 0),
(1163, '友好区', '0', 193, 0, '', 1, 0, '', '', 0),
(1164, '西林区', '0', 193, 0, '', 1, 0, '', '', 0),
(1165, '翠峦区', '0', 193, 0, '', 1, 0, '', '', 0),
(1166, '新青区', '0', 193, 0, '', 1, 0, '', '', 0),
(1167, '美溪区', '0', 193, 0, '', 1, 0, '', '', 0),
(1168, '金山屯区', '0', 193, 0, '', 1, 0, '', '', 0),
(1169, '五营区', '0', 193, 0, '', 1, 0, '', '', 0),
(1170, '乌马河区', '0', 193, 0, '', 1, 0, '', '', 0),
(1171, '汤旺河区', '0', 193, 0, '', 1, 0, '', '', 0),
(1172, '带岭区', '0', 193, 0, '', 1, 0, '', '', 0),
(1173, '乌伊岭区', '0', 193, 0, '', 1, 0, '', '', 0),
(1174, '红星区', '0', 193, 0, '', 1, 0, '', '', 0),
(1175, '上甘岭区', '0', 193, 0, '', 1, 0, '', '', 0),
(1176, '嘉荫县', '0', 193, 0, '', 1, 0, '', '', 0),
(1177, '铁力市', '0', 193, 0, '', 1, 0, '', '', 0),
(1178, '永红区', '0', 194, 0, '', 1, 0, '', '', 0),
(1179, '向阳区', '0', 194, 0, '', 1, 0, '', '', 0),
(1180, '前进区', '0', 194, 0, '', 1, 0, '', '', 0),
(1181, '东风区', '0', 194, 0, '', 1, 0, '', '', 0),
(1182, '郊区', '0', 194, 0, '', 1, 0, '', '', 0),
(1183, '桦南县', '0', 194, 0, '', 1, 0, '', '', 0),
(1184, '桦川县', '0', 194, 0, '', 1, 0, '', '', 0),
(1185, '汤原县', '0', 194, 0, '', 1, 0, '', '', 0),
(1186, '抚远县', '0', 194, 0, '', 1, 0, '', '', 0),
(1187, '同江市', '0', 194, 0, '', 1, 0, '', '', 0),
(1188, '富锦市', '0', 194, 0, '', 1, 0, '', '', 0),
(1189, '新兴区', '0', 195, 0, '', 1, 0, '', '', 0),
(1190, '桃山区', '0', 195, 0, '', 1, 0, '', '', 0),
(1191, '茄子河区', '0', 195, 0, '', 1, 0, '', '', 0),
(1192, '勃利县', '0', 195, 0, '', 1, 0, '', '', 0),
(1193, '东安区', '0', 196, 0, '', 1, 0, '', '', 0),
(1194, '阳明区', '0', 196, 0, '', 1, 0, '', '', 0),
(1195, '爱民区', '0', 196, 0, '', 1, 0, '', '', 0),
(1196, '西安区', '0', 196, 0, '', 1, 0, '', '', 0),
(1197, '东宁县', '0', 196, 0, '', 1, 0, '', '', 0),
(1198, '林口县', '0', 196, 0, '', 1, 0, '', '', 0),
(1199, '绥芬河市', '0', 196, 0, '', 1, 0, '', '', 0),
(1200, '海林市', '0', 196, 0, '', 1, 0, '', '', 0),
(1201, '宁安市', '0', 196, 0, '', 1, 0, '', '', 0),
(1202, '穆棱市', '0', 196, 0, '', 1, 0, '', '', 0),
(1203, '爱辉区', '0', 197, 0, '', 1, 0, '', '', 0),
(1204, '嫩江县', '0', 197, 0, '', 1, 0, '', '', 0),
(1205, '逊克县', '0', 197, 0, '', 1, 0, '', '', 0),
(1206, '孙吴县', '0', 197, 0, '', 1, 0, '', '', 0),
(1207, '北安市', '0', 197, 0, '', 1, 0, '', '', 0),
(1208, '五大连池市', '0', 197, 0, '', 1, 0, '', '', 0),
(1209, '北林区', '0', 198, 0, '', 1, 0, '', '', 0),
(1210, '望奎县', '0', 198, 0, '', 1, 0, '', '', 0),
(1211, '兰西县', '0', 198, 0, '', 1, 0, '', '', 0),
(1212, '青冈县', '0', 198, 0, '', 1, 0, '', '', 0),
(1213, '庆安县', '0', 198, 0, '', 1, 0, '', '', 0),
(1214, '明水县', '0', 198, 0, '', 1, 0, '', '', 0),
(1215, '绥棱县', '0', 198, 0, '', 1, 0, '', '', 0),
(1216, '安达市', '0', 198, 0, '', 1, 0, '', '', 0),
(1217, '肇东市', '0', 198, 0, '', 1, 0, '', '', 0),
(1218, '海伦市', '0', 198, 0, '', 1, 0, '', '', 0),
(1219, '呼玛县', '0', 199, 0, '', 1, 0, '', '', 0),
(1220, '塔河县', '0', 199, 0, '', 1, 0, '', '', 0),
(1221, '漠河县', '0', 199, 0, '', 1, 0, '', '', 0),
(1222, '玄武区', '0', 200, 0, '', 1, 0, '', '', 0),
(1223, '白下区', '0', 200, 0, '', 1, 0, '', '', 0),
(1224, '秦淮区', '0', 200, 0, '', 1, 0, '', '', 0),
(1225, '建邺区', '0', 200, 0, '', 1, 0, '', '', 0),
(1226, '鼓楼区', '0', 200, 0, '', 1, 0, '', '', 0),
(1227, '下关区', '0', 200, 0, '', 1, 0, '', '', 0),
(1228, '浦口区', '0', 200, 0, '', 1, 0, '', '', 0),
(1229, '栖霞区', '0', 200, 0, '', 1, 0, '', '', 0),
(1230, '雨花台区', '0', 200, 0, '', 1, 0, '', '', 0),
(1231, '江宁区', '0', 200, 0, '', 1, 0, '', '', 0),
(1232, '六合区', '0', 200, 0, '', 1, 0, '', '', 0),
(1233, '溧水县', '0', 200, 0, '', 1, 0, '', '', 0),
(1234, '高淳县', '0', 200, 0, '', 1, 0, '', '', 0),
(1235, '崇安区', '0', 201, 0, '', 1, 0, '', '', 0),
(1236, '南长区', '0', 201, 0, '', 1, 0, '', '', 0),
(1237, '北塘区', '0', 201, 0, '', 1, 0, '', '', 0),
(1238, '锡山区', '0', 201, 0, '', 1, 0, '', '', 0),
(1239, '惠山区', '0', 201, 0, '', 1, 0, '', '', 0),
(1240, '滨湖区', '0', 201, 0, '', 1, 0, '', '', 0),
(1241, '江阴市', '0', 201, 0, '', 1, 0, '', '', 0),
(1242, '宜兴市', '0', 201, 0, '', 1, 0, '', '', 0),
(1243, '鼓楼区', '0', 202, 0, '', 1, 0, '', '', 0),
(1244, '云龙区', '0', 202, 0, '', 1, 0, '', '', 0),
(1245, '九里区', '0', 202, 0, '', 1, 0, '', '', 0),
(1246, '贾汪区', '0', 202, 0, '', 1, 0, '', '', 0),
(1247, '泉山区', '0', 202, 0, '', 1, 0, '', '', 0),
(1248, '丰县', '0', 202, 0, '', 1, 0, '', '', 0),
(1249, '沛县', '0', 202, 0, '', 1, 0, '', '', 0),
(1250, '铜山县', '0', 202, 0, '', 1, 0, '', '', 0),
(1251, '睢宁县', '0', 202, 0, '', 1, 0, '', '', 0),
(1252, '新沂市', '0', 202, 0, '', 1, 0, '', '', 0),
(1253, '邳州市', '0', 202, 0, '', 1, 0, '', '', 0),
(1254, '天宁区', '0', 203, 0, '', 1, 0, '', '', 0),
(1255, '钟楼区', '0', 203, 0, '', 1, 0, '', '', 0),
(1256, '戚墅堰区', '0', 203, 0, '', 1, 0, '', '', 0),
(1257, '新北区', '0', 203, 0, '', 1, 0, '', '', 0),
(1258, '武进区', '0', 203, 0, '', 1, 0, '', '', 0),
(1259, '溧阳市', '0', 203, 0, '', 1, 0, '', '', 0),
(1260, '金坛市', '0', 203, 0, '', 1, 0, '', '', 0),
(1261, '沧浪区', '0', 204, 0, '', 1, 0, '', '', 0),
(1262, '平江区', '0', 204, 0, '', 1, 0, '', '', 0),
(1263, '金阊区', '0', 204, 0, '', 1, 0, '', '', 0),
(1264, '虎丘区', '0', 204, 0, '', 1, 0, '', '', 0),
(1265, '吴中区', '0', 204, 0, '', 1, 0, '', '', 0),
(1266, '相城区', '0', 204, 0, '', 1, 0, '', '', 0),
(1267, '常熟市', '0', 204, 0, '', 1, 0, '', '', 0),
(1268, '张家港市', '0', 204, 0, '', 1, 0, '', '', 0),
(1269, '昆山市', '0', 204, 0, '', 1, 0, '', '', 0),
(1270, '吴江市', '0', 204, 0, '', 1, 0, '', '', 0),
(1271, '太仓市', '0', 204, 0, '', 1, 0, '', '', 0),
(1272, '崇川区', '0', 205, 0, '', 1, 0, '', '', 0),
(1273, '港闸区', '0', 205, 0, '', 1, 0, '', '', 0),
(1274, '海安县', '0', 205, 0, '', 1, 0, '', '', 0),
(1275, '如东县', '0', 205, 0, '', 1, 0, '', '', 0),
(1276, '启东市', '0', 205, 0, '', 1, 0, '', '', 0),
(1277, '如皋市', '0', 205, 0, '', 1, 0, '', '', 0),
(1278, '通州市', '0', 205, 0, '', 1, 0, '', '', 0),
(1279, '海门市', '0', 205, 0, '', 1, 0, '', '', 0),
(1280, '连云区', '0', 206, 0, '', 1, 0, '', '', 0),
(1281, '新浦区', '0', 206, 0, '', 1, 0, '', '', 0),
(1282, '海州区', '0', 206, 0, '', 1, 0, '', '', 0),
(1283, '赣榆县', '0', 206, 0, '', 1, 0, '', '', 0),
(1284, '东海县', '0', 206, 0, '', 1, 0, '', '', 0),
(1285, '灌云县', '0', 206, 0, '', 1, 0, '', '', 0),
(1286, '灌南县', '0', 206, 0, '', 1, 0, '', '', 0),
(1287, '清河区', '0', 207, 0, '', 1, 0, '', '', 0),
(1288, '楚州区', '0', 207, 0, '', 1, 0, '', '', 0),
(1289, '淮阴区', '0', 207, 0, '', 1, 0, '', '', 0),
(1290, '清浦区', '0', 207, 0, '', 1, 0, '', '', 0),
(1291, '涟水县', '0', 207, 0, '', 1, 0, '', '', 0),
(1292, '洪泽县', '0', 207, 0, '', 1, 0, '', '', 0),
(1293, '盱眙县', '0', 207, 0, '', 1, 0, '', '', 0),
(1294, '金湖县', '0', 207, 0, '', 1, 0, '', '', 0),
(1295, '亭湖区', '0', 208, 0, '', 1, 0, '', '', 0),
(1296, '盐都区', '0', 208, 0, '', 1, 0, '', '', 0),
(1297, '响水县', '0', 208, 0, '', 1, 0, '', '', 0),
(1298, '滨海县', '0', 208, 0, '', 1, 0, '', '', 0),
(1299, '阜宁县', '0', 208, 0, '', 1, 0, '', '', 0),
(1300, '射阳县', '0', 208, 0, '', 1, 0, '', '', 0),
(1301, '建湖县', '0', 208, 0, '', 1, 0, '', '', 0),
(1302, '东台市', '0', 208, 0, '', 1, 0, '', '', 0),
(1303, '大丰市', '0', 208, 0, '', 1, 0, '', '', 0),
(1304, '广陵区', '0', 209, 0, '', 1, 0, '', '', 0),
(1305, '邗江区', '0', 209, 0, '', 1, 0, '', '', 0),
(1306, '维扬区', '0', 209, 0, '', 1, 0, '', '', 0),
(1307, '宝应县', '0', 209, 0, '', 1, 0, '', '', 0),
(1308, '仪征市', '0', 209, 0, '', 1, 0, '', '', 0),
(1309, '高邮市', '0', 209, 0, '', 1, 0, '', '', 0),
(1310, '江都市', '0', 209, 0, '', 1, 0, '', '', 0),
(1311, '京口区', '0', 210, 0, '', 1, 0, '', '', 0),
(1312, '润州区', '0', 210, 0, '', 1, 0, '', '', 0),
(1313, '丹徒区', '0', 210, 0, '', 1, 0, '', '', 0),
(1314, '丹阳市', '0', 210, 0, '', 1, 0, '', '', 0),
(1315, '扬中市', '0', 210, 0, '', 1, 0, '', '', 0),
(1316, '句容市', '0', 210, 0, '', 1, 0, '', '', 0),
(1317, '海陵区', '0', 211, 0, '', 1, 0, '', '', 0),
(1318, '高港区', '0', 211, 0, '', 1, 0, '', '', 0),
(1319, '兴化市', '0', 211, 0, '', 1, 0, '', '', 0),
(1320, '靖江市', '0', 211, 0, '', 1, 0, '', '', 0),
(1321, '泰兴市', '0', 211, 0, '', 1, 0, '', '', 0),
(1322, '姜堰市', '0', 211, 0, '', 1, 0, '', '', 0),
(1323, '宿城区', '0', 212, 0, '', 1, 0, '', '', 0),
(1324, '宿豫区', '0', 212, 0, '', 1, 0, '', '', 0),
(1325, '沭阳县', '0', 212, 0, '', 1, 0, '', '', 0),
(1326, '泗阳县', '0', 212, 0, '', 1, 0, '', '', 0),
(1327, '泗洪县', '0', 212, 0, '', 1, 0, '', '', 0),
(1328, '上城区', '0', 213, 0, '', 1, 0, '', '', 0),
(1329, '下城区', '0', 213, 0, '', 1, 0, '', '', 0),
(1330, '江干区', '0', 213, 0, '', 1, 0, '', '', 0),
(1331, '拱墅区', '0', 213, 0, '', 1, 0, '', '', 0),
(1332, '西湖区', '0', 213, 0, '', 1, 0, '', '', 0),
(1333, '滨江区', '0', 213, 0, '', 1, 0, '', '', 0),
(1334, '萧山区', '0', 213, 0, '', 1, 0, '', '', 0),
(1335, '余杭区', '0', 213, 0, '', 1, 0, '', '', 0),
(1336, '桐庐县', '0', 213, 0, '', 1, 0, '', '', 0),
(1337, '淳安县', '0', 213, 0, '', 1, 0, '', '', 0),
(1338, '建德市', '0', 213, 0, '', 1, 0, '', '', 0),
(1339, '富阳市', '0', 213, 0, '', 1, 0, '', '', 0),
(1340, '临安市', '0', 213, 0, '', 1, 0, '', '', 0),
(1341, '海曙区', '0', 214, 0, '', 1, 0, '', '', 0),
(1342, '江东区', '0', 214, 0, '', 1, 0, '', '', 0),
(1343, '江北区', '0', 214, 0, '', 1, 0, '', '', 0),
(1344, '北仑区', '0', 214, 0, '', 1, 0, '', '', 0),
(1345, '镇海区', '0', 214, 0, '', 1, 0, '', '', 0),
(1346, '鄞州区', '0', 214, 0, '', 1, 0, '', '', 0),
(1347, '象山县', '0', 214, 0, '', 1, 0, '', '', 0),
(1348, '宁海县', '0', 214, 0, '', 1, 0, '', '', 0),
(1349, '余姚市', '0', 214, 0, '', 1, 0, '', '', 0),
(1350, '慈溪市', '0', 214, 0, '', 1, 0, '', '', 0),
(1351, '奉化市', '0', 214, 0, '', 1, 0, '', '', 0),
(1352, '鹿城区', '0', 215, 0, '', 1, 0, '', '', 0),
(1353, '龙湾区', '0', 215, 0, '', 1, 0, '', '', 0),
(1354, '瓯海区', '0', 215, 0, '', 1, 0, '', '', 0),
(1355, '洞头县', '0', 215, 0, '', 1, 0, '', '', 0),
(1356, '永嘉县', '0', 215, 0, '', 1, 0, '', '', 0),
(1357, '平阳县', '0', 215, 0, '', 1, 0, '', '', 0),
(1358, '苍南县', '0', 215, 0, '', 1, 0, '', '', 0),
(1359, '文成县', '0', 215, 0, '', 1, 0, '', '', 0),
(1360, '泰顺县', '0', 215, 0, '', 1, 0, '', '', 0),
(1361, '瑞安市', '0', 215, 0, '', 1, 0, '', '', 0),
(1362, '乐清市', '0', 215, 0, '', 1, 0, '', '', 0),
(1363, '秀城区', '0', 216, 0, '', 1, 0, '', '', 0),
(1364, '秀洲区', '0', 216, 0, '', 1, 0, '', '', 0),
(1365, '嘉善县', '0', 216, 0, '', 1, 0, '', '', 0),
(1366, '海盐县', '0', 216, 0, '', 1, 0, '', '', 0),
(1367, '海宁市', '0', 216, 0, '', 1, 0, '', '', 0),
(1368, '平湖市', '0', 216, 0, '', 1, 0, '', '', 0),
(1369, '桐乡市', '0', 216, 0, '', 1, 0, '', '', 0),
(1370, '吴兴区', '0', 217, 0, '', 1, 0, '', '', 0),
(1371, '南浔区', '0', 217, 0, '', 1, 0, '', '', 0),
(1372, '德清县', '0', 217, 0, '', 1, 0, '', '', 0),
(1373, '长兴县', '0', 217, 0, '', 1, 0, '', '', 0),
(1374, '安吉县', '0', 217, 0, '', 1, 0, '', '', 0),
(1375, '越城区', '0', 218, 0, '', 1, 0, '', '', 0),
(1376, '绍兴县', '0', 218, 0, '', 1, 0, '', '', 0),
(1377, '新昌县', '0', 218, 0, '', 1, 0, '', '', 0),
(1378, '诸暨市', '0', 218, 0, '', 1, 0, '', '', 0),
(1379, '上虞市', '0', 218, 0, '', 1, 0, '', '', 0),
(1380, '嵊州市', '0', 218, 0, '', 1, 0, '', '', 0),
(1381, '婺城区', '0', 219, 0, '', 1, 0, '', '', 0),
(1382, '金东区', '0', 219, 0, '', 1, 0, '', '', 0),
(1383, '武义县', '0', 219, 0, '', 1, 0, '', '', 0),
(1384, '浦江县', '0', 219, 0, '', 1, 0, '', '', 0),
(1385, '磐安县', '0', 219, 0, '', 1, 0, '', '', 0),
(1386, '兰溪市', '0', 219, 0, '', 1, 0, '', '', 0),
(1387, '义乌市', '0', 219, 0, '', 1, 0, '', '', 0),
(1388, '东阳市', '0', 219, 0, '', 1, 0, '', '', 0),
(1389, '永康市', '0', 219, 0, '', 1, 0, '', '', 0),
(1390, '柯城区', '0', 220, 0, '', 1, 0, '', '', 0),
(1391, '衢江区', '0', 220, 0, '', 1, 0, '', '', 0),
(1392, '常山县', '0', 220, 0, '', 1, 0, '', '', 0),
(1393, '开化县', '0', 220, 0, '', 1, 0, '', '', 0),
(1394, '龙游县', '0', 220, 0, '', 1, 0, '', '', 0),
(1395, '江山市', '0', 220, 0, '', 1, 0, '', '', 0),
(1396, '定海区', '0', 221, 0, '', 1, 0, '', '', 0),
(1397, '普陀区', '0', 221, 0, '', 1, 0, '', '', 0),
(1398, '岱山县', '0', 221, 0, '', 1, 0, '', '', 0),
(1399, '嵊泗县', '0', 221, 0, '', 1, 0, '', '', 0),
(1400, '椒江区', '0', 222, 0, '', 1, 0, '', '', 0),
(1401, '黄岩区', '0', 222, 0, '', 1, 0, '', '', 0),
(1402, '路桥区', '0', 222, 0, '', 1, 0, '', '', 0),
(1403, '玉环县', '0', 222, 0, '', 1, 0, '', '', 0),
(1404, '三门县', '0', 222, 0, '', 1, 0, '', '', 0),
(1405, '天台县', '0', 222, 0, '', 1, 0, '', '', 0),
(1406, '仙居县', '0', 222, 0, '', 1, 0, '', '', 0),
(1407, '温岭市', '0', 222, 0, '', 1, 0, '', '', 0),
(1408, '临海市', '0', 222, 0, '', 1, 0, '', '', 0),
(1409, '莲都区', '0', 223, 0, '', 1, 0, '', '', 0),
(1410, '青田县', '0', 223, 0, '', 1, 0, '', '', 0),
(1411, '缙云县', '0', 223, 0, '', 1, 0, '', '', 0),
(1412, '遂昌县', '0', 223, 0, '', 1, 0, '', '', 0),
(1413, '松阳县', '0', 223, 0, '', 1, 0, '', '', 0),
(1414, '云和县', '0', 223, 0, '', 1, 0, '', '', 0),
(1415, '庆元县', '0', 223, 0, '', 1, 0, '', '', 0),
(1416, '景宁畲族自治县', '0', 223, 0, '', 1, 0, '', '', 0),
(1417, '龙泉市', '0', 223, 0, '', 1, 0, '', '', 0),
(1418, '瑶海区', '0', 224, 0, '', 1, 0, '', '', 0),
(1419, '庐阳区', '0', 224, 0, '', 1, 0, '', '', 0),
(1420, '蜀山区', '0', 224, 0, '', 1, 0, '', '', 0),
(1421, '包河区', '0', 224, 0, '', 1, 0, '', '', 0),
(1422, '长丰县', '0', 224, 0, '', 1, 0, '', '', 0),
(1423, '肥东县', '0', 224, 0, '', 1, 0, '', '', 0),
(1424, '肥西县', '0', 224, 0, '', 1, 0, '', '', 0),
(1425, '镜湖区', '0', 225, 0, '', 1, 0, '', '', 0),
(1426, '弋江区', '0', 225, 0, '', 1, 0, '', '', 0),
(1427, '鸠江区', '0', 225, 0, '', 1, 0, '', '', 0),
(1428, '三山区', '0', 225, 0, '', 1, 0, '', '', 0),
(1429, '芜湖县', '0', 225, 0, '', 1, 0, '', '', 0),
(1430, '繁昌县', '0', 225, 0, '', 1, 0, '', '', 0),
(1431, '南陵县', '0', 225, 0, '', 1, 0, '', '', 0),
(1432, '龙子湖区', '0', 226, 0, '', 1, 0, '', '', 0),
(1433, '蚌山区', '0', 226, 0, '', 1, 0, '', '', 0),
(1434, '禹会区', '0', 226, 0, '', 1, 0, '', '', 0),
(1435, '淮上区', '0', 226, 0, '', 1, 0, '', '', 0),
(1436, '怀远县', '0', 226, 0, '', 1, 0, '', '', 0),
(1437, '五河县', '0', 226, 0, '', 1, 0, '', '', 0),
(1438, '固镇县', '0', 226, 0, '', 1, 0, '', '', 0),
(1439, '大通区', '0', 227, 0, '', 1, 0, '', '', 0),
(1440, '田家庵区', '0', 227, 0, '', 1, 0, '', '', 0),
(1441, '谢家集区', '0', 227, 0, '', 1, 0, '', '', 0),
(1442, '八公山区', '0', 227, 0, '', 1, 0, '', '', 0),
(1443, '潘集区', '0', 227, 0, '', 1, 0, '', '', 0),
(1444, '凤台县', '0', 227, 0, '', 1, 0, '', '', 0),
(1445, '金家庄区', '0', 228, 0, '', 1, 0, '', '', 0),
(1446, '花山区', '0', 228, 0, '', 1, 0, '', '', 0),
(1447, '雨山区', '0', 228, 0, '', 1, 0, '', '', 0),
(1448, '当涂县', '0', 228, 0, '', 1, 0, '', '', 0),
(1449, '杜集区', '0', 229, 0, '', 1, 0, '', '', 0),
(1450, '相山区', '0', 229, 0, '', 1, 0, '', '', 0),
(1451, '烈山区', '0', 229, 0, '', 1, 0, '', '', 0),
(1452, '濉溪县', '0', 229, 0, '', 1, 0, '', '', 0),
(1453, '铜官山区', '0', 230, 0, '', 1, 0, '', '', 0),
(1454, '狮子山区', '0', 230, 0, '', 1, 0, '', '', 0),
(1455, '郊区', '0', 230, 0, '', 1, 0, '', '', 0),
(1456, '铜陵县', '0', 230, 0, '', 1, 0, '', '', 0),
(1457, '迎江区', '0', 231, 0, '', 1, 0, '', '', 0),
(1458, '大观区', '0', 231, 0, '', 1, 0, '', '', 0),
(1459, '宜秀区', '0', 231, 0, '', 1, 0, '', '', 0),
(1460, '怀宁县', '0', 231, 0, '', 1, 0, '', '', 0),
(1461, '枞阳县', '0', 231, 0, '', 1, 0, '', '', 0),
(1462, '潜山县', '0', 231, 0, '', 1, 0, '', '', 0),
(1463, '太湖县', '0', 231, 0, '', 1, 0, '', '', 0),
(1464, '宿松县', '0', 231, 0, '', 1, 0, '', '', 0),
(1465, '望江县', '0', 231, 0, '', 1, 0, '', '', 0),
(1466, '岳西县', '0', 231, 0, '', 1, 0, '', '', 0),
(1467, '桐城市', '0', 231, 0, '', 1, 0, '', '', 0),
(1468, '屯溪区', '0', 232, 0, '', 1, 0, '', '', 0),
(1469, '黄山区', '0', 232, 0, '', 1, 0, '', '', 0),
(1470, '徽州区', '0', 232, 0, '', 1, 0, '', '', 0),
(1471, '歙县', '0', 232, 0, '', 1, 0, '', '', 0),
(1472, '休宁县', '0', 232, 0, '', 1, 0, '', '', 0),
(1473, '黟县', '0', 232, 0, '', 1, 0, '', '', 0),
(1474, '祁门县', '0', 232, 0, '', 1, 0, '', '', 0),
(1475, '琅琊区', '0', 233, 0, '', 1, 0, '', '', 0),
(1476, '南谯区', '0', 233, 0, '', 1, 0, '', '', 0),
(1477, '来安县', '0', 233, 0, '', 1, 0, '', '', 0),
(1478, '全椒县', '0', 233, 0, '', 1, 0, '', '', 0),
(1479, '定远县', '0', 233, 0, '', 1, 0, '', '', 0),
(1480, '凤阳县', '0', 233, 0, '', 1, 0, '', '', 0),
(1481, '天长市', '0', 233, 0, '', 1, 0, '', '', 0),
(1482, '明光市', '0', 233, 0, '', 1, 0, '', '', 0),
(1483, '颍州区', '0', 234, 0, '', 1, 0, '', '', 0),
(1484, '颍东区', '0', 234, 0, '', 1, 0, '', '', 0),
(1485, '颍泉区', '0', 234, 0, '', 1, 0, '', '', 0),
(1486, '临泉县', '0', 234, 0, '', 1, 0, '', '', 0),
(1487, '太和县', '0', 234, 0, '', 1, 0, '', '', 0),
(1488, '阜南县', '0', 234, 0, '', 1, 0, '', '', 0),
(1489, '颍上县', '0', 234, 0, '', 1, 0, '', '', 0),
(1490, '界首市', '0', 234, 0, '', 1, 0, '', '', 0),
(1491, '埇桥区', '0', 235, 0, '', 1, 0, '', '', 0),
(1492, '砀山县', '0', 235, 0, '', 1, 0, '', '', 0),
(1493, '萧县', '0', 235, 0, '', 1, 0, '', '', 0),
(1494, '灵璧县', '0', 235, 0, '', 1, 0, '', '', 0),
(1495, '泗县', '0', 235, 0, '', 1, 0, '', '', 0),
(1496, '居巢区', '0', 236, 0, '', 1, 0, '', '', 0),
(1497, '庐江县', '0', 236, 0, '', 1, 0, '', '', 0),
(1498, '无为县', '0', 236, 0, '', 1, 0, '', '', 0),
(1499, '含山县', '0', 236, 0, '', 1, 0, '', '', 0),
(1500, '和县', '0', 236, 0, '', 1, 0, '', '', 0),
(1501, '金安区', '0', 237, 0, '', 1, 0, '', '', 0),
(1502, '裕安区', '0', 237, 0, '', 1, 0, '', '', 0),
(1503, '寿县', '0', 237, 0, '', 1, 0, '', '', 0),
(1504, '霍邱县', '0', 237, 0, '', 1, 0, '', '', 0),
(1505, '舒城县', '0', 237, 0, '', 1, 0, '', '', 0),
(1506, '金寨县', '0', 237, 0, '', 1, 0, '', '', 0),
(1507, '霍山县', '0', 237, 0, '', 1, 0, '', '', 0),
(1508, '谯城区', '0', 238, 0, '', 1, 0, '', '', 0),
(1509, '涡阳县', '0', 238, 0, '', 1, 0, '', '', 0),
(1510, '蒙城县', '0', 238, 0, '', 1, 0, '', '', 0),
(1511, '利辛县', '0', 238, 0, '', 1, 0, '', '', 0),
(1512, '贵池区', '0', 239, 0, '', 1, 0, '', '', 0),
(1513, '东至县', '0', 239, 0, '', 1, 0, '', '', 0),
(1514, '石台县', '0', 239, 0, '', 1, 0, '', '', 0),
(1515, '青阳县', '0', 239, 0, '', 1, 0, '', '', 0),
(1516, '宣州区', '0', 240, 0, '', 1, 0, '', '', 0),
(1517, '郎溪县', '0', 240, 0, '', 1, 0, '', '', 0),
(1518, '广德县', '0', 240, 0, '', 1, 0, '', '', 0),
(1519, '泾县', '0', 240, 0, '', 1, 0, '', '', 0),
(1520, '绩溪县', '0', 240, 0, '', 1, 0, '', '', 0),
(1521, '旌德县', '0', 240, 0, '', 1, 0, '', '', 0),
(1522, '宁国市', '0', 240, 0, '', 1, 0, '', '', 0),
(1523, '鼓楼区', '0', 241, 0, '', 1, 0, '', '', 0),
(1524, '台江区', '0', 241, 0, '', 1, 0, '', '', 0),
(1525, '仓山区', '0', 241, 0, '', 1, 0, '', '', 0),
(1526, '马尾区', '0', 241, 0, '', 1, 0, '', '', 0),
(1527, '晋安区', '0', 241, 0, '', 1, 0, '', '', 0),
(1528, '闽侯县', '0', 241, 0, '', 1, 0, '', '', 0),
(1529, '连江县', '0', 241, 0, '', 1, 0, '', '', 0),
(1530, '罗源县', '0', 241, 0, '', 1, 0, '', '', 0),
(1531, '闽清县', '0', 241, 0, '', 1, 0, '', '', 0),
(1532, '永泰县', '0', 241, 0, '', 1, 0, '', '', 0),
(1533, '平潭县', '0', 241, 0, '', 1, 0, '', '', 0),
(1534, '福清市', '0', 241, 0, '', 1, 0, '', '', 0),
(1535, '长乐市', '0', 241, 0, '', 1, 0, '', '', 0),
(1536, '思明区', '0', 242, 0, '', 1, 0, '', '', 0),
(1537, '海沧区', '0', 242, 0, '', 1, 0, '', '', 0),
(1538, '湖里区', '0', 242, 0, '', 1, 0, '', '', 0),
(1539, '集美区', '0', 242, 0, '', 1, 0, '', '', 0),
(1540, '同安区', '0', 242, 0, '', 1, 0, '', '', 0),
(1541, '翔安区', '0', 242, 0, '', 1, 0, '', '', 0),
(1542, '城厢区', '0', 243, 0, '', 1, 0, '', '', 0),
(1543, '涵江区', '0', 243, 0, '', 1, 0, '', '', 0),
(1544, '荔城区', '0', 243, 0, '', 1, 0, '', '', 0),
(1545, '秀屿区', '0', 243, 0, '', 1, 0, '', '', 0),
(1546, '仙游县', '0', 243, 0, '', 1, 0, '', '', 0),
(1547, '梅列区', '0', 244, 0, '', 1, 0, '', '', 0),
(1548, '三元区', '0', 244, 0, '', 1, 0, '', '', 0),
(1549, '明溪县', '0', 244, 0, '', 1, 0, '', '', 0),
(1550, '清流县', '0', 244, 0, '', 1, 0, '', '', 0),
(1551, '宁化县', '0', 244, 0, '', 1, 0, '', '', 0),
(1552, '大田县', '0', 244, 0, '', 1, 0, '', '', 0),
(1553, '尤溪县', '0', 244, 0, '', 1, 0, '', '', 0),
(1554, '沙县', '0', 244, 0, '', 1, 0, '', '', 0),
(1555, '将乐县', '0', 244, 0, '', 1, 0, '', '', 0),
(1556, '泰宁县', '0', 244, 0, '', 1, 0, '', '', 0),
(1557, '建宁县', '0', 244, 0, '', 1, 0, '', '', 0),
(1558, '永安市', '0', 244, 0, '', 1, 0, '', '', 0),
(1559, '鲤城区', '0', 245, 0, '', 1, 0, '', '', 0),
(1560, '丰泽区', '0', 245, 0, '', 1, 0, '', '', 0),
(1561, '洛江区', '0', 245, 0, '', 1, 0, '', '', 0),
(1562, '泉港区', '0', 245, 0, '', 1, 0, '', '', 0),
(1563, '惠安县', '0', 245, 0, '', 1, 0, '', '', 0),
(1564, '安溪县', '0', 245, 0, '', 1, 0, '', '', 0),
(1565, '永春县', '0', 245, 0, '', 1, 0, '', '', 0),
(1566, '德化县', '0', 245, 0, '', 1, 0, '', '', 0),
(1567, '金门县', '0', 245, 0, '', 1, 0, '', '', 0),
(1568, '石狮市', '0', 245, 0, '', 1, 0, '', '', 0),
(1569, '晋江市', '0', 245, 0, '', 1, 0, '', '', 0),
(1570, '南安市', '0', 245, 0, '', 1, 0, '', '', 0),
(1571, '芗城区', '0', 246, 0, '', 1, 0, '', '', 0),
(1572, '龙文区', '0', 246, 0, '', 1, 0, '', '', 0),
(1573, '云霄县', '0', 246, 0, '', 1, 0, '', '', 0),
(1574, '漳浦县', '0', 246, 0, '', 1, 0, '', '', 0),
(1575, '诏安县', '0', 246, 0, '', 1, 0, '', '', 0),
(1576, '长泰县', '0', 246, 0, '', 1, 0, '', '', 0),
(1577, '东山县', '0', 246, 0, '', 1, 0, '', '', 0),
(1578, '南靖县', '0', 246, 0, '', 1, 0, '', '', 0),
(1579, '平和县', '0', 246, 0, '', 1, 0, '', '', 0),
(1580, '华安县', '0', 246, 0, '', 1, 0, '', '', 0),
(1581, '龙海市', '0', 246, 0, '', 1, 0, '', '', 0),
(1582, '延平区', '0', 247, 0, '', 1, 0, '', '', 0),
(1583, '顺昌县', '0', 247, 0, '', 1, 0, '', '', 0),
(1584, '浦城县', '0', 247, 0, '', 1, 0, '', '', 0),
(1585, '光泽县', '0', 247, 0, '', 1, 0, '', '', 0),
(1586, '松溪县', '0', 247, 0, '', 1, 0, '', '', 0),
(1587, '政和县', '0', 247, 0, '', 1, 0, '', '', 0),
(1588, '邵武市', '0', 247, 0, '', 1, 0, '', '', 0),
(1589, '武夷山市', '0', 247, 0, '', 1, 0, '', '', 0),
(1590, '建瓯市', '0', 247, 0, '', 1, 0, '', '', 0),
(1591, '建阳市', '0', 247, 0, '', 1, 0, '', '', 0),
(1592, '新罗区', '0', 248, 0, '', 1, 0, '', '', 0),
(1593, '长汀县', '0', 248, 0, '', 1, 0, '', '', 0),
(1594, '永定县', '0', 248, 0, '', 1, 0, '', '', 0),
(1595, '上杭县', '0', 248, 0, '', 1, 0, '', '', 0),
(1596, '武平县', '0', 248, 0, '', 1, 0, '', '', 0),
(1597, '连城县', '0', 248, 0, '', 1, 0, '', '', 0),
(1598, '漳平市', '0', 248, 0, '', 1, 0, '', '', 0),
(1599, '蕉城区', '0', 249, 0, '', 1, 0, '', '', 0),
(1600, '霞浦县', '0', 249, 0, '', 1, 0, '', '', 0),
(1601, '古田县', '0', 249, 0, '', 1, 0, '', '', 0),
(1602, '屏南县', '0', 249, 0, '', 1, 0, '', '', 0),
(1603, '寿宁县', '0', 249, 0, '', 1, 0, '', '', 0),
(1604, '周宁县', '0', 249, 0, '', 1, 0, '', '', 0),
(1605, '柘荣县', '0', 249, 0, '', 1, 0, '', '', 0),
(1606, '福安市', '0', 249, 0, '', 1, 0, '', '', 0),
(1607, '福鼎市', '0', 249, 0, '', 1, 0, '', '', 0),
(1608, '东湖区', '0', 250, 0, '', 1, 0, '', '', 0),
(1609, '西湖区', '0', 250, 0, '', 1, 0, '', '', 0),
(1610, '青云谱区', '0', 250, 0, '', 1, 0, '', '', 0),
(1611, '湾里区', '0', 250, 0, '', 1, 0, '', '', 0),
(1612, '青山湖区', '0', 250, 0, '', 1, 0, '', '', 0),
(1613, '南昌县', '0', 250, 0, '', 1, 0, '', '', 0),
(1614, '新建县', '0', 250, 0, '', 1, 0, '', '', 0),
(1615, '安义县', '0', 250, 0, '', 1, 0, '', '', 0),
(1616, '进贤县', '0', 250, 0, '', 1, 0, '', '', 0),
(1617, '昌江区', '0', 251, 0, '', 1, 0, '', '', 0),
(1618, '珠山区', '0', 251, 0, '', 1, 0, '', '', 0),
(1619, '浮梁县', '0', 251, 0, '', 1, 0, '', '', 0),
(1620, '乐平市', '0', 251, 0, '', 1, 0, '', '', 0),
(1621, '安源区', '0', 252, 0, '', 1, 0, '', '', 0),
(1622, '湘东区', '0', 252, 0, '', 1, 0, '', '', 0),
(1623, '莲花县', '0', 252, 0, '', 1, 0, '', '', 0),
(1624, '上栗县', '0', 252, 0, '', 1, 0, '', '', 0),
(1625, '芦溪县', '0', 252, 0, '', 1, 0, '', '', 0),
(1626, '庐山区', '0', 253, 0, '', 1, 0, '', '', 0),
(1627, '浔阳区', '0', 253, 0, '', 1, 0, '', '', 0),
(1628, '九江县', '0', 253, 0, '', 1, 0, '', '', 0),
(1629, '武宁县', '0', 253, 0, '', 1, 0, '', '', 0),
(1630, '修水县', '0', 253, 0, '', 1, 0, '', '', 0),
(1631, '永修县', '0', 253, 0, '', 1, 0, '', '', 0),
(1632, '德安县', '0', 253, 0, '', 1, 0, '', '', 0),
(1633, '星子县', '0', 253, 0, '', 1, 0, '', '', 0),
(1634, '都昌县', '0', 253, 0, '', 1, 0, '', '', 0),
(1635, '湖口县', '0', 253, 0, '', 1, 0, '', '', 0),
(1636, '彭泽县', '0', 253, 0, '', 1, 0, '', '', 0),
(1637, '瑞昌市', '0', 253, 0, '', 1, 0, '', '', 0),
(1638, '渝水区', '0', 254, 0, '', 1, 0, '', '', 0),
(1639, '分宜县', '0', 254, 0, '', 1, 0, '', '', 0),
(1640, '月湖区', '0', 255, 0, '', 1, 0, '', '', 0),
(1641, '余江县', '0', 255, 0, '', 1, 0, '', '', 0),
(1642, '贵溪市', '0', 255, 0, '', 1, 0, '', '', 0),
(1643, '章贡区', '0', 256, 0, '', 1, 0, '', '', 0),
(1644, '赣县', '0', 256, 0, '', 1, 0, '', '', 0),
(1645, '信丰县', '0', 256, 0, '', 1, 0, '', '', 0),
(1646, '大余县', '0', 256, 0, '', 1, 0, '', '', 0),
(1647, '上犹县', '0', 256, 0, '', 1, 0, '', '', 0),
(1648, '崇义县', '0', 256, 0, '', 1, 0, '', '', 0),
(1649, '安远县', '0', 256, 0, '', 1, 0, '', '', 0),
(1650, '龙南县', '0', 256, 0, '', 1, 0, '', '', 0),
(1651, '定南县', '0', 256, 0, '', 1, 0, '', '', 0),
(1652, '全南县', '0', 256, 0, '', 1, 0, '', '', 0),
(1653, '宁都县', '0', 256, 0, '', 1, 0, '', '', 0),
(1654, '于都县', '0', 256, 0, '', 1, 0, '', '', 0),
(1655, '兴国县', '0', 256, 0, '', 1, 0, '', '', 0),
(1656, '会昌县', '0', 256, 0, '', 1, 0, '', '', 0),
(1657, '寻乌县', '0', 256, 0, '', 1, 0, '', '', 0),
(1658, '石城县', '0', 256, 0, '', 1, 0, '', '', 0),
(1659, '瑞金市', '0', 256, 0, '', 1, 0, '', '', 0),
(1660, '南康市', '0', 256, 0, '', 1, 0, '', '', 0),
(1661, '吉州区', '0', 257, 0, '', 1, 0, '', '', 0),
(1662, '青原区', '0', 257, 0, '', 1, 0, '', '', 0),
(1663, '吉安县', '0', 257, 0, '', 1, 0, '', '', 0),
(1664, '吉水县', '0', 257, 0, '', 1, 0, '', '', 0),
(1665, '峡江县', '0', 257, 0, '', 1, 0, '', '', 0),
(1666, '新干县', '0', 257, 0, '', 1, 0, '', '', 0),
(1667, '永丰县', '0', 257, 0, '', 1, 0, '', '', 0),
(1668, '泰和县', '0', 257, 0, '', 1, 0, '', '', 0),
(1669, '遂川县', '0', 257, 0, '', 1, 0, '', '', 0),
(1670, '万安县', '0', 257, 0, '', 1, 0, '', '', 0),
(1671, '安福县', '0', 257, 0, '', 1, 0, '', '', 0),
(1672, '永新县', '0', 257, 0, '', 1, 0, '', '', 0),
(1673, '井冈山市', '0', 257, 0, '', 1, 0, '', '', 0),
(1674, '袁州区', '0', 258, 0, '', 1, 0, '', '', 0),
(1675, '奉新县', '0', 258, 0, '', 1, 0, '', '', 0),
(1676, '万载县', '0', 258, 0, '', 1, 0, '', '', 0),
(1677, '上高县', '0', 258, 0, '', 1, 0, '', '', 0),
(1678, '宜丰县', '0', 258, 0, '', 1, 0, '', '', 0),
(1679, '靖安县', '0', 258, 0, '', 1, 0, '', '', 0),
(1680, '铜鼓县', '0', 258, 0, '', 1, 0, '', '', 0),
(1681, '丰城市', '0', 258, 0, '', 1, 0, '', '', 0),
(1682, '樟树市', '0', 258, 0, '', 1, 0, '', '', 0),
(1683, '高安市', '0', 258, 0, '', 1, 0, '', '', 0),
(1684, '临川区', '0', 259, 0, '', 1, 0, '', '', 0),
(1685, '南城县', '0', 259, 0, '', 1, 0, '', '', 0),
(1686, '黎川县', '0', 259, 0, '', 1, 0, '', '', 0),
(1687, '南丰县', '0', 259, 0, '', 1, 0, '', '', 0),
(1688, '崇仁县', '0', 259, 0, '', 1, 0, '', '', 0),
(1689, '乐安县', '0', 259, 0, '', 1, 0, '', '', 0),
(1690, '宜黄县', '0', 259, 0, '', 1, 0, '', '', 0),
(1691, '金溪县', '0', 259, 0, '', 1, 0, '', '', 0),
(1692, '资溪县', '0', 259, 0, '', 1, 0, '', '', 0),
(1693, '东乡县', '0', 259, 0, '', 1, 0, '', '', 0),
(1694, '广昌县', '0', 259, 0, '', 1, 0, '', '', 0),
(1695, '信州区', '0', 260, 0, '', 1, 0, '', '', 0),
(1696, '上饶县', '0', 260, 0, '', 1, 0, '', '', 0),
(1697, '广丰县', '0', 260, 0, '', 1, 0, '', '', 0),
(1698, '玉山县', '0', 260, 0, '', 1, 0, '', '', 0),
(1699, '铅山县', '0', 260, 0, '', 1, 0, '', '', 0),
(1700, '横峰县', '0', 260, 0, '', 1, 0, '', '', 0),
(1701, '弋阳县', '0', 260, 0, '', 1, 0, '', '', 0),
(1702, '余干县', '0', 260, 0, '', 1, 0, '', '', 0),
(1703, '鄱阳县', '0', 260, 0, '', 1, 0, '', '', 0),
(1704, '万年县', '0', 260, 0, '', 1, 0, '', '', 0),
(1705, '婺源县', '0', 260, 0, '', 1, 0, '', '', 0),
(1706, '德兴市', '0', 260, 0, '', 1, 0, '', '', 0),
(1707, '历下区', '0', 261, 0, '', 1, 0, '', '', 0),
(1708, '市中区', '0', 261, 0, '', 1, 0, '', '', 0),
(1709, '槐荫区', '0', 261, 0, '', 1, 0, '', '', 0),
(1710, '天桥区', '0', 261, 0, '', 1, 0, '', '', 0),
(1711, '历城区', '0', 261, 0, '', 1, 0, '', '', 0),
(1712, '长清区', '0', 261, 0, '', 1, 0, '', '', 0),
(1713, '平阴县', '0', 261, 0, '', 1, 0, '', '', 0),
(1714, '济阳县', '0', 261, 0, '', 1, 0, '', '', 0),
(1715, '商河县', '0', 261, 0, '', 1, 0, '', '', 0),
(1716, '章丘市', '0', 261, 0, '', 1, 0, '', '', 0),
(1717, '市南区', '0', 262, 0, '', 1, 0, '', '', 0),
(1718, '市北区', '0', 262, 0, '', 1, 0, '', '', 0),
(1719, '四方区', '0', 262, 0, '', 1, 0, '', '', 0),
(1720, '黄岛区', '0', 262, 0, '', 1, 0, '', '', 0),
(1721, '崂山区', '0', 262, 0, '', 1, 0, '', '', 0),
(1722, '李沧区', '0', 262, 0, '', 1, 0, '', '', 0),
(1723, '城阳区', '0', 262, 0, '', 1, 0, '', '', 0),
(1724, '胶州市', '0', 262, 0, '', 1, 0, '', '', 0),
(1725, '即墨市', '0', 262, 0, '', 1, 0, '', '', 0),
(1726, '平度市', '0', 262, 0, '', 1, 0, '', '', 0),
(1727, '胶南市', '0', 262, 0, '', 1, 0, '', '', 0),
(1728, '莱西市', '0', 262, 0, '', 1, 0, '', '', 0),
(1729, '淄川区', '0', 263, 0, '', 1, 0, '', '', 0),
(1730, '张店区', '0', 263, 0, '', 1, 0, '', '', 0),
(1731, '博山区', '0', 263, 0, '', 1, 0, '', '', 0),
(1732, '临淄区', '0', 263, 0, '', 1, 0, '', '', 0),
(1733, '周村区', '0', 263, 0, '', 1, 0, '', '', 0),
(1734, '桓台县', '0', 263, 0, '', 1, 0, '', '', 0),
(1735, '高青县', '0', 263, 0, '', 1, 0, '', '', 0),
(1736, '沂源县', '0', 263, 0, '', 1, 0, '', '', 0),
(1737, '市中区', '0', 264, 0, '', 1, 0, '', '', 0),
(1738, '薛城区', '0', 264, 0, '', 1, 0, '', '', 0),
(1739, '峄城区', '0', 264, 0, '', 1, 0, '', '', 0),
(1740, '台儿庄区', '0', 264, 0, '', 1, 0, '', '', 0),
(1741, '山亭区', '0', 264, 0, '', 1, 0, '', '', 0),
(1742, '滕州市', '0', 264, 0, '', 1, 0, '', '', 0),
(1743, '东营区', '0', 265, 0, '', 1, 0, '', '', 0),
(1744, '河口区', '0', 265, 0, '', 1, 0, '', '', 0),
(1745, '垦利县', '0', 265, 0, '', 1, 0, '', '', 0),
(1746, '利津县', '0', 265, 0, '', 1, 0, '', '', 0),
(1747, '广饶县', '0', 265, 0, '', 1, 0, '', '', 0),
(1748, '芝罘区', '0', 266, 0, '', 1, 0, '', '', 0),
(1749, '福山区', '0', 266, 0, '', 1, 0, '', '', 0),
(1750, '牟平区', '0', 266, 0, '', 1, 0, '', '', 0),
(1751, '莱山区', '0', 266, 0, '', 1, 0, '', '', 0),
(1752, '长岛县', '0', 266, 0, '', 1, 0, '', '', 0),
(1753, '龙口市', '0', 266, 0, '', 1, 0, '', '', 0),
(1754, '莱阳市', '0', 266, 0, '', 1, 0, '', '', 0),
(1755, '莱州市', '0', 266, 0, '', 1, 0, '', '', 0),
(1756, '蓬莱市', '0', 266, 0, '', 1, 0, '', '', 0),
(1757, '招远市', '0', 266, 0, '', 1, 0, '', '', 0),
(1758, '栖霞市', '0', 266, 0, '', 1, 0, '', '', 0),
(1759, '海阳市', '0', 266, 0, '', 1, 0, '', '', 0),
(1760, '潍城区', '0', 267, 0, '', 1, 0, '', '', 0),
(1761, '寒亭区', '0', 267, 0, '', 1, 0, '', '', 0),
(1762, '坊子区', '0', 267, 0, '', 1, 0, '', '', 0),
(1763, '奎文区', '0', 267, 0, '', 1, 0, '', '', 0),
(1764, '临朐县', '0', 267, 0, '', 1, 0, '', '', 0),
(1765, '昌乐县', '0', 267, 0, '', 1, 0, '', '', 0),
(1766, '青州市', '0', 267, 0, '', 1, 0, '', '', 0),
(1767, '诸城市', '0', 267, 0, '', 1, 0, '', '', 0),
(1768, '寿光市', '0', 267, 0, '', 1, 0, '', '', 0),
(1769, '安丘市', '0', 267, 0, '', 1, 0, '', '', 0),
(1770, '高密市', '0', 267, 0, '', 1, 0, '', '', 0),
(1771, '昌邑市', '0', 267, 0, '', 1, 0, '', '', 0),
(1772, '市中区', '0', 268, 0, '', 1, 0, '', '', 0),
(1773, '任城区', '0', 268, 0, '', 1, 0, '', '', 0),
(1774, '微山县', '0', 268, 0, '', 1, 0, '', '', 0),
(1775, '鱼台县', '0', 268, 0, '', 1, 0, '', '', 0),
(1776, '金乡县', '0', 268, 0, '', 1, 0, '', '', 0),
(1777, '嘉祥县', '0', 268, 0, '', 1, 0, '', '', 0),
(1778, '汶上县', '0', 268, 0, '', 1, 0, '', '', 0),
(1779, '泗水县', '0', 268, 0, '', 1, 0, '', '', 0),
(1780, '梁山县', '0', 268, 0, '', 1, 0, '', '', 0),
(1781, '曲阜市', '0', 268, 0, '', 1, 0, '', '', 0),
(1782, '兖州市', '0', 268, 0, '', 1, 0, '', '', 0),
(1783, '邹城市', '0', 268, 0, '', 1, 0, '', '', 0),
(1784, '泰山区', '0', 269, 0, '', 1, 0, '', '', 0),
(1785, '岱岳区', '0', 269, 0, '', 1, 0, '', '', 0),
(1786, '宁阳县', '0', 269, 0, '', 1, 0, '', '', 0),
(1787, '东平县', '0', 269, 0, '', 1, 0, '', '', 0),
(1788, '新泰市', '0', 269, 0, '', 1, 0, '', '', 0),
(1789, '肥城市', '0', 269, 0, '', 1, 0, '', '', 0),
(1790, '环翠区', '0', 270, 0, '', 1, 0, '', '', 0),
(1791, '文登市', '0', 270, 0, '', 1, 0, '', '', 0),
(1792, '荣成市', '0', 270, 0, '', 1, 0, '', '', 0),
(1793, '乳山市', '0', 270, 0, '', 1, 0, '', '', 0),
(1794, '东港区', '0', 271, 0, '', 1, 0, '', '', 0),
(1795, '岚山区', '0', 271, 0, '', 1, 0, '', '', 0),
(1796, '五莲县', '0', 271, 0, '', 1, 0, '', '', 0),
(1797, '莒县', '0', 271, 0, '', 1, 0, '', '', 0),
(1798, '莱城区', '0', 272, 0, '', 1, 0, '', '', 0),
(1799, '钢城区', '0', 272, 0, '', 1, 0, '', '', 0),
(1800, '兰山区', '0', 273, 0, '', 1, 0, '', '', 0),
(1801, '罗庄区', '0', 273, 0, '', 1, 0, '', '', 0),
(1802, '河东区', '0', 273, 0, '', 1, 0, '', '', 0),
(1803, '沂南县', '0', 273, 0, '', 1, 0, '', '', 0),
(1804, '郯城县', '0', 273, 0, '', 1, 0, '', '', 0),
(1805, '沂水县', '0', 273, 0, '', 1, 0, '', '', 0),
(1806, '苍山县', '0', 273, 0, '', 1, 0, '', '', 0),
(1807, '费县', '0', 273, 0, '', 1, 0, '', '', 0),
(1808, '平邑县', '0', 273, 0, '', 1, 0, '', '', 0),
(1809, '莒南县', '0', 273, 0, '', 1, 0, '', '', 0),
(1810, '蒙阴县', '0', 273, 0, '', 1, 0, '', '', 0),
(1811, '临沭县', '0', 273, 0, '', 1, 0, '', '', 0),
(1812, '德城区', '0', 274, 0, '', 1, 0, '', '', 0),
(1813, '陵县', '0', 274, 0, '', 1, 0, '', '', 0),
(1814, '宁津县', '0', 274, 0, '', 1, 0, '', '', 0),
(1815, '庆云县', '0', 274, 0, '', 1, 0, '', '', 0),
(1816, '临邑县', '0', 274, 0, '', 1, 0, '', '', 0),
(1817, '齐河县', '0', 274, 0, '', 1, 0, '', '', 0),
(1818, '平原县', '0', 274, 0, '', 1, 0, '', '', 0),
(1819, '夏津县', '0', 274, 0, '', 1, 0, '', '', 0),
(1820, '武城县', '0', 274, 0, '', 1, 0, '', '', 0),
(1821, '乐陵市', '0', 274, 0, '', 1, 0, '', '', 0),
(1822, '禹城市', '0', 274, 0, '', 1, 0, '', '', 0),
(1823, '东昌府区', '0', 275, 0, '', 1, 0, '', '', 0),
(1824, '阳谷县', '0', 275, 0, '', 1, 0, '', '', 0),
(1825, '莘县', '0', 275, 0, '', 1, 0, '', '', 0),
(1826, '茌平县', '0', 275, 0, '', 1, 0, '', '', 0),
(1827, '东阿县', '0', 275, 0, '', 1, 0, '', '', 0),
(1828, '冠县', '0', 275, 0, '', 1, 0, '', '', 0),
(1829, '高唐县', '0', 275, 0, '', 1, 0, '', '', 0),
(1830, '临清市', '0', 275, 0, '', 1, 0, '', '', 0),
(1831, '滨城区', '0', 276, 0, '', 1, 0, '', '', 0),
(1832, '惠民县', '0', 276, 0, '', 1, 0, '', '', 0),
(1833, '阳信县', '0', 276, 0, '', 1, 0, '', '', 0),
(1834, '无棣县', '0', 276, 0, '', 1, 0, '', '', 0),
(1835, '沾化县', '0', 276, 0, '', 1, 0, '', '', 0),
(1836, '博兴县', '0', 276, 0, '', 1, 0, '', '', 0),
(1837, '邹平县', '0', 276, 0, '', 1, 0, '', '', 0),
(1838, '牡丹区', '0', 277, 0, '', 1, 0, '', '', 0),
(1839, '曹县', '0', 277, 0, '', 1, 0, '', '', 0),
(1840, '单县', '0', 277, 0, '', 1, 0, '', '', 0),
(1841, '成武县', '0', 277, 0, '', 1, 0, '', '', 0),
(1842, '巨野县', '0', 277, 0, '', 1, 0, '', '', 0),
(1843, '郓城县', '0', 277, 0, '', 1, 0, '', '', 0),
(1844, '鄄城县', '0', 277, 0, '', 1, 0, '', '', 0),
(1845, '定陶县', '0', 277, 0, '', 1, 0, '', '', 0),
(1846, '东明县', '0', 277, 0, '', 1, 0, '', '', 0),
(1847, '中原区', '0', 278, 0, '', 1, 0, '', '', 0),
(1848, '二七区', '0', 278, 0, '', 1, 0, '', '', 0),
(1849, '管城回族区', '0', 278, 0, '', 1, 0, '', '', 0),
(1850, '金水区', '0', 278, 0, '', 1, 0, '', '', 0),
(1851, '上街区', '0', 278, 0, '', 1, 0, '', '', 0),
(1852, '惠济区', '0', 278, 0, '', 1, 0, '', '', 0),
(1853, '中牟县', '0', 278, 0, '', 1, 0, '', '', 0),
(1854, '巩义市', '0', 278, 0, '', 1, 0, '', '', 0),
(1855, '荥阳市', '0', 278, 0, '', 1, 0, '', '', 0),
(1856, '新密市', '0', 278, 0, '', 1, 0, '', '', 0),
(1857, '新郑市', '0', 278, 0, '', 1, 0, '', '', 0),
(1858, '登封市', '0', 278, 0, '', 1, 0, '', '', 0),
(1859, '龙亭区', '0', 279, 0, '', 1, 0, '', '', 0),
(1860, '顺河回族区', '0', 279, 0, '', 1, 0, '', '', 0),
(1861, '鼓楼区', '0', 279, 0, '', 1, 0, '', '', 0),
(1862, '禹王台区', '0', 279, 0, '', 1, 0, '', '', 0),
(1863, '金明区', '0', 279, 0, '', 1, 0, '', '', 0),
(1864, '杞县', '0', 279, 0, '', 1, 0, '', '', 0),
(1865, '通许县', '0', 279, 0, '', 1, 0, '', '', 0),
(1866, '尉氏县', '0', 279, 0, '', 1, 0, '', '', 0),
(1867, '开封县', '0', 279, 0, '', 1, 0, '', '', 0),
(1868, '兰考县', '0', 279, 0, '', 1, 0, '', '', 0),
(1869, '老城区', '0', 280, 0, '', 1, 0, '', '', 0),
(1870, '西工区', '0', 280, 0, '', 1, 0, '', '', 0),
(1871, '廛河回族区', '0', 280, 0, '', 1, 0, '', '', 0),
(1872, '涧西区', '0', 280, 0, '', 1, 0, '', '', 0),
(1873, '吉利区', '0', 280, 0, '', 1, 0, '', '', 0),
(1874, '洛龙区', '0', 280, 0, '', 1, 0, '', '', 0),
(1875, '孟津县', '0', 280, 0, '', 1, 0, '', '', 0),
(1876, '新安县', '0', 280, 0, '', 1, 0, '', '', 0),
(1877, '栾川县', '0', 280, 0, '', 1, 0, '', '', 0),
(1878, '嵩县', '0', 280, 0, '', 1, 0, '', '', 0),
(1879, '汝阳县', '0', 280, 0, '', 1, 0, '', '', 0),
(1880, '宜阳县', '0', 280, 0, '', 1, 0, '', '', 0),
(1881, '洛宁县', '0', 280, 0, '', 1, 0, '', '', 0),
(1882, '伊川县', '0', 280, 0, '', 1, 0, '', '', 0),
(1883, '偃师市', '0', 280, 0, '', 1, 0, '', '', 0),
(1884, '新华区', '0', 281, 0, '', 1, 0, '', '', 0),
(1885, '卫东区', '0', 281, 0, '', 1, 0, '', '', 0),
(1886, '石龙区', '0', 281, 0, '', 1, 0, '', '', 0),
(1887, '湛河区', '0', 281, 0, '', 1, 0, '', '', 0),
(1888, '宝丰县', '0', 281, 0, '', 1, 0, '', '', 0),
(1889, '叶县', '0', 281, 0, '', 1, 0, '', '', 0),
(1890, '鲁山县', '0', 281, 0, '', 1, 0, '', '', 0),
(1891, '郏县', '0', 281, 0, '', 1, 0, '', '', 0),
(1892, '舞钢市', '0', 281, 0, '', 1, 0, '', '', 0),
(1893, '汝州市', '0', 281, 0, '', 1, 0, '', '', 0),
(1894, '文峰区', '0', 282, 0, '', 1, 0, '', '', 0),
(1895, '北关区', '0', 282, 0, '', 1, 0, '', '', 0);
INSERT INTO `h5_linkage` (`linkageid`, `name`, `style`, `parentid`, `child`, `arrchildid`, `keyid`, `listorder`, `description`, `setting`, `siteid`) VALUES
(1896, '殷都区', '0', 282, 0, '', 1, 0, '', '', 0),
(1897, '龙安区', '0', 282, 0, '', 1, 0, '', '', 0),
(1898, '安阳县', '0', 282, 0, '', 1, 0, '', '', 0),
(1899, '汤阴县', '0', 282, 0, '', 1, 0, '', '', 0),
(1900, '滑县', '0', 282, 0, '', 1, 0, '', '', 0),
(1901, '内黄县', '0', 282, 0, '', 1, 0, '', '', 0),
(1902, '林州市', '0', 282, 0, '', 1, 0, '', '', 0),
(1903, '鹤山区', '0', 283, 0, '', 1, 0, '', '', 0),
(1904, '山城区', '0', 283, 0, '', 1, 0, '', '', 0),
(1905, '淇滨区', '0', 283, 0, '', 1, 0, '', '', 0),
(1906, '浚县', '0', 283, 0, '', 1, 0, '', '', 0),
(1907, '淇县', '0', 283, 0, '', 1, 0, '', '', 0),
(1908, '红旗区', '0', 284, 0, '', 1, 0, '', '', 0),
(1909, '卫滨区', '0', 284, 0, '', 1, 0, '', '', 0),
(1910, '凤泉区', '0', 284, 0, '', 1, 0, '', '', 0),
(1911, '牧野区', '0', 284, 0, '', 1, 0, '', '', 0),
(1912, '新乡县', '0', 284, 0, '', 1, 0, '', '', 0),
(1913, '获嘉县', '0', 284, 0, '', 1, 0, '', '', 0),
(1914, '原阳县', '0', 284, 0, '', 1, 0, '', '', 0),
(1915, '延津县', '0', 284, 0, '', 1, 0, '', '', 0),
(1916, '封丘县', '0', 284, 0, '', 1, 0, '', '', 0),
(1917, '长垣县', '0', 284, 0, '', 1, 0, '', '', 0),
(1918, '卫辉市', '0', 284, 0, '', 1, 0, '', '', 0),
(1919, '辉县市', '0', 284, 0, '', 1, 0, '', '', 0),
(1920, '解放区', '0', 285, 0, '', 1, 0, '', '', 0),
(1921, '中站区', '0', 285, 0, '', 1, 0, '', '', 0),
(1922, '马村区', '0', 285, 0, '', 1, 0, '', '', 0),
(1923, '山阳区', '0', 285, 0, '', 1, 0, '', '', 0),
(1924, '修武县', '0', 285, 0, '', 1, 0, '', '', 0),
(1925, '博爱县', '0', 285, 0, '', 1, 0, '', '', 0),
(1926, '武陟县', '0', 285, 0, '', 1, 0, '', '', 0),
(1927, '温县', '0', 285, 0, '', 1, 0, '', '', 0),
(1928, '济源市', '0', 285, 0, '', 1, 0, '', '', 0),
(1929, '沁阳市', '0', 285, 0, '', 1, 0, '', '', 0),
(1930, '孟州市', '0', 285, 0, '', 1, 0, '', '', 0),
(1931, '华龙区', '0', 286, 0, '', 1, 0, '', '', 0),
(1932, '清丰县', '0', 286, 0, '', 1, 0, '', '', 0),
(1933, '南乐县', '0', 286, 0, '', 1, 0, '', '', 0),
(1934, '范县', '0', 286, 0, '', 1, 0, '', '', 0),
(1935, '台前县', '0', 286, 0, '', 1, 0, '', '', 0),
(1936, '濮阳县', '0', 286, 0, '', 1, 0, '', '', 0),
(1937, '魏都区', '0', 287, 0, '', 1, 0, '', '', 0),
(1938, '许昌县', '0', 287, 0, '', 1, 0, '', '', 0),
(1939, '鄢陵县', '0', 287, 0, '', 1, 0, '', '', 0),
(1940, '襄城县', '0', 287, 0, '', 1, 0, '', '', 0),
(1941, '禹州市', '0', 287, 0, '', 1, 0, '', '', 0),
(1942, '长葛市', '0', 287, 0, '', 1, 0, '', '', 0),
(1943, '源汇区', '0', 288, 0, '', 1, 0, '', '', 0),
(1944, '郾城区', '0', 288, 0, '', 1, 0, '', '', 0),
(1945, '召陵区', '0', 288, 0, '', 1, 0, '', '', 0),
(1946, '舞阳县', '0', 288, 0, '', 1, 0, '', '', 0),
(1947, '临颍县', '0', 288, 0, '', 1, 0, '', '', 0),
(1948, '湖滨区', '0', 289, 0, '', 1, 0, '', '', 0),
(1949, '渑池县', '0', 289, 0, '', 1, 0, '', '', 0),
(1950, '陕县', '0', 289, 0, '', 1, 0, '', '', 0),
(1951, '卢氏县', '0', 289, 0, '', 1, 0, '', '', 0),
(1952, '义马市', '0', 289, 0, '', 1, 0, '', '', 0),
(1953, '灵宝市', '0', 289, 0, '', 1, 0, '', '', 0),
(1954, '宛城区', '0', 290, 0, '', 1, 0, '', '', 0),
(1955, '卧龙区', '0', 290, 0, '', 1, 0, '', '', 0),
(1956, '南召县', '0', 290, 0, '', 1, 0, '', '', 0),
(1957, '方城县', '0', 290, 0, '', 1, 0, '', '', 0),
(1958, '西峡县', '0', 290, 0, '', 1, 0, '', '', 0),
(1959, '镇平县', '0', 290, 0, '', 1, 0, '', '', 0),
(1960, '内乡县', '0', 290, 0, '', 1, 0, '', '', 0),
(1961, '淅川县', '0', 290, 0, '', 1, 0, '', '', 0),
(1962, '社旗县', '0', 290, 0, '', 1, 0, '', '', 0),
(1963, '唐河县', '0', 290, 0, '', 1, 0, '', '', 0),
(1964, '新野县', '0', 290, 0, '', 1, 0, '', '', 0),
(1965, '桐柏县', '0', 290, 0, '', 1, 0, '', '', 0),
(1966, '邓州市', '0', 290, 0, '', 1, 0, '', '', 0),
(1967, '梁园区', '0', 291, 0, '', 1, 0, '', '', 0),
(1968, '睢阳区', '0', 291, 0, '', 1, 0, '', '', 0),
(1969, '民权县', '0', 291, 0, '', 1, 0, '', '', 0),
(1970, '睢县', '0', 291, 0, '', 1, 0, '', '', 0),
(1971, '宁陵县', '0', 291, 0, '', 1, 0, '', '', 0),
(1972, '柘城县', '0', 291, 0, '', 1, 0, '', '', 0),
(1973, '虞城县', '0', 291, 0, '', 1, 0, '', '', 0),
(1974, '夏邑县', '0', 291, 0, '', 1, 0, '', '', 0),
(1975, '永城市', '0', 291, 0, '', 1, 0, '', '', 0),
(1976, '浉河区', '0', 292, 0, '', 1, 0, '', '', 0),
(1977, '平桥区', '0', 292, 0, '', 1, 0, '', '', 0),
(1978, '罗山县', '0', 292, 0, '', 1, 0, '', '', 0),
(1979, '光山县', '0', 292, 0, '', 1, 0, '', '', 0),
(1980, '新县', '0', 292, 0, '', 1, 0, '', '', 0),
(1981, '商城县', '0', 292, 0, '', 1, 0, '', '', 0),
(1982, '固始县', '0', 292, 0, '', 1, 0, '', '', 0),
(1983, '潢川县', '0', 292, 0, '', 1, 0, '', '', 0),
(1984, '淮滨县', '0', 292, 0, '', 1, 0, '', '', 0),
(1985, '息县', '0', 292, 0, '', 1, 0, '', '', 0),
(1986, '川汇区', '0', 293, 0, '', 1, 0, '', '', 0),
(1987, '扶沟县', '0', 293, 0, '', 1, 0, '', '', 0),
(1988, '西华县', '0', 293, 0, '', 1, 0, '', '', 0),
(1989, '商水县', '0', 293, 0, '', 1, 0, '', '', 0),
(1990, '沈丘县', '0', 293, 0, '', 1, 0, '', '', 0),
(1991, '郸城县', '0', 293, 0, '', 1, 0, '', '', 0),
(1992, '淮阳县', '0', 293, 0, '', 1, 0, '', '', 0),
(1993, '太康县', '0', 293, 0, '', 1, 0, '', '', 0),
(1994, '鹿邑县', '0', 293, 0, '', 1, 0, '', '', 0),
(1995, '项城市', '0', 293, 0, '', 1, 0, '', '', 0),
(1996, '驿城区', '0', 294, 0, '', 1, 0, '', '', 0),
(1997, '西平县', '0', 294, 0, '', 1, 0, '', '', 0),
(1998, '上蔡县', '0', 294, 0, '', 1, 0, '', '', 0),
(1999, '平舆县', '0', 294, 0, '', 1, 0, '', '', 0),
(2000, '正阳县', '0', 294, 0, '', 1, 0, '', '', 0),
(2001, '确山县', '0', 294, 0, '', 1, 0, '', '', 0),
(2002, '泌阳县', '0', 294, 0, '', 1, 0, '', '', 0),
(2003, '汝南县', '0', 294, 0, '', 1, 0, '', '', 0),
(2004, '遂平县', '0', 294, 0, '', 1, 0, '', '', 0),
(2005, '新蔡县', '0', 294, 0, '', 1, 0, '', '', 0),
(2006, '江岸区', '0', 295, 0, '', 1, 0, '', '', 0),
(2007, '江汉区', '0', 295, 0, '', 1, 0, '', '', 0),
(2008, '硚口区', '0', 295, 0, '', 1, 0, '', '', 0),
(2009, '汉阳区', '0', 295, 0, '', 1, 0, '', '', 0),
(2010, '武昌区', '0', 295, 0, '', 1, 0, '', '', 0),
(2011, '青山区', '0', 295, 0, '', 1, 0, '', '', 0),
(2012, '洪山区', '0', 295, 0, '', 1, 0, '', '', 0),
(2013, '东西湖区', '0', 295, 0, '', 1, 0, '', '', 0),
(2014, '汉南区', '0', 295, 0, '', 1, 0, '', '', 0),
(2015, '蔡甸区', '0', 295, 0, '', 1, 0, '', '', 0),
(2016, '江夏区', '0', 295, 0, '', 1, 0, '', '', 0),
(2017, '黄陂区', '0', 295, 0, '', 1, 0, '', '', 0),
(2018, '新洲区', '0', 295, 0, '', 1, 0, '', '', 0),
(2019, '黄石港区', '0', 296, 0, '', 1, 0, '', '', 0),
(2020, '西塞山区', '0', 296, 0, '', 1, 0, '', '', 0),
(2021, '下陆区', '0', 296, 0, '', 1, 0, '', '', 0),
(2022, '铁山区', '0', 296, 0, '', 1, 0, '', '', 0),
(2023, '阳新县', '0', 296, 0, '', 1, 0, '', '', 0),
(2024, '大冶市', '0', 296, 0, '', 1, 0, '', '', 0),
(2025, '茅箭区', '0', 297, 0, '', 1, 0, '', '', 0),
(2026, '张湾区', '0', 297, 0, '', 1, 0, '', '', 0),
(2027, '郧县', '0', 297, 0, '', 1, 0, '', '', 0),
(2028, '郧西县', '0', 297, 0, '', 1, 0, '', '', 0),
(2029, '竹山县', '0', 297, 0, '', 1, 0, '', '', 0),
(2030, '竹溪县', '0', 297, 0, '', 1, 0, '', '', 0),
(2031, '房县', '0', 297, 0, '', 1, 0, '', '', 0),
(2032, '丹江口市', '0', 297, 0, '', 1, 0, '', '', 0),
(2033, '西陵区', '0', 298, 0, '', 1, 0, '', '', 0),
(2034, '伍家岗区', '0', 298, 0, '', 1, 0, '', '', 0),
(2035, '点军区', '0', 298, 0, '', 1, 0, '', '', 0),
(2036, '猇亭区', '0', 298, 0, '', 1, 0, '', '', 0),
(2037, '夷陵区', '0', 298, 0, '', 1, 0, '', '', 0),
(2038, '远安县', '0', 298, 0, '', 1, 0, '', '', 0),
(2039, '兴山县', '0', 298, 0, '', 1, 0, '', '', 0),
(2040, '秭归县', '0', 298, 0, '', 1, 0, '', '', 0),
(2041, '长阳土家族自治县', '0', 298, 0, '', 1, 0, '', '', 0),
(2042, '五峰土家族自治县', '0', 298, 0, '', 1, 0, '', '', 0),
(2043, '宜都市', '0', 298, 0, '', 1, 0, '', '', 0),
(2044, '当阳市', '0', 298, 0, '', 1, 0, '', '', 0),
(2045, '枝江市', '0', 298, 0, '', 1, 0, '', '', 0),
(2046, '襄城区', '0', 299, 0, '', 1, 0, '', '', 0),
(2047, '樊城区', '0', 299, 0, '', 1, 0, '', '', 0),
(2048, '襄阳区', '0', 299, 0, '', 1, 0, '', '', 0),
(2049, '南漳县', '0', 299, 0, '', 1, 0, '', '', 0),
(2050, '谷城县', '0', 299, 0, '', 1, 0, '', '', 0),
(2051, '保康县', '0', 299, 0, '', 1, 0, '', '', 0),
(2052, '老河口市', '0', 299, 0, '', 1, 0, '', '', 0),
(2053, '枣阳市', '0', 299, 0, '', 1, 0, '', '', 0),
(2054, '宜城市', '0', 299, 0, '', 1, 0, '', '', 0),
(2055, '梁子湖区', '0', 300, 0, '', 1, 0, '', '', 0),
(2056, '华容区', '0', 300, 0, '', 1, 0, '', '', 0),
(2057, '鄂城区', '0', 300, 0, '', 1, 0, '', '', 0),
(2058, '东宝区', '0', 301, 0, '', 1, 0, '', '', 0),
(2059, '掇刀区', '0', 301, 0, '', 1, 0, '', '', 0),
(2060, '京山县', '0', 301, 0, '', 1, 0, '', '', 0),
(2061, '沙洋县', '0', 301, 0, '', 1, 0, '', '', 0),
(2062, '钟祥市', '0', 301, 0, '', 1, 0, '', '', 0),
(2063, '孝南区', '0', 302, 0, '', 1, 0, '', '', 0),
(2064, '孝昌县', '0', 302, 0, '', 1, 0, '', '', 0),
(2065, '大悟县', '0', 302, 0, '', 1, 0, '', '', 0),
(2066, '云梦县', '0', 302, 0, '', 1, 0, '', '', 0),
(2067, '应城市', '0', 302, 0, '', 1, 0, '', '', 0),
(2068, '安陆市', '0', 302, 0, '', 1, 0, '', '', 0),
(2069, '汉川市', '0', 302, 0, '', 1, 0, '', '', 0),
(2070, '沙市区', '0', 303, 0, '', 1, 0, '', '', 0),
(2071, '荆州区', '0', 303, 0, '', 1, 0, '', '', 0),
(2072, '公安县', '0', 303, 0, '', 1, 0, '', '', 0),
(2073, '监利县', '0', 303, 0, '', 1, 0, '', '', 0),
(2074, '江陵县', '0', 303, 0, '', 1, 0, '', '', 0),
(2075, '石首市', '0', 303, 0, '', 1, 0, '', '', 0),
(2076, '洪湖市', '0', 303, 0, '', 1, 0, '', '', 0),
(2077, '松滋市', '0', 303, 0, '', 1, 0, '', '', 0),
(2078, '黄州区', '0', 304, 0, '', 1, 0, '', '', 0),
(2079, '团风县', '0', 304, 0, '', 1, 0, '', '', 0),
(2080, '红安县', '0', 304, 0, '', 1, 0, '', '', 0),
(2081, '罗田县', '0', 304, 0, '', 1, 0, '', '', 0),
(2082, '英山县', '0', 304, 0, '', 1, 0, '', '', 0),
(2083, '浠水县', '0', 304, 0, '', 1, 0, '', '', 0),
(2084, '蕲春县', '0', 304, 0, '', 1, 0, '', '', 0),
(2085, '黄梅县', '0', 304, 0, '', 1, 0, '', '', 0),
(2086, '麻城市', '0', 304, 0, '', 1, 0, '', '', 0),
(2087, '武穴市', '0', 304, 0, '', 1, 0, '', '', 0),
(2088, '咸安区', '0', 305, 0, '', 1, 0, '', '', 0),
(2089, '嘉鱼县', '0', 305, 0, '', 1, 0, '', '', 0),
(2090, '通城县', '0', 305, 0, '', 1, 0, '', '', 0),
(2091, '崇阳县', '0', 305, 0, '', 1, 0, '', '', 0),
(2092, '通山县', '0', 305, 0, '', 1, 0, '', '', 0),
(2093, '赤壁市', '0', 305, 0, '', 1, 0, '', '', 0),
(2094, '曾都区', '0', 306, 0, '', 1, 0, '', '', 0),
(2095, '广水市', '0', 306, 0, '', 1, 0, '', '', 0),
(2096, '恩施市', '0', 307, 0, '', 1, 0, '', '', 0),
(2097, '利川市', '0', 307, 0, '', 1, 0, '', '', 0),
(2098, '建始县', '0', 307, 0, '', 1, 0, '', '', 0),
(2099, '巴东县', '0', 307, 0, '', 1, 0, '', '', 0),
(2100, '宣恩县', '0', 307, 0, '', 1, 0, '', '', 0),
(2101, '咸丰县', '0', 307, 0, '', 1, 0, '', '', 0),
(2102, '来凤县', '0', 307, 0, '', 1, 0, '', '', 0),
(2103, '鹤峰县', '0', 307, 0, '', 1, 0, '', '', 0),
(2104, '芙蓉区', '0', 312, 0, '', 1, 0, '', '', 0),
(2105, '天心区', '0', 312, 0, '', 1, 0, '', '', 0),
(2106, '岳麓区', '0', 312, 0, '', 1, 0, '', '', 0),
(2107, '开福区', '0', 312, 0, '', 1, 0, '', '', 0),
(2108, '雨花区', '0', 312, 0, '', 1, 0, '', '', 0),
(2109, '长沙县', '0', 312, 0, '', 1, 0, '', '', 0),
(2110, '望城县', '0', 312, 0, '', 1, 0, '', '', 0),
(2111, '宁乡县', '0', 312, 0, '', 1, 0, '', '', 0),
(2112, '浏阳市', '0', 312, 0, '', 1, 0, '', '', 0),
(2113, '荷塘区', '0', 313, 0, '', 1, 0, '', '', 0),
(2114, '芦淞区', '0', 313, 0, '', 1, 0, '', '', 0),
(2115, '石峰区', '0', 313, 0, '', 1, 0, '', '', 0),
(2116, '天元区', '0', 313, 0, '', 1, 0, '', '', 0),
(2117, '株洲县', '0', 313, 0, '', 1, 0, '', '', 0),
(2118, '攸县', '0', 313, 0, '', 1, 0, '', '', 0),
(2119, '茶陵县', '0', 313, 0, '', 1, 0, '', '', 0),
(2120, '炎陵县', '0', 313, 0, '', 1, 0, '', '', 0),
(2121, '醴陵市', '0', 313, 0, '', 1, 0, '', '', 0),
(2122, '雨湖区', '0', 314, 0, '', 1, 0, '', '', 0),
(2123, '岳塘区', '0', 314, 0, '', 1, 0, '', '', 0),
(2124, '湘潭县', '0', 314, 0, '', 1, 0, '', '', 0),
(2125, '湘乡市', '0', 314, 0, '', 1, 0, '', '', 0),
(2126, '韶山市', '0', 314, 0, '', 1, 0, '', '', 0),
(2127, '珠晖区', '0', 315, 0, '', 1, 0, '', '', 0),
(2128, '雁峰区', '0', 315, 0, '', 1, 0, '', '', 0),
(2129, '石鼓区', '0', 315, 0, '', 1, 0, '', '', 0),
(2130, '蒸湘区', '0', 315, 0, '', 1, 0, '', '', 0),
(2131, '南岳区', '0', 315, 0, '', 1, 0, '', '', 0),
(2132, '衡阳县', '0', 315, 0, '', 1, 0, '', '', 0),
(2133, '衡南县', '0', 315, 0, '', 1, 0, '', '', 0),
(2134, '衡山县', '0', 315, 0, '', 1, 0, '', '', 0),
(2135, '衡东县', '0', 315, 0, '', 1, 0, '', '', 0),
(2136, '祁东县', '0', 315, 0, '', 1, 0, '', '', 0),
(2137, '耒阳市', '0', 315, 0, '', 1, 0, '', '', 0),
(2138, '常宁市', '0', 315, 0, '', 1, 0, '', '', 0),
(2139, '双清区', '0', 316, 0, '', 1, 0, '', '', 0),
(2140, '大祥区', '0', 316, 0, '', 1, 0, '', '', 0),
(2141, '北塔区', '0', 316, 0, '', 1, 0, '', '', 0),
(2142, '邵东县', '0', 316, 0, '', 1, 0, '', '', 0),
(2143, '新邵县', '0', 316, 0, '', 1, 0, '', '', 0),
(2144, '邵阳县', '0', 316, 0, '', 1, 0, '', '', 0),
(2145, '隆回县', '0', 316, 0, '', 1, 0, '', '', 0),
(2146, '洞口县', '0', 316, 0, '', 1, 0, '', '', 0),
(2147, '绥宁县', '0', 316, 0, '', 1, 0, '', '', 0),
(2148, '新宁县', '0', 316, 0, '', 1, 0, '', '', 0),
(2149, '城步苗族自治县', '0', 316, 0, '', 1, 0, '', '', 0),
(2150, '武冈市', '0', 316, 0, '', 1, 0, '', '', 0),
(2151, '岳阳楼区', '0', 317, 0, '', 1, 0, '', '', 0),
(2152, '云溪区', '0', 317, 0, '', 1, 0, '', '', 0),
(2153, '君山区', '0', 317, 0, '', 1, 0, '', '', 0),
(2154, '岳阳县', '0', 317, 0, '', 1, 0, '', '', 0),
(2155, '华容县', '0', 317, 0, '', 1, 0, '', '', 0),
(2156, '湘阴县', '0', 317, 0, '', 1, 0, '', '', 0),
(2157, '平江县', '0', 317, 0, '', 1, 0, '', '', 0),
(2158, '汨罗市', '0', 317, 0, '', 1, 0, '', '', 0),
(2159, '临湘市', '0', 317, 0, '', 1, 0, '', '', 0),
(2160, '武陵区', '0', 318, 0, '', 1, 0, '', '', 0),
(2161, '鼎城区', '0', 318, 0, '', 1, 0, '', '', 0),
(2162, '安乡县', '0', 318, 0, '', 1, 0, '', '', 0),
(2163, '汉寿县', '0', 318, 0, '', 1, 0, '', '', 0),
(2164, '澧县', '0', 318, 0, '', 1, 0, '', '', 0),
(2165, '临澧县', '0', 318, 0, '', 1, 0, '', '', 0),
(2166, '桃源县', '0', 318, 0, '', 1, 0, '', '', 0),
(2167, '石门县', '0', 318, 0, '', 1, 0, '', '', 0),
(2168, '津市市', '0', 318, 0, '', 1, 0, '', '', 0),
(2169, '永定区', '0', 319, 0, '', 1, 0, '', '', 0),
(2170, '武陵源区', '0', 319, 0, '', 1, 0, '', '', 0),
(2171, '慈利县', '0', 319, 0, '', 1, 0, '', '', 0),
(2172, '桑植县', '0', 319, 0, '', 1, 0, '', '', 0),
(2173, '资阳区', '0', 320, 0, '', 1, 0, '', '', 0),
(2174, '赫山区', '0', 320, 0, '', 1, 0, '', '', 0),
(2175, '南县', '0', 320, 0, '', 1, 0, '', '', 0),
(2176, '桃江县', '0', 320, 0, '', 1, 0, '', '', 0),
(2177, '安化县', '0', 320, 0, '', 1, 0, '', '', 0),
(2178, '沅江市', '0', 320, 0, '', 1, 0, '', '', 0),
(2179, '北湖区', '0', 321, 0, '', 1, 0, '', '', 0),
(2180, '苏仙区', '0', 321, 0, '', 1, 0, '', '', 0),
(2181, '桂阳县', '0', 321, 0, '', 1, 0, '', '', 0),
(2182, '宜章县', '0', 321, 0, '', 1, 0, '', '', 0),
(2183, '永兴县', '0', 321, 0, '', 1, 0, '', '', 0),
(2184, '嘉禾县', '0', 321, 0, '', 1, 0, '', '', 0),
(2185, '临武县', '0', 321, 0, '', 1, 0, '', '', 0),
(2186, '汝城县', '0', 321, 0, '', 1, 0, '', '', 0),
(2187, '桂东县', '0', 321, 0, '', 1, 0, '', '', 0),
(2188, '安仁县', '0', 321, 0, '', 1, 0, '', '', 0),
(2189, '资兴市', '0', 321, 0, '', 1, 0, '', '', 0),
(2190, '零陵区', '0', 322, 0, '', 1, 0, '', '', 0),
(2191, '冷水滩区', '0', 322, 0, '', 1, 0, '', '', 0),
(2192, '祁阳县', '0', 322, 0, '', 1, 0, '', '', 0),
(2193, '东安县', '0', 322, 0, '', 1, 0, '', '', 0),
(2194, '双牌县', '0', 322, 0, '', 1, 0, '', '', 0),
(2195, '道县', '0', 322, 0, '', 1, 0, '', '', 0),
(2196, '江永县', '0', 322, 0, '', 1, 0, '', '', 0),
(2197, '宁远县', '0', 322, 0, '', 1, 0, '', '', 0),
(2198, '蓝山县', '0', 322, 0, '', 1, 0, '', '', 0),
(2199, '新田县', '0', 322, 0, '', 1, 0, '', '', 0),
(2200, '江华瑶族自治县', '0', 322, 0, '', 1, 0, '', '', 0),
(2201, '鹤城区', '0', 323, 0, '', 1, 0, '', '', 0),
(2202, '中方县', '0', 323, 0, '', 1, 0, '', '', 0),
(2203, '沅陵县', '0', 323, 0, '', 1, 0, '', '', 0),
(2204, '辰溪县', '0', 323, 0, '', 1, 0, '', '', 0),
(2205, '溆浦县', '0', 323, 0, '', 1, 0, '', '', 0),
(2206, '会同县', '0', 323, 0, '', 1, 0, '', '', 0),
(2207, '麻阳苗族自治县', '0', 323, 0, '', 1, 0, '', '', 0),
(2208, '新晃侗族自治县', '0', 323, 0, '', 1, 0, '', '', 0),
(2209, '芷江侗族自治县', '0', 323, 0, '', 1, 0, '', '', 0),
(2210, '靖州苗族侗族自治县', '0', 323, 0, '', 1, 0, '', '', 0),
(2211, '通道侗族自治县', '0', 323, 0, '', 1, 0, '', '', 0),
(2212, '洪江市', '0', 323, 0, '', 1, 0, '', '', 0),
(2213, '娄星区', '0', 324, 0, '', 1, 0, '', '', 0),
(2214, '双峰县', '0', 324, 0, '', 1, 0, '', '', 0),
(2215, '新化县', '0', 324, 0, '', 1, 0, '', '', 0),
(2216, '冷水江市', '0', 324, 0, '', 1, 0, '', '', 0),
(2217, '涟源市', '0', 324, 0, '', 1, 0, '', '', 0),
(2218, '吉首市', '0', 325, 0, '', 1, 0, '', '', 0),
(2219, '泸溪县', '0', 325, 0, '', 1, 0, '', '', 0),
(2220, '凤凰县', '0', 325, 0, '', 1, 0, '', '', 0),
(2221, '花垣县', '0', 325, 0, '', 1, 0, '', '', 0),
(2222, '保靖县', '0', 325, 0, '', 1, 0, '', '', 0),
(2223, '古丈县', '0', 325, 0, '', 1, 0, '', '', 0),
(2224, '永顺县', '0', 325, 0, '', 1, 0, '', '', 0),
(2225, '龙山县', '0', 325, 0, '', 1, 0, '', '', 0),
(2226, '荔湾区', '0', 326, 0, '', 1, 0, '', '', 0),
(2227, '越秀区', '0', 326, 0, '', 1, 0, '', '', 0),
(2228, '海珠区', '0', 326, 0, '', 1, 0, '', '', 0),
(2229, '天河区', '0', 326, 0, '', 1, 0, '', '', 0),
(2230, '白云区', '0', 326, 0, '', 1, 0, '', '', 0),
(2231, '黄埔区', '0', 326, 0, '', 1, 0, '', '', 0),
(2232, '番禺区', '0', 326, 0, '', 1, 0, '', '', 0),
(2233, '花都区', '0', 326, 0, '', 1, 0, '', '', 0),
(2234, '南沙区', '0', 326, 0, '', 1, 0, '', '', 0),
(2235, '萝岗区', '0', 326, 0, '', 1, 0, '', '', 0),
(2236, '增城市', '0', 326, 0, '', 1, 0, '', '', 0),
(2237, '从化市', '0', 326, 0, '', 1, 0, '', '', 0),
(2238, '武江区', '0', 327, 0, '', 1, 0, '', '', 0),
(2239, '浈江区', '0', 327, 0, '', 1, 0, '', '', 0),
(2240, '曲江区', '0', 327, 0, '', 1, 0, '', '', 0),
(2241, '始兴县', '0', 327, 0, '', 1, 0, '', '', 0),
(2242, '仁化县', '0', 327, 0, '', 1, 0, '', '', 0),
(2243, '翁源县', '0', 327, 0, '', 1, 0, '', '', 0),
(2244, '乳源瑶族自治县', '0', 327, 0, '', 1, 0, '', '', 0),
(2245, '新丰县', '0', 327, 0, '', 1, 0, '', '', 0),
(2246, '乐昌市', '0', 327, 0, '', 1, 0, '', '', 0),
(2247, '南雄市', '0', 327, 0, '', 1, 0, '', '', 0),
(2248, '罗湖区', '0', 328, 0, '', 1, 0, '', '', 0),
(2249, '福田区', '0', 328, 0, '', 1, 0, '', '', 0),
(2250, '南山区', '0', 328, 0, '', 1, 0, '', '', 0),
(2251, '宝安区', '0', 328, 0, '', 1, 0, '', '', 0),
(2252, '龙岗区', '0', 328, 0, '', 1, 0, '', '', 0),
(2253, '盐田区', '0', 328, 0, '', 1, 0, '', '', 0),
(2254, '香洲区', '0', 329, 0, '', 1, 0, '', '', 0),
(2255, '斗门区', '0', 329, 0, '', 1, 0, '', '', 0),
(2256, '金湾区', '0', 329, 0, '', 1, 0, '', '', 0),
(2257, '龙湖区', '0', 330, 0, '', 1, 0, '', '', 0),
(2258, '金平区', '0', 330, 0, '', 1, 0, '', '', 0),
(2259, '濠江区', '0', 330, 0, '', 1, 0, '', '', 0),
(2260, '潮阳区', '0', 330, 0, '', 1, 0, '', '', 0),
(2261, '潮南区', '0', 330, 0, '', 1, 0, '', '', 0),
(2262, '澄海区', '0', 330, 0, '', 1, 0, '', '', 0),
(2263, '南澳县', '0', 330, 0, '', 1, 0, '', '', 0),
(2264, '禅城区', '0', 331, 0, '', 1, 0, '', '', 0),
(2265, '南海区', '0', 331, 0, '', 1, 0, '', '', 0),
(2266, '顺德区', '0', 331, 0, '', 1, 0, '', '', 0),
(2267, '三水区', '0', 331, 0, '', 1, 0, '', '', 0),
(2268, '高明区', '0', 331, 0, '', 1, 0, '', '', 0),
(2269, '蓬江区', '0', 332, 0, '', 1, 0, '', '', 0),
(2270, '江海区', '0', 332, 0, '', 1, 0, '', '', 0),
(2271, '新会区', '0', 332, 0, '', 1, 0, '', '', 0),
(2272, '台山市', '0', 332, 0, '', 1, 0, '', '', 0),
(2273, '开平市', '0', 332, 0, '', 1, 0, '', '', 0),
(2274, '鹤山市', '0', 332, 0, '', 1, 0, '', '', 0),
(2275, '恩平市', '0', 332, 0, '', 1, 0, '', '', 0),
(2276, '赤坎区', '0', 333, 0, '', 1, 0, '', '', 0),
(2277, '霞山区', '0', 333, 0, '', 1, 0, '', '', 0),
(2278, '坡头区', '0', 333, 0, '', 1, 0, '', '', 0),
(2279, '麻章区', '0', 333, 0, '', 1, 0, '', '', 0),
(2280, '遂溪县', '0', 333, 0, '', 1, 0, '', '', 0),
(2281, '徐闻县', '0', 333, 0, '', 1, 0, '', '', 0),
(2282, '廉江市', '0', 333, 0, '', 1, 0, '', '', 0),
(2283, '雷州市', '0', 333, 0, '', 1, 0, '', '', 0),
(2284, '吴川市', '0', 333, 0, '', 1, 0, '', '', 0),
(2285, '茂南区', '0', 334, 0, '', 1, 0, '', '', 0),
(2286, '茂港区', '0', 334, 0, '', 1, 0, '', '', 0),
(2287, '电白县', '0', 334, 0, '', 1, 0, '', '', 0),
(2288, '高州市', '0', 334, 0, '', 1, 0, '', '', 0),
(2289, '化州市', '0', 334, 0, '', 1, 0, '', '', 0),
(2290, '信宜市', '0', 334, 0, '', 1, 0, '', '', 0),
(2291, '端州区', '0', 335, 0, '', 1, 0, '', '', 0),
(2292, '鼎湖区', '0', 335, 0, '', 1, 0, '', '', 0),
(2293, '广宁县', '0', 335, 0, '', 1, 0, '', '', 0),
(2294, '怀集县', '0', 335, 0, '', 1, 0, '', '', 0),
(2295, '封开县', '0', 335, 0, '', 1, 0, '', '', 0),
(2296, '德庆县', '0', 335, 0, '', 1, 0, '', '', 0),
(2297, '高要市', '0', 335, 0, '', 1, 0, '', '', 0),
(2298, '四会市', '0', 335, 0, '', 1, 0, '', '', 0),
(2299, '惠城区', '0', 336, 0, '', 1, 0, '', '', 0),
(2300, '惠阳区', '0', 336, 0, '', 1, 0, '', '', 0),
(2301, '博罗县', '0', 336, 0, '', 1, 0, '', '', 0),
(2302, '惠东县', '0', 336, 0, '', 1, 0, '', '', 0),
(2303, '龙门县', '0', 336, 0, '', 1, 0, '', '', 0),
(2304, '梅江区', '0', 337, 0, '', 1, 0, '', '', 0),
(2305, '梅县', '0', 337, 0, '', 1, 0, '', '', 0),
(2306, '大埔县', '0', 337, 0, '', 1, 0, '', '', 0),
(2307, '丰顺县', '0', 337, 0, '', 1, 0, '', '', 0),
(2308, '五华县', '0', 337, 0, '', 1, 0, '', '', 0),
(2309, '平远县', '0', 337, 0, '', 1, 0, '', '', 0),
(2310, '蕉岭县', '0', 337, 0, '', 1, 0, '', '', 0),
(2311, '兴宁市', '0', 337, 0, '', 1, 0, '', '', 0),
(2312, '城区', '0', 338, 0, '', 1, 0, '', '', 0),
(2313, '海丰县', '0', 338, 0, '', 1, 0, '', '', 0),
(2314, '陆河县', '0', 338, 0, '', 1, 0, '', '', 0),
(2315, '陆丰市', '0', 338, 0, '', 1, 0, '', '', 0),
(2316, '源城区', '0', 339, 0, '', 1, 0, '', '', 0),
(2317, '紫金县', '0', 339, 0, '', 1, 0, '', '', 0),
(2318, '龙川县', '0', 339, 0, '', 1, 0, '', '', 0),
(2319, '连平县', '0', 339, 0, '', 1, 0, '', '', 0),
(2320, '和平县', '0', 339, 0, '', 1, 0, '', '', 0),
(2321, '东源县', '0', 339, 0, '', 1, 0, '', '', 0),
(2322, '江城区', '0', 340, 0, '', 1, 0, '', '', 0),
(2323, '阳西县', '0', 340, 0, '', 1, 0, '', '', 0),
(2324, '阳东县', '0', 340, 0, '', 1, 0, '', '', 0),
(2325, '阳春市', '0', 340, 0, '', 1, 0, '', '', 0),
(2326, '清城区', '0', 341, 0, '', 1, 0, '', '', 0),
(2327, '佛冈县', '0', 341, 0, '', 1, 0, '', '', 0),
(2328, '阳山县', '0', 341, 0, '', 1, 0, '', '', 0),
(2329, '连山壮族瑶族自治县', '0', 341, 0, '', 1, 0, '', '', 0),
(2330, '连南瑶族自治县', '0', 341, 0, '', 1, 0, '', '', 0),
(2331, '清新县', '0', 341, 0, '', 1, 0, '', '', 0),
(2332, '英德市', '0', 341, 0, '', 1, 0, '', '', 0),
(2333, '连州市', '0', 341, 0, '', 1, 0, '', '', 0),
(2334, '湘桥区', '0', 344, 0, '', 1, 0, '', '', 0),
(2335, '潮安县', '0', 344, 0, '', 1, 0, '', '', 0),
(2336, '饶平县', '0', 344, 0, '', 1, 0, '', '', 0),
(2337, '榕城区', '0', 345, 0, '', 1, 0, '', '', 0),
(2338, '揭东县', '0', 345, 0, '', 1, 0, '', '', 0),
(2339, '揭西县', '0', 345, 0, '', 1, 0, '', '', 0),
(2340, '惠来县', '0', 345, 0, '', 1, 0, '', '', 0),
(2341, '普宁市', '0', 345, 0, '', 1, 0, '', '', 0),
(2342, '云城区', '0', 346, 0, '', 1, 0, '', '', 0),
(2343, '新兴县', '0', 346, 0, '', 1, 0, '', '', 0),
(2344, '郁南县', '0', 346, 0, '', 1, 0, '', '', 0),
(2345, '云安县', '0', 346, 0, '', 1, 0, '', '', 0),
(2346, '罗定市', '0', 346, 0, '', 1, 0, '', '', 0),
(2347, '兴宁区', '0', 347, 0, '', 1, 0, '', '', 0),
(2348, '青秀区', '0', 347, 0, '', 1, 0, '', '', 0),
(2349, '江南区', '0', 347, 0, '', 1, 0, '', '', 0),
(2350, '西乡塘区', '0', 347, 0, '', 1, 0, '', '', 0),
(2351, '良庆区', '0', 347, 0, '', 1, 0, '', '', 0),
(2352, '邕宁区', '0', 347, 0, '', 1, 0, '', '', 0),
(2353, '武鸣县', '0', 347, 0, '', 1, 0, '', '', 0),
(2354, '隆安县', '0', 347, 0, '', 1, 0, '', '', 0),
(2355, '马山县', '0', 347, 0, '', 1, 0, '', '', 0),
(2356, '上林县', '0', 347, 0, '', 1, 0, '', '', 0),
(2357, '宾阳县', '0', 347, 0, '', 1, 0, '', '', 0),
(2358, '横县', '0', 347, 0, '', 1, 0, '', '', 0),
(2359, '城中区', '0', 348, 0, '', 1, 0, '', '', 0),
(2360, '鱼峰区', '0', 348, 0, '', 1, 0, '', '', 0),
(2361, '柳南区', '0', 348, 0, '', 1, 0, '', '', 0),
(2362, '柳北区', '0', 348, 0, '', 1, 0, '', '', 0),
(2363, '柳江县', '0', 348, 0, '', 1, 0, '', '', 0),
(2364, '柳城县', '0', 348, 0, '', 1, 0, '', '', 0),
(2365, '鹿寨县', '0', 348, 0, '', 1, 0, '', '', 0),
(2366, '融安县', '0', 348, 0, '', 1, 0, '', '', 0),
(2367, '融水苗族自治县', '0', 348, 0, '', 1, 0, '', '', 0),
(2368, '三江侗族自治县', '0', 348, 0, '', 1, 0, '', '', 0),
(2369, '秀峰区', '0', 349, 0, '', 1, 0, '', '', 0),
(2370, '叠彩区', '0', 349, 0, '', 1, 0, '', '', 0),
(2371, '象山区', '0', 349, 0, '', 1, 0, '', '', 0),
(2372, '七星区', '0', 349, 0, '', 1, 0, '', '', 0),
(2373, '雁山区', '0', 349, 0, '', 1, 0, '', '', 0),
(2374, '阳朔县', '0', 349, 0, '', 1, 0, '', '', 0),
(2375, '临桂县', '0', 349, 0, '', 1, 0, '', '', 0),
(2376, '灵川县', '0', 349, 0, '', 1, 0, '', '', 0),
(2377, '全州县', '0', 349, 0, '', 1, 0, '', '', 0),
(2378, '兴安县', '0', 349, 0, '', 1, 0, '', '', 0),
(2379, '永福县', '0', 349, 0, '', 1, 0, '', '', 0),
(2380, '灌阳县', '0', 349, 0, '', 1, 0, '', '', 0),
(2381, '龙胜各族自治县', '0', 349, 0, '', 1, 0, '', '', 0),
(2382, '资源县', '0', 349, 0, '', 1, 0, '', '', 0),
(2383, '平乐县', '0', 349, 0, '', 1, 0, '', '', 0),
(2384, '荔蒲县', '0', 349, 0, '', 1, 0, '', '', 0),
(2385, '恭城瑶族自治县', '0', 349, 0, '', 1, 0, '', '', 0),
(2386, '万秀区', '0', 350, 0, '', 1, 0, '', '', 0),
(2387, '蝶山区', '0', 350, 0, '', 1, 0, '', '', 0),
(2388, '长洲区', '0', 350, 0, '', 1, 0, '', '', 0),
(2389, '苍梧县', '0', 350, 0, '', 1, 0, '', '', 0),
(2390, '藤县', '0', 350, 0, '', 1, 0, '', '', 0),
(2391, '蒙山县', '0', 350, 0, '', 1, 0, '', '', 0),
(2392, '岑溪市', '0', 350, 0, '', 1, 0, '', '', 0),
(2393, '海城区', '0', 351, 0, '', 1, 0, '', '', 0),
(2394, '银海区', '0', 351, 0, '', 1, 0, '', '', 0),
(2395, '铁山港区', '0', 351, 0, '', 1, 0, '', '', 0),
(2396, '合浦县', '0', 351, 0, '', 1, 0, '', '', 0),
(2397, '港口区', '0', 352, 0, '', 1, 0, '', '', 0),
(2398, '防城区', '0', 352, 0, '', 1, 0, '', '', 0),
(2399, '上思县', '0', 352, 0, '', 1, 0, '', '', 0),
(2400, '东兴市', '0', 352, 0, '', 1, 0, '', '', 0),
(2401, '钦南区', '0', 353, 0, '', 1, 0, '', '', 0),
(2402, '钦北区', '0', 353, 0, '', 1, 0, '', '', 0),
(2403, '灵山县', '0', 353, 0, '', 1, 0, '', '', 0),
(2404, '浦北县', '0', 353, 0, '', 1, 0, '', '', 0),
(2405, '港北区', '0', 354, 0, '', 1, 0, '', '', 0),
(2406, '港南区', '0', 354, 0, '', 1, 0, '', '', 0),
(2407, '覃塘区', '0', 354, 0, '', 1, 0, '', '', 0),
(2408, '平南县', '0', 354, 0, '', 1, 0, '', '', 0),
(2409, '桂平市', '0', 354, 0, '', 1, 0, '', '', 0),
(2410, '玉州区', '0', 355, 0, '', 1, 0, '', '', 0),
(2411, '容县', '0', 355, 0, '', 1, 0, '', '', 0),
(2412, '陆川县', '0', 355, 0, '', 1, 0, '', '', 0),
(2413, '博白县', '0', 355, 0, '', 1, 0, '', '', 0),
(2414, '兴业县', '0', 355, 0, '', 1, 0, '', '', 0),
(2415, '北流市', '0', 355, 0, '', 1, 0, '', '', 0),
(2416, '右江区', '0', 356, 0, '', 1, 0, '', '', 0),
(2417, '田阳县', '0', 356, 0, '', 1, 0, '', '', 0),
(2418, '田东县', '0', 356, 0, '', 1, 0, '', '', 0),
(2419, '平果县', '0', 356, 0, '', 1, 0, '', '', 0),
(2420, '德保县', '0', 356, 0, '', 1, 0, '', '', 0),
(2421, '靖西县', '0', 356, 0, '', 1, 0, '', '', 0),
(2422, '那坡县', '0', 356, 0, '', 1, 0, '', '', 0),
(2423, '凌云县', '0', 356, 0, '', 1, 0, '', '', 0),
(2424, '乐业县', '0', 356, 0, '', 1, 0, '', '', 0),
(2425, '田林县', '0', 356, 0, '', 1, 0, '', '', 0),
(2426, '西林县', '0', 356, 0, '', 1, 0, '', '', 0),
(2427, '隆林各族自治县', '0', 356, 0, '', 1, 0, '', '', 0),
(2428, '八步区', '0', 357, 0, '', 1, 0, '', '', 0),
(2429, '昭平县', '0', 357, 0, '', 1, 0, '', '', 0),
(2430, '钟山县', '0', 357, 0, '', 1, 0, '', '', 0),
(2431, '富川瑶族自治县', '0', 357, 0, '', 1, 0, '', '', 0),
(2432, '金城江区', '0', 358, 0, '', 1, 0, '', '', 0),
(2433, '南丹县', '0', 358, 0, '', 1, 0, '', '', 0),
(2434, '天峨县', '0', 358, 0, '', 1, 0, '', '', 0),
(2435, '凤山县', '0', 358, 0, '', 1, 0, '', '', 0),
(2436, '东兰县', '0', 358, 0, '', 1, 0, '', '', 0),
(2437, '罗城仫佬族自治县', '0', 358, 0, '', 1, 0, '', '', 0),
(2438, '环江毛南族自治县', '0', 358, 0, '', 1, 0, '', '', 0),
(2439, '巴马瑶族自治县', '0', 358, 0, '', 1, 0, '', '', 0),
(2440, '都安瑶族自治县', '0', 358, 0, '', 1, 0, '', '', 0),
(2441, '大化瑶族自治县', '0', 358, 0, '', 1, 0, '', '', 0),
(2442, '宜州市', '0', 358, 0, '', 1, 0, '', '', 0),
(2443, '兴宾区', '0', 359, 0, '', 1, 0, '', '', 0),
(2444, '忻城县', '0', 359, 0, '', 1, 0, '', '', 0),
(2445, '象州县', '0', 359, 0, '', 1, 0, '', '', 0),
(2446, '武宣县', '0', 359, 0, '', 1, 0, '', '', 0),
(2447, '金秀瑶族自治县', '0', 359, 0, '', 1, 0, '', '', 0),
(2448, '合山市', '0', 359, 0, '', 1, 0, '', '', 0),
(2449, '江洲区', '0', 360, 0, '', 1, 0, '', '', 0),
(2450, '扶绥县', '0', 360, 0, '', 1, 0, '', '', 0),
(2451, '宁明县', '0', 360, 0, '', 1, 0, '', '', 0),
(2452, '龙州县', '0', 360, 0, '', 1, 0, '', '', 0),
(2453, '大新县', '0', 360, 0, '', 1, 0, '', '', 0),
(2454, '天等县', '0', 360, 0, '', 1, 0, '', '', 0),
(2455, '凭祥市', '0', 360, 0, '', 1, 0, '', '', 0),
(2456, '秀英区', '0', 361, 0, '', 1, 0, '', '', 0),
(2457, '龙华区', '0', 361, 0, '', 1, 0, '', '', 0),
(2458, '琼山区', '0', 361, 0, '', 1, 0, '', '', 0),
(2459, '美兰区', '0', 361, 0, '', 1, 0, '', '', 0),
(2460, '锦江区', '0', 382, 0, '', 1, 0, '', '', 0),
(2461, '青羊区', '0', 382, 0, '', 1, 0, '', '', 0),
(2462, '金牛区', '0', 382, 0, '', 1, 0, '', '', 0),
(2463, '武侯区', '0', 382, 0, '', 1, 0, '', '', 0),
(2464, '成华区', '0', 382, 0, '', 1, 0, '', '', 0),
(2465, '龙泉驿区', '0', 382, 0, '', 1, 0, '', '', 0),
(2466, '青白江区', '0', 382, 0, '', 1, 0, '', '', 0),
(2467, '新都区', '0', 382, 0, '', 1, 0, '', '', 0),
(2468, '温江区', '0', 382, 0, '', 1, 0, '', '', 0),
(2469, '金堂县', '0', 382, 0, '', 1, 0, '', '', 0),
(2470, '双流县', '0', 382, 0, '', 1, 0, '', '', 0),
(2471, '郫县', '0', 382, 0, '', 1, 0, '', '', 0),
(2472, '大邑县', '0', 382, 0, '', 1, 0, '', '', 0),
(2473, '蒲江县', '0', 382, 0, '', 1, 0, '', '', 0),
(2474, '新津县', '0', 382, 0, '', 1, 0, '', '', 0),
(2475, '都江堰市', '0', 382, 0, '', 1, 0, '', '', 0),
(2476, '彭州市', '0', 382, 0, '', 1, 0, '', '', 0),
(2477, '邛崃市', '0', 382, 0, '', 1, 0, '', '', 0),
(2478, '崇州市', '0', 382, 0, '', 1, 0, '', '', 0),
(2479, '自流井区', '0', 383, 0, '', 1, 0, '', '', 0),
(2480, '贡井区', '0', 383, 0, '', 1, 0, '', '', 0),
(2481, '大安区', '0', 383, 0, '', 1, 0, '', '', 0),
(2482, '沿滩区', '0', 383, 0, '', 1, 0, '', '', 0),
(2483, '荣县', '0', 383, 0, '', 1, 0, '', '', 0),
(2484, '富顺县', '0', 383, 0, '', 1, 0, '', '', 0),
(2485, '东区', '0', 384, 0, '', 1, 0, '', '', 0),
(2486, '西区', '0', 384, 0, '', 1, 0, '', '', 0),
(2487, '仁和区', '0', 384, 0, '', 1, 0, '', '', 0),
(2488, '米易县', '0', 384, 0, '', 1, 0, '', '', 0),
(2489, '盐边县', '0', 384, 0, '', 1, 0, '', '', 0),
(2490, '江阳区', '0', 385, 0, '', 1, 0, '', '', 0),
(2491, '纳溪区', '0', 385, 0, '', 1, 0, '', '', 0),
(2492, '龙马潭区', '0', 385, 0, '', 1, 0, '', '', 0),
(2493, '泸县', '0', 385, 0, '', 1, 0, '', '', 0),
(2494, '合江县', '0', 385, 0, '', 1, 0, '', '', 0),
(2495, '叙永县', '0', 385, 0, '', 1, 0, '', '', 0),
(2496, '古蔺县', '0', 385, 0, '', 1, 0, '', '', 0),
(2497, '旌阳区', '0', 386, 0, '', 1, 0, '', '', 0),
(2498, '中江县', '0', 386, 0, '', 1, 0, '', '', 0),
(2499, '罗江县', '0', 386, 0, '', 1, 0, '', '', 0),
(2500, '广汉市', '0', 386, 0, '', 1, 0, '', '', 0),
(2501, '什邡市', '0', 386, 0, '', 1, 0, '', '', 0),
(2502, '绵竹市', '0', 386, 0, '', 1, 0, '', '', 0),
(2503, '涪城区', '0', 387, 0, '', 1, 0, '', '', 0),
(2504, '游仙区', '0', 387, 0, '', 1, 0, '', '', 0),
(2505, '三台县', '0', 387, 0, '', 1, 0, '', '', 0),
(2506, '盐亭县', '0', 387, 0, '', 1, 0, '', '', 0),
(2507, '安县', '0', 387, 0, '', 1, 0, '', '', 0),
(2508, '梓潼县', '0', 387, 0, '', 1, 0, '', '', 0),
(2509, '北川羌族自治县', '0', 387, 0, '', 1, 0, '', '', 0),
(2510, '平武县', '0', 387, 0, '', 1, 0, '', '', 0),
(2511, '江油市', '0', 387, 0, '', 1, 0, '', '', 0),
(2512, '市中区', '0', 388, 0, '', 1, 0, '', '', 0),
(2513, '元坝区', '0', 388, 0, '', 1, 0, '', '', 0),
(2514, '朝天区', '0', 388, 0, '', 1, 0, '', '', 0),
(2515, '旺苍县', '0', 388, 0, '', 1, 0, '', '', 0),
(2516, '青川县', '0', 388, 0, '', 1, 0, '', '', 0),
(2517, '剑阁县', '0', 388, 0, '', 1, 0, '', '', 0),
(2518, '苍溪县', '0', 388, 0, '', 1, 0, '', '', 0),
(2519, '船山区', '0', 389, 0, '', 1, 0, '', '', 0),
(2520, '安居区', '0', 389, 0, '', 1, 0, '', '', 0),
(2521, '蓬溪县', '0', 389, 0, '', 1, 0, '', '', 0),
(2522, '射洪县', '0', 389, 0, '', 1, 0, '', '', 0),
(2523, '大英县', '0', 389, 0, '', 1, 0, '', '', 0),
(2524, '市中区', '0', 390, 0, '', 1, 0, '', '', 0),
(2525, '东兴区', '0', 390, 0, '', 1, 0, '', '', 0),
(2526, '威远县', '0', 390, 0, '', 1, 0, '', '', 0),
(2527, '资中县', '0', 390, 0, '', 1, 0, '', '', 0),
(2528, '隆昌县', '0', 390, 0, '', 1, 0, '', '', 0),
(2529, '市中区', '0', 391, 0, '', 1, 0, '', '', 0),
(2530, '沙湾区', '0', 391, 0, '', 1, 0, '', '', 0),
(2531, '五通桥区', '0', 391, 0, '', 1, 0, '', '', 0),
(2532, '金口河区', '0', 391, 0, '', 1, 0, '', '', 0),
(2533, '犍为县', '0', 391, 0, '', 1, 0, '', '', 0),
(2534, '井研县', '0', 391, 0, '', 1, 0, '', '', 0),
(2535, '夹江县', '0', 391, 0, '', 1, 0, '', '', 0),
(2536, '沐川县', '0', 391, 0, '', 1, 0, '', '', 0),
(2537, '峨边彝族自治县', '0', 391, 0, '', 1, 0, '', '', 0),
(2538, '马边彝族自治县', '0', 391, 0, '', 1, 0, '', '', 0),
(2539, '峨眉山市', '0', 391, 0, '', 1, 0, '', '', 0),
(2540, '顺庆区', '0', 392, 0, '', 1, 0, '', '', 0),
(2541, '高坪区', '0', 392, 0, '', 1, 0, '', '', 0),
(2542, '嘉陵区', '0', 392, 0, '', 1, 0, '', '', 0),
(2543, '南部县', '0', 392, 0, '', 1, 0, '', '', 0),
(2544, '营山县', '0', 392, 0, '', 1, 0, '', '', 0),
(2545, '蓬安县', '0', 392, 0, '', 1, 0, '', '', 0),
(2546, '仪陇县', '0', 392, 0, '', 1, 0, '', '', 0),
(2547, '西充县', '0', 392, 0, '', 1, 0, '', '', 0),
(2548, '阆中市', '0', 392, 0, '', 1, 0, '', '', 0),
(2549, '东坡区', '0', 393, 0, '', 1, 0, '', '', 0),
(2550, '仁寿县', '0', 393, 0, '', 1, 0, '', '', 0),
(2551, '彭山县', '0', 393, 0, '', 1, 0, '', '', 0),
(2552, '洪雅县', '0', 393, 0, '', 1, 0, '', '', 0),
(2553, '丹棱县', '0', 393, 0, '', 1, 0, '', '', 0),
(2554, '青神县', '0', 393, 0, '', 1, 0, '', '', 0),
(2555, '翠屏区', '0', 394, 0, '', 1, 0, '', '', 0),
(2556, '宜宾县', '0', 394, 0, '', 1, 0, '', '', 0),
(2557, '南溪县', '0', 394, 0, '', 1, 0, '', '', 0),
(2558, '江安县', '0', 394, 0, '', 1, 0, '', '', 0),
(2559, '长宁县', '0', 394, 0, '', 1, 0, '', '', 0),
(2560, '高县', '0', 394, 0, '', 1, 0, '', '', 0),
(2561, '珙县', '0', 394, 0, '', 1, 0, '', '', 0),
(2562, '筠连县', '0', 394, 0, '', 1, 0, '', '', 0),
(2563, '兴文县', '0', 394, 0, '', 1, 0, '', '', 0),
(2564, '屏山县', '0', 394, 0, '', 1, 0, '', '', 0),
(2565, '广安区', '0', 395, 0, '', 1, 0, '', '', 0),
(2566, '岳池县', '0', 395, 0, '', 1, 0, '', '', 0),
(2567, '武胜县', '0', 395, 0, '', 1, 0, '', '', 0),
(2568, '邻水县', '0', 395, 0, '', 1, 0, '', '', 0),
(2569, '华蓥市', '0', 395, 0, '', 1, 0, '', '', 0),
(2570, '通川区', '0', 396, 0, '', 1, 0, '', '', 0),
(2571, '达县', '0', 396, 0, '', 1, 0, '', '', 0),
(2572, '宣汉县', '0', 396, 0, '', 1, 0, '', '', 0),
(2573, '开江县', '0', 396, 0, '', 1, 0, '', '', 0),
(2574, '大竹县', '0', 396, 0, '', 1, 0, '', '', 0),
(2575, '渠县', '0', 396, 0, '', 1, 0, '', '', 0),
(2576, '万源市', '0', 396, 0, '', 1, 0, '', '', 0),
(2577, '雨城区', '0', 397, 0, '', 1, 0, '', '', 0),
(2578, '名山县', '0', 397, 0, '', 1, 0, '', '', 0),
(2579, '荥经县', '0', 397, 0, '', 1, 0, '', '', 0),
(2580, '汉源县', '0', 397, 0, '', 1, 0, '', '', 0),
(2581, '石棉县', '0', 397, 0, '', 1, 0, '', '', 0),
(2582, '天全县', '0', 397, 0, '', 1, 0, '', '', 0),
(2583, '芦山县', '0', 397, 0, '', 1, 0, '', '', 0),
(2584, '宝兴县', '0', 397, 0, '', 1, 0, '', '', 0),
(2585, '巴州区', '0', 398, 0, '', 1, 0, '', '', 0),
(2586, '通江县', '0', 398, 0, '', 1, 0, '', '', 0),
(2587, '南江县', '0', 398, 0, '', 1, 0, '', '', 0),
(2588, '平昌县', '0', 398, 0, '', 1, 0, '', '', 0),
(2589, '雁江区', '0', 399, 0, '', 1, 0, '', '', 0),
(2590, '安岳县', '0', 399, 0, '', 1, 0, '', '', 0),
(2591, '乐至县', '0', 399, 0, '', 1, 0, '', '', 0),
(2592, '简阳市', '0', 399, 0, '', 1, 0, '', '', 0),
(2593, '汶川县', '0', 400, 0, '', 1, 0, '', '', 0),
(2594, '理县', '0', 400, 0, '', 1, 0, '', '', 0),
(2595, '茂县', '0', 400, 0, '', 1, 0, '', '', 0),
(2596, '松潘县', '0', 400, 0, '', 1, 0, '', '', 0),
(2597, '九寨沟县', '0', 400, 0, '', 1, 0, '', '', 0),
(2598, '金川县', '0', 400, 0, '', 1, 0, '', '', 0),
(2599, '小金县', '0', 400, 0, '', 1, 0, '', '', 0),
(2600, '黑水县', '0', 400, 0, '', 1, 0, '', '', 0),
(2601, '马尔康县', '0', 400, 0, '', 1, 0, '', '', 0),
(2602, '壤塘县', '0', 400, 0, '', 1, 0, '', '', 0),
(2603, '阿坝县', '0', 400, 0, '', 1, 0, '', '', 0),
(2604, '若尔盖县', '0', 400, 0, '', 1, 0, '', '', 0),
(2605, '红原县', '0', 400, 0, '', 1, 0, '', '', 0),
(2606, '康定县', '0', 401, 0, '', 1, 0, '', '', 0),
(2607, '泸定县', '0', 401, 0, '', 1, 0, '', '', 0),
(2608, '丹巴县', '0', 401, 0, '', 1, 0, '', '', 0),
(2609, '九龙县', '0', 401, 0, '', 1, 0, '', '', 0),
(2610, '雅江县', '0', 401, 0, '', 1, 0, '', '', 0),
(2611, '道孚县', '0', 401, 0, '', 1, 0, '', '', 0),
(2612, '炉霍县', '0', 401, 0, '', 1, 0, '', '', 0),
(2613, '甘孜县', '0', 401, 0, '', 1, 0, '', '', 0),
(2614, '新龙县', '0', 401, 0, '', 1, 0, '', '', 0),
(2615, '德格县', '0', 401, 0, '', 1, 0, '', '', 0),
(2616, '白玉县', '0', 401, 0, '', 1, 0, '', '', 0),
(2617, '石渠县', '0', 401, 0, '', 1, 0, '', '', 0),
(2618, '色达县', '0', 401, 0, '', 1, 0, '', '', 0),
(2619, '理塘县', '0', 401, 0, '', 1, 0, '', '', 0),
(2620, '巴塘县', '0', 401, 0, '', 1, 0, '', '', 0),
(2621, '乡城县', '0', 401, 0, '', 1, 0, '', '', 0),
(2622, '稻城县', '0', 401, 0, '', 1, 0, '', '', 0),
(2623, '得荣县', '0', 401, 0, '', 1, 0, '', '', 0),
(2624, '西昌市', '0', 402, 0, '', 1, 0, '', '', 0),
(2625, '木里藏族自治县', '0', 402, 0, '', 1, 0, '', '', 0),
(2626, '盐源县', '0', 402, 0, '', 1, 0, '', '', 0),
(2627, '德昌县', '0', 402, 0, '', 1, 0, '', '', 0),
(2628, '会理县', '0', 402, 0, '', 1, 0, '', '', 0),
(2629, '会东县', '0', 402, 0, '', 1, 0, '', '', 0),
(2630, '宁南县', '0', 402, 0, '', 1, 0, '', '', 0),
(2631, '普格县', '0', 402, 0, '', 1, 0, '', '', 0),
(2632, '布拖县', '0', 402, 0, '', 1, 0, '', '', 0),
(2633, '金阳县', '0', 402, 0, '', 1, 0, '', '', 0),
(2634, '昭觉县', '0', 402, 0, '', 1, 0, '', '', 0),
(2635, '喜德县', '0', 402, 0, '', 1, 0, '', '', 0),
(2636, '冕宁县', '0', 402, 0, '', 1, 0, '', '', 0),
(2637, '越西县', '0', 402, 0, '', 1, 0, '', '', 0),
(2638, '甘洛县', '0', 402, 0, '', 1, 0, '', '', 0),
(2639, '美姑县', '0', 402, 0, '', 1, 0, '', '', 0),
(2640, '雷波县', '0', 402, 0, '', 1, 0, '', '', 0),
(2641, '南明区', '0', 403, 0, '', 1, 0, '', '', 0),
(2642, '云岩区', '0', 403, 0, '', 1, 0, '', '', 0),
(2643, '花溪区', '0', 403, 0, '', 1, 0, '', '', 0),
(2644, '乌当区', '0', 403, 0, '', 1, 0, '', '', 0),
(2645, '白云区', '0', 403, 0, '', 1, 0, '', '', 0),
(2646, '小河区', '0', 403, 0, '', 1, 0, '', '', 0),
(2647, '开阳县', '0', 403, 0, '', 1, 0, '', '', 0),
(2648, '息烽县', '0', 403, 0, '', 1, 0, '', '', 0),
(2649, '修文县', '0', 403, 0, '', 1, 0, '', '', 0),
(2650, '清镇市', '0', 403, 0, '', 1, 0, '', '', 0),
(2651, '钟山区', '0', 404, 0, '', 1, 0, '', '', 0),
(2652, '六枝特区', '0', 404, 0, '', 1, 0, '', '', 0),
(2653, '水城县', '0', 404, 0, '', 1, 0, '', '', 0),
(2654, '盘县', '0', 404, 0, '', 1, 0, '', '', 0),
(2655, '红花岗区', '0', 405, 0, '', 1, 0, '', '', 0),
(2656, '汇川区', '0', 405, 0, '', 1, 0, '', '', 0),
(2657, '遵义县', '0', 405, 0, '', 1, 0, '', '', 0),
(2658, '桐梓县', '0', 405, 0, '', 1, 0, '', '', 0),
(2659, '绥阳县', '0', 405, 0, '', 1, 0, '', '', 0),
(2660, '正安县', '0', 405, 0, '', 1, 0, '', '', 0),
(2661, '道真仡佬族苗族自治县', '0', 405, 0, '', 1, 0, '', '', 0),
(2662, '务川仡佬族苗族自治县', '0', 405, 0, '', 1, 0, '', '', 0),
(2663, '凤冈县', '0', 405, 0, '', 1, 0, '', '', 0),
(2664, '湄潭县', '0', 405, 0, '', 1, 0, '', '', 0),
(2665, '余庆县', '0', 405, 0, '', 1, 0, '', '', 0),
(2666, '习水县', '0', 405, 0, '', 1, 0, '', '', 0),
(2667, '赤水市', '0', 405, 0, '', 1, 0, '', '', 0),
(2668, '仁怀市', '0', 405, 0, '', 1, 0, '', '', 0),
(2669, '西秀区', '0', 406, 0, '', 1, 0, '', '', 0),
(2670, '平坝县', '0', 406, 0, '', 1, 0, '', '', 0),
(2671, '普定县', '0', 406, 0, '', 1, 0, '', '', 0),
(2672, '镇宁布依族苗族自治县', '0', 406, 0, '', 1, 0, '', '', 0),
(2673, '关岭布依族苗族自治县', '0', 406, 0, '', 1, 0, '', '', 0),
(2674, '紫云苗族布依族自治县', '0', 406, 0, '', 1, 0, '', '', 0),
(2675, '铜仁市', '0', 407, 0, '', 1, 0, '', '', 0),
(2676, '江口县', '0', 407, 0, '', 1, 0, '', '', 0),
(2677, '玉屏侗族自治县', '0', 407, 0, '', 1, 0, '', '', 0),
(2678, '石阡县', '0', 407, 0, '', 1, 0, '', '', 0),
(2679, '思南县', '0', 407, 0, '', 1, 0, '', '', 0),
(2680, '印江土家族苗族自治县', '0', 407, 0, '', 1, 0, '', '', 0),
(2681, '德江县', '0', 407, 0, '', 1, 0, '', '', 0),
(2682, '沿河土家族自治县', '0', 407, 0, '', 1, 0, '', '', 0),
(2683, '松桃苗族自治县', '0', 407, 0, '', 1, 0, '', '', 0),
(2684, '万山特区', '0', 407, 0, '', 1, 0, '', '', 0),
(2685, '兴义市', '0', 408, 0, '', 1, 0, '', '', 0),
(2686, '兴仁县', '0', 408, 0, '', 1, 0, '', '', 0),
(2687, '普安县', '0', 408, 0, '', 1, 0, '', '', 0),
(2688, '晴隆县', '0', 408, 0, '', 1, 0, '', '', 0),
(2689, '贞丰县', '0', 408, 0, '', 1, 0, '', '', 0),
(2690, '望谟县', '0', 408, 0, '', 1, 0, '', '', 0),
(2691, '册亨县', '0', 408, 0, '', 1, 0, '', '', 0),
(2692, '安龙县', '0', 408, 0, '', 1, 0, '', '', 0),
(2693, '毕节市', '0', 409, 0, '', 1, 0, '', '', 0),
(2694, '大方县', '0', 409, 0, '', 1, 0, '', '', 0),
(2695, '黔西县', '0', 409, 0, '', 1, 0, '', '', 0),
(2696, '金沙县', '0', 409, 0, '', 1, 0, '', '', 0),
(2697, '织金县', '0', 409, 0, '', 1, 0, '', '', 0),
(2698, '纳雍县', '0', 409, 0, '', 1, 0, '', '', 0),
(2699, '威宁彝族回族苗族自治县', '0', 409, 0, '', 1, 0, '', '', 0),
(2700, '赫章县', '0', 409, 0, '', 1, 0, '', '', 0),
(2701, '凯里市', '0', 410, 0, '', 1, 0, '', '', 0),
(2702, '黄平县', '0', 410, 0, '', 1, 0, '', '', 0),
(2703, '施秉县', '0', 410, 0, '', 1, 0, '', '', 0),
(2704, '三穗县', '0', 410, 0, '', 1, 0, '', '', 0),
(2705, '镇远县', '0', 410, 0, '', 1, 0, '', '', 0),
(2706, '岑巩县', '0', 410, 0, '', 1, 0, '', '', 0),
(2707, '天柱县', '0', 410, 0, '', 1, 0, '', '', 0),
(2708, '锦屏县', '0', 410, 0, '', 1, 0, '', '', 0),
(2709, '剑河县', '0', 410, 0, '', 1, 0, '', '', 0),
(2710, '台江县', '0', 410, 0, '', 1, 0, '', '', 0),
(2711, '黎平县', '0', 410, 0, '', 1, 0, '', '', 0),
(2712, '榕江县', '0', 410, 0, '', 1, 0, '', '', 0),
(2713, '从江县', '0', 410, 0, '', 1, 0, '', '', 0),
(2714, '雷山县', '0', 410, 0, '', 1, 0, '', '', 0),
(2715, '麻江县', '0', 410, 0, '', 1, 0, '', '', 0),
(2716, '丹寨县', '0', 410, 0, '', 1, 0, '', '', 0),
(2717, '都匀市', '0', 411, 0, '', 1, 0, '', '', 0),
(2718, '福泉市', '0', 411, 0, '', 1, 0, '', '', 0),
(2719, '荔波县', '0', 411, 0, '', 1, 0, '', '', 0),
(2720, '贵定县', '0', 411, 0, '', 1, 0, '', '', 0),
(2721, '瓮安县', '0', 411, 0, '', 1, 0, '', '', 0),
(2722, '独山县', '0', 411, 0, '', 1, 0, '', '', 0),
(2723, '平塘县', '0', 411, 0, '', 1, 0, '', '', 0),
(2724, '罗甸县', '0', 411, 0, '', 1, 0, '', '', 0),
(2725, '长顺县', '0', 411, 0, '', 1, 0, '', '', 0),
(2726, '龙里县', '0', 411, 0, '', 1, 0, '', '', 0),
(2727, '惠水县', '0', 411, 0, '', 1, 0, '', '', 0),
(2728, '三都水族自治县', '0', 411, 0, '', 1, 0, '', '', 0),
(2729, '五华区', '0', 412, 0, '', 1, 0, '', '', 0),
(2730, '盘龙区', '0', 412, 0, '', 1, 0, '', '', 0),
(2731, '官渡区', '0', 412, 0, '', 1, 0, '', '', 0),
(2732, '西山区', '0', 412, 0, '', 1, 0, '', '', 0),
(2733, '东川区', '0', 412, 0, '', 1, 0, '', '', 0),
(2734, '呈贡县', '0', 412, 0, '', 1, 0, '', '', 0),
(2735, '晋宁县', '0', 412, 0, '', 1, 0, '', '', 0),
(2736, '富民县', '0', 412, 0, '', 1, 0, '', '', 0),
(2737, '宜良县', '0', 412, 0, '', 1, 0, '', '', 0),
(2738, '石林彝族自治县', '0', 412, 0, '', 1, 0, '', '', 0),
(2739, '嵩明县', '0', 412, 0, '', 1, 0, '', '', 0),
(2740, '禄劝彝族苗族自治县', '0', 412, 0, '', 1, 0, '', '', 0),
(2741, '寻甸回族彝族自治县', '0', 412, 0, '', 1, 0, '', '', 0),
(2742, '安宁市', '0', 412, 0, '', 1, 0, '', '', 0),
(2743, '麒麟区', '0', 413, 0, '', 1, 0, '', '', 0),
(2744, '马龙县', '0', 413, 0, '', 1, 0, '', '', 0),
(2745, '陆良县', '0', 413, 0, '', 1, 0, '', '', 0),
(2746, '师宗县', '0', 413, 0, '', 1, 0, '', '', 0),
(2747, '罗平县', '0', 413, 0, '', 1, 0, '', '', 0),
(2748, '富源县', '0', 413, 0, '', 1, 0, '', '', 0),
(2749, '会泽县', '0', 413, 0, '', 1, 0, '', '', 0),
(2750, '沾益县', '0', 413, 0, '', 1, 0, '', '', 0),
(2751, '宣威市', '0', 413, 0, '', 1, 0, '', '', 0),
(2752, '红塔区', '0', 414, 0, '', 1, 0, '', '', 0),
(2753, '江川县', '0', 414, 0, '', 1, 0, '', '', 0),
(2754, '澄江县', '0', 414, 0, '', 1, 0, '', '', 0),
(2755, '通海县', '0', 414, 0, '', 1, 0, '', '', 0),
(2756, '华宁县', '0', 414, 0, '', 1, 0, '', '', 0),
(2757, '易门县', '0', 414, 0, '', 1, 0, '', '', 0),
(2758, '峨山彝族自治县', '0', 414, 0, '', 1, 0, '', '', 0),
(2759, '新平彝族傣族自治县', '0', 414, 0, '', 1, 0, '', '', 0),
(2760, '元江哈尼族彝族傣族自治县', '0', 414, 0, '', 1, 0, '', '', 0),
(2761, '隆阳区', '0', 415, 0, '', 1, 0, '', '', 0),
(2762, '施甸县', '0', 415, 0, '', 1, 0, '', '', 0),
(2763, '腾冲县', '0', 415, 0, '', 1, 0, '', '', 0),
(2764, '龙陵县', '0', 415, 0, '', 1, 0, '', '', 0),
(2765, '昌宁县', '0', 415, 0, '', 1, 0, '', '', 0),
(2766, '昭阳区', '0', 416, 0, '', 1, 0, '', '', 0),
(2767, '鲁甸县', '0', 416, 0, '', 1, 0, '', '', 0),
(2768, '巧家县', '0', 416, 0, '', 1, 0, '', '', 0),
(2769, '盐津县', '0', 416, 0, '', 1, 0, '', '', 0),
(2770, '大关县', '0', 416, 0, '', 1, 0, '', '', 0),
(2771, '永善县', '0', 416, 0, '', 1, 0, '', '', 0),
(2772, '绥江县', '0', 416, 0, '', 1, 0, '', '', 0),
(2773, '镇雄县', '0', 416, 0, '', 1, 0, '', '', 0),
(2774, '彝良县', '0', 416, 0, '', 1, 0, '', '', 0),
(2775, '威信县', '0', 416, 0, '', 1, 0, '', '', 0),
(2776, '水富县', '0', 416, 0, '', 1, 0, '', '', 0),
(2777, '古城区', '0', 417, 0, '', 1, 0, '', '', 0),
(2778, '玉龙纳西族自治县', '0', 417, 0, '', 1, 0, '', '', 0),
(2779, '永胜县', '0', 417, 0, '', 1, 0, '', '', 0),
(2780, '华坪县', '0', 417, 0, '', 1, 0, '', '', 0),
(2781, '宁蒗彝族自治县', '0', 417, 0, '', 1, 0, '', '', 0),
(2782, '翠云区', '0', 418, 0, '', 1, 0, '', '', 0),
(2783, '普洱哈尼族彝族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2784, '墨江哈尼族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2785, '景东彝族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2786, '景谷傣族彝族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2787, '镇沅彝族哈尼族拉祜族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2788, '江城哈尼族彝族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2789, '孟连傣族拉祜族佤族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2790, '澜沧拉祜族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2791, '西盟佤族自治县', '0', 418, 0, '', 1, 0, '', '', 0),
(2792, '临翔区', '0', 419, 0, '', 1, 0, '', '', 0),
(2793, '凤庆县', '0', 419, 0, '', 1, 0, '', '', 0),
(2794, '云县', '0', 419, 0, '', 1, 0, '', '', 0),
(2795, '永德县', '0', 419, 0, '', 1, 0, '', '', 0),
(2796, '镇康县', '0', 419, 0, '', 1, 0, '', '', 0),
(2797, '双江拉祜族佤族布朗族傣族自治县', '0', 419, 0, '', 1, 0, '', '', 0),
(2798, '耿马傣族佤族自治县', '0', 419, 0, '', 1, 0, '', '', 0),
(2799, '沧源佤族自治县', '0', 420, 0, '', 1, 0, '', '', 0),
(2800, '楚雄市', '0', 420, 0, '', 1, 0, '', '', 0),
(2801, '双柏县', '0', 420, 0, '', 1, 0, '', '', 0),
(2802, '牟定县', '0', 420, 0, '', 1, 0, '', '', 0),
(2803, '南华县', '0', 420, 0, '', 1, 0, '', '', 0),
(2804, '姚安县', '0', 420, 0, '', 1, 0, '', '', 0),
(2805, '大姚县', '0', 420, 0, '', 1, 0, '', '', 0),
(2806, '永仁县', '0', 420, 0, '', 1, 0, '', '', 0),
(2807, '元谋县', '0', 420, 0, '', 1, 0, '', '', 0),
(2808, '武定县', '0', 420, 0, '', 1, 0, '', '', 0),
(2809, '禄丰县', '0', 420, 0, '', 1, 0, '', '', 0),
(2810, '个旧市', '0', 421, 0, '', 1, 0, '', '', 0),
(2811, '开远市', '0', 421, 0, '', 1, 0, '', '', 0),
(2812, '蒙自县', '0', 421, 0, '', 1, 0, '', '', 0),
(2813, '屏边苗族自治县', '0', 421, 0, '', 1, 0, '', '', 0),
(2814, '建水县', '0', 421, 0, '', 1, 0, '', '', 0),
(2815, '石屏县', '0', 421, 0, '', 1, 0, '', '', 0),
(2816, '弥勒县', '0', 421, 0, '', 1, 0, '', '', 0),
(2817, '泸西县', '0', 421, 0, '', 1, 0, '', '', 0),
(2818, '元阳县', '0', 421, 0, '', 1, 0, '', '', 0);
INSERT INTO `h5_linkage` (`linkageid`, `name`, `style`, `parentid`, `child`, `arrchildid`, `keyid`, `listorder`, `description`, `setting`, `siteid`) VALUES
(2819, '红河县', '0', 421, 0, '', 1, 0, '', '', 0),
(2820, '金平苗族瑶族傣族自治县', '0', 421, 0, '', 1, 0, '', '', 0),
(2821, '绿春县', '0', 421, 0, '', 1, 0, '', '', 0),
(2822, '河口瑶族自治县', '0', 421, 0, '', 1, 0, '', '', 0),
(2823, '文山县', '0', 422, 0, '', 1, 0, '', '', 0),
(2824, '砚山县', '0', 422, 0, '', 1, 0, '', '', 0),
(2825, '西畴县', '0', 422, 0, '', 1, 0, '', '', 0),
(2826, '麻栗坡县', '0', 422, 0, '', 1, 0, '', '', 0),
(2827, '马关县', '0', 422, 0, '', 1, 0, '', '', 0),
(2828, '丘北县', '0', 422, 0, '', 1, 0, '', '', 0),
(2829, '广南县', '0', 422, 0, '', 1, 0, '', '', 0),
(2830, '富宁县', '0', 422, 0, '', 1, 0, '', '', 0),
(2831, '景洪市', '0', 423, 0, '', 1, 0, '', '', 0),
(2832, '勐海县', '0', 423, 0, '', 1, 0, '', '', 0),
(2833, '勐腊县', '0', 423, 0, '', 1, 0, '', '', 0),
(2834, '大理市', '0', 424, 0, '', 1, 0, '', '', 0),
(2835, '漾濞彝族自治县', '0', 424, 0, '', 1, 0, '', '', 0),
(2836, '祥云县', '0', 424, 0, '', 1, 0, '', '', 0),
(2837, '宾川县', '0', 424, 0, '', 1, 0, '', '', 0),
(2838, '弥渡县', '0', 424, 0, '', 1, 0, '', '', 0),
(2839, '南涧彝族自治县', '0', 424, 0, '', 1, 0, '', '', 0),
(2840, '巍山彝族回族自治县', '0', 424, 0, '', 1, 0, '', '', 0),
(2841, '永平县', '0', 424, 0, '', 1, 0, '', '', 0),
(2842, '云龙县', '0', 424, 0, '', 1, 0, '', '', 0),
(2843, '洱源县', '0', 424, 0, '', 1, 0, '', '', 0),
(2844, '剑川县', '0', 424, 0, '', 1, 0, '', '', 0),
(2845, '鹤庆县', '0', 424, 0, '', 1, 0, '', '', 0),
(2846, '瑞丽市', '0', 425, 0, '', 1, 0, '', '', 0),
(2847, '潞西市', '0', 425, 0, '', 1, 0, '', '', 0),
(2848, '梁河县', '0', 425, 0, '', 1, 0, '', '', 0),
(2849, '盈江县', '0', 425, 0, '', 1, 0, '', '', 0),
(2850, '陇川县', '0', 425, 0, '', 1, 0, '', '', 0),
(2851, '泸水县', '0', 426, 0, '', 1, 0, '', '', 0),
(2852, '福贡县', '0', 426, 0, '', 1, 0, '', '', 0),
(2853, '贡山独龙族怒族自治县', '0', 426, 0, '', 1, 0, '', '', 0),
(2854, '兰坪白族普米族自治县', '0', 426, 0, '', 1, 0, '', '', 0),
(2855, '香格里拉县', '0', 427, 0, '', 1, 0, '', '', 0),
(2856, '德钦县', '0', 427, 0, '', 1, 0, '', '', 0),
(2857, '维西傈僳族自治县', '0', 427, 0, '', 1, 0, '', '', 0),
(2858, '城关区', '0', 428, 0, '', 1, 0, '', '', 0),
(2859, '林周县', '0', 428, 0, '', 1, 0, '', '', 0),
(2860, '当雄县', '0', 428, 0, '', 1, 0, '', '', 0),
(2861, '尼木县', '0', 428, 0, '', 1, 0, '', '', 0),
(2862, '曲水县', '0', 428, 0, '', 1, 0, '', '', 0),
(2863, '堆龙德庆县', '0', 428, 0, '', 1, 0, '', '', 0),
(2864, '达孜县', '0', 428, 0, '', 1, 0, '', '', 0),
(2865, '墨竹工卡县', '0', 428, 0, '', 1, 0, '', '', 0),
(2866, '昌都县', '0', 429, 0, '', 1, 0, '', '', 0),
(2867, '江达县', '0', 429, 0, '', 1, 0, '', '', 0),
(2868, '贡觉县', '0', 429, 0, '', 1, 0, '', '', 0),
(2869, '类乌齐县', '0', 429, 0, '', 1, 0, '', '', 0),
(2870, '丁青县', '0', 429, 0, '', 1, 0, '', '', 0),
(2871, '察雅县', '0', 429, 0, '', 1, 0, '', '', 0),
(2872, '八宿县', '0', 429, 0, '', 1, 0, '', '', 0),
(2873, '左贡县', '0', 429, 0, '', 1, 0, '', '', 0),
(2874, '芒康县', '0', 429, 0, '', 1, 0, '', '', 0),
(2875, '洛隆县', '0', 429, 0, '', 1, 0, '', '', 0),
(2876, '边坝县', '0', 429, 0, '', 1, 0, '', '', 0),
(2877, '乃东县', '0', 430, 0, '', 1, 0, '', '', 0),
(2878, '扎囊县', '0', 430, 0, '', 1, 0, '', '', 0),
(2879, '贡嘎县', '0', 430, 0, '', 1, 0, '', '', 0),
(2880, '桑日县', '0', 430, 0, '', 1, 0, '', '', 0),
(2881, '琼结县', '0', 430, 0, '', 1, 0, '', '', 0),
(2882, '曲松县', '0', 430, 0, '', 1, 0, '', '', 0),
(2883, '措美县', '0', 430, 0, '', 1, 0, '', '', 0),
(2884, '洛扎县', '0', 430, 0, '', 1, 0, '', '', 0),
(2885, '加查县', '0', 430, 0, '', 1, 0, '', '', 0),
(2886, '隆子县', '0', 430, 0, '', 1, 0, '', '', 0),
(2887, '错那县', '0', 430, 0, '', 1, 0, '', '', 0),
(2888, '浪卡子县', '0', 430, 0, '', 1, 0, '', '', 0),
(2889, '日喀则市', '0', 431, 0, '', 1, 0, '', '', 0),
(2890, '南木林县', '0', 431, 0, '', 1, 0, '', '', 0),
(2891, '江孜县', '0', 431, 0, '', 1, 0, '', '', 0),
(2892, '定日县', '0', 431, 0, '', 1, 0, '', '', 0),
(2893, '萨迦县', '0', 431, 0, '', 1, 0, '', '', 0),
(2894, '拉孜县', '0', 431, 0, '', 1, 0, '', '', 0),
(2895, '昂仁县', '0', 431, 0, '', 1, 0, '', '', 0),
(2896, '谢通门县', '0', 431, 0, '', 1, 0, '', '', 0),
(2897, '白朗县', '0', 431, 0, '', 1, 0, '', '', 0),
(2898, '仁布县', '0', 431, 0, '', 1, 0, '', '', 0),
(2899, '康马县', '0', 431, 0, '', 1, 0, '', '', 0),
(2900, '定结县', '0', 431, 0, '', 1, 0, '', '', 0),
(2901, '仲巴县', '0', 431, 0, '', 1, 0, '', '', 0),
(2902, '亚东县', '0', 431, 0, '', 1, 0, '', '', 0),
(2903, '吉隆县', '0', 431, 0, '', 1, 0, '', '', 0),
(2904, '聂拉木县', '0', 431, 0, '', 1, 0, '', '', 0),
(2905, '萨嘎县', '0', 431, 0, '', 1, 0, '', '', 0),
(2906, '岗巴县', '0', 431, 0, '', 1, 0, '', '', 0),
(2907, '那曲县', '0', 432, 0, '', 1, 0, '', '', 0),
(2908, '嘉黎县', '0', 432, 0, '', 1, 0, '', '', 0),
(2909, '比如县', '0', 432, 0, '', 1, 0, '', '', 0),
(2910, '聂荣县', '0', 432, 0, '', 1, 0, '', '', 0),
(2911, '安多县', '0', 432, 0, '', 1, 0, '', '', 0),
(2912, '申扎县', '0', 432, 0, '', 1, 0, '', '', 0),
(2913, '索县', '0', 432, 0, '', 1, 0, '', '', 0),
(2914, '班戈县', '0', 432, 0, '', 1, 0, '', '', 0),
(2915, '巴青县', '0', 432, 0, '', 1, 0, '', '', 0),
(2916, '尼玛县', '0', 432, 0, '', 1, 0, '', '', 0),
(2917, '普兰县', '0', 433, 0, '', 1, 0, '', '', 0),
(2918, '札达县', '0', 433, 0, '', 1, 0, '', '', 0),
(2919, '噶尔县', '0', 433, 0, '', 1, 0, '', '', 0),
(2920, '日土县', '0', 433, 0, '', 1, 0, '', '', 0),
(2921, '革吉县', '0', 433, 0, '', 1, 0, '', '', 0),
(2922, '改则县', '0', 433, 0, '', 1, 0, '', '', 0),
(2923, '措勤县', '0', 433, 0, '', 1, 0, '', '', 0),
(2924, '林芝县', '0', 434, 0, '', 1, 0, '', '', 0),
(2925, '工布江达县', '0', 434, 0, '', 1, 0, '', '', 0),
(2926, '米林县', '0', 434, 0, '', 1, 0, '', '', 0),
(2927, '墨脱县', '0', 434, 0, '', 1, 0, '', '', 0),
(2928, '波密县', '0', 434, 0, '', 1, 0, '', '', 0),
(2929, '察隅县', '0', 434, 0, '', 1, 0, '', '', 0),
(2930, '朗县', '0', 434, 0, '', 1, 0, '', '', 0),
(2931, '新城区', '0', 435, 0, '', 1, 0, '', '', 0),
(2932, '碑林区', '0', 435, 0, '', 1, 0, '', '', 0),
(2933, '莲湖区', '0', 435, 0, '', 1, 0, '', '', 0),
(2934, '灞桥区', '0', 435, 0, '', 1, 0, '', '', 0),
(2935, '未央区', '0', 435, 0, '', 1, 0, '', '', 0),
(2936, '雁塔区', '0', 435, 0, '', 1, 0, '', '', 0),
(2937, '阎良区', '0', 435, 0, '', 1, 0, '', '', 0),
(2938, '临潼区', '0', 435, 0, '', 1, 0, '', '', 0),
(2939, '长安区', '0', 435, 0, '', 1, 0, '', '', 0),
(2940, '蓝田县', '0', 435, 0, '', 1, 0, '', '', 0),
(2941, '周至县', '0', 435, 0, '', 1, 0, '', '', 0),
(2942, '户县', '0', 435, 0, '', 1, 0, '', '', 0),
(2943, '高陵县', '0', 435, 0, '', 1, 0, '', '', 0),
(2944, '王益区', '0', 436, 0, '', 1, 0, '', '', 0),
(2945, '印台区', '0', 436, 0, '', 1, 0, '', '', 0),
(2946, '耀州区', '0', 436, 0, '', 1, 0, '', '', 0),
(2947, '宜君县', '0', 436, 0, '', 1, 0, '', '', 0),
(2948, '渭滨区', '0', 437, 0, '', 1, 0, '', '', 0),
(2949, '金台区', '0', 437, 0, '', 1, 0, '', '', 0),
(2950, '陈仓区', '0', 437, 0, '', 1, 0, '', '', 0),
(2951, '凤翔县', '0', 437, 0, '', 1, 0, '', '', 0),
(2952, '岐山县', '0', 437, 0, '', 1, 0, '', '', 0),
(2953, '扶风县', '0', 437, 0, '', 1, 0, '', '', 0),
(2954, '眉县', '0', 437, 0, '', 1, 0, '', '', 0),
(2955, '陇县', '0', 437, 0, '', 1, 0, '', '', 0),
(2956, '千阳县', '0', 437, 0, '', 1, 0, '', '', 0),
(2957, '麟游县', '0', 437, 0, '', 1, 0, '', '', 0),
(2958, '凤县', '0', 437, 0, '', 1, 0, '', '', 0),
(2959, '太白县', '0', 437, 0, '', 1, 0, '', '', 0),
(2960, '秦都区', '0', 438, 0, '', 1, 0, '', '', 0),
(2961, '杨凌区', '0', 438, 0, '', 1, 0, '', '', 0),
(2962, '渭城区', '0', 438, 0, '', 1, 0, '', '', 0),
(2963, '三原县', '0', 438, 0, '', 1, 0, '', '', 0),
(2964, '泾阳县', '0', 438, 0, '', 1, 0, '', '', 0),
(2965, '乾县', '0', 438, 0, '', 1, 0, '', '', 0),
(2966, '礼泉县', '0', 438, 0, '', 1, 0, '', '', 0),
(2967, '永寿县', '0', 438, 0, '', 1, 0, '', '', 0),
(2968, '彬县', '0', 438, 0, '', 1, 0, '', '', 0),
(2969, '长武县', '0', 438, 0, '', 1, 0, '', '', 0),
(2970, '旬邑县', '0', 438, 0, '', 1, 0, '', '', 0),
(2971, '淳化县', '0', 438, 0, '', 1, 0, '', '', 0),
(2972, '武功县', '0', 438, 0, '', 1, 0, '', '', 0),
(2973, '兴平市', '0', 438, 0, '', 1, 0, '', '', 0),
(2974, '临渭区', '0', 439, 0, '', 1, 0, '', '', 0),
(2975, '华县', '0', 439, 0, '', 1, 0, '', '', 0),
(2976, '潼关县', '0', 439, 0, '', 1, 0, '', '', 0),
(2977, '大荔县', '0', 439, 0, '', 1, 0, '', '', 0),
(2978, '合阳县', '0', 439, 0, '', 1, 0, '', '', 0),
(2979, '澄城县', '0', 439, 0, '', 1, 0, '', '', 0),
(2980, '蒲城县', '0', 439, 0, '', 1, 0, '', '', 0),
(2981, '白水县', '0', 439, 0, '', 1, 0, '', '', 0),
(2982, '富平县', '0', 439, 0, '', 1, 0, '', '', 0),
(2983, '韩城市', '0', 439, 0, '', 1, 0, '', '', 0),
(2984, '华阴市', '0', 439, 0, '', 1, 0, '', '', 0),
(2985, '宝塔区', '0', 440, 0, '', 1, 0, '', '', 0),
(2986, '延长县', '0', 440, 0, '', 1, 0, '', '', 0),
(2987, '延川县', '0', 440, 0, '', 1, 0, '', '', 0),
(2988, '子长县', '0', 440, 0, '', 1, 0, '', '', 0),
(2989, '安塞县', '0', 440, 0, '', 1, 0, '', '', 0),
(2990, '志丹县', '0', 440, 0, '', 1, 0, '', '', 0),
(2991, '吴起县', '0', 440, 0, '', 1, 0, '', '', 0),
(2992, '甘泉县', '0', 440, 0, '', 1, 0, '', '', 0),
(2993, '富县', '0', 440, 0, '', 1, 0, '', '', 0),
(2994, '洛川县', '0', 440, 0, '', 1, 0, '', '', 0),
(2995, '宜川县', '0', 440, 0, '', 1, 0, '', '', 0),
(2996, '黄龙县', '0', 440, 0, '', 1, 0, '', '', 0),
(2997, '黄陵县', '0', 440, 0, '', 1, 0, '', '', 0),
(2998, '汉台区', '0', 441, 0, '', 1, 0, '', '', 0),
(2999, '南郑县', '0', 441, 0, '', 1, 0, '', '', 0),
(3000, '城固县', '0', 441, 0, '', 1, 0, '', '', 0),
(3001, '洋县', '0', 441, 0, '', 1, 0, '', '', 0),
(3002, '西乡县', '0', 441, 0, '', 1, 0, '', '', 0),
(3003, '勉县', '0', 441, 0, '', 1, 0, '', '', 0),
(3004, '宁强县', '0', 441, 0, '', 1, 0, '', '', 0),
(3005, '略阳县', '0', 441, 0, '', 1, 0, '', '', 0),
(3006, '镇巴县', '0', 441, 0, '', 1, 0, '', '', 0),
(3007, '留坝县', '0', 441, 0, '', 1, 0, '', '', 0),
(3008, '佛坪县', '0', 441, 0, '', 1, 0, '', '', 0),
(3009, '榆阳区', '0', 442, 0, '', 1, 0, '', '', 0),
(3010, '神木县', '0', 442, 0, '', 1, 0, '', '', 0),
(3011, '府谷县', '0', 442, 0, '', 1, 0, '', '', 0),
(3012, '横山县', '0', 442, 0, '', 1, 0, '', '', 0),
(3013, '靖边县', '0', 442, 0, '', 1, 0, '', '', 0),
(3014, '定边县', '0', 442, 0, '', 1, 0, '', '', 0),
(3015, '绥德县', '0', 442, 0, '', 1, 0, '', '', 0),
(3016, '米脂县', '0', 442, 0, '', 1, 0, '', '', 0),
(3017, '佳县', '0', 442, 0, '', 1, 0, '', '', 0),
(3018, '吴堡县', '0', 442, 0, '', 1, 0, '', '', 0),
(3019, '清涧县', '0', 442, 0, '', 1, 0, '', '', 0),
(3020, '子洲县', '0', 442, 0, '', 1, 0, '', '', 0),
(3021, '汉滨区', '0', 443, 0, '', 1, 0, '', '', 0),
(3022, '汉阴县', '0', 443, 0, '', 1, 0, '', '', 0),
(3023, '石泉县', '0', 443, 0, '', 1, 0, '', '', 0),
(3024, '宁陕县', '0', 443, 0, '', 1, 0, '', '', 0),
(3025, '紫阳县', '0', 443, 0, '', 1, 0, '', '', 0),
(3026, '岚皋县', '0', 443, 0, '', 1, 0, '', '', 0),
(3027, '平利县', '0', 443, 0, '', 1, 0, '', '', 0),
(3028, '镇坪县', '0', 443, 0, '', 1, 0, '', '', 0),
(3029, '旬阳县', '0', 443, 0, '', 1, 0, '', '', 0),
(3030, '白河县', '0', 443, 0, '', 1, 0, '', '', 0),
(3031, '商州区', '0', 444, 0, '', 1, 0, '', '', 0),
(3032, '洛南县', '0', 444, 0, '', 1, 0, '', '', 0),
(3033, '丹凤县', '0', 444, 0, '', 1, 0, '', '', 0),
(3034, '商南县', '0', 444, 0, '', 1, 0, '', '', 0),
(3035, '山阳县', '0', 444, 0, '', 1, 0, '', '', 0),
(3036, '镇安县', '0', 444, 0, '', 1, 0, '', '', 0),
(3037, '柞水县', '0', 444, 0, '', 1, 0, '', '', 0),
(3038, '城关区', '0', 445, 0, '', 1, 0, '', '', 0),
(3039, '七里河区', '0', 445, 0, '', 1, 0, '', '', 0),
(3040, '西固区', '0', 445, 0, '', 1, 0, '', '', 0),
(3041, '安宁区', '0', 445, 0, '', 1, 0, '', '', 0),
(3042, '红古区', '0', 445, 0, '', 1, 0, '', '', 0),
(3043, '永登县', '0', 445, 0, '', 1, 0, '', '', 0),
(3044, '皋兰县', '0', 445, 0, '', 1, 0, '', '', 0),
(3045, '榆中县', '0', 445, 0, '', 1, 0, '', '', 0),
(3046, '金川区', '0', 447, 0, '', 1, 0, '', '', 0),
(3047, '永昌县', '0', 447, 0, '', 1, 0, '', '', 0),
(3048, '白银区', '0', 448, 0, '', 1, 0, '', '', 0),
(3049, '平川区', '0', 448, 0, '', 1, 0, '', '', 0),
(3050, '靖远县', '0', 448, 0, '', 1, 0, '', '', 0),
(3051, '会宁县', '0', 448, 0, '', 1, 0, '', '', 0),
(3052, '景泰县', '0', 448, 0, '', 1, 0, '', '', 0),
(3053, '秦城区', '0', 449, 0, '', 1, 0, '', '', 0),
(3054, '北道区', '0', 449, 0, '', 1, 0, '', '', 0),
(3055, '清水县', '0', 449, 0, '', 1, 0, '', '', 0),
(3056, '秦安县', '0', 449, 0, '', 1, 0, '', '', 0),
(3057, '甘谷县', '0', 449, 0, '', 1, 0, '', '', 0),
(3058, '武山县', '0', 449, 0, '', 1, 0, '', '', 0),
(3059, '张家川回族自治县', '0', 449, 0, '', 1, 0, '', '', 0),
(3060, '凉州区', '0', 450, 0, '', 1, 0, '', '', 0),
(3061, '民勤县', '0', 450, 0, '', 1, 0, '', '', 0),
(3062, '古浪县', '0', 450, 0, '', 1, 0, '', '', 0),
(3063, '天祝藏族自治县', '0', 450, 0, '', 1, 0, '', '', 0),
(3064, '甘州区', '0', 451, 0, '', 1, 0, '', '', 0),
(3065, '肃南裕固族自治县', '0', 451, 0, '', 1, 0, '', '', 0),
(3066, '民乐县', '0', 451, 0, '', 1, 0, '', '', 0),
(3067, '临泽县', '0', 451, 0, '', 1, 0, '', '', 0),
(3068, '高台县', '0', 451, 0, '', 1, 0, '', '', 0),
(3069, '山丹县', '0', 451, 0, '', 1, 0, '', '', 0),
(3070, '崆峒区', '0', 452, 0, '', 1, 0, '', '', 0),
(3071, '泾川县', '0', 452, 0, '', 1, 0, '', '', 0),
(3072, '灵台县', '0', 452, 0, '', 1, 0, '', '', 0),
(3073, '崇信县', '0', 452, 0, '', 1, 0, '', '', 0),
(3074, '华亭县', '0', 452, 0, '', 1, 0, '', '', 0),
(3075, '庄浪县', '0', 452, 0, '', 1, 0, '', '', 0),
(3076, '静宁县', '0', 452, 0, '', 1, 0, '', '', 0),
(3077, '肃州区', '0', 453, 0, '', 1, 0, '', '', 0),
(3078, '金塔县', '0', 453, 0, '', 1, 0, '', '', 0),
(3079, '瓜州县', '0', 453, 0, '', 1, 0, '', '', 0),
(3080, '肃北蒙古族自治县', '0', 453, 0, '', 1, 0, '', '', 0),
(3081, '阿克塞哈萨克族自治县', '0', 453, 0, '', 1, 0, '', '', 0),
(3082, '玉门市', '0', 453, 0, '', 1, 0, '', '', 0),
(3083, '敦煌市', '0', 453, 0, '', 1, 0, '', '', 0),
(3084, '西峰区', '0', 454, 0, '', 1, 0, '', '', 0),
(3085, '庆城县', '0', 454, 0, '', 1, 0, '', '', 0),
(3086, '环县', '0', 454, 0, '', 1, 0, '', '', 0),
(3087, '华池县', '0', 454, 0, '', 1, 0, '', '', 0),
(3088, '合水县', '0', 454, 0, '', 1, 0, '', '', 0),
(3089, '正宁县', '0', 454, 0, '', 1, 0, '', '', 0),
(3090, '宁县', '0', 454, 0, '', 1, 0, '', '', 0),
(3091, '镇原县', '0', 454, 0, '', 1, 0, '', '', 0),
(3092, '安定区', '0', 455, 0, '', 1, 0, '', '', 0),
(3093, '通渭县', '0', 455, 0, '', 1, 0, '', '', 0),
(3094, '陇西县', '0', 455, 0, '', 1, 0, '', '', 0),
(3095, '渭源县', '0', 455, 0, '', 1, 0, '', '', 0),
(3096, '临洮县', '0', 455, 0, '', 1, 0, '', '', 0),
(3097, '漳县', '0', 455, 0, '', 1, 0, '', '', 0),
(3098, '岷县', '0', 455, 0, '', 1, 0, '', '', 0),
(3099, '武都区', '0', 456, 0, '', 1, 0, '', '', 0),
(3100, '成县', '0', 456, 0, '', 1, 0, '', '', 0),
(3101, '文县', '0', 456, 0, '', 1, 0, '', '', 0),
(3102, '宕昌县', '0', 456, 0, '', 1, 0, '', '', 0),
(3103, '康县', '0', 456, 0, '', 1, 0, '', '', 0),
(3104, '西和县', '0', 456, 0, '', 1, 0, '', '', 0),
(3105, '礼县', '0', 456, 0, '', 1, 0, '', '', 0),
(3106, '徽县', '0', 456, 0, '', 1, 0, '', '', 0),
(3107, '两当县', '0', 456, 0, '', 1, 0, '', '', 0),
(3108, '临夏市', '0', 457, 0, '', 1, 0, '', '', 0),
(3109, '临夏县', '0', 457, 0, '', 1, 0, '', '', 0),
(3110, '康乐县', '0', 457, 0, '', 1, 0, '', '', 0),
(3111, '永靖县', '0', 457, 0, '', 1, 0, '', '', 0),
(3112, '广河县', '0', 457, 0, '', 1, 0, '', '', 0),
(3113, '和政县', '0', 457, 0, '', 1, 0, '', '', 0),
(3114, '东乡族自治县', '0', 457, 0, '', 1, 0, '', '', 0),
(3115, '积石山保安族东乡族撒拉族自治县', '0', 457, 0, '', 1, 0, '', '', 0),
(3116, '合作市', '0', 458, 0, '', 1, 0, '', '', 0),
(3117, '临潭县', '0', 458, 0, '', 1, 0, '', '', 0),
(3118, '卓尼县', '0', 458, 0, '', 1, 0, '', '', 0),
(3119, '舟曲县', '0', 458, 0, '', 1, 0, '', '', 0),
(3120, '迭部县', '0', 458, 0, '', 1, 0, '', '', 0),
(3121, '玛曲县', '0', 458, 0, '', 1, 0, '', '', 0),
(3122, '碌曲县', '0', 458, 0, '', 1, 0, '', '', 0),
(3123, '夏河县', '0', 458, 0, '', 1, 0, '', '', 0),
(3124, '城东区', '0', 459, 0, '', 1, 0, '', '', 0),
(3125, '城中区', '0', 459, 0, '', 1, 0, '', '', 0),
(3126, '城西区', '0', 459, 0, '', 1, 0, '', '', 0),
(3127, '城北区', '0', 459, 0, '', 1, 0, '', '', 0),
(3128, '大通回族土族自治县', '0', 459, 0, '', 1, 0, '', '', 0),
(3129, '湟中县', '0', 459, 0, '', 1, 0, '', '', 0),
(3130, '湟源县', '0', 459, 0, '', 1, 0, '', '', 0),
(3131, '平安县', '0', 460, 0, '', 1, 0, '', '', 0),
(3132, '民和回族土族自治县', '0', 460, 0, '', 1, 0, '', '', 0),
(3133, '乐都县', '0', 460, 0, '', 1, 0, '', '', 0),
(3134, '互助土族自治县', '0', 460, 0, '', 1, 0, '', '', 0),
(3135, '化隆回族自治县', '0', 460, 0, '', 1, 0, '', '', 0),
(3136, '循化撒拉族自治县', '0', 460, 0, '', 1, 0, '', '', 0),
(3137, '门源回族自治县', '0', 461, 0, '', 1, 0, '', '', 0),
(3138, '祁连县', '0', 461, 0, '', 1, 0, '', '', 0),
(3139, '海晏县', '0', 461, 0, '', 1, 0, '', '', 0),
(3140, '刚察县', '0', 461, 0, '', 1, 0, '', '', 0),
(3141, '同仁县', '0', 462, 0, '', 1, 0, '', '', 0),
(3142, '尖扎县', '0', 462, 0, '', 1, 0, '', '', 0),
(3143, '泽库县', '0', 462, 0, '', 1, 0, '', '', 0),
(3144, '河南蒙古族自治县', '0', 462, 0, '', 1, 0, '', '', 0),
(3145, '共和县', '0', 463, 0, '', 1, 0, '', '', 0),
(3146, '同德县', '0', 463, 0, '', 1, 0, '', '', 0),
(3147, '贵德县', '0', 463, 0, '', 1, 0, '', '', 0),
(3148, '兴海县', '0', 463, 0, '', 1, 0, '', '', 0),
(3149, '贵南县', '0', 463, 0, '', 1, 0, '', '', 0),
(3150, '玛沁县', '0', 464, 0, '', 1, 0, '', '', 0),
(3151, '班玛县', '0', 464, 0, '', 1, 0, '', '', 0),
(3152, '甘德县', '0', 464, 0, '', 1, 0, '', '', 0),
(3153, '达日县', '0', 464, 0, '', 1, 0, '', '', 0),
(3154, '久治县', '0', 464, 0, '', 1, 0, '', '', 0),
(3155, '玛多县', '0', 464, 0, '', 1, 0, '', '', 0),
(3156, '玉树县', '0', 465, 0, '', 1, 0, '', '', 0),
(3157, '杂多县', '0', 465, 0, '', 1, 0, '', '', 0),
(3158, '称多县', '0', 465, 0, '', 1, 0, '', '', 0),
(3159, '治多县', '0', 465, 0, '', 1, 0, '', '', 0),
(3160, '囊谦县', '0', 465, 0, '', 1, 0, '', '', 0),
(3161, '曲麻莱县', '0', 465, 0, '', 1, 0, '', '', 0),
(3162, '格尔木市', '0', 466, 0, '', 1, 0, '', '', 0),
(3163, '德令哈市', '0', 466, 0, '', 1, 0, '', '', 0),
(3164, '乌兰县', '0', 466, 0, '', 1, 0, '', '', 0),
(3165, '都兰县', '0', 466, 0, '', 1, 0, '', '', 0),
(3166, '天峻县', '0', 466, 0, '', 1, 0, '', '', 0),
(3167, '兴庆区', '0', 467, 0, '', 1, 0, '', '', 0),
(3168, '西夏区', '0', 467, 0, '', 1, 0, '', '', 0),
(3169, '金凤区', '0', 467, 0, '', 1, 0, '', '', 0),
(3170, '永宁县', '0', 467, 0, '', 1, 0, '', '', 0),
(3171, '贺兰县', '0', 467, 0, '', 1, 0, '', '', 0),
(3172, '灵武市', '0', 467, 0, '', 1, 0, '', '', 0),
(3173, '大武口区', '0', 468, 0, '', 1, 0, '', '', 0),
(3174, '惠农区', '0', 468, 0, '', 1, 0, '', '', 0),
(3175, '平罗县', '0', 468, 0, '', 1, 0, '', '', 0),
(3176, '利通区', '0', 469, 0, '', 1, 0, '', '', 0),
(3177, '盐池县', '0', 469, 0, '', 1, 0, '', '', 0),
(3178, '同心县', '0', 469, 0, '', 1, 0, '', '', 0),
(3179, '青铜峡市', '0', 469, 0, '', 1, 0, '', '', 0),
(3180, '原州区', '0', 470, 0, '', 1, 0, '', '', 0),
(3181, '西吉县', '0', 470, 0, '', 1, 0, '', '', 0),
(3182, '隆德县', '0', 470, 0, '', 1, 0, '', '', 0),
(3183, '泾源县', '0', 470, 0, '', 1, 0, '', '', 0),
(3184, '彭阳县', '0', 470, 0, '', 1, 0, '', '', 0),
(3185, '沙坡头区', '0', 471, 0, '', 1, 0, '', '', 0),
(3186, '中宁县', '0', 471, 0, '', 1, 0, '', '', 0),
(3187, '海原县', '0', 471, 0, '', 1, 0, '', '', 0),
(3188, '天山区', '0', 472, 0, '', 1, 0, '', '', 0),
(3189, '沙依巴克区', '0', 472, 0, '', 1, 0, '', '', 0),
(3190, '新市区', '0', 472, 0, '', 1, 0, '', '', 0),
(3191, '水磨沟区', '0', 472, 0, '', 1, 0, '', '', 0),
(3192, '头屯河区', '0', 472, 0, '', 1, 0, '', '', 0),
(3193, '达坂城区', '0', 472, 0, '', 1, 0, '', '', 0),
(3194, '东山区', '0', 472, 0, '', 1, 0, '', '', 0),
(3195, '乌鲁木齐县', '0', 472, 0, '', 1, 0, '', '', 0),
(3196, '独山子区', '0', 473, 0, '', 1, 0, '', '', 0),
(3197, '克拉玛依区', '0', 473, 0, '', 1, 0, '', '', 0),
(3198, '白碱滩区', '0', 473, 0, '', 1, 0, '', '', 0),
(3199, '乌尔禾区', '0', 473, 0, '', 1, 0, '', '', 0),
(3200, '吐鲁番市', '0', 474, 0, '', 1, 0, '', '', 0),
(3201, '鄯善县', '0', 474, 0, '', 1, 0, '', '', 0),
(3202, '托克逊县', '0', 474, 0, '', 1, 0, '', '', 0),
(3203, '哈密市', '0', 475, 0, '', 1, 0, '', '', 0),
(3204, '巴里坤哈萨克自治县', '0', 475, 0, '', 1, 0, '', '', 0),
(3205, '伊吾县', '0', 475, 0, '', 1, 0, '', '', 0),
(3206, '昌吉市', '0', 476, 0, '', 1, 0, '', '', 0),
(3207, '阜康市', '0', 476, 0, '', 1, 0, '', '', 0),
(3208, '米泉市', '0', 476, 0, '', 1, 0, '', '', 0),
(3209, '呼图壁县', '0', 476, 0, '', 1, 0, '', '', 0),
(3210, '玛纳斯县', '0', 476, 0, '', 1, 0, '', '', 0),
(3211, '奇台县', '0', 476, 0, '', 1, 0, '', '', 0),
(3212, '吉木萨尔县', '0', 476, 0, '', 1, 0, '', '', 0),
(3213, '木垒哈萨克自治县', '0', 476, 0, '', 1, 0, '', '', 0),
(3214, '博乐市', '0', 477, 0, '', 1, 0, '', '', 0),
(3215, '精河县', '0', 477, 0, '', 1, 0, '', '', 0),
(3216, '温泉县', '0', 477, 0, '', 1, 0, '', '', 0),
(3217, '库尔勒市', '0', 478, 0, '', 1, 0, '', '', 0),
(3218, '轮台县', '0', 478, 0, '', 1, 0, '', '', 0),
(3219, '尉犁县', '0', 478, 0, '', 1, 0, '', '', 0),
(3220, '若羌县', '0', 478, 0, '', 1, 0, '', '', 0),
(3221, '且末县', '0', 478, 0, '', 1, 0, '', '', 0),
(3222, '焉耆回族自治县', '0', 478, 0, '', 1, 0, '', '', 0),
(3223, '和静县', '0', 478, 0, '', 1, 0, '', '', 0),
(3224, '和硕县', '0', 478, 0, '', 1, 0, '', '', 0),
(3225, '博湖县', '0', 478, 0, '', 1, 0, '', '', 0),
(3226, '阿克苏市', '0', 479, 0, '', 1, 0, '', '', 0),
(3227, '温宿县', '0', 479, 0, '', 1, 0, '', '', 0),
(3228, '库车县', '0', 479, 0, '', 1, 0, '', '', 0),
(3229, '沙雅县', '0', 479, 0, '', 1, 0, '', '', 0),
(3230, '新和县', '0', 479, 0, '', 1, 0, '', '', 0),
(3231, '拜城县', '0', 479, 0, '', 1, 0, '', '', 0),
(3232, '乌什县', '0', 479, 0, '', 1, 0, '', '', 0),
(3233, '阿瓦提县', '0', 479, 0, '', 1, 0, '', '', 0),
(3234, '柯坪县', '0', 479, 0, '', 1, 0, '', '', 0),
(3235, '阿图什市', '0', 480, 0, '', 1, 0, '', '', 0),
(3236, '阿克陶县', '0', 480, 0, '', 1, 0, '', '', 0),
(3237, '阿合奇县', '0', 480, 0, '', 1, 0, '', '', 0),
(3238, '乌恰县', '0', 480, 0, '', 1, 0, '', '', 0),
(3239, '喀什市', '0', 481, 0, '', 1, 0, '', '', 0),
(3240, '疏附县', '0', 481, 0, '', 1, 0, '', '', 0),
(3241, '疏勒县', '0', 481, 0, '', 1, 0, '', '', 0),
(3242, '英吉沙县', '0', 481, 0, '', 1, 0, '', '', 0),
(3243, '泽普县', '0', 481, 0, '', 1, 0, '', '', 0),
(3244, '莎车县', '0', 481, 0, '', 1, 0, '', '', 0),
(3245, '叶城县', '0', 481, 0, '', 1, 0, '', '', 0),
(3246, '麦盖提县', '0', 481, 0, '', 1, 0, '', '', 0),
(3247, '岳普湖县', '0', 481, 0, '', 1, 0, '', '', 0),
(3248, '伽师县', '0', 481, 0, '', 1, 0, '', '', 0),
(3249, '巴楚县', '0', 481, 0, '', 1, 0, '', '', 0),
(3250, '塔什库尔干塔吉克自治县', '0', 481, 0, '', 1, 0, '', '', 0),
(3251, '和田市', '0', 482, 0, '', 1, 0, '', '', 0),
(3252, '和田县', '0', 482, 0, '', 1, 0, '', '', 0),
(3253, '墨玉县', '0', 482, 0, '', 1, 0, '', '', 0),
(3254, '皮山县', '0', 482, 0, '', 1, 0, '', '', 0),
(3255, '洛浦县', '0', 482, 0, '', 1, 0, '', '', 0),
(3256, '策勒县', '0', 482, 0, '', 1, 0, '', '', 0),
(3257, '于田县', '0', 482, 0, '', 1, 0, '', '', 0),
(3258, '民丰县', '0', 482, 0, '', 1, 0, '', '', 0),
(3259, '伊宁市', '0', 483, 0, '', 1, 0, '', '', 0),
(3260, '奎屯市', '0', 483, 0, '', 1, 0, '', '', 0),
(3261, '伊宁县', '0', 483, 0, '', 1, 0, '', '', 0),
(3262, '察布查尔锡伯自治县', '0', 483, 0, '', 1, 0, '', '', 0),
(3263, '霍城县', '0', 483, 0, '', 1, 0, '', '', 0),
(3264, '巩留县', '0', 483, 0, '', 1, 0, '', '', 0),
(3265, '新源县', '0', 483, 0, '', 1, 0, '', '', 0),
(3266, '昭苏县', '0', 483, 0, '', 1, 0, '', '', 0),
(3267, '特克斯县', '0', 483, 0, '', 1, 0, '', '', 0),
(3268, '尼勒克县', '0', 483, 0, '', 1, 0, '', '', 0),
(3269, '塔城市', '0', 484, 0, '', 1, 0, '', '', 0),
(3270, '乌苏市', '0', 484, 0, '', 1, 0, '', '', 0),
(3271, '额敏县', '0', 484, 0, '', 1, 0, '', '', 0),
(3272, '沙湾县', '0', 484, 0, '', 1, 0, '', '', 0),
(3273, '托里县', '0', 484, 0, '', 1, 0, '', '', 0),
(3274, '裕民县', '0', 484, 0, '', 1, 0, '', '', 0),
(3275, '和布克赛尔蒙古自治县', '0', 484, 0, '', 1, 0, '', '', 0),
(3276, '阿勒泰市', '0', 485, 0, '', 1, 0, '', '', 0),
(3277, '布尔津县', '0', 485, 0, '', 1, 0, '', '', 0),
(3278, '富蕴县', '0', 485, 0, '', 1, 0, '', '', 0),
(3279, '福海县', '0', 485, 0, '', 1, 0, '', '', 0),
(3280, '哈巴河县', '0', 485, 0, '', 1, 0, '', '', 0),
(3281, '青河县', '0', 485, 0, '', 1, 0, '', '', 0),
(3282, '吉木乃县', '0', 485, 0, '', 1, 0, '', '', 0),
(3358, '钓鱼岛', '', 0, 0, '', 1, 0, '', '', 0),
(3359, '钓鱼岛', '', 3358, 0, '', 1, 0, '', '', 0),
(3360, '区域', '1', 0, 0, '', 0, 0, '', 'array (\n  ''level'' => ''2'',\n)', 1),
(3361, '环翠区', '0', 0, 1, '3361,3376,3417,3374,3378,3414,3385,3382,3375,3415', 3360, 1, '122.11734401987|37.510618015036', 'array (\n  ''level'' => ''0'',\n)', 0),
(3362, '经区', '0', 0, 1, '3362,3383,3384,3389,3416,3387,3388', 3360, 2, '122.14888143445|37.430716583374', 'array (\n  ''level'' => ''0'',\n)', 0),
(3363, '高区', '0', 0, 1, '3363,3386,3379,3377,3373,3380', 3360, 4, '122.05891478007|37.523697580224', 'array (\n  ''level'' => ''0'',\n)', 0),
(3364, '工业新区', '', 0, 0, '3364', 3360, 8, '', '', 0),
(3365, '荣成市', '0', 0, 1, '3365,3394,3392,3393,3390,3381', 3360, 5, '122.48667144775|37.165241241455', 'array (\n  ''level'' => ''0'',\n)', 0),
(3366, '文登市', '0', 0, 1, '3366,3395,3368', 3360, 6, '122.05812835693|37.193912506104', 'array (\n  ''level'' => ''0'',\n)', 0),
(3367, '乳山市', '0', 0, 1, '3367,3396,3397', 3360, 7, '121.53976440429|36.919815063476', 'array (\n  ''level'' => ''0'',\n)', 0),
(3368, '南海', '0', 3366, 0, '3368', 3360, 2, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3374, '竹岛大润发', '0', 3361, 0, '3374', 3360, 3, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3373, '田村后峰西', '0', 3363, 0, '3373', 3360, 4, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3375, '张村', '0', 3361, 0, '3375', 3360, 8, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3376, '菊花顶中心区', '0', 3361, 0, '3376', 3360, 1, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3377, '卧龙山', '0', 3363, 0, '3377', 3360, 3, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3378, '望岛戚家庄', '0', 3361, 0, '3378', 3360, 4, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3379, '利群哈工大', '0', 3363, 0, '3379', 3360, 2, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3380, '国际海水浴场', '0', 3363, 0, '3380', 3360, 5, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3381, '其他', '0', 3365, 0, '3381', 3360, 5, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3382, '温泉江家寨', '0', 3361, 0, '3382', 3360, 7, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3383, '皇冠九龙湾', '0', 3362, 0, '3383', 3360, 1, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3384, '车站蒿泊', '0', 3362, 0, '3384', 3360, 2, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3385, '半月湾', '0', 3361, 0, '3385', 3360, 6, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3386, '寨子万家疃', '0', 3363, 0, '3386', 3360, 1, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3387, '新都凤林', '0', 3362, 0, '3387', 3360, 5, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3388, '天东曲阜', '0', 3362, 0, '3388', 3360, 6, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3389, '新港', '0', 3362, 0, '3389', 3360, 3, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3390, '港西', '0', 3365, 0, '3390', 3360, 4, '', 'array (\n  ''level'' => ''0'',\n)', 1),
(3392, '成山', '', 3365, 0, '3392', 3360, 2, '', '', 0),
(3393, '石岛', '', 3365, 0, '3393', 3360, 3, '', '', 0),
(3394, '荣成市区', '', 3365, 0, '3394', 3360, 1, '', '', 0),
(3395, '文登市区', '', 3366, 0, '3395', 3360, 1, '', '', 0),
(3396, '乳山市区', '', 3367, 0, '3396', 3360, 1, '', '', 0),
(3397, '银滩', '', 3367, 0, '3397', 3360, 2, '', '', 0),
(3417, '老车站海港', '', 3361, 0, '3417', 3360, 2, '', '', 0),
(3414, '孙家疃', '', 3361, 0, '3414', 3360, 5, '', '', 0),
(3415, '羊亭', '', 3361, 0, '3415', 3360, 9, '', '', 0),
(3416, '长峰', '', 3362, 0, '3416', 3360, 4, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_log`
--

CREATE TABLE IF NOT EXISTS `h5_log` (
  `logid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(15) NOT NULL,
  `value` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(15) NOT NULL,
  `file` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `querystring` varchar(255) NOT NULL,
  `data` mediumtext NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`logid`),
  KEY `module` (`module`,`file`,`action`),
  KEY `username` (`username`,`action`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=173 ;

--
-- 导出表中的数据 `h5_log`
--

INSERT INTO `h5_log` (`logid`, `field`, `value`, `module`, `file`, `action`, `querystring`, `data`, `userid`, `username`, `ip`, `time`) VALUES
(1, '', 0, 'admin', '', 'index', '?s=admin/index/login', '', 0, '', '127.0.0.1', '2014-07-01 15:14:23'),
(2, '', 0, 'admin', '', 'index', '?s=admin/index/login', '', 0, '', '127.0.0.1', '2014-07-01 15:14:27'),
(3, '', 0, 'admin', '', 'site', '?s=admin/site/edit', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:14:59'),
(4, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:33'),
(5, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:36'),
(6, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:38'),
(7, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:38'),
(8, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:39'),
(9, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:39'),
(10, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:40'),
(11, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:40'),
(12, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:41'),
(13, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:41'),
(14, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:42'),
(15, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:43'),
(16, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:43'),
(17, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:43'),
(18, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:44'),
(19, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:44'),
(20, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:45'),
(21, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:45'),
(22, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:46'),
(23, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:46'),
(24, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:47'),
(25, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:47'),
(26, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:48'),
(27, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:48'),
(28, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:48'),
(29, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:49'),
(30, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:49'),
(31, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:50'),
(32, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:50'),
(33, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:51'),
(34, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:51'),
(35, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:52'),
(36, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:52'),
(37, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:53'),
(38, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:54'),
(39, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:54'),
(40, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:55'),
(41, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:55'),
(42, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:56'),
(43, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:56'),
(44, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:56'),
(45, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:57'),
(46, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:57'),
(47, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:58'),
(48, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:58'),
(49, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:16:59'),
(50, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:00'),
(51, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:00'),
(52, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:00'),
(53, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:01'),
(54, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:01'),
(55, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:02'),
(56, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:02'),
(57, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:02'),
(58, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:03'),
(59, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:03'),
(60, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:03'),
(61, '', 0, 'content', '', 'create_html', '?s=content/create_html/category', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:04'),
(62, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:06'),
(63, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:51'),
(64, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:52'),
(65, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:52'),
(66, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:53'),
(67, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:53'),
(68, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:53'),
(69, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:54'),
(70, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:54'),
(71, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:54'),
(72, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:54'),
(73, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:55'),
(74, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:55'),
(75, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:55'),
(76, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:56'),
(77, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:56'),
(78, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:57'),
(79, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:58'),
(80, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:17:59'),
(81, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:00'),
(82, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:01'),
(83, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:02'),
(84, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:03'),
(85, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:04'),
(86, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:05'),
(87, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:06'),
(88, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:07'),
(89, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:08'),
(90, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:09'),
(91, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:10'),
(92, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:11'),
(93, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:12'),
(94, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:13'),
(95, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:14'),
(96, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:15'),
(97, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:16'),
(98, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:17'),
(99, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:18'),
(100, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:19'),
(101, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:20'),
(102, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:21'),
(103, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:22'),
(104, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:23'),
(105, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:24'),
(106, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:25'),
(107, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:26'),
(108, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:27'),
(109, '', 0, 'content', '', 'create_html', '?s=content/create_html/show', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:18:28'),
(110, '', 0, 'collection', '', 'node', '?s=collection/node/manage', '', 1, 'admin', '127.0.0.1', '2014-07-01 15:59:26'),
(111, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:00'),
(112, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:02'),
(113, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:02'),
(114, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:02'),
(115, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:02'),
(116, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:03'),
(117, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:03'),
(118, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:03'),
(119, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:03'),
(120, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:04'),
(121, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:05'),
(122, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:05'),
(123, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:05'),
(124, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:06'),
(125, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:07'),
(126, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:08'),
(127, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:09'),
(128, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:10'),
(129, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:11'),
(130, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:12'),
(131, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:13'),
(132, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:14'),
(133, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:15'),
(134, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:16'),
(135, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:17'),
(136, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:18'),
(137, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:19'),
(138, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:20'),
(139, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:21'),
(140, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:22'),
(141, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:23'),
(142, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:24'),
(143, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:25'),
(144, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:26'),
(145, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:27'),
(146, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:28'),
(147, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:29'),
(148, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:30'),
(149, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:31'),
(150, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:32'),
(151, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:33'),
(152, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:34'),
(153, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:35'),
(154, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:36'),
(155, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:37'),
(156, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:38'),
(157, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:39'),
(158, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:40'),
(159, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:41'),
(160, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:42'),
(161, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:43'),
(162, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:44'),
(163, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:45'),
(164, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:46'),
(165, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:47'),
(166, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:48'),
(167, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:49'),
(168, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:50'),
(169, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:51'),
(170, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:52'),
(171, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:53'),
(172, '', 0, 'content', '', 'create_html', '?s=content/create_html/update_urls', '', 1, 'admin', '127.0.0.1', '2014-07-01 16:03:54');

-- --------------------------------------------------------

--
-- 表的结构 `h5_member`
--

CREATE TABLE IF NOT EXISTS `h5_member` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `encrypt` char(6) NOT NULL,
  `nickname` char(20) NOT NULL,
  `avatar` varchar(255) DEFAULT '',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `regip` char(15) NOT NULL DEFAULT '',
  `lastip` char(15) NOT NULL DEFAULT '',
  `loginnum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `email` char(32) NOT NULL DEFAULT '',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `areaid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `message` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `overduedate` int(10) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `connectid` char(35) NOT NULL DEFAULT '',
  `from` char(10) NOT NULL DEFAULT '',
  `typeid` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`(20))
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=75 ;

--
-- 导出表中的数据 `h5_member`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_broker`
--

CREATE TABLE IF NOT EXISTS `h5_member_broker` (
  `userid` mediumint(8) unsigned NOT NULL,
  `district` int(10) unsigned NOT NULL DEFAULT '0',
  `truename` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(11) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(11) NOT NULL DEFAULT '',
  `notice` mediumtext NOT NULL,
  `companyname` varchar(255) NOT NULL DEFAULT '',
  `QQ` varchar(11) NOT NULL DEFAULT '',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_broker`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_broker_identity`
--

CREATE TABLE IF NOT EXISTS `h5_member_broker_identity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(50) NOT NULL,
  `idtype` varchar(20) NOT NULL,
  `idcard_pic` varchar(100) NOT NULL,
  `broker_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `h5_member_broker_identity`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_broker_type`
--

CREATE TABLE IF NOT EXISTS `h5_member_broker_type` (
  `typeid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `starnum` tinyint(2) unsigned NOT NULL,
  `point` smallint(6) unsigned NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowmessage` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowvisit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowpostverify` tinyint(1) unsigned NOT NULL,
  `allowsearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowupgrade` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowsendmessage` tinyint(1) unsigned NOT NULL,
  `allowpostnum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowattachment` tinyint(1) unsigned NOT NULL,
  `xintui` smallint(5) unsigned NOT NULL DEFAULT '0',
  `jishou` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tuijian` smallint(5) unsigned NOT NULL DEFAULT '0',
  `zhiding` smallint(5) unsigned NOT NULL DEFAULT '0',
  `shuaxin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `total_nums` smallint(5) unsigned NOT NULL DEFAULT '0',
  `price_y` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `price_m` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `price_d` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `price_jy` decimal(8,0) unsigned NOT NULL DEFAULT '0',
  `price_jm` decimal(8,0) unsigned NOT NULL DEFAULT '0',
  `price_jd` decimal(8,0) unsigned NOT NULL DEFAULT '0',
  `icon` char(30) NOT NULL,
  `usernamecolor` char(7) NOT NULL,
  `description` char(100) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`typeid`),
  KEY `disabled` (`disabled`),
  KEY `listorder` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `h5_member_broker_type`
--

INSERT INTO `h5_member_broker_type` (`typeid`, `name`, `issystem`, `starnum`, `point`, `modelid`, `allowmessage`, `allowvisit`, `allowpost`, `allowpostverify`, `allowsearch`, `allowupgrade`, `allowsendmessage`, `allowpostnum`, `allowattachment`, `xintui`, `jishou`, `tuijian`, `zhiding`, `shuaxin`, `total_nums`, `price_y`, `price_m`, `price_d`, `price_jy`, `price_jm`, `price_jd`, `icon`, `usernamecolor`, `description`, `sort`, `disabled`) VALUES
(1, '经纪人', 1, 1, 1, 42, 0, 0, 0, 0, 0, 0, 1, 0, 1, 2, 2, 0, 0, 0, 100, 0.00, 0.00, 0.00, 0, 0, 0, 'images/group/vip.jpg', '#000000', '', 0, 0),
(2, '银牌经纪人', 1, 1, 2, 42, 0, 0, 0, 0, 0, 0, 1, 0, 1, 3, 3, 3, 0, 0, 200, 0.00, 0.00, 0.00, 0, 0, 0, 'images/group/vip.jpg', '#000000', '', 0, 0),
(3, '金牌经纪人', 1, 2, 3, 42, 0, 0, 0, 0, 0, 0, 1, 0, 1, 5, 5, 5, 1, 0, 300, 0.00, 0.00, 0.00, 0, 0, 0, 'images/group/vip.jpg', '#000000', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_member_company`
--

CREATE TABLE IF NOT EXISTS `h5_member_company` (
  `userid` mediumint(8) unsigned NOT NULL,
  `district` int(10) unsigned NOT NULL DEFAULT '0',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_company`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_daili`
--

CREATE TABLE IF NOT EXISTS `h5_member_daili` (
  `userid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_daili`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_detail`
--

CREATE TABLE IF NOT EXISTS `h5_member_detail` (
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mobile` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_detail`
--

INSERT INTO `h5_member_detail` (`userid`, `mobile`) VALUES
(2, 0),
(3, 0),
(67, 0),
(70, 0),
(71, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_member_favorite`
--

CREATE TABLE IF NOT EXISTS `h5_member_favorite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) NOT NULL DEFAULT '0',
  `houseid` smallint(5) NOT NULL DEFAULT '0',
  `catid` smallint(5) NOT NULL DEFAULT '0',
  `price` varchar(100) NOT NULL DEFAULT '',
  `tags` varchar(80) NOT NULL DEFAULT '',
  `siteid` smallint(5) NOT NULL DEFAULT '1',
  `inputtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_member_favorite`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_group`
--

CREATE TABLE IF NOT EXISTS `h5_member_group` (
  `groupid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `starnum` tinyint(2) unsigned NOT NULL,
  `point` smallint(6) unsigned NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowmessage` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowvisit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowpostverify` tinyint(1) unsigned NOT NULL,
  `allowsearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowupgrade` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowsendmessage` tinyint(1) unsigned NOT NULL,
  `allowpostnum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowattachment` tinyint(1) unsigned NOT NULL,
  `total_nums` smallint(5) unsigned NOT NULL DEFAULT '0',
  `icon` char(30) NOT NULL,
  `usernamecolor` char(7) NOT NULL,
  `description` char(100) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`),
  KEY `disabled` (`disabled`),
  KEY `listorder` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=25 ;

--
-- 导出表中的数据 `h5_member_group`
--

INSERT INTO `h5_member_group` (`groupid`, `name`, `issystem`, `starnum`, `point`, `modelid`, `allowmessage`, `allowvisit`, `allowpost`, `allowpostverify`, `allowsearch`, `allowupgrade`, `allowsendmessage`, `allowpostnum`, `allowattachment`, `total_nums`, `icon`, `usernamecolor`, `description`, `sort`, `disabled`) VALUES
(8, '游客', 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, '', '', '', 0, 0),
(2, '注册会员', 1, 2, 100, 10, 100, 0, 1, 0, 0, 1, 1, 0, 1, 20, '', '', '', 3, 0),
(6, '等级3', 1, 3, 100, 42, 100, 0, 1, 0, 0, 1, 1, 0, 1, 300, '3.gif', '', '', 3, 0),
(4, '等级1', 1, 1, 10, 42, 100, 0, 1, 0, 0, 1, 1, 0, 1, 100, '1.gif', '', '', 1, 0),
(5, '等级2', 1, 2, 50, 42, 999, 0, 1, 0, 0, 1, 1, 0, 1, 500, '2.gif', '', '', 2, 0),
(1, '禁止访问', 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, '', '', '0', 0, 0),
(7, '邮件认证', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'images/group/vip.jpg', '#000000', '', 1, 0),
(9, '中介公司', 1, 3, 200, 43, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 'images/group/vip.jpg', '#000000', '', 7, 0),
(10, '等级4', 1, 4, 200, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '4.gif', '#000000', '', 4, 0),
(11, '中级会员', 1, 3, 200, 10, 0, 0, 1, 0, 0, 1, 1, 0, 1, 30, 'images/group/vip.jpg', '#000000', '', 4, 0),
(12, '高级会员', 1, 4, 500, 10, 0, 0, 1, 0, 0, 1, 1, 0, 1, 50, 'images/group/vip.jpg', '#000000', '', 5, 0),
(13, '新手上路', 1, 1, 50, 10, 0, 0, 1, 0, 0, 1, 1, 0, 1, 10, '1.gif', '#000000', '', 2, 0),
(14, '等级5', 1, 5, 500, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '5.gif', '#000000', '', 5, 0),
(15, '等级6', 1, 6, 1000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '6.gif', '#000000', '', 6, 0),
(16, '等级7', 1, 7, 2000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '7.gif', '#000000', '', 7, 0),
(17, '等级8', 1, 8, 3000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '8.gif', '#000000', '', 8, 0),
(18, '等级9', 1, 9, 4000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '9.gif', '#000000', '', 9, 0),
(19, '等级10', 1, 10, 5000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '10.gif', '#000000', '', 10, 0),
(20, '等级11', 1, 11, 6000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '11.gif', '#000000', '', 11, 0),
(21, '等级12', 1, 12, 7000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '12.gif', '#000000', '', 12, 0),
(22, '等级13', 1, 13, 8000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '13.gif', '#000000', '', 13, 0),
(23, '等级14', 1, 14, 9000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '14.gif', '#000000', '', 14, 0),
(24, '等级15', 1, 15, 10000, 42, 0, 0, 1, 0, 0, 1, 1, 0, 1, 0, '15.gif', '#000000', '', 15, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_member_kfs`
--

CREATE TABLE IF NOT EXISTS `h5_member_kfs` (
  `userid` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_kfs`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_menu`
--

CREATE TABLE IF NOT EXISTS `h5_member_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL DEFAULT '',
  `c` char(20) NOT NULL DEFAULT '',
  `a` char(20) NOT NULL DEFAULT '',
  `data` char(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `display` enum('1','0') NOT NULL DEFAULT '1',
  `isurl` enum('1','0') NOT NULL DEFAULT '0',
  `url` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`a`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `h5_member_menu`
--

INSERT INTO `h5_member_menu` (`id`, `name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`, `isurl`, `url`) VALUES
(1, 'member_init', 0, 'member', 'index', 'init', 't=0', 0, '1', '', ''),
(2, 'account_manage', 0, 'member', 'index', 'account_manage', 't=1', 0, '1', '', ''),
(3, 'favorite', 0, 'member', 'index', 'favorite', 't=2', 0, '0', '0', ''),
(4, 'follow', 0, 'member', 'index', 'follow', 't=2', 0, '1', '0', '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_member_verify`
--

CREATE TABLE IF NOT EXISTS `h5_member_verify` (
  `userid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `encrypt` char(6) NOT NULL,
  `nickname` char(20) NOT NULL,
  `regdate` int(10) unsigned NOT NULL,
  `regip` char(15) NOT NULL,
  `email` char(32) NOT NULL,
  `modelid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `modelinfo` char(255) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `siteid` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `message` char(100) DEFAULT NULL,
  `typeid` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`(20))
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `h5_member_verify`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_member_vip`
--

CREATE TABLE IF NOT EXISTS `h5_member_vip` (
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_member_vip`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_menu`
--

CREATE TABLE IF NOT EXISTS `h5_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL DEFAULT '',
  `c` char(20) NOT NULL DEFAULT '',
  `a` char(25) NOT NULL DEFAULT '',
  `data` char(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `display` enum('1','0') NOT NULL DEFAULT '1',
  `project1` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project2` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project3` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project4` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `project5` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`a`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1968 ;

--
-- 导出表中的数据 `h5_menu`
--

INSERT INTO `h5_menu` (`id`, `name`, `parentid`, `m`, `c`, `a`, `data`, `listorder`, `display`, `project1`, `project2`, `project3`, `project4`, `project5`) VALUES
(1, 'sys_setting', 0, 'admin', 'setting', 'init', '', 8, '1', 1, 1, 1, 1, 1),
(2, 'module', 0, 'admin', 'module', 'init', '', 5, '0', 1, 1, 1, 1, 1),
(1608, 'linkage_city', 1598, 'admin', 'linkage', 'public_manage_submenu', 'keyid/3360', 11, '1', 1, 1, 1, 1, 1),
(4, 'news', 0, 'content', 'content', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(5, 'members', 0, 'member', 'member', 'init', '', 5, '1', 1, 1, 1, 1, 1),
(6, 'userinterface', 0, 'template', 'style', 'init', '', 6, '0', 1, 1, 1, 1, 1),
(30, 'correlative_setting', 1, 'admin', 'admin', 'admin', '', 1, '1', 1, 1, 1, 1, 1),
(31, 'menu_manage', 977, 'admin', 'menu', 'init', '', 8, '0', 1, 1, 1, 1, 1),
(32, 'posid_manage', 30, 'admin', 'position', 'init', '', 7, '1', 1, 1, 1, 1, 1),
(29, 'module_manage', 2, 'admin', 'module', '', '', 0, '1', 1, 1, 1, 1, 1),
(1603, 'huxing_manage', 1598, 'content', 'content', 'init', 'catid/13', 4, '1', 1, 1, 1, 1, 1),
(10, 'panel', 0, 'admin', 'index', 'public_main', '', 0, '1', 1, 1, 1, 1, 1),
(35, 'menu_add', 31, 'admin', 'menu', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(826, 'template_manager', 6, '', '', '', '', 0, '1', 1, 1, 1, 1, 1),
(54, 'admin_manage', 49, 'admin', 'admin_manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(43, 'category_manage', 975, 'admin', 'category', 'init', 'module/admin/modelid/1', 4, '1', 1, 1, 1, 1, 1),
(42, 'add_category', 43, 'admin', 'category', 'add', 's/0', 1, '1', 1, 1, 1, 1, 1),
(44, 'edit_category', 43, 'admin', 'category', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(45, 'badword_manage', 977, 'admin', 'badword', 'init', '', 10, '1', 1, 1, 1, 1, 1),
(46, 'posid_add', 32, 'admin', 'position', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(49, 'admin_setting', 1, 'admin', '', '', '', 3, '1', 1, 1, 1, 1, 1),
(50, 'role_manage', 49, 'admin', 'role', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(51, 'role_add', 50, 'admin', 'role', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(52, 'category_cache', 43, 'admin', 'category', 'public_cache', 'module/admin', 4, '1', 1, 1, 1, 1, 1),
(55, 'manage_member', 5, 'member', 'member', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(58, 'admin_add', 54, 'admin', 'admin_manage', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(59, 'model_manage', 30, 'content', 'sitemodel', 'init', '', 6, '1', 1, 1, 1, 1, 1),
(64, 'site_management', 30, 'admin', 'site', 'init', '', 1, '1', 1, 1, 1, 1, 1),
(81, 'member_add', 72, 'member', 'member', 'add', '', 2, '0', 1, 1, 1, 1, 1),
(62, 'add_model', 59, 'content', 'sitemodel', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1602, 'house_manage', 1598, 'content', 'content', 'init', 'catid/14', 1, '1', 1, 1, 1, 1, 1),
(66, 'badword_export', 45, 'admin', 'badword', 'export', '', 0, '1', 1, 1, 1, 1, 1),
(67, 'add_site', 64, 'admin', 'site', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(68, 'badword_import', 45, 'admin', 'badword', 'import', '', 0, '1', 1, 1, 1, 1, 1),
(812, 'member_group_manage', 76, 'member', 'member_group', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(74, 'member_verify', 55, 'member', 'member_verify', 'manage', 's/0', 3, '1', 1, 1, 1, 1, 1),
(76, 'manage_member_group', 5, 'member', 'member_group', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(77, 'manage_member_model', 5, 'member', 'member_model', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(78, 'member_group_add', 812, 'member', 'member_group', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(79, 'member_model_add', 813, 'member', 'member_model', 'add', '', 1, '0', 1, 1, 1, 1, 1),
(80, 'member_model_import', 77, 'member', 'member_model', 'import', '', 2, '0', 1, 1, 1, 1, 1),
(72, 'member_manage', 55, 'member', 'member', 'manage', '', 1, '1', 1, 1, 1, 1, 1),
(813, 'member_model_manage', 77, 'member', 'member_model', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(814, 'site_edit', 64, 'admin', 'site', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(815, 'site_del', 64, 'admin', 'site', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(816, 'release_point_add', 65, 'admin', 'release_point', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(817, 'release_point_del', 65, 'admin', 'release_point', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(818, 'release_point_edit', 65, 'admin', 'release_point', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(821, 'content_publish', 4, 'content', 'content', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(822, 'content_manage', 821, 'content', 'content', 'init', 'catid/6', 0, '1', 1, 1, 1, 1, 1),
(867, 'linkage', 977, 'admin', 'linkage', 'init', '', 13, '0', 1, 1, 1, 1, 1),
(827, 'template_style', 1637, 'template', 'style', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(828, 'import_style', 827, 'template', 'style', 'import', '', 0, '0', 1, 1, 1, 1, 1),
(831, 'template_export', 827, 'template', 'style', 'export', '', 0, '0', 1, 1, 1, 1, 1),
(830, 'template_file', 827, 'template', 'file', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(832, 'template_onoff', 827, 'template', 'style', 'disable', '', 0, '0', 1, 1, 1, 1, 1),
(833, 'template_updatename', 827, 'template', 'style', 'updatename', '', 0, '0', 1, 1, 1, 1, 1),
(834, 'member_lock', 72, 'member', 'member', 'lock', '', 0, '0', 1, 1, 1, 1, 1),
(835, 'member_unlock', 72, 'member', 'member', 'unlock', '', 0, '0', 1, 1, 1, 1, 1),
(836, 'member_move', 72, 'member', 'member', 'move', '', 0, '0', 1, 1, 1, 1, 1),
(837, 'member_delete', 72, 'member', 'member', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(842, 'verify_ignore', 74, 'member', 'member_verify', 'manage', 's/2', 0, '1', 1, 1, 1, 1, 1),
(839, 'member_setting', 55, 'member', 'member_setting', 'manage', '', 4, '1', 1, 1, 1, 1, 1),
(841, 'verify_pass', 74, 'member', 'member_verify', 'manage', 's/1', 0, '1', 1, 1, 1, 1, 1),
(843, 'verify_delete', 74, 'member', 'member_verify', 'manage', 's/3', 0, '0', 1, 1, 1, 1, 1),
(844, 'verify_deny', 74, 'member', 'member_verify', 'manage', 's/4', 0, '1', 1, 1, 1, 1, 1),
(845, 'never_pass', 74, 'member', 'member_verify', 'manage', 's/5', 0, '1', 1, 1, 1, 1, 1),
(846, 'template_file_list', 827, 'template', 'file', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(847, 'template_file_edit', 827, 'template', 'file', 'edit_file', '', 0, '0', 1, 1, 1, 1, 1),
(848, 'file_add_file', 827, 'template', 'file', 'add_file', '', 0, '0', 1, 1, 1, 1, 1),
(850, 'listorder', 76, 'member', 'member_group', 'sort', '', 0, '0', 1, 1, 1, 1, 1),
(852, 'priv_setting', 50, 'admin', 'role', 'priv_setting', '', 0, '0', 1, 1, 1, 1, 1),
(853, 'role_priv', 50, 'admin', 'role', 'role_priv', '', 0, '0', 1, 1, 1, 1, 1),
(857, 'attachment_manage', 821, 'attachment', 'manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(868, 'special', 821, 'special', 'special', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(869, 'template_editor', 827, 'template', 'file', 'edit_file', '', 0, '0', 1, 1, 1, 1, 1),
(870, 'template_visualization', 827, 'template', 'file', 'visualization', '', 0, '0', 1, 1, 1, 1, 1),
(871, 'pc_tag_edit', 827, 'template', 'file', 'edit_pc_tag', '', 0, '0', 1, 1, 1, 1, 1),
(873, 'release_manage', 4, 'release', 'html', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(874, 'type_manage', 975, 'content', 'type_manage', 'init', '', 6, '0', 1, 1, 1, 1, 1),
(875, 'add_type', 874, 'content', 'type_manage', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(876, 'linkageadd', 867, 'admin', 'linkage', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(877, 'failure_list', 872, 'release', 'index', 'failed', '', 0, '1', 1, 1, 1, 1, 1),
(879, 'member_search', 72, 'member', 'member', 'search', '', 0, '0', 1, 1, 1, 1, 1),
(880, 'queue_del', 872, 'release', 'index', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(881, 'member_model_delete', 813, 'member', 'member_model', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(882, 'member_model_edit', 813, 'member', 'member_model', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(885, 'workflow', 977, 'content', 'workflow', 'init', '', 15, '1', 1, 1, 1, 1, 1),
(888, 'add_workflow', 885, 'content', 'workflow', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(889, 'member_modelfield_add', 813, 'member', 'member_modelfield', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(890, 'member_modelfield_edit', 813, 'member', 'member_modelfield', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(891, 'member_modelfield_delete', 813, 'member', 'member_modelfield', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(892, 'member_modelfield_manage', 813, 'member', 'member_modelfield', 'manage', '', 0, '0', 1, 1, 1, 1, 1),
(895, 'sitemodel_import', 59, 'content', 'sitemodel', 'import', '', 0, '1', 1, 1, 1, 1, 1),
(896, 'pay', 977, 'pay', 'payment', 'pay_list', 's/3', 0, '1', 1, 1, 1, 1, 1),
(897, 'payments', 896, 'pay', 'payment', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(898, 'paylist', 896, 'pay', 'payment', 'pay_list', '', 0, '1', 1, 1, 1, 1, 1),
(899, 'add_content', 822, 'content', 'content', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(900, 'modify_deposit', 896, 'pay', 'payment', 'modify_deposit', 's/1', 0, '1', 1, 1, 1, 1, 1),
(901, 'check_content', 822, 'content', 'content', 'pass', '', 0, '0', 1, 1, 1, 1, 1),
(902, 'dbsource', 1638, 'dbsource', 'data', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(905, 'create_content_html', 873, 'content', 'create_html', 'show', '', 2, '1', 1, 1, 1, 1, 1),
(904, 'external_data_sources', 902, 'dbsource', 'dbsource_admin', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(906, 'update_urls', 873, 'content', 'create_html', 'update_urls', '', 1, '1', 1, 1, 1, 1, 1),
(960, 'node_add', 957, 'collection', 'node', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(909, 'fulltext_search', 1638, 'search', 'search_type', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(910, 'manage_type', 909, 'search', 'search_type', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(911, 'search_setting', 909, 'search', 'search_admin', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(912, 'createindex', 909, 'search', 'search_admin', 'createindex', '', 0, '1', 1, 1, 1, 1, 1),
(913, 'add_search_type', 909, 'search', 'search_type', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(914, 'database_toos', 1638, 'admin', 'database', 'export', '', 6, '1', 1, 1, 1, 1, 1),
(915, 'database_export', 914, 'admin', 'database', 'export', '', 0, '1', 1, 1, 1, 1, 1),
(916, 'database_import', 914, 'admin', 'database', 'import', '', 0, '1', 1, 1, 1, 1, 1),
(917, 'dbsource_add', 902, 'dbsource', 'dbsource_admin', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(918, 'dbsource_edit', 902, 'dbsource', 'dbsource_admin', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(919, 'dbsource_del', 902, 'dbsource', 'dbsource_admin', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(920, 'dbsource_data_add', 902, 'dbsource', 'data', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(921, 'dbsource_data_edit', 902, 'dbsource', 'data', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(922, 'dbsource_data_del', 902, 'dbsource', 'data', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(926, 'add_special', 868, 'special', 'special', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(927, 'edit_special', 868, 'special', 'special', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(928, 'special_list', 868, 'special', 'special', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(929, 'special_elite', 868, 'special', 'special', 'elite', '', 0, '0', 1, 1, 1, 1, 1),
(930, 'delete_special', 868, 'special', 'special', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(931, 'badword_add', 45, 'admin', 'badword', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(932, 'badword_edit', 45, 'admin', 'badword', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(933, 'badword_delete', 45, 'admin', 'badword', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(934, 'special_listorder', 868, 'special', 'special', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(935, 'special_content_list', 868, 'special', 'content', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(936, 'special_content_add', 935, 'special', 'content', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(937, 'special_content_list', 935, 'special', 'content', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(938, 'special_content_edit', 935, 'special', 'content', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(939, 'special_content_delete', 935, 'special', 'content', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(940, 'special_content_listorder', 935, 'special', 'content', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(941, 'special_content_import', 935, 'special', 'special', 'import', '', 0, '0', 1, 1, 1, 1, 1),
(942, 'history_version', 827, 'template', 'template_bak', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(943, 'restore_version', 827, 'template', 'template_bak', 'restore', '', 0, '0', 1, 1, 1, 1, 1),
(944, 'del_history_version', 827, 'template', 'template_bak', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(945, 'block', 821, 'block', 'block_admin', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(946, 'block_add', 945, 'block', 'block_admin', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(950, 'block_edit', 945, 'block', 'block_admin', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(951, 'block_del', 945, 'block', 'block_admin', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(952, 'block_update', 945, 'block', 'block_admin', 'block_update', '', 0, '0', 1, 1, 1, 1, 1),
(953, 'block_restore', 945, 'block', 'block_admin', 'history_restore', '', 0, '0', 1, 1, 1, 1, 1),
(954, 'history_del', 945, 'block', 'block_admin', 'history_del', '', 0, '0', 1, 1, 1, 1, 1),
(978, 'urlrule_manage', 30, 'admin', 'urlrule', 'init', '', 8, '0', 1, 1, 1, 1, 1),
(957, 'collection_node', 1639, 'collection', 'node', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(979, 'safe_config', 30, 'admin', 'setting', 'init', 'tab/2', 11, '0', 1, 1, 1, 1, 1),
(959, 'basic_config', 30, 'admin', 'setting', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(961, 'position_edit', 32, 'admin', 'position', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(962, 'collection_node_edit', 957, 'collection', 'node', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(963, 'collection_node_delete', 957, 'collection', 'node', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(990, 'col_url_list', 957, 'collection', 'node', 'col_url_list', '', 0, '0', 1, 1, 1, 1, 1),
(965, 'collection_node_publish', 957, 'collection', 'node', 'publist', '', 0, '0', 1, 1, 1, 1, 1),
(966, 'collection_node_import', 957, 'collection', 'node', 'node_import', '', 0, '0', 1, 1, 1, 1, 1),
(967, 'collection_node_export', 957, 'collection', 'node', 'export', '', 0, '0', 1, 1, 1, 1, 1),
(968, 'collection_node_collection_content', 957, 'collection', 'node', 'col_content', '', 0, '0', 1, 1, 1, 1, 1),
(969, 'googlesitemap', 977, 'admin', 'googlesitemap', 'set', '', 11, '1', 1, 1, 1, 1, 1),
(970, 'admininfo', 10, 'admin', 'admin_manage', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(971, 'editpwd', 970, 'admin', 'admin_manage', 'public_edit_pwd', '', 1, '1', 1, 1, 1, 1, 1),
(972, 'editinfo', 970, 'admin', 'admin_manage', 'public_edit_info', '', 0, '1', 1, 1, 1, 1, 1),
(973, 'keylink', 977, 'admin', 'keylink', 'init', '', 12, '1', 1, 1, 1, 1, 1),
(974, 'add_keylink', 973, 'admin', 'keylink', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(975, 'content_settings', 4, 'content', 'content_settings', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(7, 'extend', 0, 'admin', 'extend', 'init_extend', '', 7, '1', 1, 1, 1, 1, 1),
(977, 'extend_help', 7, 'admin', 'extend_all', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(1600, 'add_content', 1598, 'content', 'content', 'add', 'catid/14', 2, '0', 1, 1, 1, 1, 1),
(981, 'email_config', 30, 'admin', 'setting', 'init', 'tab/3', 13, '0', 1, 1, 1, 1, 1),
(1597, 'house', 0, 'content', 'content', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(983, 'ipbanned', 30, 'admin', 'ipbanned', 'init', '', 5, '1', 1, 1, 1, 1, 1),
(984, 'add_ipbanned', 983, 'admin', 'ipbanned', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(993, 'collection_content_import', 957, 'collection', 'node', 'import', '', 0, '0', 1, 1, 1, 1, 1),
(991, 'copy_node', 957, 'collection', 'node', 'copy', '', 0, '0', 1, 1, 1, 1, 1),
(992, 'content_del', 957, 'collection', 'node', 'content_del', '', 0, '0', 1, 1, 1, 1, 1),
(1618, 'esf_setting', 1614, 'content', 'content', 'init', '', 1, '1', 1, 1, 1, 1, 1),
(994, 'import_program_add', 957, 'collection', 'node', 'import_program_add', '', 0, '0', 1, 1, 1, 1, 1),
(995, 'import_program_del', 957, 'collection', 'node', 'import_program_del', '', 0, '0', 1, 1, 1, 1, 1),
(996, 'import_content', 957, 'collection', 'node', 'import_content', '', 0, '0', 1, 1, 1, 1, 1),
(997, 'log', 1638, 'admin', 'log', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(998, 'add_page', 43, 'admin', 'category', 'add', 's/1', 2, '1', 1, 1, 1, 1, 1),
(999, 'add_cat_link', 43, 'admin', 'category', 'add', 's/2', 2, '1', 1, 1, 1, 1, 1),
(1000, 'count_items', 43, 'admin', 'category', 'count_items', '', 5, '1', 1, 1, 1, 1, 1),
(1001, 'cache_all', 4, 'admin', 'cache_all', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1002, 'create_list_html', 873, 'content', 'create_html', 'category', '', 0, '1', 1, 1, 1, 1, 1),
(1003, 'create_html_quick', 10, 'content', 'create_html_opt', 'index', '', 0, '1', 1, 1, 1, 1, 1),
(1004, 'create_index', 1003, 'content', 'create_html', 'public_index', '', 0, '1', 1, 1, 1, 1, 1),
(1616, 'house_sale_manage', 1615, 'content', 'esf', 'init', 'catid/112', 1, '1', 1, 1, 1, 1, 1),
(1006, 'scan_report', 1005, 'scan', 'index', 'scan_report', '', 0, '1', 1, 1, 1, 1, 1),
(1007, 'md5_creat', 1005, 'scan', 'index', 'md5_creat', '', 0, '1', 1, 1, 1, 1, 1),
(1601, 'image_manage', 1598, 'content', 'content', 'init', 'catid/8', 3, '1', 1, 1, 1, 1, 1),
(1011, 'edit_content', 822, 'content', 'content', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1012, 'push_to_special', 822, 'content', 'push', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1023, 'delete_log', 997, 'admin', 'log', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1024, 'delete_ip', 983, 'admin', 'ipbanned', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1026, 'delete_keylink', 973, 'admin', 'keylink', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1027, 'edit_keylink', 973, 'admin', 'keylink', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1034, 'operation_pass', 74, 'member', 'member_verify', 'pass', '', 0, '0', 1, 1, 1, 1, 1),
(1035, 'operation_delete', 74, 'member', 'member_verify', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1039, 'operation_ignore', 74, 'member', 'member_verify', 'ignore', '', 0, '0', 1, 1, 1, 1, 1),
(1038, 'settingsave', 30, 'admin', 'setting', 'save', '', 0, '0', 1, 1, 1, 1, 1),
(1040, 'admin_edit', 54, 'admin', 'admin_manage', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1041, 'operation_reject', 74, 'member', 'member_verify', 'reject', '', 0, '0', 1, 1, 1, 1, 1),
(1042, 'admin_delete', 54, 'admin', 'admin_manage', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1043, 'card', 54, 'admin', 'admin_manage', 'card', '', 0, '0', 1, 1, 1, 1, 1),
(1044, 'creat_card', 54, 'admin', 'admin_manage', 'creat_card', '', 0, '0', 1, 1, 1, 1, 1),
(1045, 'remove_card', 54, 'admin', 'admin_manage', 'remove_card', '', 0, '0', 1, 1, 1, 1, 1),
(1049, 'member_group_edit', 812, 'member', 'member_group', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1048, 'member_edit', 72, 'member', 'member', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1050, 'role_edit', 50, 'admin', 'role', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1051, 'member_group_delete', 812, 'member', 'member_group', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1052, 'member_manage', 50, 'admin', 'role', 'member_manage', '', 0, '0', 1, 1, 1, 1, 1),
(1053, 'role_delete', 50, 'admin', 'role', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1054, 'member_model_export', 77, 'member', 'member_model', 'export', '', 0, '0', 1, 1, 1, 1, 1),
(1055, 'member_model_sort', 77, 'member', 'member_model', 'sort', '', 0, '0', 1, 1, 1, 1, 1),
(1056, 'member_model_move', 77, 'member', 'member_model', 'move', '', 0, '0', 1, 1, 1, 1, 1),
(1057, 'payment_add', 897, 'pay', 'payment', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1058, 'payment_delete', 897, 'pay', 'payment', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1059, 'payment_edit', 897, 'pay', 'payment', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1060, 'spend_record', 896, 'pay', 'spend', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1061, 'pay_stat', 896, 'pay', 'payment', 'pay_stat', '', 0, '1', 1, 1, 1, 1, 1),
(1062, 'fields_manage', 59, 'content', 'sitemodel_field', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1063, 'edit_model_content', 59, 'content', 'sitemodel', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1064, 'disabled_model', 59, 'content', 'sitemodel', 'disabled', '', 0, '0', 1, 1, 1, 1, 1),
(1065, 'delete_model', 59, 'content', 'sitemodel', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1066, 'export_model', 59, 'content', 'sitemodel', 'export', '', 0, '0', 1, 1, 1, 1, 1),
(1067, 'delete', 874, 'content', 'type_manage', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1068, 'edit', 874, 'content', 'type_manage', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1069, 'add_urlrule', 978, 'admin', 'urlrule', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1070, 'edit_urlrule', 978, 'admin', 'urlrule', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1071, 'delete_urlrule', 978, 'admin', 'urlrule', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1072, 'edit_menu', 31, 'admin', 'menu', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1073, 'delete_menu', 31, 'admin', 'menu', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1074, 'edit_workflow', 885, 'content', 'workflow', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1075, 'delete_workflow', 885, 'content', 'workflow', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1076, 'creat_html', 868, 'special', 'special', 'html', '', 0, '1', 1, 1, 1, 1, 1),
(1093, 'connect_config', 30, 'admin', 'setting', 'init', 'tab/4', 14, '0', 1, 1, 1, 1, 1),
(1102, 'view_modelinfo', 74, 'member', 'member_verify', 'modelinfo', '', 0, '0', 1, 1, 1, 1, 1),
(1202, 'create_special_list', 868, 'special', 'special', 'create_special_list', '', 0, '1', 1, 1, 1, 1, 1),
(1240, 'view_memberlinfo', 72, 'member', 'member', 'memberinfo', '', 0, '0', 1, 1, 1, 1, 1),
(1239, 'copyfrom_manage', 975, 'admin', 'copyfrom', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1614, 'esf', 0, 'content', 'content', 'init', '', 4, '1', 1, 1, 1, 1, 1),
(1241, 'move_content', 822, 'content', 'content', 'move', '', 0, '0', 1, 1, 1, 1, 1),
(1242, 'poster_template', 56, 'poster', 'space', 'poster_template', '', 0, '1', 1, 1, 1, 1, 1),
(1243, 'create_index', 873, 'content', 'create_html', 'public_index', '', 0, '1', 1, 1, 1, 1, 1),
(1244, 'add_othors', 822, 'content', 'content', 'add_othors', '', 0, '1', 1, 1, 1, 1, 1),
(1295, 'attachment_manager_dir', 857, 'attachment', 'manage', 'dir', '', 2, '1', 1, 1, 1, 1, 1),
(1296, 'attachment_manager_db', 857, 'attachment', 'manage', 'init', '', 1, '1', 1, 1, 1, 1, 1),
(1346, 'attachment_address_replace', 857, 'attachment', 'address', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(1347, 'attachment_address_update', 857, 'attachment', 'address', 'update', '', 0, '0', 1, 1, 1, 1, 1),
(1348, 'delete_content', 822, 'content', 'content', 'delete', '', 0, '1', 1, 1, 1, 1, 1),
(1617, 'house_rent_manage', 1615, 'content', 'esf', 'init', 'catid/113', 2, '1', 1, 1, 1, 1, 1),
(1350, 'member_menu_add', 1349, 'member', 'member_menu', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(1351, 'member_menu_edit', 1349, 'member', 'member_menu', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1352, 'member_menu_delete', 1349, 'member', 'member_menu', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1353, 'batch_show', 822, 'content', 'content', 'batch_show', '', 0, '1', 1, 1, 1, 1, 1),
(1354, 'pay_delete', 898, 'pay', 'payment', 'pay_del', '', 0, '0', 1, 1, 1, 1, 1),
(1355, 'pay_cancel', 898, 'pay', 'payment', 'pay_cancel', '', 0, '0', 1, 1, 1, 1, 1),
(1356, 'discount', 898, 'pay', 'payment', 'discount', '', 0, '0', 1, 1, 1, 1, 1),
(1360, 'category_batch_edit', 43, 'admin', 'category', 'batch_edit', '', 6, '1', 1, 1, 1, 1, 1),
(1361, 'plugin', 9, 'admin', 'plugin', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1362, 'appcenter', 1361, 'admin', 'plugin', 'appcenter', '', 0, '1', 1, 1, 1, 1, 1),
(1365, 'appcenter_detail', 1362, 'admin', 'plugin', 'appcenter_detail', '', 0, '0', 1, 1, 1, 1, 1),
(1366, 'install_online', 1362, 'admin', 'plugin', 'install_online', '', 0, '0', 1, 1, 1, 1, 1),
(1363, 'plugin_import', 1361, 'admin', 'plugin', 'import', '', 2, '1', 1, 1, 1, 1, 1),
(1364, 'plugin_list', 1361, 'admin', 'plugin', 'init', '', 1, '1', 1, 1, 1, 1, 1),
(1367, 'plugin_close', 1364, 'admin', 'plugin', 'status', '', 0, '0', 1, 1, 1, 1, 1),
(1368, 'uninstall_plugin', 1364, 'admin', 'plugin', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1500, 'listorder', 822, 'content', 'content', 'listorder', '', 0, '0', 1, 1, 1, 1, 1),
(1639, 'common_tools', 7, 'admin', 'admin', 'init', '', 1, '1', 1, 1, 1, 1, 1),
(1638, 'system_manage', 7, 'admin', 'admin', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(1636, 'wap_type_delete', 1630, 'wap', 'wap_admin', 'type_delete', '', 0, '0', 1, 1, 1, 1, 1),
(1507, 'comment', 977, 'comment', 'comment_admin', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1508, 'comment_manage', 975, 'comment', 'comment_admin', 'listinfo', '', 0, '1', 1, 1, 1, 1, 1),
(1509, 'comment_check', 1508, 'comment', 'check', 'checks', '', 0, '1', 1, 1, 1, 1, 1),
(1510, 'comment_list', 1507, 'comment', 'comment_admin', 'lists', '', 0, '0', 1, 1, 1, 1, 1),
(1511, 'link', 1639, 'link', 'link', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1512, 'add_link', 1511, 'link', 'link', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1513, 'edit_link', 1511, 'link', 'link', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1514, 'delete_link', 1511, 'link', 'link', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1515, 'link_setting', 1511, 'link', 'link', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(1516, 'add_type', 1511, 'link', 'link', 'add_type', '', 0, '1', 1, 1, 1, 1, 1),
(1517, 'list_type', 1511, 'link', 'link', 'list_type', '', 0, '1', 1, 1, 1, 1, 1),
(1518, 'check_register', 1511, 'link', 'link', 'check_register', '', 0, '1', 1, 1, 1, 1, 1),
(1519, 'vote', 1639, 'vote', 'vote', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1520, 'add_vote', 1519, 'vote', 'vote', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1521, 'edit_vote', 1519, 'vote', 'vote', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1522, 'delete_vote', 1519, 'vote', 'vote', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1523, 'vote_setting', 1519, 'vote', 'vote', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(1524, 'statistics_vote', 1519, 'vote', 'vote', 'statistics', '', 0, '0', 1, 1, 1, 1, 1),
(1525, 'statistics_userlist', 1519, 'vote', 'vote', 'statistics_userlist', '', 0, '0', 1, 1, 1, 1, 1),
(1526, 'create_js', 1519, 'vote', 'vote', 'create_js', '', 0, '1', 1, 1, 1, 1, 1),
(1527, 'message', 970, 'message', 'message', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1528, 'send_one', 1527, 'message', 'message', 'send_one', '', 0, '1', 1, 1, 1, 1, 1),
(1529, 'delete_message', 1527, 'message', 'message', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1530, 'message_send', 1527, 'message', 'message', 'message_send', '', 0, '0', 1, 1, 1, 1, 1),
(1531, 'message_group_manage', 1527, 'message', 'message', 'message_group_manage', '', 0, '1', 1, 1, 1, 1, 1),
(1532, 'mood', 975, 'mood', 'mood_admin', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1533, 'mood_setting', 1532, 'mood', 'mood_admin', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(1534, 'poster', 1639, 'poster', 'space', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1535, 'add_space', 1534, 'poster', 'space', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1536, 'edit_space', 1534, 'poster', 'space', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1537, 'del_space', 1534, 'poster', 'space', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1538, 'poster_list', 1534, 'poster', 'poster', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1539, 'add_poster', 1534, 'poster', 'poster', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1540, 'edit_poster', 1534, 'poster', 'poster', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1541, 'del_poster', 1534, 'poster', 'poster', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1542, 'poster_stat', 1534, 'poster', 'poster', 'stat', '', 0, '0', 1, 1, 1, 1, 1),
(1543, 'poster_setting', 1534, 'poster', 'space', 'setting', '', 0, '0', 1, 1, 1, 1, 1),
(1544, 'create_poster_js', 1534, 'poster', 'space', 'create_js', '', 0, '1', 1, 1, 1, 1, 1),
(1545, 'poster_template', 1534, 'poster', 'space', 'poster_template', '', 0, '1', 1, 1, 1, 1, 1),
(1598, 'content_publish', 1597, 'content', 'content', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1547, 'formguide_add', 1546, 'formguide', 'formguide', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1548, 'formguide_edit', 1546, 'formguide', 'formguide', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1549, 'form_info_list', 1546, 'formguide', 'formguide_info', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1550, 'formguide_disabled', 1546, 'formguide', 'formguide', 'disabled', '', 0, '0', 1, 1, 1, 1, 1),
(1551, 'formguide_delete', 1546, 'formguide', 'formguide', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1552, 'formguide_stat', 1546, 'formguide', 'formguide', 'stat', '', 0, '0', 1, 1, 1, 1, 1),
(1553, 'add_public_field', 1546, 'formguide', 'formguide_field', 'add', '', 0, '1', 1, 1, 1, 1, 1),
(1554, 'list_public_field', 1546, 'formguide', 'formguide_field', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1555, 'module_setting', 1546, 'formguide', 'formguide', 'setting', '', 0, '0', 1, 1, 1, 1, 1),
(1637, 'theme_manage', 1, 'content', 'template', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(1635, 'wap_type_edit', 1630, 'wap', 'wap_admin', 'type_edit', '', 0, '0', 1, 1, 1, 1, 1),
(1633, 'wap_delete', 1630, 'wap', 'wap_admin', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1634, 'wap_type_manage', 1630, 'wap', 'wap_admin', 'type_manage', '', 0, '0', 1, 1, 1, 1, 1),
(1630, 'wap', 1637, 'wap', 'wap_admin', 'init', '', 5, '1', 1, 1, 1, 1, 1),
(1631, 'wap_add', 1630, 'wap', 'wap_admin', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1632, 'wap_edit', 1630, 'wap', 'wap_admin', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1563, 'upgrade', 1638, 'upgrade', 'index', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1564, 'checkfile', 1563, 'upgrade', 'index', 'checkfile', '', 0, '1', 1, 1, 1, 1, 1),
(1565, 'tag', 826, 'tag', 'tag', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1566, 'add_tag', 1565, 'tag', 'tag', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1567, 'edit_tag', 1565, 'tag', 'tag', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1568, 'delete_tag', 1565, 'tag', 'tag', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(1569, 'tag_lists', 1565, 'tag', 'tag', 'lists', '', 0, '0', 1, 1, 1, 1, 1),
(1570, 'sms', 29, 'sms', 'sms', 'init', '', 0, '0', 1, 1, 1, 1, 1),
(1571, 'sms_setting', 1570, 'sms', 'sms', 'sms_setting', '', 0, '1', 1, 1, 1, 1, 1),
(1572, 'sms_pay_history', 1570, 'sms', 'sms', 'sms_pay_history', '', 0, '1', 1, 1, 1, 1, 1),
(1573, 'sms_buy_history', 1570, 'sms', 'sms', 'sms_buy_history', '', 0, '1', 1, 1, 1, 1, 1),
(1574, 'sms_api', 1570, 'sms', 'sms', 'sms_api', '', 0, '1', 1, 1, 1, 1, 1),
(1575, 'sms_sent', 1570, 'sms', 'sms', 'sms_sent', '', 0, '1', 1, 1, 1, 1, 1),
(1615, 'esf_publish', 1614, 'content', 'content', 'init', '', 2, '1', 1, 1, 1, 1, 1),
(1592, 'del_search_keyword', 1571, 'admin', 'search_keyword', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(1591, 'edit_search_keyword', 1571, 'admin', 'search_keyword', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1590, 'add_search_keyword', 1571, 'admin', 'search_keyword', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1584, 'position_delete', 32, 'admin', 'position', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1585, 'batch_remove', 822, 'content', 'content', 'remove', '', 0, '1', 1, 1, 1, 1, 1),
(1586, 'reviews_setting', 977, 'reviews', 'reviews_admin', 'setting', '', 0, '1', 1, 1, 1, 1, 1),
(1587, 'reviews_check', 1586, 'reviews', 'check', 'checks', '', 0, '1', 1, 1, 1, 1, 1),
(1588, 'reviews_list', 1586, 'reviews', 'reviews_admin', 'lists', '', 0, '1', 1, 1, 1, 1, 1),
(1593, 'batch_copy', 822, 'content', 'content', 'copyinfo', '', 0, '1', 1, 1, 1, 1, 1),
(1594, 'join_tuan', 1598, 'formguide', 'formguide_info', 'init', 'formid/17/menuid/1546', 9, '1', 1, 1, 1, 1, 1),
(1595, 'join_kft', 1598, 'content', 'content', 'init', 'catid/108', 10, '1', 1, 1, 1, 1, 1),
(1596, 'assess_content', 970, 'content', 'assess', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(1604, 'price_manage', 1598, 'content', 'content', 'init', 'catid/11', 5, '1', 1, 1, 1, 1, 1),
(1605, 'company_manage', 1598, 'content', 'content', 'init', 'catid/12', 6, '1', 1, 1, 1, 1, 1),
(1606, 'ask_manage', 1598, 'content', 'content', 'init', 'catid/15', 8, '1', 1, 1, 1, 1, 1),
(1607, 'bjdp_manage', 1598, 'content', 'content', 'init', 'catid/99', 7, '1', 1, 1, 1, 1, 1),
(1619, 'community_manage', 1614, 'content', 'content', 'init', '', 3, '1', 1, 1, 1, 1, 1),
(1620, 'community_managelist', 1619, 'content', 'community', 'init', 'catid/110', 0, '1', 1, 1, 1, 1, 1),
(1621, 'esf_buy', 1615, 'content', 'content', 'init', '', 3, '0', 1, 1, 1, 1, 1),
(1622, 'esf_rent', 1615, 'content', 'content', 'init', '', 4, '0', 1, 1, 1, 1, 1),
(1623, 'module_manage', 29, 'admin', 'module', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1624, 'ssi', 1637, 'ssi', 'ssi', 'init', '', 4, '1', 1, 1, 1, 1, 1),
(1625, 'add_ssi', 1624, 'ssi', 'ssi', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1626, 'edit_ssi', 1624, 'ssi', 'ssi', 'edit', '', 0, '0', 1, 1, 1, 1, 1),
(1627, 'delete_ssi', 1624, 'ssi', 'ssi', 'del', '', 0, '0', 1, 1, 1, 1, 1),
(1628, 'ssi_lists', 1624, 'ssi', 'ssi', 'lists', '', 0, '0', 1, 1, 1, 1, 1),
(1629, 'dir_config', 30, 'admin', 'setting', 'init', 'tab/5', 14, '0', 1, 1, 1, 1, 1),
(1640, 'member_ucenter', 77, 'member', 'member_ucenter', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(1841, 'linkage_district', 77, 'admin', 'linkage', 'public_manage_submenu', 'keyid/4000', 0, '1', 1, 1, 1, 1, 1),
(1842, 'esf_setting_manage', 1618, 'content', 'esf_setting', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(1843, 'announce', 977, 'announce', 'admin_announce', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1844, 'announce', 29, 'announce', 'admin_announce', 'init', 's=1', 0, '1', 1, 1, 1, 1, 1),
(1845, 'announce_add', 1844, 'announce', 'admin_announce', 'add', '', 0, '0', 1, 1, 1, 1, 1),
(1846, 'edit_announce', 1844, 'announce', 'admin_announce', 'edit', 's=1', 0, '0', 1, 1, 1, 1, 1),
(1847, 'check_announce', 1844, 'announce', 'admin_announce', 'init', 's=2', 0, '1', 1, 1, 1, 1, 1),
(1848, 'overdue', 1844, 'announce', 'admin_announce', 'init', 's=3', 0, '1', 1, 1, 1, 1, 1),
(1849, 'del_announce', 1844, 'announce', 'admin_announce', 'delete', '', 0, '0', 1, 1, 1, 1, 1),
(1850, 'member_broker_group_manage', 76, 'member', 'member_group', 'manage', 'modelid/42', 0, '1', 1, 1, 1, 1, 1),
(1851, 'member_broker_type', 76, 'member', 'member_broker_type', 'manage', '', 0, '1', 1, 1, 1, 1, 1),
(1852, 'manage_broker', 5, 'member', 'member', 'manage', '', 1, '1', 1, 1, 1, 1, 1),
(1853, 'manage_broker', 1852, 'member', 'member', 'manage', 'modelid/42', 0, '1', 1, 1, 1, 1, 1),
(1854, 'broker_idcard', 1852, 'member', 'member', 'identity', '', 0, '1', 1, 1, 1, 1, 1),
(1855, 'broker_cert', 1852, 'member', 'member', 'identity', 'type/1', 0, '1', 1, 1, 1, 1, 1),
(1856, 'community_avgprice', 1619, 'content', 'community', 'avgprice', 'catid/110', 0, '1', 1, 1, 1, 1, 1),
(1857, 'manage_mendian', 5, 'member', 'member', 'manage', '', 2, '1', 1, 1, 1, 1, 1),
(1858, 'manage_mendian', 1857, 'member', 'member', 'manage', 'modelid/43', 0, '1', 1, 1, 1, 1, 1),
(1963, 'House5 Player配置', 29, 'house5_player', 'house5_player', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1962, 'House5 Player配置', 29, 'house5_player', 'house5_player', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1960, 'House5_Player', 1961, 'house5_player', 'house5_player', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1966, 'room_manage', 1598, 'content', 'room', 'init', 'catid/20', 13, '1', 1, 1, 1, 1, 1),
(1965, 'building_manage', 1598, 'content', 'building', 'init', 'catid/19', 12, '1', 1, 1, 1, 1, 1),
(1964, 'video_manage', 821, 'content', 'content', 'init', 'catid/10', 3, '1', 1, 1, 1, 1, 1),
(1961, 'video_manage', 4, 'content', 'content', 'init', '', 0, '1', 1, 1, 1, 1, 1),
(1959, 'pic_manage', 821, 'content', 'content', 'init', 'catid/7', 2, '1', 1, 1, 1, 1, 1),
(1967, 'add_shapan', 822, 'content', 'content', 'addshapan', '', 0, '0', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `h5_message`
--

CREATE TABLE IF NOT EXISTS `h5_message` (
  `messageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `send_from_id` char(30) NOT NULL DEFAULT '0',
  `send_to_id` char(30) NOT NULL DEFAULT '0',
  `folder` enum('all','inbox','outbox') NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `message_time` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` char(80) DEFAULT NULL,
  `content` text NOT NULL,
  `replyid` int(10) unsigned NOT NULL DEFAULT '0',
  `del_type` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`messageid`),
  KEY `msgtoid` (`send_to_id`,`folder`),
  KEY `replyid` (`replyid`),
  KEY `folder` (`send_from_id`,`folder`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_message`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_message_data`
--

CREATE TABLE IF NOT EXISTS `h5_message_data` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) NOT NULL,
  `group_message_id` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `message` (`userid`,`group_message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_message_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_message_group`
--

CREATE TABLE IF NOT EXISTS `h5_message_group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupid` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '?????id',
  `subject` char(80) DEFAULT NULL,
  `content` text NOT NULL COMMENT '????',
  `inputtime` int(10) unsigned DEFAULT '0',
  `status` tinyint(2) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_message_group`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_model`
--

CREATE TABLE IF NOT EXISTS `h5_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL,
  `description` char(100) NOT NULL,
  `tablename` char(20) NOT NULL,
  `setting` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `items` smallint(5) unsigned NOT NULL DEFAULT '0',
  `enablesearch` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `default_style` char(30) NOT NULL,
  `category_template` char(30) NOT NULL,
  `list_template` char(30) NOT NULL,
  `show_template` char(30) NOT NULL,
  `js_template` varchar(30) NOT NULL,
  `admin_list_template` char(20) NOT NULL,
  `member_add_template` char(20) NOT NULL,
  `member_list_template` char(20) NOT NULL,
  `sort` tinyint(3) NOT NULL,
  `type` tinyint(1) NOT NULL,
  PRIMARY KEY (`modelid`),
  KEY `type` (`type`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=44 ;

--
-- 导出表中的数据 `h5_model`
--

INSERT INTO `h5_model` (`modelid`, `siteid`, `name`, `description`, `tablename`, `setting`, `addtime`, `items`, `enablesearch`, `disabled`, `default_style`, `category_template`, `list_template`, `show_template`, `js_template`, `admin_list_template`, `member_add_template`, `member_list_template`, `sort`, `type`) VALUES
(1, 1, '文章模型', '', 'news', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(3, 1, '图片模型', '', 'picture', '', 0, 0, 1, 0, 'default', 'category_picture', 'list_picture', 'show_picture', '', '', '', '', 0, 0),
(10, 1, '普通会员', '普通会员', 'member_detail', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 0, 2),
(13, 1, '房产模型', '', 'house', '', 0, 0, 1, 0, 'default', 'category_house', 'list_house', 'show_house', '', '', '', '', 0, 0),
(14, 1, '销售动态', '', 'dynamic', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 0, 0),
(15, 1, '价格明细', '', 'price', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 0, 0),
(16, 1, '公司库', '', 'company', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 0, 0),
(17, 1, '团购报名', '', 'tuangou', 'array (\n  ''enabletime'' => ''0'',\n  ''starttime'' => ''1331827200'',\n  ''endtime'' => '''',\n  ''sendmail'' => ''0'',\n  ''mails'' => '''',\n  ''allowmultisubmit'' => ''1'',\n  ''allowunreg'' => ''1'',\n)', 1331875502, 7, 1, 0, 'default', '', '', 'show', 'show_js', '', '', '', 0, 3),
(18, 1, '问房', '', 'ask', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(23, 2, '资讯', '', 'ytnews', '', 0, 0, 1, 0, 'default', 'category_news', 'list', 'show', '', '', '', '', 0, 0),
(20, 1, '看房团', '加入看房团', 'kanfang', 'array (\n  ''enabletime'' => ''0'',\n  ''starttime'' => ''1336665600'',\n  ''endtime'' => '''',\n  ''sendmail'' => ''0'',\n  ''mails'' => '''',\n  ''allowmultisubmit'' => ''1'',\n  ''allowunreg'' => ''1'',\n)', 1336727273, 51, 1, 0, 'default', '', '', 'show', 'show_js', '', '', '', 0, 3),
(21, 2, '新房', '', 'ythouse', '', 0, 0, 1, 0, 'default', 'category_house', 'list_house', 'show_house', '', '', '', '', 0, 0),
(22, 2, '公司库', '', 'ytcompany', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show_company', '', '', '', '', 0, 0),
(24, 2, '图片', '', 'ytpicture', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(25, 2, '问房', '', 'ytask', '', 0, 0, 1, 0, 'yantai', 'category', 'list', 'show', '', '', '', '', 0, 0),
(26, 1, '成交数据', '每日成交数据', 'selldata', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(27, 2, '团购报名', '', 'yt_tuangou', 'array (\n  ''enabletime'' => ''0'',\n  ''starttime'' => ''1342540800'',\n  ''endtime'' => '''',\n  ''sendmail'' => ''0'',\n  ''mails'' => '''',\n  ''allowmultisubmit'' => ''1'',\n  ''allowunreg'' => ''1'',\n)', 1342593980, 0, 1, 0, 'yantai', '', '', 'show', 'show_js', '', '', '', 0, 3),
(28, 1, '编辑点评', '', 'dianping', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(34, 1, '房源', '', 'housesell', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(35, 1, '代理商', '楼盘代理商、分销商', 'member_daili', '', 0, 0, 1, 1, '', '', '', '', '', '', '', '', 0, 2),
(36, 1, '开发商', '楼盘开发商', 'member_kfs', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 0, 2),
(37, 1, '看房团', '', 'kanfang', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(39, 1, '二手房出售', '', 'esf', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(40, 1, '小区', '', 'community', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(41, 1, '二手房出租', '', 'esf_rent', '', 0, 0, 1, 0, 'default', 'category', 'list', 'show', '', '', '', '', 0, 0),
(42, 1, '经纪人', '经纪人', 'member_broker', '', 0, 0, 1, 0, '', '', '', '', '', '', '', '', 2, 2),
(43, 1, '中介公司', '中介公司', 'member_company', '', 0, 0, 1, 1, '', '', '', '', '', '', '', '', 3, 2),
(4, 1, '图库模型', '', 'pic', '', 0, 0, 1, 0, 'house5-style1', 'category_picture', 'list_picture', 'show_picture', '', '', '', '', 0, 0),
(5, 1, '视频模型', '', 'video', '', 0, 0, 1, 0, 'house5-style1', 'category_video', 'list_video', 'show_video', '', '', '', '', 0, 0),
(29, 1, '楼栋', '', 'building', '', 0, 0, 1, 0, 'house5-style1', 'category', 'list', 'show', '', '', '', '', 0, 0),
(30, 1, '房间', '', 'room', '', 0, 0, 1, 0, 'house5-style1', 'category', 'list', 'show', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_model_field`
--

CREATE TABLE IF NOT EXISTS `h5_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tips` text NOT NULL,
  `css` varchar(30) NOT NULL,
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `pattern` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `formtype` varchar(20) NOT NULL,
  `setting` mediumtext NOT NULL,
  `formattribute` varchar(255) NOT NULL,
  `unsetgroupids` varchar(255) NOT NULL,
  `unsetroleids` varchar(255) NOT NULL,
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isunique` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isbase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isfulltext` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isposition` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isomnipotent` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`,`disabled`),
  KEY `field` (`field`,`modelid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1316 ;

--
-- 导出表中的数据 `h5_model_field`
--

INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(1, 1, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(2, 1, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(3, 1, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(4, 1, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(5, 1, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(574, 28, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(6, 1, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(7, 1, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(8, 1, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => '''',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(9, 1, 1, 'voteid', '添加投票', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''text\\'' name=\\''info[voteid]\\'' id=\\''voteid\\'' value=\\''{FIELD_VALUE}\\'' size=\\''3\\''> \r\n<input type=\\''button\\'' value="选择已有投票" onclick="omnipotent(\\''selectid\\'',\\''?s=vote/vote/public_get_votelist/from_api/1\\'',\\''选择已有投票\\'')" class="button">\r\n<input type=\\''button\\'' value="新增投票" onclick="omnipotent(\\''addvote\\'',\\''?s=vote/vote/add/from_api/1\\'',\\''添加投票\\'',0)" class="button">'',\n  ''fieldtype'' => ''mediumint'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 1, 0, 21, 0, 0),
(10, 1, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(11, 1, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(12, 1, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(13, 1, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(14, 1, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(15, 1, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(16, 1, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(17, 1, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(1091, 40, 1, 'video', '视频', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 45, 0, 0),
(19, 1, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/{MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(20, 1, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(21, 1, 1, 'copyfrom', '来源', '', '', 0, 100, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 1, 8, 0, 0),
(80, 1, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(51, 3, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(52, 3, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(53, 3, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(54, 3, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(55, 3, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(56, 3, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(57, 3, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(58, 3, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(59, 3, 1, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 0, 0),
(60, 3, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(61, 3, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 1, 0),
(62, 3, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(63, 3, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 1, 0),
(64, 3, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(65, 3, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0),
(66, 3, 1, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(67, 3, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(68, 3, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(69, 3, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(70, 3, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(71, 3, 1, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 0, 0),
(72, 3, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(73, 1, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 30, 0, 0),
(75, 3, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(806, 37, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(145, 13, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(146, 13, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n  ''size'' => '''',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 24, 1, 0),
(143, 13, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(144, 13, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(142, 13, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(135, 13, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 205, 1, 0),
(136, 13, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 20, 0, 0),
(137, 13, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 203, 0, 0),
(138, 13, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 204, 1, 0),
(139, 13, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(140, 13, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(141, 13, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(133, 13, 1, 'thumb', '缩略图', '', '', 0, 100, '', '请上传缩略图', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 14, 0, 0),
(134, 13, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/1\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(1,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 16, 0, 0),
(131, 13, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(132, 13, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 49, 0, 0),
(129, 13, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 10, 0, 0),
(130, 13, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 202, 1, 0),
(128, 13, 1, 'title', '楼盘名称', '', 'inputtitle', 1, 80, '', '请输入楼盘名称', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 2, 0, 0),
(127, 13, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 200, 1, 0),
(126, 13, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(147, 13, 1, 'type', '房屋类型', '', '', 0, 0, '', '请选择房屋类型', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''100'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 4, 0, 0),
(179, 13, 1, 'fix', '装修状况', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n简装修|2\r\n精装修|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 8, 0, 0),
(176, 13, 1, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '请指定区域', 'linkage', 'array (\n  ''linkageid'' => ''3360'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 5, 0, 0),
(178, 13, 1, 'bbs', '业主论坛', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 45, 0, 0),
(150, 13, 1, 'type2', '建筑类别', '', '', 1, 0, '', '请选择建筑类别', 'box', 'array (\n  ''options'' => ''高层|1\r\n多层|2\r\n小高层|3\r\n联排别墅|4\r\n双拼别墅|5\r\n独栋别墅|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(177, 13, 1, 'xszt', '销售状态', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''在售|1\r\n即将上市|2\r\n尾盘|3\r\n售完|4'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 6, 0, 0),
(172, 13, 1, 'jdtime', '接待时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 37, 0, 0),
(151, 13, 1, 'type3', '房屋属性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''待定|0\r\n期房|1\r\n现房|2\r\n商品房|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(152, 13, 1, 'fcznx', '房产证年限', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''70 年'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(267, 13, 1, 'character', '楼盘特色', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''小户型|2\r\n公园地产|3\r\n学区房|4\r\n旅游地产|5\r\n投资地产|6\r\n海景地产|7\r\n经济住宅|8\r\n宜居生态地产|9'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(154, 13, 1, 'area', '项目四至', '（东南西北分别毗邻哪里）', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''70'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(155, 13, 1, 'huxing', '主力户型', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(156, 13, 1, 'jiaotong', '交通状况', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''80'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 14, 0, 0),
(157, 13, 1, 'address', '楼盘地址', '', '', 1, 0, '', '请输入楼盘地址', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 17, 0, 0),
(158, 13, 1, 'qqqun', '业主QQ群', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 19, 0, 0),
(159, 13, 1, 'progress', '工程进度', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 18, 0, 0),
(160, 13, 1, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 21, 0, 0),
(161, 13, 1, 'jfdate', '交房时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 22, 0, 0),
(162, 13, 1, 'zdmj', '占地面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 23, 0, 0),
(163, 13, 1, 'jzmj', '建筑面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 25, 0, 0),
(164, 13, 1, 'far', '容积率', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''7'',\n  ''decimaldigits'' => ''-1'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 26, 0, 0),
(165, 13, 1, 'gt', '公摊', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 27, 0, 0),
(166, 13, 1, 'lhl', '绿化率', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 28, 0, 0),
(167, 13, 1, 'kftime', '开发周期', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 29, 0, 0),
(168, 13, 1, 'cws', '车位数', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 32, 0, 0),
(169, 13, 1, 'cwf', '车位费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 31, 0, 0),
(170, 13, 1, 'license', '销售许可证', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 35, 0, 0),
(171, 13, 1, 'office', '售楼处', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 36, 0, 0),
(173, 13, 1, 'tel', '售楼电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 38, 0, 0),
(180, 13, 1, 'payment', '付款方式', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''一次性付款/商业贷款'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 34, 0, 0),
(181, 13, 1, 'price', '参考价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 33, 0, 0),
(182, 13, 1, 'jzdw', '建筑单位', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 39, 0, 0),
(183, 13, 1, 'jgsj', '景观设计', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 47, 0, 0),
(184, 13, 1, 'siteurl', '项目网站', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 48, 0, 0),
(185, 13, 1, 'wyf', '物业费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 46, 0, 0),
(186, 14, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(187, 14, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(188, 14, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(189, 14, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(190, 14, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(191, 14, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(192, 14, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(193, 14, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(194, 14, 1, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(195, 14, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(196, 14, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(197, 14, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(198, 14, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(199, 14, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(200, 14, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(201, 14, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(202, 14, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(203, 14, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(204, 14, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(205, 14, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(206, 14, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(207, 15, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(208, 15, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(209, 15, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(210, 15, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(211, 15, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(212, 15, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(213, 15, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(214, 15, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(215, 15, 1, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 0, 0, 1, 0, 15, 0, 0),
(216, 15, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(217, 15, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(218, 15, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(219, 15, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(220, 15, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(221, 15, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(222, 15, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(223, 15, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(224, 15, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(225, 15, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(226, 15, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(227, 15, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(228, 15, 1, 'price', '价格', '必须为数字，不要写单位', '', 1, 0, '/^[0-9.-]+$/', '请填写价格', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(229, 15, 1, 'trend', '涨跌', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''-|0\r\n↑|1\r\n↓|2'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(230, 15, 1, 'addtime', '记录时间', '', '', 0, 0, '/^\\d{4}(\\-)\\d{1,2}(\\-)\\d{1,2}$/', '请指定记录时间', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(231, 14, 1, 'addtime', '记录时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(232, 13, 1, 'xglp', '相关楼盘', '用于互相切换', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xglp]\\'' id=\\''xglp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_lp_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist/type/relationlp/modelid/{MODELID}/id/{ID}\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation1({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 40, 0, 0),
(233, 16, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(234, 16, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(235, 16, 1, 'title', '公司名称', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(236, 16, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(237, 16, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(238, 16, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(239, 16, 1, 'content', '公司简介', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(240, 16, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(241, 16, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(242, 16, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(243, 16, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(244, 16, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(245, 16, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(246, 16, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(247, 16, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(248, 16, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(249, 16, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(250, 16, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(251, 16, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(252, 16, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(253, 16, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(254, 16, 1, 'address', '公司地址', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''80'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(255, 16, 1, 'email', '电子邮件', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(256, 16, 1, 'siteurl', '公司网站', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 7, 0, 0),
(257, 16, 1, 'manager', '负 责 人', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 8, 0, 0),
(258, 16, 1, 'contact', '联 系 人', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 9, 0, 0),
(259, 16, 1, 'tel', '联系电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(260, 16, 1, 'fax', '传　　真', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(261, 16, 1, 'level', '资质等级', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(262, 13, 1, 'developer', '开发商', '', '', 1, 0, '', '请选择开发商', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[developer]\\'' id=\\''developer\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="developer_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&type=developer&modelid=16&typeid=8\\'',\\''添加开发商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''developer\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 41, 0, 0),
(263, 13, 1, 'investor', '投资商', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[investor]\\'' id=\\''investor\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="investor_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=investor&typeid=9\\'',\\''添加投资商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''investor\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 42, 0, 0),
(264, 13, 1, 'agency', '代理公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[agency]\\'' id=\\''agency\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="agency_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=agency&typeid=10\\'',\\''添加代理公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''agency\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 43, 0, 0);
INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(265, 13, 1, 'property', '物业公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[property]\\'' id=\\''property\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="property_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=property&typeid=11\\'',\\''添加物业公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''property\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 44, 0, 0),
(266, 13, 1, 'zbpt', '周边配套', '', '', 0, 0, '', '', 'textarea', 'array (\n  ''width'' => ''90'',\n  ''height'' => ''85'',\n  ''defaultvalue'' => ''学校(学区)：\r\n幼儿园：\r\n综合商场：\r\n银　行：\r\n医　院：\r\n其　它：'',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 15, 0, 0),
(270, 13, 1, 'map', '地图', '', '', 0, 0, '', '', 'map', 'array (\n  ''maptype'' => ''2'',\n  ''api_key'' => ''B7abf7d30009a9979fbfbc93ef485321'',\n  ''defaultcity'' => ''威海'',\n  ''hotcitys'' => '''',\n  ''width'' => ''650'',\n  ''height'' => ''250'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 48, 0, 0),
(1315, 37, 1, 'initialtuan', '初始报名数', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''0'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(269, 13, 1, 'pic', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(271, 17, 1, 'name', '姓名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
(272, 17, 1, 'tel', '电话', '', '', 1, 0, '/^(1)[0-9]{10}$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0),
(273, 17, 1, 'qq', 'qq', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(274, 17, 1, 'relation', '楼盘id', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(275, 13, 1, 'range', '价格区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''3000以下|1\r\n3000-4000|2\r\n4000-5000|3\r\n5000-6000|4\r\n6000-7000|5\r\n7000-8000|6\r\n8000-10000|7\r\n10000以上|8'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 34, 0, 0),
(276, 1, 1, 'xglp', '相关楼盘', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xglp]\\'' id=\\''xglp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="xglp_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlp_list/modelid/13/id/{ID}\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(13,{MODELID},{ID},\\''xglp\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 0),
(277, 17, 1, 'subject', '楼盘名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(278, 17, 1, 'regionid', '区域id', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0),
(280, 17, 1, 'region', '区域', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 0),
(279, 17, 1, 'price', '参考价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0),
(281, 17, 1, 'gender', '性别', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''男|1\r\n女|2'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''cols'' => ''5'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0),
(282, 13, 1, 'hot', '楼盘定性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''热门楼盘|4\r\n最新楼盘|5\r\n精品楼盘|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(283, 18, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(284, 18, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(285, 18, 1, 'title', '标题', '', 'inputtitle', 1, 255, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(286, 18, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(287, 18, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(288, 18, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(289, 18, 1, 'content', '答', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 0, '', '', 'editor', 'array (\n  ''toolbar'' => ''basic'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''0'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 6, 0, 0),
(290, 18, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(291, 18, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(292, 18, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(293, 18, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(294, 18, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(295, 18, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(296, 18, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(297, 18, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(298, 18, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(299, 18, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(300, 18, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(301, 18, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(302, 18, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(303, 18, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(309, 18, 1, 'ip', 'ip', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 10, 0, 0),
(306, 18, 1, 'isreply', '已回复', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''未回答|0\r\n已回答|1'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 7, 0, 0),
(310, 18, 1, 'question', '问', '', '', 1, 0, '', '', 'textarea', 'array (\n  ''width'' => ''100%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 5, 0, 0),
(308, 18, 1, 'region', '区域', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(311, 18, 1, 'xglp', '相关楼盘', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 8, 0, 0),
(312, 18, 1, 'housename', '楼盘名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 8, 0, 0),
(313, 13, 1, 'priceunit', '价格单位', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''元/平方米|0\r\n元/套|2'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 33, 0, 0),
(314, 13, 1, 'video', '视频', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 45, 0, 0),
(469, 23, 2, 'xglp', '相关楼盘', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xglp]\\'' id=\\''xglp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="xglp_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlp_list&modelid=13&id={ID}\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(13,{MODELID},{ID},\\''xglp\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 0),
(468, 23, 2, 'copyfrom', '来源', '', '', 0, 100, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(463, 23, 2, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(464, 23, 2, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 0, 0),
(465, 23, 2, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(466, 23, 2, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 30, 0, 0),
(467, 23, 2, 'voteid', '添加投票', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''text\\'' name=\\''info[voteid]\\'' id=\\''voteid\\'' value=\\''{FIELD_VALUE}\\'' size=\\''3\\''> \r\n<input type=\\''button\\'' value="选择已有投票" onclick="omnipotent(\\''selectid\\'',\\''?s=vote/vote/public_get_votelist&from_api=1\\'',\\''选择已有投票\\'')" class="button">\r\n<input type=\\''button\\'' value="新增投票" onclick="omnipotent(\\''addvote\\'',\\''?s=vote/vote/add&from_api=1\\'',\\''添加投票\\'',0)" class="button">'',\n  ''fieldtype'' => ''mediumint'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 1, 0, 21, 0, 0),
(461, 23, 2, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(462, 23, 2, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(455, 23, 2, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(456, 23, 2, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(457, 23, 2, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(458, 23, 2, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(459, 23, 2, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(460, 23, 2, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(454, 23, 2, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(453, 23, 2, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(452, 23, 2, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(451, 23, 2, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(446, 23, 2, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(447, 23, 2, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(448, 23, 2, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(449, 23, 2, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(450, 23, 2, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(1090, 40, 1, 'hot', '小区定性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''热门小区|4\r\n最新小区|5\r\n精品小区|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(340, 1, 1, 'newstype', '视频新闻', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(341, 20, 1, 'name', '姓名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
(342, 20, 1, 'tel', '手机', '', '', 1, 0, '/^(1)[0-9]{10}$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0),
(343, 20, 1, 'gender', '性别', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''男|1\r\n女|2'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''cols'' => ''5'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(344, 20, 1, 'qq', 'QQ', '', '', 0, 0, '/^[0-9]{5,20}$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0),
(348, 21, 2, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(347, 13, 1, 'ename', '英文首字母', '例如“营创美域”，那么此处填写ycmy', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 3, 0, 0),
(349, 21, 2, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 200, 1, 0),
(350, 21, 2, 'title', '楼盘名称', '', 'inputtitle', 1, 80, '', '请输入楼盘名称', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 2, 0, 0),
(351, 21, 2, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 10, 0, 0),
(352, 21, 2, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 202, 1, 0),
(353, 21, 2, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(354, 21, 2, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 49, 0, 0),
(355, 21, 2, 'thumb', '缩略图', '', '', 0, 100, '', '请上传缩略图', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 14, 0, 0),
(356, 21, 2, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=1\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(1,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 16, 0, 0),
(357, 21, 2, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 205, 1, 0),
(358, 21, 2, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 20, 0, 0),
(359, 21, 2, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 203, 0, 0),
(360, 21, 2, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 204, 1, 0),
(361, 21, 2, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(362, 21, 2, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(363, 21, 2, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(364, 21, 2, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(365, 21, 2, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(366, 21, 2, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(367, 21, 2, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(368, 21, 2, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n  ''size'' => '''',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 24, 1, 0),
(369, 21, 2, 'type', '房屋类型', '', '', 0, 0, '', '请选择房屋类型', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''100'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 4, 0, 0),
(370, 21, 2, 'fix', '装修状况', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n简装修|2\r\n精装修|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 8, 0, 0),
(371, 21, 2, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '请指定区域', 'linkage', 'array (\n  ''linkageid'' => ''3398'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 5, 0, 0),
(372, 21, 2, 'bbs', '业主论坛', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 45, 0, 0),
(373, 21, 2, 'type2', '建筑类别', '', '', 1, 0, '', '请选择建筑类别', 'box', 'array (\n  ''options'' => ''高层|1\r\n多层|2\r\n小高层|3\r\n联排别墅|4\r\n双拼别墅|5\r\n独栋别墅|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(374, 21, 2, 'xszt', '销售状态', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''在售|1\r\n即将上市|2\r\n尾盘|3\r\n售完|4'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 6, 0, 0),
(375, 21, 2, 'jdtime', '接待时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 37, 0, 0),
(376, 21, 2, 'type3', '房屋属性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''待定|0\r\n期房|1\r\n现房|2\r\n商品房|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(377, 21, 2, 'fcznx', '房产证年限', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''70 年'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(378, 21, 2, 'character', '楼盘特色', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''优惠楼盘|1\r\n小户型|2\r\n公园地产|3\r\n学区房|4\r\n旅游地产|5\r\n投资地产|6\r\n海景地产|7\r\n经济住宅|8\r\n宜居生态地产|9'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(379, 21, 2, 'area', '项目四至', '（东南西北分别毗邻哪里）', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''70'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(380, 21, 2, 'huxing', '主力户型', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(381, 21, 2, 'jiaotong', '交通状况', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''80'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 14, 0, 0),
(382, 21, 2, 'address', '楼盘地址', '', '', 1, 0, '', '请输入楼盘地址', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 17, 0, 0),
(383, 21, 2, 'qqqun', '业主QQ群', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 19, 0, 0),
(384, 21, 2, 'progress', '工程进度', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 18, 0, 0),
(497, 21, 2, 'jfdate', '入住时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 22, 0, 0),
(496, 21, 2, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 21, 0, 0),
(387, 21, 2, 'zdmj', '占地面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 23, 0, 0),
(388, 21, 2, 'jzmj', '建筑面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 25, 0, 0),
(389, 21, 2, 'far', '容积率', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''7'',\n  ''decimaldigits'' => ''-1'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 26, 0, 0),
(390, 21, 2, 'gt', '公摊', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 27, 0, 0),
(391, 21, 2, 'lhl', '绿化率', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 28, 0, 0),
(392, 21, 2, 'kftime', '开发周期', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 29, 0, 0),
(393, 21, 2, 'cws', '车位数', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 32, 0, 0),
(394, 21, 2, 'cwf', '车位费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 31, 0, 0),
(395, 21, 2, 'license', '销售许可证', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 35, 0, 0),
(396, 21, 2, 'office', '售楼处', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 36, 0, 0),
(397, 21, 2, 'tel', '售楼电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 38, 0, 0),
(398, 21, 2, 'payment', '付款方式', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''一次性付款/商业贷款'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 34, 0, 0),
(399, 21, 2, 'price', '参考均价', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 33, 0, 0),
(400, 21, 2, 'jzdw', '建筑单位', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 39, 0, 0),
(401, 21, 2, 'jgsj', '景观设计', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 47, 0, 0),
(402, 21, 2, 'siteurl', '项目网站', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 48, 0, 0),
(403, 21, 2, 'wyf', '物业费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 46, 0, 0),
(404, 21, 2, 'xglp', '相关楼盘', '用于互相切换', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xglp]\\'' id=\\''xglp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_lp_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&type=relationlp&modelid={MODELID}&id={ID}\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation1({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 40, 0, 0),
(405, 21, 2, 'developer', '开发商', '', '', 1, 0, '', '请选择开发商', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[developer]\\'' id=\\''developer\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="developer_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&type=developer&modelid=22&typeid=43\\'',\\''添加开发商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(22,{MODELID},{ID},\\''developer\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 41, 0, 0),
(406, 21, 2, 'investor', '投资商', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[investor]\\'' id=\\''investor\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="investor_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=investor&typeid=9\\'',\\''添加投资商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''investor\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 42, 0, 0),
(407, 21, 2, 'agency', '代理公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[agency]\\'' id=\\''agency\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="agency_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=agency&typeid=10\\'',\\''添加代理公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''agency\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 43, 0, 0),
(408, 21, 2, 'property', '物业公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[property]\\'' id=\\''property\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="property_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=property&typeid=11\\'',\\''添加物业公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''property\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 44, 0, 0),
(409, 21, 2, 'zbpt', '周边配套', '', '', 0, 0, '', '', 'textarea', 'array (\n  ''width'' => ''90'',\n  ''height'' => ''85'',\n  ''defaultvalue'' => ''学校(学区)：\r\n幼儿园：\r\n综合商场：\r\n银　行：\r\n医　院：\r\n其　它：'',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 15, 0, 0),
(410, 21, 2, 'map', '地图', '', '', 0, 0, '', '', 'map', 'array (\r\n  ''maptype'' => ''1'',\n  ''api_key'' => ''db4fb4013c14680641a99e4fdbb5158325d0530d2d6f48d4e2c47e7bbdac7d5484c8a88194b349c5'',\n  ''defaultcity'' => ''烟台'',\n  ''hotcitys'' => '''',\n  ''width'' => ''650'',\n  ''height'' => ''250'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 48, 0, 0),
(411, 21, 2, 'pic', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(412, 21, 2, 'range', '价格区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''3000以下|1\r\n3000-4000|2\r\n4000-5000|3\r\n5000-6000|4\r\n6000-7000|5\r\n7000-8000|6\r\n8000-10000|7\r\n10000以上|8'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 34, 0, 0),
(413, 21, 2, 'hot', '楼盘定性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''在售楼盘|2\r\n即将上市|3\r\n热门楼盘|4\r\n最新楼盘|5\r\n精品楼盘|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(414, 21, 2, 'priceunit', '价格单位', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''元/平方米|0\r\n元/套|2'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 33, 0, 0),
(415, 21, 2, 'video', '视频', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 45, 0, 0),
(416, 21, 2, 'ename', '英文首字母', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 3, 0, 0),
(417, 22, 2, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(418, 22, 2, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(419, 22, 2, 'title', '公司名称', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(420, 22, 2, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(421, 22, 2, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(422, 22, 2, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(423, 22, 2, 'content', '公司简介', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(424, 22, 2, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(425, 22, 2, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(426, 22, 2, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(427, 22, 2, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(428, 22, 2, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(429, 22, 2, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(430, 22, 2, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(431, 22, 2, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(432, 22, 2, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(433, 22, 2, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(434, 22, 2, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(435, 22, 2, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(436, 22, 2, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(437, 22, 2, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(438, 22, 2, 'address', '公司地址', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''80'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0);
INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(439, 22, 2, 'email', '电子邮件', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(440, 22, 2, 'siteurl', '公司网站', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 7, 0, 0),
(441, 22, 2, 'manager', '负 责 人', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 8, 0, 0),
(442, 22, 2, 'contact', '联 系 人', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 9, 0, 0),
(443, 22, 2, 'tel', '联系电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(444, 22, 2, 'fax', '传　　真', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(445, 22, 2, 'level', '资质等级', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(470, 23, 2, 'newstype', '视频新闻', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(471, 23, 2, 'recom', '首页栏目推荐', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 1, 0),
(472, 24, 2, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(473, 24, 2, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(474, 24, 2, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(475, 24, 2, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0),
(476, 24, 2, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 1, 0),
(477, 24, 2, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(478, 24, 2, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 1, 0),
(479, 24, 2, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(480, 24, 2, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=21\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(21,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 0, 0),
(481, 24, 2, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(482, 24, 2, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(483, 24, 2, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(484, 24, 2, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(485, 24, 2, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(486, 24, 2, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(487, 24, 2, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(488, 24, 2, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(489, 24, 2, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(490, 24, 2, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(491, 24, 2, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(492, 24, 2, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(493, 24, 2, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 0, 0),
(494, 24, 2, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(495, 21, 2, 'houseurl', '源地址', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(498, 25, 2, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(499, 25, 2, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(500, 25, 2, 'title', '标题', '', 'inputtitle', 1, 255, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(501, 25, 2, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(502, 25, 2, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(503, 25, 2, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(504, 25, 2, 'content', '答', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 0, '', '', 'editor', 'array (\n  ''toolbar'' => ''basic'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''0'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 6, 0, 0),
(505, 25, 2, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(506, 25, 2, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(507, 25, 2, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(508, 25, 2, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(509, 25, 2, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(510, 25, 2, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(511, 25, 2, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(512, 25, 2, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(513, 25, 2, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(514, 25, 2, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(515, 25, 2, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(516, 25, 2, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(517, 25, 2, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(518, 25, 2, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(519, 25, 2, 'ip', 'ip', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 10, 0, 0),
(520, 25, 2, 'isreply', '已回复', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''未回答|0\r\n已回答|1'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 7, 0, 0),
(521, 25, 2, 'question', '问', '', '', 1, 0, '', '', 'textarea', 'array (\n  ''width'' => ''100%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 5, 0, 0),
(522, 25, 2, 'region', '区域', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(523, 25, 2, 'xglp', '相关楼盘', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 8, 0, 0),
(524, 25, 2, 'housename', '楼盘名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 8, 0, 0),
(525, 26, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(526, 26, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(527, 26, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(528, 26, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(529, 26, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(530, 26, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(531, 26, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(532, 26, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(533, 26, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(534, 26, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(535, 26, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(536, 26, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(537, 26, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(538, 26, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(539, 26, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(540, 26, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(541, 26, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(542, 26, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(543, 26, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(544, 26, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 66, 0, 0),
(545, 26, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(548, 26, 1, 'hcqts', '环翠区成交套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 11, 0, 0),
(547, 26, 1, 'pubdate', '日期', '', '', 1, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 13, 0, 0),
(549, 26, 1, 'hcqmj', '环翠区成交面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(550, 26, 1, 'jqts', '经区成交套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(551, 26, 1, 'jqmj', '经区成交面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(552, 26, 1, 'gqts', '高区成交套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(553, 26, 1, 'gqmj', '高区成交面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(554, 26, 1, 'gyxqts', '工业新区成交套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(555, 26, 1, 'gyxqmj', '工业新区成交面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 11, 0, 0),
(556, 26, 1, 'xsfts', '现售房网上销售套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(557, 26, 1, 'xsfmj', '现售房网上销售面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(558, 26, 1, 'xsfzzts', '现售房住宅销售套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(559, 26, 1, 'xsfzzmj', '现售房住宅销售面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(560, 26, 1, 'ysfts', '预售房网上销售套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(561, 26, 1, 'ysfmj', '预售房网上销售面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(562, 26, 1, 'ysfzzts', '预售房住宅销售套数', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(563, 26, 1, 'ysfzzmj', '预售房住宅销售面积', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(564, 26, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(565, 27, 2, 'name', '姓名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
(566, 27, 2, 'phone', '电话', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0),
(567, 27, 2, 'sex', '性别', '', '', 1, 0, '', '', 'box', 'array (\n  ''options'' => ''男|1\r\n女|2'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''cols'' => ''5'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0),
(568, 27, 2, 'QQ', 'qq', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(569, 27, 2, 'relation', '楼盘id', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(570, 27, 2, 'subject', '楼盘名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(571, 27, 2, 'regionid', '区域id', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0),
(572, 27, 2, 'region', '区域', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 0),
(573, 27, 2, 'price', '参考价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 0),
(575, 28, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(576, 28, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(577, 28, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(578, 28, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(579, 28, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(580, 28, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(581, 28, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(582, 28, 1, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 0, 0, 1, 0, 15, 0, 0),
(583, 28, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(584, 28, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(585, 28, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(586, 28, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(587, 28, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(588, 28, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(589, 28, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(590, 28, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(591, 28, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(592, 28, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(593, 28, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(594, 28, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(596, 28, 1, 'advantage', '优点', '', '', 3, 0, '', '请填写优点', 'textarea', 'array (\n  ''width'' => ''60%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(597, 28, 1, 'disadvantage', '缺点', '', '', 3, 0, '', '请填写缺点', 'textarea', 'array (\n  ''width'' => ''60%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(598, 28, 1, 'zongjie', '总结', '', '', 3, 0, '', '请填写总结', 'textarea', 'array (\n  ''width'' => ''60%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 7, 0, 0),
(1294, 30, 1, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 1, 0),
(1292, 30, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1293, 30, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(1244, 5, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1245, 5, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(1246, 5, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1247, 5, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 0, 0),
(1248, 29, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1249, 5, 1, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 1, 0),
(1250, 5, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(1251, 5, 1, 'video_src', '视频地址', '<br />支持优酷视频', '', 0, 0, '', '', 'upfiles', 'array (\n  ''upload_allowext'' => ''flv|mp4'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1252, 29, 1, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(1253, 29, 1, 'title', '楼栋', '', 'inputtitle', 1, 80, '', '请输入楼栋号', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1254, 29, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0),
(1255, 29, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 1, 0),
(1256, 29, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1257, 29, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 1, 0),
(1238, 5, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(1239, 5, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(1240, 5, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1241, 5, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1242, 5, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1243, 5, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(1236, 5, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1237, 5, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1206, 4, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1207, 4, 1, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(1208, 4, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1209, 4, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0),
(1210, 4, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 0, 0),
(1211, 4, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1212, 4, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 0, 0),
(1213, 4, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(1214, 4, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1215, 4, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1216, 4, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(1217, 4, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(1218, 4, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1219, 4, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1220, 4, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1221, 4, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(1222, 4, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1223, 4, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(1224, 4, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1225, 4, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(1226, 4, 1, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 0, 0),
(1227, 4, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(1228, 5, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1229, 5, 1, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(1230, 5, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1231, 5, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 5, 0, 0),
(1232, 5, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 7, 0, 0),
(1233, 5, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1234, 5, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 9, 0, 0),
(1235, 5, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(1291, 30, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(1290, 30, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1289, 30, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(1288, 30, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1282, 30, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1283, 30, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1284, 30, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(1285, 30, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(1286, 30, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1287, 30, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1281, 30, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(1279, 30, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1280, 30, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 1, 0),
(1274, 30, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1275, 30, 1, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(1276, 30, 1, 'title', '房间号', '', 'inputtitle', 1, 80, '', '请输入房间号', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1277, 30, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0);
INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(1278, 30, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 1, 0),
(1269, 29, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1270, 29, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(1271, 29, 1, 'unit', '单元', '必须为1-20的数字', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''20'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => ''6'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1272, 29, 1, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 1, 0),
(1273, 29, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(1266, 29, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(1267, 29, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1268, 29, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(1262, 29, 1, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(1263, 29, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1264, 29, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1265, 29, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1259, 29, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1260, 29, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1261, 29, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(1258, 29, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(1205, 30, 1, 'tnmj', '套内面积', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', 'onBlur="var data = $(''#jzmj'').val()-$(''#tnmj'').val(); if(data>0 && $(''#ftmj'').val()==''''){ $(''#ftmj'').val(data);}" ', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(1204, 30, 1, 'price', '参考单价', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', 'onBlur="var data = $(''#jzmj'').val()*$(''#price'').val(); if(data>0 && $(''#totalprice'').val()==''''){ $(''#totalprice'').val(data);}" ', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1203, 13, 1, 'xgsp', '相关视频', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xgsp]\\'' id=\\''xgsp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="xgsp_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationsp_list/modelid/5/id/{ID}\\'',\\''添加相关视频\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(5,{MODELID},{ID},\\''xgsp\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 40, 0, 0),
(1200, 5, 1, 'relation', '相关楼盘', '此处为单选', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''mediumint'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 1, 0, 1, 0, 18, 0, 0),
(1202, 30, 1, 'relation', '相关楼栋', '此处为单选', '', 1, 0, '', '请指定楼栋', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationld_list/modelid/29\\'',\\''添加相关楼栋\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(29,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 0, 0),
(1199, 1, 1, 'xgsp', '相关视频', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xgsp]\\'' id=\\''xgsp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="xgsp_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationsp_list/modelid/5/id/{ID}\\'',\\''添加相关视频\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(5,{MODELID},{ID},\\''xgsp\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''mediumint'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 15, 0, 0),
(1198, 1, 1, 'xgtk', '相关图库', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xgtk]\\'' id=\\''xgtk\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="xgtk_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationtk_list/modelid/4/id/{ID}\\'',\\''添加相关图库\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(4,{MODELID},{ID},\\''xgtk\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''mediumint'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 15, 0, 0),
(1201, 29, 1, 'relation', '所属楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加所属楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 0, 0),
(698, 31, 3, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(699, 31, 3, 'typeid', '类别', '', '', 1, 0, '', '请指定类别', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(700, 31, 3, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(701, 31, 3, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 80, 1, 0),
(702, 31, 3, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 82, 1, 0),
(703, 31, 3, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(704, 31, 3, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 999999, '', '', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n  ''height'' => '''',\n  ''disabled_page'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 83, 1, 0),
(705, 31, 3, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(706, 31, 3, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=29\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(29,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''int'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 0, 0),
(707, 31, 3, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(708, 31, 3, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(709, 31, 3, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 84, 1, 0),
(710, 31, 3, 'groupids_view', '阅读权限', '', '', 0, 0, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 85, 1, 0),
(711, 31, 3, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(712, 31, 3, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(713, 31, 3, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(714, 31, 3, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 87, 1, 0),
(715, 31, 3, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(716, 31, 3, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 88, 1, 0),
(717, 31, 3, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(718, 31, 3, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 0, 86, 1, 0),
(719, 31, 3, 'pictureurls', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''50'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 15, 0, 0),
(720, 31, 3, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(721, 32, 3, 'name', '姓名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(722, 32, 3, 'phone', '电话', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(723, 32, 3, 'sex', '性别', '', '', 1, 0, '', '', 'box', 'array (\n  ''options'' => ''男|1\r\n女|2'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''cols'' => ''5'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(724, 32, 3, 'QQ', 'qq', '', '', 0, 0, '/^[0-9]{5,20}$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(725, 32, 3, 'relation', '楼盘id', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(726, 32, 3, 'subject', '楼盘名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(727, 32, 3, 'regionid', '区域id', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(728, 32, 3, 'region', '区域', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(729, 32, 3, 'price', '参考价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(730, 33, 3, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(731, 33, 3, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 1, 0),
(732, 33, 3, 'title', '标题', '', 'inputtitle', 1, 255, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(733, 33, 3, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 0, 0),
(734, 33, 3, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(735, 33, 3, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(736, 33, 3, 'content', '答', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 0, 0, '', '', 'editor', 'array (\n  ''toolbar'' => ''basic'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''0'',\n  ''height'' => '''',\n  ''disabled_page'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 6, 0, 0),
(737, 33, 3, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 1, 0),
(738, 33, 3, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid={MODELID}\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation({MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,17,18,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 1, 0),
(739, 33, 3, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(740, 33, 3, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(741, 33, 3, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 1, 0),
(742, 33, 3, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(743, 33, 3, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(744, 33, 3, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(745, 33, 3, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(746, 33, 3, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(747, 33, 3, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(748, 33, 3, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(749, 33, 3, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(750, 33, 3, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(751, 33, 3, 'ip', 'ip', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 10, 0, 0),
(752, 33, 3, 'isreply', '已回复', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''未回答|0\r\n已回答|1'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 7, 0, 0),
(753, 33, 3, 'question', '问', '', '', 1, 0, '', '', 'textarea', 'array (\n  ''width'' => ''100%'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 5, 0, 0),
(754, 33, 3, 'region', '区域', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(755, 33, 3, 'xglp', '相关楼盘', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 8, 0, 0),
(756, 33, 3, 'housename', '楼盘名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 8, 0, 0),
(757, 18, 1, 'name', '姓名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(758, 18, 1, 'tel', '电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 0),
(759, 13, 1, 'pinyin', '楼盘名拼音', '点一下，就有了', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', 'onFocus="$.post(''api.php?op=get_pinyin&sid=''+Math.random()*5, {data:$(''#title'').val()}, function(data){if(data && $(''#pinyin'').val()=='''') $(''#pinyin'').val(data); })" ', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 3, 0, 0),
(760, 1, 1, 'video', '视频地址', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''60'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 1, 0, 12, 0, 0),
(761, 13, 1, 'opentimetips', '开盘时间说明', '如果开盘时间不确定，那么填在这里“如2012年10月”', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 21, 0, 0),
(762, 13, 1, 'jfdatetips', '交房时间说明', '同"开盘时间说明"', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 22, 0, 0),
(763, 34, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(764, 34, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(765, 34, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(766, 34, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(767, 34, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(768, 34, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(769, 34, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(770, 34, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(771, 34, 1, 'relation', '所属楼盘', '', '', 1, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(772, 34, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(773, 34, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(774, 34, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(775, 34, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(776, 34, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(777, 34, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(778, 34, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(779, 34, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(780, 34, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(781, 34, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(782, 34, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(783, 34, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(784, 34, 1, 'huxing', '户型', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''{huxingshi} 室 {huxingting} 厅 {huxingwei} 卫　　第 {floor}  层，总 {zonglouceng} 层'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(791, 34, 1, 'huxingting', '厅', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(790, 34, 1, 'huxingshi', '室', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(788, 34, 1, 'floor', '楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(789, 34, 1, 'zonglouceng', '总楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(792, 34, 1, 'huxingwei', '卫', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(801, 34, 1, 'total_area', '面积', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(793, 34, 1, 'house_no', '楼号', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(794, 34, 1, 'fix', '装修', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n简装修|2\r\n精装修|3\r\n豪华装修|4'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(795, 34, 1, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(796, 34, 1, 'jfdate', '入住时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(797, 34, 1, 'tel', '电话', '', '', 0, 0, '/^[0-9-]{6,13}$/', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(798, 34, 1, 'wyf', '物业管理费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(799, 34, 1, 'house_toward', '朝向', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''东|1\r\n西|2\r\n南|3\r\n北|4\r\n东南|5\r\n西南|6\r\n东北|7\r\n西北|8\r\n南北|9\r\n东西|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(800, 34, 1, 'house_pic', '图片', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(802, 34, 1, 'price', '价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(803, 34, 1, 'house_num', '可售', '套', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(804, 34, 1, 'type', '房屋类型', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(805, 10, 0, 'mobile', '手机', '', '', 11, 11, '/^(1)[0-9]{10}$/', '请输入正确的手机号', 'number', 'array (\n  ''minnumber'' => ''11'',\n  ''maxnumber'' => ''11'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0),
(807, 37, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(808, 37, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', '', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 4, 0, 0),
(809, 37, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\r\n  ''size'' => ''100'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(810, 37, 1, 'description', '活动介绍', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(811, 37, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\r\n  ''dateformat'' => ''int'',\r\n  ''format'' => ''Y-m-d H:i:s'',\r\n  ''defaulttype'' => ''1'',\r\n  ''defaultvalue'' => '''',\r\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(812, 37, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 1, 0),
(813, 37, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(814, 37, 1, 'relation', '相关楼盘', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(815, 37, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(816, 37, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(817, 37, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(818, 37, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 1, 0),
(819, 37, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(820, 37, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(821, 37, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(822, 37, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 1, 0),
(823, 37, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(824, 37, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(825, 37, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', '', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(826, 37, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(827, 37, 1, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '请指定区域', 'linkage', 'array (\n  ''linkageid'' => ''3360'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(828, 37, 1, 'character', '线路特点', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(829, 37, 1, 'addtime', '活动日期', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 12, 0, 0),
(830, 37, 1, 'endtime', '结束时间', '', '', 1, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 13, 0, 0),
(831, 20, 1, 'relatedid', '相关路线', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(832, 13, 1, 'dzinfo', '优惠信息', '简单一句话', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 40, 0, 0),
(833, 13, 1, 'dzinfodate', '优惠信息截止时间', '', '', 0, 0, '', '请输入优惠活动有效期', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 40, 0, 0),
(834, 20, 1, 'num', '参团人数', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''1'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0),
(835, 20, 1, 'fromurl', '来源链接', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0),
(836, 21, 2, 'opentimetips', '开盘时间说明', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 21, 0, 0),
(837, 21, 2, 'dzinfo', '打折信息', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0),
(838, 17, 1, 'num', '参团人数', '', '', 0, 0, '/^[0-9.-]+$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''1'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0),
(839, 17, 1, 'fromurl', '来源链接', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0),
(840, 17, 1, 'type', '类型', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''团购|0\r\n看房|1'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''cols'' => ''5'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0),
(841, 17, 1, 'relatedid', '相关路线', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''0'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0),
(1089, 40, 1, 'range', '价格区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''3000以下|1\r\n3000-4000|2\r\n4000-5000|3\r\n5000-6000|4\r\n6000-7000|5\r\n7000-8000|6\r\n8000-10000|7\r\n10000以上|8'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 34, 0, 0),
(1088, 40, 1, 'pic', '组图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''1'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1086, 40, 1, 'zbpt', '周边配套', '', '', 0, 0, '', '', 'textarea', 'array (\n  ''width'' => ''90'',\n  ''height'' => ''85'',\n  ''defaultvalue'' => ''学校(学区)：\r\n幼儿园：\r\n综合商场：\r\n银　行：\r\n医　院：\r\n其　它：'',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 15, 0, 0),
(1087, 40, 1, 'map', '地图', '', '', 0, 0, '', '', 'map', 'array (\n  ''maptype'' => ''1'',\n  ''api_key'' => ''db4fb4013c14680641a99e4fdbb5158325d0530d2d6f48d4e2c47e7bbdac7d5484c8a88194b349c5'',\n  ''defaultcity'' => ''威海'',\n  ''hotcitys'' => '''',\n  ''width'' => ''650'',\n  ''height'' => ''250'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 48, 0, 0),
(1070, 40, 1, 'lhl', '绿化率', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 28, 0, 0),
(1085, 40, 1, 'property', '物业公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[property]\\'' id=\\''property\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="property_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=property&typeid=11\\'',\\''添加物业公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''property\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 44, 0, 0),
(1068, 40, 1, 'far', '容积率', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''7'',\n  ''decimaldigits'' => ''-1'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 26, 0, 0),
(1069, 40, 1, 'gt', '公摊', '%', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''100'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 27, 0, 0),
(1084, 40, 1, 'agency', '代理公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[agency]\\'' id=\\''agency\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="agency_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=agency&typeid=10\\'',\\''添加代理公司\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''agency\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 43, 0, 0),
(1067, 40, 1, 'jzmj', '建筑面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 25, 0, 0);
INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(1083, 40, 1, 'investor', '投资商', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[investor]\\'' id=\\''investor\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="investor_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&modelid=16&type=investor&typeid=9\\'',\\''添加投资商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''investor\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 42, 0, 0),
(1082, 40, 1, 'developer', '开发商', '', '', 0, 0, '', '请选择开发商', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[developer]\\'' id=\\''developer\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="developer_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&type=developer&modelid=16&typeid=8\\'',\\''添加开发商\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_company(16,{MODELID},{ID},\\''developer\\'')" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 41, 0, 0),
(1081, 40, 1, 'xglp', '相关楼盘', '用于互相关联', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[xglp]\\'' id=\\''xglp\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_lp_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_companylist&type=relationlp&modelid=13&id={ID}\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation1(13,{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 40, 0, 0),
(1080, 40, 1, 'wyf', '物业费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 46, 0, 0),
(1079, 40, 1, 'siteurl', '项目网站', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 48, 0, 0),
(1078, 40, 1, 'jgsj', '景观设计', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 47, 0, 0),
(1076, 40, 1, 'price', '楼盘均价', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 33, 0, 0),
(1077, 40, 1, 'jzdw', '建筑单位', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 39, 0, 0),
(1075, 40, 1, 'tel', '售楼电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 38, 0, 0),
(1074, 40, 1, 'license', '销售许可证', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 35, 0, 0),
(1073, 40, 1, 'cwf', '车位费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 31, 0, 0),
(1071, 40, 1, 'kftime', '开发周期', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 29, 0, 0),
(1072, 40, 1, 'cws', '车位数', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 32, 0, 0),
(1066, 40, 1, 'zdmj', '占地面积', '㎡', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 23, 0, 0),
(1065, 40, 1, 'jfdate', '交房时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 22, 0, 0),
(1064, 40, 1, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 21, 0, 0),
(1063, 40, 1, 'qqqun', '业主QQ群', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 19, 0, 0),
(1062, 40, 1, 'address', '小区地址', '', '', 1, 0, '', '请输入楼盘地址', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 17, 0, 0),
(1059, 40, 1, 'area', '项目四至', '（东南西北分别毗邻哪里）', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''70'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 12, 0, 0),
(1060, 40, 1, 'huxing', '主力户型', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(1061, 40, 1, 'jiaotong', '交通状况', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''80'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 14, 0, 0),
(1058, 40, 1, 'character', '小区特色', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''小户型|2\r\n公园地产|3\r\n学区房|4\r\n旅游地产|5\r\n投资地产|6\r\n海景地产|7\r\n经济住宅|8\r\n宜居生态地产|9'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1054, 40, 1, 'bbs', '业主论坛', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 45, 0, 0),
(1055, 40, 1, 'type2', '建筑类别', '', '', 1, 0, '', '请选择建筑类别', 'box', 'array (\n  ''options'' => ''高层|1\r\n多层|2\r\n小高层|3\r\n联排别墅|4\r\n双拼别墅|5\r\n独栋别墅|6'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1056, 40, 1, 'jdtime', '接待时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''30'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 37, 0, 0),
(1057, 40, 1, 'fcznx', '房产证年限', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => ''70 年'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1053, 40, 1, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '请指定区域', 'linkage', 'array (\n  ''linkageid'' => ''3360'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 5, 0, 0),
(1052, 40, 1, 'type', '房屋类型', '', '', 0, 0, '', '请选择房屋类型', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''100'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 4, 0, 0),
(1050, 40, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1051, 40, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', '', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(1048, 40, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1049, 40, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 0, 0),
(1044, 40, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1045, 40, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1046, 40, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1047, 40, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(1042, 40, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 203, 0, 0),
(1043, 40, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(1161, 41, 1, 'flag', '标记', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''新推|1\r\n急售|2\r\n推荐|3\r\n多图|5'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(1040, 40, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', '', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 0, 0),
(1041, 40, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 20, 0, 0),
(1039, 40, 1, 'relation', '相关文章', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=1\\'',\\''添加相关文章\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(1,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 16, 0, 0),
(1038, 40, 1, 'thumb', '缩略图', '', '', 0, 100, '', '请上传缩略图', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 14, 0, 0),
(1037, 40, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 49, 0, 0),
(1036, 40, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1035, 40, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\n  ''width'' => ''98'',\n  ''height'' => ''46'',\n  ''defaultvalue'' => '''',\n  ''enablehtml'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 1, 0),
(1034, 40, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 10, 0, 0),
(1033, 40, 1, 'title', '小区名称', '', 'inputtitle', 1, 80, '', '请输入楼盘名称', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 2, 0, 0),
(1032, 40, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(1031, 40, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1030, 39, 1, 'belong', '产权', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''私产|1\r\n公产|2\r\n商品房|3\r\n期房|4\r\n经济适用房|5\r\n使用权房|6\r\n房改房|7'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1029, 39, 1, 'huxingyang', '阳', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(1028, 39, 1, 'type', '房屋类型', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1027, 39, 1, 'price', '总价', '万', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(1026, 39, 1, 'house_pic', '户型图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1025, 39, 1, 'house_toward', '朝向', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''东|1\r\n南|2\r\n西|3\r\n北|4\r\n东南|5\r\n东北|6\r\n西南|7\r\n西北|8\r\n南北|9\r\n东西|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1137, 39, 1, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '', 'linkage', 'array (\n  ''linkageid'' => ''3360'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(1024, 39, 1, 'wyf', '物业管理费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1023, 39, 1, 'tel', '电话', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1022, 39, 1, 'huxing', '户型', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''{huxingshi} 室 {huxingting} 厅 {huxingwei} 卫 {huxingyang} 阳　　第 {floor}  层，总 {zonglouceng} 层'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(1019, 39, 1, 'huxingwei', '卫', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(1021, 39, 1, 'huxingting', '厅', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 1, 5, 0, 1),
(1015, 39, 1, 'total_area', '面积', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(1016, 39, 1, 'huxingshi', '室', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 1, 5, 0, 1),
(1017, 39, 1, 'floor', '楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => ''1'',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(1018, 39, 1, 'zonglouceng', '总楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(1010, 39, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1011, 39, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 1, 0),
(1012, 39, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1013, 39, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(1014, 39, 1, 'fix', '装修', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n精装|2\r\n中等装修|3\r\n简装|4\r\n豪华装修|5\r\n原房|6'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1004, 39, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(1005, 39, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(1006, 39, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1007, 39, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1008, 39, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1009, 39, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(1002, 39, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1003, 39, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1001, 39, 1, 'relation', '所属小区', '', '', 1, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=40\\'',\\''添加相关小区\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(40,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 1, 0, 15, 0, 0),
(1000, 39, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(999, 39, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(998, 39, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(997, 39, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(1020, 39, 1, 'house_age', '建筑年代', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''0'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 11, 0, 0),
(996, 39, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(993, 39, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(994, 39, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(995, 39, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1092, 40, 1, 'ename', '英文首字母', '例如“营创美域”，那么此处填写ycmy', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 3, 0, 0),
(1093, 41, 1, 'catid', '栏目', '', '', 1, 6, '/^[0-9]{1,6}$/', '请选择栏目', 'catid', 'array (\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(1094, 41, 1, 'typeid', '类别', '', '', 0, 0, '', '', 'typeid', 'array (\n  ''minnumber'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 2, 0, 0),
(1095, 41, 1, 'title', '标题', '', 'inputtitle', 1, 80, '', '请输入标题', 'title', 'array (\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 1, 3, 0, 0),
(1096, 41, 1, 'keywords', '关键词', '多关键词之间用空格或者“,”隔开', '', 0, 40, '', '', 'keyword', 'array (\n  ''size'' => ''100'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 1, 0, 1, 1, 1, 1, 0, 7, 1, 0),
(1097, 41, 1, 'description', '摘要', '', '', 0, 255, '', '', 'textarea', 'array (\r\n  ''width'' => ''98'',\r\n  ''height'' => ''46'',\r\n  ''defaultvalue'' => '''',\r\n  ''enablehtml'' => ''0'',\r\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 1, 10, 0, 0),
(1098, 41, 1, 'updatetime', '更新时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''dateformat'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''1'',\n  ''defaultvalue'' => '''',\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 12, 0, 0),
(1099, 41, 1, 'content', '内容', '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>是否截取内容</label><input type="text" name="introcude_length" value="200" size="3">字符至内容摘要\r\n<label><input type=''checkbox'' name=''auto_thumb'' value="1" checked>是否获取内容第</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">张图片作为标题图片\r\n</div>', '', 1, 999999, '', '内容不能为空', 'editor', 'array (\n  ''toolbar'' => ''full'',\n  ''defaultvalue'' => '''',\n  ''enablekeylink'' => ''1'',\n  ''replacenum'' => ''2'',\n  ''link_mode'' => ''0'',\n  ''enablesaveimage'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(1100, 41, 1, 'thumb', '缩略图', '', '', 0, 100, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''1'',\n  ''upload_maxsize'' => ''1024'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''1'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 1, 0, 0, 0, 1, 0, 1, 14, 0, 0),
(1101, 41, 1, 'relation', '所属小区', '', '', 1, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul>\r\n<div>\r\n<input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist&modelid=40\\'',\\''添加相关小区\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(40,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 0, 0, 0, 1, 0, 15, 0, 0),
(1102, 41, 1, 'pages', '分页方式', '', '', 0, 0, '', '', 'pages', 'array (\n)', '', '-99', '-99', 0, 0, 0, 1, 0, 0, 0, 0, 16, 1, 0),
(1103, 41, 1, 'inputtime', '发布时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 0, 0, 0, 0, 1, 17, 0, 0),
(1104, 41, 1, 'posids', '推荐位', '', '', 0, 0, '', '', 'posid', 'array (\n  ''cols'' => ''4'',\n  ''width'' => ''125'',\n)', '', '', '', 0, 1, 0, 1, 0, 0, 0, 0, 18, 0, 0),
(1105, 41, 1, 'groupids_view', '阅读权限', '', '', 0, 100, '', '', 'groupid', 'array (\n  ''groupids'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 0, 0, 0, 19, 0, 0),
(1106, 41, 1, 'url', 'URL', '', '', 0, 100, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 50, 0, 0),
(1107, 41, 1, 'listorder', '排序', '', '', 0, 6, '', '', 'number', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 51, 0, 0),
(1108, 41, 1, 'template', '内容页模板', '', '', 0, 30, '', '', 'template', 'array (\n  ''size'' => '''',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 53, 0, 0),
(1109, 41, 1, 'allow_comment', '允许评论', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''允许评论|1\r\n不允许评论|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''88'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 54, 0, 0),
(1110, 41, 1, 'status', '状态', '', '', 0, 2, '', '', 'box', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 55, 0, 0),
(1111, 41, 1, 'readpoint', '阅读收费', '', '', 0, 5, '', '', 'readpoint', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''99999'',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n)', '', '-99', '-99', 0, 0, 0, 0, 0, 0, 0, 0, 55, 0, 0),
(1112, 41, 1, 'username', '用户名', '', '', 0, 20, '', '', 'text', 'array (\n)', '', '', '', 1, 1, 0, 1, 0, 0, 0, 0, 98, 0, 0),
(1113, 41, 1, 'islink', '转向链接', '', '', 0, 0, '', '', 'islink', 'array (\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 1, 0),
(1114, 41, 1, 'house_age', '房龄', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''0'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1115, 41, 1, 'jfdate', '入住时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(1116, 41, 1, 'fix', '装修', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n精装|2\r\n中等装修|3\r\n简装|4\r\n豪华装修|5\r\n原房|6'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1117, 41, 1, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''date'',\n  ''format'' => ''Y-m-d Ah:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(1118, 41, 1, 'total_area', '面积', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1119, 41, 1, 'huxingshi', '室', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(1120, 41, 1, 'floor', '楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(1121, 41, 1, 'zonglouceng', '总楼层', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 5, 0, 1),
(1122, 41, 1, 'huxingwei', '卫', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(1123, 41, 1, 'huxingting', '厅', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''1|1\r\n2|2\r\n3|3\r\n4|4\r\n5|5'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 1),
(1124, 41, 1, 'huxing', '户型', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''{huxingshi} 室 {huxingting} 厅 {huxingwei} 卫　　第 {floor}  层，总 {zonglouceng} 层'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(1125, 41, 1, 'tel', '电话', '', '', 0, 0, '/^[0-9-]{6,13}$/', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1126, 41, 1, 'wyf', '物业管理费', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1127, 41, 1, 'house_toward', '朝向', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''东|1\r\n西|2\r\n南|3\r\n北|4\r\n东南|5\r\n西南|6\r\n东北|7\r\n西北|8\r\n南北|9\r\n东西|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1128, 41, 1, 'house_pic', '户型图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1129, 41, 1, 'price', '价格', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1130, 41, 1, 'house_num', '可售', '套', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1131, 41, 1, 'type', '房屋类型', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1132, 40, 1, 'pinyin', '小区名拼音', '点一下，就有了', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', 'onFocus="$.post(''api.php?op=get_pinyin&sid=''+Math.random()*5, {data:$(''#title'').val()}, function(data){if(data && $(''#pinyin'').val()=='''') $(''#pinyin'').val(data); })" ', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 3, 0, 0),
(1160, 39, 1, 'flag', '标记', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''新推|1\r\n急售|2\r\n推荐|3\r\n置顶|4\r\n多图|5'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(1135, 39, 1, 'house_status', '房源属性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''出售|1\r\n下架|2\r\n已成交|4'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''smallint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 6, 0, 0),
(1136, 41, 1, 'house_status', '房源属性', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''出租|1\r\n下架|2\r\n已成交|4'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''smallint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 6, 0, 0),
(1138, 41, 1, 'region', '区域', '', '', 0, 0, '/^[0-9.-]+$/', '', 'linkage', 'array (\n  ''linkageid'' => ''3360'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1139, 39, 1, 'uid', 'uid', '', '', 0, 0, '/^[0-9.-]+$/', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 99, 0, 0),
(1140, 39, 1, 'assort', '配套设施', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''有线电视|18\r\n双人床|17\r\n家电|16\r\n灶具|15\r\n小房|14\r\n家具|12\r\n电话|10\r\n宽带|9\r\n天然气|2\r\n煤气|1\r\n暖气|3\r\n电梯|4\r\n车位|5\r\n储藏室/地下室|6\r\n防盗门|7\r\n空调|8\r\n阳台封闭|11\r\n热水|13'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 12, 0, 0),
(1141, 39, 1, 'encode', '认证码', '', '', 0, 6, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 22, 0, 0),
(1142, 39, 1, 'houseno', '房源编号', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 22, 0, 0),
(1143, 39, 1, 'house_room', '室内图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1144, 39, 1, 'house_outdoor', '室外图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1145, 39, 1, 'range', '价格区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''30万以下|1\r\n30-40万|2\r\n40-50万|3\r\n50-60万|4\r\n60-80万|5\r\n80-100万|6\r\n100-150万|7\r\n150-200万|8'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 10, 0, 0),
(1146, 39, 1, 'area_range', '面积区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''70平米以下|1\r\n70-90平米|3\r\n90-120平米|4\r\n120-150平米|5\r\n150-200平米|6\r\n200-300平米|7\r\n300平米以上|8'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 10, 0, 0),
(1147, 39, 1, 'mprice', '单价', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1148, 41, 1, 'area_range', '面积区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''70平米以下|1\r\n70-90平米|3\r\n90-120平米|4\r\n120-150平米|5\r\n150-200平米|6\r\n200-300平米|7\r\n300平米以上|8'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''smallint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1149, 41, 1, 'range', '价格区间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''500以下|1\r\n500-600元|2\r\n600-700元|3\r\n700-800元|4\r\n800-1000元|5\r\n1000-1200元|6\r\n1200-1500元|7\r\n1500-2000元|8\r\n2000以上|9\r\n'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''smallint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1150, 41, 1, 'uid', 'uid', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 99, 0, 0),
(1151, 41, 1, 'encode', '认证码', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 22, 0, 0),
(1152, 41, 1, 'rent_type', '出租方式', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''整租|1\r\n合租|2\r\n日租|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''smallint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 0, 0, 5, 0, 0),
(1153, 41, 1, 'paytype1', '押', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1154, 41, 1, 'paytype2', '付', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1155, 41, 1, 'house_room', '室内图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1156, 41, 1, 'house_outdoor', '室外图', '', '', 0, 0, '', '', 'images', 'array (\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''isselectimage'' => ''0'',\n  ''upload_number'' => ''5'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1157, 41, 1, 'assort', '配套设施', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''有线电视|18\r\n双人床|17\r\n家电|16\r\n灶具|15\r\n小房|14\r\n家具|12\r\n电话|10\r\n宽带|9\r\n天然气|2\r\n煤气|1\r\n暖气|3\r\n电梯|4\r\n车位|5\r\n储藏室/地下室|6\r\n防盗门|7\r\n空调|8\r\n阳台封闭|11\r\n热水|13'',\n  ''boxtype'' => ''checkbox'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => '''',\n  ''outputtype'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 12, 0, 0),
(1158, 39, 1, 'communityname', '小区名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 11, 0, 0),
(1159, 41, 1, 'communityname', '小区名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 1, 1, 1, 0, 11, 0, 0),
(1162, 40, 1, 'price_rent', '出租均价', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 33, 0, 0),
(1163, 40, 1, 'price_percent', '出售同比上月', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => '''',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 33, 0, 0),
(1164, 40, 1, 'price_rent_percent', '出租同比上月', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => '''',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''2'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 33, 0, 0),
(1165, 42, 0, 'tel', '联系电话', '', '', 11, 11, '/^(1)[0-9]{10}$/', '请输入正确的手机号', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1166, 42, 0, 'company', '所属公司', '', '', 0, 0, '', '', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[company]\\'' id=\\''company\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<input type=\\''hidden\\'' name=\\''info[companyname]\\'' id=\\''companyname\\'' style=\\''50\\'' >\r\n<input class=\\''input-text\\'' id=\\''relation_lp_text\\'' readonly/>\r\n<input type=\\''button\\'' value="选择公司" onclick="omnipotent(\\''selectid\\'',\\''?s=member/index/public_member_companylist/type/company\\'',\\''添加所属公司\\'',1,500,470)" class="button">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="独立经纪人" onclick="remove_company()" class="button">\r\n</span>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 3, 0, 0),
(1167, 42, 0, 'mobile', '手机号码', '', '', 0, 11, '', '', 'checkmobile', '', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 7, 1, 0),
(1168, 42, 0, 'district', '工作区域', '', '', 0, 0, '/^[0-9.-]+$/', '', 'linkage', 'array (\n  ''linkageid'' => ''4000'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 2, 0, 0),
(1169, 42, 0, 'truename', '真实姓名', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0),
(1170, 42, 0, 'notice', '店铺公告', '', '', 0, 0, '', '', 'editor', 'array (\n  ''toolbar'' => ''basic'',\n  ''defaultvalue'' => '''',\n  ''allowupload'' => ''0'',\n  ''enablesaveimage'' => ''0'',\n  ''height'' => ''200'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 8, 1, 0),
(1171, 42, 0, 'companyname', '所属公司名', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 6, 1, 0),
(1172, 42, 0, 'QQ', 'QQ', '', '', 0, 11, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 1, 0, 0, 5, 1, 0),
(1173, 43, 0, 'district', '所在区域', '', '', 0, 0, '', '', 'linkage', 'array (\n  ''linkageid'' => ''4000'',\n  ''showtype'' => ''2'',\n  ''space'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0),
(1174, 43, 0, 'contact', '联系人', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 2, 0, 0),
(1175, 43, 0, 'tel', '服务热线', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 3, 0, 0),
(1176, 43, 0, 'address', '所在地址', '', '', 1, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 4, 0, 0);
INSERT INTO `h5_model_field` (`fieldid`, `modelid`, `siteid`, `field`, `name`, `tips`, `css`, `minlength`, `maxlength`, `pattern`, `errortips`, `formtype`, `setting`, `formattribute`, `unsetgroupids`, `unsetroleids`, `iscore`, `issystem`, `isunique`, `isbase`, `issearch`, `isadd`, `isfulltext`, `isposition`, `listorder`, `disabled`, `isomnipotent`) VALUES
(1177, 41, 1, 'roomtype', '合租房间', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''主卧|1\r\n次卧|2\r\n隔断间|3\r\n床位|4'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(1178, 41, 1, 'limitsex', '性别限制', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''男女不限|1\r\n限男性|2\r\n限女性|3'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(1179, 41, 1, 'house_downtime', '下架时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1180, 41, 1, 'remarks', '备注', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 20, 0, 0),
(1181, 41, 1, 'refresh', '刷新次数', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''0'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => '''',\n  ''defaultvalue'' => ''2'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 10, 0, 0),
(1182, 41, 1, 'houseno', '房源编号', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 6, 0, 0),
(1183, 41, 1, 'recommend', '店铺推荐', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 10, 0, 0),
(1184, 41, 1, 'isbroker', '经纪人房源', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 99, 0, 0),
(1185, 39, 1, 'refresh', '刷新次数', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''0'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''2'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1186, 39, 1, 'house_downtime', '下架时间', '', '', 0, 0, '', '', 'datetime', 'array (\n  ''fieldtype'' => ''int'',\n  ''format'' => ''Y-m-d H:i:s'',\n  ''defaulttype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1187, 39, 1, 'remarks', '备注', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 20, 0, 0),
(1188, 39, 1, 'recommend', '店铺推荐', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 9, 0, 0),
(1189, 39, 1, 'isbroker', '经纪人房源', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''是|1\r\n否|0'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''-1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''0'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 99, 0, 0),
(1190, 13, 1, 'domain', '域名', '留空为不启用', '', 0, 0, '/^[0-9a-z-]+$/i', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', 'onBlur="$.post(''api.php?op=check_domain&sid=''+Math.random()*5, {data:$(''#domain'').val(),id:$(''input[name=id]'').val()}, function(data){if(data==1)$(''#domain'').val('''');})" ', '', '', 0, 1, 0, 1, 1, 0, 0, 0, 3, 0, 0),
(1191, 17, 1, 'description', '留言', '', '', 0, 255, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 0),
(1192, 15, 1, 'type', '房屋类型', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''住宅|1\r\n花园洋房|2\r\n酒店式公寓|3\r\n商住两用|4\r\n综合体|5\r\n别墅|6\r\n写字楼|7\r\n商铺|8\r\n公寓|9\r\n经济适用房|10'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1193, 5, 1, 'initialviews', '初始点击量', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''0'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 8, 0, 0),
(1194, 1, 1, 'initialviews', '初始点击量', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''0'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 12, 0, 0),
(1195, 13, 1, 'initialtuan', '初始报名数', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''0'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(1196, 13, 1, 'initialviews', '初始点击量', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => ''0'',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 20, 0, 0),
(1197, 4, 1, 'relation', '相关楼盘', '此处为单选', '', 1, 0, '', '请指定楼盘', 'omnipotent', 'array (\n  ''formtext'' => ''<input type=\\''hidden\\'' name=\\''info[relation]\\'' id=\\''relation\\'' value=\\''{FIELD_VALUE}\\'' style=\\''50\\'' >\r\n<ul class="list-dot" id="relation_text"></ul><div><input type=\\''button\\'' value="添加相关" onclick="omnipotent(\\''selectid\\'',\\''?s=content/content/public_relationlist/modelid/13\\'',\\''添加相关楼盘\\'',1)" class="button" style="width:66px;">\r\n<span class="edit_content">\r\n<input type=\\''button\\'' value="显示已有" onclick="show_relation2(13,{MODELID},{ID})" class="button" style="width:66px;">\r\n</span>\r\n</div>'',\n  ''fieldtype'' => ''varchar'',\n  ''minnumber'' => ''1'',\n)', '', '2,6,4,5,1,7', '', 0, 0, 0, 1, 1, 0, 1, 0, 18, 1, 0),
(1295, 30, 1, 'copyfrom', '来源', '', '', 0, 0, '', '', 'copyfrom', 'array (\n  ''defaultvalue'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 81, 1, 0),
(1296, 4, 1, 'initialviews', '初始点击量', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1297, 30, 1, 'xszt', '销售状态', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''在售|1\r\n未售|2\r\n售完|3\r\n预订|4'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n  ''filtertype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(1298, 30, 1, 'totalprice', '总价', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1299, 13, 1, 'shapan', '沙盘图', '宽度不超过900', '', 0, 0, '', '', 'image', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''show_type'' => ''0'',\n  ''upload_maxsize'' => '''',\n  ''upload_allowext'' => ''gif|jpg|jpeg|png|bmp'',\n  ''watermark'' => ''0'',\n  ''isselectimage'' => ''0'',\n  ''images_width'' => '''',\n  ''images_height'' => '''',\n)', '', '', '', 0, 0, 0, 1, 0, 1, 0, 0, 18, 0, 0),
(1300, 29, 1, 'shapan', '标注位置', '通过沙盘图标注', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 11, 0, 0),
(1301, 29, 1, 'dongtai', '近期动态', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''50'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 14, 0, 0),
(1302, 30, 1, 'ftmj', '分摊面积', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 9, 0, 0),
(1303, 30, 1, 'height', '层高', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''-1'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(1304, 30, 1, 'jzmj', '建筑面积', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1305, 30, 1, 'floor', '楼层', '必须为数字', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 0),
(1306, 30, 1, 'character', '性质', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''住宅|1'',\n  ''boxtype'' => ''radio'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 4, 0, 0),
(1307, 29, 1, 'license', '预售许可', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 13, 0, 0),
(1308, 29, 1, 'fix', '交付标准', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''毛坯|1\r\n简装修|2\r\n精装修|3'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 11, 0, 0),
(1309, 29, 1, 'jfdate', '交房时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 10, 0, 0),
(1310, 29, 1, 'opentime', '开盘时间', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 9, 0, 0),
(1311, 29, 1, 'progress', '施工进度', '', '', 0, 0, '', '', 'text', 'array (\n  ''size'' => ''20'',\n  ''defaultvalue'' => '''',\n  ''ispassword'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 1, 0, 8, 0, 0),
(1312, 29, 1, 'xszt', '销售状态', '', '', 0, 0, '', '', 'box', 'array (\n  ''options'' => ''在售|1\r\n未售|2\r\n售完|3'',\n  ''boxtype'' => ''select'',\n  ''fieldtype'' => ''tinyint'',\n  ''minnumber'' => ''1'',\n  ''width'' => ''80'',\n  ''size'' => ''1'',\n  ''defaultvalue'' => ''1'',\n  ''outputtype'' => ''1'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 7, 0, 0),
(1313, 29, 1, 'hushu', '户数', '', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => '''',\n  ''decimaldigits'' => ''0'',\n  ''size'' => ''6'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 6, 0, 0),
(1314, 29, 1, 'floor', '层数', '必须为数字', '', 0, 0, '', '', 'number', 'array (\n  ''minnumber'' => ''1'',\n  ''maxnumber'' => ''200'',\n  ''decimaldigits'' => ''0'',\n  ''size'' => ''6'',\n  ''defaultvalue'' => '''',\n  ''rangetype'' => ''0'',\n)', '', '', '', 0, 1, 0, 1, 0, 1, 0, 0, 5, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_module`
--

CREATE TABLE IF NOT EXISTS `h5_module` (
  `module` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `iscore` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `version` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `setting` mediumtext NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `installdate` date NOT NULL DEFAULT '0000-00-00',
  `updatedate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_module`
--

INSERT INTO `h5_module` (`module`, `name`, `url`, `iscore`, `version`, `description`, `setting`, `listorder`, `disabled`, `installdate`, `updatedate`) VALUES
('admin', 'admin', '', 1, '1.0', '', 'array (\n  ''admin_email'' => ''admin@house5.net'',\n  ''maxloginfailedtimes'' => ''8'',\n  ''minrefreshtime'' => ''2'',\n  ''mail_type'' => ''1'',\n  ''mail_server'' => ''smtp.exmail.qq.com'',\n  ''mail_port'' => ''25'',\n  ''category_ajax'' => ''0'',\n  ''mail_user'' => '''',\n  ''mail_auth'' => ''1'',\n  ''mail_from'' => '''',\n  ''mail_password'' => '''',\n  ''errorlog_size'' => ''20'',\n)', 0, 0, '2010-10-18', '2010-10-18'),
('member', '会员', '', 1, '1.0', '', 'array (\n  ''allowregister'' => ''1'',\n  ''choosemodel'' => ''1'',\n  ''enablemailcheck'' => ''0'',\n  ''registerverify'' => ''1'',\n  ''showapppoint'' => ''0'',\n  ''rmb_point_rate'' => ''10'',\n  ''defualtpoint'' => ''0'',\n  ''defualtamount'' => ''0'',\n  ''firstloginpoint'' => '''',\n  ''showregprotocol'' => ''0'',\n  ''regprotocol'' => ''		 欢迎您注册成为house5用户\r\n请仔细阅读下面的协议，只有接受协议才能继续进行注册。 \r\n1．服务条款的确认和接纳\r\n　　house5用户服务的所有权和运作权归house5拥有。house5所提供的服务将按照有关章程、服务条款和操作规则严格执行。用户通过注册程序点击“我同意” 按钮，即表示用户与house5达成协议并接受所有的服务条款。\r\n2． house5服务简介\r\n　　house5通过国际互联网为用户提供新闻及文章浏览、图片浏览、软件下载、网上留言和BBS论坛等服务。\r\n　　用户必须： \r\n　　1)购置设备，包括个人电脑一台、调制解调器一个及配备上网装置。 \r\n　　2)个人上网和支付与此服务有关的电话费用、网络费用。\r\n　　用户同意： \r\n　　1)提供及时、详尽及准确的个人资料。 \r\n　　2)不断更新注册资料，符合及时、详尽、准确的要求。所有原始键入的资料将引用为注册资料。 \r\n　　3)用户同意遵守《中华人民共和国保守国家秘密法》、《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》等有关计算机及互联网规定的法律和法规、实施办法。在任何情况下，house5合理地认为用户的行为可能违反上述法律、法规，house5可以在任何时候，不经事先通知终止向该用户提供服务。用户应了解国际互联网的无国界性，应特别注意遵守当地所有有关的法律和法规。\r\n3． 服务条款的修改\r\n　　house5会不定时地修改服务条款，服务条款一旦发生变动，将会在相关页面上提示修改内容。如果您同意改动，则再一次点击“我同意”按钮。 如果您不接受，则及时取消您的用户使用服务资格。\r\n4． 服务修订\r\n　　house5保留随时修改或中断服务而不需知照用户的权利。house5行使修改或中断服务的权利，不需对用户或第三方负责。\r\n5． 用户隐私制度\r\n　　尊重用户个人隐私是house5的 基本政策。house5不会公开、编辑或透露用户的注册信息，除非有法律许可要求，或house5在诚信的基础上认为透露这些信息在以下三种情况是必要的： \r\n　　1)遵守有关法律规定，遵从合法服务程序。 \r\n　　2)保持维护house5的商标所有权。 \r\n　　3)在紧急情况下竭力维护用户个人和社会大众的隐私安全。 \r\n　　4)符合其他相关的要求。 \r\n6．用户的帐号，密码和安全性\r\n　　一旦注册成功成为house5用户，您将得到一个密码和帐号。如果您不保管好自己的帐号和密码安全，将对因此产生的后果负全部责任。另外，每个用户都要对其帐户中的所有活动和事件负全责。您可随时根据指示改变您的密码，也可以结束旧的帐户重开一个新帐户。用户同意若发现任何非法使用用户帐号或安全漏洞的情况，立即通知house5。\r\n7． 免责条款\r\n　　用户明确同意网站服务的使用由用户个人承担风险。 　　 \r\n　　house5不作任何类型的担保，不担保服务一定能满足用户的要求，也不担保服务不会受中断，对服务的及时性，安全性，出错发生都不作担保。用户理解并接受：任何通过house5服务取得的信息资料的可靠性取决于用户自己，用户自己承担所有风险和责任。 \r\n8．有限责任\r\n　　house5对任何直接、间接、偶然、特殊及继起的损害不负责任。\r\n9． 不提供零售和商业性服务 \r\n　　用户使用网站服务的权利是个人的。用户只能是一个单独的个体而不能是一个公司或实体商业性组织。用户承诺不经house5同意，不能利用网站服务进行销售或其他商业用途。\r\n10．用户责任 \r\n　　用户单独承担传输内容的责任。用户必须遵循： \r\n　　1)从中国境内向外传输技术性资料时必须符合中国有关法规。 \r\n　　2)使用网站服务不作非法用途。 \r\n　　3)不干扰或混乱网络服务。 \r\n　　4)不在论坛BBS或留言簿发表任何与政治相关的信息。 \r\n　　5)遵守所有使用网站服务的网络协议、规定、程序和惯例。\r\n　　6)不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益。\r\n　　7)不得利用本站制作、复制和传播下列信息： \r\n　　　1、煽动抗拒、破坏宪法和法律、行政法规实施的；\r\n　　　2、煽动颠覆国家政权，推翻社会主义制度的；\r\n　　　3、煽动分裂国家、破坏国家统一的；\r\n　　　4、煽动民族仇恨、民族歧视，破坏民族团结的；\r\n　　　5、捏造或者歪曲事实，散布谣言，扰乱社会秩序的；\r\n　　　6、宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；\r\n　　　7、公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；\r\n　　　8、损害国家机关信誉的；\r\n　　　9、其他违反宪法和法律行政法规的；\r\n　　　10、进行商业广告行为的。\r\n　　用户不能传输任何教唆他人构成犯罪行为的资料；不能传输长国内不利条件和涉及国家安全的资料；不能传输任何不符合当地法规、国家法律和国际法 律的资料。未经许可而非法进入其它电脑系统是禁止的。若用户的行为不符合以上的条款，house5将取消用户服务帐号。\r\n11．网站内容的所有权\r\n　　house5定义的内容包括：文字、软件、声音、相片、录象、图表；在广告中全部内容；电子邮件的全部内容；house5为用户提供的商业信息。所有这些内容受版权、商标、标签和其它财产所有权法律的保护。所以，用户只能在house5和广告商授权下才能使用这些内容，而不能擅自复制、篡改这些内容、或创造与内容有关的派生产品。\r\n12．附加信息服务\r\n　　用户在享用house5提供的免费服务的同时，同意接受house5提供的各类附加信息服务。\r\n13．解释权\r\n　　本注册协议的解释权归house5所有。如果其中有任何条款与国家的有关法律相抵触，则以国家法律的明文规定为准。 '',\n  ''registerverifymessage'' => '' 欢迎您注册成为house5用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}\r\n或者将网址复制到浏览器：{url}'',\n  ''forgetpassword'' => ''house5密码找回，请在一小时内点击下面链接进行操作：{click}\r\n或者将网址复制到浏览器：{url}'',\n  ''broker_check'' => ''0'',\n  ''esf_check'' => ''0'',\n  ''refresh_times'' => ''2'',\n  ''tags_valid'' => '''',\n  ''overtime'' => '''',\n  ''add_esf_point'' => '''',\n  ''add_rent_point'' => '''',\n)', 0, 0, '2010-09-06', '2010-09-06'),
('pay', '支付', '', 1, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('digg', '顶一下', '', 0, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('special', '专题', '', 0, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('content', '内容模块', '', 1, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('search', '全站搜索', '', 0, '1.0', '', 'array (\n  ''fulltextenble'' => ''1'',\n  ''relationenble'' => ''1'',\n  ''suggestenable'' => ''1'',\n  ''sphinxenable'' => ''0'',\n  ''sphinxhost'' => ''10.228.134.102'',\n  ''sphinxport'' => ''9312'',\n  1 => \n  array (\n    ''fulltextenble'' => ''1'',\n    ''relationenble'' => ''1'',\n    ''suggestenable'' => ''0'',\n    ''sphinxenable'' => ''0'',\n    ''sphinxhost'' => '''',\n    ''sphinxport'' => '''',\n  ),\n)', 0, 0, '2010-09-06', '2010-09-06'),
('scan', '木马扫描', 'scan', 0, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('attachment', '附件', 'attachment', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('block', '碎片', '', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('collection', '采集模块', 'collection', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('dbsource', '数据源', '', 1, '', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('template', '模板风格', '', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('release', '发布点', '', 1, '1.0', '', '', 0, 0, '2010-09-01', '2010-09-06'),
('cnzz', 'CNZZ统计', 'cnzz/', 0, '1.0', 'CNZZ统计', '', 0, 0, '2010-09-15', '2010-09-15'),
('announce', '公告', 'announce/', 0, '1.0', '公告', '', 0, 0, '2012-01-06', '2012-01-06'),
('comment', '评论', 'comment/', 0, '1.0', '评论', '', 0, 0, '2012-01-06', '2012-01-06'),
('link', '友情链接', '', 0, '1.0', '', 'array (\n  1 => \n  array (\n    ''is_post'' => ''1'',\n    ''enablecheckcode'' => ''0'',\n  ),\n)', 0, 0, '2010-09-06', '2010-09-06'),
('vote', '投票', '', 0, '1.0', '', 'array (\r\n  1 => \r\n  array (\r\n    ''default_style'' => ''default'',\r\n    ''vote_tp_template'' => ''vote_tp'',\r\n    ''allowguest'' => ''1'',\r\n    ''enabled'' => ''1'',\r\n    ''interval'' => ''1'',\r\n    ''credit'' => ''1'',\r\n  ),\r\n)', 0, 0, '2010-09-06', '2010-09-06'),
('message', '短消息', '', 0, '1.0', '', '', 0, 0, '2010-09-06', '2010-09-06'),
('mood', '新闻心情', 'mood/', 0, '1.0', '新闻心情', '', 0, 0, '2012-01-06', '2012-01-06'),
('poster', '广告模块', 'poster/', 0, '1.0', '广告模块', 'array (\n  ''enablehits'' => ''1'',\n  ''ext'' => '''',\n  ''maxsize'' => '''',\n)', 0, 0, '2012-01-06', '2012-01-06'),
('formguide', '表单向导', 'formguide/', 0, '1.0', 'formguide', 'array (\n  ''allowmultisubmit'' => ''1'',\n  ''interval'' => '''',\n  ''allowunreg'' => ''1'',\n  ''mailmessage'' => '''',\n)', 0, 0, '2010-10-20', '2010-10-20'),
('wap', '手机门户', 'wap/', 0, '1.0', '手机门户', '', 0, 0, '2012-01-06', '2012-01-06'),
('upgrade', '在线升级', '', 0, '1.0', '', '', 0, 0, '2011-05-18', '2011-05-18'),
('tag', '标签向导', 'tag/', 0, '1.0', '标签向导', '', 0, 0, '2012-01-06', '2012-01-06'),
('sms', '短信平台', 'sms/', 0, '1.0', '短信平台', 'array (\n  ''sms_enable'' => ''1'',\n  ''userid'' => ''1590'',\n  ''productid'' => ''33646'',\n  ''sms_key'' => ''828622a8dc3922394791d23ebcafe4ba'',\n)', 0, 0, '2011-09-02', '2011-09-02'),
('reviews', '点评', 'reviews/', 0, '1.0', '点评', '', 0, 0, '2010-10-30', '2010-10-30'),
('ssi', '模版碎片标签', 'ssi/', 0, '1.0', '模版碎片标签向导', '', 0, 0, '2012-09-23', '2012-09-23'),
('house5_player', 'House5 player', 'house5_player/', 0, '1.1', 'House5 player 模块配置', '', 0, 0, '2013-06-01', '2013-06-01');

-- --------------------------------------------------------

--
-- 表的结构 `h5_mood`
--

CREATE TABLE IF NOT EXISTS `h5_mood` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '???id',
  `siteid` mediumint(6) unsigned NOT NULL DEFAULT '0' COMMENT '???ID',
  `contentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '????id',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '????',
  `n1` int(10) unsigned NOT NULL DEFAULT '0',
  `n2` int(10) unsigned NOT NULL DEFAULT '0',
  `n3` int(10) unsigned NOT NULL DEFAULT '0',
  `n4` int(10) unsigned NOT NULL DEFAULT '0',
  `n5` int(10) unsigned NOT NULL DEFAULT '0',
  `n6` int(10) unsigned NOT NULL DEFAULT '0',
  `n7` int(10) unsigned NOT NULL DEFAULT '0',
  `n8` int(10) unsigned NOT NULL DEFAULT '0',
  `n9` int(10) unsigned NOT NULL DEFAULT '0',
  `n10` int(10) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '?????????',
  PRIMARY KEY (`id`),
  KEY `total` (`total`),
  KEY `lastupdate` (`lastupdate`),
  KEY `catid` (`catid`,`siteid`,`contentid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_mood`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_news`
--

CREATE TABLE IF NOT EXISTS `h5_news` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(40) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `newstype` tinyint(3) NOT NULL DEFAULT '0',
  `video` varchar(255) NOT NULL DEFAULT '',
  `initialviews` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=1555 ;

--
-- 导出表中的数据 `h5_news`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_news_data`
--

CREATE TABLE IF NOT EXISTS `h5_news_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` mediumtext NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `voteid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `copyfrom` varchar(100) NOT NULL DEFAULT '',
  `xglp` varchar(255) NOT NULL DEFAULT '',
  `xgtk` mediumint(8) DEFAULT '0',
  `xgsp` mediumint(8) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_news_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_page`
--

CREATE TABLE IF NOT EXISTS `h5_page` (
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(160) NOT NULL,
  `style` varchar(24) NOT NULL,
  `keywords` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `template` varchar(30) NOT NULL,
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_page`
--

INSERT INTO `h5_page` (`catid`, `title`, `style`, `keywords`, `content`, `template`, `updatetime`) VALUES
(2, '关于我们', ';', '关于我们', '\r\n', '', 0),
(3, '联系我们', ';', '', '联系我们', '', 0),
(4, '版权声明', ';', '', '版权声明', '', 0),
(5, '招聘信息', ';', '招聘信息', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_pay_account`
--

CREATE TABLE IF NOT EXISTS `h5_pay_account` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `trade_sn` char(50) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `contactname` char(50) NOT NULL,
  `email` char(40) NOT NULL,
  `telephone` char(20) NOT NULL,
  `discount` float(8,2) NOT NULL DEFAULT '0.00',
  `money` char(8) NOT NULL,
  `quantity` int(8) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) NOT NULL DEFAULT '0',
  `paytime` int(10) NOT NULL DEFAULT '0',
  `usernote` char(255) NOT NULL,
  `pay_id` tinyint(3) NOT NULL,
  `pay_type` enum('offline','recharge','selfincome','online') NOT NULL DEFAULT 'recharge',
  `payment` char(90) NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '1',
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0',
  `status` enum('succ','failed','error','progress','timeout','cancel','waitting','unpay') NOT NULL DEFAULT 'unpay',
  `adminnote` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `userid` (`userid`),
  KEY `trade_sn` (`trade_sn`,`money`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_pay_account`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_pay_payment`
--

CREATE TABLE IF NOT EXISTS `h5_pay_payment` (
  `pay_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `pay_name` varchar(120) NOT NULL,
  `pay_code` varchar(20) NOT NULL,
  `pay_desc` text NOT NULL,
  `pay_method` tinyint(1) DEFAULT NULL,
  `pay_fee` varchar(10) NOT NULL,
  `config` text NOT NULL,
  `is_cod` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_online` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `pay_code` (`pay_code`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_pay_payment`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_pay_spend`
--

CREATE TABLE IF NOT EXISTS `h5_pay_spend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creat_at` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `logo` varchar(20) NOT NULL,
  `value` int(5) NOT NULL,
  `op_userid` int(10) unsigned NOT NULL DEFAULT '0',
  `op_username` char(20) NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `creat_at` (`creat_at`),
  KEY `logo` (`logo`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_pay_spend`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_pic`
--

CREATE TABLE IF NOT EXISTS `h5_pic` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `initialviews` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `h5_pic`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_picture`
--

CREATE TABLE IF NOT EXISTS `h5_picture` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `h5_picture`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_picture_data`
--

CREATE TABLE IF NOT EXISTS `h5_picture_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `relation` int(10) unsigned NOT NULL DEFAULT '0',
  `pictureurls` mediumtext NOT NULL,
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_picture_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_pic_data`
--

CREATE TABLE IF NOT EXISTS `h5_pic_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `pictureurls` mediumtext NOT NULL,
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_pic_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_player`
--

CREATE TABLE IF NOT EXISTS `h5_player` (
  `id` tinyint(1) NOT NULL DEFAULT '1',
  `video_type` tinyint(1) NOT NULL DEFAULT '0',
  `video_default_status` tinyint(1) NOT NULL DEFAULT '1',
  `ck_http_set` tinyint(1) NOT NULL DEFAULT '0',
  `video_url` char(255) DEFAULT NULL,
  `ck_style` char(100) DEFAULT NULL,
  `thumb_load` varchar(100) DEFAULT NULL,
  `thumb_pause_ad` varchar(100) DEFAULT NULL,
  `url_pause_ad` char(255) DEFAULT NULL,
  `thumb_qz_ad` varchar(100) DEFAULT NULL,
  `url_qz_ad` char(255) DEFAULT NULL,
  `time_qz_ad` char(50) DEFAULT NULL,
  `beff_ad` char(255) DEFAULT NULL,
  `text_ad` text,
  `ck_volume` char(2) NOT NULL DEFAULT '80',
  `ck_size` char(10) NOT NULL DEFAULT '600|400',
  `ck_html5` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_player`
--

INSERT INTO `h5_player` (`id`, `video_type`, `video_default_status`, `ck_http_set`, `video_url`, `ck_style`, `thumb_load`, `thumb_pause_ad`, `url_pause_ad`, `thumb_qz_ad`, `url_qz_ad`, `time_qz_ad`, `beff_ad`, `text_ad`, `ck_volume`, `ck_size`, `ck_html5`) VALUES
(1, 3, 1, 0, '', '', '', '', '', '', '', '0', '', '{a href="http://www.house5.net"}{font color="#FFFFFF" size="12"}这里可以放文字广告。这里可以放文字广告。这里可以放文字广告。{/font}{/a}', '80', '620|465', 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_plugin`
--

CREATE TABLE IF NOT EXISTS `h5_plugin` (
  `pluginid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `appid` int(10) DEFAULT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `identification` varchar(40) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `datatables` varchar(255) NOT NULL DEFAULT '',
  `dir` varchar(100) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `setting` text NOT NULL,
  `iframe` text NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '',
  `listorder` tinyint(3) NOT NULL DEFAULT '0',
  `disable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pluginid`),
  UNIQUE KEY `identification` (`identification`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_plugin`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_plugin_var`
--

CREATE TABLE IF NOT EXISTS `h5_plugin_var` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pluginid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `fieldname` varchar(40) NOT NULL DEFAULT '',
  `fieldtype` varchar(20) NOT NULL DEFAULT 'text',
  `value` text NOT NULL,
  `setting` text NOT NULL,
  `formattribute` varchar(255) DEFAULT NULL,
  `listorder` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pluginid` (`pluginid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=9 ;

--
-- 导出表中的数据 `h5_plugin_var`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_position`
--

CREATE TABLE IF NOT EXISTS `h5_position` (
  `posid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned DEFAULT '0',
  `catid` smallint(5) unsigned DEFAULT '0',
  `name` char(30) NOT NULL DEFAULT '',
  `maxnum` smallint(5) NOT NULL DEFAULT '20',
  `extention` char(100) DEFAULT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `thumb` char(200) NOT NULL,
  PRIMARY KEY (`posid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=85 ;

--
-- 导出表中的数据 `h5_position`
--

INSERT INTO `h5_position` (`posid`, `modelid`, `catid`, `name`, `maxnum`, `extention`, `listorder`, `siteid`, `thumb`) VALUES
(1, 0, 0, '首页焦点图推荐', 20, '', 99, 1, ''),
(2, 1, 0, '首页_头条1', 20, '', 90, 1, ''),
(13, 82, 0, '栏目页焦点图', 20, '', 0, 1, ''),
(5, 1, 20, '旅游地产_首页焦点图', 5, '', 58, 1, ''),
(9, 13, 0, '首页_搜索框下推荐楼盘', 20, '', 77, 1, ''),
(10, 0, 0, '栏目首页推荐', 20, '', 40, 1, ''),
(12, 1, 0, '资讯首页_图片新闻焦点图', 5, '', 18, 1, ''),
(14, 1, 0, '内容_标题下 推荐1', 20, '', 16, 1, ''),
(15, 13, 14, '新房首页_推荐楼盘', 100, '', 70, 1, ''),
(16, 13, 14, '新房首页_推荐户型', 4, '', 65, 1, ''),
(17, 13, 14, '新房首页_推荐样板间', 4, '', 64, 1, ''),
(18, 1, 46, '商业地产_首页焦点图', 5, '', 59, 1, ''),
(19, 13, 0, '在售商业地产推荐', 8, '', 30, 1, ''),
(20, 13, 0, '在售旅游地产推荐', 8, '', 25, 1, ''),
(21, 13, 0, '精品商业地产Ⅰ', 2, '', 28, 1, ''),
(22, 13, 0, '精品旅游地产Ⅰ', 2, '', 24, 1, ''),
(23, 13, 0, '精品商业地产Ⅱ', 5, '', 26, 1, ''),
(24, 13, 0, '精品旅游地产Ⅱ', 5, '', 23, 1, ''),
(25, 1, 0, '资讯_首页焦点图', 5, '', 20, 1, ''),
(26, 13, 0, '首页_精品楼盘1（2图）', 2, '', 80, 1, ''),
(27, 13, 0, '首页_精品楼盘2（8条）', 10, '', 79, 1, ''),
(28, 13, 0, '首页_推荐楼盘1（7图）', 7, '', 82, 1, ''),
(29, 13, 0, '首页_推荐楼盘2（7图）', 21, '', 81, 1, ''),
(30, 1, 0, '资讯_右侧图片推荐', 20, '', 17, 1, ''),
(31, 1, 0, '内容_标题下 推荐2', 20, '', 15, 1, ''),
(32, 1, 0, '内容_标题下 图1', 20, '', 14, 1, ''),
(33, 1, 0, '内容_标题下 图2', 20, '', 13, 1, ''),
(42, 1, 0, '资讯_首页精品推荐', 20, '', 19, 1, ''),
(35, 1, 0, '首页_头条2', 20, '', 89, 1, ''),
(36, 1, 0, '首页_头条3', 20, '', 88, 1, ''),
(37, 1, 0, '首页_头条1_下5条', 20, '', 87, 1, ''),
(38, 1, 0, '首页_头条2_下4条', 20, '', 86, 1, ''),
(39, 1, 0, '首页_头条3_下4条', 20, '', 85, 1, ''),
(40, 1, 0, '右侧视频推荐', 20, '', 10, 1, ''),
(43, 1, 0, '看房团首页_优惠打折信息', 20, '', 22, 1, ''),
(44, 13, 0, '看房团首页_热点楼盘团购', 20, '', 21, 1, ''),
(45, 21, 74, '新房首页推荐楼盘', 100, '', 58, 2, ''),
(46, 21, 74, '新房首页推荐户型', 4, '', 55, 2, ''),
(47, 21, 74, '新房首页推荐样板间', 4, '', 54, 2, ''),
(48, 21, 74, '首页_精品楼盘1（2图）', 2, '', 57, 2, ''),
(49, 21, 74, '首页_精品楼盘2（8条）', 8, '', 56, 2, ''),
(50, 23, 0, '内容_标题下 推荐1', 20, '', 16, 2, ''),
(51, 23, 0, '内容_标题下 推荐2', 20, '', 15, 2, ''),
(52, 23, 0, '内容_标题下 图1', 20, '', 14, 2, ''),
(53, 23, 0, '内容_标题下 图2', 20, '', 13, 2, ''),
(54, 23, 0, '资讯_首页焦点图', 20, '', 25, 2, ''),
(55, 21, 74, '首页_推荐楼盘1（7图）', 20, '', 82, 2, ''),
(56, 21, 74, '首页_推荐楼盘2（7图）', 20, '', 81, 2, ''),
(57, 23, 0, '首页焦点图推荐', 20, '', 99, 2, ''),
(58, 23, 0, '首页_头条1', 20, '', 90, 2, ''),
(59, 23, 0, '首页_头条2', 20, '', 89, 2, ''),
(60, 23, 0, '首页_头条3', 20, '', 88, 2, ''),
(61, 23, 0, '首页_头条1_下5条', 20, '', 87, 2, ''),
(62, 23, 0, '首页_头条2_下4条', 20, '', 86, 2, ''),
(63, 23, 0, '首页_头条3_下4条', 20, '', 85, 2, ''),
(64, 21, 0, '首页_精品楼盘1（2图）', 20, '', 80, 2, ''),
(65, 21, 0, '首页_精品楼盘2（8条）', 20, '', 79, 2, ''),
(66, 21, 0, '首页_搜索框下推荐楼盘', 20, '', 77, 2, ''),
(67, 23, 0, '栏目首页推荐', 100, '', 42, 2, ''),
(69, 21, 0, '在售商业地产推荐', 20, '', 30, 2, ''),
(34, 1, 0, '[新1]大头条', 1, '', 0, 1, ''),
(71, 13, 14, '新房楼盘超市页_推广楼盘', 20, '', 22, 1, ''),
(72, 21, 74, '新房_楼盘超市_推广楼盘', 20, '', 0, 2, ''),
(73, 23, 0, '资讯_首页精品推荐', 20, '', 0, 2, ''),
(75, 29, 0, '新房首页推荐楼盘', 100, '', 58, 3, ''),
(76, 29, 0, '新房首页推荐户型', 4, '', 52, 3, ''),
(77, 29, 0, '新房首页推荐样板间', 4, '', 51, 3, ''),
(78, 29, 0, '推广楼盘', 4, '', 50, 3, ''),
(79, 29, 0, '首页_推荐楼盘1（7图）', 20, '', 80, 3, ''),
(80, 29, 0, '首页_推荐楼盘2（7图）', 20, '', 79, 3, ''),
(81, 29, 0, '首页_搜索框下推荐楼盘', 20, '', 75, 3, ''),
(82, 1, 6, '微信专栏', 100, '', 0, 1, ''),
(83, 13, 0, '看房团-备选楼盘', 20, '', 21, 1, ''),
(84, 1, 6, '二手房首页焦点图', 20, '', 0, 1, ''),
(41, 1, 0, '[新1]大头条下3条', 20, '', 0, 1, ''),
(8, 1, 53, '家居首页_焦点图', 20, '', 0, 1, ''),
(11, 1, 53, '家居首页_头条', 20, '', 0, 1, ''),
(74, 4, 0, '图库_播放结束推荐', 20, '', 10, 1, ''),
(7, 5, 0, '视频首页焦点图', 20, '', 80, 1, ''),
(68, 4, 0, '图库_首页焦点图', 20, '', 11, 1, ''),
(70, 4, 0, '图库内页_推荐组图', 20, '', 10, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_position_data`
--

CREATE TABLE IF NOT EXISTS `h5_position_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `posid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` char(20) DEFAULT NULL,
  `modelid` smallint(6) unsigned DEFAULT '0',
  `thumb` tinyint(1) NOT NULL DEFAULT '0',
  `data` mediumtext,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `listorder` mediumint(8) DEFAULT '0',
  `expiration` int(10) NOT NULL,
  `extention` char(30) DEFAULT NULL,
  `synedit` tinyint(1) DEFAULT '0',
  KEY `posid` (`posid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_position_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_poster`
--

CREATE TABLE IF NOT EXISTS `h5_poster` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL,
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `setting` text NOT NULL,
  `startdate` int(10) unsigned NOT NULL DEFAULT '0',
  `enddate` int(10) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `clicks` smallint(5) unsigned NOT NULL DEFAULT '0',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `spaceid` (`spaceid`,`siteid`,`disabled`,`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=52 ;

--
-- 导出表中的数据 `h5_poster`
--

INSERT INTO `h5_poster` (`id`, `siteid`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(27, 1, '房产广告1', 25, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310090926181.swf'',  ),)', 1362877561, 1418172900, 1362877630, 0, 0, 0, 0),
(44, 1, 'house5公益广告1', 52, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house.net/'', ''imageurl'' => ''/uploadfile/2013/0315/20130315093425302.jpg'', ''alt'' => '''',  ),)', 1363354453, 1418172900, 1363354501, 0, 2, 0, 0),
(43, 1, 'House5公益广告32', 51, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0313/20130313081249828.jpg'', ''alt'' => ''房地产门户网站程序'',  ),)', 1363176741, 1418172900, 1363176780, 0, 0, 0, 0),
(20, 1, '看房团QQ群', 19, 'text', 'array (  ''code'' => ''<ul>\r<li>1群：165356415</li>\r<li>2群：102500690</li>\r<li>3满：53109199</li>\r<li>4群：29781122</li>\r<li>5满：95725954</li>\r</ul>\r\r\r\r\r\r'',)', 1336725316, 1418172900, 1336725446, 0, 0, 0, 0),
(19, 1, '首页业主社区右侧广告', 18, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.bluebbs.com/forum.php?gid=10'', ''imageurl'' => ''http://www.venfang.com/uploadfile/2012/0508/20120508083026144.png'', ''alt'' => ''业主社区'',  ),)', 1336437008, 1418172900, 1336437060, 0, 4, 0, 0),
(41, 1, '招商进行中', 45, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310093755711.swf'',  ),)', 1362981445, 1418172900, 1362981596, 0, 0, 0, 0),
(42, 1, 'House5公益广告23', 50, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0312/20130312014101599.jpg'', ''alt'' => ''房地产门户网站程序'',  ),)', 1363066206, 1418172900, 1363066228, 0, 0, 0, 0),
(11, 1, '业主交流QQ群', 11, 'text', 'array (  ''code'' => ''<ul>\r<li>华润威海湾九里：252727689 </li>\r<li>	山海顺沁苑：102604344(快满)</li>\r<li>\r		乳山湖畔人家业主群：16548549</li>\r<li>\r		永兴园业主群：109772688</li>\r<li>\r		蓝山海岸业主交流群：106865780</li>\r<li>高新城市广场：235113980</li>\r<li>威百望海园：29644198</li>\r</ul>'',)', 1335920642, 1418172900, 1335920735, 0, 0, 0, 0),
(12, 1, '左侧竖 6条', 12, 'text', 'array (  ''code'' => ''<li><a href="http://house.venfang.com/list.html" target="_blank"><font color=blue>看房选房请到——楼盘超市</font></a></li>\r<li><a href="http://www.veryhome.com/news-art/30211.html" target="_blank">丰荟董事长谈康居示范工程</a></li>\r<li><a href="http://news.venfang.com/2012/bendi_0804/16693.html" target="_blank"><font color=red>长青海宴台情景示范区绽放</font></a></li>\r<li><a href="http://www.venfang.com/news/special/20120728/" target="_blank">2012年伦敦奥运会精彩专题</a></li>\r<li><a href="http://www.veryhome.com/news-art/29484.html" target="_blank">访工友房地产总经理杨松柏</a></li>\r<li><a href="http://www.veryhome.com/news-art/33638.html?1337149910" target="_blank"><font color=red>保利凯旋公馆品质感动威海</font></a></li>'',)', 1335921274, 1418172900, 1335921397, 0, 0, 0, 0),
(14, 1, '顶部4条', 13, 'text', 'array (  ''code'' => ''<a href="http://news.venfang.com/2012/bendi_0917/18493.html">\r海宴台中南海国医养生会</a>\r<a href="http://news.venfang.com/2012/bendi_0817/17219.html" target="_blank"><font color="red">华润威海湾九里盛世加推</font></a>\r<a href="http://www.venfang.com/weixin/" target="_blank"><font color="blue">关注问房网官方微信</font></a>\r<a href="http://news.venfang.com/2012/bendi_0812/16985.html" target="_blank">2012荣成海洋沙滩音乐节启幕</a>'',)', 1335921848, 1418172900, 1335921859, 0, 0, 0, 0),
(15, 1, '底部 4条', 14, 'text', 'array (  ''code'' => ''<a href="http://news.venfang.com/2012/bendi_0819/17265.html" target="_blank"><font color=blue>舌尖上的世界 品鉴葡萄酒</font></a> <a href="http://www.venfang.com/news/special/20120820/" target="_blank">\r长青海宴台：国宴饕餮夜</a>\r  <a href="http://www.venfang.com/news/special/20120818/" target="_blank">幸福威海之歌新闻发布会 <a href="http://www.veryhome.com" target="_blank"><font color=red>房产门户：威海房地产网</font></a>'',)', 1335921952, 1418172900, 1335921973, 0, 0, 0, 0),
(16, 1, '右侧竖 6条', 15, 'text', 'array (  ''code'' => ''<li><a href="http://house.venfang.com/227/" target="_blank">纹石宝滩-中国低碳节能楼盘</a></li>\r<li><a href="http://house.venfang.com/247/" target="_blank">蓝山海岸-面朝大海春暖花开</a></li>\r<li><a href="http://house.venfang.com/285/" target="_blank">莱茵小镇-威海首席湖居生活</a></li>\r<li><a href="http://house.venfang.com/63/" target="_blank">林海花园-天鹅湖畔环保精品</a></li>\r<li><a href="http://house.venfang.com/248/" target="_blank">仁和佳苑-都市里的山水家园</a></li>\r<li><a href="http://house.venfang.com/159/" target="_blank"><font color=red>\r唐人海湾公馆-威海地标建筑</font></a></li>'',)', 1335922025, 1418172900, 1335922039, 0, 0, 0, 0),
(24, 1, 'House5', 17, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''http://www.house5.cn/uploadfile/2013/0304/20130304023304371.jpg'', ''alt'' => ''House5房地产网站程序'',  ),)', 1362875865, 1418172900, 1362875896, 0, 1, 0, 0),
(25, 1, 'House5公益广告0', 17, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0310/20130310084341458.jpg'', ''alt'' => ''House5房地产网站程序'',  ),)', 1362875996, 1418172900, 1362876044, 0, 2, 0, 0),
(26, 1, 'House5公益广告8', 34, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0310/20130310085611384.jpg'', ''alt'' => ''房地产门户网站程序'',  ),)', 1362876953, 1418172900, 1362876984, 0, 0, 0, 0),
(22, 1, '首页通栏2', 26, 'images', 'array (  1 =>   array ( ''linkurl'' => '''', ''imageurl'' => ''/uploadfile/2013/0306/20130306105949981.jpg'', ''alt'' => '''',  ),)', 1362740082, 1418172900, 1362740106, 0, 0, 0, 0),
(28, 1, 'House5公益广告9', 26, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310091045755.swf'',  ),)', 1362877818, 1418172900, 1362877848, 0, 0, 0, 0),
(30, 1, 'House5公益广告11', 28, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310091225979.swf'',  ),)', 1362877916, 1418172900, 1362877952, 0, 0, 0, 0),
(31, 1, 'House5公益广告12', 32, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310090926181.swf'',  ),)', 1362878002, 1418172900, 1362878029, 0, 0, 0, 0),
(32, 1, 'House5公益广告13', 35, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0310/20130310091822332.jpg'', ''alt'' => ''房地产门户网站程序'',  ),  2 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0310/20130310091822332.jpg'', ''alt'' => ''房地产门户网站程序'',  ),)', 1362878291, 1418172900, 1362878330, 0, 0, 0, 0),
(35, 1, 'House5公益广告16', 37, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310093551829.swf'',  ),)', 1362879341, 1418172900, 1362879358, 0, 0, 0, 0),
(34, 1, 'House5公益广告15', 36, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310093447384.swf'',  ),)', 1362879220, 1418172900, 1362879239, 0, 0, 0, 0),
(36, 1, 'House5公益广告17', 38, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310093638576.swf'',  ),)', 1362879365, 1418172900, 1362879412, 0, 0, 0, 0),
(37, 1, 'House5公益广告18', 39, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310093755711.swf'',  ),)', 1362879430, 1418172900, 1362879481, 0, 0, 0, 0),
(38, 1, 'House5公益广告19', 40, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310090926181.swf'',  ),)', 1362879527, 1418172900, 1362879548, 0, 0, 0, 0),
(39, 1, 'House5公益广告20', 41, 'flash', 'array (  1 =>   array ( ''flashurl'' => ''/uploadfile/2013/0310/20130310091045755.swf'',  ),)', 1362879569, 1418172900, 1362879583, 0, 0, 0, 0),
(40, 1, 'House5公益广告21', 44, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0310/20130310022033405.jpg'', ''alt'' => ''房地产门户网站程序'',  ),)', 1362896305, 1418172900, 1362896444, 0, 0, 0, 0),
(45, 1, 'house5 公益广告2', 53, 'images', 'array (  1 =>   array ( ''linkurl'' => ''http://www.house5.net'', ''imageurl'' => ''/uploadfile/2013/0315/20130315093539748.jpg'', ''alt'' => '''',  ),)', 1363354513, 1418172900, 1363354562, 0, 0, 0, 0),
(46, 1, '[新1]首页一屏右下', 202, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''#'',\n    ''imageurl'' => ''http://ubmcmm.baidustatic.com/media/v1/0f000rdTMSuUQBeJ2digs0.gif'',\n    ''alt'' => '''',\n  ),\n)', 1371885697, 1468480860, 1371885729, 0, 299, 0, 0),
(47, 1, '[新1]首页-新房中心-小广告', 204, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.cn'',\n    ''imageurl'' => ''http://demo1.house5.net/uploadfile/2013/0627/20130627031720932.jpg'',\n    ''alt'' => ''[新1]首页-新房中心-小广告'',\n  ),\n)', 1372317405, 1392794160, 1372317442, 0, 2, 0, 0),
(48, 1, '[新1]资讯首页-右侧', 207, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.cn'',\n    ''imageurl'' => ''http://demo1.house5.net/uploadfile/2013/0702/20130702010108686.png'',\n    ''alt'' => '''',\n  ),\n)', 1372741220, 1423630800, 1372741579, 0, 6, 0, 0),
(49, 1, '[新1]资讯首页-左侧画中画', 208, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.cn'',\n    ''imageurl'' => ''http://demo1.house5.net/uploadfile/2013/0701/20130701011700783.jpg'',\n    ''alt'' => '''',\n  ),\n)', 1372741921, 1454476320, 1372741951, 0, 1, 0, 0),
(50, 1, '扫一扫', 16, 'flash', 'array (\n  1 => \n  array (\n    ''flashurl'' => ''http://img2.tbcdn.cn/tfscom/T1F1SkFgtfXXXtxVjX.swf'',\n  ),\n)', 1376789359, 1484011740, 1376789379, 0, 0, 0, 0),
(51, 1, '扫一扫右', 24, 'flash', 'array (\n  1 => \n  array (\n    ''flashurl'' => ''http://img2.tbcdn.cn/tfscom/T1F1SkFgtfXXXtxVjX.swf'',\n  ),\n)', 1376789394, 1484011740, 1376789412, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_poster_201308`
--

CREATE TABLE IF NOT EXISTS `h5_poster_201308` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=203 ;

--
-- 导出表中的数据 `h5_poster_201308`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_poster_201309`
--

CREATE TABLE IF NOT EXISTS `h5_poster_201309` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=109 ;

--
-- 导出表中的数据 `h5_poster_201309`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_poster_201407`
--

CREATE TABLE IF NOT EXISTS `h5_poster_201407` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `spaceid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `area` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `referer` char(120) NOT NULL,
  `clicktime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`,`type`,`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_poster_201407`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_poster_space`
--

CREATE TABLE IF NOT EXISTS `h5_poster_space` (
  `spaceid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(50) NOT NULL,
  `type` char(30) NOT NULL,
  `path` char(40) NOT NULL,
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `setting` char(100) NOT NULL,
  `description` char(100) NOT NULL,
  `items` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`spaceid`),
  KEY `disabled` (`disabled`,`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=209 ;

--
-- 导出表中的数据 `h5_poster_space`
--

INSERT INTO `h5_poster_space` (`spaceid`, `siteid`, `name`, `type`, `path`, `width`, `height`, `setting`, `description`, `items`, `disabled`) VALUES
(36, 1, '首页通栏广告8', 'banner', 'poster_js/36.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(50, 1, '楼盘首页_业主交流群_下广告', 'banner', 'poster_js/50.js', 310, 168, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(49, 1, '楼盘首页通栏3', 'banner', 'poster_js/49.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(48, 1, '楼盘首页通栏2', 'banner', 'poster_js/48.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(22, 1, '首页二手房租房', 'banner', 'poster_js/22.js', 330, 65, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(21, 1, '首页视角中栏小横幅', 'banner', 'poster_js/21.js', 350, 35, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(20, 1, '看房团首页底部-活动回顾', 'banner', 'poster_js/20.js', 940, 200, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '看房团首页底部-活动回顾', 0, 0),
(19, 1, '看房团QQ群', 'code', '{show_ad(1, 19)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '看房团QQ群', 1, 0),
(18, 1, '首页业主社区右侧广告', 'banner', 'poster_js/18.js', 232, 143, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(45, 1, '楼盘首页通栏1', 'banner', 'poster_js/45.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(11, 1, '业主交流QQ群', 'code', '{show_ad(1, 11)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '业主交流QQ群', 1, 0),
(12, 1, '首页推荐box -左侧竖 6条', 'code', '{show_ad(1, 12)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '首页顶部 -左侧竖 6条', 1, 0),
(13, 1, '首页推荐box -顶部 4条', 'code', '{show_ad(1, 13)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '首页推荐box -顶部 4条', 1, 0),
(14, 1, '首页推荐box -底部 4条', 'code', '{show_ad(1, 14)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '首页推荐box -底部 4条', 1, 0),
(15, 1, '首页推荐box -右侧竖 6条', 'code', '{show_ad(1, 15)}', 0, 0, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '首页顶部 -右侧竖 6条', 1, 0),
(35, 1, '首页对联广告', 'couplet', 'poster_js/35.js', 97, 240, 'array ( ''scroll'' => ''1'', ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(17, 1, '首页推荐box 中间广告', 'imagechange', 'poster_js/17.js', 590, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 2, 0),
(23, 1, '新房首页广告', 'banner', 'poster_js/23.js', 310, 260, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(25, 1, '全站通栏广告1', 'banner', 'poster_js/25.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(26, 1, '首页通栏2', 'banner', 'poster_js/26.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 2, 0),
(27, 1, '首页通栏3', 'banner', 'poster_js/27.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(28, 1, '首页通栏4', 'banner', 'poster_js/28.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(29, 1, '首页通栏5', 'banner', 'poster_js/29.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(34, 1, '首页房产家居右侧', 'banner', 'poster_js/34.js', 232, 143, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(31, 1, '首页通栏6', 'banner', 'poster_js/31.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(32, 1, '首页通栏7', 'banner', 'poster_js/32.js', 960, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(33, 1, '首页专题栏目条上', 'banner', 'poster_js/33.js', 200, 20, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(37, 1, '首页通栏广告9', 'banner', 'poster_js/37.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(38, 1, '首页通栏广告10', 'banner', 'poster_js/38.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(39, 1, '首页通栏广告11', 'banner', 'poster_js/39.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(40, 1, '首页通栏广告12', 'banner', 'poster_js/40.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(41, 1, '首页通栏广告13', 'banner', 'poster_js/41.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(42, 1, '资讯首页顶部通栏1', 'banner', 'poster_js/42.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(43, 1, '资讯首页通栏2', 'banner', 'poster_js/43.js', 960, 70, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 0, 0),
(44, 1, '新闻列表右侧小横幅1', 'banner', 'poster_js/44.js', 300, 300, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(51, 1, '家居首页顶部', 'banner', 'poster_js/51.js', 200, 60, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(52, 1, '二手房首页-右侧1', 'banner', 'poster_js/52.js', 202, 255, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(53, 1, '二手房首页-右侧2', 'banner', 'poster_js/53.js', 202, 213, 'array ( ''paddleft'' => '''', ''paddtop'' => '''')', '', 1, 0),
(46, 1, '图库首页通栏', 'banner', 'poster_js/46.js', 960, 80, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 1, 0),
(16, 1, '视频播放内页广告-左', 'banner', 'poster_js/16.js', 170, 465, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 2, 0),
(24, 1, '视频播放内页广告-右', 'banner', 'poster_js/24.js', 170, 465, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 2, 0),
(200, 1, '[新]BOX小画中画L', 'banner', 'poster_js/54.js', 140, 130, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '新首页广告 小画中画左', 0, 0),
(201, 1, '[新]BOX小画中画R', 'banner', 'poster_js/55.js', 140, 130, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '[新]BOX小画中画右', 0, 0),
(202, 1, '[新1]首页一屏右下', 'banner', 'poster_js/202.js', 250, 75, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '[新1]首页一屏右下250X75', 1, 0),
(203, 1, '[新1]首页-新房中心右下', 'banner', 'poster_js/203.js', 650, 85, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '[新1]首页-新房中心右下', 0, 0),
(204, 1, '[新1]首页-新房中心-小广告', 'banner', 'poster_js/204.js', 325, 106, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 1, 0),
(205, 1, '[新1]首页-通栏8', 'banner', 'poster_js/205.js', 960, 70, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 0, 0),
(206, 1, '[新1]首页-通栏9', 'banner', 'poster_js/206.js', 960, 70, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 0, 0),
(207, 1, '[新1]资讯首页-右侧', 'banner', 'poster_js/207.js', 280, 195, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 1, 0),
(208, 1, '[新1]资讯首页-左侧画中画', 'banner', 'poster_js/208.js', 300, 190, 'array (\n  ''paddleft'' => '''',\n  ''paddtop'' => '''',\n)', '', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_price`
--

CREATE TABLE IF NOT EXISTS `h5_price` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '',
  `trend` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `addtime` date DEFAULT NULL,
  `type` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=525 ;

--
-- 导出表中的数据 `h5_price`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_price_data`
--

CREATE TABLE IF NOT EXISTS `h5_price_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_price_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_queue`
--

CREATE TABLE IF NOT EXISTS `h5_queue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` char(5) DEFAULT NULL,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `path` varchar(100) DEFAULT NULL,
  `status1` tinyint(1) DEFAULT '0',
  `status2` tinyint(1) DEFAULT '0',
  `status3` tinyint(1) DEFAULT '0',
  `status4` tinyint(1) DEFAULT '0',
  `times` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`),
  KEY `times` (`times`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_queue`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_release_point`
--

CREATE TABLE IF NOT EXISTS `h5_release_point` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `port` varchar(10) DEFAULT '21',
  `pasv` tinyint(1) DEFAULT '0',
  `ssl` tinyint(1) DEFAULT '0',
  `path` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_release_point`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_reviews`
--

CREATE TABLE IF NOT EXISTS `h5_reviews` (
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
  `startype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `starnum` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tableid` mediumint(8) unsigned DEFAULT '0',
  `lastupdate` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`reviewsid`),
  KEY `lastupdate` (`lastupdate`),
  KEY `siteid` (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_reviews`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_reviews_check`
--

CREATE TABLE IF NOT EXISTS `h5_reviews_check` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reviews_data_id` int(10) DEFAULT '0',
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  `tableid` mediumint(8) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`),
  KEY `reviews_data_id` (`reviews_data_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_reviews_check`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_reviews_data_1`
--

CREATE TABLE IF NOT EXISTS `h5_reviews_data_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reviewsid` char(30) NOT NULL DEFAULT '',
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  `userid` int(10) unsigned DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `creat_at` int(10) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `advantage` text,
  `disadvantage` text,
  `content` text,
  `direction` tinyint(1) DEFAULT '0',
  `support` mediumint(8) unsigned DEFAULT '0',
  `star1` tinyint(1) unsigned DEFAULT '0',
  `star2` tinyint(1) unsigned DEFAULT '0',
  `star3` tinyint(1) unsigned DEFAULT '0',
  `star4` tinyint(1) unsigned DEFAULT '0',
  `star5` tinyint(1) unsigned DEFAULT '0',
  `star6` tinyint(1) unsigned DEFAULT '0',
  `startype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `starnum` tinyint(1) unsigned NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`),
  KEY `reviewsid` (`reviewsid`),
  KEY `direction` (`direction`),
  KEY `siteid` (`siteid`),
  KEY `support` (`support`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_reviews_data_1`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_reviews_setting`
--

CREATE TABLE IF NOT EXISTS `h5_reviews_setting` (
  `siteid` smallint(5) NOT NULL DEFAULT '0',
  `guest` tinyint(1) DEFAULT '0',
  `check` tinyint(1) DEFAULT '0',
  `code` tinyint(1) DEFAULT '0',
  `add_point` tinyint(3) unsigned DEFAULT '0',
  `del_point` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_reviews_setting`
--

INSERT INTO `h5_reviews_setting` (`siteid`, `guest`, `check`, `code`, `add_point`, `del_point`) VALUES
(1, 1, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_reviews_table`
--

CREATE TABLE IF NOT EXISTS `h5_reviews_table` (
  `tableid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `total` int(10) unsigned DEFAULT '0',
  `creat_at` int(10) DEFAULT '0',
  PRIMARY KEY (`tableid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_reviews_table`
--

INSERT INTO `h5_reviews_table` (`tableid`, `total`, `creat_at`) VALUES
(1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_room`
--

CREATE TABLE IF NOT EXISTS `h5_room` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `character` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `floor` int(10) unsigned NOT NULL DEFAULT '0',
  `height` float unsigned NOT NULL DEFAULT '0',
  `jzmj` int(10) unsigned NOT NULL DEFAULT '0',
  `tnmj` int(10) unsigned NOT NULL DEFAULT '0',
  `ftmj` int(10) unsigned NOT NULL DEFAULT '0',
  `price` varchar(255) NOT NULL DEFAULT '',
  `totalprice` varchar(255) NOT NULL DEFAULT '',
  `xszt` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `h5_room`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_room_data`
--

CREATE TABLE IF NOT EXISTS `h5_room_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` int(10) unsigned NOT NULL DEFAULT '0',
  `pictureurls` mediumtext NOT NULL,
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_room_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_search`
--

CREATE TABLE IF NOT EXISTS `h5_search` (
  `searchid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adddate` int(10) unsigned NOT NULL,
  `data` text NOT NULL,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`searchid`),
  KEY `typeid` (`typeid`,`id`),
  KEY `siteid` (`siteid`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_search`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_search_keyword`
--

CREATE TABLE IF NOT EXISTS `h5_search_keyword` (
  `keyword` char(20) NOT NULL,
  `pinyin` char(20) NOT NULL,
  `searchnums` int(10) unsigned NOT NULL,
  `data` char(20) NOT NULL,
  `keywordid` int(16) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`keywordid`),
  UNIQUE KEY `keyword` (`keyword`),
  UNIQUE KEY `pinyin` (`pinyin`),
  FULLTEXT KEY `data` (`data`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_search_keyword`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_selldata`
--

CREATE TABLE IF NOT EXISTS `h5_selldata` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `pubdate` date DEFAULT NULL,
  `hcqts` varchar(255) NOT NULL DEFAULT '',
  `hcqmj` varchar(255) NOT NULL DEFAULT '',
  `jqts` varchar(255) NOT NULL DEFAULT '',
  `jqmj` varchar(255) NOT NULL DEFAULT '',
  `gqts` varchar(255) NOT NULL DEFAULT '',
  `gqmj` varchar(255) NOT NULL DEFAULT '',
  `gyxqts` varchar(255) NOT NULL DEFAULT '',
  `gyxqmj` varchar(255) NOT NULL DEFAULT '',
  `xsfts` varchar(255) NOT NULL DEFAULT '',
  `xsfmj` varchar(255) NOT NULL DEFAULT '',
  `xsfzzts` varchar(255) NOT NULL DEFAULT '',
  `xsfzzmj` varchar(255) NOT NULL DEFAULT '',
  `ysfts` varchar(255) NOT NULL DEFAULT '',
  `ysfmj` varchar(255) NOT NULL DEFAULT '',
  `ysfzzts` varchar(255) NOT NULL DEFAULT '',
  `ysfzzmj` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_selldata`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_selldata_data`
--

CREATE TABLE IF NOT EXISTS `h5_selldata_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` varchar(255) NOT NULL DEFAULT '',
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_selldata_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_session`
--

CREATE TABLE IF NOT EXISTS `h5_session` (
  `sessionid` char(32) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `roleid` tinyint(3) unsigned DEFAULT '0',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(255) NOT NULL,
  PRIMARY KEY (`sessionid`),
  KEY `lastvisit` (`lastvisit`)
) ENGINE=MEMORY DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_session`
--

INSERT INTO `h5_session` (`sessionid`, `userid`, `ip`, `lastvisit`, `roleid`, `groupid`, `m`, `c`, `a`, `data`) VALUES
('8f93b28fb23ff0fc8c7b44b1afec5f4e', 1, '127.0.0.1', 1404201915, 1, 0, 'admin', 'index', 'public_session_life', 'userid|s:1:"1";roleid|s:1:"1";h5_hash|s:6:"iR8LwD";lock_screen|i:0;');

-- --------------------------------------------------------

--
-- 表的结构 `h5_site`
--

CREATE TABLE IF NOT EXISTS `h5_site` (
  `siteid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) DEFAULT '',
  `dirname` char(255) DEFAULT '',
  `domain` char(255) DEFAULT '',
  `site_title` char(255) DEFAULT '',
  `keywords` char(255) DEFAULT '',
  `description` char(255) DEFAULT '',
  `copyright` text,
  `map_key` char(100) DEFAULT '',
  `default_city` char(50) DEFAULT '',
  `city_map` char(200) DEFAULT '',
  `release_point` text,
  `default_style` char(50) DEFAULT NULL,
  `template` text,
  `setting` mediumtext,
  `uuid` char(40) DEFAULT '',
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `h5_site`
--

INSERT INTO `h5_site` (`siteid`, `name`, `dirname`, `domain`, `site_title`, `keywords`, `description`, `copyright`, `map_key`, `default_city`, `city_map`, `release_point`, `default_style`, `template`, `setting`, `uuid`) VALUES
(1, 'house5演示站', '', 'http://localhost:7030/', 'house5演示站--最专业的房地产网站程序', 'house5演示站--最专业的房地产网站程序', 'house5演示站--最专业的房地产网站程序', 'Copyright 2003-2012 House5.cn <a href="http://www.house5.cn/">House5.cn</a> 版权所有\r\n\r\n<br />\r\n\r\n鲁ICP备11018261号-3', 'a55bf8eb974dbf451984ba73a902ed18c5026e0704931db3f13c6b1f59fc87fb6c5dedc8a5745cd0', '威海', '122.1|37.5', '', 'house5-style1', 'house5-style1', 'array (\n  ''upload_maxsize'' => ''4096'',\n  ''upload_allowext'' => ''jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf|flv|mp3'',\n  ''watermark_enable'' => ''1'',\n  ''watermark_minwidth'' => ''300'',\n  ''watermark_minheight'' => ''300'',\n  ''watermark_img'' => ''statics/images/water//mark.png'',\n  ''watermark_pct'' => ''85'',\n  ''watermark_quality'' => ''80'',\n  ''watermark_pos'' => ''9'',\n)', 'b059547a-382a-11e1-bf51-74649bdb78c7');

-- --------------------------------------------------------

--
-- 表的结构 `h5_sms_report`
--

CREATE TABLE IF NOT EXISTS `h5_sms_report` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) NOT NULL,
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  `id_code` varchar(10) NOT NULL,
  `msg` varchar(90) NOT NULL,
  `send_userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `return_id` varchar(30) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mobile` (`mobile`,`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_sms_report`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_special`
--

CREATE TABLE IF NOT EXISTS `h5_special` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(60) NOT NULL,
  `typeids` char(100) NOT NULL,
  `thumb` char(100) NOT NULL,
  `banner` char(100) NOT NULL,
  `description` char(255) NOT NULL,
  `url` char(100) NOT NULL,
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ispage` tinyint(1) unsigned NOT NULL,
  `filename` char(40) NOT NULL,
  `pics` char(100) NOT NULL,
  `voteid` char(60) NOT NULL,
  `style` char(20) NOT NULL,
  `index_template` char(40) NOT NULL,
  `list_template` char(40) NOT NULL,
  `show_template` char(60) NOT NULL,
  `css` text NOT NULL,
  `username` char(40) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL,
  `elite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `disabled` (`disabled`,`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_special`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_special_content`
--

CREATE TABLE IF NOT EXISTS `h5_special_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `specialid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` char(80) NOT NULL,
  `style` char(24) NOT NULL,
  `typeid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `thumb` char(100) NOT NULL,
  `keywords` char(40) NOT NULL,
  `description` char(255) NOT NULL,
  `url` char(100) NOT NULL,
  `curl` char(15) NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `searchid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isdata` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `specialid` (`specialid`,`typeid`,`isdata`),
  KEY `typeid` (`typeid`,`isdata`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_special_content`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_special_c_data`
--

CREATE TABLE IF NOT EXISTS `h5_special_c_data` (
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `paginationtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `maxcharperpage` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `style` char(20) NOT NULL,
  `show_template` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_special_c_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_sphinx_counter`
--

CREATE TABLE IF NOT EXISTS `h5_sphinx_counter` (
  `counter_id` int(11) unsigned NOT NULL,
  `max_doc_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`counter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_sphinx_counter`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_ssi`
--

CREATE TABLE IF NOT EXISTS `h5_ssi` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag` text NOT NULL,
  `name` char(40) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `module` char(20) NOT NULL,
  `action` char(20) NOT NULL,
  `data` text NOT NULL,
  `page` char(15) NOT NULL,
  `return` char(20) NOT NULL,
  `cache` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `h5_ssi`
--

INSERT INTO `h5_ssi` (`id`, `siteid`, `tag`, `name`, `type`, `module`, `action`, `data`, `page`, `return`, `cache`, `num`) VALUES
(1, 1, '1', '首页导航', 0, '', '', '<div class="subNav subNavNews">\r\n        	<h4><a href="{catlink(6)}">资<br />讯</a></h4>\r\n            <ul>\r\n            	<li><a href="{catlink(24)}">本地关注</a></li>\r\n            	<li><a href="{catlink(25)}" class="colFF0000">本地</a></li>\r\n            	<li><a href="{catlink(16)}">全国</a></li>\r\n            	<li><a href="{catlink(6)}special/">专题</a></li>\r\n            	<li><a href="{catlink(80)}">数据</a></li>\r\n            	<li><a href="{catlink(38)}">地产人物</a></li>\r\n            	<li><a href="{APP_PATH}piclist.html">图片</a></li>\r\n            	<li><a href="{catlink(33)}">土地</a></li>\r\n            	<li><a href="{catlink(30)}">市场</a></li>\r\n            	<li><a href="{catlink(27)}">行情</a></li>\r\n            </ul>\r\n        </div>\r\n     	 <div class="subNav subNavHouse">\r\n        	<h4><a href="{HOUSE_PATH}">买<br />房</a></h4>\r\n            <ul>\r\n            	<li><a href="{HOUSE_PATH}list.html" class="colFF0000">新房</a></li>\r\n            	<li><a href="{ESF_PATH}">二手房</a></li>\r\n            	<li><a href="{ESF_PATH}rent/">租房</a></li>\r\n            	<li><a href="{HOUSE_PATH}/map/">地图</a></li>\r\n            	<li><a href="{catlink(26)}">楼市快报</a></li>\r\n            	<li><a href="{catlink(46)}">商业地产</a></li>\r\n            	<li><a href="{catlink(44)}">旅游地产</a></li>\r\n            	<li><a href="{HOUSE_PATH}list-t6.html">别墅</a></li>\r\n            	<li><a href="{TUAN_PATH}" class="colFF0000">看房团</a></li>\r\n            </ul>\r\n        </div>\r\n     	<div class="subNav subNavDecoration">\r\n        	<h4><a href="{catlink(53)}">装修<br />家居</a></h4>\r\n            <ul>\r\n            	<li><a href="{catlink(54)}">资讯</a></li>\r\n            	<li><a href="{catlink(114)}">建材</a></li>\r\n            	<li><a href="{catlink(59)}">装修日记</a></li>\r\n            	<li><a href="{catlink(58)}">设计</a></li>\r\n            	<li><a href="{APP_PATH}piclist.html">图库</a></li>\r\n            	<li><a href="{BBS_PATH}">装修论坛</a></li>\r\n            </ul>\r\n        </div>\r\n     	<div class="subNav subNavBBs">\r\n        	<h4><a href="{BBS_PATH}">业主<br />社区</a></h4>\r\n            <ul>\r\n            	<li><a href="{BBS_PATH}" class="colFF0000">业主论坛</a></li>\r\n            	<li><a href="{BBS_PATH}">生活</a></li>\r\n            	<li><a href="{BBS_PATH}">房产楼市</a></li>\r\n            	<li><a href="{BBS_PATH}">微博</a></li>\r\n            </ul>\r\n        </div>', '', '', 3600, 0),
(8, 1, '8', '全站通用顶部迷你导航', 0, '', '', '<div id="topBar">\r\n<div class="fl">\r\n</div>\r\n<div class="fr">\r\n<div class="panl" id="topBarPanl">\r\n  快速连接\r\n<i></i>\r\n<div>\r\n                        <a target="_blank" href="{HOUSE_PATH}">新房</a>\r\n                        <a target="_blank" href="{catlink(6)}" rel="nofollow">{catname(6)}</a>\r\n<a target="_blank" href="{ESF_PATH}" rel="nofollow">二手房</a>\r\n                        <a target="_blank" href="{ESF_PATH}rent-list.htmL}" rel="nofollow">地图</a>\r\n                        <a target="_blank" href="{catlink(53)}" rel="nofollow">{catname(53)}</a>\r\n                        <a target="_blank" href="{HOUSE_PATH}list-t6.html" rel="nofollow">别墅</a>\r\n<a target="_blank" href="{TUAN_PATH}" rel="nofollow">看房团</a>\r\n <a target="_blank" href="{BBS_PATH}" rel="nofollow">业主论坛</a>\r\n<a target="_blank" href="{APP_PATH}wenfang-p1.html" rel="nofollow">问房</a>\r\n\r\n</div>\r\n</div>\r\n<!-- <span>网站热线:</span> -->\r\n<a href="{ESF_PATH}chushou.html" class="send" target="_blank">个人免费发布房源</a>\r\n</div>\r\n</div>\r\n<script type="text/javascript">\r\nseajs.use(["jquery","topbarlogin"],function($,login){\r\nlogin("{APP_PATH}index.php?s=member/index/loginbar")\r\n$("#topBarPanl").hover(function(){\r\n$(this).find("div").show()\r\n},function(){\r\n$(this).find("div").hide()\r\n})\r\n})\r\n</script>', '', '', 3600, 0),
(2, 1, '2', '首页_业内视角小导航', 0, '', '', '<div class="textColumnTitle"> <a href="#" class="titleColumnLink"></a>\r\n<div class="titleColumnQuick"> <a href="{catlink(24)}" target="_blank">{catname(24)}</a></li>|<a href="{catlink(38)}" target="_blank">{catname(38)}</a></li>|<a href="{catlink(33)}" target="_blank">{catname(33)}</a></li>|<a href="{catlink(80)}" target="_blank">{catname(80)}</a></li>|<a href="{catlink(27)}" target="_blank">{catname(27)}</a></li>|<a href="{catlink(30)}" target="_blank">{catname(30)}</a></li>|<a href="{catlink(34)}" target="_blank">{catname(34)}</a></li>|<a href="{catlink(35)}" target="_blank">{catname(35)}</a></li></div>\r\n</div>', '', '', 3600, 0),
(3, 1, '3', '首页_楼市百姓小导航', 0, '', '', '<div class="textColumnTitle"><a href="{catlink(25)}" class="titleColumnLink"></a>\r\n<div class="titleColumnQuick"> <a href="{catlink(26)}">{catname(26)}</a>|<a href="{catlink(27)}">{catname(27)}</a>|<a href="{catlink(49)}">{catname(49)}</a>|<a href="{catlink(29)}">{catname(29)}</a>|<a href="{catlink(31)}">{catname(31)}</a>|<a href="{catlink(28)}">{catname(28)}</a></div>\r\n</div>', '', '', 3600, 0),
(4, 1, '4', '首页_楼盘中心小导航', 0, '', '', '<div class="textColumnTitle"> <a href="{HOUSE_PATH}" class="titleColumnLink"></a>\r\n<div class="titleColumnQuick"> <a href="{HOUSE_PATH}map/">地图找房</a>|<a href="{HOUSE_PATH}list.html">楼盘超市</a>|<a href="{HOUSE_PATH}zimu.html">楼盘字母索引</a>|<a href="{APP_PATH}tools/fdjsq.html">贷款计算器</a>|<a href="{HOUSE_PATH}wenfang-p1.html">问房</a>|<a href="{HOUSE_PATH}qqqun-p1.html">业主QQ群</a>|<a href="{HOUSE_PATH}xclist.html">楼盘图库</a>|<a href="{HOUSE_PATH}hxlist.html">户型图库</a>|<a href="{HOUSE_PATH}ybjlist.html">样板间图库</a>|<a href="{HOUSE_PATH}baojia.html">楼盘报价</a></div>\r\n</div>', '', '', 3600, 0),
(5, 1, '5', '首页_楼盘中心QQ群', 0, '', '', '<ul>\r\n<li>华润威海湾九里：252727689 </li>\r\n<li>山海顺沁苑：102604344(快满)</li>\r\n<li>乳山湖畔人家业主群：16548549</li>\r\n<li>永兴园业主群：109772688</li>\r\n<li>蓝山海岸业主交流群：106865780</li>\r\n<li>高新城市广场：235113980</li>\r\n<li>威百望海园：29644198</li>\r\n</ul>', '', '', 3600, 0),
(6, 1, '6', '首页_商业地产小导航', 0, '', '', '<div class="textColumnTitle"> <a href="{catlink(46)}" class="titleColumnLinkLong"></a>\r\n             <div class="titleColumnQuick"> <a href="{HOUSE_PATH}list-t8.html">新商铺</a>|<a href="{ESF_PATH}">二手商铺</a>|<a href="{catlink(23)}">{catname(23)}</a>|<a href="{HOUSE_PATH}list-t7.html">新写字楼</a>|<a href="{ESF_PATH}">二手写字楼</a>|<a href="{catlink(44)}">{catname(44)}</a> </div>\r\n</div>', '', '', 3600, 0),
(7, 1, '7', '首页_家居装修小导航', 0, '', '', '<div class="textColumnTitle"> <a href="{catlink(53)}" class="titleColumnLink"></a>\r\n             <div class="titleColumnQuick"> <a href="{catlink(54)}">{catname(54)}</a>|<a href="{catlink(55)}">{catname(55)}</a>|<a href="{catlink(56)}">{catname(56)}</a>|<a href="{catlink(57)}">{catname(57)}</a>|<a href="{catlink(58)}">{catname(58)}</a>|<a href="{catlink(59)}">{catname(59)}</a>|<a href="{catlink(55)}">{BBS_PATH}</a></div>\r\n</div>', '', '', 3600, 0),
(13, 1, '13', '看房团登录按钮下信息', 0, '', '', '<DIV>已有<SPAN class=num>135</SPAN>个楼盘组团成功</DIV>\r\n<DIV>已有共<SPAN class=num>365544</SPAN>位网友参与</DIV>\r\n<!--推荐两条最新往期看房团-->\r\n<UL>\r\n  <LI><A href="#" \r\n  target=_blank>将优惠进行到底 活动专题报道</A>\r\n  <LI><A href="#" \r\n  target=_blank>金九购房潮价格为王问房团将优惠争取到底</A></LI></UL>', '', '', 3600, 0),
(11, 1, '11', '楼盘_楼盘详情页论坛列表', 0, '', '', '<li>·<a href="#" title="2月26日威海广电媒体春季家装建材团购会完美" target="_blank">2月26日威海广电媒体春季家装建材团购会完美</a></li><li>·<a href="#" title="空间魔术师”史南桥之家" target="_blank">空间魔术师”史南桥之家</a></li><li>·<a href="#" title="国宝到威海新闻发布会" target="_blank">国宝到威海新闻发布会</a></li><li>·<a href="#" title="情人节分手率高" target="_blank">情人节分手率高</a></li><li>·<a href="#" title="潘石屹：破产房企是撑死的" target="_blank">潘石屹：破产房企是撑死的</a></li><li>·<a href="#" title="优惠来袭 威海春季精品楼盘团购会特价让利" target="_blank">优惠来袭 威海春季精品楼盘团购会特价让利</a></li><li>·<a href="#" title="4月25日李鑫点点来文登水榭花都了" target="_blank">4月25日李鑫点点来文登水榭花都了</a></li><li>·<a href="#" title="唐人海湾公馆样板间面世啦！！！" target="_blank">唐人海湾公馆样板间面世啦！！！</a></li>', '', '', 3600, 0),
(9, 1, '9', '楼盘首页导航', 0, '', '', '<ul class="link1"><li class="aa"><a href="{HOUSE_PATH}" target="_blank">新房首页</a></li><li class="aa"><a href="{HOUSE_PATH}list.html" target="_blank">楼盘超市</a></li><li class="aa"><a href="{HOUSE_PATH}list-o1.html" target="_blank">本月开盘</a></li><li class="aa"><a href="{HOUSE_PATH}baojia.html" target="_blank">楼市房价</a></li><li class="aa"><a href="{catlink(49)}" target="_blank">{catname(49)}</a></li><li class="aa"><a href="{catlink(26)}" target="_blank">{catname(26)}</a></li><li class="aa"><a href="{catlink(31)}" target="_blank">{catname(31)}</a></li><li class="aa"><a href="{APP_PATH}tools/fdjsq.html" target="_blank">房贷计算</a></li><li class="ab"><a href="{HOUSE_PATH}wenfang-p1.html" target="_blank">问房</a></li>				<li class="aa"><a href="{TUAN_PATH}" target="_blank">看房团</a></li><li class="aa"><a href="{HOUSE_PATH}qqqun-p1.html" target="_blank">业主QQ群</a></li></ul>', '', '', 3600, 0),
(10, 1, '10', '楼盘首页_左_看房团', 0, '', '', '<div class="title_left link5"><span class="red1">看房热线：5668077 5693177</span><a href="{TUAN_PATH}">看房团</a></div>\r\n<div class="content_left">\r\n  <div class="left_1">\r\n    <ul>\r\n    <li>当前会员<span class="red">2316</span>人</li>\r\n    <li>购房<span class="red">723</span>套 最新砍价幅度<span class="red">10%</span></li>\r\n    </ul>\r\n   \r\n    <div class="a2">&#160;</div>\r\n    <div class="a1 smb_reg" ><a href="http://tuan.venfang.com" target="_blank">申请加入</a></div>\r\n  </div>\r\n  <div class="left_2">\r\n    <div class="a1 tips">活动</div>\r\n    <ul>\r\n    </ul>\r\n   </div>\r\n   <div class="left_3"><b>看房QQ群：</b>1群：165356415&#160;&#160;2群：102500690</div>', '', '', 3600, 0),
(12, 1, '12', '二手房下拉导航', 0, '', '', '<ul>\r\n<li><a href="{HOUSE_PATH}"  target="_self" >新房网</a>\r\n<div>\r\n<a href="{HOUSE_PATH}"  target="_blank" >首页</a>\r\n<a href="{HOUSE_PATH}list.html"  target="_blank" >楼盘搜索</a>\r\n<a href="{APP_PATH}map"  target="_blank" >地图找房</a>\r\n<a href="{APP_PATH}baojia.html"  target="_blank" >{$default_city}房价</a>\r\n <a href="{catlink(26)}" target="_blank">{catname(26)}</a>\r\n <a href="{catlink(37)}" target="_blank">{catname(37)}</a>\r\n <a href="{catlink(31)}" target="_blank">{catname(31)}</a>\r\n <a href="{catlink(54)}" target="_blank">{catname(54)}</a>             \r\n</div>\r\n</li>\r\n<li>\r\n<a href="{ESF_PATH}"  target="_blank" >二手房网</a>\r\n<div>\r\n<a href="{ESF_PATH}"  target="_blank" >首页</a>\r\n<a href="{ESF_PATH}list.html"  target="_blank" >出售房源 </a>\r\n<a href="{ESF_PATH}list-u1.html"  target="_blank" > 个人出售 </a>\r\n<a href="{ESF_PATH}map.html"  target="_blank" > 地图找房 </a>\r\n<a href="{ESF_PATH}xiaoqu-list.html"  target="_blank"> 小区找房 </a>\r\n<a href="{ESF_PATH}jingjiren"  target="_blank"> 经纪人 </a>\r\n<a href="{ESF_PATH}qiugou/sell/list.html"  target="_blank"> 求购 </a>\r\n<a href="/1"  target="_blank" > 二手房资讯 </a>\r\n<a href="{ESF_PATH}fabu/chushou/ershoufang.htm"  target="_blank" > 免费发布 </a>\r\n</div>\r\n</li>\r\n<li>\r\n<a href="{ESF_PATH}"  target="_self" > 租房网 </a>\r\n<div>\r\n<a href="{ESF_PATH}"  target="_blank" > 首页 </a>\r\n<a href="{ESF_PATH}rent-list.html"  target="_blank" > 出租房源 </a>\r\n<a href="{ESF_PATH}rent-list-u1.html"  target="_blank" > 个人出租 </a>\r\n<a href="{ESF_PATH}rent-list-l2.html"  target="_blank" > 合租房源 </a>\r\n<a href="{ESF_PATH}rent-map.html"  target="_blank"> 地图找房 </a>\r\n<a href="{ESF_PATH}xiaoqu-list.html"  target="_blank"> 小区找房 </a>\r\n<a href="{ESF_PATH}jingjiren"  target="_blank"> 经纪人 </a>\r\n<a href="#"  target="_blank" > 求租 </a>\r\n<a href="{APP_PATH}chuzu.html"  target="_blank" > 免费发布 </a>\r\n</div>\r\n</li>\r\n\r\n<li>\r\n<a href="/1"  target="_self" > 地产资讯 </a>\r\n<div>\r\n<a href="/1"  target="_blank" > 首页 </a>\r\n<a href="/1"  target="_blank" > 全国头条 </a>\r\n<a href="/1"  target="_blank" > 独家视点 </a>\r\n<a href="/1"  target="_blank" > 本地资讯 </a>\r\n<a href="/1"  target="_blank"> 业界观点 </a>\r\n<a href="/1"  target="_blank"> 土地市场 </a>\r\n<a href="/1"  target="_blank"> 每日成交 </a>\r\n<a href="/1"  target="_blank"> 高端访谈 </a>\r\n<a href="/1"  target="_blank" > 水煮楼市 </a>\r\n<a href="/1"  target="_blank" > 业界招聘 </a>\r\n<a href="/1"  target="_blank" > 专题汇总 </a>\r\n</div>\r\n</li>\r\n</ul>', '', '', 3600, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_admin`
--

CREATE TABLE IF NOT EXISTS `h5_sso_admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` char(32) NOT NULL,
  `encrypt` char(6) DEFAULT NULL,
  `issuper` tinyint(1) DEFAULT '0',
  `lastlogin` int(10) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_sso_admin`
--

INSERT INTO `h5_sso_admin` (`id`, `username`, `password`, `encrypt`, `issuper`, `lastlogin`, `ip`) VALUES
(1, 'admin', 'a1eb49ded323487734ebf4da682502f4', 'bTXmWx', 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_applications`
--

CREATE TABLE IF NOT EXISTS `h5_sso_applications` (
  `appid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(16) NOT NULL DEFAULT '',
  `name` char(20) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `authkey` char(255) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `apifilename` char(30) NOT NULL DEFAULT 'phpsso.php',
  `charset` char(8) NOT NULL DEFAULT '',
  `synlogin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`appid`),
  KEY `synlogin` (`synlogin`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `h5_sso_applications`
--

INSERT INTO `h5_sso_applications` (`appid`, `type`, `name`, `url`, `authkey`, `ip`, `apifilename`, `charset`, `synlogin`) VALUES
(1, 'house5_v1', 'house5 v1', 'http://localhost:7030/', 'buf9iGIhI4GzpcRDcxIwHL1cYyV6nSaK', '', 'api.php?op=phpsso', 'gbk', 1);

-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_members`
--

CREATE TABLE IF NOT EXISTS `h5_sso_members` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `random` char(8) NOT NULL DEFAULT '',
  `email` char(32) NOT NULL DEFAULT '',
  `regip` char(15) NOT NULL DEFAULT '',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` char(15) NOT NULL DEFAULT '0',
  `lastdate` int(10) unsigned NOT NULL DEFAULT '0',
  `appname` char(15) NOT NULL,
  `type` enum('app','connect') DEFAULT NULL,
  `avatar` tinyint(1) NOT NULL DEFAULT '0',
  `ucuserid` mediumint(8) unsigned DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `ucuserid` (`ucuserid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_sso_members`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_messagequeue`
--

CREATE TABLE IF NOT EXISTS `h5_sso_messagequeue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation` char(32) NOT NULL,
  `succeed` tinyint(1) NOT NULL DEFAULT '0',
  `totalnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `noticedata` mediumtext NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `appstatus` mediumtext,
  PRIMARY KEY (`id`),
  KEY `dateline` (`dateline`),
  KEY `succeed` (`succeed`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_sso_messagequeue`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_session`
--

CREATE TABLE IF NOT EXISTS `h5_sso_session` (
  `sessionid` char(32) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `roleid` tinyint(3) unsigned DEFAULT '0',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m` char(20) NOT NULL,
  `c` char(20) NOT NULL,
  `a` char(20) NOT NULL,
  `data` char(255) NOT NULL,
  PRIMARY KEY (`sessionid`),
  KEY `lastvisit` (`lastvisit`)
) ENGINE=MEMORY DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_sso_session`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_sso_settings`
--

CREATE TABLE IF NOT EXISTS `h5_sso_settings` (
  `name` varchar(32) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_sso_settings`
--

INSERT INTO `h5_sso_settings` (`name`, `data`) VALUES
('denyemail', ''),
('denyusername', ''),
('creditrate', ''),
('sp4', ''),
('ucenter', '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_tag`
--

CREATE TABLE IF NOT EXISTS `h5_tag` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag` text NOT NULL,
  `name` char(40) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `module` char(20) NOT NULL,
  `action` char(20) NOT NULL,
  `data` text NOT NULL,
  `page` char(15) NOT NULL,
  `return` char(20) NOT NULL,
  `cache` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_tag`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_template_bak`
--

CREATE TABLE IF NOT EXISTS `h5_template_bak` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `creat_at` int(10) unsigned DEFAULT '0',
  `fileid` char(50) DEFAULT NULL,
  `userid` mediumint(8) DEFAULT NULL,
  `username` char(20) DEFAULT NULL,
  `template` text,
  PRIMARY KEY (`id`),
  KEY `fileid` (`fileid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_template_bak`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_times`
--

CREATE TABLE IF NOT EXISTS `h5_times` (
  `username` char(40) NOT NULL,
  `ip` char(15) NOT NULL,
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `times` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`isadmin`)
) ENGINE=MEMORY DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_times`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_tuangou_mark`
--

CREATE TABLE IF NOT EXISTS `h5_tuangou_mark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dataid` mediumint(8) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_tuangou_mark`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_type`
--

CREATE TABLE IF NOT EXISTS `h5_type` (
  `typeid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `module` char(15) NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` char(30) NOT NULL,
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typedir` char(20) NOT NULL,
  `url` char(100) NOT NULL,
  `template` char(30) NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`typeid`),
  KEY `module` (`module`,`parentid`,`siteid`,`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=118 ;

--
-- 导出表中的数据 `h5_type`
--

INSERT INTO `h5_type` (`typeid`, `siteid`, `module`, `modelid`, `name`, `parentid`, `typedir`, `url`, `template`, `listorder`, `description`) VALUES
(1, 1, 'search', 1, '新闻', 0, '', '', '', 1, '新闻模型搜索'),
(24, 1, 'content', 0, '复式', 0, '', '', '', 17, ''),
(23, 1, 'content', 0, '六室', 0, '', '', '', 16, ''),
(8, 1, 'content', 0, '开发商', 0, '', '', '', 1, ''),
(9, 1, 'content', 0, '投资商', 0, '', '', '', 2, ''),
(10, 1, 'content', 0, '代理公司', 0, '', '', '', 3, ''),
(11, 1, 'content', 0, '物业公司', 0, '', '', '', 4, ''),
(12, 1, 'content', 0, '实景图', 0, '', '', '', 5, ''),
(13, 1, 'content', 0, '效果图', 0, '', '', '', 6, ''),
(14, 1, 'content', 0, '交通图', 0, '', '', '', 7, ''),
(15, 1, 'content', 0, '配套图', 0, '', '', '', 8, ''),
(16, 1, 'content', 0, '样板间', 0, '', '', '', 9, ''),
(17, 1, 'content', 0, '活动图', 0, '', '', '', 10, ''),
(18, 1, 'content', 0, '一室', 0, '', '', '', 11, ''),
(19, 1, 'content', 0, '两室', 0, '', '', '', 12, ''),
(20, 1, 'content', 0, '三室', 0, '', '', '', 13, ''),
(21, 1, 'content', 0, '四室', 0, '', '', '', 14, ''),
(22, 1, 'content', 0, '五室', 0, '', '', '', 15, ''),
(111, 2, 'link', 0, '各地分站', 0, '', '', '', 0, ''),
(108, 1, 'search', 34, '房源', 0, '', '', '', 0, ''),
(39, 1, 'link', 0, '媒体合作', 0, '', '', '', 4, ''),
(40, 1, 'link', 0, '品牌开发商展示', 0, '', '', '', 5, '广告位'),
(41, 1, 'link', 0, '合作伙伴', 0, '', '', '', 6, ''),
(42, 1, 'link', 0, '友情链接', 0, '', '', '', 8, ''),
(96, 1, 'search', 13, '新房', 0, 'content', '', '', 2, ''),
(112, 1, 'search', 37, '看房团', 0, '', '', '', 0, ''),
(117, 1, 'link', 0, '二手房', 0, '', '', '', 0, ''),
(2, 1, 'search', 4, '图库', 0, 'content', '', '', 1, ''),
(3, 1, 'search', 5, '视频', 0, 'content', '', '', 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `h5_urlrule`
--

CREATE TABLE IF NOT EXISTS `h5_urlrule` (
  `urlruleid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(15) NOT NULL,
  `file` varchar(20) NOT NULL,
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `urlrule` varchar(255) NOT NULL,
  `example` varchar(255) NOT NULL,
  PRIMARY KEY (`urlruleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=50 ;

--
-- 导出表中的数据 `h5_urlrule`
--

INSERT INTO `h5_urlrule` (`urlruleid`, `module`, `file`, `ishtml`, `urlrule`, `example`) VALUES
(1, 'content', 'category', 1, '{$categorydir}{$catdir}/index.html|{$categorydir}{$catdir}/{$page}.html', 'news/china/1000.html'),
(6, 'content', 'category', 0, 'index.php?s=content/index/lists/catid/{$catid}|index.php?s=content/index/lists/catid/{$catid}/page/{$page}', 'index.php?s=content/index/lists/catid/1/page/1'),
(11, 'content', 'show', 1, '{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}.html|{$categorydir}{$year}/{$catdir}_{$month}{$day}/{$id}_{$page}.html', '2010/catdir_0720/1_2.html'),
(12, 'content', 'show', 1, '{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}.html|{$categorydir}{$catdir}/{$year}/{$month}{$day}/{$id}_{$page}.html', 'it/product/2010/0720/1_2.html'),
(16, 'content', 'show', 0, 'index.php?s=content/index/show/catid/{$catid}/id/{$id}|index.php?s=content/index/show/catid/{$catid}/id/{$id}/page/{$page}', 'index.php?s=content/index/show/catid/1/id/1'),
(17, 'content', 'show', 0, 'show-{$catid}-{$id}-{$page}.html', 'show-1-2-1.html'),
(18, 'content', 'show', 0, 'content-{$catid}-{$id}-{$page}.html', 'content-1-2-1.html'),
(30, 'content', 'category', 0, 'list{$lst}-g{$page}.html', 'list-g1.html'),
(31, 'content', 'category', 0, 'wenfang{$lst}-p{$page}.html', 'wenfang-p1.html'),
(32, 'content', 'category', 0, 'list-{$page}.html', 'list-1.html'),
(33, 'content', 'show', 0, '{$house_path}{$id}', '{$id}'),
(34, 'content', 'show', 0, '{$house_path}company-{$id}.html', 'company-1.html'),
(35, 'content', 'show', 0, '{$house_path}{$relation}/huxing.html', '1/huxing.html'),
(36, 'content', 'show', 0, '{$house_path}{$relation}/dongtai.html', '1/dongtai.html'),
(37, 'content', 'show', 0, '{$house_path}{$relation}/xiangce.html', '1/xiangce.html'),
(38, 'content', 'show', 0, '{$house_path}{$relation}/jiage.html', '1/jiage.html'),
(40, 'content', 'category', 0, 'piclist-{$page}.html', 'piclist-1.html'),
(41, 'content', 'show', 0, '{$house_path}{$xglp}/wenfang-p1.html', '1/wenfang-p1.html'),
(42, 'content', 'category', 0, 'ybjlist{$lst}-p{$page}.html', 'ybjlist.html'),
(43, 'content', 'category', 0, 'hxlist{$lst}-p{$page}.html', 'hxlist.html'),
(44, 'content', 'show', 0, '{$house_path}{$relation}/dianping.html', '1/dianping.html'),
(45, 'content', 'category', 0, 'xclist{$lst}-p{$page}.html', 'xclist.html'),
(46, 'content', 'show', 0, '{$house_path}fangyuan/{$id}.html', 'fangyuan/1.html'),
(47, 'content', 'show', 0, '{$tuan_path}route_{$id}.html', 'route_1.html'),
(48, 'content', 'category', 0, 'rent-list{$lst}-g{$page}.html', 'rent-list-g1.html'),
(49, 'content', 'category', 0, 'xiaoqu-list{$lst}-g{$page}.html', 'xiaoqu-list-g1.html'),
(13, 'content', 'show', 0, '{$esf_path}show-{$id}.html', 'esf/show-1.html'),
(14, 'content', 'show', 0, '{$esf_path}rent-show-{$id}.html', 'esf/rent-show-1.html'),
(15, 'content', 'show', 0, '{$esf_path}xiaoqu-show-{$id}.html', 'esf/xiaoqu-show-1.html');

-- --------------------------------------------------------

--
-- 表的结构 `h5_video`
--

CREATE TABLE IF NOT EXISTS `h5_video` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(5) unsigned NOT NULL,
  `title` char(80) NOT NULL DEFAULT '',
  `style` char(24) NOT NULL DEFAULT '',
  `thumb` char(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  `posids` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` char(100) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sysadd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `initialviews` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`listorder`,`id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`id`),
  KEY `catid` (`catid`,`status`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `h5_video`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_video_data`
--

CREATE TABLE IF NOT EXISTS `h5_video_data` (
  `id` mediumint(8) unsigned DEFAULT '0',
  `content` text NOT NULL,
  `readpoint` smallint(5) unsigned NOT NULL DEFAULT '0',
  `groupids_view` varchar(100) NOT NULL,
  `paginationtype` tinyint(1) NOT NULL,
  `maxcharperpage` mediumint(6) NOT NULL,
  `template` varchar(30) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_comment` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `relation` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pictureurls` mediumtext NOT NULL,
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  `video_src` mediumtext NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_video_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_vote_data`
--

CREATE TABLE IF NOT EXISTS `h5_vote_data` (
  `userid` mediumint(8) unsigned DEFAULT '0',
  `username` char(20) NOT NULL,
  `subjectid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL,
  `data` text NOT NULL,
  `userinfo` text NOT NULL,
  KEY `subjectid` (`subjectid`),
  KEY `userid` (`userid`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_vote_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_vote_option`
--

CREATE TABLE IF NOT EXISTS `h5_vote_option` (
  `optionid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `subjectid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option` varchar(255) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `listorder` tinyint(2) unsigned DEFAULT '0',
  PRIMARY KEY (`optionid`),
  KEY `subjectid` (`subjectid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_vote_option`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_vote_subject`
--

CREATE TABLE IF NOT EXISTS `h5_vote_subject` (
  `subjectid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned DEFAULT '0',
  `subject` char(255) NOT NULL,
  `ismultiple` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ischeckbox` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `credit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `fromdate` date NOT NULL DEFAULT '0000-00-00',
  `todate` date NOT NULL DEFAULT '0000-00-00',
  `interval` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `template` char(20) NOT NULL,
  `description` text NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `allowguest` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `maxval` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `minval` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowview` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `optionnumber` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `votenumber` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`subjectid`),
  KEY `enabled` (`enabled`),
  KEY `fromdate` (`fromdate`,`todate`),
  KEY `todate` (`todate`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `h5_vote_subject`
--


-- --------------------------------------------------------

--
-- 表的结构 `h5_wap`
--

CREATE TABLE IF NOT EXISTS `h5_wap` (
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '1',
  `sitename` char(30) NOT NULL,
  `logo` char(100) DEFAULT NULL,
  `domain` varchar(100) DEFAULT NULL,
  `setting` mediumtext,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`siteid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `h5_wap`
--

INSERT INTO `h5_wap` (`siteid`, `sitename`, `logo`, `domain`, `setting`, `status`) VALUES
(1, 'house5 WAP站', '/statics/images/wap/wlogo.gif', 'http://www.house5.cn/', 'array (\n  ''listnum'' => ''10'',\n  ''thumb_w'' => ''220'',\n  ''thumb_h'' => ''0'',\n  ''c_num'' => ''1000'',\n  ''index_template'' => ''index'',\n  ''category_template'' => ''category'',\n  ''list_template'' => ''list'',\n  ''show_template'' => ''show'',\n  ''hotwords'' => '''',\n)', 1);

-- --------------------------------------------------------

--
-- 表的结构 `h5_wap_type`
--

CREATE TABLE IF NOT EXISTS `h5_wap_type` (
  `typeid` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat` smallint(5) NOT NULL,
  `parentid` smallint(5) NOT NULL,
  `typename` varchar(30) NOT NULL,
  `siteid` smallint(5) NOT NULL,
  `listorder` smallint(5) DEFAULT '0',
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `h5_wap_type`
--

INSERT INTO `h5_wap_type` (`typeid`, `cat`, `parentid`, `typename`, `siteid`, `listorder`) VALUES
(1, 9, 0, '新房', 1, 0),
(2, 16, 0, '全国楼市', 1, 0),
(3, 25, 0, '楼市', 1, 0),
(4, 26, 3, '楼市快报', 1, 0),
(5, 14, 1, '新房', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `h5_workflow`
--

CREATE TABLE IF NOT EXISTS `h5_workflow` (
  `workflowid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `steps` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `workname` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `setting` text NOT NULL,
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`workflowid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `h5_workflow`
--

INSERT INTO `h5_workflow` (`workflowid`, `siteid`, `steps`, `workname`, `description`, `setting`, `flag`) VALUES
(1, 1, 1, '一级审核', '审核一次', 'array (\n  1 => \n  array (\n    0 => ''yangyy'',\n    1 => ''congdd'',\n    2 => ''zhanghx'',\n  ),\n  2 => '''',\n  3 => '''',\n  4 => '''',\n  ''nocheck_users'' => \n  array (\n    0 => ''yangyy'',\n    1 => ''miaomiao'',\n    2 => ''congdd'',\n    3 => ''zhangh'',\n    4 => ''zhanghx'',\n  ),\n)', 0),
(2, 1, 2, '二级审核', '审核两次', '', 0),
(3, 1, 3, '三级审核', '审核三次', '', 0),
(4, 1, 4, '四级审核', '四级审核', '', 0);
