<?php session_start();
include '../Back/header.php';
include '../Back/contDb.php';

print_r(isset($_SESSION['errors']))

?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3>Login</h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none">Back</a>
                </div>
            </div>
            <form method="POST" action="../Back/loginController.php">
                <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="alert alert-danger">
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>

                <?php endif; unset($_SESSION['errors']); ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>
        </div>
    </div>
</div>

<?php require('../Back/footer.php'); ?>