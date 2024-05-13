<?php
require_once "method.php";
$obj_book = new Book();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_book->get_book($id);
        } else {
            $obj_book->get_books();
        }
        break;
    case 'POST':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            $obj_book->update_book($id);
        } else {
            $obj_book->insert_book();
        }
        break;
    case 'DELETE':
        $id = intval($_GET["id"]);
        $obj_book->delete_book($id);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
