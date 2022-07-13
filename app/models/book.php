<?php

namespace Model;

class book{
    public static function getBookList(){
        $db = \DB::get_instance();
        $query = $db->prepare("select * from booklist");
        $query->execute();
        $row = $query->fetchAll();
        return $row;
    }
    public static function getBookList_checkin(){
        $db = \DB::get_instance();
        $query = $db->prepare("select * from checkin");
        $query->execute();
        $row = $query->fetchAll();
        return $row;
    }
    public static function getBookList_checkout(){
        $db = \DB::get_instance();
        $query = $db->prepare("select * from checkout");
        $query->execute();
        $row = $query->fetchAll();
        return $row;
    }
    public static function getBookList_with_user(){
        $db = \DB::get_instance();
        session_start();
        $uname = $_SESSION['uname'];
        $query = $db->prepare("select * from with_user where uname = ?");
        $query->execute([$uname]);
        $row = $query->fetchAll();
        return $row;
    }
    public static function getBookBy_ISBN($isbn){
        $db = \DB::get_instance();
        $query = $db->prepare("select name,count from booklist where ISBN = ?");
        $query->execute([$isbn]);
        $row = $query->fetchAll();
        return $row;
    }
    public static function getBookBy_ISBN_checkin($isbn){
        $db = \DB::get_instance();
        $query = $db->prepare("select name,count from checkout where ISBN = ?");
        $query->execute([$isbn]);
        $row = $query->fetchAll();
        return $row;
    }
    public static function checkout_book($isbn,$name,$qty,$uname){
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE booklist SET count = ? WHERE ISBN = ?");
        $query->execute([$qty,$isbn]);
        $query2 = $db->prepare("INSERT INTO checkout values (?,?,?)");
        echo $uname;
        $query2->execute([$name,$isbn,$uname]);
    }
    public static function checkin_book($isbn,$name,$qty,$uname){
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE booklist SET count = ? WHERE ISBN = ?");
        $query->execute([$qty,$isbn]);
        $query2 = $db->prepare("INSERT INTO checkout values (?,?,?)");
        echo $uname;
        $query2->execute([$name,$isbn,$uname]);
    }
    public static function change_qty($isbn,$qty){
        $db = \DB::get_instance();
        $query = $db->prepare("UPDATE booklist SET count = ? WHERE ISBN = ?");
        $query->execute([$qty,$isbn]);
    }
    public static function delete_book($isbn){
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM booklist WHERE ISBN = ?");
        $query->execute([$isbn]);
    }
    public static function add_new_book($name,$isbn,$qty){
        $db = \DB::get_instance();
        $query2 = $db->prepare("INSERT INTO booklist values (?,?,?)");
        $query2->execute([$name,$isbn,$qty]);
    }
    public static function checkout_approved($name,$isbn,$uname){
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM checkout WHERE ISBN = ? and uname = ?");
        $query->execute([$isbn,$uname]);
        $query2 = $db->prepare("INSERT INTO with_user values (?,?,?)");
        $query2->execute([$name,$isbn,$uname]);
    }
    public static function checkin_approved($isbn,$uname){
        $db = \DB::get_instance();
        $query2 = $db->prepare("DELETE FROM checkin WHERE ISBN = ? and uname = ?");
        $query2->execute([$isbn,$uname]);
    }
    public static function checkin_request_send($name,$uname,$isbn){
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO checkin VALUES (?,?,?)");
        $query->execute([$name,$isbn,$uname]);
        $query2 = $db->prepare("DELETE FROM with_user WHERE ISBN = ? and uname = ?");
        $query2->execute([$isbn,$uname]);
    }
}