<?php

namespace Controller;

class add_new{
    public static function post(){
        $name = $_POST['name'];
        $ISBN = $_POST['ISBN'];
        $qty = $_POST['qty'];
        if(!(isset($name)&&isset($ISBN)&&isset($qty))){
            echo "Please enter all the fields";
        }else{
            \Model\book::add_new_book($name,$ISBN,$qty);
            echo \View\Loader::make()->render("templates/view_edit.twig", array(
                "booklist" => \Model\book::getBookList(),
            ));
        }
    }
}