<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

class AjaxProducts{

	/*=============================================
	GENERATE CODE FROM ID CATEGORY
	=============================================*/	

	public $idCategory;

	public function ajaxCreateProductCode(){

		$item = "idCategory";
		$value = $this->idCategory;

		$answer = controllerProducts::ctrShowProducts($item, $value);

		echo json_encode($answer);

	}

	/*=============================================
 	 EDIT PRODUCT
  	=============================================*/ 

  	public $idProduct;

  	public function ajaxEditProduct(){

	    $item = "id";
	    $value = $this->idProduct;

	    $answer = controllerProducts::ctrShowProducts($item, $value);

	    echo json_encode($answer);

  	}

}

/*=============================================
GENERATE CODE FROM ID CATEGORY
=============================================*/	

if(isset($_POST["idCategory"])){

	$productCode = new AjaxProducts();
	$productCode -> idCategory = $_POST["idCategory"];
	$productCode -> ajaxCreateProductCode();

}

/*=============================================
EDIT PRODUCT
=============================================*/ 


if(isset($_POST["idProduct"])){

  $editProduct = new AjaxProducts();
  $editProduct -> idProduct = $_POST["idProduct"];
  $editProduct -> ajaxEditProduct();

}

