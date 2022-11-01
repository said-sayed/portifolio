<?php
include '../Back/contDb.php';

class PortifolioItemController
{
    function index($request)
    {
        global $cont;
        $index = $cont->prepare('SELECT * FROM `portfolio_items` JOIN portfolio_category_item ON portfolio_category_item.item_id = portfolio_items.id WHERE portfolio_category_item.category_id = ?');
        $index->execute([$request]);
        return $index;
    }
    function updateItems($request)
    {
        global $cont;
        $query = "UPDATE portfolio_items , portfolio_category_item SET portfolio_category_item.category_id=? , portfolio_items.slug=?, portfolio_items.desc=? WHERE portfolio_items.id = ? AND portfolio_category_item.item_id=? AND portfolio_category_item.category_id = ?";
        echo $query;
        $updateItem = $cont->prepare($query);
        $updateItem->execute($request);
    }
    function deleteItems($request){

        global $cont;
        $deleteItems = $cont->prepare("DELETE FROM `portfolio_category_item` WHERE category_id=? AND item_id=?;");
        $deleteItems->execute($request);


    }
    function store($request)
    {

        global $cont;
        $insrt = $cont->prepare("INSERT INTO `portfolio_items`(`desc`, `slug` , `image`) VALUES (?,? ,?)");
        $insrt->execute($request);
        return $cont->lastInsertId();
    }
    function insertCategories($item_id, $category_id)
    {
        global $cont;
        $insrt = $cont->prepare("INSERT INTO `portfolio_category_item`(`category_id`, `item_id`) VALUES (?,?)");
        $insrt->execute([$category_id, $item_id]);
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
$portifolio = new PortifolioItemController();
if (isset($_POST['add'])) {
    $categories = $_POST["categoryId"];
    print_r($categories);
    $frist_index  = array_key_first($categories);
    $last_index  = array_key_last($categories);
    echo $frist_index;
    echo $last_index;
    $desc = $_POST['desc'];
    $slug = $_POST['slug'];
    $image = $_FILES['image'];

    if ($image['name']) {
        $image_new_name =  $portifolio->moveImage($image);
    } else {
        $image_new_name = null;
        // header("Location: ../portifolio/addPortifolioItem.php");
    }
    $data = [$desc, $slug, $image_new_name];
    $item_id = $portifolio->store($data);

    for ($i = $frist_index; $i < $last_index+1; $i++) {
        if (isset($categories[$i])) {
            $portifolio->insertCategories($item_id, $categories[$i]);
            // echo "said";  
        }
        
    }
}

if (isset($_GET['id'])) {
    $id_cactegory = $_GET['id'];
    $items = $portifolio->index($id_cactegory);
    header("location:../portifolio/viewPortifolioItem.php?Id=$id_cactegory");
    $_SESSION['index'] = "index";
}
if (isset($_POST['update']) and $_GET['idCategory']) {
    $idCategory = $_GET['idCategory'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $item_id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $data = [ $category_id, $slug, $desc, $item_id, $item_id ,$idCategory];
    // print_r($data);
    $portifolio->updateItems($data);
    header("Location: ../portifolio/viewPortifolioItem.php");
}
if (isset($_POST['delete'])){
    $category_id = $_POST['categoryID'];
    $item_id  = $_POST['itemID'];
    $data = [ $category_id  ,$item_id ];
    print_r($data);
    $portifolio->deleteItems($data);
}

