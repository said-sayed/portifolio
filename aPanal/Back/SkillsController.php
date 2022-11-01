<?php 
include "contDb.php";

class SkillsController{
   function index(){
        global $cont;
        $skills = $cont->prepare("SELECT * FROM  skills");
        $skills->execute([]);
        return $skills;
       
    }
    function store($request){
        global $cont;
        $insert  = $cont->prepare("INSERT INTO skills ( name , progress , category_id) VALUES ( ? ,?, ?)");
        $insert->execute($request);
        header("Location:" . $_SERVER['HTTP_REFERER'] );
        
    }

    function update($request)
    {
        print_r($request);
        global $cont;
        $updateSkill  = $cont->prepare("UPDATE `skills` SET `name`=? ,`progress`=?,`category_id`=? WHERE id=? ");
        if($updateSkill->execute($request))
        {
            // Session Done
            header("Location:" . $_SERVER['HTTP_REFERER'] );
        }else
        {
            // Session Erorr

        }
    }
    function delete($request){
        global $cont;
        $delete  = $cont->prepare("DELETE FROM skills WHERE id=? ");
        $delete->execute([$request]);
    }
}

$skill = new SkillsController();

if(isset($_POST["addSkill"])){
   
    

    $skill_name = $_POST["name"];
    $progress = $_POST["progress"];
    $category_id = $_POST["category_id"];
    echo $category_id;
    $data = [$skill_name , $progress  , $category_id ];
   
    $skill->store($data);
    
}

if(isset($_POST["updateSkill"])){
   
    $skill_name = $_POST["name"];
    $progress = $_POST["progress"];
    $category_id = $_POST["category_id"];
    $id = $_POST["id"];
    
    $data = [$skill_name , $progress  , $category_id , $id];
    $skill->update($data); 
}
if(isset($_GET['id'])){
    echo "Said";
    $id = $_GET['id'];
    $skill->delete($id);
    header("Location: ../skills/viewSkills.php");
}
