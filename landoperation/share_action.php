<?php
include('../config.php');
include(root.'lib/vendor/autoload.php');

$action = $_POST['action'];

if($action == 'showone'){  
    // unset($_SESSION["go_permission_aid"]);
    // unset($_SESSION["go_permission_name"]);
    
    $projectcreateaid = $_POST["projectcreateaid"];
    $landoperationaid = $_POST["landoperationaid"];
    $limit_per_page=""; 
    if($_POST['entryvalue']==""){
        $limit_per_page=10; 
    } else{
        $limit_per_page=$_POST['entryvalue']; 
    }
    
    $page="";
    $no=0;
    if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];                
    }
    else{
        $page=1;                      
    }

    $offset = ($page-1) * $limit_per_page;                                               
   
    $search = $_POST['search'];
    $a = "";
    if($search != ''){  
        $a = " and (ShareHolderName like '%$search%' or SharePercent like '%$search%') ";
    }      
    $sql = "select * from tblprojectinverstment where ProjectCreateID='{$projectcreateaid}' 
    ".$a." order by AID desc limit {$offset},{$limit_per_page}";
        
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-hover table-bordered mb-0">
        <thead>
        <tr> 
            <th width="7%;">No</th>
            <th>ShareHolder Name</th>
            <th width="10%;" class="text-center">Action</th>      
        </tr>
        </thead>
        <tbody>
        ';
        $no = (($page - 1) * $limit_per_page);
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $out.="<tr>
                <td>{$no}</td>
                <td>{$row["ShareHolderName"]}</td>
                <td class='text-center'>
                    <a href='#' id='btnpay' class='dropdown-item'
                        data-aid='{$row['AID']}' 
                        data-landoperationaid='{$landoperationaid}'
                        data-shareholdername='{$row['ShareHolderName']}' 
                        data-sharepercent='{$row['SharePercent']}' >
                        <i class='ft-grid text-success'></i>
                        Pay</a>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        echo $out; 
        
    }
    else{
        $out.='
        <table class="table table-hover table-bordered mb-0">
        <thead>
        <tr>
            <th width="7%;">No</th>
            <th>User Name</th>
            <th>User Type</th>  
            <th width="10%;" class="text-center">Action</th>               
        </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="text-center">No data</td>
            </tr>
        </tbody>
        </table>
        ';
        echo $out;
    }

}

if($action == 'savepay'){
    $projectinvestmentaid = $_POST["projectinvestmentaid"];
    $landoperationaid = $_POST["landoperationaid"];
    $shareholdername = $_POST["shareholdername"];
    $sharelandno = $_POST["sharelandno"];
    $landoperationnetprofit = $_POST["landoperationnetprofit"];
    $shareholderamount = $_POST["shareholderamount"];
    $sharepercent = $_POST["sharepercent"];
    $sharefee = $_POST["sharefee"];
    $sharedt = $_POST["sharedt"];
    $data = [
        "LandOperationID" => $landoperationaid,
        "ProjectInverstmentID" => $projectinvestmentaid,
        "ShareInversterName" => $shareholdername,
        "ShareLandNum" => $sharelandno,
        "LandOperationNetProfit" => $landoperationnetprofit,
        "ShareHolderAmount" => $shareholderamount,
        "SharePercent" => $sharepercent,
        "ShareFee" => $sharefee,
        "ShareStatus" => "yes",
        "ShareDate" => $sharedt
    ];
    $result = insertData_Fun("tblrecordshare",$data);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် RecordShare အားအသစ်သွင်းသွားသည်။");
        echo 1;
    }else{
        echo 0;
    }
}

