<?php

namespace Controller;

class ISBN_delete_book{
    public static function post(){
        session_start();
        $isbn = $_POST['ISBN'];
        \Model\book::delete_book($isbn);
        echo \View\Loader::make()->render("templates/view_edit.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}