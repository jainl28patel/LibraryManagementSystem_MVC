<?php

namespace Controller;

class _view_checkin_checkout{
    public static function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        if (!empty($row[0])) {
            session_start();
            $_SESSION['uname'] = $row[0]['uname'];
            echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
                "booklist2" => \Model\book::getBookList_checkin(),
                "booklist1" => \Model\book::getBookList_checkout(),
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