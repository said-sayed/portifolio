<?php
session_start();
include '../Back/contDb.php';

class Portifolio2ItemCategoryController
{
    function select()
    {
        global $cont;
        $select = $cont->prepare("SELECT * FROM `portfolio_category_item`");
        $select->execute([]);
        return $select;
    }
    function index($request)
    {
        global $cont;
        $index = $cont->prepare('SELECT * FROM `portfolio_items` JOIN portfolio_category_item ON portfolio_category_item.item_id = portfolio_items.id WHERE portfolio_category_item.category_id = ?');
        $index->execute([$request]);
        return $index;
    }

    function selectCategoryID($request)
    {
        global $cont;
        $selectCategoryID = $cont->prepare("SELECT category_id FROM portfolio_category_item WHERE item_id =?");
        $selectCategoryID->execute([$request]);
        return $selectCategoryID;
    }
    function selectCategoryName($request)
    {
        global $cont;
        $selectCategoryName = $cont->prepare("SELECT * FROM  portfolio_categories WHERE id=?");
        $selectCategoryName->execute([$request]);
        return $selectCategoryName;
    }
    function insert($request)
    {
        global $cont;
        $insert = $cont->prepare("INSERT INTO portfolio_category_item (category_id , item_id) VALUES (? , ?)");
        $insert->execute($request);
    }

    function delete($request)
    {
        global $cont;
        $delete = $cont->prepare("DELETE FROM portfolio_category_item WHERE category_id=?");
        $delete->execute([$request]);
    }
}
$item_category = new Portifolio2ItemCategoryController();
if (isset($_POST['add']) and $_GET['id']) {
    $category_id = $_POST['select'];
    $_SESSION['item_id'] = $_GET['id'];
    $item_id = $_SESSION['item_id'];
    $date = [$category_id, $item_id];
    $select = $item_category->select($date)->fetchAll();

    if (empty($select)) {
        $item_category->insert($date);
    }

    header("Location: ../portifolio/viewPortifolio2ItemCategory.php?id=$item_id");
}
if (isset($_GET['categoryID'])) {
    echo "said";
    $categoryId = $_GET['categoryID'];
    // $item_id = $_GET['itemId'];
    $item_id = $_SESSION['item_id'];
    $item_category->delete($categoryId);
    header("Location: ../portifolio/viewPortifolio2ItemCategory.php?id=$item_id");
}
