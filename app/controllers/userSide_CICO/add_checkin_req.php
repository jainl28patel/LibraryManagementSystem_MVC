<?php

namespace Controller;

class add_checkin_req{
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
