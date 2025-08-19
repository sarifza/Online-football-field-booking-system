<?php
include 'header.php';
include 'db.php';

$result = $mysqli->query("SELECT * FROM status_name ");
while ($row = $result->fetch_array()) {
    $rows[] = $row;
}


$id = isset($_GET["id"]) ? $_GET["id"] : '';
$stadium = $mysqli->query("SELECT * FROM stadium where id= " . $id);
while ($row = $stadium->fetch_array()) {
    $name = $row["name"];

    $detail = $row["detail"];
    $status_name_id = $row["status_name_id"];
    $image = $row["image"];
    $price = $row["price"];

}


if ($_POST) {
    if (trim($_POST["name"]) != ""  && trim($_POST['status_name_id'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            
        } else {
            $target_file = $image;
        }
        $sql = "update  stadium  set name='" . $_POST["name"] . "', image='" . $target_file . "',detail='"  . "',price='" . $_POST['price'] . "',status_name_id='" . $_POST['status_name_id'] . "',users_id='" . $_SESSION['id'] . "',modify_at='" . date("Y-m-d H:i:s") . "' where id=" . $id;



        if ($mysqli->query($sql) === TRUE) {
            ?>
            <div class="alert alert-success text-center"><strong>บันทึกข้อมูลสนามเรียบร้อย..</strong></div>
            <?php
            echo '<meta http-equiv="refresh" content="1;url=stadium.php">';
        } else {
            ?>
            <div class="alert alert-danger text-center"><strong>Error : <?= $mysqli->error ?>..</strong></div>
            <?php
            // echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }else {
    ?>
    <div class="alert alert-danger text-center"><strong>กรุณากรอกข้อมูลให้ครบถ้วน..</strong></div>
    <?php
}
} 
?>


<div class="create container">
<body>
                        <STYLE>
                        body{background-image:url('img/login2.jpg'); }</STYLE>
<br>
    <h1 class="text-center" style="color: #FFFFFF;">แก้ไขข้อมูลสนาม</h1>


    <div class="form" style="color: #FFFFFF;">

        <form method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-md-6"> <div class="form-group  ">
                        <label class="control-label" for="name">ชื่อสนาม</label>
                        <input type="text" id="name" class="form-control" name="name" maxlength="100" aria-="true">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6"> <div class="form-group  ">
                        <label class="control-label" for="name">ราคา / ชั่วโมง</label>
                        <input type="text" class="form-control" name="price" aria-="true">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6"> <div class="form-group  ">
                        <label class="control-label" for="name">สถานะการใช้งาน</label>
                        <select id="status_name_id" class="form-control" name="status_name_id">

                            <?php
                            foreach ($rows as $key => $value) {
                                ?>
                                <option value="<?= $value["id"] ?>"  ><?= $value["name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label" for="image">รูปภาพ</label>
                        <input type="file" id="image" name="fileToUpload">
                    </div> 
                </div>
            </div>
    </div>
            <div class="form-group mt-5">
                <center><button type="submit" class="btn btn-success">บันทึก</button></center>
            </div>
        </form>
    </div><br>

<?php
include 'footer.php';
?>