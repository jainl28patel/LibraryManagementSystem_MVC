<?php

namespace Controller;

class client_login_verify{
    public function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $row = \Model\User::user_exist($uname, $password);
        $logic=TRUE;
        if(!isset($row[\Controller\index::zero])){
            $logic=FALSE;
        }
        $logic2=FALSE;
        $row2 = \Model\User::user_verify($uname, $password);
        if(!isset($row2[index::zero])){
            $logic2=FALSE;
        }
        if($row2[index::zero]['password'] == hash("sha256", $password.$row2[index::zero]['salt']) ){
            $logic2=TRUE;
        }
        if(!isset($_POST['uname']) && !isset($_POST['password'])){
            echo "Please enter all the details";
        }elseif ($logic) {
            if(!$logic2){
                session_start();
                $_SESSION['uname'] = $uname;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid", $sessionId, time()+strtotime('30 days'),"/");
                \Model\User::set_cookie($sessionId, $uname);
                echo \View\Loader::make()->render("templates/client_mainpage.twig", array(
                    "post" => $uname,
                ));
            }else{
                echo "Incorrect password";
            }
        }else{
            echo "User don't exist";
        }
    }
}