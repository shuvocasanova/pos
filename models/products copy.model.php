<?php 

require_once "connection.model.php";

class ModelProducts{

	/*=============================================
	=            show products           =
	=============================================*/
	
	static public function mdlModelProducts($table, $item, $value){

		if ($item !=null) {
			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY ID DESC");

			$stmt -> bindParam(":", $item, $value, PDO::PARAM_STR);		

			$stmt -> execute();

			return $stmt -> fetch();
		}else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $table ");

			$stmt -> bindParam(":", $item, $value, PDO::PARAM_STR);		

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();
		$stmt -> null;
	}

/*=============================================
	ADDING PRODUCT
	=============================================*/

	static public function mdlCreateProduct($table, $data){
		$stmt = Connection::connect()->prepare("INSERT  INTO $table(id_category, name, stock, buying_price, selling_price) VALUES (:id_category, :name, :stock, :buying_price, :selling_price) ");

		$stmt->bindParam(":id_category", $data["id_category"], PDO::PARAM_INT);
		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":buying_price", $data["buying_price"], PDO::PARAM_STR);
		$stmt->bindParam(":selling_price", $data["selling_price"], PDO::PARAM_STR);

		if ($stmt ->execute()) {
			return "ok";
		}else{
			return "error";
		}
		$stmt -> close();
		$stmt -> null;
	}	
	

	
}