<?php include 'header.php';
if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    ob_end_flush();
}
?>

<div class="row justify-content-center">
    <div class="col-md-4 mt-5">
        <?php if (isset($_GET['msg'])) { ?>

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>
                    <?php echo $_GET['msg'] ?>
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php } ?>
        <form action="process.php" method="post" class="shadow p-3">
            <center>
                <h3><strong style="color:white;">Login</strong></h3>
            </center>
            <div class="mt-4 mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary mt-4" style="width:100%;" name="login">Login</button>
            </div>
            <center>
                <p>Don't have an account?<a href="register.php" type="submit" class="">Register</a></p>
            </center>
        </form>
    </div>
</div>
</body>

</html>