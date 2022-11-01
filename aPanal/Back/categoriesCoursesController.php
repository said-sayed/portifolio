<?php

use aPanal\errors2\Errors2;

include 'contDb.php';
include '../Errors/errors2.php';


class categoriesCoursesController
{

    function index()
    {
        global $cont;
        $index = $cont->prepare("SELECT * FROM categories_courses");
        $index->execute([]);
        /* echo "<pre>";
        print_r($index);
        echo "<pre>"; */
        return $index;
    }
     function insert($request)
    {
        global $cont;
        $add = $cont->prepare("INSERT INTO `categories_courses`(`name`) VALUES (?)");
         if ($add->execute([$request])) {
            $_SESSION['category_add'] = "category added";
        }
    }
    function update($request){
        global $cont;
        $update = $cont->prepare("UPDATE `categories_courses` SET `name`=? WHERE `id`=?");
        $update->execute($request);
        echo "said" ;
    }
    
    
    
    function delete($request){
        global $cont;
        $delete = $cont->prepare("DELETE FROM `categories_courses` WHERE `id`=?");
        $delete->execute([$request]);
    }
}
$categoriesCourses = new categoriesCoursesController();
if (isset($_POST['add'])) {
$error = new Errors2;

    $id = $_POST['id'];
    $name = $_POST['name'];
   
    $error->empty($name);
    $error->is_string($name);
    $error->strlen($name);
    print_r($error->errors);

    if (empty($error->errors)) {
        
        $categoriesCourses->insert($name);
        $_SESSION['add_category']= "Added Done";
        header("location: ../Course/add_categoies_course.php");
    }
    else{
        $_SESSION['errors']=$error->errors;
        $_SESSION['errors'];
        header("location: ../Course/add_categoies_course.php");
    }
}

if (isset($_POST['update'])){
$error = new Errors2;

    $name_category = $_POST['name'];
   
    $id_category = $_POST['id'];
    
    $data = [ $name_category , $id_category  ];
    $error->empty($name_category);
    $error->is_string($name_category);
    $error->strlen($name_category);

 

     if(empty($error->errors)){
        $categoriesCourses ->update($data);
        print_r($data);
        $_SESSION['update_done'] = 'Update_Done';
        header('Location: ../Course/add_categoies_course.php');
    }
    else{
        $_SESSION['errors'] = $error->errors;
        header("location: ../Course/add_categoies_course.php");
    } 
    
}
//for delete category
if(isset($_GET['id'])){
    $id_category = $_GET['id'];
    $categoriesCourses->delete($id_category);
    header("location: ../Course/add_categoies_course.php");
}