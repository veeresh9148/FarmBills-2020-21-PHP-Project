<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $date = $_POST['date'];
	$state = $_POST['state'];
	$district = $_POST['district'];
	$status = $_POST['status'];

    $imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

    if(empty($name)){
			$errorMsg = 'Please input name';
		}elseif(empty($contact)){
			$errorMsg = 'Please input contact';
		}elseif(empty($email)){
			$errorMsg = 'Please input email';
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
			$sql = "insert into agreement(name, contact, email, date, state, district, status, image)
					values('".$name."', '".$contact."', '".$email."', '".$date."','".$state."','".$district."', '".$status."','".$userPic."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'agreemented successfully';
				header('Location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  }
 ?>