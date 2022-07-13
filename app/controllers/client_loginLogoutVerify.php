<?php

namespace Controller;

class client_login_verify{
    public function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $row = \Model\User::user_exist($uname,$password);
        $logic=TRUE;
        if(!isset($row[0])){
            $logic=FALSE;
        }
        $logic2=FALSE;
        $row2 = \Model\User::user_verify($uname,$password);
        if(!isset($row2[0])){
            $logic2=FALSE;
        }
        if($row2[0]['password'] == hash("sha256",$password.$row2[0]['salt']) ){
            $logic2=TRUE;
        }
        if(!isset($_POST['uname']) && !isset($_POST['password'])){
            echo "Please enter all the details";
        }elseif ($logic) {
            if(!$logic2){
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
        $row = \Model\User::check_cookie_client($_COOKIE['sessionid']);
        $logic = TRUE;
        if (!empty($row[0])) {
            session_start();
            $_SESSION['uname'] = $row[0]['uname'];
            echo \View\Loader::make()->render("templates/client_mainpage.twig", array(
                "post" => $_SESSION['uname'],
            ));
            $logic = TRUE;
        }else{
            $logic = FALSE;
        }
        if($logic){
        }else{
            echo \View\Loader::make()->render("templates/Login_client.twig",array());
        }
    }
}

class client_logout{
    public function get(){
        $_SESSION =NULL;
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
            $passwordConfirm = $_POST['passwordC'];
            if($password != $passwordConfirm){
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