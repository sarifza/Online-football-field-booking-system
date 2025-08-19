        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/site.css" rel="stylesheet">    

<?php
 
include 'db.php';


$id = isset($_GET["id"]) ? $_GET["id"] : '';


 
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
//		$strHour= date("H",strtotime($strDate));
//		$strMinute= date("i",strtotime($strDate));
//		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear ";// เวลา $strHour:$strMinute";
 
	}
    

 
 
        
        

$booking = $mysqli->query("SELECT * FROM booking where id= " . $id);
while ($row = $booking->fetch_array()) {
    $stadium_id = $row["stadium_id"];
    $date_start = $row["date_start"];
 
    $time_start = $row["time_start"];
    $time_end = $row["time_end"];
    $approve_name_id = $row["approve_name_id"];
    $detail = $row["detail"];
    $approve_comment = $row["approve_comment"];
    $users_id = $row["users_id"];
    
}
?>

<div class="container">
<body>
                        <STYLE>
                        body{background-image:url('images/สนามคิกออฟ_1.jpg'); }</STYLE>
    <div class="booking-create">
    <br>
        <h1><center>ใบเสร็จรายการจอง</cennter></h1>
        <div class="booking-form">
             <div class="row">
                    <div class="col-md-12">
                    <h3><strong>ผู้จอง</strong> : 
                        <?php
                        $result = $mysqli->query("SELECT * FROM users   where id= " . $users_id);
                        while ($row = $result->fetch_array()) {
                            echo $row["name"];
                        }
                        ?>
                    </div>  
 
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h3><strong>สนามที่จอง</strong> : 
                        <?php
                        $result = $mysqli->query("SELECT * FROM stadium   where id= " . $stadium_id);
                        while ($stadium = $result->fetch_array()) {
                            echo $stadium["name"];
                        }
                        ?>
                    </div>  
                   
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <h2><strong>วันที่จอง</strong> : <?=($date_start)? DateThai($date_start).' '.$time_start.'-'.$time_end.' น.':DateThai($date_start).' '.$time_start.' น. - '.$time_end.' น.' ?>
                    </div>       
 
                </div>     
                <div class="row">
                    <div class="col-md-12">
                    <h3><strong>รายละเอียดการจอง</strong> : <?= $detail ?>    
                    </div>  
                </div>
                <?php
                $approve_name = $mysqli->query("SELECT * FROM approve_name  where id= " . $approve_name_id);
                if ($approve_name) {
                    while ($approve = $approve_name->fetch_array()) {
                        ?>
                
                        <div class="row">
                            <div class="col-md-6">
                            <h2><strong>สถานะการจอง</strong> : <?= $approve["name"] ?>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <h2><strong>หมายเหตุการอนุมัติ</strong> :    <?= $approve_comment ?>    
                            </div>  
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                        <h2><strong>สถานะการจอง</strong> : ยังไม่อนุมัติ
                        </div>  
                    </div>
                <?php } ?>
                <button id="hid" onclick="window.print();" class="btn btn-primary" > print </button>
                
</script> 
        </div>
    </div>
</div>

 