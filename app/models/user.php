<?php

namespace Model;

class User{
    public static function reigster_user($user_name,$salt,$password){
        $db = \DB::get_instance();
        $quey = $db->prepare("INSERT INTO user VALUES (?,?,?)");
        $quey->execute([$user_name,$salt,$password]);
    }
    public static function user_exist($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM user where username = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        return TRUE;
    }
    public static function admin_exist($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admin where admin_name = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        return TRUE;
    }
    public static function set_cookie($sessionId,$uname){
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO cookies VALUES (?,?)");
        $query->execute([$uname,$sessionId]);
    }
    public static function user_verify($uname,$password){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT salt, password FROM user WHERE username = ?");
        $query->execute([$uname]);
        $row = $query->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        if($row[0]['password'] == hash("sha256",$password.$row[0]['salt']) ){
            return TRUE;
        }
        return FALSE;
    }
    public static function admin_verify($uname,$password){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT salt, password FROM admin WHERE admin_name = ?");
        $query->execute([$uname]);
        $row = $query->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        if($row[0]['password'] == hash("sha256",$password.$row[0]['salt']) ){
            return TRUE;
        }
        return FALSE;
    }

    public static function delete_cookie($sessionId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM cookies WHERE sessionId = ?");
        $stmt->execute([$sessionId]);
    }

    public static function check_cookie_client($sessionId){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT * FROM cookies WHERE sessionId = ?");
        $query->execute([$sessionId]);
        $row = $query->fetchAll();
        if (!empty($row[0])) {
            session_start();
            $_SESSION['uname'] = $row[0]['uname'];
            // $sessionId = base64_encode(random_bytes(16));
            // setcookie("sessionid",$sessionId,time()+60*60*24*30);
            // \Model\User::set_cookie($sessionId,$row[0]['uname']);
            echo \View\Loader::make()->render("templates/client_mainpage.twig", array(
                "post" => $_SESSION['uname'],
            ));
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function check_cookie_admin($sessionId){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT * FROM cookies WHERE sessionId = ?");
        $query->execute([$sessionId]);
        $row = $query->fetchAll();
        if (!empty($row[0])) {
            session_start();
            $_SESSION['uname'] = $row[0]['uname'];
            // $sessionId = base64_encode(random_bytes(16));
            // setcookie("sessionid",$sessionId,time()+60*60*24*30);
            // \Model\User::set_cookie($sessionId,$row[0]['uname']);
            echo \View\Loader::make()->render("templates/admin_mainpage.twig", array());
            return TRUE;
        }else{
            return FALSE;
        }
    }
}