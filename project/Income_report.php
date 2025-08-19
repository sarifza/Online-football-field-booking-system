<?php
include 'header.php';
include 'db.php';

// ตรวจสอบว่า session มีค่า user_role และมีค่าเป็น 'admin' หรือไม่
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
                        <STYLE>
                        body{background-image:url('img/1111.jpg'); }</STYLE>
                        
<br>
                        <center><h1 style="color: #FFFFFF; ">รายงานรายได้การจองสนาม</h1>
                        <hr>
</center>
<form id="hid" method="get" id="form" enctype="multipart/form-tb_register" action="" class="text-center" >
      <strong style="color: #FFFFFF">ค้นหาข้อมูล วัน</strong>
    
    <select id="country" name="day" >
	  <option value="">ทั้งหมด</option>
      <option value="-01">1</option>
      <option value="-02">2</option>
      <option value="-03">3</option>
	  <option value="-04">4</option>
	  <option value="-05">5</option>
	  <option value="-06">6</option>
	  <option value="-07">7</option>
	  <option value="-08">8</option>
	  <option value="-09">9</option>
	  <option value="-10">10</option>
	  <option value="-11">11</option>
	  <option value="-12">12</option>
      <option value="-13">13</option>
      <option value="-14">14</option>
      <option value="-15">15</option>
	  <option value="-16">16</option>
	  <option value="-17">17</option>
	  <option value="-18">18</option>
	  <option value="-19">19</option>
	  <option value="-20">20</option>
	  <option value="-21">21</option>
	  <option value="-22">22</option>
	  <option value="-23">23</option>
	  <option value="-24">24</option>
      <option value="-25">25</option>
	  <option value="-26">26</option>
	  <option value="-27">27</option>
	  <option value="-28">28</option>
	  <option value="-29">29</option>
	  <option value="-30">30</option>
      <option value="-31">31</option>

      </select>
      <strong style="color: #FFFFFF">เดือน</strong>
      <select id="country" name="mount">
	  <option value="">ทั้งหมด</option>
      <option value="-01-">มกราคม</option>
      <option value="-02-">กุมภาพันธ์</option>
      <option value="-03-">มีนาคม</option>
	  <option value="-04-">เมษายน </option>
	  <option value="-05-">พฤษภาคม</option>
	  <option value="-06-">มิถุนายน</option>
	  <option value="-07-">กรกฎาคม</option>
	  <option value="-08-">สิงหาคม</option>
	  <option value="-09-">กันยายน</option>
	  <option value="-10-">ตุลาคม</option>
	  <option value="-11-">พฤศจิกายน</option>
	  <option value="-12-">ธันวาคม</option>
     
    </select>
    <strong style="color: #FFFFFF">ปี</strong>
    <select id="country" name="year">
	  <option  value="">ทั้งหมด</option>
      <option  value="2025">2568</option>
      <option  value="2024">2567</option>
      <option  value="2023">2566</option>   
      <option  value="2022">2565</option>
    </select>
      <button class="btn btn-primary bi bi-search" type="submit" value="ค้นหา"></button>

<style>input[type=submit] {
  width: 7%;
  background-color: #4CAF50;
  color: white;
  padding: 5px 10px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}</style>
    </form>
  
<?php $year=isset($_GET['year']) ? $_GET['year']:'' ?>
<?php $mount=isset($_GET['mount']) ? $_GET['mount']:'' ?>
<?php $day=isset($_GET['day']) ? $_GET['day']:'' ?>
<?php $search = $year.''.$mount.''.$day;
echo $search; 
    

?>
<br>
        <table width="100%" style=" background-color : #FFFFFF;" class="table table-striped table-bordered"><colgroup><col>

            <thead>
                <tr><th width="3%"></th>
                    <th width="20%">ชื่อสนาม</th>
                    <th width="15%" class="action-column">รายได้ทั้งหมด</th>
                </tr>
            </thead>
            <tbody>
            <?php
$price_total = 0;
$price_all = array();
$count = 1;
$total = 0;
$_SESSION['price'] = 0;

$stadium = $mysqli->query("SELECT * FROM stadium ");

while ($row = $stadium->fetch_array()) {
    $id = $row["id"];

    $price = $mysqli->query("SELECT price FROM booking WHERE stadium_id = '$id' AND date_start LIKE '%$search%'");
    while ($rows = $price->fetch_array()) {
        $total = $total + $rows["price"];
    }
    $price_all[$count] = $total;
    $total = 0;
    $_SESSION['price'] = $_SESSION['price'] + $price_all[$count];
?>
<tr>
    <td><img src="<?= $row["image"] ?>" width="200"></td>
    <td><?= $row["name"] ?></td>
    <td><?php echo $price_all[$count]; ?></td>
</tr>
<?php 
    $count++;
} 
?>

                        
                       

                 <tr>
                        <td colspan="2">รวมทั้งหมด</td>
                        <td><?php 
                        $all = $_SESSION['price']; 
                        unset($_SESSION["price"]);
                        $_SESSION['total_revenue'] = $all;
                        
                        echo $all;
                        ?></td>
                        </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <center><a href="print_report.php" class="btn btn-success bi bi-printer-fill">&nbsp;พิมม์ทั้งหมด</a></center>
    
    <script>
        function popupWindow(url) {

            var h = 500;
            var w = 500;
            const y = window.top.outerHeight / 2 + window.top.screenY - (h / 2);
            const x = window.top.outerWidth / 2 + window.top.screenX - (w / 2);
            return window.open(url, "รายการจอง", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}');
        }
    </script>
    <?php
include 'footer.php';
?>
