<?php

namespace Controller;

class ISBN_checkout_approve{
    public static function post(){
        $isbn = $_POST['ISBN'];
        $uname = $_POST['uname'];
        $row=\Model\book::getBookBy_ISBN($isbn);
        $name = $row[index::zero]['name'];
        $qty = $row[index::zero]['count'];
        \Model\book::checkout_approved($name,$isbn,$uname);
        echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
            "checkin_list" => \Model\book::getBookList_checkin(),
            "checkout_list" => \Model\book::getBookList_checkout(),
        ));
    }
}