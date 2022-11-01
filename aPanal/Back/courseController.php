<?php
namespace aPanal\back\course;

use aPanal\errors\Errors;
include '../Errors/errors.php';

session_start();
include 'contDb.php';


class courseController
{
    function index()
    {
        global $cont;
        $index = $cont->prepare("SELECT * FROM course");
        $index->execute([]);
        return $index;
    }
    function insert($request)
    {
        global $cont;
        $insert = $cont->prepare("INSERT INTO course (`name`, `year`, `slug`, `desc`, `course_category`) VALUES(? , ? , ? ,? , ?)");
        $insert->execute($request);
    }
    function update($request){
        global $cont;
        $update = $cont->prepare("UPDATE course SET `name` = ? , `year`=? , `slug` = ? , `desc` = ? , `course_category` = ? WHERE id = ?");
        $update->execute($request);
    }
    function delete($request){
        global $cont;
        $delete = $cont->prepare("DELETE FROM course WHERE id =?");
        $delete->execute([$request]);
    }
}
$course = new courseController();


if (isset($_POST['Add'])) {
$error = new Errors;

    $id = $_POST['id'];
    $course_name = $_POST['name'];
    $course_year = $_POST['year'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $category_id = $_POST['select'];
    echo $category_id;

    $error->empty($course_name);
    $error->empty($course_year);
    $error->empty($slug);


    $error->is_string($course_name);
    $error->is_string($course_year);
    $error->is_string($slug);


    $error->strlen($course_name);
    $error->strlen($course_year);
    $error->strlen($slug);
   
    print_r($error->errors);

    $data = [$course_name, $course_year, $slug, $desc, $category_id];
    if (empty($error->errors)) {
        $course->insert($data);
        $_SESSION['add_course']= "Add Done";
        header("location: ../Course/addCourse.php");
    }
    else{
        $_SESSION["errorsAdd"] = $error->errors;
        header("Location: ../Course/addCourse.php");
    }

    
}
if(isset($_POST['update'])){
$error = new Errors;

    $course_id = $_POST['id'];
    $course_name = $_POST['name'];
    $course_year = $_POST['year'];
    $slug = $_POST['slug'];
    $desc = $_POST['desc'];
    $category_id = $_POST['category_id'];
    $data = [$course_name,$course_year,$slug,$desc , $category_id , $course_id];

    $error->empty($course_name);
    $error->empty($course_year);
    $error->empty($slug);
    

    $error->is_string($course_name);
    $error->is_string($course_year);
    $error->is_string($slug);
    

    $error->strlen($course_name);
    $error->strlen($course_year);
    $error->strlen($slug);
    
    print_r($error->errors);

    if(empty($error->errors)){
        $course->update($data);
        $_SESSION['updateCourse'] = 'Update Done';
        header("location: ../Course/view_couurses.php");
    }
    else{
        $_SESSION['error'] =$error->errors;
        header("location: ../Course/view_couurses.php");
    }

}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $course->delete($id);
    header("location: ../Course/view_couurses.php");
}
else{
    //header("location: ../view_pages/view_couurses.php");
}