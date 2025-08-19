<?php

include 'header.php';
include 'db.php';

// ตรวจสอบว่า session มีค่า type และมีค่าเป็น '1' (admin) หรือไม่
if (isset($_SESSION['type']) && $_SESSION['type'] == '1') {
    // กระบวนการทำงานของ admin ที่นี่
} else {
    // ถ้าไม่ใช่ admin ให้โยงไปยังหน้าอื่น
    header('Location: logout.php');
    exit();
}
?>

<div class="container">
    <body>
        <style>
            body{background-image:url('img/1111.jpg'); }
        </style>

        <br>
        <center><h1 style="color: #FFFFFF;">ข้อมูลการใช้งานสนาม</h1></center><br>

        <table width="100%" style=" background-color : #FFFFFF;" class="table table-striped table-bordered">
            <colgroup>
                <col>
            </colgroup>

            <thead>
                <tr>
                    <th><div align="center">รูปภาพ</th></div>
                    <th><div align="center">ชื่อสนาม</th></div>
                    <th><div align="center">ราคา/ชั่วโมง</th></div>
                    <th><div align="center">จำนวนการใช้งาน</th></div>
                </tr>
            </thead>
            <tbody>
                <?php
            $total_all_usage = 0; // กำหนดตัวแปรเพื่อเก็บผลรวมของการใช้งานสนามทั้งหมด

// เชื่อมต่อฐานข้อมูล
$mysqli = new mysqli("localhost", "root", "65309010014", "pro111");

// ตรวจสอบการเชื่อมต่อ
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

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
        // เก็บค่า total_usage ไว้ใน session
$_SESSION['total_usage'] = $total_all_usage;
} ?>
                <tr> <!-- เพิ่มแถวใหม่ -->
                    <td colspan="4">รวมการใช้งานสนามทั้งหมด = <?php echo $_SESSION['total_usage'] = $total_all_usage; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
include 'footer.php';
?>
