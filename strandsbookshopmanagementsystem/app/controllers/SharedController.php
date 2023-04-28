<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * users_user_name_value_exist Model Action
     * @return array
     */
	function users_user_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("user_name", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * users_email_value_exist Model Action
     * @return array
     */
	function users_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("users");
		return $exist;
	}

	/**
     * getcount_total Model Action
     * @return Value
     */
	function getcount_total(){
		$db = $this->GetModel();
		$sqltext = "SELECT  SUM(t.total_price) AS sum_of_total_price FROM transactions AS t";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_totalrevenue Model Action
     * @return Value
     */
	function getcount_totalrevenue(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(price * quantity_ordered) AS Amount_Made
FROM orders;";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_sold Model Action
     * @return Value
     */
	function getcount_sold(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(quantity_ordered) AS total_ordered
FROM orders;
";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_instock Model Action
     * @return Value
     */
	function getcount_instock(){
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(quantity_in_stock) AS total_quantity
FROM inventory;
";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* piechart_status Model Action
	* @return array
	*/
	function piechart_status(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT COUNT(*) AS total_count, 'Books' AS books
FROM books
UNION ALL
SELECT COUNT(*) AS total_count, 'Inventory' AS Inventory
FROM inventory
UNION ALL
SELECT COUNT(*) AS total_count, 'Orders' AS orders
FROM orders
UNION ALL
SELECT COUNT(*) AS total_count, 'Users' AS users
FROM users;
";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'total_count');
		$dataset_labels =  array_column($dataset1, 'books');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* barchart_bestselling Model Action
	* @return array
	*/
	function barchart_bestselling(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT SUM(o.quantity_ordered) AS total_sales, b.name AS book_name FROM books AS b INNER JOIN orders AS o ON b.book_id = o.book_id GROUP BY b.book_id ORDER BY total_sales DESC;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'total_sales');
		$dataset_labels =  array_column($dataset1, 'book_name');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* doughnutchart_users Model Action
	* @return array
	*/
	function doughnutchart_users(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT COUNT(*) AS num_users, role_name FROM users WHERE role_name IN ('Admin', 'Manager', 'Clerk') GROUP BY role_name;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'num_users');
		$dataset_labels =  array_column($dataset1, 'role_name');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* linechart_monthlysales Model Action
	* @return array
	*/
	function linechart_monthlysales(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  SUM(o.Price) AS sum_of_Price, MONTHNAME(o.Date_Sold) AS monthname_of_Date_Sold FROM orders AS o GROUP BY monthname_of_Date_Sold";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'sum_of_Price');
		$dataset_labels =  array_column($dataset1, 'monthname_of_Date_Sold');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
     * report_reportPayment_Type_option_list Model Action
     * @return array
     */
	function report_reportPayment_Type_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT Payment_Type AS value,Payment_Type AS label FROM report";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_books Model Action
     * @return Value
     */
	function getcount_books(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM books";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_transactions_2 Model Action
     * @return Value
     */
	function getcount_transactions_2(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM transactions";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_users Model Action
     * @return Value
     */
	function getcount_users(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM users";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_inventory Model Action
     * @return Value
     */
	function getcount_inventory(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM inventory";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * booksGenre_list Model Action
     * @return array
     */
	function booksGenre_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT Genre ,   COUNT(*) AS num FROM books GROUP BY Genre";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	* linechart_dailysales Model Action
	* @return array
	*/
	function linechart_dailysales(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "SELECT  SUM(o.Price) AS sum_of_Price, DAYNAME(o.Date_Sold) AS dayname_of_Date_Sold FROM orders AS o GROUP BY dayname_of_Date_Sold" ;
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'sum_of_Price');
		$dataset_labels =  array_column($dataset1, 'dayname_of_Date_Sold');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
