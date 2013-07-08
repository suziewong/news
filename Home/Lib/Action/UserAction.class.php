<?php
class UserAction extends Action{
	/*
		添加内容
	*/
    public function index()
    {
        $this->display();
    }

    public function checklogin()
    {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $User = M("User");
        $condition['username'] = $username;
        $user_info = $User->where($condition)->find();
        // 数据库操作

        //exit;
        if($user_info) 
        {
            if($password == $user_info['userpassword'] )
            {
                        // 设置登录信息
                session('userid',$user_info['userid']);
                session('username',$user_info['username']);
                session('userpower',$user_info['userpower']);
                session('lastlogintime',$user_info['lastlogintime']);
                        
                // 更新帐号登录信息
                $loginip = get_client_ip();
                $data = array('loginip'=>$loginip,'lastlogintime'=>time(),'logincount'=>$user_info['logincount']+1);
                $condition['userid'] = $user_info['userid'];
                $User->where($condition)->setField($data);
                
                redirect(U('Index/index'));
                //$this->success("登录成功",'../Index/index');
                //$this->assign('jumpUrl',U('Index/index'));
                //$this->display(THINK_PATH.'Tpl/dispatch_jump.tpl'); 
                //echo json_encode(array("msg" => 'succeess登录成功！', "result" => '1'));
            }
            else 
            {
                $msg = '密码错误，请重新输入';

            } // end if password
        } 
        else 
        {
            $msg ='用户名不存在';
        } // end if admin
        $this->assign('message',$msg);// 提示信息
                // 成功操作后默认停留1秒
        $this->assign('waitSecond','1');
                // 登出成功返回登录页面
        $this->assign('jumpUrl',U('User/login'));
        $this->display(THINK_PATH.'Tpl/dispatch_jump.tpl');
    }
    /*
        精弘账号
    */
    public function jhchecklogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $url = "http://user.zjut.com/api.php?app=member&action=login&username=".$username."&password=".$password;
        $result = json_decode(file_get_contents($url));
        // 设置登录信息
        /**/
        if($result->state == "success")
        {
            session('userid',$result->data->uid);
            session('username',$result->data->username);
            session('email',$result->data->email);
            session('avatar',$result->data->avatar);
            redirect(U('Index/index'));
        }
        else
        {
            //错误提示
            $this->error('用户登录失败',U('User/login'));
        }
       
    }
    public function jhlogout()
    {
        if(session('userid')) { 
            session('userid',null);
            session('username',null);
            session('email',null);
            session('avatar',null);
            redirect(U('Index/index'));
        }else {
            $this->error('已经登出！');
        }
    }

    public function logout()
    {
        if(session('userid')) {    
            session('userid',null);
            session('verify',null);
            session('username',null);
            session('userpower',null);
            session('lastlogintime',null);
            redirect(U('Index/index'));
        }else {
            $this->error('已经登出！');
        }
    }
    /*
        注册用户
    */
    public function register()
    {
        if(isset($_POST['username']))
        {
            $data = array();
            $data['username'] = $_POST['username'];
            $data['userpassword'] = md5($_POST['password']);
            $data['userpower'] = 1;
            $user = M('User');
             $result = $user->add($data);
            if($result)
            {
                //成功提示
                redirect(U('Index/index'));
            } else {
                //错误提示
                $this->error('增加用户失败');
            }
        }
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

            /*echo("<h1>恭喜！使用 {$type} 用户登录成功</h1><br>");
            echo("授权信息为：<br>");
            dump($token);
            echo("当前登录用户信息为：<br>");
            dump($user_info);*/
            session('userid',$token['openid']);
             session('username',$user_info['name']);
             session('avatar',$user_info['head']);
             redirect(U('Index/index'));
        }
    }
}
