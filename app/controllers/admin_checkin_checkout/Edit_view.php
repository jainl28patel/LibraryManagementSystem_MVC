<?php

namespace Controller;

class Edit_view{
    public static function get(){
        $row = \Model\User::check_cookie_admin($_COOKIE['sessionid']);
        $logic = TRUE;
        session_start();
        if (!empty($row[index::zero])&&($_SESSION['uname']=="admin")) {
            $_SESSION['uname'] = $row[index::zero]['uname'];
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