<!DOCTYPE html>
<html lang="en">
<?php  include 'db.php';
session_start();
// Execute SQL queries
$sql1 = "SELECT COUNT(id) AS id FROM users";
$sql2 = "SELECT SUM(price) AS total FROM booking";
$sql3 = "SELECT COUNT(*) AS total_rows FROM booking WHERE approve_name_id = 2";

$result1 = $mysqli->query($sql1);
$result2 = $mysqli->query($sql2);
$result3 = $mysqli->query($sql3);

// Check if queries were successful
if (!$result1 || !$result2 || !$result3) {
    echo "Error: " . $mysqli->error;
} else {
    // Fetch and display results
    $row1 = $result1->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    $row3 = $result3->fetch_assoc();

    if ($result2 && $result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc(); // Fetch again if $result2 has rows
         
    } else {
         "<p>Total revenue: 0</p>"; // Handle case where $result2 has no rows
    }


         
    $labels = array();
$data = array();
$totalBookingPrice = 0; // Initialize total booking price variable

$query = "SELECT stadium.name AS stadium_name, SUM(booking.price) AS total_booking_price 
          FROM stadium
          JOIN booking ON stadium.id = booking.stadium_id
          GROUP BY stadium.name"; 

$result = $mysqli->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Collect data into arrays
        $labels[] = $row['stadium_name'];
        $bookingPrice = (int)$row['total_booking_price']; // Convert to integer if necessary
        $data[] = $bookingPrice;
        $totalBookingPrice += $bookingPrice; // Add to total booking price
    }
}

include 'slide.php'; ?>
        

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><br>Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                จำนวนสมาชิก</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                        echo  $row1['id'] . "</p>";
                                        ?>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                รายได้ทั้งหมด</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
    
    
  
    // เรียกใช้งานฟังก์ชันและแสดงผลลัพธ์
    echo $totalSum = array_sum($data)
    
    
?>
                                                </div> 
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                จำนวนการใช้งานสนามทั้งหมด</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                
                                            <?php
                                             echo   $row3['total_rows'] . "</p>";
}
                                           ?>
                                           

                                        


</p>
    
    
    </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-15 col-lg-9">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-15 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ตารางแสดงรายได้ของการจองสนาม</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body ">
    <div id="chart_div"> <!-- แก้เป็น ID แทนการใช้คลาส -->
        
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Stadium Name');
                data.addColumn('number', 'รายได้ทั้งหมด');
                data.addRows([
                    <?php
                    // Populate data into DataTable
                    for ($i = 0; $i < count($labels); $i++) {
                        echo "['" . $labels[$i] . "', " . $data[$i] . "]";
                        if ($i < count($labels) - 1) {
                            echo ",";
                        }
                    }
                    ?>
                ]);
        
                var options = {
                    'title': '',
                    'width': 800,
                    'height': 600
                };
        
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div')); // ใช้ ColumnChart แทน PieChart
                chart.draw(data, options);
            }
        </script>
        
    </div>
</div>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>