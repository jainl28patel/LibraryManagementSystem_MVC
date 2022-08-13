<?php

namespace Controller;

class _view_checkin_checkout{
    public static function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        session_start();
        if ( !empty($row[index::zero]) && ($_SESSION['uname']=="admin") ) {
            $_SESSION['uname'] = $row[index::zero]['uname'];
            echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
                "checkin_list" => \Model\book::getBookList_checkin(),
                "checkout_list" => \Model\book::getBookList_checkout(),
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