<?php

namespace Controller;

class ISBN_change_qty{
    public static function post(){
        session_start();
        $new_qty = $_POST['ISBN_count'];
        $isbn = $_POST['ISBN'];
        \Model\book::change_qty($isbn,$new_qty);
        echo \View\Loader::make()->render("templates/view_edit.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}