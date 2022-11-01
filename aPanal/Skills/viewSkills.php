<?php

include '../Back/header.php';
include '../Back/SkillsController.php';
include '../Back/SkillCatrgoryController.php';

$index = 1;

$skillCategories = new SkillCatrgoryController();
$categories = $skillCategories->index()->fetchAll();

$mySkill = new SkillsController();
$skills = $mySkill->index()->fetchAll();

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
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">prograss</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($skills as $skill) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $index ?></th>
                        <td><?php echo $skill['name'] ?></td>
                        <td><?php echo $skill['progress'] ?>%
                            <div class="progress" style="height:6px;width:100px">
                                <div class="progress-bar " style="width:<?php echo $skill['progress'] ?>%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?php echo $skill['id'] ?>"></i>
                            <a href="../Back/SkillsController.php?id=<?php echo $skill['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="editExampleModal<?php echo $skill['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../Back/SkillsController.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Skill</label>
                                                            <input type="text" name="name" value="<?php echo $skill['name'] ?>" class="form-control" placeholder="Enter ...">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Progress</label>
                                                            <input type="number" name="progress" value="<?php echo $skill['progress'] ?>" class="form-control" placeholder="Enter ...">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select class="form-control" name="category_id">
                                                                <?php
                                                                foreach ($categories as $category) { 
                                                                    if($category['id'] == $skill['category_id']) {?>
                                                                    <option selected value="<?php echo $category['id'] ?>">
                                                                        <?php echo $category['name'] ?>
                                                                    </option>
                                                                <?php } else {?>
                                                                    <option value="<?php echo $category['id'] ?>">
                                                                        <?php echo $category['name'] ?>
                                                                    </option>
                                                                <?php
                                                                }
                                                            
                                                            } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="<?php echo $skill['id']?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning" name="updateSkill">Update</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete-->
                            <div class="modal fade" id="deleteExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
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