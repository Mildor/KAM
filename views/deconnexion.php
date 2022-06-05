<?php
$past = time() - 3600;
foreach ( $_COOKIE as $key => $value )
{
    setcookie( $key, $value, $past, '/' );
}
session_start();
session_unset();
session_destroy();
echo "<script type='text/javascript'>document.location.replace('/kam/');</script>";
exit();
?>