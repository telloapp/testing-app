<?php 
class designer
{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}


		public function register($username, $password, $email)
		   {

				global $bcrypt; // making the $bcrypt variable global so we can use here

				$query 	= $this->db->prepare("INSERT INTO `designer` (`username`,`password`, `email`) VALUES (?, ?, ?) ");

				$query->bindValue(1, $username);
				$query->bindValue(2, $password);
				$query->bindValue(3, $email);
				

				try
				{
					$query->execute();
				}

				catch(PDOException $e)
				{
					die($e->getMessage());
				}	
			}

			public function login($username, $password) 
			{

				global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

				$query = $this->db->prepare("SELECT `id`,`password` FROM `designer` WHERE `username` = ?");
				$query->bindValue(1, $username);

				try{
					
					$query->execute();
					$data 				= $query->fetch();
					$stored_password 	= $data['password']; // stored hashed password
					$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
					
					if(($password == $stored_password)){ // using the verify method to compare the password with the stored hashed password.
						return $id;	// returning the user's id.
					}else{
						return false;	
					}

				}catch(PDOException $e){
					die($e->getMessage());
				}
	
	       }

	       public function userdata($id) 
	       {

				$query = $this->db->prepare("SELECT * FROM `designer` WHERE `id`= ?");
				$query->bindValue(1, $id);

				try{

					$query->execute();

					return $query->fetch();

				} catch(PDOException $e){

					die($e->getMessage());
				}

		   }
}

?>