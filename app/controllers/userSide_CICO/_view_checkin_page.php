<?php

namespace Controller;

class _view_checkin_page{
    public static function get(){
        echo \View\Loader::make()->render("templates/request_checkin.twig", array(
            "booklist" => \Model\book::getBookList_with_user(),
        ));
    }
}