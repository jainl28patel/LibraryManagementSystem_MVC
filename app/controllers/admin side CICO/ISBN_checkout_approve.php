<?php

namespace Controller;

class ISBN_checkout_approve{
    public static function post(){
        $isbn = $_POST['ISBN'];
        $uname = $_POST['uname'];
        $row=\Model\book::getBookBy_ISBN($isbn);
        $name = $row[0]['name'];
        $qty = $row[0]['count'];
        \Model\book::checkout_approved($name,$isbn,$uname);
        echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
            "booklist2" => \Model\book::getBookList_checkin(),
            "booklist1" => \Model\book::getBookList_checkout(),
        ));
    }
}