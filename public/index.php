<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/admin" => "\Controller\admin_login",
    "/client" => "\Controller\client_login",
    "/client/register" => "\Controller\Register_Client",
    "/admin/register" => "\Controller\Register_Admin",
    "/client/register/process" => "\Controller\client_register_process",
    "/client/login" => "\Controller\client_login_verify",
    "/client/logout" => "\Controller\client_logout",
    "/admin/logout" => "\Controller\admin_logout",
    "/admin/login" => "\Controller\admin_login_verify",
    "/view_checkout_page" => "\Controller\_view_checkout_page",
    "/ISBN" => "\Controller\add_checkout_request",
    "/ISBN_change_qty" => "\Controller\ISBN_change_qty",
    "/ISBN_delete_book" => "\Controller\ISBN_delete_book",
    "/view_edit" => "\Controller\_view_edit",
    "/add_book" => "\Controller\add_new",
    "/view_checkin_page" => "\Controller\_view_checkin_page",
    "/ISBN_checkin_req" => "\Controller\add_checkin_req",
    "/view_checkin_checkout" => "\Controller\_view_checkin_checkout",
    "/ISBN_checkout_approve" => "\Controller\ISBN_checkout_approve",
    "/ISBN_checkin_approve" => "\Controller\ISBN_checkin_approve",
));