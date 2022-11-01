<?php
include '../Back/header.php';
include '../Back/portifolio2CategoryControllrt.php';

$categories = new portifolio2CategoryControllrt();
$categories = $categories->index()->fetchAll();
/* echo "<pre>";
print_r($categories);
echo "<pre>"; */
$index = 1;
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
                    <li class="breadcrumb-item active">General Form</li>
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

    <div class="card-body">
        <form action="../Back/portifolio2CategoryControllrt.php" method="POST" class="mb-5">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <input type="text" name="name" value="" class="form-control" placeholder="Enter Caetgory ...">
                    </div>
                </div>
                <div class="col-md-4 ">
                    <input class="btn btn-primary w-50 " name="add" type="submit" value="Add">
                </div>
            </div>

        </form>
        <h4>portifolio Categories list</h4>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">index</th>
                    <th scope="col">Name</th>
                    <th scope="col">update </th>
                    <th scope="col">Delete</th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>
                            <a href="../Back/portifolio2CategoryControllrt.php?id=<?= $category['id'] ?>"> <i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>
                        </td>
                        <td>
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $category['id'] ?>"></i>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button> -->

                            <!-- Modal -->
                            <div class="modal fade" id="editExampleModal<?= $category['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../Back/portifolio2CategoryControllrt.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6 ">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label> Slug</label>
                                                        <input type="text" name="name" value="<?= $category['name'] ?>" class="form-control" placeholder="Enter ...">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 mt-3">
                                                    <input type="hidden" name="category_id" value="<?=$category ['id']?>" />
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
include '../Back/footer.php';
?>