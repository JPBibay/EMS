<?php
include 'conn.php';

// Create
if (isset($_POST['addData'])) {
    $emID = $_POST['emID'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $age = $_POST['age'];
    $bday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $jtitle = $_POST['jobtitle'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        $filename = basename($_FILES['image']['name']);
        $uniqueFilename = time() . '_' . $filename;
        $uploadPath = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $image = $uniqueFilename;
        } else {
            $msg = "Failed to upload image";
            header("Location: index.php?msg=$msg");
            exit;
        }
    } else {
        $image = '';
    }

    $insert = $conn->prepare("INSERT INTO employees(user_id,e_fname,e_lname,age,birthday,gender,contact,address,jobtitle,image) VALUES(?,?,?,?,?,?,?,?,?,?)");

    $insert->execute([
        $emID,
        $fname,
        $lname,
        $age,
        $bday,
        $gender,
        $contact,
        $address,
        $jtitle,
        $image
    ]);

    $msg = "Data inserted";
    header("Location: index.php?msg=$msg");
}


// Update
if (isset($_POST['editData'])) {
    $emID = $_POST['emID'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $age = $_POST['age'];
    $bday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $jtitle = $_POST['jobtitle'];

    if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        $filename = basename($_FILES['newImage']['name']);
        $uniqueFilename = time() . '_' . $filename;
        $uploadPath = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($_FILES['newImage']['tmp_name'], $uploadPath)) {
            $image = $uniqueFilename;
        } else {
            $msg = "Failed to upload new image";
            header("Location: index.php?msg=$msg");
            exit;
        }
    } else {
        $image = $_POST['existingImage'] ?? '';
    }

    $update = $conn->prepare("UPDATE employees SET e_fname = ?, e_lname = ?, age = ?, birthday = ?, gender = ?, contact = ?, address = ?, jobtitle = ?, image = ? WHERE e_id = ?");
    $update->execute([
        $fname,
        $lname,
        $age,
        $bday,
        $gender,
        $contact,
        $address,
        $jtitle,
        $image,
        $emID
    ]);

    $msg = "Data Updated!";
    header("Location: index.php?&msg=$msg");
}

// delete
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $delete = $conn->prepare("DELETE FROM employees WHERE e_id = ?");
    $delete->execute([$id]);

    $msg = "Data Deleted!";
    header("Location: index.php?msg=$msg");
}



// register a user
if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 == $pass2) {
        $hash = password_hash($pass1, PASSWORD_DEFAULT);
        $addUser = $conn->prepare("INSERT INTO users(user_fname, user_lname, user_email, user_pass) VALUES(?, ?, ?, ?)");
        $addUser->execute([
            $fname,
            $lname,
            $email,
            $hash,
        ]);

        // Fetch the ID of the newly inserted user
        $newUserId = $conn->lastInsertId();

        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['u_id'] = $newUserId; // Use the fetched user ID

        header("Location: welcome.php");
        exit;
    } else {
        $msg = "Password do not match!";
        header("Location: register.php?msg=$msg");
        exit;
    }
}


//login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $check->execute([$email]);

    $data = $check->fetch();

    if ($data && password_verify($password, $data['user_pass'])) {
        session_start();
        $_SESSION['logged_in'] = true;
        $_SESSION['u_id'] = $data['user_id'];

        header("Location: welcome.php");
        exit;
    } else {
        $msg = "Email or Password do not match!";
        header("Location: login.php?msg=$msg");
        exit;
    }
}


// logout
if(isset($_GET['logout'])){
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['u_id']);

    header("Location: login.php");
}