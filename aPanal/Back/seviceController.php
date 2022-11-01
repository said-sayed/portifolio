<?php
use aPanal\errors\Errors;

session_start();
include 'contDb.php';
include '../Errors/errors.php';

class seviceController
{

    function index()
    {
        global $cont;
        $index = $cont->prepare("SELECT * FROM services");
        $index->execute([]);
        /* echo "<pre>";
        print_r($index);
        echo "<pre>"; */
        return $index;
    }
    function insert($request)
    {
        global $cont;
        $add = $cont->prepare("INSERT INTO `services`(`name` , `desc` , `icon`) VALUES (? , ? , ?)");
        $add->execute($request);
    }

    function update($request)
    {
        global $cont;
        $update = $cont->prepare("UPDATE services SET `name`=? , `desc`=? , `icon`=? WHERE id =? ");
        $update->execute($request);
    }
    function delete($request)
    {
        global $cont;
        $add = $cont->prepare("DELETE FROM `services` WHERE id = ?");
        $add->execute([$request]);
    }
}
$service = new seviceController();


if (isset($_POST['add'])) {
    $error = new Errors;

    $service_id = $_POST['id'];
    $service_name = $_POST['name'];
    $service_icon = $_POST['icon'];
    $service_desc = $_POST['desc'];


    $data = [$service_name,  $service_desc , $service_icon];
    print_r($data);



    //chek errors 
    $error->empty($service_name);
    $error->empty($service_icon);

    $error->is_string($service_name);
    $error->is_string($service_icon);

    $error->strlen($service_name);
    $error->strlen($service_icon);

    if (empty($error->errors)) {
        $service->insert($data);
        header('Location:../Services/addService.php');

        $_SESSION['add']  = "done";
    } else {
        $_SESSION['errors'] = $error->errors;
        header('Location:../Services/addService.php');
    }
}

if (isset($_POST['update'])) {
    $error = new Errors;

    $service_id = $_POST['id'];
    $service_name = $_POST['name'];
    $service_icon = $_POST['icon'];
    $service_desc = $_POST['desc'];


    $data = [$service_name, $service_desc , $service_icon, $service_id];
    print_r($data);



    //chek errors 
    $error->empty($service_name);
    $error->empty($service_icon);

    $error->is_string($service_name);
    $error->is_string($service_icon);

    $error->strlen($service_name);
    $error->strlen($service_icon);

    if (empty($error->errors)) {
        $service->update($data);
        header('Location:../Services/view_sevices.php');
        $_SESSION['update']  = "done";
    } else {
        $_SESSION['errors'] = $error->errors;
        header('Location:../Services/view_sevices.php');
    }
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $service->delete($id);
    header('Location:../Services/view_sevices.php');
}
