CREATE TABLE `elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('y','n') NOT NULL DEFAULT 'y',
  `name` varbinary(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `content` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

CREATE TABLE `gfx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `filename` varchar(150) NOT NULL,
  `ext` enum('jpg','tif','gif','png','pdf','doc','xls') NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `function` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE `module_page_link` (
  `module_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  KEY `module_id` (`module_id`,`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `status` enum('y','n') NOT NULL DEFAULT 'y',
  `name` varchar(60) NOT NULL,
  `uri_type` enum('url','page') NOT NULL DEFAULT 'page',
  `url` varchar(200) NOT NULL,
  `page_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('y','n') NOT NULL,
  `meta_title` varbinary(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `name` varbinary(255) NOT NULL,
  `short_content` text NOT NULL,
  `content` blob NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

CREATE TABLE `page_member_link` (
  `page_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  KEY `page_id` (`page_id`,`member_id`,`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('y','n') NOT NULL DEFAULT 'n',
  `created` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` blob NOT NULL,
  `short_body` blob NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `permalink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `unsubscribed` datetime DEFAULT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('y','n') NOT NULL DEFAULT 'y',
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
