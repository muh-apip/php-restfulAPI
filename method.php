<?php
require_once "koneksi.php";
class Book
{
    public function get_books()
    {
        global $koneksi;
        $query = "SELECT * FROM books";
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get List Book Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_book($id = 0)
    {
        global $koneksi;
        $query = "SELECT * FROM books";
        if ($id != 0) {
            $query .= " WHERE id=" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $koneksi->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Get Book Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_book()
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '', 'price' => '', 'qty' => '',
            'author' => '', 'publisher' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "INSERT INTO books SET name = '$_POST[name]',
            price = '$_POST[price]',
            qty = '$_POST[qty]',
            author = '$_POST[author]',
            publisher = '$_POST[publisher]'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Book Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Book Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function update_book($id)
    {
        global $koneksi;
        $arrcheckpost = array(
            'name' => '', 'price' => '', 'qty' => '',
            'author' => '', 'publisher' => ''
        );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($koneksi, "UPDATE books SET 
            name = '$_POST[name]',
            price = '$_POST[price]',
            qty = '$_POST[qty]',
            author = '$_POST[author]',
            publisher = '$_POST[publisher]'WHERE id='$id'");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Book Updated Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Book Updation Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function delete_book($id)
    {
        global $koneksi;
        $query = "DELETE FROM books WHERE id=" . $id;
        if (mysqli_query($koneksi, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Book Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Book Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
