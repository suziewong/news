CREATE TABLE `dc_user` (
  `userid` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `username` varchar(50) NOT NULL COMMENT '管理员名称',
  `userpassword` varchar(32) NOT NULL COMMENT '管理员密码',
  `userpower` int(1) unsigned NOT NULL COMMENT '管理员权限',
  `loginip` varchar(30) DEFAULT NULL COMMENT '登录IP',
  `lastlogintime` int(10) unsigned DEFAULT NULL COMMENT '最后登录时间',
  `logincount` int(6) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='管理员表';



CREATE TABLE `dc_content` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '节目ID',
  `userid` int NOT NULL COMMENT '发布者',
  `anonymous` int NOT NULL COMMENT '是否匿名',
  `title` varchar(50) NOT NULL COMMENT '名称',
  `link` varchar(100) NOT NULL COMMENT '超链接',
  `intro` varchar(200) COMMENT '简介',
  `time` datetime NOT NULL COMMENT '发布时间',
  `support` smallint(5) unsigned NOT NULL COMMENT '；支持数量',
  `oppose` smallint(5) unsigned NOT NULL COMMENT '；反对数量',
  `disable` smallint(5) COMMENT '是否审核通过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='内容表';


CREATE TABLE `dc_setting` (
  `item` int(3) unsigned NOT NULL COMMENT 'settingID',
  `item_key` varchar(50) NOT NULL COMMENT 'setting键',
  `item_value` varchar(70) NOT NULL COMMENT 'setting值'
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='设置表';


CREATE TABLE `feel_suggest` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '建议ID',
  `uid` int(11) unsigned NOT NULL COMMENT '；精弘ID',
  `name` varchar(70) NOT NULL COMMENT '；昵称',
  `email` varchar(70) NOT NULL COMMENT '；邮箱', 
 `posttime` int(10) unsigned NOT NULL COMMENT '；评论时间',
  `suggest` varchar(300) DEFAULT NULL COMMENT '建议',
  `support` smallint(5) unsigned NOT NULL COMMENT '；支持数量',
  `oppose` smallint(5) unsigned NOT NULL COMMENT '；反对数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='建议表' 


CREATE TABLE `feel_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `uid` int(11) unsigned NOT NULL COMMENT '；精弘ID',
  `djid` int(11) unsigned NOT NULL COMMENT '；DJID',
  `posttime` int(10) unsigned NOT NULL COMMENT '；评论时间',
  `comment` varchar(300) DEFAULT NULL COMMENT '评论',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='评论表'