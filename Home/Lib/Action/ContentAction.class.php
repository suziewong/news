<?php
class ContentAction extends Action{
	/*
		添加内容
	*/
    public function submit()
    {
        $this->display();
        
    }
	public function add()
	{
		if(isset($_POST["title"]))
		{

			$data = array();
			$data["title"]	= $_POST["title"];
			//$data["userid"]  = !empty(session("userid"))?0:1;
            $data["anonymous"]  = empty($_POST["anonymous"])?0:1;
			$data["link"]	= $_POST["link"];
            $data["time"]   = date("Y-m-d H:i:s");
			$Content = M('Content');
            $result = $Content->add($data);
            if ( $result ){
                //成功提示
                redirect(U('Index/index'));
               // $this->redirect('增加内容成功',U('Index/index'));
            }
            else{
                //错误提示
                $this->error('增加内容失败',U('Index/index'));
            }
	   	}
		else
		{
            $this->error('增加内容失败',U('Index/index'));
		}
	}
}
