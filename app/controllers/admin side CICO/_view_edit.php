<?php

namespace Controller;

class _view_edit{
    public static function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        session_start();
        if (!empty($row[\enum\constant::zero])&&($_SESSION['uname']=="admin")) {
            $_SESSION['uname'] = $row[\enum\constant::zero]['uname'];
            echo \View\Loader::make()->render("templates/view_edit.twig", array(
                "booklist" => \Model\book::getBookList(),
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