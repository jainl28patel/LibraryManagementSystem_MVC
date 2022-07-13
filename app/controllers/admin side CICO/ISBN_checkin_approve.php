<?php

namespace Controller;

class ISBN_checkin_approve{
    public static function post(){
        $isbn = $_POST['ISBN'];
        $uname = $_POST['uname'];
        \Model\book::checkin_approved($isbn,$uname);
        $row=\Model\book::getBookBy_ISBN($isbn);
        $qty = $row[0]['count'];
        $qty++;
        \Model\book::change_qty($isbn,$qty);
        echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
            "booklist2" => \Model\book::getBookList_checkin(),
            "booklist1" => \Model\book::getBookList_checkout(),
        ));
    }
}