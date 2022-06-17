<?php
if (isset($_SESSION['phonenumber'])) {
echo "../bankportal/FarmerProfile.php";
}
else {
echo "../auth/bankLogin.php";
}
?>