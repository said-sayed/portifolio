<?php

include '../Back/header.php';
include '../Back/SkillCatrgoryController.php';

$categorySkill = new SkillCatrgoryController();

$categories = $categorySkill->index()->fetchAll();

$index =1;

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
        <form action="../Back/SkillCatrgoryController.php" method="POST" class="mb-5">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col md-3 ml-5">
                

                <button class="btn btn-warning mt-4" type="submit" name="addCategory">Add</button>

                </div>
               
            </div>
        </form>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($categories as $category) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $index ?></th>
                        <td><?php echo $category['name'] ?></td>


                        <td>
                            <!-- Button trigger modal -->
                            <i class="fas fa-edit fa-2x text-warning mr-3" data-toggle="modal" data-target="#editExampleModal<?php echo $category['id'] ?>"></i>
                            <a href="../Back/SkillCatrgoryController.php?id=<?php echo $category['id'] ?>"><i class="fas fa-trash text-danger fa-2x" data-toggle="modal" data-target="#deleteExampleModal"></i></a>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="editExampleModal<?php echo $category['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../Back/SkillCatrgoryController.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Cstegory</label>
                                                            <input type="text" name="name" value="<?php echo $category['name'] ?>" class="form-control" placeholder="Enter ...">
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id" value="<?php echo $category['id']?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning" name="update">Update</button>
                                                </div>
                                            </form>
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