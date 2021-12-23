<?php

IF (!ISSET($_SESSION))
{
SESSION_START();
}
//anti flood protection
IF($_SESSION['last_session_request'] >TIME() - 1)
{
//header('location:http://easymobad.com');

echo "<b>Anti flood control</b> -->> please always wait 1 seconds after each proccess, press back your back button now to continue. Thanks";
exit;
}
$_SESSION['last_session_request'] = TIME();



?>