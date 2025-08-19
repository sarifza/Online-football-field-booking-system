<?php

include 'db.php';

$start = str_replace('T00:00:00', '', $_GET["start"]);
$end = str_replace('T00:00:00', '', $_GET["end"]);





if ($result = $mysqli->query("SELECT * FROM booking where date_start BETWEEN '" . $start . "' and  '" . $end . "' and approve_name_id in(2)")) {
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    $json = [];


// Free result set
//
//     $CalendarData = $result->fetch_assoc();
//     print_r($CalendarData);
    foreach ($rows as $key => $value) {


        $time = '';
        if (trim($value["time_start"]) != "") {
            $time = $value["time_start"] . ":00";
        }
        if (trim($value["time_end"]) != "") {
            $time .= '-' . $value["time_end"];
        }


        if ($time != "") {
            $time = 'T' . $time;
        }
        $name = "";

        if ($result1 = $mysqli->query("SELECT * FROM stadium where id=" . $value["stadium_id"] . "")) {
            while ($row = $result1->fetch_assoc()) {
                $name = $row["name"];
            }
        } else {
            
        }



        if ($value["date_start"] == $value["date_end"]) {
            array_push($json, ['id' => $value["id"], 'title' => $name, 'description' => $value["detail"], 'start' => $value["date_start"] . $time]);
        } else {
            array_push($json, ['id' => $value["id"], 'title' => $name, 'description' => $value["detail"], 'start' => $value["date_start"] . $time, 'end' => $value["date_end"] . $time]);
        }
    }


    $events = json_encode($json, true);

    echo $events;
}
$result->free_result();
$mysqli->close();
?>