// Page Two
if($action == 'showtwo'){  
    // unset($_SESSION["go_permission_aid"]);
    // unset($_SESSION["go_permission_name"]);
    $limit_per_page=""; 
    if($_POST['entryvalue']==""){
        $limit_per_page=10; 
    } else{
        $limit_per_page=$_POST['entryvalue']; 
    }
    
    $page="";
    $no=0;
    if(isset($_POST["page_no"])){
        $page=$_POST["page_no"];                
    }
    else{
        $page=1;                      
    }

    $offset = ($page-1) * $limit_per_page;                                               
   
    $search = $_POST['search'];
    $a = "";
    if($search != ''){  
        $a = " and (ShareInversterName like '%$search%') ";
    }      
    $sql = "select * from tblrecordshare where AID is not null 
    ".$a." order by AID desc limit {$offset},{$limit_per_page}";
        
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-hover table-bordered mb-0">
        <thead>
        <tr> 
            <th width="7%;">No</th>
            <th>ShareHolder Name</th>
            <th>ShareLandNum</th>
            <th>LandOperationNetProfit</th>
            <th>ShareHolderAmount</th>
            <th>SharePercent</th>
            <th>ShareFee</th>
            <th>ShareDate</th>
            <th width="10%;" class="text-center">Action</th>      
        </tr>
        </thead>
        <tbody>
        ';
        $no = (($page - 1) * $limit_per_page);
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $out.="<tr>
                <td>{$no}</td>
                <td>{$row["ShareInversterName"]}</td>
                <td>{$row["ShareLandNum"]}</td>
                <td>{$row["LandOperationNetProfit"]}</td>
                <td>{$row["ShareHolderAmount"]}</td>
                <td>{$row["SharePercent"]}</td>
                <td>{$row["ShareFee"]}</td>
                <td>{$row["ShareDate"]}</td>
                <td class='text-center'>
                    <a href='#' id='btnedit'
                        data-aid='{$row['AID']}' 
                        data-shareholdername='{$row["ShareInversterName"]}'
                        data-sharelandno='{$row['ShareLandNum']}' 
                        data-landoperationnetprofit='{$row['LandOperationNetProfit']}' 
                        data-shareholderamount='{$row['ShareHolderAmount']}' 
                        data-sharepercent='{$row['SharePercent']}' 
                        data-sharefee='{$row['ShareFee']}' 
                        data-sharedt='{$row['ShareDate']}' >
                        <i class='la la-edit text-success'></i></a>
                    <a href='#' id='btndelete'
                        data-aid='{$row['AID']}'>
                        <i class='la la-trash text-danger'></i></a>
                </td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        echo $out; 
        
    }
    else{
        $out.='
        <table class="table table-hover table-bordered mb-0">
        <thead>
        <tr>
            <th width="7%;">No</th>
            <th>ShareHolder Name</th>
            <th>ShareLandNum</th>
            <th>LandOperationNetProfit</th>
            <th>ShareHolderAmount</th>
            <th>SharePercent</th>
            <th>ShareFee</th>
            <th>ShareDate</th>  
            <th width="10%;" class="text-center">Action</th>               
        </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="9" class="text-center">No data</td>
            </tr>
        </tbody>
        </table>
        ';
        echo $out;
    }

}

if($action == 'editpay'){
    $aid = $_POST["eaid"];
    $shareholdername = $_POST["eshareholdername"];
    $sharelandno = $_POST["esharelandno"];
    $landoperationnetprofit = $_POST["elandoperationnetprofit"];
    $shareholderamount = $_POST["eshareholderamount"];
    $sharepercent = $_POST["esharepercent"];
    $sharefee = $_POST["esharefee"];
    $sharedt = $_POST["esharedt"];
    $data = [
        "ShareInversterName" => $shareholdername,
        "ShareLandNum" => $sharelandno,
        "LandOperationNetProfit" => $landoperationnetprofit,
        "ShareHolderAmount" => $shareholderamount,
        "SharePercent" => $sharepercent,
        "ShareFee" => $sharefee,
        "ShareDate" => $sharedt
    ];   
    $where = [
        "AID" => $aid
    ];
    $result = updateData_Fun("tblrecordshare",$data,$where);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် RecordShare အား update လုပ်သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }
}

