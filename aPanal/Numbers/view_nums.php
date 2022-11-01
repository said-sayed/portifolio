<?php

use aPanal\numbers\numbersController;

include '../Back/numbersController.php';
include '../Back/header.php';


$index = 1;
$numbers = new numbersController();
$numbers = $numbers->index()->fetchAll();

if(!empty($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
}
else{
    $errors = [];
}

/* echo "<pre>";
print_r($numbers);
echo "<pre>";  */
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Your Numbers</h1>
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
        <h3 class="card-title">Your Numbers</h3>
    </div>
    <?php if(!empty($_SESSION["update"])) {?>
    <div class="alert alert-success">
        <p><?= "Updated Done" ?></p>
    </div>
    <?php } unset($_SESSION["update"])?>

    <?php foreach ($errors as $error){ ?>
    <div class="alert alert-danger">
        <p><?= $error?></p>
    </div>
    <?php } unset($_SESSION['errors']); ?>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">index</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($numbers as $number) { ?>

                <tr>
                    <div class="row">
                        <td><?= $index ?></td>
                        <td><?= $number['name'] ?></td>
                        <td><?= $number['num'] ?></td>


                        <td>
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $number['id'] ?>"></i>
                            <a href="../Back/numbersController.php?id=<?= $number['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>

                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="editExampleModal<?= $number['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../Back/numbersController.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label> Name</label>
                                                        <input type="text" name="name" value="<?= $number['name'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Number</label>
                                                        <input type="number" name="num" value="<?= $number['num'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                               
                                               

                                                
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label></label>
                                                        <input type="hidden" value="<?= $number['id'] ?>" name='id' class="form-control">
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