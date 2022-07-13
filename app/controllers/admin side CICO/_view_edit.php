<?php

namespace Controller;

class _view_edit{
    public static function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        if (!empty($row[0])) {
            session_start();
            $_SESSION['uname'] = $row[0]['uname'];
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