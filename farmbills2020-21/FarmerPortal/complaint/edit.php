<?php
  require_once('db.php');
  $upload_dir = 'uploads/';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from complaint where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }else {
      $errorMsg = 'Could not Find Any Record';
    }
  }

  if(isset($_POST['Submit'])){
		$name = $_POST['name'];
    $contact = $_POST['contact'];
		$email = $_POST['email'];
    $state = $_POST['state'];
    $district = $_POST['district'];
    $adress = $_POST['adress'];
    $complaint = $_POST['complaint'];
    $status = $_POST['status'];

		$imgName = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];

		if($imgName){

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					unlink($upload_dir.$row['image']);
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
    if($imgName){

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic1 = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 5000000){
					unlink($upload_dir.$row['image']);
					move_uploaded_file($imgTmp ,$upload_dir.$userPic1);
				}else{
					$errorMsg = 'Image too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}else{

			$userPic1 = $row['image1'];
		}

		if(!isset($errorMsg)){
			$sql = "update complaint
									set name = '".$name."',
										contact = '".$contact."',
                    email = '".$email."',
                    state = '".$state."',
                    district = '".$district."',
                    adress = '".$adress."',
                    status = '".$status."',
                    complaint = '".$complaint."',
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
    <title>Complaints</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="index.php">Complaint Edit</a>
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
                Edit Complaint
              </div>
              <div class="card-body">
                <form class="" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name"  placeholder="Enter Name" value="<?php echo $row['name']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="contact">Contact No:</label>
                      <input type="text" class="form-control" name="contact" placeholder="Enter Mobile Number" value="<?php echo $row['contact']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">E-Mail</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="state">State</label>
                      <input type="text" class="form-control" name="state" placeholder="Enter state" value="<?php echo $row['state']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="district">District</label>
                      <input type="text" class="form-control" name="district" placeholder="Enter District" value="<?php echo $row['district']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="adress">Address</label>
                      <input type="text" class="form-control" name="adress" placeholder="Enter Address" value="<?php echo $row['adress']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <input type="text" class="form-control" name="status" placeholder="Enter Status" value="<?php echo $row['status']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="complaint">Complaint</label>
                      <textarea type="text" class="form-control" name="complaint" placeholder="Enter complaint" value="<?php echo $row['complaint']; ?>"></textarea>
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
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </body>
</html>
