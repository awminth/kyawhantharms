<?php 

session_start();

date_default_timezone_set("Asia/Rangoon");

define('server_name',$_SERVER['HTTP_HOST']);

if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
    $chk_link = "https";
}else{
    $chk_link = "http";
}

define('root',__DIR__.'/');

define('roothtml',$chk_link."://".server_name."/kyawhantharms/");
$con=new mysqli("localhost","root","root","kyawhantharms");

define('curlink',basename($_SERVER['SCRIPT_NAME']));

//define('roothtml',$chk_link."://".server_name."/");
//$con=new mysqli("108.178.44.242","smgkyur_smgkyur","kyoungunity*007*","smgkyur_privateschoolsis");

mysqli_set_charset($con,"utf8");

$color = "primary";
$pay=array('KPay','Wave Money','KBZ Banking','AYA','CB');
$arr_gender = array('Male','Female');
$arr_usertype = array("Admin","User");

function load_shareholder(){
    global $con;
    $sql="SELECT * FROM tblshareholder WHERE AID IS NOT NULL";
    $result=mysqli_query($con,$sql) or die("Query fail.");
    $out="";
    while($row = mysqli_fetch_array($result)){
        $out.="<option value='{$row["AID"]}'>{$row["ShareHolderName"]}</option>";
    }
    return $out;
}

function enDate1($date){
    if($date!=NULL && $date!=''){
        $date = date_create($date);
        $date = date_format($date,"j F Y");
        return $date;
    }else{
        return "";
    }   
}

function enDate2($date){
    if($date!=NULL && $date!=''){
        $date = date_create($date);
        $date = date_format($date,"F Y");
        return $date;
    }else{
        return "";
    }   
}

function enDate3($date){
    if($date!=NULL && $date!=''){
        $date = date_create($date);
        $date = date_format($date,"M - Y");
        return $date;
    }else{
        return "";
    }   
}

function GetString($sql){
    global $con;
    $str="";   
    $result=mysqli_query($con,$sql) or die("Query Fail");
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
       $str= $row[0];
    }

    return $str;

}

function GetInt($sql){
    global $con;
    $str=0;   
    $result=mysqli_query($con,$sql) or die("Query Fail");
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
       $str= $row[0];
    }

    return $str;

}

function GetBool($sql){
    global $con;
    $str = false;   
    $result=mysqli_query($con,$sql) or die("Query Fail");
    if(mysqli_num_rows($result)>0){
        $str = true;
    }
    return $str;
}

function enDate($date){
    if($date!=NULL && $date!=''){
        $date = date_create($date);
        $date = date_format($date,"d-m-Y");
        return $date;
    }else{
        return "";
    }
   
}

function save_log($des){
    global $con;
    $dt = date("Y-m-d H:i:s");
    $userid = $_SESSION['kyawhantharms_userid'];
    $sql = "insert into tbllog (Description,UserID,Date) values ('{$des}','{$userid}','{$dt}')";
    mysqli_query($con,$sql);  
}

