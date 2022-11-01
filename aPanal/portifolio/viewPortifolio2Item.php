<?php

session_start();
include '../Back/header.php';
include '../Back/portifolio2itemController.php';
$items = new Portifolio2ItemController();
$items = $items->index()->fetchAll();


$index = 1;
/* echo "<pre>";
print_r($items);
echo "<pre>"; */


// <img src="../../Images/<?= $items->moveImage()" alt="">

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Items</h1>
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
        <h3 class="card-title">Your Items</h3>
    </div>




    <table class="table">
        <thead>
            <tr>
                <th scope="col">index</th>
                <th scope="col">Slug</th>
                <th scope="col">image </th>
                <th scope="col">desc</th>
                <th scope="col">CAtegory Types</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) { ?>

                <tr>

                    <td><?= $index ?></td>
                    <td>
                        <?= $item['slug'] ?>
                    </td>
                    <td>
                        <div style="width:50px">
                            <img src="../../Images/<?= $item['image'] ?>" class="w-100 " alt="">
                        </div>
                    </td>
                    <td>
                        <?= $item['desc'] ?>
                    </td>
                    <td>
                        <a href="../portifolio/viewPortifolio2ItemCategory.php?id=<?= $item['id'] ?>">
                            <i class="fas fa-sign-in-alt fa-2x text-success ml-5 "></i>
                        </a>
                    </td>

                    <td>
                        <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $item['id'] ?>"></i>
                        <a href="../Back/portifolio2itemController.php?id=<?= $item['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button> -->

                        <!-- Modal -->
                        <div class="modal fade" id="editExampleModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="../Back/portifolio2itemController.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label> Slug</label>
                                                    <input type="text" name="slug" value="<?= $item['slug'] ?>" class="form-control" placeholder="Enter ...">
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>desc</label>
                                                    <input type="text" name="desc" value="<?= $item['desc'] ?>" class="form-control" placeholder="Enter ...">
                                                </div>
                                            </div>


                                        </div>
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>" />
                                        <!-- <button class="btn btn-warning" type="submit" name="update">Update</button> -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit" name="update">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </td>

                </tr>
            <?php } ?>



        </tbody>
    </table>


</div>


</div>
<?php include '../Back/footer.php' ?>