<?php 
class chartforum{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}

	public function insert_data($designer_id,$message,$category)
	{

	  $query = $this->db->prepare("INSERT INTO `chat_forum`(`designer_id`,`message`,`category`) VALUES (?,?,?)");


	   $query->bindValue(1, $designer_id);
	   $query->bindValue(2, $message);
	   $query->bindValue(3, $category);


	   try
	   {

	   $query->execute();

	   }
	    catch (PDOException $e) 
	    {
			die($e->getMessage());
		}
	 
	}

	public function list_messages()
	{
      $query = $this->db->prepare("SELECT T1.id, T1.designer_id, T1.message, T1.category FROM chat_forum T1 INNER JOIN designer T2 ON T1.designer_id = T2.id");


			try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}

	}

	public function insert_comments($m_id,$designer_id,$reply)
	{

	  $query = $this->db->prepare("INSERT INTO `comments`(`m_id`,`designer_id`,`reply`) VALUES (?,?,?)");

	   $query->bindValue(1, $m_id);
	   $query->bindValue(2, $designer_id);
	   $query->bindValue(3, $reply);

	
	   try
	   {

	   $query->execute();
	   }
	    catch (PDOException $e) 
	    {
			die($e->getMessage());
		}
	 
	}

	public function list_comments($m_id)
	{
            $query = $this->db->prepare("SELECT T1.reply,T2.username,T1.likes,T1.id,T1.m_id FROM comments T1 INNER JOIN designer T2 ON T1.designer_id = T2.id WHERE T1.m_id = ? ORDER BY T1.likes DESC");

            $query->bindValue(1, $m_id);


			try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}

	}

	public function edit_data($designer_id,$message,$category)
	{
      $query = $this->db->prepare("UPDATE `chat_forum` SET message = ?,
      													   category = ?
      													   WHERE designer_id = ?");


	   $query->bindValue(1, $message);
	   $query->bindValue(2, $category);
	   $query->bindValue(3, $designer_id);



	   try
	   {

	   $query->execute();

	   }
	    catch (PDOException $e) 
	    {
			die($e->getMessage());
		}


	}
 /*============================list one message for the logged in designer for updating========================================*/
 public function get_notifications($designer_id)
	{
      $query = $this->db->prepare("SELECT T1.id,T1.status,T2.id,T2.designer_id FROM comments T1 INNER JOIN chat_forum T2 ON T1.m_id = T2.id WHERE T2.designer_id = ? AND T1.status = 'unread'");

      $query->bindValue(1,$designer_id);

			try
			{
				$query->execute();
				$count = count($query);
				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}

	}



   public function insert_likes($id)
 	  {
         $query = $this->db->prepare("UPDATE `comments` SET likes    = likes + 1
      													   WHERE id = ? ");

		   $query->bindValue(1, $id);

		   try
		   {

		   $query->execute();
		  // $message_id = $this->db->lastInsertId();

		   }
		    catch (PDOException $e) 
		    {
				die($e->getMessage());
			}
	  }
/*==================for notifications on home page=========================================*/
	  public function get_msg_id($designer_id)
	  {

	  	$query = $this->db->prepare("SELECT t1.id, t1.m_id, t1.status, t2.id, t2.designer_id FROM comments t1 INNER JOIN chat_forum t2 ON t1.m_id = t2.id WHERE t2.designer_id = ? LIMIT 0,1");

	  	$query->bindValue(1, $designer_id);

	  	try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}

	  }
/*==================insert into likes comment for counting====================================*/
	public function insert_likes_ids($id)
		{

		  $query = $this->db->prepare("INSERT INTO `likes`(`reply_id`,`designer_id`) VALUES (?,?)");

		   $query->bindValue(1, $reply_id);
		   $query->bindValue(2, $designer_id);

		   try
		   {

		   $query->execute();

		   }
		    catch (PDOException $e) 
		    {
				die($e->getMessage());
			}
		 
		}

		/*==================delete from likes table if the designer has selected unlike====================================*/
	public function delete_notifications($m_id,$designer_id)
		{

		  $query = $this->db->prepare("UPDATE comments T1 INNER JOIN chat_forum T2 ON T1.m_id = T2.id SET T1.status = 'read' WHERE T1.m_id = ? AND T2.designer_id = ?");

		   
		   $query->bindValue(1,$m_id);
		   $query->bindValue(2,$designer_id);

		   try
		   {

		   $query->execute();

		   }
		    catch (PDOException $e)
		    {
				die($e->getMessage());
			}
		 
		}

		public function countNumOflikes($id)
	  {

	  	$query = $this->db->prepare("SELECT likes FROM comments WHERE id = ?");

	  	try
			{
				$query->execute();

				return $query->fetchAll();

				
			} catch(PDOException $e)

			{
				die($e->getMessage());
			}

	  }
}

?>