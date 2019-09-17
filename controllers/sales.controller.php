<?php 

class ControllerSales{

	/*=============================================
	=            show sales        =
	=============================================*/
	
	static public function ctrShowSales($item, $value){
		$table = "sales";

		$answer = ModelSales::mdlShowSales($table, $item, $value);
		return $answer;
	}
	

	/*=============================================
	CREATE SALE
	=============================================*/

	static public function ctrCreateSale(){
		if(isset($_POST["newSale"])){
			/*=============================================
			UPDATE CUSTOMER'S PURCHASES AND REDUCE THE STOCK AND INCREASE SALES OF THE PRODUCT
			=============================================*/

			$productsList = json_decode($_POST["productsList"], true);
			$totalPurchasedProducts = array();


			foreach ($productsList as $key => $value) {
				array_push($totalPurchasedProducts, $value["quantity"]);
				$tableProducts = "products";
				//var_dump($getProduct["sales"]);
				$item = "id";
			    $valueid = $value["id"];
			    $order = "id";

			    $getProduct = productsModel::mdlShowProducts($tableProducts, $item, $valueid);
			    var_dump($getProduct["sales"]);
			    $item1a = "sales";
			    $value1a = $value["quantity"] + $getProduct["sales"];

			    $newSales = productsModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $valueid);

			    $item1b = "stock";
				$value1b = $value["stock"];

				$newStock = productsModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $valueid);

			}

			$tableCustomers = "customers";

			$item = "id";
			$valueCustomer = $_POST["selectCustomer"];

			$getCustomer = ModelCustomers::mdlShowCustomers($tableCustomers, $item, $valueCustomer);
			 

			 $item1 = "total_purchase";
			 $value1 = array_sum($totalPurchasedProducts) + $getCustomer["total_purchase"];

			$CustomerPurchased = ModelCustomers::mdlUpdateCustomer($tableCustomers, $item1, $value1, $valueCustomer);




			/*=============================================
			SAVE THE SALE
			=============================================*/	

			$table = "sales";

			$data = array("idSeller"=>$_POST["idSeller"],
						   "idCustomer"=>$_POST["selectCustomer"],
						   "code"=>$_POST["newSale"],
						   "products"=>$_POST["productsList"],
						   "discount"=>$_POST["newDiscountPrice"],
						   "netPrice"=>$_POST["newNetPrice"],
						   "totalPrice"=>$_POST["newSaleTotal"],
						   "totalPaid"=>$_POST["newCashValue"],
						   "due"=>$_POST["newCashChange"]);

