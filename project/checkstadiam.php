<?php include 'header.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">

    <div class="site-index">
        <div class="jumbotron" style="color: #FFFFFF;">
            <h1>ตรวจสอบเวลาสนามว่าง</h1>
            <h2>KOK Stadiam</h2>
            <body>
            <STYLE>
            body{background-image:url('img/1111.jpg'); }</STYLE>

        </div>

        <div class="body-content">

            <div id='calendar'></div>
        </div>
    </div>
</div>
<script>
    


    document.addEventListener('DOMContentLoaded', function () {
        var initialLocaleCode = 'th';
        var localeSelectorEl = document.getElementById('locale-selector');
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            //  initialDate: '2020-09-12',
            timeZone: 'Asia/Bangkok',
            locale: initialLocaleCode,
            buttonIcons: false, // show the prev/next text
            fixedWeekCount: true,   
            weekNumbers: true,
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: {
                url: 'calendar.php', //'plugins/fullcalendar/php/get-events.php',
                failure: function () {
                    // 
                }
            },
            eventRender: function (e, elm) {


            }, 

        });

        calendar.render();



    });

</script>         

<script>

    jQuery(function ($) {
        jQuery('#modalSub').modal({"show": false, "backdrop": "static", "keyboard": false});
    });
</script>       
<?php
include 'footer.php';
?>

</body>
</html>