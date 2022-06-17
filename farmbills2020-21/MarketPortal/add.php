<?php
  require_once('db.php');

  if (isset($_POST['Submit'])) {
    $date = $_POST['Current_Date'];
    $time = $_POST['Current_Time'];
	$market_name = $_POST['market_name'];
    $imgName = $_FILES['msp_image']['name'];
		$imgTmp = $_FILES['msp_image']['tmp_name'];
		$imgSize = $_FILES['msp_image']['size'];

		if(empty($market_name)){
			$errorMsg = 'Please input Market_Name';
		}elseif(empty($date)){
			$errorMsg = 'Please input date';
		}elseif(empty($time)){
			$errorMsg = 'Please input time';
		}else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into msp(date,time,msp_image,market_name)
					values('".$date."','".$time."','".$userPic."','".$market_name."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('Location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  }
?>
