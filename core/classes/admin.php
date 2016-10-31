<?php

class Admin{

	private $db;

	public function __construct($database){
		$this->db = $database;
	}

	public function register($username, $password, $email){

		global $bcrypt; // making the $bcrypt variable global so we can use here
		$password   = $bcrypt->genHash($password);

		$query 	= $this->db->prepare("INSERT INTO admin (ad_username, ad_password, ad_email) VALUES (?, ?, ?)");
		$query->bindValue(1,$username);
		$query->bindValue(2,$password);
		$query->bindValue(3,$email);

		try{
			$query->execute();

			//mail($email, 'Welcome to Afrilisting.com', "Hello " . $username. ",\r\nThank you for registering with us.\r\n\r\n-- Tello Faith team");
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	 

	public function mainAdmin($username,$password)
	{

		$query = $this->db->prepare("SELECT ad_password, ad_id FROM admin WHERE ad_username = ?");
		$query->bindValue(1, $username);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function Admin_login($username,$password)
	{

		$query = $this->db->prepare("SELECT ad_password, ad_id FROM admin WHERE ad_username = ?");
		$query->bindValue(1, $username);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

		public function admin_exists($username) {
	
		$query = $this->db->prepare("SELECT COUNT(ad_id) FROM admin WHERE ad_username = ?");
		$query->bindValue(1, $username);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function email_exists($email) 
	{

		$query = $this->db->prepare("SELECT COUNT(ad_id) FROM admin WHERE ad_email = ?");
		$query->bindValue(1,$email);
	
		try{

			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}else{
				return false;
			}

		} catch (PDOException $e){
			die($e->getMessage());
		}

	}

	public function login($username, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ?");
		$query->bindValue(1, $username);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['password']; // stored hashed password
			$id   				= $data['id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function addlogin($username,$password,$main_admin_id) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT ad_password, ad_id FROM admin WHERE ad_username = ? AND ad_id = ?");
		$query->bindValue(1,$username);
		$query->bindValue(2,$main_admin_id);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['ad_password']; // stored hashed password
			$id   				= $data['ad_id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

	public function other_addlogin($username, $password) {

		global $bcrypt;  // Again make get the bcrypt variable, which is defined in init.php, which is included in login.php where this function is called

		$query = $this->db->prepare("SELECT ad_password, ad_id FROM admin WHERE ad_username = ?");
		$query->bindValue(1, $username);

		try{
			
			$query->execute();
			$data 				= $query->fetch();
			$stored_password 	= $data['ad_password']; // stored hashed password
			$id   				= $data['ad_id']; // id of the user to be returned if the password is verified, below.
			
			if($bcrypt->verify($password, $stored_password) === true){ // using the verify method to compare the password with the stored hashed password.
				return $id;	// returning the user's id.
			}else{
				return false;	
			}

		}catch(PDOException $e){
			die($e->getMessage());
		}
	
	}

		function add_admin($username,$password,$email,$contact,$fname,$lname)
		{

			global $bcrypt;
			$password = $bcrypt->genHash($password);

		$query = $this->db->prepare("INSERT INTO admin (ad_username, ad_password, ad_email, ad_contact, ad_fname, ad_lname) VALUES (?, ?, ?, ?, ?, ?)");
		$query->bindValue(1,$username);
		$query->bindValue(2,$password);
		$query->bindValue(3,$email);
		$query->bindValue(4,$contact);
		$query->bindValue(5,$fname);
		$query->bindValue(6,$lname);

		try{

			$query->execute();

		} catch(PDOException $e){

			die($e->getMessage());
		}
	}

	public function userdata($id) {

		$query = $this->db->prepare("SELECT * FROM admin WHERE ad_id= ?");
		$query->bindValue(1, $id);

		try{

			$query->execute();

			return $query->fetch();

		} catch(PDOException $e){

			die($e->getMessage());
		}

	}

	public function delete_admin($admin_id)
	{

		$query = $this->db->prepare("DELETE FROM admin WHERE ad_id = ?");
		$query->bindValue(1,$admin_id);
		try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}

	public function Disp_admin($main_admin_id)
     {

       	global $db;

	$query = $this->db->prepare("SELECT * FROM admin WHERE ad_id != ?");
	$query->bindValue(1,$main_admin_id);

			try{

				$query->execute();
				return $query->fetchAll();
				
			} catch(PDOException $e){

				die($e->getMessage());
			}

		}

		public function edit_admin($admin_id){

		global $db;

		$query	= $this->db->prepare("SELECT ad_email,ad_username, ad_password FROM admin  WHERE ad_id = ?");

			$query->bindValue(1,$admin_id);



		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function update_admin($admin_id,$admin_email,$admin_username,$admin_password)
	{
		global $bcrypt;
		$admin_password = $bcrypt->genHash($admin_password);

		$query	= $this->db->prepare("UPDATE admin SET
									   ad_email		= ?,
									   ad_username		= ?,
									   ad_password   =?							   									
									   WHERE ad_id	= ? 
									   ");
	
	    $query->bindValue(1, $admin_email);
		$query->bindValue(2, $admin_username);
		$query->bindValue(3, $admin_password);
		$query->bindValue(4, $admin_id);
		
		


		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

public function list_business(){
		global $db;

$query	= $this->db->prepare("SELECT T1.id, T1.name,T1.user_id,T1.cat_id,T1.address,T1.email,T1.tel,T1.fax,T1.city,T1.country,T1.image,T1.website,T1.facebook,T1.twitter,T1.instagram,T1.about,T1.services,T1.refferal,T1.status,T1.dateposted,T1.map,T1.analytics,T1.province,T1.date_approved, T2.pid,T2.amount,T2.pay_type,T2.pstatus FROM  `business` T1 INNER JOIN `payments` T2 ON T1.id = T2.b_id ");
		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	


public function list_users(){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `users` ");

		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	


public function approve($bid){

		$date 	= date('Y-m-d');
		$status = 'Active';

		$query	= $this->db->prepare("UPDATE `business` SET 
									  		 `date_approved` = ?,
											 `status`		 = ?

									   		  WHERE `id`	 = ? 
									   ");

	
		$query->bindValue(1, $bid);
		$query->bindValue(2, $date);
		$query->bindValue(3, $status);

		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}


public function pending($bid){

		$date = date('Y-m-d');
		$status = 'Pending';

		$query	= $this->db->prepare("UPDATE `business` SET 
									   		 `date_approved` = ?,
											 `status`		 = ?

									  		  WHERE `id`	 = ? 
									   ");

		$query->bindValue(1, $date);
		$query->bindValue(2, $status);
		$query->bindValue(3, $bid);

		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}



public function delete_list($user_id) {

		$query = $this->db->prepare("DELETE FROM `business` WHERE `user_id` = ? ");
		$query->bindValue(1, $user_id);
		
		try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}		


public function list_client(){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `client` ");

	

		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	


public function delete_client($user_id) {

		$query = $this->db->prepare("DELETE FROM `users` WHERE `id` = ? ");
		$query->bindValue(1, $user_id);
		
		try{
			
			$query->execute();
		} catch(PDOException $e){
			die($e->getMessage());
		}

	}		



	public function update_client($client_id,$client_name,$client_lastname,$client_city,$contact,$email){

		$query	= $this->db->prepare("UPDATE `client` SET 									   									 
									   `client_name`		= ?,
									   `client_lastname`		= ?,
									   `client_city`		= ?,
									   `contact`		= ?,
									   `email`		= ?
									  									
									   WHERE `client_id`	= ? 
									   ");

	
		$query->bindValue(1, $client_name);
	    $query->bindValue(2, $client_lastname);
	    $query->bindValue(3, $client_city);
        $query->bindValue(4, $contact);
	    $query->bindValue(5, $email);
		$query->bindValue(6, $client_id);


		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}




public function all_edit_client($user_id){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `client`  WHERE `client_id` = ?");

			$query->bindValue(1, $user_id);


		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	




public function all_edit_business($buss_id){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `business`  WHERE `b_id` = ?");

			$query->bindValue(1, $buss_id);


		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	
	
/*===================Start Property====================*/

	public function list_property(){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `property` ");

		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}	

	/*===================Start cars listing====================*/

	public function list_cars(){
		global $db;

		$query	= $this->db->prepare("SELECT * FROM `cars` ");

		try {
			$query->execute();

			return $query->fetchAll();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	

	/*==============Aprove cars listing by admin===============*/
public function admin_approve($pid){
$date= date('Y-m-d');
		$query	= $this->db->prepare("UPDATE `payments` SET 

									   `pstatus`		= 'Paid'

									   WHERE `pid`	= ? 
									   ");

	
		$query->bindValue(1,$pid);
	
		

		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

/*==============unaprove payments listing by admin ===============*/


public function unapprove_payments($pid){
$date= date('Y-m-d');

		$query	= $this->db->prepare("UPDATE `payments` SET 

									   `pstatus`		= 'Unpaid'

									   WHERE `pid`	= ? 
									   ");

	
		$query->bindValue(1, $pid);
	
		

		try {
			$query->execute();

		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
		

}