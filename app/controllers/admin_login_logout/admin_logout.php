<?php

namespace Controller;


class admin_logout{
    public function get(){
        $_SESSION = NULL;
        \Model\User::delete_cookie($_COOKIE['sessionid']);
        setcookie('sessionId',"",time()-60*60*24*30);
        setcookie('PHPSESSID',"",time()-60*60*24*30);
        session_destroy();
        header('Location: /');
    }
}