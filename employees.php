<?php
include 'process.php';
include 'header.php';
if (!isset($_SESSION['logged_in'])) {
   header("Location: login.php");
   ob_end_flush();
}
?>

<!--search-->
<div class="row mt-2 p-2 justify-content-center">
   <div class="col me-4 ms-4" align="right">
      <form class="d-flex w-50" role="search" method="post">
         <input class="form-control me-2" type="search" name="search" placeholder="Search for Something"
            aria-label="Search">
         <button class="btn btn-outline-primary active" name="submit">Search</button>
      </form>
   </div>
</div>

<?php
$emID = $_SESSION['u_id'];
$cnt = 1;

if (isset($_POST['submit'])) {
   $cnt = 1;
   $search = $_POST['search'];
   $select = $conn->prepare("SELECT * FROM employees WHERE user_id=? AND (e_fname LIKE ? OR e_lname LIKE ? OR age LIKE ? OR birthday LIKE ? OR gender LIKE ? OR address LIKE ? OR jobtitle = ?)");
   $select->execute([$emID, "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%", "%$search%"]);
} else {
   $emID = $_SESSION['u_id'];

   $start = 0;
   $rows_per_page = 5;

   $n_of_rows = $conn->query("SELECT COUNT(*) as total FROM employees WHERE user_id=$emID")->fetchColumn();
   $pages = ceil($n_of_rows / $rows_per_page);

   if (isset($_GET['page-num'])) {
      $page = $_GET['page-num'] - 1;
      $start = $page * $rows_per_page;
      $cnt = $start + 1;
   }

   $select = $conn->prepare("SELECT * FROM employees WHERE user_id=? LIMIT $start, $rows_per_page");
   $select->execute([$emID]);
}
?>

<!--Employees-->
<div class="row mt-2 p-2 justify-content-center">
   <div class="col me-4 ms-4">

      <?php if (isset($_GET['msg'])) { ?>

         <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <center>
               <strong>
                  <?php echo $_GET['msg'] ?>
               </strong>
            </center>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>

      <?php } ?>

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

               <?php

               foreach ($select as $value) {

                  ?>
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
                        <a href="index.php?view&id=<?= $value['e_id'] ?>" class="text-decoration-none">👁‍🗨</a>|
                        <a href="index.php?edit&id=<?= $value['e_id'] ?>" class="text-decoration-none">🖊</a>|
                        <a href="employees.php?delete&id=<?= $value['e_id'] ?>" class="text-decoration-none">❌</a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>


         <div class="d-flex justify-content-between align-items-center" style="height: 3%;">
            <?php
            if (!isset($_POST['submit'])) {
               ?>
               <nav aria-label="Page navigation example">
                  <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="?page-num=1">First</a></li>
                     <?php if (isset($_GET['page-num']) && $_GET['page-num'] > 1) { ?>
                        <li class="page-item"><a class="page-link"
                              href="?page-num=<?php echo $_GET['page-num'] - 1 ?>">Previous</a></li>
                     <?php } ?>

                     <?php for ($i = 1; $i <= $pages; $i++) { ?>
                        <li class="page-item"><a class="page-link" href="?page-num=<?= $i ?>">
                              <?php echo $i ?>
                           </a></li>
                     <?php } ?>

                     <?php if (isset($_GET['page-num']) && $_GET['page-num'] < $pages) { ?>
                        <li class="page-item"><a class="page-link"
                              href="?page-num=<?php echo $_GET['page-num'] + 1 ?>">Next</a></li>
                     <?php } ?>
                     <li class="page-item"><a class="page-link" href="?page-num=<?= $pages ?>">Last</a></li>
                  </ul>
               </nav>
            <?php } ?>
            <a class="btn btn-primary" align="right" href="employees.php">Back</a>
         </div>
      </div>
   </div>
</div>
</body>

</html>