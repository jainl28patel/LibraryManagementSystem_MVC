<?php

namespace Controller;


class client_register_process{
    public function post(){
        if( !( isset($_POST['userid'])  &&  isset($_POST['password'])  &&  isset($_POST['passwordC']) ) ){
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
                $hash = hash('sha256', $salt.$password);
                \Model\User::reigster_user($name, $salt, $hash);
                $_SESSION['uname'] = $name;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid", $sessionId, time()+strtotime('30 days'),"/");
                \Model\User::set_cookie($sessionId, $name);
                echo \View\Loader::make()->render("templates/client_mainpage.twig",array());
            }
        }
    }
}