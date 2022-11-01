<?php

include '../Back/header.php';
include '../Back/SkillCatrgoryController.php';

$categorySkill = new SkillCatrgoryController();

$categories = $categorySkill->index()->fetchAll();

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
<div class="card card-secondary w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">Add Sill</h3>
    </div>




    <div class="card-body">
        <form action="../Back/SkillsController.php" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Skill</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Progress</label>
                        <input type="number" name="progress" value="" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="">
                            <?php foreach($categories as $category){?>
                                <option value="<?php echo $category['id']?>">
                                    <?php echo $category['name']?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="addSkill">submit</button>

            </div>

        </form>
    </div>
    <!-- /.card-body -->
</div>

<?php
include '../Back/footer.php';
?>