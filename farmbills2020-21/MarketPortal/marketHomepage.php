<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Market Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="markethomepage.css">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body>
      <nav>
          <label class="logo">WELCOME TO MARKET</label>
          <ul>
            <li><a class="active" href="crud/create.php">MSP</a></li> 
            <li><a  class="active" href="crud/index.php">View MSP</a></li>
            <li><a  class="active" href="MarketProfile.php">Profile</a></li>
            <li><a  class="active" href="MarketLogout.php">Log Out</a></li>
           
          </ul>
      </nav>
      <section>
<?php 
if(isset($_GET['page'])) {
  if($_GET['page'] == "create"){
    echo " create page";
}
}
?>
      </section>
    </body>
 </html>