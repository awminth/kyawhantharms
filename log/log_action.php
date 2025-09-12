<?php
include('../config.php');
include(root.'lib/vendor/autoload.php');

$action = $_POST['action'];

if($action == 'show'){  
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
        $a .= " and (l.Description like '%$search%' or u.UserName like '%$search%') ";
    }   
    $from = $_POST['from'];
    $to = $_POST['to'];
    if($from != "" || $to != ""){
        $a .= " and Date(l.Date)>='{$from}' and Date(l.Date)<='{$to}' ";
    }   
    $sql="select l.*,u.UserName from tbllog l,tbluser u 
    where l.UserID=u.AID ".$a." 
    order by l.AID desc limit {$offset},{$limit_per_page}";
        
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $out="";
    if(mysqli_num_rows($result) > 0){
        $out.='
        <table class="table table-bordered table-striped responsive nowrap">
        <thead>
        <tr>
            <th width="7%;">No</th>
            <th>Description</th>
            <th>UserName</th>
            <th>Date / Time</th>            
        </tr>
        </thead>
        <tbody>
        ';
        $no = (($page - 1) * $limit_per_page);
        while($row = mysqli_fetch_array($result)){
            $no=$no+1;
            $tt = date("H:i:s", strtotime($row['Date']));
            $out.="<tr>
                <td>{$no}</td>
                <td>{$row["Description"]}</td>
                <td>{$row["UserName"]}</td>
                <td>".enDate($row["Date"])." / ".$tt."</td>
            </tr>";
        }
        $out.="</tbody>";
        $out.="</table>";

        $sql_total="select l.AID from tbllog l,tbluser u 
        where l.UserID=u.AID  ".$a." 
        order by l.AID desc";
        $record = mysqli_query($con,$sql_total) or die("fail query");
        $total_record = mysqli_num_rows($record);
        $total_links = ceil($total_record/$limit_per_page);

        $out.='<div class="float-left"><p>Total record -  ';
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
        <table id="example" class="table table-bordered table-striped responsive nowrap">
        <thead>
        <tr>
            <th width="7%;">No</th>
            <th>Description</th>
            <th>UserName</th>
            <th>Date</th>            
        </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="text-center">No record</td>
            </tr>
        </tbody>
        </table>
        ';
        echo $out;
    }

}


if($action == 'excel'){
    $search = $_POST['ser'];
    $a = "";
    if($search != ''){  
        $a .= " and (l.Description like '%$search%' or u.UserName like '%$search%') ";
    }   
    $from = $_POST['dtfrom'];
    $to = $_POST['dtto'];
    if($from != "" || $to != ""){
        $a .= " and Date(l.Date)>='{$from}' and Date(l.Date)<='{$to}' ";
    }   
    $sql="select l.*,u.UserName from tbllog l,tbluser u 
    where l.UserID=u.AID ".$a." 
    order by l.AID desc";
    $result = mysqli_query($con,$sql);
    $out="";
    $fileName = "LogHistory_".date('d-m-Y').".xls";
    $out .= '<head><meta charset="utf-8"></head>
        <table >  
            <tr>
                <td colspan="4" align="center"><h3>Log History</h3></td>
            </tr>
            <tr><td colspan="4"><td></tr>
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Description</th>  
                <th style="border: 1px solid ;">UserName</th>  
                <th style="border: 1px solid ;">Date / Time</th>
       
            </tr>';
    if(mysqli_num_rows($result) > 0){        
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $tt = date("H:i:s", strtotime($row['Date']));
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Description"].'</td>  
                    <td style="border: 1px solid ;">'.$row["UserName"].'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["Date"]).' / '.$tt.'</td>  
                
                </tr>';
        }                   
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" align="center" colspan="4">No record</td>
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
        $a .= " and (l.Description like '%$search%' or u.UserName like '%$search%') ";
    }   
    $from = $_POST['dtfrom'];
    $to = $_POST['dtto'];
    if($from != "" || $to != ""){
        $a .= " and Date(l.Date)>='{$from}' and Date(l.Date)<='{$to}' ";
    }   
    $sql="select l.*,u.UserName from tbllog l,tbluser u 
    where l.UserID=u.AID ".$a." 
    order by l.AID desc";
    $result = mysqli_query($con,$sql);
    $out="";
    $out .= '<h3 align="center">Log History</h3>
        <head><meta charset="utf-8"></head>
        <table >  
            <tr>  
                <th style="border: 1px solid ;">No</th>  
                <th style="border: 1px solid ;">Description</th>  
                <th style="border: 1px solid ;">UserName</th>  
                <th style="border: 1px solid ;">Date / Time</th>       
            </tr>';
    if(mysqli_num_rows($result) > 0){        
        $no=0;
        while($row = mysqli_fetch_array($result)){
            $no = $no + 1;
            $tt = date("H:i:s", strtotime($row['Date']));
            $out .= '
                <tr>  
                    <td style="border: 1px solid ;">'.$no.'</td>  
                    <td style="border: 1px solid ;">'.$row["Description"].'</td>  
                    <td style="border: 1px solid ;">'.$row["UserName"].'</td>  
                    <td style="border: 1px solid ;">'.enDate($row["Date"]).' / '.$tt.'</td>  
                
                </tr>';
        }                    
    }else{
        $out .= '
            <tr>
                <td style="border: 1px solid ;" align="center" colspan="4">No record</td>
            </tr>
        ';  
    }
    $out .= '</table>';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont   = true;  
    $stylesheet = file_get_contents(roothtml.'lib/mypdfcss.css'); // external css
    $mpdf->WriteHTML($stylesheet,1);  
    $mpdf->WriteHTML($out,2);
    $file = 'LogHistoryPDF'.date("d_m_Y").'.pdf';
    $mpdf->output($file,'D');
    
}



?>