<?php
return array(
	//'配置项'=>'配置值'
	// 添加数据库配置信息
	'URL_MODEL'=>  0, 			// 0普通模式，1.pathinfo[利于SEO] 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'   => 'mysql', 	// 数据库类型
	'DB_HOST'   => '', // 服务器地址
	'DB_NAME'   => 'feel', 		// 数据库名
	'DB_USER'   => '', 	// 用户名
	'DB_PWD'    => '', 	// 密码
	'DB_PORT'   => 3306, 		// 端口
	'DB_PREFIX' => 'feel_', 	// 数据库表前缀


    // 'DEFAULT_TIMEZONE'   => 'PRC',	// 默认时区
	//'HOME_TMPL_PATH' 	 => '../Home/Template/', //定义前台项目模板存放路径
	'HOME_DEFAULT_THEME' => 'default', // 定义默认模板主题名称
	//'DEFAULT_THEME' => 'default',
	//'THEME_LIST'		=>	'default,think',
    //'TMPL_DETECT_THEME' => 	true, // 自动侦测模板主题

	'FACE_UPLOAD_PATH' => './Common/Uploads/DJ/Face/', //定义后台Face上传文件存放路径
	'HEAD_UPLOAD_PATH' => './Common/Uploads/DJ/Head/', //定义后台Head上传文件存放路径
    'MP3_UPLOAD_PATH'  =>  './Common/Uploads/MP3/', 		//定义后台MP3上传文件存放路径
    'LIFE_UPLOAD_PATH' => './Common/Uploads/DJ/Life/', //定义后台生活照上传文件存放路径
	'UPLOAD_FILE_SIZE' => 1024*1024*50, 				//定义后台上传文件附件大小  10M

	
	'TMPL_ACTION_ERROR' => 'Public:error',			//默认错误跳转对应的模板文件	
	'TMPL_ACTION_SUCCESS' => 'Public:success',		//默认成功跳转对应的模板文件

	'TMPL_PARSE_STRING'  =>array(
    	'__PUBLIC__' => __ROOT__.'/Common', 		// 更改默认的__PUBLIC__ 替换规则
     	'__ADMIN__' => __ROOT__.'/Common/', 	// 更改默认的__PUBLIC__ 替换规则
     	'__CSS__'=>  __ROOT__.'/Common/Css/',
     	'__JS__' => __ROOT__.'/Common/Js/', 		// 增加新的JS类库路径替换规则
     	'__UPLOAD__' => __ROOT__.'/Common/Uploads', // 增加新的上传路径替换规则
     	'__PIC__'=> __ROOT__.'/Common/images/',
	)
);
?>
