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
    $new_image_filename = '';
    $new_pdf_filename = '';

    // PDF file ကို စစ်ဆေးပြီး upload လုပ်ခြင်း
    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['pdf_file']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['pdf_file']['tmp_name'];
        $valid_pdf_extensions = array("pdf", "PDF");

        if(in_array($extension, $valid_pdf_extensions)) {
            $new_pdf_filename = date("YmdHis") . "_doc." . $extension; // ပုံနဲ့ နာမည်မတူအောင် ပြောင်းထား
            $new_path = root . "upload/documents/" . $new_pdf_filename; // PDF အတွက် folder သီးသန့်ထား
            move_uploaded_file($file, $new_path);
        }
    }

    // Image file ကို စစ်ဆေးပြီး upload လုပ်ခြင်း
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['image_file']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['image_file']['tmp_name'];
        $valid_image_extensions = array("jpg","jpeg","png","JPG","PNG","JPEG");

        if(in_array($extension, $valid_image_extensions)) {
            $new_image_filename = date("YmdHis") . "." . $extension;
            $new_path = root . "upload/images/" . $new_image_filename;
            move_uploaded_file($file, $new_path);
        }
    }

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
        "PaperStoreFile" => $new_pdf_filename,
        "RecordPhoto" => $new_image_filename,
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

if($action == "editcreateproject"){
    $aid = $_POST["eaid"];
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

    $where = [
        "AID" => $aid
    ];

    $result = updateData_Fun("tblprojectcreate",$data,$where);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် Project Name [".$projectname."] အမည်ဖြင့်ProjectအားEditလုပ်သွားသည်။");
        echo 1;
    }
    else{
        echo 0;
    }
}

if($action == 'show_data'){
    unset($_SESSION["edit_createprojectaid"]);
    unset($_SESSION["landoperation_createprojectaid"]);
    unset($_SESSION["preedit_landoperationaid"]);
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
        $a .= " and (ProjectName like '%$search%' or MainInversterName like '%$search%') ";
    }  
    
    $from = $_POST['dtfrom'];
    $to = $_POST['dtto'];
    if($from != "" || $to != ""){
        $a .= " and Date(Date)>='{$from}' and Date(Date)<='{$to}' ";
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
                        <p class="card-text card font-medium-1 text-center mb-0 text-primary">MainInvestorName - '.$row["MainInversterName"].'</p>
                        <p class="card-text card font-medium-1 text-center mb-0 text-success">Shares - '.$row["InversterName"].'</p>
                        <p class="text-center text-warning">TotalInvestmentFee - '.$row["TotalInverstmentFee"].'</p>
                        <p class="font-small-3 text-center text-dark">ConstructDate - '.$row["ContrustDate"].'</p>
                        

                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <a href="#" class="btn btn-outline-warning btn-sm me-1"
                                    id="btneditcreateproject" 
                                    data-projectcreateid="'.$row["AID"].'"  >
                                    Edit</a>
                                <a href="#" class="btn btn-outline-warning btn-sm me-1"
                                    id="btndelete" 
                                    data-aid="'.$row["AID"].'"  >
                                    Delete</a>
                            </div>
                            <div class="col-12">
                                <a href="#" class="btn btn-outline-danger btn-sm me-1" 
                                    id="btnaddinvestors" 
                                    data-projectcreateid="'.$row["AID"].'">
                                    Add Inverstors</a>';
                            if($row["SoldStatus"] == "no") {
                            $out .= '
                                <a href="#" class="btn btn-outline-info btn-sm"
                                    id="btnlandoperation" 
                                    data-projectcreateid="'.$row["AID"].'"  >
                                    Land Operations</a>';
                            }
                        $out .= ' 
                            </div>      
                        </div>
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
    $projectid = GetInt("SELECT ProjectID FROM tblprojectcreate WHERE AID='{$projectcreateid}'");
    $shareholderid = $_POST["shareholder"];
    $shareholdername = GetString("SELECT ShareHolderName FROM tblshareholder WHERE AID='{$shareholderid}'");
    $sharepercent = $_POST["sharepercent"];
    $chk = GetInt("SELECT InversterAmount FROM tblprojectcreate WHERE AID='{$projectcreateid}'");
    $investoramt = $chk + 1;

    $sql = "UPDATE tblprojectcreate SET InversterAmount = '{$investoramt}', 
    InversterName = CONCAT(CASE WHEN InversterName IS NOT NULL 
    THEN CONCAT(InversterName, ',') ELSE '' END, '{$shareholdername}') 
    WHERE AID = '{$projectcreateid}'";
    $result_one = mysqli_query($con,$sql);
    if($result_one){
        $data = [
            "ProjectCreateID" => $projectcreateid,
            "ShareHolderID" => $shareholderid,
            "ShareHolderName" => $shareholdername,
            "SharePercent" => $sharepercent
        ];
        $result_two = insertData_Fun("tblprojectinverstment",$data);
        if($result_two){
            echo 1;
        }
        else{
            echo 2;
        }
    }
    else{
        echo 0;
    }
}

if ($action == "preeditcreateproject") {
    if (isset($_POST["editprojectid"])) {
        $projectcreateid = $_POST["editprojectid"];
        $_SESSION["edit_createprojectaid"] = $projectcreateid;
        echo 1;
    } else {
        echo 0;
    }
}

if($action == "delete"){
    $aid = $_POST["aid"];
    $sql_chk = "select AID from tbllandoperation where ProjectCreateID = '{$aid}'";
    $res_chk = mysqli_query($con,$sql_chk);
    if(mysqli_num_rows($res_chk) > 0){
        $where_one  = [
            "ProjectCreateID" => $aid
        ];
        $result_one = deleteData_Fun("tbllandoperation",$where_one);
    }
    $where_two = [
        "AID" => $aid
    ];
    $result_two = deleteData_Fun("tblprojectcreate",$where_two);
    if($result_two){
        save_log($_SESSION["kyawhantharms_username"]." သည် Projectအား deleteလုပ်သွားသည်။");
        echo 1;
    }
    else{
        echo 0;
    }
}

if ($action == "prelandoperation") {
    if (isset($_POST["landprojectid"])) {
        $projectcreateid = $_POST["landprojectid"];
        $_SESSION["landoperation_createprojectaid"] = $projectcreateid;
        echo 1;
    } else {
        echo 0;
    }
}

?>