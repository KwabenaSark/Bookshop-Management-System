<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >The Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-sm-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_books();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("books/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Books</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_transactions_2();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("transactions/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Transactions</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_users();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("users/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Users</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_inventory();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("inventory/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-globe"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Inventory</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-sm-3 comp-grid">
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <div class="card mb-3 ">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <span class="navbar-brand mb-0 h4"></span>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </nav>  
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>">
                            <?php 
                            $arr_menu = array();
                            $menus = $comp_model->booksGenre_list(); // Get menu items from database
                            if(!empty($menus)){
                            //build menu items into arrays
                            foreach($menus as $menu){
                            $arr_menu[] = array(
                            "path"=>"books/list/books.Genre/$menu[Genre]?label=$menu[Genre]&tag=Books Genre", 
                            "label"=>"$menu[Genre] <span class='badge badge-primary float-right'>$menu[num]</span>", 
                            "icon"=>''
                            );
                            }
                            //call menu render helper.
                            Html :: render_menu($arr_menu , "nav nav-tabs flex-column");
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 comp-grid">
                    <div class=" ">
                        <?php  
                        $this->render_page("orders/list?limit_count=20"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->linechart_dailysales();
                        ?>
                        <div>
                            <h4>Daily Sales</h4>
                            <small class="text-muted"></small>
                        </div>
                        <hr />
                        <canvas id="linechart_dailysales"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Dataset 1',
                            backgroundColor:[
                            <?php 
                            foreach($chartdata['labels'] as $g){
                            echo "'" . random_color(0.9) . "',";
                            }
                            ?>
                            ],
                            borderWidth:3,
                            pointStyle:'circle',
                            pointRadius:5,
                            lineTension:0.1,
                            type:'',
                            steppedLine:false,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('linechart_dailysales');
                            var chart = new Chart(ctx, {
                            type:'line',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
