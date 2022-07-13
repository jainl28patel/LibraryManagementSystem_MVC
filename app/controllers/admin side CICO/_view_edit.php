<?php

namespace Controller;

class _view_edit{
    public static function get(){
        echo \View\Loader::make()->render("templates/view_edit.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}