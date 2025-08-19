<?php 
session_start();
include 'slide.php';
        include 'db.php';
        
        
        // ตรวจสอบว่า session มีค่า user_role และมีค่าเป็น 'admin' หรือไม่
if (isset($_SESSION['type']) && $_SESSION['type'] == '1') {
    // กระบวนการทำงานของ admin ที่นี่
} else {
    // ถ้าไม่ใช่ admin ให้โยงไปยังหน้าอื่น
    header('Location: logout.php');
    exit();
}
        ?>

<div class="container-fluid">
                    &nbsp;
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-2 text-black-800">ตารางรายได้ทั้งหมด</h1>
                        <form id="hid" method="get" id="form" enctype="multipart/form-tb_register" action="" class="text-center" >
      <strong style="">ค้นหาข้อมูล วัน</strong>
    
    <select id="country" name="day" >
	  <option value="">ทั้งหมด</option>
      <option value="-01">1</option>
      <option value="-02">2</option>
      <option value="-03">3</option>
	  <option value="-04">4</option>
	  <option value="-05">5</option>
	  <option value="-06">6</option>
	  <option value="-07">7</option>
	  <option value="-08">8</option>
	  <option value="-09">9</option>
	  <option value="-10">10</option>
	  <option value="-11">11</option>
	  <option value="-12">12</option>
      <option value="-13">13</option>
      <option value="-14">14</option>
      <option value="-15">15</option>
	  <option value="-16">16</option>
	  <option value="-17">17</option>
	  <option value="-18">18</option>
	  <option value="-19">19</option>
	  <option value="-20">20</option>
	  <option value="-21">21</option>
	  <option value="-22">22</option>
	  <option value="-23">23</option>
	  <option value="-24">24</option>
      <option value="-25">25</option>
	  <option value="-26">26</option>
	  <option value="-27">27</option>
	  <option value="-28">28</option>
	  <option value="-29">29</option>
	  <option value="-30">30</option>
      <option value="-31">31</option>

      </select>
      <strong style="">เดือน</strong>
      <select id="country" name="mount">
	  <option value="">ทั้งหมด</option>
      <option value="-01-">มกราคม</option>
      <option value="-02-">กุมภาพันธ์</option>
      <option value="-03-">มีนาคม</option>
	  <option value="-04-">เมษายน </option>
	  <option value="-05-">พฤษภาคม</option>
	  <option value="-06-">มิถุนายน</option>
	  <option value="-07-">กรกฎาคม</option>
	  <option value="-08-">สิงหาคม</option>
	  <option value="-09-">กันยายน</option>
	  <option value="-10-">ตุลาคม</option>
	  <option value="-11-">พฤศจิกายน</option>
	  <option value="-12-">ธันวาคม</option>
     
    </select>
    <strong style="">ปี</strong>
    <select id="country" name="year">
	  <option  value="">ทั้งหมด</option>
      <option  value="2025">2568</option>
      <option  value="2024">2567</option>
      <option  value="2023">2566</option>   
      <option  value="2022">2565</option>
    </select>
    <button class="btn btn-primary " type="submit" value="ค้นหา">ค้นหา</button>
    <?php $year=isset($_GET['year']) ? $_GET['year']:'' ?>
<?php $mount=isset($_GET['mount']) ? $_GET['mount']:'' ?>
<?php $day=isset($_GET['day']) ? $_GET['day']:'' ?>
<?php $search = $year.''.$mount.''.$day;

    
?>

    <br><br>
                                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "data-bs-toggle='modal' href="print_report.php" data-bs-target='#Modal-manage-user-insert'><i
                                class="fas fa-plus fa-sm text-white-50"></i> พิมพ์รายงาน</a></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>ชื่อสนาม</th>
                                            <th>รายได้ทั้งหมด</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody >
                                    <?php
$price_total = 0;
$price_all = array();
$count = 1;
$total = 0;
$_SESSION['price'] = 0;

$stadium = $mysqli->query("SELECT * FROM stadium ");

while ($row = $stadium->fetch_array()) {
    $id = $row["id"];

    $price = $mysqli->query("SELECT price FROM booking WHERE stadium_id = '$id' AND date_start LIKE '%$search%' ");
    while ($rows = $price->fetch_array()) {
        $total = $total + $rows["price"];
    }
    $price_all[$count] = $total;
    $total = 0;
    $_SESSION['price'] = $_SESSION['price'] + $price_all[$count];
?>
<tr style="tect-center">
    <td><img src="<?= $row["image"] ?>" width="200"></td>
    <td><?= $row["name"] ?></td>
    <td><?php echo $price_all[$count]; ?></td>
</tr>
<?php 
    $count++;
} 
?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×asdasdasd</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>