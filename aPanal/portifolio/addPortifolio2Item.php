<?php

include '../Back/header.php';

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>General Form</h1>
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
        <h3 class="card-title">General Elements</h3>
    </div>

    <div class="card-body">
        <form action="../Back/portifolio2itemController.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Enter ..." >
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                       
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
            <input class="btn btn-warning" name="add" type="submit" value="Add">
        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php';
?>