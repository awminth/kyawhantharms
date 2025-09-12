<?php
include('../config.php');
include(root.'lib/vendor/autoload.php');

$action = $_POST['action'];

if($action == "savecreateproject"){
    $projectid = $_POST["projectid"];
    $projectname = $_POST["projectname"];
    $landinverstmentfee = $_POST["landinverstmentfee"];
    $operationfee = $_POST["operationfee"];
    $paperfee = $_POST["paperfee"];
    $layerfee = $_POST["layerfee"];
    $villageadminfee = $_POST["villageadminfee"];
    $totalinverstmentfee = $_POST["totalinverstmentfee"];
    $sqrtfeet = $_POST["sqrtfeet"];
    $paperstorename = $_POST["paperstorename"];
    $constructdate = $_POST["constructdate"];
    $maininvestorname = $_POST["maininvestorname"];
    $rmk = $_POST["rmk"];
    $dt = $_POST["dt"];
    $labourname = $_POST["labourname"];
    $depositfee = $_POST["depositfee"];
    $depositdate = $_POST["depositdate"];
    $labourrmk = $_POST["labourrmk"];

    $data = [
        "ProjectID" => $projectid,
        "ProjectName" => $projectname,
        "LandInverstmentFee" => $landinverstmentfee,
        "OperationFee" => $operationfee,
        "PaperFee" => $paperfee,
        "LayerFee" => $layerfee,
        "VillageAdminFee" => $villageadminfee,
        "TotalInverstmentFee" => $totalinverstmentfee,
        "SqrtFeet" => $sqrtfeet,
        "PaperStoreName" => $paperstorename,
        "ContrustDate" => $constructdate,
        "MainInversterName" => $maininvestorname,
        "Rmk" => $rmk,
        "Date" => $dt,
        "LabourName" => $labourname,
        "DepositFee" => $depositfee,
        "DepositDate" => $depositdate,
        "LabourRmk" => $labourrmk
    ];
    $result = insertData_Fun("tblprojectcreate",$data);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် Project Name [".$projectname."] အမည်ဖြင့်Projectတစ်ခုအသစ်ထည့်သွားသည်။");
        echo 1;
    }
    else{
        echo 0;
    }
}

