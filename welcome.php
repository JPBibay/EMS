<?php include 'header.php';
if (!isset($_SESSION['logged_in'])) {
   header("Location: login.php");
   ob_end_flush();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Welcome to Employee Monitoring System</title>

   <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <style>
      body {
         background-image: url("images/img14.png");
         background-repeat: no-repeat;
         background-attachment: fixed;
         background-position: center;
         background-size: cover;
      }

      .text {
         color: #f8f8ff;
      }

      h1 {
         font-size: 3%;
         font-family: serif;
      }

      .width {
         width: 60%;
      }

      p {
         font-size: 50px;
         font-family: Comic Sans MS;
         color: darkgrey;
      }

      .button {
         width: 20%;
         height: 5%;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-md-8 offset-md-1 text-start mt-5 width">
            <div class="text">
               <h1 class="display-2 mt-5 "><strong>Welcome to Employee Monitoring System</strong></h1>
               <p class="lead mb-5">Efficiently manage and monitor your workforce with our employee monitoring
                  tools.</p>
            </div>
            <div class="mt-5 pt-5 button">
               <a href="index.php" class="btn btn-primary btn-lg">Get Started</a>
            </div>
         </div>
      </div>
   </div>
</body>

</html>