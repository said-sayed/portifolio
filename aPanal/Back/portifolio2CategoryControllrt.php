<?php
include "../Back/contDb.php";

class portifolio2CategoryControllrt
{
    function index()
    {
        global $cont;
        $get = $cont->prepare("SELECT * FROM `portfolio_categories`");
        $get->execute([]);
        return $get;
    }
    function insert($request)
    {
        global $cont;
        $insert = $cont->prepare("INSERT INTO `portfolio_categories`(`name`) VALUES (?)");
        $insert->execute([$request]);
    }
    function delete($request)
    {
        global $cont;
        $delete = $cont->prepare("DELETE FROM `portfolio_categories` WHERE id = ?");
        $delete->execute([$request]);
    }
    function update($request)
    {
        global $cont;
        $update = $cont->prepare("UPDATE `portfolio_categories` set name = ? WHERE id = ?");
        $update->execute($request);
    }
}
$PortifolioCategory = new portifolio2CategoryControllrt();

if (isset($_POST['add'])) {
    $category_name = $_POST['name'];
    $PortifolioCategory->insert($category_name);
    header("location: ../portifolio/addPortifolio2Ctegory.php");
}
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $PortifolioCategory->delete($category_id);
    // header("location: ../portifolio/addPortifolio2Ctegory.php");
}
if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $data = [$name, $category_id];

    $PortifolioCategory->update($data);
    header('Location: ../portifolio/addPortifolio2Ctegory.php');
}
