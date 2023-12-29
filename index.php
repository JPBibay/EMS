<?php include 'header.php';
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
    if (isset($_GET['about'])) { ?>

        <style>
            .container-main {
                width: 80%;
                background-color: #B2BEB5;
                padding: 50px;
                margin: auto;
                background-image: url("images/img13.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
            }

            .container {
                padding-top: 3%;
            }

            .imgcon {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                margin-top: 15px;
                font-family: verdana;
            }

            .img1,
            .img2,
            .img3 {
                width: 20%;
                margin: 5px 5px;
                box-sizing: border-box;
                text-align: center;
            }

            .img1 img,
            .img2 img,
            .img3 img {
                width: 60%;
                height: auto;
                border-radius: 50%;
                object-fit: cover;
                margin-top: 10px;
            }

            .footer {
                color: #a9a9a9;
                padding: 20px 0;
                text-align: center;
                margin-top: 10px;
                font-family: Monospace;
            }
        </style>

        <div class="container-main">
            <center>
                <h2><strong>ABOUT US</strong></h2><br>
                <hr>

                <div class="">
                    <p style="font-family:verdana">"In the ever-evolving terrain of contemporary workplaces,
                        effective employee monitoring is not about micromanagement but rather a strategic tool for fostering
                        growth and productivity. Our monitoring solutions prioritize transparency and collaboration,
                        aiming to empower teams with valuable insights that lead to informed decision-making."
                    </p>
                </div>
                <hr>
                <h5><span style="color:white; background-color:grey; font-family:Serif;">The Team</span></h5>
            </center>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="imgcon">
                        <div class="img1">
                            <strong>Paulyn Joy Bito-on</strong>
                            <img src="images/img6.jpg" alt="">
                        </div>
                        <div class="img2">
                            <strong>John Paul Bibay</strong>
                            <img src="images/img5.jpg" alt="">
                        </div>
                        <div class="img3">
                            <strong>Jaymar Cerna</strong>
                            <img src="images/img8.jpeg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p>Contact us:</p>
                <p>Email: example@example.com</p>
                <p>Contact Number: +1 123-456-7890</p>
            </div>
        </div>

        <?php
    } else { ?>



        <?php
        include 'process.php';
        if (isset($_GET['employees'])) { ?>

            <!--search-->
            <div class="container mt-4" align="right">
                <form class="d-flex w-50" role="search" method="post">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search for Something"
                        aria-label="Search">
                    <button class="btn btn-outline-primary active" name="submit">Search</button>
                </form>
            </div>

            <?php
            include 'process.php';
            $emID = $_SESSION['u_id'];
            $cnt = 1;

            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $select = $conn->prepare("SELECT * FROM employees WHERE user_id=? AND (e_fname LIKE ? OR e_lname LIKE ? OR age LIKE ? OR birthday LIKE ? OR gender LIKE ? OR address LIKE ? OR jobtitle = ?)");
                $select->execute([$emID, "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%"]);
            } else {
                $select = $conn->prepare("SELECT * FROM employees WHERE user_id=?");
                $select->execute([$emID]);
            }
            ?>

            <!--Employees-->
            <div class="row mt-4 justify-content-center">
                <div class="col me-4 ms-4">
                    <div class="table">
                        <table style="width:100%;" class="table shadow p-2 ">
                            <thead>
                                <th>#</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Job Title</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($select as $value) { ?>
                                    <tr>
                                        <td>
                                            <?= $cnt++ ?>
                                        </td>
                                        <td>
                                            <?= $value['e_fname'] ?>
                                        </td>
                                        <td>
                                            <?= $value['e_lname'] ?>
                                        </td>
                                        <td>
                                            <?= $value['jobtitle'] ?>
                                        </td>
                                        <td>
                                            <?= $value['gender'] ?>
                                        </td>
                                        <td>
                                            <?= $value['birthday'] ?>
                                        </td>
                                        <td>
                                            <?= $value['age'] ?>
                                        </td>
                                        <td>
                                            <?= $value['address'] ?>
                                        </td>
                                        <td>
                                            <?= $value['contact'] ?>
                                        </td>
                                        <td>
                                            <a href="index.php?view&id=<?= $value['e_id'] ?>"
                                                class="text-decoration-none">👁‍🗨</a>|
                                            <a href="index.php?edit&id=<?= $value['e_id'] ?>" class="text-decoration-none">🖊</a>|
                                            <a href="index.php?delete&id=<?= $value['e_id'] ?>" class="text-decoration-none">❌</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        
                    <a align="left" class="btn btn-primary" href='javascript:history.go(-1)'>Back</a>
                    </div>
                </div>
            </div>




        <?php } else { ?>

            <?php
            if (!isset($_GET['view'])) { ?>

                <div class="row justify-content-center">
                    <div class="col-md-5 mt-5 p-3">
                        <div class="card shadow pb-3" style="border: solid 4px skyblue;">

                            <?php 
                            if (isset($_GET['msg'])) { ?>

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
                                        <div class="d-flex mt-5">
                                            <div class="mt-1 me-5 ms-5">
                                                <label class="form-label" for="fname">Firstname</label>
                                                <input type="text" class="form-control mb-3" id="fname" name="firstname"
                                                    value="<?= $data['e_fname'] ?>">
                                            </div>
                                            <div class="mt-1 ms-5">
                                                <label class="form-label" for="lname">Lastname</label>
                                                <input type="text" class="form-control mb-3" id="lname" name="lastname"
                                                    value="<?= $data['e_lname'] ?>">
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="mt-1 me-5 ms-5">
                                                <label class="form-label" for="age">Age</label>
                                                <input type="number" class="form-control mb-3" id="age" name="age"
                                                    value="<?= $data['age'] ?>">
                                            </div>
                                            <div class="mt-1 ms-5">
                                                <label class="form-label" for="Bday">Birthday</label>
                                                <input type="date" class="form-control mb-3" id="Bday" name="birthday"
                                                    value="<?= $data['birthday'] ?>">
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="me-5 ms-5">
                                                <label class="form-label" for="gender">Gender</label>
                                                <input type="text" class="form-control mb-3" id="gender" name="gender"
                                                    value="<?= $data['gender'] ?>">
                                            </div>
                                            <div class="me-5 ms-5">
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
                                        <div class="mb-3 ms-5">
                                            <button class="btn btn-primary " type="submit" name="editData">Update</button>
                                        </div>
                                    </form>
                                <?php }
                            } else { ?>

                                <form action="process.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="emID" value="<?= $_SESSION['u_id'] ?>">
                                    <div class="d-flex mt-5">
                                        <div class="mt-1 me-5 ms-5">
                                            <label class="form-label" for="fname">Firstname</label>
                                            <input type="text" class="form-control mb-3" id="fname" name="firstname" required>
                                        </div>
                                        <div class="mt-1 ms-5">
                                            <label class="form-label" for="lname">Lastname</label>
                                            <input type="text" class="form-control mb-3" id="lname" name="lastname" required>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="mt-1 me-5 ms-5">
                                            <label class="form-label" for="age">Age</label>
                                            <input type="number" class="form-control mb-3" id="age" name="age">
                                        </div>
                                        <div class="mt-1 ms-5">
                                            <label class="form-label" for="Bday">Birthday</label>
                                            <input type="date" class="form-control mb-3" id="Bday" name="birthday">
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-5 ms-5">
                                            <label class="form-label" for="gender">Gender</label>
                                            <input type="text" class="form-control mb-3" id="gender" name="gender">
                                        </div>
                                        <div class="me-5 ms-5">
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
                                        <input type="text" class="form-control mb-3" id="jtitle" name="jobtitle">
                                    </div>
                                    <div class="mb-3 me-5 ms-5">
                                        <label class="form-label" for="image">Choose an image:</label>
                                        <input type="file" class="form-control mb-3" name="image" id="image" accept="image/*" required>
                                    </div>
                                    <div class="mb-3 ms-5">
                                        <button class="btn btn-primary" type="submit" name="addData">Add</button>
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
                                        <a class="btn btn-primary" href='javascript:history.go(-1)'>Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            <?php
                }
            } ?>

            <!--Dispay-->
            <div class="row mt-4 justify-content-center">
                <div class="col-sm-10">
                    <div class="table">
                        <table class="table shadow p-2">
                            <thead class="th">
                                <th>#</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Job Title</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                include 'process.php';
                                $emID = $_SESSION['u_id'];
                                $cnt = 1;
                                $select = $conn->prepare("SELECT*FROM employees WHERE user_id=?");
                                $select->execute([$emID]);
                                foreach ($select as $value) { ?>

                                    <tr>
                                        <td>
                                            <?= $cnt++ ?>
                                        </td>
                                        <td>
                                            <?= $value['e_fname'] ?>
                                        </td>
                                        <td>
                                            <?= $value['e_lname'] ?>
                                        </td>
                                        <td>
                                            <?= $value['jobtitle'] ?>
                                        </td>
                                        <td>
                                            <?= $value['contact'] ?>
                                        </td>
                                        <td>
                                            <a href="index.php?view&id=<?= $value['e_id'] ?>"
                                                class="text-decoration-none">👁‍🗨</a>|
                                            <a href="index.php?edit&id=<?= $value['e_id'] ?>" class="text-decoration-none">🖊</a>|
                                            <a href="index.php?delete&id=<?= $value['e_id'] ?>" class="text-decoration-none">❌</a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    <?php
        }
    } ?>

</body>

</html>