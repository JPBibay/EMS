<?php
include 'header.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    ob_end_flush();
}
?>

<style>
    body {
        background-image: url("images/img10.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
</style>

<body>


    <?php
    if (!isset($_GET['view'])) { ?>

        <div class="row justify-content-center">
            <div class="col-md-5 mt-5 p-3">
                <div class="card shadow pb-3" style="border: solid 4px skyblue;">

                    <?php if (isset($_GET['msg'])) { ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>
                                <?php echo $_GET['msg'] ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php } ?>

                    <?php
                    if (isset($_GET['edit'])) {

                        $id = $_GET['id'];
                        $selectData = $conn->prepare("SELECT * FROM employees WHERE e_id = ?");
                        $selectData->execute([$id]);

                        foreach ($selectData as $data) { ?>

                            <form action="process.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="emID" value="<?= $data['e_id'] ?>">
                                <div class="d-flex mt-5 justify-content-around">
                                    <div class="mt-1 w-40">
                                        <label class="form-label" for="fname">Firstname</label>
                                        <input type="text" class="form-control mb-3" id="fname" name="firstname"
                                            value="<?= $data['e_fname'] ?>">
                                    </div>
                                    <div class="mt-1 w-40">
                                        <label class="form-label" for="lname">Lastname</label>
                                        <input type="text" class="form-control mb-3" id="lname" name="lastname"
                                            value="<?= $data['e_lname'] ?>">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="mt-1">
                                        <label class="form-label" for="Bday">Birthday</label>
                                        <input type="date" class="form-control mb-3" id="Bday" name="birthday"
                                            onchange="calculateAge()" value="<?= $data['birthday'] ?>">
                                    </div>
                                    <div class="mt-1 ms-5 w-40">
                                        <label class="form-label" for="age">Age</label>
                                        <input type="number" class="form-control mb-3" id="age" name="age"
                                            value="<?= $data['age'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <div class="w-40">
                                        <label class="form-label" for="gender">Gender</label>
                                        <input type="text" class="form-control mb-3" id="gender" name="gender"
                                            value="<?= $data['gender'] ?>">
                                    </div>
                                    <div class="w-40">
                                        <label class="form-label" for="contact">Contact No.</label>
                                        <input type="text" class="form-control mb-3" id="contact" name="contact"
                                            value="<?= $data['contact'] ?>">
                                    </div>
                                </div>
                                <div class="mb-3 me-5 ms-5">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" class="form-control mb-3" id="address" name="address"
                                        value="<?= $data['address'] ?>">
                                </div>
                                <div class="mb-3 me-5 ms-5">
                                    <label class="form-label" for="jtitle">Job Title</label>
                                    <input type="text" class="form-control mb-3" id="jtitle" name="jobtitle"
                                        value="<?= $data['jobtitle'] ?>">
                                </div>
                                <div class="mb-3 me-5 ms-5">
                                    <label class="form-label" for="image">Choose an image</label>
                                    <input type="file" class="form-control mb-3" name="newImage" id="image">
                                    <input type="hidden" name="existingImage" value="<?= $data['image'] ?>">

                                    <img src="images/<?= $data['image'] ?>" style="width:30%; height:30%;" alt="Current Image">
                                </div>
                                <div class="d-flex me-5 ms-5 justify-content-between">
                                    <div class="mb-3">
                                        <button class="btn btn-primary " type="submit" name="editData">Update</button>
                                    </div>
                                    <div class="mb-3">
                                        <a class="btn btn-warning" href='javascript:history.go(-1)'>Back</a>
                                    </div>
                                </div>
                            </form>
                        <?php }
                    } else { ?>

                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="emID" value="<?= $_SESSION['u_id'] ?>">
                            <div class="d-flex mt-5 justify-content-around">
                                <div class="mt-1">
                                    <label class="form-label" for="fname">Firstname</label>
                                    <input type="text" class="form-control mb-3" id="fname" name="firstname">
                                </div>
                                <div class="mt-1 ">
                                    <label class="form-label" for="lname">Lastname</label>
                                    <input type="text" class="form-control mb-3" id="lname" name="lastname">
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="mt-1">
                                    <label class="form-label" for="Bday">Birthday</label>
                                    <input type="date" class="form-control mb-3" id="Bday" name="birthday"
                                        onchange="calculateAge()">
                                </div>
                                <div class="mt-1 ms-5 w-40">
                                    <label class="form-label" for="age">Age</label>
                                    <input type="number" class="form-control mb-3" id="age" name="age" readonly>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around">
                                <div class="w-40">
                                    <label class="form-label" for="gender">Gender</label>
                                    <input type="text" class="form-control mb-3" id="gender" name="gender">
                                </div>
                                <div class="w-40">
                                    <label class="form-label" for="contact">Contact No.</label>
                                    <input type="text" class="form-control mb-3" id="contact" name="contact">
                                </div>
                            </div>
                            <div class="mb-3 me-5 ms-5">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control mb-3" id="address" name="address">
                            </div>
                            <div class="mb-3 me-5 ms-5">
                                <label class="form-label" for="jtitle">Job Title</label>
                                <input type="text" class="form-control mb-3" id="jtitle" name="jobtitle" required>
                            </div>
                            <div class="mb-3 me-5 ms-5">
                                <label class="form-label" for="image">Choose an image:</label>
                                <input type="file" class="form-control mb-3" name="image" id="image" accept="image/*" required>
                            </div>
                            <div class="mb-3 ms-5">
                                <button class="btn btn-success" type="submit" name="addData">Add</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php
    } else { ?>
        <style>
            .background-container {
                background-image: url('images/img.jpg');
                background-size: cover;
                background-position: center center;
                background-attachment: fixed;

            }

            .card {
                background-color: rgba(255, 255, 255, 0.7);
            }
        </style>

        <?php
        $id = $_GET['id'];
        $selectData = $conn->prepare("SELECT * FROM employees WHERE e_id = ?");
        $selectData->execute([$id]);

        foreach ($selectData as $data) {
            ?>
            <div class="background-container">
                <div class="row mt-4 justify-content-center">
                    <div class="col-sm-10" style="width: 47%;">
                        <div class="card shadow m-5">
                            <center>
                                <div class="mt-4" style="width:50%; height: 250px; border:solid black 2px;">
                                    <img src="images/<?= $data['image'] ?>" style="height:100%;" class="card-img-top">
                                </div>
                            </center>
                            <div class="card-body">
                                <h4 class="card-title" align="middle">
                                    <?= $data['e_fname'] ?>
                                    <?= $data['e_lname'] ?>
                                </h4>
                                <p class="card-text"><strong>Job Title: </strong>
                                    <?= $data['jobtitle'] ?>
                                </p>
                                <div class="d-flex">
                                    <div class="w-50 mb-3">
                                        <p class="card-text"><strong>Age: </strong>
                                            <?= $data['age'] ?>
                                        </p>
                                    </div class="w-50">
                                    <div>
                                        <p class="card-text"><strong>Contact: </strong>
                                            <?= $data['contact'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="w-50 mb-3">
                                        <p class="card-text"><strong>Birthday: </strong>
                                            <?= $data['birthday'] ?>
                                        </p>
                                    </div>
                                    <div class="w-50">
                                        <p class="card-text"><strong>Gender: </strong>
                                            <?= $data['gender'] ?>
                                        </p>
                                    </div>
                                </div>
                                <p class="card-text"><strong>Address: </strong>
                                    <?= $data['address'] ?>
                                </p>
                                <div class="d-flex justify-content-between ms-5 me-5">
                                    <a href="index.php?edit&id=<?= $data['e_id'] ?>" class="btn btn-success">🖊</a>
                                    <a class="btn btn-primary" href='javascript:history.go(-1)'>Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
        }
    } ?>

        <script>
            function calculateAge() {
                var dob = new Date(document.getElementById('Bday').value);
                var today = new Date();

                var age = today.getFullYear() - dob.getFullYear();

                // Adjust age if birthday hasn't occurred yet this year
                if (today.getMonth() < dob.getMonth() || (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                    age--;
                }

                document.getElementById('age').value = age;
            }
        </script>

</body>

</html>