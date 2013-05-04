<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	
    public function index(){
    	//var_dump($config);
    	//C('HOME_DEFAULT_THEME');
    	$ContentList = array();
        $Model = new Model();
        $Content = $Model->query("select id,username,title,link,time from dc_content,dc_user where dc_user.userid = dc_content.userid order by time desc ");
		while (list($key, $val) = each($Content)) {
		    array_push($ContentList,$val);
		}
		import("ORG.Util.Page");// 导入分页类
		$count = count($ContentList);// 查询满足要求的总记录数
		$length = 10;
		$offset = $length * ($page - 1);
		$Page = new Page($count,$length,$page);// 实例化分页类 传入总记录数和每页显示的记录数和当前页数
		$Page->setConfig('theme',' %upPage%   %linkPage%  %downPage%');
		$show = $Page->show();// 分页显示输出
		$this->assign("ContentList",$ContentList);

		$this->assign("offset",$offset);
		$this->assign("length",$length);
		$this->assign("page",$show);

    	//$this->display(C('HOME_DEFAULT_THEME').':index');
		$this->display();
	}
	public function dj()
	{
		$this->display(C('HOME_DEFAULT_THEME').':dj');
	}
	public function test()
	{
		//echo C('HOME_DEFAULT_THEME').'/feel-static:index';
		$this->display(C('HOME_DEFAULT_THEME').'/feel-static:index');
	}
}
