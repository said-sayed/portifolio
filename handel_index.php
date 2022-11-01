<?php
use aPanal\back\course\courseController;
use aPanal\numbers\numbersController;

include "aPanal/Back/contDb.php";
////////show about
include 'aPanal/Back/AboutController.php';
$data = new AboutController;
$about = $data->index()->fetch();
/////////show skills

include 'aPanal/Back/SkillsController.php';
include 'aPanal/Back/SkillCatrgoryController.php';
$skillCategories = new SkillCatrgoryController();
$categories = $skillCategories->index()->fetchAll();
// print_r($categories);
$mySkill = new SkillsController();
$skills = $mySkill->index()->fetchAll();

///////////show Hostory || courses
error_reporting(E_ERROR | E_PARSE);

include 'aPanal/Back/courseController.php';
include "aPanal/Back/categoriesCoursesController.php";

$categoriesCourses = new categoriesCoursesController();
$courses = new courseController();
$categoriesCourses = $categoriesCourses->index()->fetchAll();
$courses = $course->index()->fetchAll();

////////////show services
include 'aPanal/Back/seviceController.php';
$services = new seviceController();
$services = $services->index()->fetchAll();
//////////// show Numbers
include 'aPanal/Back/numbersController.php';
$numbers = new numbersController();
$numbers = $numbers->index()->fetchAll();

//////////// show portifolio
include 'aPanal/Back/portifolio2CategoryControllrt.php';
include 'aPanal/Back/portifolio2itemController.php';
include 'aPanal/Back/Portifolio2ItemCategoryController.php';

$categoriesPortifolio = new portifolio2CategoryControllrt();
$categoriesPortifolio = $categoriesPortifolio->index()->fetchAll();


$items = new Portifolio2ItemController();
$itemsAllItems = $items->index()->fetchAll();

$categoriesItems = new Portifolio2ItemCategoryController();
$categoriesItems = $categoriesItems->select()->fetchAll();

if (isset($_GET['id_category'])) {
  $id = $_GET['id_category'];
  $indexitemsInCAtegory = $indexItems->index($id)->fetchAll();
} else {
  $indexitemsInCAtegory = $items->index()->fetchAll();
}

?>