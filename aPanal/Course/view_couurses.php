<?php

use aPanal\back\course\courseController;

include '../Back/courseController.php';
include "../Back/categoriesCoursesController.php";
include '../Back/header.php';


$categoriesCourses = new categoriesCoursesController();
$categoriesCourses = $categoriesCourses->index()->fetchAll();

$index = 1;
$courses = new courseController();
$courses = $course->index()->fetchAll();

if(!empty($_SESSION['error'])){
    $errors = $_SESSION['error'];
}
else{
    $errors = [];
}

/* echo "<pre>";
print_r($categoriesCourses);
echo "<pre>";

echo "<pre>";
print_r($courses);
echo "<pre>"; */
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Your Courses</h1>
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

<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">Your Courses</h3>
    </div>
    <?php if(isset($_SESSION["updateCourse"])) {?>
    <div class="alert alert-success">
        <p><?= "Updated Done" ?></p>
    </div>
    <?php } unset($_SESSION["updateCourse"])?>

    <?php foreach ($errors as $error){ ?>
    <div class="alert alert-danger">
        <p><?= $error?></p>
    </div>
    <?php } unset($_SESSION['error']); ?>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">index</th>
                <th scope="col">Name</th>
                <th scope="col">Year</th>
                <th scope="col">Slug</th>
                <th scope="col">Desc</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course) { ?>

                <tr>
                    <div class="row">
                        <td><?= $index ?></td>
                        <td><?= $course['name'] ?></td>
                        <td><?= $course['year'] ?></td>
                        <td><?= $course['slug'] ?></td>
                        <td><?= $course['desc'] ?></td>

                        <td>
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $course['id'] ?>"></i>
                            <a href="../Back/courseController.php?id=<?= $course['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>

                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="editExampleModal<?= $course['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../Back/courseController.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Course Name</label>
                                                        <input type="text" name="name" value="<?= $course['name'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Course Year</label>
                                                        <input type="text" name="year" value="<?= $course['year'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Course Slug</label>
                                                        <input type="text" name="slug" value="<?= $course['slug'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Course desc</label>
                                                        <input type="text" name="desc" value="<?= $course['desc'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Category Name</label>
                                                        <select class="form-control" name="category_id">
                                                            <?php foreach ($categoriesCourses as $categoryCourse) :
                                                                if ($categoryCourse['id'] == $course['course_category']) { ?>
                                                                    <option selected value="<?= $categoryCourse['id'] ?>">
                                                                        <?= $categoryCourse['name'] ?>
                                                                    </option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $categoryCourse['id'] ?>">
                                                                        <?= $categoryCourse['name'] ?>
                                                                    </option>
                                                            <?php }
                                                            endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input type="hidden" value="<?= $course['id'] ?>" name='id' class="form-control">
                                                        <!-- <button class="btn btn-warning" type="submit" name="update">Update</button> -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            <button class="btn btn-primary" type="submit" name="update">Update</button>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </td>

                    </div>
                </tr>
            <?php $index++;
            } ?>

        </tbody>
    </table>
</div>



<?php
include '../Back/footer.php';
?>