if($action == 'delete'){
    $aid = $_POST["aid"]; 
    $where = [
        "AID" => $aid
    ];
    $result = deleteData_Fun("tblrecordshare",$where);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် RecordShare အားဖျက်သွားသည်။");
        echo 1;
    }else{
        echo 0;
    }    
}

if($action == 'excel'){
    $search = $_POST['ser'];
    $a = "";
    if($search != ''){  
        $a = " and (ShareInversterName like '%$search%') ";
    }      
    $sql = "select * from tblrecordshare where AID is not null 
    ".$a." order by AID desc ";
    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "Record Share".date('d-m-Y').".xls";
    $out .= '<head><meta charset="UTF-8"></head>
        <table >  
            <tr>
                <td colspan="8" align="center"><h3>Record Share</h3></td>
            </tr>
            <tr><td colspan="8"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th> 
                <th style="border: 1px solid ;">ShareHolder Name</th>
                <th style="border: 1px solid ;">ShareLandNum</th>
                <th style="border: 1px solid ;">LandOperationNetProfit</th>
                <th style="border: 1px solid ;">ShareHolderAmount</th>
                <th style="border: 1px solid ;">SharePercent</th>
                <th style="border: 1px solid ;">ShareFee</th>
                <th style="border: 1px solid ;">ShareDate</th>
       
            </tr>';
    if(mysqli_num_rows($result) > 0){
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td> 
                    <td style="border: 1px solid ;">'.$row["ShareInversterName"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareLandNum"].'</td>
                    <td style="border: 1px solid ;">'.$row["LandOperationNetProfit"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareHolderAmount"].'</td>
                    <td style="border: 1px solid ;">'.$row["SharePercent"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareFee"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareDate"].'</td>                 
                </tr>';
        }          
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" colspan="8" align="center">No data found</td>   
            </tr>';
        
    }
    $out .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename='.$fileName);
    echo $out;
}

if($action == 'pdf'){
    $search = $_POST['ser'];
    $a = "";
    if($search != ''){  
        $a = " and (ShareInversterName like '%$search%') ";
    }      
    $sql = "select * from tblrecordshare where AID is not null 
    ".$a." order by AID desc ";
    $result = mysqli_query($con,$sql);
    $out="";
    $out .= '<h3 align="center">Record Share</h3>
    <head><meta charset="UTF-8"></head>
        <table >  
            <tr>  
                <th style="border: 1px solid ;">No</th> 
                <th style="border: 1px solid ;">ShareHolder Name</th>
                <th style="border: 1px solid ;">ShareLandNum</th>
                <th style="border: 1px solid ;">LandOperationNetProfit</th>
                <th style="border: 1px solid ;">ShareHolderAmount</th>
                <th style="border: 1px solid ;">SharePercent</th>
                <th style="border: 1px solid ;">ShareFee</th>
                <th style="border: 1px solid ;">ShareDate</th>
            </tr>';
    if(mysqli_num_rows($result) > 0){
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td> 
                    <td style="border: 1px solid ;">'.$row["ShareInversterName"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareLandNum"].'</td>
                    <td style="border: 1px solid ;">'.$row["LandOperationNetProfit"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareHolderAmount"].'</td>
                    <td style="border: 1px solid ;">'.$row["SharePercent"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareFee"].'</td>
                    <td style="border: 1px solid ;">'.$row["ShareDate"].'</td>                    
                </tr>';
        }          
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" colspan="8" align="center">No data found</td>   
            </tr>';
        
    }
    $out .= '</table>';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont   = true;  
    $stylesheet = file_get_contents(roothtml.'lib/mypdfcss.css'); // external css
    $mpdf->WriteHTML($stylesheet,1);  
    $mpdf->WriteHTML($out,2);
    $file = 'RecordShare_'.date("d_m_Y").'.pdf';
    $mpdf->output($file,'D');
    
}



?>