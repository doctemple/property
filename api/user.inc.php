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

	function information()
	{
		$query = "SELECT * FROM setting WHERE param='information' ";
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

	function CheckSignin($idcard,$password)
	{
		$pwd = md5($password);
		$query = "SELECT * FROM members WHERE idcard='$idcard' && password='$pwd' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{

			$count = $statement->rowCount();
			if($count>0){
				foreach($statement->fetchAll() as $data)
				{
					$_SESSION['firstName']=$data['firstName'];
					$_SESSION['u']=$data['id'];
				}				
				return true;
			}else{
				return false;
			}


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

	function Reports($m)
	{
		$query = "SELECT * FROM sitations where month(check_date)=$m HAVING age order by age asc";
				
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");

			$ages = array("","ทารก","วัยเด็ก","วัยรุ่น","วัยผู้ใหญ่","วัยกลางคน","ผู้สูงวัย");

			$colors = array("","#e55784","#3d7bba","#2ab241","#754bea","#e5c827","#c65247");

				$reports = array();
				$count = $statement->rowCount();
				foreach($statement->fetchAll() as $data)
				{
						$bps = $data['blood_pressure_sys'];
						$bpd = $data['blood_pressure_dia'];

						if($bps<=90 && $bpd<60){ $db = "ต่ำ"; }else{
							if($bps<=119 && $bpd<=79){ $db = "ปกติ"; }else{
								if($bps<=139 && $bpd<=89){ $db = "ปกติ(ค่อนข้างสูง)"; }else{
									if($bps<=159 && $bpd<=99){ $db = "สูงระดับ 1"; }else{
										if($bps<=179 && $bpd<=109){ $db = "สูงระดับ 2"; }else{
											if($bps>=180 && $bpd>=110){ $db = "สูง ระดับ 3(รุนแรง)"; }else{
												if($bps>140 && $bpd<90){ $db = "ตัวบนสูง(SBP)"; }else{
													$db = "วิเคราะห์ไม่ได้"; 
												}
											}
										}
									}
								}
							}
						}

					$reports[] = array(
						"label"=>$ages[$data['age']],
						"backgroundColor"=> $colors[$data['age']],
						"borderColor"=> $colors[$data['age']],
						"borderWidth"=>2,
						"data"=> array($bps,$bpd),
						"tension"=>0.4);

				}

				$return = array("labels"=>array($month[$m]),"datasets"=>$reports);

				return $return;
		}
	}

	function reportList()
	{
		$query = "SELECT *, month(check_date) as m FROM `sitations` GROUP by month(check_date) ORDER BY m ASC ";
				
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

	function editCheckSheet($id)
	{
		$query = "SELECT * FROM sitations WHERE id='$id' ";
				
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

	function addService($param)
	{
		extract($param);

		$description = htmlentities($description);

			$query = "INSERT INTO tickets 
			(fName,cPhone,tDescription,createDate)
			values 
			('$fName','$cPhone',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					$_SESSION['mid'] = $this->connect->lastInsertId(); 
					return true;
				}

	}

	function addCheckSheet($param)
	{
		extract($param);

			$query = "INSERT INTO sitations 
			(member,age,around_belly,blood_pressure_sys,blood_pressure_dia,blood_sugar,pulse,bmi,vaccine_covid19,blood,congenital_disease,drug_allergy,food_allergy,vaccine,height,weight,note,check_date) 
			values 
			('$member','$age','$around_belly','$blood_pressure_sys','$blood_pressure_dia','$blood_sugar','$pulse','$bmi','$vaccine_covid19','$blood','$congenitalDisease','$drugAllergy','$foodAllergy','$vaccine','$height','$weight','$note',now())";

				$statement = $this->connect->prepare($query);
				$insert = $statement->execute();
				if(!$insert){
					return false;
				}else{
					return true;
				}

	}

		function updateCheckSheet($param)
	{
		extract($param);

		$checkdate = date('Y-m-d',strtotime($check_date));

		$query = "UPDATE sitations SET member = '$member', around_belly = '$around_belly', blood_pressure_sys = '$blood_pressure_sys', blood_pressure_dia = '$blood_pressure_dia', blood_sugar = '$blood_sugar', pulse = '$pulse', bmi = '$bmi', vaccine_covid19 = '$vaccine_covid19', blood = '$blood', congenital_disease = '$congenital_disease', drug_allergy = '$drug_allergy', food_allergy = '$food_allergy', vaccine = '$vaccine', age = '$age', check_date = '$checkdate', note = '$note' WHERE id = '$id';";
	
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}

	function checkList($m)
	{
		if($m==""){
		$query = "SELECT s.*, m.firstName,m.lastName  FROM sitations as s left join members as m on s.member=m.id";
		}else{
			$query = "SELECT s.*, m.firstName,m.lastName  FROM sitations as s left join members as m on s.member=m.id where m.id='$m' order by check_date DESC";
		}
				
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

	function delCheckSheet($id)
	{

			$query = "DELETE FROM sitations WHERE id='$id' ";

				$statement = $this->connect->prepare($query);
				$del = $statement->execute();
				if(!$del){
					return false;
				}else{
					return true;
				}
	}

	function addNews($param)
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


	function newList()
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

	function newDetail($id)
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

	function updateNews($param,$imgnew='')
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

	function addMember($param)
	{
		extract($param);

		$notes = htmlentities($note);
		$pwd = md5($password);

			$query = "INSERT INTO members 
			(gender,firstName,lastName,nickName,email,idcard,password,phone,birth,occupation,address,blood,congenitalDisease,drugAllergy,foodAllergy,vaccine,height,weight,note,lastUpdate) 
			values 
			('$gender','$firstName','$lastName','$nickName','$email','$idcard','$pwd','$phone','$birth','$occupation','$address','$blood','$congenitalDisease','$drugAllergy','$foodAllergy','$vaccine','$height','$weight','$notes',now())";

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

			$query = "UPDATE members SET gender = '$gender', firstName = '$firstName', lastName = '$lastName', nickName = '$nickName', email = '$email', idcard = '$idcard', phone = '$phone', birth = '$birth', occupation = '$occupation', address = '$address', blood = '$blood', congenitalDisease = '$congenitalDisease', drugAllergy = '$drugAllergy', foodAllergy = '$foodAllergy', vaccine = '$vaccine', height = '$height', weight = '$weight', note = '$note' WHERE id = '$id';";
	
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}

	function updateInspector($param)
	{
		extract($param);
		if($newpassword!=''){ $password=md5($newpassword); $sq2 = "password='$password', "; }else{ $sq2=''; }

			$query = "UPDATE users SET gender = '$gender', $sq2 firstName = '$firstName', lastName = '$lastName', email = '$email', phone = '$phone', position = '$position', note = '$note' WHERE id = '$id';";
	
				$statement = $this->connect->prepare($query);
				$update = $statement->execute();
				if(!$update){
					return false;
				}else{
					return true;
				}
	}

	function addUser($param)
	{
		extract($param);

		$notes = htmlentities($note);
		$pwd = md5($password);

			$query = "INSERT INTO users 
			(user,gender, firstName,lastName,email,password,type,phone,position,note,created) 
			values 
			('$user','$gender','$firstName','$lastName','$email','$pwd','$type','$phone','$position','$notes',now())";

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

			$query = "UPDATE users SET user = '$user', gender = '$gender', $sq2 firstName = '$firstName', lastName = '$lastName', email = '$email', phone = '$phone', position = '$position', type = '$type', note = '$note', lastUpdate=now() WHERE id = '$id';";
	
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

	function nextTicketId(){
		$query = "SELECT * from tickets"; 
		$statement = $this->connect->prepare($query);
		$check = $statement->execute();
		$maxid = $this->connect->lastInsertId();

		if($maxid<1 || $maxid==''){ $maxid= 0; }
		
		$id = $maxid+1;
		return $id;
	}

}

?>