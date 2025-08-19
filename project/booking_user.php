<?php
include 'header.php';

include 'db.php';



if ($result = $mysqli->query("SELECT * FROM booking where users_id=" . $_SESSION['id']." order by id desc")) {
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    ?>

    <div class="container">
    <body>
                        <STYLE>
                        body{background-image:url('img/1111.jpg'); }</STYLE>

<center><br><h1 style="color: #FFFFFF; ">ข้อมูลการจองของคุณ</h1>
</center>
 

        <table width="100%" style=" background-color : #FFFFFF;" class="table table-striped table-bordered"><colgroup><col>

            <thead>
                <tr><th width="3%">#</th>
                    <th width="27%">สนามที่จอง</th>
       
                    <th width="25%">วันที่จอง
                    </th>
                    <th width="23%" class="action-column">เวลาจอง</th>
                    <th width="10%" class="action-column">ราคาทั้งหมด</th>
                    <th width="22%" class="action-column">สถานะการจอง</th>
                    <th width="22%" class="action-column">&nbsp;</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    foreach ($rows as $key => $value) {
                        $Rstadiums = $mysqli->query("SELECT * FROM stadium where id='" . $value['stadium_id'] . "'");
                        $stadium = $Rstadiums->fetch_array();

                        $Rapprove = $mysqli->query("SELECT * FROM approve_name where id='" . $value['approve_name_id'] . "'");
                        $approve = $Rapprove->fetch_array();
                        ?>
                        <tr data-key="1">
                            <td><?= $key + 1 ?></td>
                            <td><?= $stadium["name"] ?></td>
       
                            <td><?= DateThaiFull($value["date_start"]) ?> </td>
                            <td><?= $value["time_start"] ?> - <?= $value["time_end"] ?> น.</td>
                            <td><?= $value["price"] ?> บาท</td>
                            <td><?= $approve["name"] ?></td>
                            <td>
                                <div class="btn-group btn-group-sm text-center" role="group">
                                    
                                    <?php if ($value["approve_name_id"] == 1) { ?>
                                        <a class="btn btn-warning" href="booking_update.php?id=<?= $value["id"] ?>">แก้ไข</a> 
                                        <a onclick="return confirm('แน่ใจหรือไม่ที่จะลบข้อมูล')" class="btn btn-danger" href="booking_delete1.php?id=<?= $value["id"] ?>">ลบข้อมูล</a> 
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
 <script>
        function popupWindow(url) {

            var h = 500;
            var w = 500;
            const y = window.top.outerHeight / 2 + window.top.screenY - (h / 2);
            const x = window.top.outerWidth / 2 + window.top.screenX - (w / 2);
            return window.open(url, "รายการจอง", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}');
        }
    </script>
     <center><a class="btn btn-success" href="booking.php">จองใช้สนาม</a><center> <br>
    <?php
}
include 'footer.php';
?>
