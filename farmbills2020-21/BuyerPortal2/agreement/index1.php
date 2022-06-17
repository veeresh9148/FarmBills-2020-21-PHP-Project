<?php
  include('db.php');
  $upload_dir = 'uploads/';

  if(isset($_GET['delete'])){
		$id = $_GET['delete'];
		$sql = "select * from agreement where id = ".$id;
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			$image = $row['image'];
			unlink($upload_dir.$image);
			$sql = "delete from agreement where id=".$id;
			if(mysqli_query($conn, $sql)){
				header('location:index.php');
			}
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Agreement</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
  </head>
  <body>

      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="index.php">Agreement Page</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto"></ul>
          
              <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="btn btn-primary" href="../../FarmerPortal/FarmerHomepage.php"><i class="fas fa-arrow-circle-left"></i></a></li>
              </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Agreement List</div>
                      <div class="card-body">
                      <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                
                                <th>Image</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Contact No:</th>
                                <th>E-Mail</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                          <tr>
                           
                            <th>Image</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Contact No:</th>
                            <th>E-Mail</th>
                            <th>State</th>
                            <th>District</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                            $sql = "select * from agreement";
                            $result = mysqli_query($conn, $sql);
                    				if(mysqli_num_rows($result)){
                    					while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <tr>
                            
                            <td><img src="<?php echo $upload_dir.$row['image'] ?>" height="40"></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['date'] ?></td>
                            <td><?php echo $row['contact'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['state'] ?></td>
                            <td><?php echo $row['district'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td class="text-center">
                              <a href="show1.php?id=<?php echo $row['id'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                              <a href="edit1.php?id=<?php echo $row['id'] ?>" class="btn btn-info"><i class="fa fa-user-edit"></i></a>
                              <a href="index1.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash-alt"></i></a>
                            </td>
                          </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
      </div>

    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>
  </body>
</html>
