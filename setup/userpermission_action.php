<?php
include('../config.php');

$action = $_POST["action"];

if($action == 'save_permission'){  
    $aid = $_POST['aid'];
    $A1 = isset($_POST["A1"])?1:0;
    $A2 = isset($_POST["A2"])?1:0;

    $M1 = isset($_POST["M1"])?1:0;
    if($M1 == 1){
        $A3 = isset($_POST["A3"])?1:0;
        $A4 = isset($_POST["A4"])?1:0;
        $A5 = isset($_POST["A5"])?1:0;
    }else{
        $A3 = 0;
        $A4 = 0;
        $A5 = 0;
    }  

    $M2 = isset($_POST["M2"])?1:0;
    if($M2 == 1){
        $A6 = isset($_POST["A6"])?1:0;
        $A7 = isset($_POST["A7"])?1:0;
        $A8 = isset($_POST["A8"])?1:0;
        $A9 = isset($_POST["A9"])?1:0;
    }else{
        $A6 = 0;
        $A7 = 0;
        $A8 = 0;
        $A9 = 0;
    } 

    $M3 = isset($_POST["M3"])?1:0;
    if($M3 == 1){
        $A10 = isset($_POST["A10"])?1:0;
        $A11 = isset($_POST["A11"])?1:0;
        $A12 = isset($_POST["A12"])?1:0;
        $A13 = isset($_POST["A13"])?1:0;
    }else{
        $A10 = 0;
        $A11 = 0;
        $A12 = 0;
        $A13 = 0;
    } 

    $A14 = isset($_POST["A14"])?1:0;
    $A15 = isset($_POST["A15"])?1:0;

    $sql = "update tbluser set A1={$A1},A2={$A2},A3={$A3},A4={$A4},A5={$A5},
    A6={$A6},A7={$A7},A8={$A8},A9={$A9},A10={$A10},A11={$A11},A12={$A12},
    A13={$A13},A14={$A14},A15={$A15},
    M1={$M1},M2={$M2},M3={$M3}   
    where AID={$aid}" ;
    // echo $sql;
    if(mysqli_query($con,$sql)){
        save_log($_SESSION["tts_username"]." သည် user permission အား edit သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }
}



?>