function custom_calendar($dt){
    $ym = date('Y-m');
    if($dt != ""){
        $ym = $dt;
    }

    // Check format
    $timestamp = strtotime($ym . '-01');
    if ($timestamp === false) {
        $ym = date('Y-m');
        $timestamp = strtotime($ym . '-01');
    }

    // Today
    $today = date('Y-m-j', time());  

    // Number of days in the month
    $day_count = date('t', $timestamp);
 
    // 0:Sun 1:Mon 2:Tue ...
    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
    //$str = date('w', $timestamp);

    // Create Calendar!!
    $weeks = array();
    $week = '';

    // create Add empty cell
    $week .= str_repeat('<td class="td-height"></td>', $str);
    // userid
    $userid = $_SESSION['userid'];

    for ( $day = 1; $day <= $day_count; $day++, $str++) {     
        $date = $ym . '-' . $day;
        // search event count from tbltodolist 
        $txt = '';
        $sql = "select count(AID) as cnt from tbltodolist 
        where Date(StartEvent)='{$date}'";
        $res = GetInt($sql);
        if($res > 0){
            $txt = '<br><br><span class="badge badge-primary text-center">'.$res.'&nbsp;Events</span>';
        }
     
        if ($today == $date) {
            $week .= '<td class="td-height today" id="btnevent" data-dt="'.$date.'">'.$day.$txt.'</td>';
        } else {
            $week .= '<td class="td-height" id="btnevent" data-dt="'.$date.'">'.$day.$txt.'</td>';
        }
     
        // End of the week OR End of the month
        if ($str % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // Add empty cell
                $week .= str_repeat('<td class="td-height"></td>', 6 - ($str % 7));
            }

            $weeks[] = '<tr>'.$week.'</tr>';

            // Prepare for new week
            $week = '';
        }
    }

    // show data
    foreach ($weeks as $week) {
        echo $week;
    }
}

function NumtoText($number){
    $array = [
        '1' => 'First',
        '2' => 'Second',
        '3' => 'Third',
        '4' => 'Four',
        '5' => 'Five',
        '6' => 'Six',
        '7' => 'Seven',
        '8' => 'Eight',
        '9' => 'Nine',
        '10' => 'Ten',
    ];
    return strtr($number, $array);
}

function toMyanmar($number){
    $array = [
        '0' => '၀',
        '1' => '၁',
        '2' => '၂',
        '3' => '၃',
        '4' => '၄',
        '5' => '၅',
        '6' => '၆',
        '7' => '၇',
        '8' => '၈',
        '9' => '၉',
    ];
    return strtr($number, $array);
}

function toEnglish($number){
    $array = [
        '၀' => '0',
        '၁' => '1',
        '၂' => '2',
        '၃' => '3',
        '၄' => '4',
        '၅' => '5',
        '၆' => '6',
        '၇' => '7',
        '၈' => '8',
        '၉' => '9',
    ];
    return strtr($number, $array);
}

function insertData_Fun($table, $data) {
    global $con;
    $con->begin_transaction();
    try{
        // array ရဲ့ key name ကိုသာ ယူ
        $columns = implode(", ", array_keys($data));
        // array length ရှိသလောက် ? ကို သတ်မှတ်ပေး
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        // array ရဲ့ value ကို ယူ
        $values = array_values($data);

        // types သတ်မှတ် (i = int, d = double, s = string)
        $types = "";
        foreach ($values as $v) {
            if (is_int($v)) {
                $types .= "i";
            } elseif (is_float($v)) {
                $types .= "d";
            } else {
                $types .= "s";
            }
        }

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $con->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        $stmt->bind_param($types, ...$values);

        $success = $stmt->execute();

        if (!$success) throw new Exception($stmt->error);
        // check row count is success
        $affected = $stmt->affected_rows;

        $con->commit();
        // return $con->insert_id; 
        return $affected > 0 ? true : false;
    } catch (Exception $e) {
        $con->rollback();
        return false;
    }    
}

