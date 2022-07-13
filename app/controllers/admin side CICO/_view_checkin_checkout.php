<?php

namespace Controller;

class _view_checkin_checkout{
    public static function get(){
        echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
            "booklist2" => \Model\book::getBookList_checkin(),
            "booklist1" => \Model\book::getBookList_checkout(),
        ));
    }
}