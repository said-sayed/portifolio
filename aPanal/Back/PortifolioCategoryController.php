<?php
include "../Back/contDb.php";

class PortifolioCategoryController
{
    function index()
    {
        global $cont;
        $get = $cont->prepare("SELECT * FROM `portfolio_categories`");
        $get->execute([]);

        return $get;
    }
   function insert($request){
    global $cont;
    $insert = $cont->prepare("INSERT INTO `portfolio_categories`(`name`) VALUES (?)");
    $insert->execute([$request]);
   }
}
$PortifolioCategory= new PortifolioCategoryController();

if(isset($_POST['add'])){
    $category_name = $_POST['name'];
    $PortifolioCategory->insert($category_name);
}

