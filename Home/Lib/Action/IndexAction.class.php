<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	
    public function index(){
    	//var_dump($config);
    	//C('HOME_DEFAULT_THEME');
    	//$Content = M("Content");
		$page = isset($_GET['p'])? $_GET['p'] : '1';  //默认显示首页数据

    	$ContentList = array();
        $Model = new Model();
        //$Content = $Model->query("select id,username,title,link,anonymous,time from dc_content,dc_user where dc_user.userid = dc_content.userid order by time desc ");
        $Content = $Model->query("select id,title,link,anonymous,time from dc_content order by time desc ");
		//var_dump($Content);
		while (list($key, $val) = each($Content)) {
		    array_push($ContentList,$val);
		}
		import("ORG.Util.Page");// 导入分页类
		$count = count($ContentList);// 查询满足要求的总记录数
		$length = 10;
		$offset = $length * ($page - 1);
		$Page = new Page($count,$length,$page);// 实例化分页类 传入总记录数和每页显示的记录数和当前页数
		//$Page->setConfig('theme',' %upPage%   %linkPage%  %downPage%');
		$Page->setConfig('prev','Older');
		$Page->setConfig('next','More');
		$Page->setConfig('theme',' %upPage%   %downPage%');
		$show = $Page->show();// 分页显示输出
		$this->assign("ContentList",$ContentList);
		$this->assign("offset",$offset);
		$this->assign("length",$length);
		$this->assign("page",$show);

    	//$this->display(C('HOME_DEFAULT_THEME').':index');
		$this->display();
	}
	public function about()
	{
		$this->display();
	}
	public function maktimes($date)
	{
		$time =  strtotime($date);
	    $t=time()-$time;
	     $f=array(
	       '31536000'=> '年',
	       '2592000' => '个月',
	       '604800'  => '星期',
	       '86400'   => '天',
	       '3600'    => '小时',
	       '60'      => '分钟',
	       '1'       => '秒'
	   );
	   foreach ($f as $k=>$v){        
	       if (0 !=$c=floor($t/(int)$k)){
	           return $c.$v.'前';
	       }
	   }
	 }
	 public function team()
	 {
	 	$this->display();
	 }

	 //登录地址
	public function login($type = null){
		empty($type) && $this->error('参数错误');

		//加载ThinkOauth类并实例化一个对象
		import("ORG.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);

		//跳转到授权页面
		redirect($sns->getRequestCodeURL());
	}

	//授权回调地址
	public function callback($type = null, $code = null){
		(empty($type) || empty($code)) && $this->error('参数错误');
		
		//加载ThinkOauth类并实例化一个对象
		import("ORG.ThinkSDK.ThinkOauth");
		$sns  = ThinkOauth::getInstance($type);

		//腾讯微博需传递的额外参数
		$extend = null;
		if($type == 'tencent'){
			$extend = array('openid' => $this->_get('openid'), 'openkey' => $this->_get('openkey'));
		}

		//请妥善保管这里获取到的Token信息，方便以后API调用
		//调用方法，实例化SDK对象的时候直接作为构造函数的第二个参数传入
		//如： $qq = ThinkOauth::getInstance('qq', $token);
		$token = $sns->getAccessToken($code , $extend);

		//获取当前登录用户信息
		if(is_array($token)){
			$user_info = A('Type', 'Event')->$type($token);

			echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
			echo("授权信息为：<br>");
			dump($token);
			echo("当前登录用户信息为：<br>");
			dump($user_info);
		}
	}

}
