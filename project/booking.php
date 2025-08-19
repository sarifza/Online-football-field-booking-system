<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
include 'header.php';
include 'db.php';
if (isset($_SESSION["id"])) {

    $stadium = isset($_GET["id"]) ? $_GET["id"] : '';

    $result = $mysqli->query("SELECT * FROM stadium ");
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    function DateDiff($strDate1)
    {
    return (strtotime($strDate1))/  ( 60 * 24 );  // 1 day = 60*60*24
    }
    function TimeDiff($strTime1,$strTime2)
    {
    return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60  ); // 1 Hour =  60*60
    }

    if ($_POST) {
        if (isset($_SESSION["id"]) && trim($_POST["stadium_id"]) != "" && trim($_POST['date_start'])) {
            
            /////////ส่วนค้นหาข้อมูลในช่วงเวลา ที่ต้องการจองนั้นซ้ำกันหรือไม่//////////////////

           $result_NO = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND date_start = '".$_POST['date_start']."'  AND time_start = '".$_POST['time_start']."' AND time_end = '".$_POST['time_end']."'");
           $result_NO2 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND date_start = '".$_POST['date_start']."' AND (time_start BETWEEN '".$_POST['time_start']."' AND '".$_POST['time_end']."') ");
           $result_NO3 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND (time_start BETWEEN '".$_POST['time_start']."' AND '".$_POST['time_end']."') ");
           $result_NO4 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND date_end = '".$_POST['date_start']."' AND time_end > '".$_POST['time_start']."'");
           $result_NO5 = $mysqli->query("SELECT * FROM booking WHERE stadium_id = '".$_POST['stadium_id']."' AND date_end = '".$_POST['date_start']."' AND time_end ");



            ///////////////////////////////////////ส่วนการจองซ้ำ ////////////////////////////////////////
           
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
                    }elseif(mysqli_num_rows($result_NO5) == 1 ){ 
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
                    echo $timeall;
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
                        if($timeall < 1){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 1 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                                $price_total = $_SESSION['price'] / 2; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 2){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 1 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 1; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 3){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 2 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 2; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 4){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 3 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 3; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 5){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 4 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 4; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 6){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 5 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 5; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 7){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 6 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 6; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 8){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 7 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 7; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }elseif($timeall < 9){ //ตรวจสอบว่าเวลาที่จองเข้ามานั้นน้อยกว่า 8 ชั่วโมงหรือมั้ย ถ้าน้อยกว่า
                            $price_total = $_SESSION['price'] * 8; // ก็จะคิดราคาเต็มของค่าจอง ทันที
                        }else{
                                $price_total = $timeall * $_SESSION['price'];//ถ้าไม่ก็จะเอาแค่ความต่างเวลา มาคูณกับราคาจองรายชั่วโมงสนามนั้นๆ
                        }


                    }else {//ถ้าไม่ใช่ หรือก็คือไม่ใช้จองวันเดียว จะเอา $total_time ที่ได้จากบรรทัด 55 มา คูณด้วยราคาจองรายชั่วโมงของสนามนั้นๆ
                        
                        $price_total = $total_time * $_SESSION['price'];
                    }
                    ///////////////////////////////////////////////////////////////////////

                    
                    if($price_total < 0){
                        ?>
                        <div class="alert alert-danger text-center"><strong>เวลาการจองย้อนหลัง กรุณาจองใหม่อีกครั้ง..</strong></div>
                        <?php
                        

                    }else{
                        if($_POST['date_start'] >= date("Y-m-d")){// เป็นการตรวจสอบว่า เวลาที่เริ่มจองนั้น น้อยกว่าเวลาปัจจุบันหรือไม่ หรือก็คือ ตรวจสอบว่ามันไม่ใช่วันที่เมื่อวานนั้นเอง
                                
                                if( $_POST['time_start'] >= "10:00" && $_POST['time_end'] <= "21:00"){ //เป็นการตรวจสอบว่า เวลาที่ทำการเลือกมานั้น อยู่ในช่วงที่สนามเปิดทำการหรือไม่ 10.00 - 21.00 น.
                                        $sql = "INSERT INTO booking (users_id, stadium_id, date_start,date_end,time_start,time_end,price,detail,approve_name_id,create_at)";
                                        $sql .= "VALUES ('" . $_SESSION["id"] . "', '" . $_POST['stadium_id'] . "','" . $_POST['date_start'] . "','" . "','" . $_POST['time_start'] . "','" . $_POST['time_end'] . "','$price_total','" . "',1,'" . date("Y-m-d H:i:s") . "')";

                                        if ($mysqli->query($sql) === TRUE) {
                                            ?>
                                            <div class="alert alert-success text-center"><strong>บันทึกข้อมูลการจองเรียบร้อย..</strong></div>
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

                                    }
                            }else {
                                ?>
                                <div class="alert alert-danger text-center"><strong>กรุณาจองสนามในวันนี้ หรือวันถัดไป..</strong></div>
                                <?php

                            }
                        }
                    }
                        
        } else {
                    ?>
                    <div class="alert alert-danger text-center"><strong>กรุณากรอกข้อมูลให้ครบถ้วน..</strong></div>
                    <?php

                }
                
            }
    
        
    ?>

    <div class="container " >
     <body>
                        <STYLE>
                        body{background-image:url('img/login2.jpg'); 
                                }
                        
                        h1 {
                        text-align: center; /* จัดให้อยู่ตรงกลาง */
                            }
                            .card.border-danger {
                        background-color: #FFFFFF; /* กำหนดพื้นหลังเป็นสีขาว */
                        margin: auto; /* จัดให้อยู่ตรงกลาง */
                        width: 30cm; /* กำหนดความกว้าง */
                        height: 4cm;
                        text-align: center;
                        color: #FFFFFF;
        }
                        </STYLE>
        <div class="booking-create" style="color: #FFFFFF; ">
            <h1 >ทำรายการจองสนาม</h1>
            <div class="booking-form">
                <form id="w0" action="booking.php" method="post">
                    <div class="row justify-content-center ">
                        <div class="col-md-6">
                            <div class="form-group field-booking-stadium_id required">
                                <label style="color: #FFFFFF;" class="control-label" for="booking-stadium_id">สนามที่จะจอง</label>
                                <select id="booking-stadium_id" class="form-control" name="stadium_id">
                                    <option style="color: #FFFFFF;">เลือกสนามที่จะจอง</option>
                                    <?php
                                    foreach ($rows as $key => $value) {
                                        ?>
                                        <option value="<?= $value["id"] ?>" <?= ($value["id"] == $stadium) ? 'selected' : '' ?> ><?= $value["name"] ?>  ราคา/ชั่วโมง<?= $value["price"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>     
                        </div>  
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-date_start required">
                                <label class="control-label" for="booking-date_start">วันที่จอง</label>
                                <input type="date" id="booking-date_start" class="form-control" name="date_start" min="<?php echo date("Y-m-d"); ?>" aria-required="true">
                            </div>       
                        </div>
                    </div>
                        <div class="row justify-content-center">
                         <div class="col-md-6">
                            <div class="form-group field-booking-time_start required">
                                <label class="control-label" for="booking-time_start">เริ่มเวลา</label>
                                <input type="time" id="booking-time_start" class="form-control" name="time_start" min="10:00" max="21:00"  aria-required="true">
                                
                            </div>       
                        </div>
                    </div>     
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group field-booking-time_end required">
                                <label class="control-label" for="booking-time_end">ถึงเวลา</label>
                                <input type="time" id="booking-time_end" class="form-control" name="time_end"  min="10:00" max="21:00" maxlength="7" aria-required="true">
                            </div>       
                        </div>
                    </div><br>
                    <div class="form-group">
                        <center><button type="submit" class="btn btn-success">ส่งรายการจอง</button></center>
                    </div>

                </form>
            </div>
            
        </div><br>
        <div class="card border-danger mb-6">
  <h3 class="card-header text-decoration-underline ">คำเตือน</h3>
  <div class="card-body">
    <h5 class="card-title">หากท่านจองสนามเรียบร้อยแล้ว กรุณาติดต่อ 098-7097065 & 062-7644044 ภายในหนึ่งชั่วโมง<br>หากท่านไม่ได้ติดต่อ ภายในหนึ่งชั่วโมง Admin จะทำการยกเลิกการจองของท่าน</h5>
    <p class="card-text">จองสนามได้ตั้งแต่เวลา 10.00 น. ถึงเวลา 21.00 น.</p>

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
</body>
</html>