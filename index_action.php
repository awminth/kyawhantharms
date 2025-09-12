<?php 
include("config.php");

$action = $_POST["action"];

if($action == "login"){
    $username = $_POST["username"];
    $password = $_POST["password"];    

    $sql = "select * from tbluser where UserName='{$username}' and Password='{$password}'";
    $result = mysqli_query($con,$sql);     
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION["kyawhantharms_userid"] = $row['AID'];
        $_SESSION["kyawhantharms_username"] = $row['UserName'];                  
        $_SESSION["kyawhantharms_usertype"] = $row['UserType'];
        $_SESSION["kyawhantharms_userpassword"] = $row['Password'];  

        // for slip address
        // $sql_slip = "select * from tblsiteaddress limit 1";
        // $res_slip = mysqli_query($con,$sql_slip);
        // if(mysqli_num_rows($res_slip) > 0){
        //     $row_slip = mysqli_fetch_array($res_slip);
        //     $_SESSION["kyawhantharms_site_aid"] = $row_slip['AID'];  
        //     $_SESSION["kyawhantharms_site_name"] = $row_slip['Name'];                 
        //     $_SESSION["kyawhantharms_site_address"] = $row_slip['Address'];
        //     $_SESSION["kyawhantharms_site_phno"] = $row_slip['PhoneNo']; 
        // }

        //remember username and password
        if(!empty($_POST['remember'])){
            setcookie("member_login",$row['UserName'],time()+(10*365*24*60*60));
            setcookie("member_password",$row['Password'],time()+(10*365*24*60*60));
        }
        else{
            if(isset($_COOKIE['member_login'])){
                setcookie("member_login",'');
            }
            if(isset($_COOKIE['member_password'])){
                setcookie("member_password",'');
            }
        }
        save_log($row['UserName']." သည် Login ဝင်သွားသည်");
        echo 1;
    }else{
        session_unset();
        echo 0;
    }
}

if($action == "logout"){   
    save_log($_SESSION['kyawhantharms_username']." သည် Logout လုပ်သွားသည်");
    unset($_SESSION["kyawhantharms_userid"]);
    unset($_SESSION["kyawhantharms_username"]);
    unset($_SESSION["kyawhantharms_usertype"]);
    unset($_SESSION["kyawhantharms_userpassword"]);
    // unset($_SESSION["kyawhantharms_site_name"]);                 
    // unset($_SESSION["kyawhantharms_site_address"]);
    // unset($_SESSION["kyawhantharms_site_phno"]);
    unset($_SESSION["edit_purchase_aid"]); 
    unset($_SESSION["edit_salelist_vno"]); 
    echo 1;

}





?>