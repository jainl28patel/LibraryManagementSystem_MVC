<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/admin" => "\Controller\admin_login",   
    "/client" => "\Controller\client_login", 
    "/client/register" => "\Controller\Register_Client",   
    "/client/logout" => "\Controller\client_logout", 
    "/admin/logout" => "\Controller\admin_logout",  
    "/checkout" => "\Controller\checkout",  
    "/checkin" => "\Controller\checkin",  
    "/ISBN" => "\Controller\checkout", 
    "/ISBN_change_qty" => "\Controller\ISBN_change_qty", 
    "/ISBN_delete_book" => "\Controller\ISBN_delete_book",  
    "/Edit_view" => "\Controller\Edit_view",  
    "/add_book" => "\Controller\add_new",  
    "/checkin_req" => "\Controller\checkin_req",   
    "/view_checkin_checkout" => "\Controller\_view_checkin_checkout",   
    "/ISBN_checkout_approve" => "\Controller\ISBN_checkout_approve",
    "/ISBN_checkin_approve" => "\Controller\ISBN_checkin_approve",
));