<?php

namespace aPanal\numbers;
use aPanal\errors\Errors;

session_start();

include '../Errors/errors.php';
include 'contDb.php';

class numbersController
{

    function index()
    {
        global $cont;
        $index = $cont->prepare("SELECT * FROM numbers");
        $index->execute([]);
        /* echo "<pre>";
        print_r($index);
        echo "<pre>"; */
        return $index;
    }
    function insert($request)
    {
        global $cont;
        $add = $cont->prepare("INSERT INTO `numbers`(`name` , `num` ) VALUES (? , ?)");
        $add->execute($request);
    }

     function update($request)
    {
        global $cont;
        $update = $cont->prepare("UPDATE numbers SET `name`=? , `num`=?  WHERE id =? ");
        $update->execute($request);
    }
    
    function delete($request)
    {
        global $cont;
        $add = $cont->prepare("DELETE FROM `numbers` WHERE id = ?");
        $add->execute([$request]);
    } 
}
$numbers = new numbersController();



if (isset($_POST['add'])) {
$error = new Errors;

    $num_id = $_POST['id'];
    $num_name = $_POST['name'];
    $num_numbers = $_POST['num'];



    $data = [$num_name, $num_numbers];
    print_r($data);



    //chek errors 
    $error->empty($num_name);
    $error->empty($num_numbers);

    $error->is_string($num_name);

    $error->strlen($num_name);


    if (empty($error->errors)) {
        $numbers->insert($data);
        header('Location:../Numbers/addNumbers.php');

        $_SESSION['add']  = "done";
    } else {
        $_SESSION['errors'] = $error->errors;
        header('Location:../Numbers/addNumbers.php');
    }
}

 if (isset($_POST['update'])) {
    $error = new Errors;

    $num_id = $_POST['id'];
    $num_name = $_POST['name'];
    $num_numbers = $_POST['num'];


    $data = [$num_name, $num_numbers , $num_id];
    print_r($data);



    //chek errors 
    $error->empty($num_name);
    $error->empty($num_numbers);

    $error->is_string($num_name);

    $error->strlen($num_name);

    if (empty($error->errors)) {
        $numbers->update($data);
        header('Location:../Numbers/view_nums.php');
        $_SESSION['update']  = "done";
    } else {
        $_SESSION['errors'] = $error->errors;
        header('Location:../Numbers/view_nums.php');
    }
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $numbers->delete($id);
    header('Location:../Numbers/view_nums.php');
}
 
