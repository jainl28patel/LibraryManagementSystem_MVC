<?php

namespace Controller;

class admin_login_verify{
    public static function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        if(!isset($_POST['uname']) && !isset($_POST['password'])){
            echo "Please enter all the details";
        }elseif (\Model\User::admin_exist($uname)) {
            if(!\Model\User::admin_verify($uname,$password)){
                session_start();
                $_SESSION['uname'] = $uname;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid",$sessionId,time()+60*60*24*30,"/");
                \Model\User::set_cookie($sessionId,$uname);
                echo \View\Loader::make()->render("templates/admin_mainpage.twig", array());
            }else{
                echo "Incorrent password";
            }
        }else{
            echo "Admin dont exist with this credentials";
        }
    }
}

class admin_login{
    public function get(){
        if(\Model\User::check_cookie_admin($_COOKIE['sessionid'])){
        }else{
            echo \View\Loader::make()->render("templates/Login_admin.twig",array());
        }
    }
}

class admin_logout{
    public function get(){
        $_SESSION = NULL;
        \Model\User::delete_cookie($_COOKIE['sessionid']);
        setcookie('sessionId',"",time()-60*60*24*30);
        setcookie('PHPSESSID',"",time()-60*60*24*30);
        session_destroy();
        header('Location: /');
    }
}