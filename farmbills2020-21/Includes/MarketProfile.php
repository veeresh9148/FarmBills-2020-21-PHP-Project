<?php
if (isset($_SESSION['phonenumber'])) {
echo "../MarketPortal/MarketProfile.php";
}
else {
echo "../auth/MarketLogin.php";
}
?>