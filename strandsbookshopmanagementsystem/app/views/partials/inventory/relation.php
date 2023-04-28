<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("inventory/add");
$can_edit = ACL::is_allowed("inventory/edit");
$can_view = ACL::is_allowed("inventory/view");
$can_delete = ACL::is_allowed("inventory/delete");
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
                    <h4 class="record-title">Inventory</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("inventory/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Add New Inventory 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('inventory/'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('inventory'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('inventory'); ?>">
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
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="inventory-relation-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-sno">#</th>
                                                <th  class="td-name"> Name</th>
                                                <th  class="td-status"> Status</th>
                                                <th  class="td-quantity_in_stock"> Quantity In Stock</th>
                                                <th  class="td-book_id"> Book Id</th>
                                                <th  class="td-books_Book_ID"> Books Book Id</th>
                                                <th  class="td-books_Name"> Books Name</th>
                                                <th  class="td-books_title"> Books Title</th>
                                                <th  class="td-books_Author"> Books Author</th>
                                                <th  class="td-books_Publisher"> Books Publisher</th>
                                                <th  class="td-books_ISBN"> Books Isbn</th>
                                                <th  class="td-books_Genre"> Books Genre</th>
                                                <th  class="td-books_Description"> Books Description</th>
                                                <th  class="td-books_quantity_in_stock"> Books Quantity In Stock</th>
                                                <th  class="td-books_price"> Books Price</th>
                                                <th class="td-btn"></th>
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
                                            $rec_id = (!empty($data['quantity_in_stock']) ? urlencode($data['quantity_in_stock']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['quantity_in_stock'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-name">
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
                                                    <td class="td-status">
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
                                                    <td class="td-quantity_in_stock"><a href="<?php print_link("inventory/view/$data[quantity_in_stock]") ?>"><?php echo $data['quantity_in_stock']; ?></a></td>
                                                    <td class="td-book_id">
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
                                                    <td class="td-books_Book_ID">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Book_ID']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Book_ID" 
                                                            data-title="Enter Book Id" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Book_ID']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_Name">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Name']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Name" 
                                                            data-title="Enter Name" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Name']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_title">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_title']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="title" 
                                                            data-title="Enter Title" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_title']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_Author">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Author']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Author" 
                                                            data-title="Enter Author" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Author']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_Publisher">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Publisher']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Publisher" 
                                                            data-title="Enter Publisher" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Publisher']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_ISBN">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_ISBN']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="ISBN" 
                                                            data-title="Enter Isbn" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_ISBN']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_Genre">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Genre']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Genre" 
                                                            data-title="Enter Genre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Genre']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_Description">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_Description']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="Description" 
                                                            data-title="Enter Description" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_Description']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_quantity_in_stock">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_quantity_in_stock']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="quantity_in_stock" 
                                                            data-title="Enter Quantity In Stock" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_quantity_in_stock']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-books_price">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['books_price']; ?>" 
                                                            data-pk="<?php echo $data['quantity_in_stock'] ?>" 
                                                            data-url="<?php print_link("books/editfield/" . urlencode($data['Book_ID'])); ?>" 
                                                            data-name="price" 
                                                            data-title="Enter Price" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['books_price']; ?> 
                                                        </span>
                                                    </td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("inventory/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("inventory/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("inventory/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            Delete
                                                        </a>
                                                        <?php } ?>
                                                    </th>
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
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("inventory/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> Delete Selected
                                                    </button>
                                                    <?php } ?>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
