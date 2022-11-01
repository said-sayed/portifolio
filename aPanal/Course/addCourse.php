<?php

use aPanal\back\course\courseController;

include '../Back/categoriesCoursesController.php';
include '../Back/courseController.php';
include '../Back/header.php';

$categoriesCourse = new categoriesCoursesController();
$categoriesCourse = $categoriesCourse->index()->fetchAll();


$course = new courseController();
$course = $course->index()->fetchAll();


if (!empty($_SESSION['errorsAdd'])) {
    $errors = $_SESSION['errorsAdd'];
} else {
    $errors = [];
}






/* echo "<pre>";
print_r($about);
echo "<pre>"; */
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Course</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">General Form</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- general form elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">Add Course</h3>
    </div>

    <?php if (isset($_SESSION["add_course"])) { ?>
        <div class="alert alert-success">
            <p><?= "Add Done" ?></p>
        </div>
    <?php }
    unset($_SESSION["add_course"]) ?>

    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger">
            <p><?= $error ?></p>
        </div>
    <?php }
    unset($_SESSION['errorsAdd']); ?>

    <!-- /.card-header -->
    <div class="card-body">
        <form action="../Back/courseController.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Course Name</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>slug</label>
                        <input type="text" name="slug" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6 ">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select" name="select">
                            <?php foreach ($categoriesCourse as $category) { ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" value="" name='id' class="form-control">
            <button class="btn btn-warning" type="submit" name="Add">Add</button>

        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php'
?>