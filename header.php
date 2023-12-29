<?php
ob_start();
session_start();
include 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emloyee Monitoring System</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url("images/img10.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container-fluid ">
        <!-- navbar start -->
        <nav class="navbar bg-dark border-bottom border-body navbar-expand-lg card-header bg-transparent"
            data-bs-theme="dark">


            <div class="container-fluid">
                <div class="navbar-brand"><img src="images/img1.png" alt=""
                        style="width: 70px; height: 50px; border-radius: 50%;">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size:100%;">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Manage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?employees">Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?about">About</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php

                            if (isset($_SESSION['logged_in'])) { ?>
                                <a href="process.php?logout" class="nav-link btn btn-primary">Logout</a>
                            <?php } else { ?>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div>
                                        <a href="login.php" class="nav-link btn btn-light">Login</a>
                                    </div>
                                    <div>
                                        <a href="register.php" type="submit" class=" nav-link btn btn-light">Register</a>
                                    </div>
                                </div>

                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- navbar end -->