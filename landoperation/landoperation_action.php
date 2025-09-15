<?php
include('../config.php');
include(root.'lib/vendor/autoload.php');

$action = $_POST['action'];

if($action == "presave"){
    $projectcreateid = $_POST["projectcreateid"];
    $projectname = $_POST["projectname"];
    $landmanageamt = $_POST["landmanageamt"];
    $landnumber = $_POST["landnumber"];
    $sellprice = $_POST["sellprice"];
    $confirmprice = $_POST["confirmprice"];
    $agentname = $_POST["agentname"];
    $agentstatus = "no";
    if($agentname != ""){
        $agentstatus = "yes";
    }
    $agentfee = $_POST["agentfee"];
    $otherfee = $_POST["otherfee"] == "" ? 0 : $_POST["otherfee"];
    $agentfeedt = $_POST["agentfeedt"];
    $rmk = $_POST["rmk"];
    $netprofit = $_POST["netprofit"];
    $buyername = $_POST["buyername"];
    $dt = $_POST["dt"];
    $paymentplan = $_POST["paymentplan"];
    $totalpay = 0;
    if($paymentplan == "Cash"){
        $totalpay = $_POST["totalpay"];
    }
    $new_image_filename = '';
    $new_pdf_filename = '';
    $remainpayment = $confirmprice - $totalpay;
    $hidpdf_file = $_POST["hidpdf_file"];
    $hidimage_file = $_POST["hidimage_file"];

    //For Edit ////////////////////////////////////////////////////////
    $landoperationaid = $_POST["landoperationaid"];
    if($landoperationaid != 0){
        $wheredel = [
            "AID" => $landoperationaid
        ];
        $resultdel = deleteData_Fun("tbllandoperation",$wheredel);
        if($resultdel){
            if($paymentplan == "Cash"){
                $wheredel_installment = [
                    "LandOperationID" => $landoperationaid,
                    "ProjectCreateID" => $projectcreateid
                ];
                $resdel_installment = deleteData_Fun("tbllandoperationinstallment",$wheredel_installment);
            }
        }
    }

    ///////////////////////////////////////////////////////////////////

    // PDF file ကို စစ်ဆေးပြီး upload လုပ်ခြင်း
    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES['pdf_file']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['pdf_file']['tmp_name'];
        $valid_pdf_extensions = array("pdf", "PDF");

        if(in_array($extension, $valid_pdf_extensions)) {
            $new_pdf_filename = date("YmdHis") . "_doc." . $extension; // ပုံနဲ့ နာမည်မတူအောင် ပြောင်းထား
            $new_path = root . "upload/documents/" . $new_pdf_filename; // PDF အတွက် folder သီးသန့်ထား            
            if(move_uploaded_file($file, $new_path)){
                if($hidpdf_file != ""){
                    unlink(root. "upload/documents/" . $hidpdf_file);
                }
            }
            
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
            if(move_uploaded_file($file, $new_path)){
                if($hidimage_file != ""){
                    unlink(root. "upload/images/" . $hidimage_file);
                }
            }
        }
    }

    $data = [
        "ProjectCreateID" => $projectcreateid,
        "LandManageAmount" => $landmanageamt,
        "LandNumber" => $landnumber,
        "SalePrice" => $sellprice,
        "ConfirmPrice" => $confirmprice,
        "BuyerName" => $buyername,
        "Date" => $dt,
        "PaymentPlan" => $paymentplan,
        "TotalPayment" => $totalpay,
        "RemainPayment" => $remainpayment,
        "ContrustFile" => $new_pdf_filename,
        "RecordPhoto" => $new_image_filename,
        "AgentName" => $agentname,
        "AgentFee" => $agentfee,
        "OtherFee" => $otherfee,
        "AgentStatus" => $agentstatus,
        "AgentFeeDate" => $agentfeedt,
        "AgentRmk" => $rmk,
        "NetProfit" => $netprofit
    ];
    $result = insertData_Fun("tbllandoperation",$data);
    if($result){
        $data_one = [
            "SoldStatus" => "yes"
        ];
        $where_one = [
            "AID" => $projectcreateid
        ];
        $result_one = updateData_Fun("tblprojectcreate",$data_one,$where_one);
        if($result_one){
            save_log($_SESSION["kyawhantharms_username"]." သည် Project Name [".$projectname."] အမည်ဖြင့်Land Operationတစ်ခုအသစ်ထည့်သွားသည်။");
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        echo 0;
    }
}

