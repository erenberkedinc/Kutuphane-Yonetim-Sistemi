<?php
        $atla = $_POST['atla'];
        $atla=$atla." days";
        echo $atla;
        session_start();
        $date=$_SESSION["date"];

        $_SESSION["date"]=date('Y-m-d', strtotime($date. ' +'.$atla));
        echo $_SESSION["date"];


?>