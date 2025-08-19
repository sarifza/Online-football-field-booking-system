<?php
include 'header.php';
include 'db.php';
if (isset($_SESSION["id"])) {

    $id = isset($_GET["id"]) ? $_GET["id"] : '';

    $result = $mysqli->query("SELECT * FROM stadium ");
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }


    $booking = $mysqli->query("SELECT * FROM booking where id= " . $id);
    while ($row = $booking->fetch_array()) {
        $stadium_id = $row["stadium_id"];
        $date_start = $row["date_start"];
        $date_end = $row["date_end"];
        $time_start = $row["time_start"];
        $time_end = $row["time_end"];
        $approve_name_id = $row["approve_name_id"];
        $detail = $row["detail"];
    }



    function DateDiff($strDate1,)
    {
    return strtotime($strDate1)/  ( 60  * 24 );  // 1 day = 60*60*24
    }
    function TimeDiff($strTime1,$strTime2)
    {
    return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
    }

    if ($_POST) {
        if (isset($_SESSION["id"]) && trim($_POST["stadium_id"]) != "" && trim($_POST['date_start'])) {
            
            /////////ส่วนค้นหาข้อมูลในช่วงเวลา ที่ต้องการจองนั้นซ้ำกันหรือไม่//////////////////

           $result_NO = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND id != '$id' AND date_start = '".$_POST['date_start']."' AND time_start = '".$_POST['time_start']."' AND time_end = '".$_POST['time_end']."'");
           $result_NO2 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND id != '$id' AND date_start = '".$_POST['date_start']."' AND (time_start BETWEEN '".$_POST['time_start']."' AND '".$_POST['time_end']."') ");
           $result_NO3 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND id != '$id'  AND (time_start BETWEEN '".$_POST['time_start']."' AND '".$_POST['time_end']."') ");
           $result_NO4 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND id != '$id' AND date_end = '".$_POST['date_start']."' AND time_end > '".$_POST['time_start']."'");


            ///////////////////////////////////////ส่วนการจองซ้ำ โดยจะตรวจเพื่มคือ ไม่ใช่รายการที่กำลังแก้ไข////////////////////////////////////////
           
           if(mysqli_num_rows($result_NO) == 1 ){ //จะซ้ำในกรณีที่วันที่เวลาที่เลือกเข้ามาตรงกับข้อมูลในระบบทุกอย่าง บรรทัด 27
            ?>
            <div class="alert alert-danger text-center"><strong>ช่วงเวลาจองนี้ไม่ว่าง กรุณาจองช่วงเวลาอื่น..</strong></div>
            <?php
            //echo '<meta http-equiv="refresh" content="1;url=booking.php">';
           }elseif(mysqli_num_rows($result_NO2) == 1 ){ //จะซ้ำในกรณีวันที่เริ่มจองเหมือนในระบบ และข้อมูลในดาต้าตรงเริ่มจองนั้นอยู่ในระหว่าง เวลาที่เริ่มกับสิ้นสุดการจองมั้ย  บรรทัด 28
            ?>
            <div class="alert alert-danger text-center"><strong>ช่วงเวลาจองนี้ไม่ว่าง กรุณาจองช่วงเวลาอื่น..</strong></div>
            <?php
            }elseif(mysqli_num_rows($result_NO3) == 1 ){ //จะซ้ำในกรณีวันที่เริ่มจองเหมือนกับ ข้อมูลที่กรอกของวันสิ้นสุดหรือไม่ และหลังจากนั้นข้อมูลในดาต้าตรงเริ่มจองนั้นอยู่ในระหว่าง เวลาที่เริ่มกับสิ้นสุดการจองมั้ย
                ?>
                <div class="alert alert-danger text-center"><strong>ช่วงเวลาจองนี้ไม่ว่าง กรุณาจองช่วงเวลาอื่น..</strong></div>
                <?php
            }elseif(mysqli_num_rows($result_NO4) == 1 ){ //จะซ้ำในกรณีวันที่สิ้นสุดการจองในดาต้าเหมือนกันกับข้อมูลที่กรอกวันสิ้นสุดการ และ ข้อมูลในดาต้า เวลาสิ้นสุด < เวลาเริ่มต้นที่กรอกเข้ามา
                ?>
                <div class="alert alert-danger text-center"><strong>ช่วงเวลาจองนี้ไม่ว่าง กรุณาจองช่วงเวลาอื่น..</strong></div>
                <?php
            ///////////////////////////////////////////////////////////////////////////////////////////
            
           }else{

                    /////////ส่วน คำนวณเวลาจองสนาม เพื่อนำมาคิดรายชั่วโมง หาราคาทั้งหมด //////////

                    $dateall = 11 * DateDiff($_POST['date_start']); 
                    //$_POST['date_start'] คือ วันที่เรื่มจอง
                    //$_POST['date_end'] คือ วันที่สิ้นสุดการจอง
                    // DateDiff ที่มาจากบรรทัด 13 นั้นเป็นฟังชั่นหาความต่างของวัน จาก $_POST['date_start'] กับ $_POST['date_end']

                    $timeall = TimeDiff($_POST['time_start'],$_POST['time_end']);
                    //สูตรหาความต่างของชั่วโมงของวันทีเริ่มจองวันนั้นวันเดียว โดยใช้ฟังชั่น TimeDiff ที่มาจากบรรทัด 17
                    //$_POST['time_start'] คือ เวลาที่เริ่มจอง
                    //$_POST['time_end'] คือ เวลาที่สิ้นสุดการจอง

                    //เป้นการบวก ชั่วโมง ในกรณีที่มีการจองมากกว่า 1 วัน
                    //$dateall คือ ความต่างของวัน แปลงเป็นรายชั่วโมงแล้ว ได้ 11 ชั่วโมงต่อ วัน
                    //$timeall คือ ความต่างรายชั่วโมงของวันที่เริ่มจองวันเดียว
                    $total_time = $dateall  + $timeall;

                    //$total_time เก็บชั่วโมงที่ทำการจองทั้งหมด เพื่อไปคำนวณค่าใช้จ่าย


                            $result_price = $mysqli->query("SELECT * FROM stadium WHERE id = '".$_POST['stadium_id']."' ");//เป็นการค้าหาข้อมูล สนาม database
                            if(mysqli_num_rows($result_price) == 1){ //จะตรวจสอบว่ามีข้อมูลใน database เจอสัก 1 ค่ามั้ย ถ้ามี..
                                $rows = mysqli_fetch_array($result_price); 
                                $_SESSION['price'] = $rows['price']; //ให้เก็บค่าราคาจองรายชั่วโมงมา ไว้ใน $_SESSION['price'] จากนั้น ..
                            }

                    //ก่อนจะคำนวณจะมีการตรวจสอบก่อนว่า
                    if($_POST['date_start']){ //ตรวจสอบว่า วันที่จองกับวันที่สิ้นสุดการจองนั้นเป็นวันเดียวกันรึป่าว
                        $price_total = $timeall * $_SESSION['price']; //ถ้าใช่ก็จะเอาแค่ความต่างเวลา มาคูณกับราคาจองรายชั่วโมงสนามนั้นๆ
                    
                    }else {//ถ้าไม่ใช่ หรือก็คือไม่ใช้จองวันเดียว จะเอา $total_time ที่ได้จากบรรทัด 55 มา คูณด้วยราคาจองรายชั่วโมงของสนามนั้นๆ
                        $price_total = $total_time * $_SESSION['price'];
                    }
                    echo $dateall;
                    ///////////////////////////////////////////////////////////////////////
                    if($price_total < 0){
                        ?>
                                        <div class="alert alert-danger text-center"><strong>เวลาการจองย้อนหลัง กรุณาจองใหม่อีกครั้ง..</strong></div>
                                        <?php
                                        echo '<meta http-equiv="refresh" content="1;url=booking.php">';

                    }else{
                        if($_POST['date_start'] >= date("Y-m-d")){// เป็นการตรวจสอบว่า เวลาที่เริ่มจองนั้น น้อยกว่าเวลาปัจจุบันหรือไม่ หรือก็คือ ตรวจสอบว่ามันไม่ใช่วันที่เมื่อวานนั้นเอง
                                
                                if( $_POST['time_start'] >= "10:00" && $_POST['time_end'] <= "21:00"){ //เป็นการตรวจสอบว่า เวลาที่ทำการเลือกมานั้น อยู่ในช่วงที่สนามเปิดทำการหรือไม่ 10.00 - 21.00 น.
                                    $sql = "update  booking set stadium_id='" . $_POST['stadium_id'] . "' , date_start='" . $_POST['date_start'] . "',time_start='" . $_POST['time_start'] . "',time_end='" . $_POST['time_end'] . "',price = '$price_total',detail='" . $_POST['detail'] . "' ,modify_at='" . date("Y-m-d H:i:s") . "' where id=" . $id;
                                    if ($mysqli->query($sql) === TRUE) {
                                            ?>
                                            <div class="alert alert-success text-center"><strong>แก้ไขข้อมูลการจองเรียบร้อย..</strong></div>
                                            <?php
                                            echo '<meta http-equiv="refresh" content="0;url=booking_user.php">';
                                        } else {
                                            ?>
                                            <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
                                            <?php
                                            echo "Error: " . $sql . "<br>" . $mysqli->error;
                                        }
                                    }else {
                                    
                                        ?>
                                        <div class="alert alert-danger text-center"><strong>กรุณาจองภายในเวลา 10.00 - 21.00 น ที่สนามเปิดและปิดใช้งาน..</strong></div>
                                        <?php
                                        echo '<meta http-equiv="refresh" content="1;url=booking.php">';

                                    }
                            }else {
                                ?>
                                <div class="alert alert-danger text-center"><strong>กรุณาจองสนามในวันนี้ หรือวันถัดไป..</strong></div>
                                <?php
                                echo '<meta http-equiv="refresh" content="1;url=booking.php">';

                            }
                        }
                    }
                        
        } else {
                    ?>
                    <div class="alert alert-danger text-center"><strong>กรุณากรอกข้อมูลให้ครบถ้วน..</strong></div>
                    <?php
                    echo '<meta http-equiv="refresh" content="1;url=booking.php">';

                }
                
            }
    
        
    ?>
  


    <div class="container">
    <body>
                        <STYLE>
                        body{background-image:url('img/login2.jpg'); }</STYLE>
    <br>
        <div class="booking-create">
        <center><h1 style="color: #FFFFFF">แก้ไขข้อมูลการจองสนาม</h1></center>
            <div class="booking-form" style="color: #FFFFFF">
                <form id="w0" action="booking_update.php?id=<?= $id ?>" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-stadium_id required">
                                <label class="control-label" for="booking-stadium_id">สนามที่จะจอง</label>
                                <select id="booking-stadium_id" class="form-control" name="stadium_id">
                                    <option value="">เลือกสนามที่จะจอง</option>
                                    <?php
                                    foreach ($rows as $key => $value) {
                                        ?>
                                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == $stadium_id) ? 'selected' : '' ?> ><?= $value["name"] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block"></div>
                            </div>     
                        </div>  
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-date_start required">
                                <label class="control-label" for="booking-date_start">วันที่จอง</label>
                                <input type="date" id="booking-date_start" value="<?= $date_start ?>" class="form-control" name="date_start" aria-required="true">
                                <div class="help-block"></div>
                            </div>       
                        </div> 
                    </div> 
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-time_start required">
                                <label class="control-label" for="booking-time_start">เริ่มเวลา</label>
                                <input type="time" id="booking-time_start"  value="<?= $time_start ?>" class="form-control" name="time_start" maxlength="7" aria-required="true">
                                <div class="help-block"></div>
                            </div>       
                        </div>
                    </div>
                        <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-time_end required">
                                <label class="control-label" for="booking-time_end">ถึงเวลา</label>
                                <input type="time" id="booking-time_end"  value="<?= $time_end ?>" class="form-control" name="time_end" maxlength="7" aria-required="true">
                                <div class="help-block"></div>
                            </div>       
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button type="submit" class="btn btn-success">บันทึก</button></center>
                    </div>

                </form>
            </div>
        </div>
    </div><br>
    <?php
} else {
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
    ?>

    <?php
}
include 'footer.php';
?>
