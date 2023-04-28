<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'books', 
			'label' => 'Books', 
			'icon' => '<i class="fa fa-book "></i>','submenu' => array(
		array(
			'path' => 'books/Index', 
			'label' => 'Books', 
			'icon' => '<i class="fa fa-book "></i>'
		),
		
		array(
			'path' => 'books/relation', 
			'label' => 'book+inventory', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'inventory', 
			'label' => 'Inventory', 
			'icon' => '<i class="fa fa-bar-chart "></i>'
		),
		
		array(
			'path' => 'orders', 
			'label' => 'Orders', 
			'icon' => '<i class="fa fa-cart-plus "></i>'
		),
		
		array(
			'path' => 'transactions', 
			'label' => 'Transactions', 
			'icon' => '<i class="fa fa-money "></i>'
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'orders/order_books', 
			'label' => 'Order+Books', 
			'icon' => '<i class="fa fa-anchor "></i>'
		),
		
		array(
			'path' => 'transactions/sales_details', 
			'label' => 'Sales Details', 
			'icon' => ''
		),
		
		array(
			'path' => 'report', 
			'label' => 'Report', 
			'icon' => '<i class="fa fa-file-text "></i>'
		)
	);
		
			public static $navbartopleft = array(
		array(
			'path' => 'books/add', 
			'label' => 'add books', 
			'icon' => '<i class="fa fa-plus-circle "></i>'
		),
		
		array(
			'path' => 'orders/add', 
			'label' => 'add order', 
			'icon' => '<i class="fa fa-cart-plus "></i>'
		),
		
		array(
			'path' => 'inventory/add', 
			'label' => 'add inventory', 
			'icon' => '<i class="fa fa-bar-chart "></i>'
		)
	);
		
	
	
			public static $status = array(
		array(
			"value" => "Available", 
			"label" => "Available", 
		),
		array(
			"value" => "Not- Available", 
			"label" => "Not- Available", 
		),);
		
			public static $Payment_Type = array(
		array(
			"value" => "Cash", 
			"label" => "Cash", 
		),
		array(
			"value" => "Credit Card", 
			"label" => "Credit Card", 
		),
		array(
			"value" => "Debit Card", 
			"label" => "Debit Card", 
		),
		array(
			"value" => "Paypal", 
			"label" => "Paypal", 
		),
		array(
			"value" => "Mobile Money", 
			"label" => "Mobile Money", 
		),);
		
			public static $role_name = array(
		array(
			"value" => "Admin", 
			"label" => "Admin", 
		),
		array(
			"value" => "Manager", 
			"label" => "Manager", 
		),
		array(
			"value" => "Clerk", 
			"label" => "Clerk", 
		),);
		
}