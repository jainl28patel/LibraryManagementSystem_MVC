<?php

namespace Controller;


class client_logout{
    public function get(){
        $_SESSION =NULL;
        \Model\User::delete_cookie($_COOKIE['sessionid']);
        setcookie('sessionId',"",time()-strtotime('30 days'));
        setcookie('PHPSESSID',"",time()-strtotime('30 days'));
        session_destroy();
        header('Location: /');
    }
}