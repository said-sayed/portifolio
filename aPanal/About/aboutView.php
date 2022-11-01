<?php
ob_start();
session_start();
include '../Back/header.php';
include '../Back/AboutController.php';
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

    <?php if(isset($_SESSION['done']))
                  {
                      ?>
                      <div class="alert alert-success" role="alert">
                          <?php
                          echo $_SESSION['done'];
                          unset($_SESSION['done']);

                          ?>
                      </div>
                      <?php
                  }?>
    <?php 
    session_unset();
    $data = new AboutController;
    $about = $data->index()->fetch();
    ?>

    <div class="card-body">
        <form action="../Back/AboutController.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="name" value="<?php echo $about['name'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" value="<?php echo $about['age'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" name="title" value="<?php echo $about['title'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>From</label>
                        <input type="text" name="from" value="<?php echo $about['from'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Live In</label>
                        <input type="text" name="live_in" value="<?php echo $about['live_in'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" name="gender" value="<?php echo $about['gender'] ?>" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Enter ..." value="<?php echo $about['image'] ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Cv</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" id="" cols="30" rows="5"><?php echo $about['desc'] ?></textarea>
                    </div>
                </div>

            </div>
            <input type="hidden" value="<?php echo $about['id'] ?>" name="id">
            <input type="hidden" value="<?php echo $about['image'] ?>" name="oldImage">
            <input class="btn btn-warning" name="submit" type="submit" value="Update">
        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php';
?>