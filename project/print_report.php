<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
include 'db.php';
include ("date.php");

if ($result = $mysqli->query("SELECT * FROM booking   order by id desc")) {
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    ?>
<h2><B>&nbsp;&nbsp;&nbsp;&nbsp;รายงานรายได้จากการจองสนาม</B></h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พิมม์เมื่อ : <?php echo ThDate(); ?><Br><Br>
<hr>

<center><table class="table" style="width: 1000px;">

<thead>
                <tr><th width="3%">#</th>
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

                                $price = $mysqli->query("SELECT price FROM booking WHERE stadium_id = '$id' ");
                                while ($rows = $price->fetch_array()) {
                                    $total = $total + $rows["price"];

                                }
                                $price_all[$count] = $total;
                                $total = 0;
                                $_SESSION['price'] = $_SESSION['price'] + $price_all[$count];
                        ?>
                            
                            <td><img src="<?= $row["image"] ?>" width="200"></td>
                            <td><?= $row["name"] ?> </td>
                            <td><?php echo $price_all[$count]; ?> </td>

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
                        echo $all;
                        ?></td>
                        </tr>
            </tbody>
        </table>


<button type="button" onclick="javascript:this.style.display='none';window.print();window.close();" class="btn btn-success" > พิมพ์หน้านี้</button>
	
		
	
	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
   <?php
}
?>

