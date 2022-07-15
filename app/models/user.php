<?php

namespace Model;

class User{
    public static function reigster_user($user_name,$salt,$hash){
        $db = \DB::get_instance();
        $query = $db->prepare("INSERT INTO user VALUES (?,?,?)");
        $query->execute([$user_name,$salt,$hash]);
    }
    public static function user_exist($uname){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT * FROM user where username = ?");
        $query->execute([$uname]);
        $row  = $query->fetchAll();
        return $row;
    }
    public static function admin_exist($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admin where admin_name = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        return $row;
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
        return $row;
    }
    public static function admin_verify($uname,$password){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT salt, password FROM admin WHERE admin_name = ?");
        $query->execute([$uname]);
        $row = $query->fetchAll();
        return $row;
    }

    public static function delete_cookie($sessionId){
        $db = \DB::get_instance();
        $query = $db->prepare("DELETE FROM cookies WHERE sessionId = ?");
        $query->execute([$sessionId]);
    }

    public static function check_cookie_client($sessionId){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT uname FROM cookies WHERE sessionId = ?");
        $query->execute([$sessionId]);
        $row = $query->fetchAll();
        return $row;
    }
    public static function check_cookie_admin($sessionId){
        $db = \DB::get_instance();
        $query = $db->prepare("SELECT uname FROM cookies WHERE sessionId = ?");
        $query->execute([$sessionId]);
        $row = $query->fetchAll();
        return $row;
    }
}