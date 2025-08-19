<?php

 
    $mysqli = new mysqli("localhost", "root", "65309010014", "pro111"); 
    $mysqli -> set_charset("utf8");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;   
        exit();
    }

       
    function DateThaiFull($strDateFull,$mode=null){
        $strYearFull = date("Y",strtotime($strDateFull))+543;
        $strMonthFull= date("n",strtotime($strDateFull));
        $strDayFull= date("d",strtotime($strDateFull));
        //$strHourFull= date("H",strtotime($strDateFull));
        //$strMinuteFull= date("i",strtotime($strDateFull));
        //$strSecondsFull= date("s",strtotime($strDateFull));
        if (empty($mode)) {
            # code...
            $strMonthFullCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThaiFull=$strMonthFullCut[$strMonthFull];
        }else{
            $strMonthThaiFull=date("m",strtotime($strDateFull));
        }
    
        // return "$strDay"." "."$strMonthThai"." "."$strYear";
        return "$strDayFull"." "."$strMonthThaiFull"." "."$strYearFull";
        //return "$strDayFull"." "."$strMonthThaiFull"." "."$strYearFull"." "."$strHourFull".":"."$strMinuteFull".":"."$strSecondsFull";
    }
        // $strDate = $result["come_date"];
    //     $strDate = 2020-02-15;
    // echo $strDate
    //////////////////////////////////////////////////////////  
 
?>