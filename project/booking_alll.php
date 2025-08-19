<?php
include 'header.php';
include 'db.php';

// ตรวจสอบ session ว่ามีค่า user_type และมีค่าเป็น '1' (admin) หรือไม่
if (isset($_SESSION['type']) && $_SESSION['type'] == '1') {
    // กระบวนการทำงานของ admin ที่นี่
} else {
    // ถ้าไม่ใช่ admin ให้เปลี่ยนเส้นทางไปยังหน้า logout.php
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
    <div class="container">
        <h1 class="text-center" style="color: #FFFFFF;">ข้อมูลการเช่าทั้งหมด</h1>
        <table class="table table-striped table-bordered" style="background-color: #FFFFFF;">
            <!-- ส่วนหัวตาราง -->
            <thead>
                <tr style="text-align: center;">
                    <th style="width: 5%;">NO</th>
                    <th style="width: 13%;">สนาม</th>
                    <th style="width: 17%;">ผู้จอง</th>
                    <th style="width: 10%;">วันที่จอง</th>
                    <th style="width: 12%;" class="action-column">เวลาจอง</th>
                    <th style="width: 12%;" class="action-column">ราคาทั้งหมด</th>
                    <th style="width: 15%;" class="action-column">สถานะการจอง</th>
                    <th style="width:;" class="action-column"></th>
                </tr>
            </thead>
            <!-- ส่วนเนื้อหาตาราง -->
            <tbody>
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
                                <?php if ($value["approve_name_id"] == 1) { ?>
                                    <a class="btn btn-primary" href="booking_approve.php?id=<?= $value["id"] ?>">อนุมัติ</a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm text-center align-items-center justify-content-between" role="group">
                                    <a class="btn btn-warning bi bi-tools" href="booking_update.php?id=<?= $value["id"] ?>">แก้ไข</a>
                                    <a class="btn btn-danger bi bi-trash3-fill" href="booking_delete.php?id=<?= $value["id"] ?>">ลบข้อมูล</a>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // ถ้าไม่มีข้อมูลการจอง
                    echo "<tr><td colspan='8' style='text-align:center;'>ไม่พบข้อมูลการจอง</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- ปุ่มสำหรับจองใช้สนาม -->
        <div class="text-center">
            <a class="btn btn-success" href="booking.php">จองใช้สนาม</a>
        </div>
    </div>
    <?php
}
include 'footer.php';
?>
