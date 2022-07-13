<?php

namespace Controller;

class _view_edit{
    public static function get(){
        echo \View\Loader::make()->render("templates/view_edit.twig", array(
            "booklist" => \Model\book::getBookList(),
        ));
    }
}

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

class _view_checkin_checkout{
    public static function get(){
        echo \View\Loader::make()->render("templates/approve_checkout_checkin.twig", array(
            "booklist2" => \Model\book::getBookList_checkin(),
            "booklist1" => \Model\book::getBookList_checkout(),
        ));
    }
}

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