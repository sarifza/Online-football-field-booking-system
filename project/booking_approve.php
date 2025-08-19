<?php
include 'header.php';
include 'db.php';
if (isset($_SESSION["id"])) {

    $id = isset($_GET["id"]) ? $_GET["id"] : '';

    $booking = $mysqli->query("SELECT * FROM booking where id= " . $id);
    while ($row = $booking->fetch_array()) {
        $stadium_id = $row["stadium_id"];
        $date_start = $row["date_start"];
        $date_end = $row["date_end"];
        $time_start = $row["time_start"];
        $time_end = $row["time_end"];
        $approve_name_id = $row["approve_name_id"];
        $detail = $row["detail"];
        $approve_comment = $row["approve_comment"];
    }


    $result = $mysqli->query("SELECT * FROM stadium ");
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    $approve_name = $mysqli->query("SELECT * FROM approve_name ");
    while ($name = $approve_name->fetch_array()) {
        $approve[] = $name;
    }
 

    if ($_POST) {

        $sql = "update  booking set stadium_id='" . $_POST['stadium_id'] . "' , "
                . "date_start='" . $_POST['date_start'] . "',"
                . "time_start='" . $_POST['time_start'] . "',"
                . "time_end='" . $_POST['time_end'] . "',"
                . "approve_name_id='" . $_POST['approve_name_id'] . "',"
                . "approve_staff='" . $_SESSION['id'] . "',"
                . "approve_date='" . date("Y-m-d H:i:s") . "',"

                . "modify_at='" . date("Y-m-d H:i:s") . "' where id=" . $id;
        if ($mysqli->query($sql) === TRUE) {
            ?>
            <div class="alert alert-success text-center"><strong>บันทึกข้อมูลผลการอนุมัติเรียบร้อย..</strong></div>
            <?php
              echo '<meta http-equiv="refresh" content="5;url=tablebooking_all.php">';
        } else {
            ?>
            <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
            <?php
            // echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    ?>

<body>
     <style>
        body {
            background-image: url('img/login2.jpg');
            color: white; /* Set font color to white */
        }
        
        h1 {
            text-align: center;
        }
        
        .card.border-danger {
            background-color: #FFFFFF;
            margin: auto;
            width: 30cm;
            height: 4cm;
            text-align: center;
            color: #FFFFFF;
        }
        .booking-create {
            color: white; /* Set font color to white */
        }
    </style>
    <div class="container " >
        <div class="booking-create" style="color: #FFFFFF; ">
            <h1 >อนุมัติรายการจองสนาม</h1>
            <div class="booking-form">
                <form id="w0" action="booking_approve.php?id=<?=$id?>" method="post">
                    <div class="row justify-content-center ">
                        <div class="col-md-6">
                            <div class="form-group field-booking-stadium_id required">
                                <label style="color: #FFFFFF;" class="control-label" for="booking-stadium_id">สนามที่จะจอง</label>
                                <select id="booking-stadium_id" class="form-control" name="stadium_id">
                                    <option style="color: #FFFFFF;">เลือกสนามที่จะจอง</option>
                                    <?php
                                    foreach ($rows as $key => $value) {
                                        ?>
                                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == $stadium_id) ? 'selected' : '' ?> ><?= $value["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>     
                        </div>  
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-date_start required">
                                <label class="control-label" for="booking-date_start">วันที่จอง</label>
                                <input type="date" id="booking-date_start" value="<?= $date_start ?>" class="form-control" name="date_start" aria-required="true">
                            </div>       
                        </div>
                    </div>
                        <div class="row justify-content-center">
                         <div class="col-md-6">
                            <div class="form-group field-booking-time_start required">
                                <label class="control-label" for="booking-time_start">เริ่มเวลา</label>
                                <input type="time" id="booking-time_start" value="<?= $time_start ?>" class="form-control" name="time_start" maxlength="7" aria-required="true">
                                
                            </div>       
                        </div>
                    </div>     
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-time_end required">
                                <label class="control-label" for="booking-time_end">ถึงเวลา</label>
                                <input type="time" id="booking-time_end" value="<?= $time_end ?>" class="form-control" name="time_end" maxlength="7" aria-required="true">
                            </div>       
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-approve_name_id ">
                                <label class="control-label" for="booking-approve_name_id">สถานะการจอง</label>
                                <select id="booking-approve_name_id" class="form-control" name="approve_name_id">
                                    <option value="">สถานะการจอง</option>
                                    <?php
                                    foreach ($approve as $key => $value) {
                                        ?>
                                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == $approve_name_id) ? 'selected' : '' ?> ><?= $value["name"] ?></option>
                                    <?php } ?>
                                </select>

                            </div>     
                        </div>  
                    </div>
                    
                    <div class="form-group"><br>
                        <center><button type="submit" class="btn btn-success">บันทึกข้อมูล</button></center>
                    </div>

                </form>
            </div>
            
        </div><br>
   
    <?php
} else {
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
    ?>
<br>
    <?php
}
include 'footer.php';
?>
</body>
</html>