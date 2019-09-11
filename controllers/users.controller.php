<?php 

class UserController{
	static public function ctrUserLogin(){
		if(isset($_POST["loginUser"])){
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) &&
			    preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]))  {
				$table = "user";
				$item = "username";
				$value = $_POST["loginUser"];
				$answer = UsersModel::MdlShowUsers($table, $item, $value);

				if ($answer["username"] == $_POST["loginUser"] && $answer["password"] == $_POST["loginPassword"]) {
					$_SESSION["beginSession"] = "ok";
					$_SESSION["id"] = $answer["id"];
					$_SESSION["name"] = $answer["name"];
					$_SESSION["username"] = $answer["username"];
					$_SESSION["profile"] = $answer["profile"];

					echo '<script>
						window.location = "home";

					</script>';


				}else{
					echo '<br><div class="alert alert-danger">Username or Password incorrect</div>';

				}

			}
			//var_dump($answer["username"]);

		}

	}
	/*=============================================
	CREATE USER
	=============================================*/

	static public function ctrCreateUser(){
		if (isset($_POST["newUsername"])){
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUsername"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])){


				$table = "user";

				$data = array('name' => $_POST["newName"],
							  'username' => $_POST["newUsername"],
								'password' => $_POST["newPassword"],
								'profile' => $_POST["newProfile"]
								);

				$answer = UsersModel::mdlAddUser($table, $data);
				if ($answer == 'ok') {

						echo '<script>
						
						swal({
							type: "success",
							title: "User added succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						});
						
						</script>';

				}





			}else{
				echo '<script>

				swal({

					type: "error",
					title: "User cant be blank or special charecter",
					showConfirmButton: true,
					confirmButtonText: "Close",
					closeOnConfirm: false

				}).then(function(result){

							if(result.value){

								window.location = "users";
							}

				});




				</script>';
			}





		}
	}

	/*=============================================
	SHOW USER
	=============================================*/

	static public function ctrShowUsers($item, $value){

		$table = "user";

		$answer = UsersModel::MdlShowUsers($table, $item, $value);

		return $answer;
	}

}
