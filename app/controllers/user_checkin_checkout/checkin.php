<?php

namespace Controller;

class checkin_req{
    public static function get(){
        $row = \Model\User::check_cookie_client($_COOKIE['sessionid']);
        $logic = TRUE;
        session_start();
        if (  !empty($row[index::zero])  &&  ($_SESSION['uname']!="admin")  ) 
        {
            $_SESSION['uname'] = $row[index::zero]['uname'];
            echo \View\Loader::make()->render("templates/request_checkin.twig", array(
                "booklist" => \Model\book::getBookList_with_user($_SESSION['uname'])),
            );
            $logic = TRUE;
        }
        else
        {
            $logic = FALSE;
        }
        if($logic)
        {
        }
        else
        {
            echo \View\Loader::make()->render("templates/Login_client.twig",array());
        }
    }

    public static function post(){
        session_start();
        $uname = $_SESSION['uname'];
        $isbn = $_POST['ISBN'];
        $row = \Model\book::getBookBy_ISBN($isbn);
        $name = $row[index::zero]['name'];
        \Model\book::checkin_request_send($name, $uname, $isbn);
        echo \View\Loader::make()->render("templates/request_checkin.twig", array(
            "booklist" => \Model\book::getBookList_with_user($uname),
        ));
    }
}
