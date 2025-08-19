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


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    &nbsp;
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-2 text-gray-800">ตารางแสดงข้อมูลสนาม</h1>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm "data-bs-toggle='modal' href="stadium_create.php" data-bs-target='#Modal-manage-user-insert'><i
                                class="fas fa-plus fa-sm text-white-50"></i> เพิ่มข้อมูล</a></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>ชื่อสนาม</th>
                                            <th>ราคา / ชั่วโมง</th>
                                            <th>จำนวนการใช้งาน</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>ชื่อสนาม</th>
                                            <th>ราคา / ชั่วโมง</th>
                                            <th>จำนวนการใช้งาน</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> </td>
                                    <?php 
                    $total_all_usage = 0; // กำหนดตัวแปรเพื่อเก็บผลรวมของการใช้งานสนามทั้งหมด
                    $status_name = $mysqli->query("SELECT * FROM stadium "); // ค้นหาข้อมูลสนามแต่ละสนาม
                    // ประกาศฟังก์ชันนอกลูป while
                    function countTotalUsage($mysqli, $id) {
                        $count_total = 0;
                        $result_total2 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '$id' "); // ค้นหาข้อมูลในตารางการจอง โดยตรวจสอบว่ามีค่าเท่ากับ id หรือไม่
                        while ($row3 = $result_total2->fetch_array()) { 
                            $count_total++; // เป็นการนับ + 1 เก็บไว้ในตัวแปร เมื่อพบเจอค่าตามเงื่อนไข
                        }
                        return $count_total;
                    }
                    while ($row = $status_name->fetch_array()) {
                        $id = $row["id"]; // id เป็นตัวแปล เก็บค่า id ของแต่สนามเพื่อนำไปนับจำนวนการใช้งานใน ตารางของการจอง booking
                        // เริ่มต้นการรวมจำนวนการใช้งาน
                        // ใช้งานฟังก์ชันเพื่อรวมการใช้งานสนามทั้งหมด
                        $total_usage = countTotalUsage($mysqli, $id);
                        $total_all_usage += $total_usage; // เพิ่มจำนวนการใช้งานสนามของสนามนี้เข้าไปในผลรวมทั้งหมด

                        // ส่วนของการแสดงผลข้อมูลในตาราง
                        echo '<tr data-key="1">
                                <td><center><img src="' . $row["image"] . '" width="100"></center></td>
                                <td>' . $row["name"] . '</td>
                                <td><center>' . $row["price"] . '</center></td>
                                <td><center>' .  $total_usage . '</center></td>
                            </tr>';
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
                        <span aria-hidden="true">×</span>
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