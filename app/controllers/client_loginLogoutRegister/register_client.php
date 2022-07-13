<?php

namespace Controller;

class Register_Client {
    public function get(){
        echo \View\Loader::make()->render("templates/register_client.twig", array(
        ));
    }
}