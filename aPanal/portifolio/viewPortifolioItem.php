<?php
ob_start();
session_start();
include '../Back/header.php';
include '../Back/PortifolioCategoryController.php';
include '../Back/PortifolioItemController.php';

$Categories = new PortifolioCategoryController();
$Categories = $Categories->index()->fetchAll();

$items = new PortifolioItemController();
if (isset($_GET['Id'])) {
    $category_id = $_GET['Id'];
    $items = $items->index($category_id)->fetchAll();
    
} else {
    //default id
    $category_id = 1;
    $items = $items->index($category_id)->fetchAll();
}



/* echo "<pre>";
print_r($Categories);
echo "</pre>";

echo "<pre>";
print_r($items);
echo "</pre>"; */
$index = 1;






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

    <div class="btn-toolbar m-auto py-5" role="toolbar" aria-label="Toolbar with button groups">
        <?php foreach ($Categories as $category) { ?>
            <div class="btn-group mx-2" role="group" aria-label="Third group">
                <a href="../Back/PortifolioItemController.php?id=<?= $category['id'] ?>"><input type="submit" class="btn btn-secondary" value="<?= $category['name'] ?>"></a>
            </div>
        <?php } ?>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">index</th>
                <th scope="col">Slug</th>
                <th scope="col">image Name</th>
                <th scope="col">desc</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) { ?>
                <tr>

                    <td><?= $index ?></td>
                    <td>
                        <h6><?= $item['slug'] ?></h6>
                    </td>
                    <td>
                        <h6><?= $item['image'] ?></h6>
                    </td>
                    <td>
                        <h6><?= $item['desc'] ?></h6>
                    </td>

                    <td>
                        <form method="post" action="../Back/PortifolioItemController.php">
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?= $item['id'] ?>"></i>
                            <button type="submit" name="delete" class="btn"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></button>
                            <input type="hidden" name="itemID" value="<?= $item['0'] ?>">
                            <input type="hidden" name="categoryID" value="<?= $category_id ?>">
                        </form>
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
                                    <form action="../Back/PortifolioItemController.php?idCategory=<?= $category_id ?>" method="POST" enctype="multipart/form-data">
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
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Category Name</label>
                                                    <select class="form-control" name="category_id">
                                                        <?php foreach ($Categories as $category) :
                                                            if ($category['id'] == $item['category_id']) { ?>
                                                                <option selected value="<?= $category['id'] ?>">
                                                                    <?= $category['name'] ?>
                                                                </option>
                                                            <?php } else { ?>
                                                                <option value="<?= $category['id'] ?>">
                                                                    <?= $category['name'] ?>
                                                                </option>
                                                        <?php }
                                                        endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" name="id" value="<?= $item['0'] ?>" />
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
            <?php $index++;
            } ?>


        </tbody>
    </table>


</div> -->


</div>
<?php include '../Back/footer.php' ?>