function updateData_Fun($table, $data, $where) {
    global $con;
    $con->begin_transaction();
    try {
        // Step 1: Check if the AID exists first
        $whereKeys = array_keys($where);
        $whereValues = array_values($where);
        $whereClauseCheck = implode(" AND ", array_map(fn($col) => "$col=?", $whereKeys));

        $sqlCheck = "SELECT COUNT(*) FROM $table WHERE $whereClauseCheck";
        $stmtCheck = $con->prepare($sqlCheck);
        if (!$stmtCheck) {
            throw new Exception("Prepare failed: " . $con->error);
        }

        $typesCheck = "";
        foreach ($whereValues as $v) {
            if (is_int($v)) $typesCheck .= "i";
            elseif (is_float($v)) $typesCheck .= "d";
            else $typesCheck .= "s";
        }
        $stmtCheck->bind_param($typesCheck, ...$whereValues);
        $stmtCheck->execute();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->close();

        // If the AID does not exist, rollback and return a specific value
        if ($count == 0) {
            $con->rollback();
            return 0; // Return 0 for "No matching AID found"
        }

        // Step 2: Proceed with the UPDATE if the AID was found
        $setClause = implode(", ", array_map(fn($col) => "$col=?", array_keys($data)));
        $whereClause = implode(" AND ", array_map(fn($col) => "$col=?", array_keys($where)));

        $types = "";
        $values = array_merge(array_values($data), array_values($where));
        foreach ($values as $v) {
            if (is_int($v)) $types .= "i";
            elseif (is_float($v)) $types .= "d";
            else $types .= "s";
        }

        $sql = "UPDATE $table SET $setClause WHERE $whereClause";
        $stmt = $con->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $con->error);
        }

        $stmt->bind_param($types, ...$values);
        $success = $stmt->execute();
        if (!$success) {
            throw new Exception($stmt->error);
        }

        $con->commit();

        return 1; // 1 for success, 0 for no changes
        
    } catch (Exception $e) {
        $con->rollback();
        return $e->getMessage();
    }
}

function deleteData_Fun($table, $where) {
    global $con;
    $con->begin_transaction();
    try{
        /*
        $where = ["AID" => 2, "Status" => "yes", "UserID" => 5]
        */

        if (empty($where)) {
            die("WHERE condition is required to prevent full table delete!");
        }

        // WHERE clause
        $whereClause = implode(" AND ", array_map(fn($col) => "$col=?", array_keys($where)));

        // Detect types
        $types = "";
        $values = array_values($where);
        foreach ($values as $v) {
            if (is_int($v)) $types .= "i";
            elseif (is_float($v)) $types .= "d";
            else $types .= "s";
        }

        $sql = "DELETE FROM $table WHERE $whereClause";

        $stmt = $con->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }

        $stmt->bind_param($types, ...$values);
        $success = $stmt->execute();

        if (!$success) throw new Exception($stmt->error);
        // check row count is success
        $affected = $stmt->affected_rows;

        $con->commit();

        return $affected > 0 ? true : false;

    } catch (Exception $e) {
        $con->rollback();
        return false;
    }    
}

// function updateData_Fun1($table, $data, $where) {
//     global $con;
//     $con->begin_transaction();
//     try{
//         /*
//         $data = ["Description" => "Food", "Amount" => 1000]
//         $where = ["AID" => 2, "Status" => "yes", "UserID" => 5]
//         */

//         // SET clause
//         $setClause = implode(", ", array_map(fn($col) => "$col=?", array_keys($data)));

//         // WHERE clause
//         $whereClause = implode(" AND ", array_map(fn($col) => "$col=?", array_keys($where)));

//         // Detect types
//         $types = "";
//         $values = array_merge(array_values($data), array_values($where));
//         foreach ($values as $v) {
//             if (is_int($v)) $types .= "i";
//             elseif (is_float($v)) $types .= "d";
//             else $types .= "s";
//         }

//         $sql = "UPDATE $table SET $setClause WHERE $whereClause";

//         $stmt = $con->prepare($sql);
//         if (!$stmt) {
//             throw new Exception("Prepare failed: " . $con->error);
//         }

//         $stmt->bind_param($types, ...$values);
//         $success = $stmt->execute();

//         if (!$success) {
//             throw new Exception($stmt->error);
//         }

//         $affected = $stmt->affected_rows;

//         $con->commit();

//         // Check if the query was successful, then if rows were affected.
//         // A success means the query ran without a DB error.
//         // Returning 1 for any success, or 0 if no rows matched or were updated.
//         return $affected > 0 ? 1 : 0;

//     } catch (Exception $e) {
//         $con->rollback();
//         return $e->getMessage();
//     } 
// }




?>