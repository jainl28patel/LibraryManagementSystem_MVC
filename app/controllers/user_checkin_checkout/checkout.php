<?php

namespace Controller;

class checkout{
    public static function get(){
        $row = \Model\User::check_cookie_client($_COOKIE['sessionid']);
        $logic = TRUE;
        session_start();
        if ( !empty($row[index::zero])  &&  ($_SESSION['uname']!="admin") ) {
            $_SESSION['uname'] = $row [index::zero]['uname'];
                echo \View\Loader::make()->render("templates/view_checkout.twig", array(
                "booklist" => \Model\book::getBookList(),
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
    public static function post(){
        session_start();
        $isbn = $_POST['ISBN'];
        $row = \Model\book::getBookBy_ISBN($isbn);
        $name = $row[index::zero]['name'];
        $qty = $row[index::zero]['count'];
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