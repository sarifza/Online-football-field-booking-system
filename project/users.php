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



if ($result = $mysqli->query("SELECT * FROM users")) {
    while ($row = $result->fetch_array()) {
        $id = $row['id'];
        $rows[] = $row;
    }
    ?>
  
    <div class="container">
    <body>
        <br>
                        <STYLE>
                        body{background-image:url('img/1111.jpg'); }</STYLE>

<center><h1 style="color: #FFFFFF; ">ข้อมูลผู้ใช้งาน</h1>
</center>

 

        <table width="100%" style=" background-color : #FFFFFF;" class="table table-striped table-bordered"><colgroup><col>

            <thead>
                <tr class="text-center">
                    <th>ลำดับ</th>
                    <th>ชื่อผู้ใช้งาน</th>
                    <th>ประเภท</th>
                    <th class="action-column">สถานะการใช้งาน</th>
 <th> </th>
                </tr>
            </thead>
            <tbody>
    <?php
    foreach ($rows as $key => $value) {

        $Rapprove = $mysqli->query("SELECT * FROM users_type where id='" . $value['users_type_id'] . "'");
        $type = $Rapprove->fetch_array();
        ?>
                    <tr class="text-center" data-key="1">
                        <td><?= $key + 1 ?></td>
                        <td><?= $value["name"] ?></td>
                        <td><?= $type["name"] ?></td>
                        <td><?= $value["status_at"] ?></td>
                        <td>
                            <div class="btn-group btn-group-sm text-center" role="group">

                                <a class="btn btn-warning bi bi-tools " href="users_update.php?id=<?= $value["id"] ?>"> &nbsp;แก้ไข</a>
                                    <?php if($type["name"] == "Admin") {} else {?>
                                <a onclick="return confirm('แน่ใจหรือไม่ที่จะลบข้อมูล')" class="btn btn-danger bi bi-trash3-fill" href="users_delete.php?id=<?= $value['id']?>">&nbsp;ลบข้อมูล</a>
                                <?php } ?>
                                 

                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <center><a class="btn btn-primary bi bi-person-fill-add " href="add_users.php">&nbsp;เพิ่มสมาชิก</a></center>

    <?php
}
include 'footer.php';
?>
