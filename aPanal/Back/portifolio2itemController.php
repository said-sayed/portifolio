<?php
include '../Back/contDb.php';

class Portifolio2ItemController
{
    function index()
    {
        global $cont;
        $index = $cont->prepare('SELECT * FROM `portfolio_items`');
        $index->execute([]);
        return $index;
    }
    
    function insertItem($request){
        global $cont;
        $insert = $cont->prepare('INSERT INTO `portfolio_items` (`slug` , `desc` , `image`) VALUES (?, ? , ?)');
        $insert->execute($request);
    }
    function updateItem($request){
        global $cont;
        $update = $cont->prepare('UPDATE `portfolio_items` SET slug=? , `desc`=? WHERE id=?');
        $update->execute($request);
    }
    function deleteItem($request){
        global $cont;
        $delete = $cont->prepare('DELETE FROM `portfolio_items` WHERE `id` = ?');
        $delete->execute([$request]);
    }
   
    
    function moveImage($image)
    {
        $image_name = $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_extension = pathinfo($image_name,  PATHINFO_EXTENSION);

        $chackValidation = $this->valdtionImage($image_extension, ['png', 'jpeg', 'PNG', 'jpg', 'webp']);
        if ($chackValidation) {
            $image_new_name = "_portifolio" . time() . "." . $image_extension;
            move_uploaded_file($image_tmp, "../../Images/$image_new_name");
            echo $image_new_name;
            return $image_new_name;
        }
    }
    function valdtionImage($typeImage, $images_extensions)
    {
        if (in_array($typeImage, $images_extensions)) {
            return true;
        } else {
            return false;
        }
    }
}
$portifolio = new Portifolio2ItemController();
if(isset($_POST['add'])){
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $image = $_FILES['image'];
    if($image['name']){
        $image_new_name = $portifolio->moveImage($image);
    }
    $data = [$slug , $desc , $image_new_name];
    $portifolio->insertItem($data);
    header("location: ../portifolio/addPortifolio2Item.php");
}

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $portifolio->deleteItem($item_id);
    header("location: ../portifolio/viewPortifolio2Item.php");
}
if (isset($_POST['update'])) {
    $item_id = $_POST['id'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $data = [$slug , $desc , $item_id];
    
    $portifolio->updateItem($data);
    header('Location: ../portifolio/viewPortifolio2Item.php');
    
}
