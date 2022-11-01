<?php
session_start();
include '../Back/header.php';
include '../Back/categoriesCoursesController.php';
$categoriesCourses = new categoriesCoursesController();
$categoriesCourses = $categoriesCourses->index()->fetchAll();
if (!empty($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
} else {
    $errors = [];
}
$index = 1;
// print_r($categoriesCourses);

?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- general form elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">Add Category</h3>
    </div>

    <?php if(!empty($_SESSION["update_done"])) {?>
    <div class="alert alert-success">
        <p><?= "Update Done" ?></p>
    </div>
    <?php } unset($_SESSION["update_done"])?>



    <?php if(!empty($_SESSION["add_category"])) {?>
    <div class="alert alert-success">
        <p><?= "Added Done" ?></p>
    </div>
    <?php } unset($_SESSION["add_category"])?>


    <?php foreach ($errors as $error) { ?>

        <div class="alert alert-danger">
            <p><?= $error ?></p>
        </div>
    <?php }
    unset($_SESSION['errors']); ?>

    <!-- /.card-header -->
    <div class="card-body">
        <form action="../Back/categoriesCoursesController.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>


                <input type="hidden" value="" name='id' class="form-control">
                <button class="btn btn-warning h-50 mt-4" type="submit" name="add">Add</button>
            </div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">index</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoriesCourses as $category) { ?>
                    <tr>

                        <td><?= $index ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>

                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $category['id'] ?>"></i>

                            <a href="../Back/categoriesCoursesController.php?id=<?= $category['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>

                            <div class="modal fade" id="editExampleModal<?= $category['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../Back/categoriesCoursesController.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Category Name</label>
                                                        <input type="text" name="name" value="<?= $category['name'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-3">
                                                    <input type="hidden" value="<?= $category['id'] ?>" name='id' class="form-control">
                                                    <!-- <button class="btn btn-warning" type="submit" name="update">Update</button> -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-primary" type="submit" name="update">Update</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                        </td>

                    </tr>
                <?php $index++;
                } ?>



            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php'
?>

<?php
include '../Back/footer.php'
?>