if($action == 'show_data'){
    unset($_SESSION["go_record_patientbrcode"]);
    unset($_SESSION["go_record_patientid"]);
    unset($_SESSION["go_record_patientname"]);
    unset($_SESSION["go_record_vno"]);
    unset($_SESSION["go_record_totalamt"]);
    unset($_SESSION["go_record_action"]);
    $limit_per_page=""; 
    if($_POST['entryvalue']==""){
        $limit_per_page=20; 
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
        $a = " and (ProjectName like '%$search%' or MainInversterName like '%$search%') ";
    }    
    
    $sql = "select * from tblprojectcreate where AID is not null ".$a."
    order by AID desc limit {$offset},{$limit_per_page}";
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    $out.='
        <div id="doctors-list">
            <div class="row match-height">';
    if(mysqli_num_rows($result) > 0){
        $no = (($page - 1) * $limit_per_page);
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $out.='
            <div class=" col-xl-3 col-lg-4 col-md-6">
                <div class="card border-top-warning border-top-3" style="height: 270px;">
                    <div class="card-body">
                        <h6 class="card-title font-large-1 mb-2 text-center text-info">'.$row["ProjectName"].'</h6>
                        <p class="card-text card font-medium-1 text-center mb-0">'.$row["MainInversterName"].'</p>
                        <p class="font-small-3 mb-2 text-center">TotalInvestmentFee - '.$row["TotalInverstmentFee"].'</p>
                        <p class="font-small-3 mb-2 text-center">ConstructDate - '.$row["ContrustDate"].'</p>
                        

                    </div>
                    <div class="card-footer mx-auto">
                        <a href="#" class="btn btn-outline-danger btn-sm" 
                            id="btnaddinvestors" 
                            data-projectcreateid="'.$row["AID"].'">
                            Add Inverstors</a>
                        <a href="#" class="btn btn-outline-warning btn-sm"
                            id="btnedit" 
                            data-projectcreateid="'.$row["AID"].'"  >
                            Edit</a>
                    </div>
                </div>
            </div>
            ';
        }
        $out.="</div>";
        $out.="</div><br><br>";

        $sql_total = "select * from tblprojectcreate where AID is not null ".$a."
        order by AID desc" ;
        $record = mysqli_query($con,$sql_total) or die("fail query");
        $total_record = mysqli_num_rows($record);
        $total_links = ceil($total_record/$limit_per_page);

        $out.='<div class="float-left"><p>Total Records -  ';
        $out.=$total_record;
        $out.='</p></div>';

        $out.='<div class="float-right">
                <ul class="pagination">
            ';      
        
        $previous_link = '';
        $next_link = '';
        $page_link = '';

        if($total_links > 4){
            if($page < 5){
                for($count = 1; $count <= 5; $count++)
                {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            }else{
                $end_limit = $total_links - 5;
                if($page > $end_limit){
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for($count = $end_limit; $count <= $total_links; $count++)
                    {
                        $page_array[] = $count;
                    }
                }else{
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for($count = $page - 1; $count <= $page + 1; $count++)
                    {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }            

        }else{
            for($count = 1; $count <= $total_links; $count++)
            {
                $page_array[] = $count;
            }
        }

        for($count = 0; $count < count($page_array); $count++){
            if($page == $page_array[$count]){
                $page_link .= '<li class="page-item active">
                                    <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
                                </li>';

                $previous_id = $page_array[$count] - 1;
                if($previous_id > 0){
                    $previous_link = '<li class="page-item">
                                            <a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a>
                                    </li>';
                }
                else{
                    $previous_link = '<li class="page-item disabled">
                                            <a class="page-link" href="#">Previous</a>
                                    </li>';
                }

                $next_id = $page_array[$count] + 1;
                if($next_id > $total_links){
                    $next_link = '<li class="page-item disabled">
                                        <a class="page-link" href="#">Next</a>
                                </li>';
                }else{
                    $next_link = '<li class="page-item">
                                    <a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a>
                                </li>';
                }
            }else{
                if($page_array[$count] == '...')
                {
                    $page_link .= '<li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li> ';
                }else{
                    $page_link .= '<li class="page-item">
                                        <a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
                                    </li> ';
                }
            }
        }

        $out .= $previous_link . $page_link . $next_link;

        $out .= '</ul></div>';

        echo $out; 
        
    }
    else{
        $out.='
        <div style="width:100%" class="text-center">
            <div class="alert alert-warning mb-2" role="alert" style="height:100px;">
                <strong>Warning!</strong> No data found.
            </div>
        </div>
        ';
        echo $out;
    }
}

if($action == "select_shareholder"){
    $shareholderid = $_POST["shareholderid"];
    $sharepercent = GetString("SELECT SharePercent FROM tblshareholder WHERE AID='{$shareholderid}'");
    echo $sharepercent;
}

if($action == "addinvestor"){
    $projectcreateid = $_POST["projectcreateid"];
    $shareholderid = $_POST["shareholder"];
    $shareholdername = GetString("SELECT ShareHolderName FROM tblshareholder WHERE AID='{$shareholderid}'");
    $chk = GetInt("SELECT InversterAmount FROM tblprojectcreate WHERE AID='{$projectcreateid}'");
    $investoramt = $chk + 1;
    $sql_one = "UPDATE tblprojectcreate SET InversterAmount = '{$investoramt}', 
    InversterName = CONCAT(IFNULL(InversterName, ''), CASE WHEN InversterName 
    IS NOT NULL THEN ',' ELSE '' END, '{$shareholdername}')
    WHERE AID = '{$projectcreateid}'";

    $sql = "UPDATE tblprojectcreate
    SET InversterAmount = '{$investoramt}', 
    InversterName = CONCAT(
    CASE WHEN InversterName IS NOT NULL THEN CONCAT(InversterName, ',') ELSE '' END,
    '{$shareholdername}')
    WHERE AID = '{$projectcreateid}'";
    $result = mysqli_query($con,$sql);
    if($result){
        echo 1;
    }
    else{
        echo 0;
    }
}

?>