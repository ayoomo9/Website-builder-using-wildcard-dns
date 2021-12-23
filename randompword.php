
<?php
function generate_passwd($length = 6) {
  static $chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ23456789';
  $chars_len = strlen($chars);
  for ($i = 0; $i < $length; $i++)
    $password .= $chars[mt_rand(0, $chars_len - 1)];
  return $password;
}


echo generate_passwd();
?>
