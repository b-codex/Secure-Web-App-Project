<?php
session_start();
$token = isset($_SESSION['delete_customer_token']) ? $_SESSION['delete_customer_token'] : "";
if (!$token) {
    // generate token and persist for later verification
    // - in practice use openssl_random_pseudo_bytes() or similar instead of uniqid() 
    $token = md5(uniqid());
    $_SESSION['delete_customer_token'] = $token;
}
session_write_close();
?>
<html>

<body>
    <form method="post" action="confirm_save.php">
        <input type="hidden" name="token" value="<?php echo $token; ?>" />
        Do you really want to delete?
        <input type="submit" value=" Yes " />
        <input type="button" value=" No " onclick="history.go(-1);" />
    </form>
</body>

</html>