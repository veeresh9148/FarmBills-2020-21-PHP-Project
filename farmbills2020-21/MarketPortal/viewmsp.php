<html>
<head>
<title> View MSP</title>
</head>
<body>
  <center>
  <form action="" method="POST" enctype="multipart/form-data" cellpadding='10'>
  <table>
    <thead>
        <tr>
            <th>Image </th>
            <th> Date </th>
            <th> Time </th>
         </tr>
     </thead>
    <?php 
    include("../Includes/db.php");
    session_start();
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query = "select * from msp where id=".$id;
    $query_run = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($query_run))
    {
        ?>
        <tr>
            <td> <img src="<?php echo $row['msp_image'];?>"height='100px' width='100px'/> </td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['time']; ?></td>
        </tr>


        <?php
    }
  }
    ?>
  </table>
  </form>
  </center>
</body>
</html>