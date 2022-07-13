<?php

namespace Controller;

class _view_checkout_page{
    public static function get(){
        echo \View\Loader::make()->render("templates/view_checkout.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}