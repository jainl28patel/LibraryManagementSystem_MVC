<?php

namespace Controller;

class admin_login_verify{
    public static function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $row = \Model\User::admin_exist($uname,$password);
        $logic=TRUE;
        if(!isset($row[0])){
            $logic=FALSE;
        }
        $logic2=FALSE;
        $row2 = \Model\User::admin_verify($uname,$password);
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
                echo \View\Loader::make()->render("templates/admin_mainpage.twig", array());
            }else{
                echo "Incorrent password";
            }
        }else{
            echo "Admin dont exist with this credentials";
        }
    }
}