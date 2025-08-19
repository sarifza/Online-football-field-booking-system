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


if ($result = $mysqli->query("SELECT * FROM users")) {
    while ($row = $result->fetch_array()) {
        $id = $row['id'];
        $rows[] = $row;
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
                        <h1 class="h3 mb-2 text-gray-800">ตารางแสดงข้อมูลสมาชิก</h1>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm "data-bs-toggle='modal' href="add_users.php" data-bs-target='#Modal-manage-user-insert'><i
                                class="fas fa-plus fa-sm text-white-50"></i> เพิ่มข้อมูล</a></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>ประเภท</th>
                                            <th>email</th>
                                            <th class="action-column">setting</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
 <?php
foreach ($rows as $key => $value) {
$Rapprove = $mysqli->query("SELECT * FROM users_type where id='" . $value['users_type_id'] . "'");
$type = $Rapprove->fetch_array();
?>
                                        <tr data-key="1">
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value["name"] ?></td>
                                            <td><?= $type["name"] ?></td>
                                            <td><?= $value["email"] ?></td>
                                            <td>
                                            <a class="btn btn-warning bi bi-tools " href="users_update.php?id=<?= $value["id"] ?>"> &nbsp;แก้ไข</a>
                                            <?php if($type["name"] == "Admin") {} else {?>
                                            <a onclick="return confirm('แน่ใจหรือไม่ที่จะลบข้อมูล')" class="btn btn-danger bi bi-trash3-fill" href="users_delete.php?id=<?= $value['id']?>">&nbsp;ลบข้อมูล</a>
                                            <?php } ?>
                            
                        </td>
                    </td>
                        <?php }} ?>
                                        </tr>
                                        
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