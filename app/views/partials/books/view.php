<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("books/add");
$can_edit = ACL::is_allowed("books/edit");
$can_view = ACL::is_allowed("books/view");
$can_delete = ACL::is_allowed("books/delete");
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
                    <h4 class="record-title">View  Books</h4>
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
                        $rec_id = (!empty($data['Book_ID']) ? urlencode($data['Book_ID']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-Book_ID">
                                        <th class="title"> Book Id: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Book_ID']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Book_ID" 
                                                data-title="Enter Book Id" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Book_ID']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Name">
                                        <th class="title"> Name: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Name']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Name" 
                                                data-title="Enter Name" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Name']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-title">
                                        <th class="title"> Title: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['title']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="title" 
                                                data-title="Enter Title" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['title']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Author">
                                        <th class="title"> Author: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Author']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Author" 
                                                data-title="Enter Author" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Author']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Publisher">
                                        <th class="title"> Publisher: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Publisher']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Publisher" 
                                                data-title="Enter Publisher" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Publisher']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-ISBN">
                                        <th class="title"> Isbn: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['ISBN']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="ISBN" 
                                                data-title="Enter Isbn" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['ISBN']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Genre">
                                        <th class="title"> Genre: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Genre']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Genre" 
                                                data-title="Enter Genre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Genre']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Description">
                                        <th class="title"> Description: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Description']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="Description" 
                                                data-title="Enter Description" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Description']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-quantity_in_stock">
                                        <th class="title"> Quantity In Stock: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['quantity_in_stock']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
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
                                    <tr  class="td-price">
                                        <th class="title"> Price: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['price']; ?>" 
                                                data-pk="<?php echo $data['Book_ID'] ?>" 
                                                data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                data-name="price" 
                                                data-title="Enter Price" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['price']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-inventory_name">
                                        <th class="title"> Inventory Name: </th>
                                        <td class="value"> <?php echo $data['inventory_name']; ?></td>
                                    </tr>
                                    <tr  class="td-inventory_status">
                                        <th class="title"> Inventory Status: </th>
                                        <td class="value"> <?php echo $data['inventory_status']; ?></td>
                                    </tr>
                                    <tr  class="td-inventory_quantity_in_stock">
                                        <th class="title"> Inventory Quantity In Stock: </th>
                                        <td class="value"> <?php echo $data['inventory_quantity_in_stock']; ?></td>
                                    </tr>
                                    <tr  class="td-inventory_book_id">
                                        <th class="title"> Inventory Book Id: </th>
                                        <td class="value"> <?php echo $data['inventory_book_id']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("books/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("books/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