if($action == 'show_data'){
    unset($_SESSION["preedit_landoperationaid"]);
    unset($_SESSION["share_projectcreateaid"]);
    unset($_SESSION["share_landoperationaid"]);
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
        $a .= " and (LandNumber like '%$search%') ";
    }  
    
    $from = $_POST['dtfrom'];
    $to = $_POST['dtto'];
    if($from != "" || $to != ""){
        $a .= " and Date(Date)>='{$from}' and Date(Date)<='{$to}' ";
    } 
    
    $sql = "select * from tbllandoperation where AID is not null ".$a."
    order by AID desc limit {$offset},{$limit_per_page}";
    
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    $out.='
        <div id="doctors-list">
            <div class="row match-height">';
    if(mysqli_num_rows($result) > 0){
        $no = (($page - 1) * $limit_per_page);
        while($row = mysqli_fetch_array($result)){
            $projectname = GetString("select ProjectName from tblprojectcreate where AID='{$row["ProjectCreateID"]}'");
            $no=$no+1;
            $out.='
            <div class=" col-xl-3 col-lg-4 col-md-6">
                <div class="card border-top-primary border-top-3" style="height: 270px;">
                    <div class="card-body">
                        <h6 class="card-title font-large-1 mb-2 text-center text-info">'.$projectname.'</h6>
                        <p class="card-text card font-medium-1 text-center mb-0 text-primary">LandManageAmount - '.$row["LandManageAmount"].'</p>
                        <p class="card-text card font-medium-1 text-center mb-0 text-success">LandNumber - '.$row["LandNumber"].'</p>
                        <p class="text-center text-warning">SalePrice - '.number_format($row["SalePrice"]).'</p>
                        <p class="text-center text-dark">ConfirmPrice - '.number_format($row["ConfirmPrice"]).'</p>
                        <p class="text-center text-dark">TotalPay - '.number_format($row["TotalPayment"]).'</p>
                        

                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <a href="#" class="btn btn-outline-danger btn-sm me-1" 
                                    id="btnedit" 
                                    data-landoperationaid="'.$row["AID"].'">
                                    Edit</a>
                                <a href="#" class="btn btn-outline-warning btn-sm me-1"
                                    id="btndelete" 
                                    data-aid="'.$row["AID"].'">
                                    Delete</a>
                                <a href="#" class="btn btn-outline-info btn-sm"
                                    id="btnshare" 
                                    data-landoperationaid="'.$row["AID"].'">
                                    Share</a>
                            </div>';
                            if($row["PaymentPlan"] == "Installment"){
                            $out .= '
                            <div class="col-12">
                                <a href="#" class="btn btn-outline-success btn-sm me-1"
                                    id="btninstallment" 
                                    data-landoperationaid="'.$row["AID"].'"
                                    data-projectcreateaid="'.$row["ProjectCreateID"].'"
                                    data-projectname="'.$projectname.'"
                                    data-buyername="'.$row["BuyerName"].'">
                                    Installment</a>
                            </div>';
                            }
                        $out .= '
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

if($action == "pre_edit"){
    $landoperationaid = $_POST["landoperationaid"];
    $_SESSION["preedit_landoperationaid"] = $landoperationaid;
    echo 1;
}

if($action == "delete"){
    $aid = $_POST["aid"];
    $where = [
        "AID" => $aid
    ];
    $result = deleteData_Fun("tbllandoperation",$where);
    if($result){
        save_log($_SESSION["kyawhantharms_username"]." သည် Land Operationအား deleteလုပ်သွားသည်။");
        echo 1;
    }
    else{
        echo 0;
    }
}

if($action == "goshare"){
    $landoperationaid = $_POST["landoperationaid"];
    $projectcreateaid = GetInt("select ProjectCreateID from tbllandoperation where AID='{$landoperationaid}'");
    $_SESSION["share_projectcreateaid"] = $projectcreateaid;
    $_SESSION["share_landoperationaid"] = $landoperationaid;
    echo 1;
}

if($action == "go_installment"){
    $landoperationaid = $_POST["landoperationaid"];
    $projectcreateaid = $_POST["projectcreateaid"];
    $projectname = $_POST["projectname"];
    $out = "";
    $out.='
        <table class="table table-hover table-bordered mb-0">
        <thead>
        <tr> 
            <th width="7%;">No</th>
            <th>Buyer Name</th>
            <th>Deposit Fee</th>  
            <th>Deposit Date</th>  
            <th>Remark</th>  
            <th width="10%;" class="text-center">Action</th>      
        </tr>
        </thead>
        <tbody>';
    $sql = "select * from tbllandoperationinstallment where LandOperationID = '{$landoperationaid}' 
    and ProjectCreateID = '{$projectcreateaid}'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $no = 0;
        while($row = mysqli_fetch_array($result)){
            $no += 1;
            $out .= '
            <tr>
                <td>'.$no.'</td>
                <td>'.$row["BuyerName"].'</td>
                <td>'.number_format($row["DepositFee"]).'</td>
                <td>'.enDate($row["DepositDate"]).'</td>
                <td>'.$row["Rmk"].'</td>
                <td class="text-center">
                    <a href="#" id="btneditinstallment" 
                    data-aid="'.$row["AID"].'"
                    data-buyername="'.$row["BuyerName"].'"
                    data-depositfee="'.$row["DepositFee"].'"
                    data-depositdate="'.$row["DepositDate"].'"
                    data-rmk="'.$row["Rmk"].'">
                        <i class="la la-edit"></i>
                    </a>
                    <a href="#" id="btndeleteinstallment"
                    data-aid="'.$row["AID"].'"
                    data-projectcreateaid="'.$row["ProjectCreateID"].'"
                    data-landoperationaid="'.$row["LandOperationID"].'">
                        <i class="la la-trash text-danger"></i>
                    </a>
                </td>
            </tr>
            ';
        }
    }
    else{
        $out .= '
            <tr>
                <td colspan="6" class="text-center">No Data</td>
            </tr>
            ';
    }
    $out.= '
        </tbody>
        </table>
        ';
    echo $out;
}

if($action == "saveinstallment"){
    $landoperationaid = $_POST["landoperationaid"];
    $projectcreateaid = $_POST["projectcreateaid"];
    $buyername = $_POST["buyername"];
    $depositfee = $_POST["depositfee"];
    $depositdt = $_POST["depositdt"];
    $rmk = $_POST["rmk"];
    $data_one = [
        "LandOperationID" => $landoperationaid,
        "ProjectCreateID" => $projectcreateaid,
        "BuyerName" => $buyername,
        "DepositFee" => $depositfee,
        "DepositDate" => $depositdt,
        "Rmk" => $rmk
    ];
    $result_one = insertData_Fun("tbllandoperationinstallment",$data_one);
    if($result_one){
        $totalpayment = GetInt("SELECT SUM(DepositFee) FROM tbllandoperationinstallment WHERE 
        LandOperationID = '{$landoperationaid}' AND ProjectCreateID='{$projectcreateaid}'");
        $confirmprice = GetInt("SELECT ConfirmPrice FROM tbllandoperation WHERE AID='{$landoperationaid}'");
        $remainpayment = $confirmprice - $totalpayment;
        $data_two = [
            "BuyerName" => $buyername,
            "TotalPayment" => $totalpayment,
            "RemainPayment" => $remainpayment
        ];
        $where = [
            "AID" => $landoperationaid
        ];
        $result_two = updateData_Fun("tbllandoperation",$data_two,$where);
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

if($action == "editinstallment"){
    $installmentaid = $_POST["installmentaid"];
    $projectcreateaid = $_POST["projectcreateaid"];
    $landoperationaid = $_POST["landoperationaid"];
    $buyername = $_POST["buyername"];
    $depositfee = $_POST["depositfee"];
    $depositdt = $_POST["depositdt"];
    $rmk = $_POST["rmk"];
    $data_one = [
        "BuyerName" => $buyername,
        "DepositFee" => $depositfee,
        "DepositDate" => $depositdt,
        "Rmk" => $rmk
    ];
    $where_one = [
        "AID" => $installmentaid
    ];
    $result_one = updateData_Fun("tbllandoperationinstallment",$data_one,$where_one);
    if($result_one){
        $totalpayment = GetInt("SELECT SUM(DepositFee) FROM tbllandoperationinstallment WHERE 
        LandOperationID = '{$landoperationaid}' AND ProjectCreateID='{$projectcreateaid}'");
        $confirmprice = GetInt("SELECT ConfirmPrice FROM tbllandoperation WHERE AID='{$landoperationaid}'");
        $remainpayment = $confirmprice - $totalpayment;
        $data_two = [
            "BuyerName" => $buyername,
            "TotalPayment" => $totalpayment,
            "RemainPayment" => $remainpayment
        ];
        $where_two = [
            "AID" => $landoperationaid
        ];
        $result_two = updateData_Fun("tbllandoperation",$data_two,$where_two);
        if($result_two){
            echo 1;
        }
        else{
            echo 0;
        }
    }
    else{
        echo 0;
    }
}

if($action == "deleteinstallment"){
    $aid = $_POST["aid"];
    $projectcreateaid = $_POST["projectcreateaid"];
    $landoperationaid = $_POST["landoperationaid"];
    $where_one = [
        "AID" => $aid
    ];
    $result_one = deleteData_Fun("tbllandoperationinstallment",$where_one);
    if($result_one){
        $totalpayment = GetInt("SELECT SUM(DepositFee) FROM tbllandoperationinstallment WHERE 
        LandOperationID = '{$landoperationaid}' AND ProjectCreateID='{$projectcreateaid}'");
        $confirmprice = GetInt("SELECT ConfirmPrice FROM tbllandoperation WHERE AID='{$landoperationaid}'");
        $remainpayment = $confirmprice - $totalpayment;
        $data_two = [
            "TotalPayment" => $totalpayment,
            "RemainPayment" => $remainpayment
        ];
        $where_two = [
            "AID" => $landoperationaid
        ];
        $result_two = updateData_Fun("tbllandoperation",$data_two,$where_two);
        if($result_two){
            echo 1;
        }
        else{
            echo 0;
        }

    }
    else{
        echo 0;
    }
}

?>