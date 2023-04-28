<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("orders/add");
$can_edit = ACL::is_allowed("orders/edit");
$can_view = ACL::is_allowed("orders/view");
$can_delete = ACL::is_allowed("orders/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Orders</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['order_Id']) ? urlencode($data['order_Id']) : null);
                        $counter++;
                        ?>
                        <div class="container">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12  body-main">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                                                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                                    </svg>
                                                </div>
                                                <div class="col-md-6 text-end text-right">
                                                    <h4 style="color: #F81D2D;"><strong>Strand Bookshop</strong></h4>
                                                    <p>221 ,Baker Street</p>
                                                    <p>1800-234-124</p>
                                                    <p>Stradbookshop@gmail.com</p>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h2>Receipt</h2>
                                                    <h5>04854654101</h5>
                                                </div>
                                            </div>
                                            <br />
                                            <div>
                                                <table class="table">
                                                    <thead>
                                                        <tr  class="td-order_Id">
                                                            <th class="title"> Order Id: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['order_Id']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="order_Id" 
                                                                    data-title="Enter Order Id" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="number" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['order_Id']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr  class="td-quantity_ordered">
                                                            <th class="title"> Quantity Ordered: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['quantity_ordered']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="quantity_ordered" 
                                                                    data-title="Enter Quantity Ordered" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="number" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['quantity_ordered']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr  class="td-Price">
                                                            <th class="title"> Price: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['Price']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="Price" 
                                                                    data-title="Enter Price" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="number" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['Price']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr  class="td-Date_Sold">
                                                            <th class="title"> Date Sold: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-flatpickr="{ enableTime: false, minDate: '', maxDate: ''}" 
                                                                    data-value="<?php echo $data['Date_Sold']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="Date_Sold" 
                                                                    data-title="Enter Date Sold" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="flatdatetimepicker" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['Date_Sold']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr  class="td-Payment_Type">
                                                            <th class="title"> Payment Type: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['Payment_Type']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="Payment_Type" 
                                                                    data-title="Enter Payment Type" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="text" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['Payment_Type']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr  class="td-book_id">
                                                            <th class="title"> Book Id: </th>
                                                            <td class="value">
                                                                <span <?php if($can_edit){ ?> data-value="<?php echo $data['book_id']; ?>" 
                                                                    data-pk="<?php echo $data['order_Id'] ?>" 
                                                                    data-url="<?php print_link("orders/editfield/" . urlencode($data['order_Id'])); ?>" 
                                                                    data-name="book_id" 
                                                                    data-title="Enter Book Id" 
                                                                    data-placement="left" 
                                                                    data-toggle="click" 
                                                                    data-type="number" 
                                                                    data-mode="popover" 
                                                                    data-showbuttons="left" 
                                                                    class="is-editable" <?php } ?>>
                                                                    <?php echo $data['book_id']; ?> 
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr style="color: #F81D2D;">
                                                            <td class="text-right"><h4><strong>Total:</strong></h4></td>
                                                            <td class="text-left"><h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> 
                                                                <?php if ($data['quantity_ordered'] >= 1) {
                                                                $total = $data['Price'] * $data['quantity_ordered'];
                                                                } else {
                                                                $total = $data['Price']; // set total to 0 if quantity_ordered is less than 1
                                                                }
                                                                // output total
                                                                echo  $total;?>
                                                            </strong></h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <div class="col-md-12">
                                                    <p><b>Date :</b><?php echo $data['Date_Sold']; ?></p>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                </tbody>
                <!-- Table Body End -->
            </table>
        </div>
        <div class="p-3 d-flex">
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
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-info"  href="<?php print_link("orders/edit/$rec_id"); ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("orders/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                    <i class="fa fa-times"></i> Delete
                                </a>
                                <?php } ?>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <!-- Empty Record Message -->
                            <div class="text-muted p-3">
                                <i class="fa fa-ban"></i> No Record Found
                            </div>
                            <?php
                            }
                            ?>
                            <div id="page-report-body" class="">
                                <table class="table table-hover table-borderless table-striped">
                                    <!-- Table Body Start -->
                                    <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
