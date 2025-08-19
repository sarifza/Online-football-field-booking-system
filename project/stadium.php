<?php
include 'header.php';

include 'db.php';



if ($result = $mysqli->query("SELECT * FROM stadium ")) {
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    $status_name = $mysqli->query("SELECT * FROM status_name ");
    while ($name = $status_name->fetch_array()) {
        $status[$name['id']] = $name['name'];
    }
    ?>

    <div class="container"><br><br>
    <body>
                        <STYLE>
                        body{background-image:url('img/1111.jpg'); }
                        </STYLE>
                        
                        <h1 class="text-center" style="color: #FFFFFF; ">ข้อมูลสนาม</h1>
                        <?php if (isset($_SESSION["id"]) && $_SESSION["type"] == 1) { ?>

        <?php } ?>
 

        <table width="100%" style=" background-color : #FFFFFF;" class="table table-striped table-bordered"><colgroup><col>

            <thead>
                <tr >
                    <th><div align="center">No.</th></div>
                    <th><div align="center">รูปภาพ</th></div>
                    <th><div align="center">ชื่อสนาม</th></div>
                    <th><div align="center">ราคา/ชั่วโมง</th></div>

                    

                    <!-- <th class="action-column"><div align="center">สถานะการใช้งาน</th></div> -->
                    <th class="action-column">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $key => $value) { ?>
                    <tr data-key="1">
                        <td class="text-center" ><?= $key + 1 ?></td>
                        <td class="text-center" ><img src="<?= $value["image"] ?>" width="100"></td>
                        <td class="text-center"><?= $value["name"] ?></td>
                        <td class="text-center"><?= $value["price"] ?></td>

                        <!-- <td class="text-center"><?= $status[$value["status_name_id"]] ?></td> -->
                        <td class="text-center">
                            <div class="btn-group btn-group-sm text-center align-items-center justify-content-between" role="group">
                                <a class="btn btn-primary bi bi-bag-plus-fill" href="booking.php?id=<?= $value["id"] ?>">&nbsp;เช่าสนาม</a>
                                <?php if (isset($_SESSION["id"]) && $_SESSION["type"] == 1) { ?>
                                    <a  class="btn btn-warning bi bi-tools" href="stadium_update.php?id=<?= $value["id"] ?>">&nbsp;แก้ไขข้อมูล</a> 
                                    <a onclick="return confirm('แน่ใจหรือไม่ที่จะลบข้อมูล')"  class="btn btn-danger bi bi-trash3-fill" href="stadium_delete.php?id=<?= $value["id"] ?>">&nbsp;ลบข้อมูล</a> 
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> <?php if (isset($_SESSION['type'])) {
    // Access $_SESSION['type'] safely
    if ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) {
        echo '<center><a class="btn btn-primary bi bi-cloud-plus" href="stadium_create.php"> เพิ่มสนาม</a></center>';
    }
} else {
    // Handle the case where $_SESSION['type'] is not set
    // This could involve redirecting the user to a login page or displaying an error message
   // echo "Session type is not set.";
}
}
include 'footer.php';
?>
