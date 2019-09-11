

<?php 
class controllerProducts{


 /** show products */
 

	static public function ctrShowProducts($item, $value){
		$table = "products";
		$answer = ModelProducts::mdlModelProducts($table, $item, $value);

		return $answer;


	}

/*=============================================
=            create product          =
=============================================*/

	static public function ctrCreateProduct(){
		if (isset($_POST["newName"])) {
			
		
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[0-9 ]+$/', $_POST["newStock"]) &&
				preg_match('/^[0-9.]+$/', $_POST["newBuyingPrice"]) &&
				preg_match('/^[0-9.]+$/', $_POST["newSellingPrice"])){

				$table = "products";
				$data = array("id_category" => $_POST["newCategory"],
							  "name" => $_POST["newName"],
							  "stock" => $_POST["newStock"],
							  "buying_price" => $_POST["newBuyingPrice"],
							  "selling_price" => $_POST["newSellingPrice"]);
				$answer = ModelProducts::mdlCreateProduct($table, $data);

				if ($answer == "ok") {
					echo'<script>

							swal({
								  type: "success",
								  title: "Product succesfully created",
								  showConfirmButton: true,
								  confirmButtonText: "Close"
								  }).then(function(result){
											if (result.value) {

											window.location = "products";

											}
										})

							</script>';
				}


			}else{
				echo'<script>

						swal({
							  type: "error",
							  title: "Product cant be empty or special charecters",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
								if (result.value) {

								window.location = "products";

								}
							})

				  	</script>';
			}
		}
	}


	
	
	

	
}
