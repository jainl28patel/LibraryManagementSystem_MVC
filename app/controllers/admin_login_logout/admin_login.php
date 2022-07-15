<?php

namespace Controller;

class admin_login{
    public function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        if (!empty($row[\enum\constant::zero])) {
            session_start();
            $_SESSION['uname'] = $row[\enum\constant::zero]['uname'];
            echo \View\Loader::make()->render("templates/admin_mainpage.twig", array(
                "post" => $_SESSION['uname'],
            ));
            $logic = TRUE;
        }else{
            $logic = FALSE;
        }
        if($logic){
        }else{
            echo \View\Loader::make()->render("templates/Login_admin.twig",array());
        }
    }
}