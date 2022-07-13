<?php

namespace Controller;

class client_login_verify{
    public function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        if(!isset($_POST['uname']) && !isset($_POST['password'])){
            echo "Please enter all the details";
        }elseif (\Model\User::user_exist($uname)) {
            if(!\Model\User::user_verify($uname,$password)){
                session_start();
                $_SESSION['uname'] = $uname;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid",$sessionId,time()+60*60*24*30,"/");
                \Model\User::set_cookie($sessionId,$uname);
                echo \View\Loader::make()->render("templates/client_mainpage.twig", array(
                    "post" => $uname,
                ));
            }else{
                echo "Incorrent password";
            }
        }else{
            echo "User dont exist";
        }
    }
}

class client_login{
    public function get(){
        if(\Model\User::check_cookie_client($_COOKIE['sessionid'])){
        }else{
            echo \View\Loader::make()->render("templates/Login_client.twig",array());
        }
    }
}

class client_logout{
    public function get(){
        $_SESSION =NULL;
        // echo $_COOKIE['sessionId'];
        \Model\User::delete_cookie($_COOKIE['sessionid']);
        setcookie('sessionId',"",time()-60*60*24*30);
        setcookie('PHPSESSID',"",time()-60*60*24*30);
        session_destroy();
        header('Location: /');
    }
}

class client_register_process{
    public function post(){
        if(!(isset($_POST['userid'])&&isset($_POST['password'])&&isset($_POST['passwordC']))){
            echo "Please enter the data in all the fields";
            return;
        }else{
            $name = $_POST['userid'];
            $password = $_POST['password'];
            $passwordC = $_POST['passwordC'];
            if($password != $passwordC){
                echo "Password and Confirm password doesnt match";
                return;
            }
            else if(\Model\User::user_exist($name)){
                echo "username already taken";
            }
            else{
                session_start();
                $salt = dechex(rand(100,1000000));
                $hash = hash('sha256',$salt.$password);
                \Model\User::reigster_user($name,$salt,$hash);
                $_SESSION['uname'] = $name;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid",$sessionId,time()+60*60*24*30,"/");
                \Model\User::set_cookie($sessionId,$name);
                echo \View\Loader::make()->render("templates/client_mainpage.twig",array());
            }
        }
    }
}

class Register_Client {
    public function get(){
        echo \View\Loader::make()->render("templates/register_client.twig", array(
        ));
    }
}