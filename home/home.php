<?php
include('../config.php');
include(root.'master/header.php');

$item_sale = GetInt("select sum(Qty) from tblsale");
$customer_cnt = GetInt("select count(AID) from tblcustomer");
$expense_amt = GetInt("select sum(Amount) from tblexpense");
$total_purchase = 0;
$sql_s = "select RemainID,Qty from tblsale";
$res_s = mysqli_query($con,$sql_s);
if(mysqli_num_rows($res_s) > 0){
    while($row_s = mysqli_fetch_array($res_s)){
        $temp = GetInt("select PurchasePrice from tblremain where AID='{$row_s["RemainID"]}'");
        $temp = $temp * $row_s["Qty"];
        $total_purchase = $total_purchase + $temp;
    }
}

$total_sale = GetInt("select sum(TotalPrice) from tblsale");
$net_amt = $total_sale - $total_purchase;

// for top 10 item
$arr_itemname = [];
$arr_itemsale = [];
$sql_itemsale = "select sum(s.Qty) as qty,s.RemainID   
from tblsale s 
group by RemainID order by sum(Qty) desc limit 10";
$res_itemsale = mysqli_query($con,$sql_itemsale);
if(mysqli_num_rows($res_itemsale) > 0){
    while($row_itemsale = mysqli_fetch_array($res_itemsale)){
        $arr_itemsale[] = $row_itemsale['qty'];
        $arr_itemname[] = GetString("select Name from tblremain where AID='{$row_itemsale['RemainID']}'");
    }
}

$purchase_cnt = GetInt("select sum(Qty) from tblpurchase");

?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Dashboard</h3>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="info"><?=number_format($item_sale)?></h3>
                                        <h6>Items Sold</h6>
                                    </div>
                                    <div>
                                        <i class="icon-diamond info font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                        style="width: <?=$item_sale?>%" aria-valuenow="80" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="success"><?=number_format($customer_cnt)?></h3>
                                        <h6>Customers</h6>
                                    </div>
                                    <div>
                                        <i class="icon-user-follow success font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar"
                                        style="width: <?=$customer_cnt?>%" aria-valuenow="80" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="warning"><?=number_format($net_amt)?></h3>
                                        <h6>Net Profit</h6>
                                    </div>
                                    <div>
                                        <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                        style="width: <?=$net_amt?>%" aria-valuenow="65" aria-valuemin="0"
                                        aria-valuemax="100000">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <h3 class="danger"><?=number_format($expense_amt)?></h3>
                                        <h6>Total Expense</h6>
                                    </div>
                                    <div>
                                        <i class="icon-basket-loaded danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-danger" role="progressbar"
                                        style="width: <?=$expense_amt?>%" aria-valuenow="85" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Top 10 Product Sale Information </h4>
                        </div>
                        <div class="card-content p-2">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="row mt-1">
                                <div class="col-6 text-center">
                                    <h6 class="text-muted">Total Items</h6>
                                    <h2 class="block font-weight-normal"><?=number_format($purchase_cnt)?></h2>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-info" role="progressbar"
                                            style="width: <?=$purchase_cnt?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-center">
                                    <h6 class="text-muted">Total Sales</h6>
                                    <h2 class="block font-weight-normal"><?=$item_sale?></h2>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-warning" role="progressbar"
                                            style="width: <?=$item_sale?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card" style="">
                        <div class="card-header">
                            <h4 class="card-title">Top 10 Buying Customer</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="new-orders" class="media-list position-relative ps">
                                <div class="table-responsive">
                                    <table id="new-orders-table" class="table table-hover table-striped table-xl mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Customers</th>
                                                <th class="border-top-0">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_customer = "select c.Name,sum(GrandTotal) as total  
                                            from tblvoucher v,tblcustomer c 
                                            where v.CustomerID=c.AID 
                                            group by v.CustomerID 
                                            order by sum(GrandTotal) desc 
                                            limit 10";
                                            $res_customer = mysqli_query($con,$sql_customer);
                                            if(mysqli_num_rows($res_customer) > 0){
                                                while($row_customer = mysqli_fetch_array($res_customer)){
                                                ?>
                                            <tr>
                                                <td class="text-truncate"><?=$row_customer["Name"]?></td>
                                                <td class="text-truncate"><?=number_format($row_customer["total"])?>
                                                </td>
                                            </tr>
                                            <?php }
                                            }else{
                                            ?>
                                            <tr>
                                                <td colspan="2" class="text-truncate text-center text-danger">No data.</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
<!-- Chart.js -->
<script src="<?=roothtml.'lib/custom_chart/chart.js'?>"></script>
<?php include(root.'master/footer.php'); ?>
<script>
$(document).ready(function() {
    const itemNames = <?= json_encode($arr_itemname) ?>;
    const itemSales = <?= json_encode($arr_itemsale) ?>;
    // Chart.js Data & Config
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: itemNames,
            datasets: [{
                label: 'Sales Information',
                data: itemSales,
                backgroundColor: 'rgba(103, 85, 237, 0.6)',
                borderColor: 'rgb(3, 28, 45)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // const ctx = document.getElementById('myChart').getContext('2d');
    // const myChart = new Chart(ctx, {
    //     type: 'bar', // Bar chart
    //     data: {
    //         labels: ['January', 'February', 'March', 'April', 'May'],
    //         datasets: [{
    //             label: 'Sales Information',
    //             data: [100000, 500000, 1000000, 1500000, 3000000],
    //             backgroundColor: 'rgba(54, 162, 235, 0.6)',
    //             borderColor: 'rgba(54, 162, 235, 1)',
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             y: {
    //                 beginAtZero: false
    //             }
    //         }
    //     }
    // });


});
</script>