			$answer = ModelSales::mdlAddSale($table, $data);
			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The sale has been succesfully added",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "create-sales";

								}
							})

				</script>';

			}
		}
	}


	/*=============================================
	EDIT SALE
	=============================================*/

	static public function ctrEditSale(){

		if(isset($_POST["editSale"])){

			/*=============================================
			FORMAT PRODUCTS AND CUSTOMERS TABLES
			=============================================*/
			$table = "sales";

			$item = "code";
			$value = $_POST["editSale"];

			$getSale = ModelSales::mdlShowSales($table, $item, $value);
			// $products =  json_decode($getSale["products"], true);

			// //var_dump($products);
			// foreach ($products as $key => $value) {
			// 	$tableProducts = "products";
			// 	$item = "id";
			// 	$value = $value["id"];


			// 	$getProduct = ProductsModel::mdlShowProducts($tableProducts, $item, $value);	

			// 	$item1a = "sales";
			// 	$value1a = $getProduct["sales"] - $value["quantity"];

			// 	$newSales = ProductsModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $value);


			// 	$item1b = "stock";
			// 	$value1b = $value["quantity"] + $getProduct["stock"];

			// 	$stockNew = ProductsModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $value);				
			// }

			/*=============================================
			CHECK IF THERE'S ANY EDITED SALE
			=============================================*/


			if($_POST["productsList"] == ""){

				$productsList = $getSale["products"];
				$productChange = false;


			}else{

				$productsList = $_POST["productsList"];
				$productChange = true;
			}

			if($productChange){

				$products =  json_decode($getSale["products"], true);

				$totalPurchasedProducts = array();

				foreach ($products as $key => $value) {				

					array_push($totalPurchasedProducts, $value["quantity"]);	

					$tableProducts = "products";

					$item = "id";
					$value1 = $value["id"];
					$order = "id";

					$getProduct = ProductsModel::mdlShowProducts($tableProducts, $item, $value1, $order);					

					$item1a = "sales";
					$value1a = $getProduct["sales"] - $value["quantity"];

					$newSales = ProductsModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $value);

					$item1b = "stock";
					$value1b = $value["quantity"] + $getProduct["stock"];

					$stockNew = ProductsModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $value);

				}

				$tableCustomers = "customers";

				$itemCustomer = "id";
				$valueCustomer = $_POST["selectCustomer"];

				$getCustomer = ModelCustomers::mdlShowCustomers($tableCustomers, $itemCustomer, $valueCustomer);

				$item1a = "purchases";
				$value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);

				$customerPurchases = ModelCustomers::mdlUpdateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

				/*=============================================
				UPDATE THE CUSTOMER'S PURCHASES AND REDUCE THE STOCK AND INCREMENT PRODUCT SALES
				=============================================*/

				$productsList_2 = json_decode($productsList, true);

				$totalPurchasedProducts_2 = array();

				foreach ($productsList_2 as $key => $value) {

					array_push($totalPurchasedProducts_2, $value["quantity"]);
					
					$tableProducts_2 = "products";

					$item_2 = "id";
					$value_2 = $value["id"];
					$order = "id";

					$getProduct_2 = ProductsModel::mdlShowProducts($tableProducts_2, $item_2, $value_2, $order);

					$item1a_2 = "sales";
					$value1a_2 = $value["quantity"] + $getProduct_2["sales"];

					$newSales_2 = ProductsModel::mdlUpdateProduct($tableProducts_2, $item1a_2, $value1a_2, $value_2);

					$item1b_2 = "stock";
					$value1b_2 = $getProduct_2["stock"] - $value["quantity"];

					$newStock_2 = ProductsModel::mdlUpdateProduct($tableProducts_2, $item1b_2, $value1b_2, $value_2);

				}

				$tableCustomers_2 = "customers";

				$item_2 = "id";
				$value_2 = $_POST["selectCustomer"];

				$getCustomer_2 = ModelCustomers::mdlShowCustomers($tableCustomers_2, $item_2, $value_2);

				$item1a_2 = "purchases";
				$value1a_2 = array_sum($totalPurchasedProducts_2) + $getCustomer_2["purchases"];

				$customerPurchases_2 = ModelCustomers::mdlUpdateCustomer($tableCustomers_2, $item1a_2, $value1a_2, $value_2);

				
			}

			/*=============================================
			SAVE PURCHASE CHANGES
			=============================================*/	

			$data = array("idSeller"=>$_POST["idSeller"],
						   "idCustomer"=>$_POST["selectCustomer"],
						   "code"=>$_POST["editSale"],
						   "products"=>$productsList,
						   "discount"=>$_POST["newDiscountSale"],
						   "netPrice"=>$_POST["newNetPrice"],
						   "totalPrice"=>$_POST["saleTotal"],
							"due"=>$_POST["newCashChange"],
							"totalPaid"=>$_POST["newCashValue"]);


			$answer = ModelSales::mdleditSale($table, $data);

			if($answer == "ok"){

				echo'<script>

				localStorage.removeItem("range");

				swal({
					  type: "success",
					  title: "The sale has been edited correctly",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then((result) => {
								if (result.value) {

								window.location = "manage-sales";

								}
							})

				</script>';

			}

		 }

	}

/*=============================================
	Delete Sale
	=============================================*/

	static public function ctrDeleteSale(){

		if(isset($_GET["idSale"])){

			$table = "sales";

			$item = "id";
			$value = $_GET["idSale"];

			$getSale = ModelSales::mdlShowSales($table, $item, $value);



			/*=============================================
			FORMAT PRODUCTS AND CUSTOMERS TABLE
			=============================================*/

			$products =  json_decode($getSale["products"], true);

			$totalPurchasedProducts = array();

			foreach ($products as $key => $value) {

				array_push($totalPurchasedProducts, $value["quantity"]);
				
				$tableProducts = "products";

				$item = "id";
				$valueProductId = $value["id"];
				$order = "id";

				$getProduct = ProductsModel::mdlShowProducts($tableProducts, $item, $valueProductId, $order);

				$item1a = "sales";
				$value1a = $getProduct["sales"] - $value["quantity"];

				$newSales = ProductsModel::mdlUpdateProduct($tableProducts, $item1a, $value1a, $valueProductId);

				$item1b = "stock";
				$value1b = $value["quantity"] + $getProduct["stock"];

				$stockNew = ProductsModel::mdlUpdateProduct($tableProducts, $item1b, $value1b, $valueProductId);

			}

			$tableCustomers = "customers";

			$itemCustomer = "id";
			$valueCustomer = $getSale["idCustomer"];

			$getCustomer = ModelCustomers::mdlShowCustomers($tableCustomers, $itemCustomer, $valueCustomer);

			$item1a = "purchases";
			$value1a = $getCustomer["purchases"] - array_sum($totalPurchasedProducts);

			$customerPurchases = ModelCustomers::mdlUpdateCustomer($tableCustomers, $item1a, $value1a, $valueCustomer);

			/*=============================================
			Delete Sale
			=============================================*/
			$data = $_GET["idSale"];

			$answer = ModelSales::mdlDeleteSale($table, $data );

			if($answer == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "The sale has been deleted succesfully",
					  showConfirmButton: true,
					  confirmButtonText: "Close",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "sales";

								}
							})

				</script>';


			}		
		}

	}
	
	
}