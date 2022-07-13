<?php

namespace Controller;

class _view_checkout_page{
    public static function get(){
        echo \View\Loader::make()->render("templates/view_checkout.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}

class _view_checkin_page{
    public static function get(){
        echo \View\Loader::make()->render("templates/request_checkin.twig", array(
            "booklist" => \Model\book::getBookList_with_user(),
        ));
    }
}

class add_checkout_request{
    public static function post(){
        session_start();
        $isbn = $_POST['ISBN'];
        $row = \Model\book::getBookBy_ISBN($isbn);
        $name = $row[0]['name'];
        $qty = $row[0]['count'];
        if($qty<=0){
            echo "Sorry Out of stock";
        }else{
            $qty--;
            $uname = $_SESSION['uname'];
            \Model\book::checkout_book($isbn,$name,$qty,$uname);
            echo \View\Loader::make()->render("templates/view_checkout.twig", array(
                "booklist" => \Model\book::getBookList(),
            ));
        }
    }
}

class add_checkin_req{
    public static function post(){
        session_start();
        $uname = $_SESSION['uname'];
        $isbn = $_POST['ISBN'];
        $row = \Model\book::getBookBy_ISBN($isbn);
        $name = $row[0]['name'];
        \Model\book::checkin_request_send($name,$uname,$isbn);
        echo \View\Loader::make()->render("templates/request_checkin.twig", array(
            "booklist" => \Model\book::getBookList_with_user(),
        ));
    }
}
