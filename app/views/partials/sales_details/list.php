<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("sales_details/add");
$can_edit = ACL::is_allowed("sales_details/edit");
$can_view = ACL::is_allowed("sales_details/view");
$can_delete = ACL::is_allowed("sales_details/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Sales Details</h4>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('sales_details'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('sales_details'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('sales_details'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-sm-10 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <?php $this :: display_page_errors(); ?>
                            <div  class=" animated fadeIn page-content">
                                <div id="sales_details-list-records">
                                    <div id="page-report-body" class="table-responsive">
                                        <table class="table  table-striped table-sm text-left">
                                            <thead class="table-header bg-light">
                                                <tr>
                                                    <th class="td-sno">#</th>
                                                    <th  class="td-Name"> Name</th>
                                                    <th  class="td-price"> Price</th>
                                                    <th  class="td-quantity_ordered"> Quantity Ordered</th>
                                                    <th  class="td-amount"> Amount</th>
                                                    <th  class="td-Payment_Type"> Payment Type</th>
                                                    <th  class="td-user_id"> User Id</th>
                                                    <th  class="td-book_id"> Book Id</th>
                                                    <th  class="td-id"> Id</th>
                                                    <th  class="td-book"> Book</th>
                                                    <th  class="td-role_name"> Role Name</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if(!empty($records)){
                                            ?>
                                            <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                <!--record-->
                                                <?php
                                                $counter = 0;
                                                foreach($records as $data){
                                                $rec_id = (!empty($data['']) ? urlencode($data['']) : null);
                                                $counter++;
                                                ?>
                                                <tr>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-Name"> <?php echo $data['Name']; ?></td>
                                                    <td class="td-price"> <?php echo $data['price']; ?></td>
                                                    <td class="td-quantity_ordered"> <?php echo $data['quantity_ordered']; ?></td>
                                                    <td class="td-amount"> <?php echo $data['amount']; ?></td>
                                                    <td class="td-Payment_Type"> <?php echo $data['Payment_Type']; ?></td>
                                                    <td class="td-user_id"> <?php echo $data['user_id']; ?></td>
                                                    <td class="td-book_id"> <?php echo $data['book_id']; ?></td>
                                                    <td class="td-id"> <?php echo $data['id']; ?></td>
                                                    <td class="td-book"> <?php echo $data['book']; ?></td>
                                                    <td class="td-role_name"> <?php echo $data['role_name']; ?></td>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="fa fa-ban"></i> No record found
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-save"></i> Export
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Filter</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2 comp-grid">
                                            <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                                                <div class="card mb-3 sticky-top">
                                                    <?php $menu_id = "menu-" . random_str(); ?>
                                                    <nav class="navbar navbar-expand-lg navbar-light">
                                                        <div class="h4"></div>
                                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                                                            <span class="navbar-toggler-icon"></span>
                                                        </button>
                                                    </nav>
                                                    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>">
                                                        <ul class="nav nav-pills">
                                                            <?php 
                                                            $option_list = $comp_model->sales_details_list();
                                                            if(!empty($option_list)){
                                                            foreach($option_list as $option){
                                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                                            $nav_link = $this->set_current_page_link(array('' => $value , 'label' => $label) , false);
                                                            ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link <?php echo is_active_link('', $value); ?>" href="<?php print_link($nav_link) ?>">
                                                                    <?php echo $label; ?>
                                                                </a>
                                                            </li>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Filter</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-10 comp-grid">
                                            <div class="card card-body">
                                                <?php 
                                                $chartdata = $comp_model->barchart_newchart3();
                                                ?>
                                                <div>
                                                    <h4>New Chart 3</h4>
                                                    <small class="text-muted"></small>
                                                </div>
                                                <hr />
                                                <canvas id="barchart_newchart3"></canvas>
                                                <script>
                                                    $(function (){
                                                    var chartData = {
                                                    labels : <?php echo json_encode($chartdata['labels']); ?>,
                                                    datasets : [
                                                    {
                                                    label: 'Dataset 1',
                                                    backgroundColor:'<?php echo random_color(0.9); ?>',
                                                    type:'',
                                                    borderWidth:3,
                                                    data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                                                    }
                                                    ]
                                                    }
                                                    var ctx = document.getElementById('barchart_newchart3');
                                                    var chart = new Chart(ctx, {
                                                    type:'bar',
                                                    data: chartData,
                                                    options: {
                                                    scaleStartValue: 0,
                                                    responsive: true,
                                                    scales: {
                                                    xAxes: [{
                                                    ticks:{display: true},
                                                    gridLines:{display: true},
                                                    categoryPercentage: 1.0,
                                                    barPercentage: 0.8,
                                                    scaleLabel: {
                                                    display: true,
                                                    labelString: ""
                                                    },
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
                        </section>
