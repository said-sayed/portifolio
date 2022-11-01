<?php
session_start();



include '../Back/header.php';


if (!empty($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
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
                <h1>Add Number</h1>
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
        <h3 class="card-title">Add Numbers</h3>
    </div>

    <?php if (!empty($_SESSION["add"])) { ?>
        <div class="alert alert-success">
            <p><?= "Add Done" ?></p>
        </div>
    <?php }
    unset($_SESSION["add"]) ?>

    <?php foreach ($errors as $error) { ?>

        <div class="alert alert-danger">
            <p><?= $error ?></p>
        </div>
    <?php }
    unset($_SESSION['errors']); ?>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="../Back/numbersController.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label> Name</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Number</label>
                        <input type="number" name="num" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
            </div>

            <input type="hidden" value="" name='id' class="form-control">
            <button class="btn btn-warning" type="submit" name="add">Add</button>

        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php'
?>