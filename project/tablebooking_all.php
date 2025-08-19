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
// ทำการ query ข้อมูลการจองทั้งหมดจากตาราง booking
if ($result = $mysqli->query("SELECT * FROM booking ORDER BY id DESC")) {
    $rows = [];
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }


    ?>



<div class="container-fluid">
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-2 text-gray-800">ข้อมูลการเช่าสนาม</h1>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm "data-bs-toggle='modal' href="booking.php" data-bs-target='#Modal-manage-user-insert'><i
                                class="fas fa-plus fa-sm text-white-50"></i> เพิ่มข้อมูล</a></a>
                        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th style="">NO</th>
                    <th style="">สนาม</th>
                    <th style="">ผู้จอง</th>
                    <th style="">วันที่จอง</th>
                    <th style="" class="action-column">เวลาจอง</th>
                    <th style="" class="action-column">ราคาทั้งหมด</th>
                    <th style="" class="action-column">สถานะการจอง</th>
                    <th style="" class="action-column">ตั้งค่า</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                    <th style="">NO</th>
                    <th style="">สนาม</th>
                    <th style="">ผู้จอง</th>
                    <th style="">วันที่จอง</th>
                    <th style="" class="action-column">เวลาจอง</th>
                    <th style="" class="action-column">ราคาทั้งหมด</th>
                    <th style="" class="action-column">สถานะการจอง</th>
                    <th style="" class="action-column">ตั้งค่า</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr>
                    <?php
                // ถ้ามีข้อมูลการจอง
                if ($result->num_rows > 0) {
                    foreach ($rows as $key => $value) {
                        // ทำการ query ข้อมูลสนาม, ผู้จอง และสถานะการจอง
                        $Rstadiums = $mysqli->query("SELECT * FROM stadium WHERE id=" . $value['stadium_id']);
                        $stadium = $Rstadiums->fetch_array();

                        $Rapprove = $mysqli->query("SELECT * FROM approve_name WHERE id=" . $value['approve_name_id']);
                        $approve = $Rapprove->fetch_array();

                        $Ruser = $mysqli->query("SELECT * FROM users WHERE id=" . $value['users_id']);
                        $user = $Ruser->fetch_array();
                        ?>
                        <!-- แสดงข้อมูลในแต่ละแถว -->
                        <tr style="text-align: center;">
                            <td><?= $key + 1 ?></td>
                            <td><?= $stadium["name"] ?></td>
                            <td><?= $user["name"] ?></td>
                            <td><?= DateThaiFull($value["date_start"]) ?></td>
                            <td><?= $value["time_start"] ?>-<?= $value["time_end"] ?> น.</td>
                            <td><?= $value["price"] ?></td>
                            <td><?= $approve["name"] ?>
                                
                            </td>
                            <td>
                            <?php if ($value["approve_name_id"] == 1) { ?>
                                    <a class="btn btn-warning" href="booking_approve.php?id=<?= $value["id"] ?>">แก้ไข</a>
                                <?php } ?>
                                    <a onclick="return confirm('แน่ใจหรือไม่ที่จะลบข้อมูล')" class="btn btn-danger bi bi-trash3-fill" href="booking_delete.php?id=<?= $value["id"] ?>">ลบข้อมูล</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // ถ้าไม่มีข้อมูลการจอง
                    echo "<tr><td colspan='8' style='text-align:center;'>ไม่พบข้อมูลการจอง</td></tr>";
                }}
                ?>
                    </tr>
                    
                </tbody>
            </table>
        </div>
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