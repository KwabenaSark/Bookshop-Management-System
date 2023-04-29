<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("inventory/add");
$can_edit = ACL::is_allowed("inventory/edit");
$can_view = ACL::is_allowed("inventory/view");
$can_delete = ACL::is_allowed("inventory/delete");
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
                    <h4 class="record-title">View  Inventory</h4>
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
                        $rec_id = (!empty($data['quantity_in_stock']) ? urlencode($data['quantity_in_stock']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-name">
                                        <th class="title"> Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['name']; ?>" 
                                                data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                data-url="<?php print_link("inventory/editfield/" . urlencode($data['quantity_in_stock'])); ?>" 
                                                data-name="name" 
                                                data-title="Enter Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $status); ?>' 
                                                data-value="<?php echo $data['status']; ?>" 
                                                data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                data-url="<?php print_link("inventory/editfield/" . urlencode($data['quantity_in_stock'])); ?>" 
                                                data-name="status" 
                                                data-title="Enter Status" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="radiolist" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-quantity_in_stock">
                                        <th class="title"> Quantity In Stock: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['quantity_in_stock']; ?>" 
                                                data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                data-url="<?php print_link("inventory/editfield/" . urlencode($data['quantity_in_stock'])); ?>" 
                                                data-name="quantity_in_stock" 
                                                data-title="Enter Quantity In Stock" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['quantity_in_stock']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-book_id">
                                        <th class="title"> Book Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['book_id']; ?>" 
                                                data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                data-url="<?php print_link("inventory/editfield/" . urlencode($data['quantity_in_stock'])); ?>" 
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
                                    <tr  class="td-books_Book_ID">
                                        <th class="title"> Books Book Id: </th>
                                        <td class="value"> <?php echo $data['books_Book_ID']; ?></td>
                                    </tr>
                                    <tr  class="td-books_Name">
                                        <th class="title"> Books Name: </th>
                                        <td class="value"> <?php echo $data['books_Name']; ?></td>
                                    </tr>
                                    <tr  class="td-books_title">
                                        <th class="title"> Books Title: </th>
                                        <td class="value"> <?php echo $data['books_title']; ?></td>
                                    </tr>
                                    <tr  class="td-books_Author">
                                        <th class="title"> Books Author: </th>
                                        <td class="value"> <?php echo $data['books_Author']; ?></td>
                                    </tr>
                                    <tr  class="td-books_Publisher">
                                        <th class="title"> Books Publisher: </th>
                                        <td class="value"> <?php echo $data['books_Publisher']; ?></td>
                                    </tr>
                                    <tr  class="td-books_ISBN">
                                        <th class="title"> Books Isbn: </th>
                                        <td class="value"> <?php echo $data['books_ISBN']; ?></td>
                                    </tr>
                                    <tr  class="td-books_Genre">
                                        <th class="title"> Books Genre: </th>
                                        <td class="value"> <?php echo $data['books_Genre']; ?></td>
                                    </tr>
                                    <tr  class="td-books_Description">
                                        <th class="title"> Books Description: </th>
                                        <td class="value"> <?php echo $data['books_Description']; ?></td>
                                    </tr>
                                    <tr  class="td-books_quantity_in_stock">
                                        <th class="title"> Books Quantity In Stock: </th>
                                        <td class="value"> <?php echo $data['books_quantity_in_stock']; ?></td>
                                    </tr>
                                    <tr  class="td-books_price">
                                        <th class="title"> Books Price: </th>
                                        <td class="value"> <?php echo $data['books_price']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("inventory/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("inventory/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
