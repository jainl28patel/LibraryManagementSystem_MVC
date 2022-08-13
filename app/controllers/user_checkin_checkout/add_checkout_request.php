<?php

// namespace Controller;

// class add_checkout_request{
//     public static function post(){
//         session_start();
//         $isbn = $_POST['ISBN'];
//         $row = \Model\book::getBookBy_ISBN($isbn);
//         $name = $row[index::zero]['name'];
//         $qty = $row[index::zero]['count'];
//         if($qty<=0){
//             echo "Sorry Out of stock";
//         }else{
//             $qty--;
//             $uname = $_SESSION['uname'];
//             \Model\book::checkout_book($isbn,$name,$qty,$uname);
//             echo \View\Loader::make()->render("templates/view_checkout.twig", array(
//                 "booklist" => \Model\book::getBookList(),
//             ));
//         }
//     }
// }