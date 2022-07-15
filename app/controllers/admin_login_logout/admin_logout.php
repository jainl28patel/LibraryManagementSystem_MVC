<?php

namespace Controller;


class admin_logout{
    public function get(){
        $_SESSION = NULL;
        \Model\User::delete_cookie($_COOKIE['sessionid']);
        setcookie('sessionId', "", time()-strtotime('30 days'));
        //strtotime('+30 days',strtotime('05-06-2016'))
        setcookie('PHPSESSID', "", time()-strtotime('30 days'));
        session_destroy();
        header('Location: /');
    }
}