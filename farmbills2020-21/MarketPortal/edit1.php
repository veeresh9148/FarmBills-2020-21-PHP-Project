<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from product_details where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

  if(isset($_POST['Submit'])){
		$id = $_POST['id'];
    $pname = $_POST['pname'];
		$pquantity = $_POST['pquantity'];
    $pprice = $_POST['pprice'];
		$fname = $_POST['fname'];
    $faccount = $_POST['faccount'];
    $fcontact = $_POST['fcontact'];
		

		$imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		if($imgName){

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
		}else{

			$userPic = $row['image'];
		}

		if(!isset($errorMsg)){
			$sql = "update product_details
									set id = '".$id."',
										pname = '".$pname."',
                    pquantity = '".$pquantity."',
										pprice = '".$pprice."',
										fname = '".$fname."',
                    faccount = '".$faccount."',
                    fcontact = '".$fcontact."',
										image = '".$userPic."'
					where id=".$id;
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record updated successfully';
				header('Location:index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}

	}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="index.php">PHP CRUD WITH IMAGE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="btn btn-outline-danger" href="index.php"><i class="fa fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
      </div>
    </nav>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                Edit Profile
              </div>
              <div class="card-body">
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="id">Product_Id</label>
                      <input type="text" class="form-control" name="id"  placeholder="Enter Product_Id" value="<?php echo $row['id']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pname">Product_Name</label>
                      <input type="text" class="form-control" name="pname"  placeholder="Enter Product_Name" value="<?php echo $row['pname']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pquantity">Product_Quantity</label>
                      <input type="text" class="form-control" name="pquantity"  placeholder="Enter Product_Quantity" value="<?php echo $row['pquantity']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pprice">Product_Price</label>
                      <input type="text" class="form-control" name="pprice"  placeholder="Enter Product_Price" value="<?php echo $row['pprice']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="pdescription">Product_Description</label>
                      <input type="text" class="form-control" name="pdescription"  placeholder="Enter Product_description" value="<?php echo $row['pdescription']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="fname">Farmer_Name</label>
                      <input type="text" class="form-control" name="fname" placeholder="Enter Farmer_Name" value="<?php echo $row['fname']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="faccount">Farmer_account_No</label>
                      <input type="faccount" class="form-control" name="faccount" placeholder="Enter Farmer_Account_No" value="<?php echo $row['faccount']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="fcontact">Farmer_Contact_No</label>
                      <input type="text" class="form-control" name="fcontacts"  placeholder="Enter Name" value="<?php echo $row['fcontact']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="image">Choose Image</label>
                      <div class="col-md-4">
                        <img src="<?php echo $upload_dir.$row['image'] ?>" width="100">
                        <input type="file" class="form-control" name="image" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="Submit" class="btn btn-primary waves">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
