<?php

namespace Controller;
abstract class index
{
    const zero = 0;
}
class client_login{
    public function get(){
        $row = \Model\User::check_cookie_client($_COOKIE['sessionid']);
        $logic = TRUE;
        if (isset($row[index::zero])) {
            session_start();
            $_SESSION['uname'] = $row[index::zero]['uname'];
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
    
    public function post(){
        $uname = $_POST['uname'];
        $password = $_POST['password'];
        $row = \Model\User::user_exist($uname, $password);
            // Working till here
        $logic=FALSE;
        if(isset($row[index::zero])){
            $logic=TRUE;
        }
        $logic2=FALSE;
        $row2 = \Model\User::user_verify($uname, $password);
        if(($row2[index::zero]['password'] == hash("sha256", $row2[index::zero]['salt'].$password))){
            $logic2=TRUE;
        }
        if(!isset($_POST['uname']) || !isset($_POST['password'])){
            echo "Please enter all the details";
        }
        elseif ($logic) {
            if($logic2){
                session_start();
                $_SESSION['uname'] = $uname;
                $sessionId = base64_encode(random_bytes(16));
                setcookie("sessionid", $sessionId, time()+strtotime('30 days'),"/");
                \Model\User::set_cookie($sessionId, $uname);
                echo \View\Loader::make()->render("templates/client_mainpage.twig", array(
                    "post" => $uname,
                ));
            }
            else{
                echo "Incorrect password";
            }
        }
        else{
            echo "User don't exist";
        }
    }
}