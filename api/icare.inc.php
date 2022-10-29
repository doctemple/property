<?php
class INC
{

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		try {
			$this->connect = new PDO("mysql:host=".HOST.";dbname=".DB,USR, PWD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
		} catch(PDOException $e) {
			echo "<center><h1>Connection failed</h1><p>Please check Connection Config</p></center>";
			exit;
		}
	}

	function systemName()
	{
		$query = "SELECT * FROM setting WHERE param='system' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				return $data['valued'];
			}
		}
	}

	function updateSystem($data)
	{
		
		$query = "update setting set valued='$data' where param='system' ";
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}

	}
	
	function CheckLogin($username,$password)
	{
		$query = "SELECT * FROM users WHERE user='$username' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				if($count>0){
					$check = $this->CheckPWD($username,$password);
					return $check;
				}
		}
	}

	function CheckPWD($username,$password)
	{
		$query = "SELECT * FROM users WHERE user='$username' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					if(md5($password)==$data['password']){
                        $_SESSION['u'] = $data['id'];
                        $_SESSION['aut'] = true;
						return true;
					}else{
						return false;
					}
				}

		}else{
				return false;
		}

	}

	function CheckRole($id)
	{
		$query = "SELECT * FROM users WHERE id='$id' and type='admin' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				if($count>0){
                    return true;
				}else{
                    return false;
                }
		}

	}

	function getFirstName($id)
	{
		$query = "SELECT firstName FROM users WHERE id='$id' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data['firstName'];
				}
		}else{
				return false;
		}

	}

	
	function UserOnline($id)
	{
		$query = "SELECT name FROM users WHERE id='$id' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data['name'];
				
				}
		}
	}

	function fName($id)
	{
		$query = "SELECT * FROM users WHERE id='$id' ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data['firstName'];
				}
		}
	}


	function userProfile($id)
	{
		$query = "SELECT * FROM users WHERE id='$id' ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data;
				}
		}
	}

	
	function userList()
	{
		$query = "SELECT * FROM users ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					$return[] = $data;
				}

				return $return;
		}
	}

	
	function addUser($param)
	{
		extract($param);
		$pwd = md5($password);

			$query = "INSERT INTO users 
			(user, firstName,lastName,email,password,type,phone,created) 
			values 
			('$user','$firstName','$lastName','$email','$pwd','$type','$phone',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					return $this->connect->lastInsertId(); 
				}

	}

	function updateUser($param)
	{
		extract($param);
		if($newpassword!=''){ $password=md5($newpassword); $sq2 = "password='$password', "; }else{ $sq2=''; }

			$query = "UPDATE users SET user = '$user', $sq2 firstName = '$firstName', lastName = '$lastName', email = '$email', phone = '$phone', type = '$type', lastUpdate=now() WHERE id = '$id';";
	
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}

	function delUser($id)
	{

			$query = "DELETE FROM users WHERE id='$id' ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}

	}

	function ChangePassword($id,$password)
	{
		$pass = md5($password);
		$query = "UPDATE users SET password = '$pass' WHERE id = $id; ";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				return true;
		}else{
				return false;
		}

	}

	function addCaim($param)
	{
		extract($param);

		$description = htmlentities($description);

			$query = "INSERT INTO caims 
			(fName,cPhone,tDescription,createDate)
			values 
			('$fName','$cPhone','$description',now())";
				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					$_SESSION['cid'] = $this->connect->lastInsertId(); 
					return true;
				}

	}
	
	function addTicket($param)
	{
		extract($param);
		$user = $_SESSION['u'];

		$description = htmlentities($description);

			$query = "INSERT INTO tickets 
			(fName,cPhone,psGroup,tDescription,byNotic,createDate)
			values 
			('$fName','$cPhone','$psgroup','$description','$user',now())";
				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					$_SESSION['tid'] = $this->connect->lastInsertId(); 
					return true;
				}


	}

	function updateTicketPS($param)
	{
		extract($param);

		$query = "update tickets set psGroup='$ps' where ticketID='$id' ";
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}
	}

	function updateTicket($param)
	{
		extract($param);
		$description = htmlentities($description);

		$query = "update tickets set fName='$fName', cPhone='$cPhone', tDescription='$description' where ticketID='$ticketID' ";
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}
	}

	function totalPay($tid)
	{

		$query = "SELECT (select SUM(prices.addPrice) as total from prices where prices.tid = $tid) as total FROM tickets where tickets.ticketID = $tid;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $data)
			{
				$res= $data['total'];
			}
			return $res;
		}
	}

	
	function caimsRemain()
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		$today = date("Y-m-d 00:00:00");
		$query = "SELECT p.* , t.*, m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid FROM prices as p left JOIN tickets as t on t.ticketID = p.tid left JOIN members as m on t.mid = m.id or t.cPhone = m.phone where t.tStatus!=3 and t.tStatus!=9 AND p.sid = 2 ORDER BY p.sid ASC";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function caimsCompleted()
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		$query = "SELECT c.*, DATE_SUB(NOW(), INTERVAL 1 DAY) as fromDate, m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid FROM caims as c LEFT JOIN members as m on c.mid = m.id or c.cPhone = m.phone WHERE c.endDate BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW() and c.cStatus=3 order by c.caimID DESC";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function ticketRemain($ps)
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		$today = date("Y-m-d 00:00:00");
		if($ps!='00'){ $tsql = " and t.psGroup = $ps "; }else{ $tsql = ''; }
		$query = "SELECT t.* , m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid, p.pid, p.sid, DATEDIFF(NOW(),t.firstDate) as Duration, ps.psCode, ps.psName FROM tickets as t LEFT JOIN members as m on t.mid = m.id or t.cPhone = m.phone LEFT JOIN prices as p on t.ticketID = p.tid AND p.sid = 2 left join products as ps on t.psGroup = ps.id WHERE t.tStatus!=3 and t.tStatus!=9 $tsql ORDER BY t.tStatus, t.firstDate, t.ticketID ASC;";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function updateTicketPrice($tid,$st)
	{
		if($st==0){ $fp = "firstPrice"; }
		if($st==1){ $fp = "secondPrice"; }
		if($st==2){ $fp = "endPrice"; }
		if($st==3){ $fp = "endPrice"; }

		$update ="UPDATE tickets SET $fp=(SELECT (select SUM(prices.addPrice) as total from prices where prices.tid = $tid) as total FROM tickets where tickets.ticketID = $tid) WHERE ticketID = $tid";
		$st = $this->connect->prepare($update);
		$update = $st->execute();

		if(!$update){
			return false;
		}else{
			return true;
		}
	}

	function ticketCompleted($ps)
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		if($ps!='00'){ $tsql = " and t.psGroup = $ps "; }else{ $tsql = ''; }
		$query = "SELECT t.*, DATE_SUB(NOW(), INTERVAL 1 DAY) as fromDate, m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid , p.pid, p.sid,  DATEDIFF(NOW(),t.firstDate) as Duration, ps.psCode, ps.psName FROM tickets as t LEFT JOIN members as m on t.mid = m.id or t.cPhone = m.phone LEFT JOIN prices as p on t.ticketID = p.tid AND p.sid = 2 left join products as ps on t.psGroup = ps.id WHERE t.endDate BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW() and t.tStatus=3 $tsql order by t.ticketID DESC";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;	
			}
			return $res;
		}
	}

	function ticketHistory($mid) // ไม่ได้ใช้
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		$today = date("Y-m-d 00:00:00");
		$query = "SELECT * FROM tickets WHERE cPhone LIKE '$mid' order by ticketID DESC";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function ticketHistoryBy($mid,$sby)
	{
		if($sby=='Name'){ $sss = "m.firstName LIKE '%$mid%' or t.fName LIKE '%$mid%' or m.lastName LIKE '%$mid%' "; }
		if($sby=='Phone'){ $sss = "m.phone LIKE '%$mid%' or t.cPhone LIKE '%$mid%' "; }
		if($sby=='ticketID'){ $sss = "t.ticketID = '$mid' "; }
		if($sby=='Company'){ $sss = "m.Company LIKE '%$mid%' or m.email LIKE '%$mid%' or m.firstName LIKE '%$mid%' "; }

		$res=array();
		$query = "SELECT t.* , m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid FROM tickets as t left JOIN members as m on t.mid = m.id or t.cPhone = m.phone where $sss ORDER BY t.ticketID ASC";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function caimsHistory($m)
	{
		$res=array();
		$now = date("Y-m-d h:i:sa");
		$today = date("Y-m-d 00:00:00");
		$query = "SELECT *,
		DATE_SUB(NOW(), INTERVAL $m MONTH) as fromDate,
		NOW() as toDate
		FROM caims  
		where
		createDate BETWEEN DATE_SUB(NOW(), INTERVAL $m MONTH) AND NOW()
		  
		  order by caimID DESC;";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function HistoryMo()
	{
		$res=array();

		$query = "SELECT DISTINCT MONTH(t.firstDate) as mo FROM tickets as t group by t.firstDate DESC;";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data['mo'];
			}
			return $res;
		}
	}

	function HistoryYe()
	{
		$res=array();

		$query = "SELECT DISTINCT YEAR(t.firstDate) as ye FROM tickets as t group by t.firstDate DESC;";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data['ye'];
			}
			return $res;
		}
	}

	function History($mo,$ye)
	{
		$res=array();

		$query = "SELECT *
		FROM tickets  
		WHERE MONTH(firstDate) = $mo AND YEAR(firstDate) = $ye OR MONTH(createDate) = $mo AND YEAR(createDate) = $ye
		  order by ticketID DESC;";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}

	function checkService($param)
	{
		extract($param);

		$query = "SELECT * FROM tickets WHERE cPhone LIKE '$cPhone' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$res[]= $data;
			}
			return $res;
		}
	}


	function Caim($cid)
	{
		$query = "SELECT * FROM caims WHERE caimID='$cid' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				return $data;
			}
		}
	}

	function caimDetail($cid)
	{

		$query = "SELECT c.* , m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid FROM caims as c left JOIN members as m on c.cPhone = m.phone where caimID='$cid' ";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				return $data;
			}
		}
	}

	function Ticket($tid)
	{
		$query = "SELECT t.*, p.psName, p.psCode FROM tickets as t left join products as p on t.psGroup = p.id WHERE t.ticketID='$tid' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				return $data;
			}
		}
	}

	function TicketDetail($tid)
	{

		$query = "SELECT t.* , m.firstName, m.lastName, m.email, m.company, m.note, m.id as mid, p.psName, p.psCode FROM tickets as t left JOIN members as m on t.cPhone = m.phone left join products as p on t.psGroup = p.id where ticketID='$tid' ";

		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$count = $statement->rowCount();
			foreach($statement->fetchAll() as $data)
			{
				$this->updateTicketPrice($tid,$data['tStatus']);
				return $data;
			}
		}
	}



	function noteTicket($param)
	{
		extract($param);

		$query = "update tickets set Note='$note'  where ticketID='$id' ";
		//echo $query;
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}
	}
	
	
	function CaimChangeStatus($param)
	{
		extract($param);
		$u = $_SESSION['u'];
		$query = "UPDATE prices SET pid = '$pid', progressBy = '$u', progressDate = now() WHERE id = '$id'; ";

		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}
	}
	
	function TicketApprove($param)
	{
		extract($param);
		$u=$_SESSION['u'];

		$query = "update tickets set tStatus='3' , closeUser='$u', approval='$approval' where ticketID='$tid' ";

		//echo $query;
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			return false;
		}else{
			return true;
		}
	}

	function TicketChangeStatus($param)
	{
		extract($param);
		$u=$_SESSION['u'];
		$fval = array("",",byUser='$u' ",",exUser='$u' ",",closeUser='$u' ");
		$query = "update tickets set tStatus='$s' {$fval[$s]} ";
/*
		if(isset($fprice) && $fprice!=0){ $fprice = $param['fprice']; $query.=", firstPrice='$fprice' "; }
		if(isset($sprice) && $sprice!=0){ $sprice = $param['sprice']; $query.=", secondPrice='$sprice' "; }
		if(isset($eprice) && $eprice!=0){ $eprice = $param['eprice']; $query.=", endPrice='$eprice' "; }

		if(isset($pledge) && $pledge!=0){ $query.= ", pledge='$pledge' "; }
*/

		if($s==1){ 
			$fprice = $param['fprice']; 
			$query.=", firstPrice='$fprice' ";
			$query.= ", pledge='$pledge' ";
			$query.= ", firstDate=now() "; }
		if($s==2){ 
			$sprice = $param['sprice']; 
			$query.=", secondPrice='$sprice' ";
			$query.= ", pledge='$pledge' ";
			$query.= ", secondDate=now() "; }
		if($s==3){ 
			$eprice = $param['eprice']; 
			$query.=", endPrice='$eprice' ";
			$query.= ", pledge='$pledge' ";
			$query.= ", endDate=now() "; }

		$query .= " where ticketID='$id' ";

		//echo $query;
		$statement = $this->connect->prepare($query);
		$update = $statement->execute();
		if(!$update){
			$this->updateTicketPrice($id,$s);
			return false;
		}else{
			return true;
		}
	}
	
	
	
	function ticketTotalPrice($tid)
	{
		$query = "SELECT sum(addPrice) as total FROM `prices` WHERE tid=$tid";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data['total'];
				}
		}
	}

	function ticketAddPrice($param)
	{
		extract($param);
		
			$query = "INSERT INTO prices 
			(tid,sid, subject,addPrice,addBy,addTime) 
			values 
			('$tid','$pType','$subject','$price','$uid',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();

				if($insert){
					$this->updateTicketPrice($tid,$ts);
					return $insert;						
				}

	}

	function nextTicketId(){
		$query = "SELECT * from tickets"; 
		$statement = $this->connect->prepare($query);
		$check = $statement->execute();
		$maxid = $this->connect->lastInsertId();

		if($maxid<1 || $maxid==''){ $maxid= 0; }
		
		$id = $maxid+1;
		return $id;
	}

	function pricesList($tid)
	{
		$query = "SELECT * FROM prices where tid='$tid' ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				if($count>0){
				foreach($statement->fetchAll() as $data)
				{
					$return[] = $data;
				}
			}else{
				$return = array();
			}

				return $return;
		}
	}
	
	function memberList()
	{
		$query = "SELECT * FROM members ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					$return[] = $data;
				}

				return $return;
		}
	}

	function memberProfile($id)
	{
		$query = "SELECT * FROM members WHERE id='$id' ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data;
				}
		}
	}

	
	function addMember($param)
	{
		extract($param);

		$notes = htmlentities($note);
		$pwd = md5($password);

		if(!isset($company)){ $company = ''; }

			$query = "INSERT INTO members 
			(gender,firstName,lastName,email,phone,company,note,lastUpdate) 
			values 
			('$gender','$firstName','$lastName','$email','$phone','$company','$notes',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					return $this->connect->lastInsertId(); 
				}

	}

	function delMember($id)
	{

			$query = "DELETE FROM members WHERE id='$id' ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}

	}

	function updateProfile($param)
	{
		extract($param);

		$birth = date('Y-m-d',strtotime($birth));

			$query = "UPDATE members SET gender = '$gender', firstName = '$firstName', lastName = '$lastName', email = '$email', phone = '$phone', company = '$company', taxNumber='$taxNumber', address='$address', note = '$note' WHERE id = '$id';";
	
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}

	
	function prodList()
	{
		$query = "SELECT * FROM articles ";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					$return[] = $data;
				}

				return $return;
		}
	}

	function prodDetail($id)
	{
		$query = "SELECT * FROM articles where id='$id'";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
					return $data;
				}

		}
	}

	
	function addProducts($param)
	{
		extract($param);

		$details = htmlentities($detail);

			$query = "INSERT INTO articles 
			(subject,detail,last_update) 
			values 
			('$subject','$details',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{

					return $this->connect->lastInsertId(); 

				}

	}

	function updateIMG($id,$ext)
	{
					$img = $id.'.'.$ext;
					$query2 = "UPDATE articles SET img = '$img' WHERE id = '$id';";
					$statement2 = $this->connect->prepare($query2);
					$update2 = $statement2->execute();
					if($update2){
						return true;
					}else{
						return false;
					}

	}

	function delNews($id)
	{

			$query = "DELETE FROM articles WHERE id='$id' ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}

	}

	function delPrice($id)
	{

			$query = "DELETE FROM prices WHERE id='$id' ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}
	}

	function delTicket($param)
	{
		extract($param);

			$query = "DELETE FROM tickets WHERE ticketID = $id ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}

				echo $query;

	}

	function updateProduct($param,$imgnew='')
	{
		extract($param);
		$details = htmlentities($detail);

		if($imgnew!=''){
			$imm = $imgnew;
		}else{
			$imm = $img;
		}

			$query = "UPDATE articles SET subject = '$subject', img = '$imm', detail = '$details' WHERE id = '$id';";
//echo $query;
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}


}

?>