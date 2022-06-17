<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $date = $_POST['date'];
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
			$sql = "insert into agreement(name, contact, email, date, status, image)
					values('".$name."', '".$contact."', '".$email."', '".$date."', '".$status."','".$userPic."')";
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
  <?php
  if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "select * from agreement where id = '$id'";
	$query = mysqli_query($con, $sql);
	$i = 0;

	$buyer_id = array();
	$allqty = array();
	$allsubtotal = array();
	$allphones = array();
	while ($p_price = mysqli_fetch_array($query)) {
		array_push($allproducts, $product_id);
		array_push($allqty, $qty);

		$sql = "select * from buyeregistration where buyer_id='$buyer_id'";
		$run_pro_price = mysqli_query($con, $sql);
		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
			$farmer_id = $pp_price['farmer_fk'];

			$get_phone = "select * from farmerregistration where farmer_id = $farmer_id";
			$run_get_phone = mysqli_query($con, $get_phone);
			while ($phones = mysqli_fetch_array($run_get_phone)) {
				$phone = $phones['farmer_phone'];
				array_push($buyer_id, $phone); 
			}
		}
	}
}?>