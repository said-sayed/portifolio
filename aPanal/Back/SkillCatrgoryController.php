<?php
include "contDb.php";



class SkillCatrgoryController
{
    function index()
    {
        global $cont;
        $skillCategories = $cont->prepare("SELECT * FROM  skills_catogeries");
        $skillCategories->execute([]);
        return $skillCategories;
    }
    function store($request)
    {
        echo "test";
        global $cont;
        $insert  = $cont->prepare("INSERT INTO skills_catogeries (name) VALUES (?)");
        $insert->execute([$request]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    function update($request){
        global $cont;
        $update = $cont->prepare("UPDATE `skills_catogeries` SET `name`=? WHERE `id`=?");
        $update->execute($request);
        echo "said" ;
    }
    function delete($request){
        global $cont;
        $delete = $cont->prepare("DELETE FROM `skills_catogeries` WHERE `id`=?");
        $delete->execute([$request]);
    }

}
$categorySkill = new SkillCatrgoryController();

if (isset($_POST['addCategory'])) {
   $name = $_POST['name'];    
   $categorySkill->store($name);

}


if (isset($_POST['update'])){
    $name_category = $_POST['name'];
   
    $id_category = $_POST['id'];
    
    $data = [ $name_category , $id_category  ];

        $categorySkill ->update($data);
        $_SESSION['update_done'] = 'Update_Done';
        header('Location: ../Skills/addSkillsCateg.php');
    
}

if(isset($_GET['id'])){
    $id_category = $_GET['id'];
    $categorySkill->delete($id_category);
    header("location: ../Skills/addSkillsCateg.php");
}