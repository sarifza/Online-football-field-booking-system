<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ระบบจองสนามฟุตบอลออนไลน์</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/site.css" rel="stylesheet">               
        <link href='plugins/fullcalendar/lib/main.css' rel='stylesheet' />
        <script src='plugins/fullcalendar/lib/main.js'></script>
        <script src='plugins/fullcalendar/lib/locales-all.js'></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .navbar-brand, li a{
                color: #FFF !important;

            }
            .row,select{
                padding: 10px;
            }
        </style>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
    .wrapper{ 
   margin-left: 10px;
   margin-right: 10px;ิ
   min-width: 650px;
   background-color: blue ;
}
    body {
      overflow-x: auto;
    }

    .custom-navbar {
      background-color: #eeeeee; /* สามารถปรับสีตามต้องการ */
    }


 </style>
    </head>
    <body>
<font size="1.5" >
        <div class="wrap">
            <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #006600;">
                <div class="container">
                    <div class="d-flex flex-grow-1">
                        <span class="w-100 d-lg-none d-block">
                            <!-- hidden spacer to center brand on mobile --></span>
                        <a class="navbar-brand d-none d-lg-inline-block" href="index1.php"> Kok stadium </a>
                        <a class="navbar-brand-two mx-auto d-lg-none d-inline-block"  style="float: left" href="#">
                           Kok stadium
                        </a>
                        <div class="w-100 text-right">
                            <button class="navbar-toggler" style="float: right" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
                        <ul class="navbar-nav ms-auto flex-nowrap">
                            <li class="nav-item">
                                <a href="index1.php" class="nav-link m-2 menu-item nav-active"><i class="bi bi-house-door"></i>&nbsp;หน้าหลัก</a>
                            </li>
                            <li class="nav-item">
                                <a href="stadium.php" class="nav-link m-2 menu-item nav-active"><i class="bi bi-card-checklist"></i>&nbsp;รายชื่อสนาม</a>
                            </li>
                            <li class="nav-item">
                                <a href="checkstadiam.php" class="nav-link m-2 menu-item nav-active"><i class="bi bi-calendar-check"></i>&nbsp;ตรวจสอบสนามว่าง</a>
                            </li>

                            <?php if (isset($_SESSION['id'])) { 


                                

                                 if($_SESSION["type"]!=2) {?>
                                    <li class="nav-item">
                                        <a href="booking_user.php" class="nav-link m-2 menu-item"><i class="bi bi-card-checklist"></i>&nbsp;รายการจองของคุณ</a>
                                    </li>
                                <?php } ?>

                                <?php if ($_SESSION['type'] == 1 ||  $_SESSION['type'] == 2) { ?>
                                    <li class="nav-item">
                                        <a href="dashbord.php" class="nav-link m-2 menu-item"><i class="bi bi-card-checklist"></i>&nbsp;dashbord</a>
                                    </li>
                                
                                <?php } ?>

                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link m-2 menu-item"><i class="bi bi-box-arrow-right"></i>&nbsp;ออกจากระบบ(<?= $_SESSION['name'] ?>)</a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="nav-item">
                                    <a href="register.php" class="nav-link m-2 menu-item"><i class="bi bi-box-arrow-in-right"></i>&nbsp;สมัครใช้งานระบบ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="login.php" class="nav-link m-2 menu-item"><i class="bi bi-box-arrow-in-right"></i>&nbsp;เข้าสู่ระบบ</a>
                                </li>
                            <?php } ?>

                        </ul>


                    </div>
                </div>

            </nav>
</font>
