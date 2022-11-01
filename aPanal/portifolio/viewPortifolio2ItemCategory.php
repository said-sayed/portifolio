<?php
include '../Back/Portifolio2ItemCategoryController.php';
include '../Back/header.php';
include '../Back/portifolio2CategoryControllrt.php';

$categories = new portifolio2CategoryControllrt();
$categories = $categories->index()->fetchAll();

$item_category = new Portifolio2ItemCategoryController();
$categorys=[];
if (isset($_GET['id'])) {
    $itemID = $_GET['id'];
    $categorysID = $item_category->selectCategoryID($itemID)->fetchAll();
    for ($i = 0; $i < count($categorysID); $i++) {
        $categorys[] = $item_category->selectCategoryName($categorysID[$i]['category_id'])->fetch();
    }
    /* echo "<pre>";
    print_r($categorys);
    echo "<pre>"; */
}
/* echo "<pre>";
print_r($categorysID);
echo "<pre>"; */
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

    <form action="../Back/Portifolio2ItemCategoryController.php?id=<?= $itemID ?>" method="POST" enctype="multipart/form-data">

        <div class="row mt-5">
            <div class="col-md-6 ">
                <select class="form-control" name="select">
                    <?php foreach ($categories as $category) { ?>
                        <option selected hidden> please choose ....</option>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- <button class="btn btn-warning" type="submit" name="update">Update</button> -->
            <div class="modal-footer p-0 ml-4">
                <button class="btn btn-primary" type="submit" name="add">add Category</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">index</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>

            
            <?php foreach ($categorys as $category) { ?>
                <tr>

                    <td><?= $index ?></td>
                    <td><?= $category['name']?></td>

                    <td><a href="../Back/Portifolio2ItemCategoryController.php?categoryID=<?= $category['id']?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></td></a>

                </tr>
            <?php $index++;
            } ?>


        </tbody>
    </table>





</div>

</div>
<?php
include '../Back/footer.php';

?>