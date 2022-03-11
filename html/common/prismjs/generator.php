<?php
/* xRender generator for XCL core */
$main = "../../mainfile.php";
if (file_exists($main)) {
    require_once $main;
    // xRender - XCL core auth
    $root =& XCube_Root::getSingleton();
    $user =& $root->mContext->mUser;
    if ( $user->isInRole("Site.Administrator") ) {
    //if ( isset($_SERVER['HTTP_SEC_FETCH_DEST']) && empty($_SERVER['HTTP_SEC_FETCH_DEST'] !== 'iframe' ) ) {
    /* xRender template compatible with XCL core  */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Prism theme generator</title>
  <link rel="stylesheet" href="vendor/x-prism.css">
    <link rel="stylesheet" href="prism.css">
</head>
<body>
 <div id="app"></div>
 <script src="vendor/less.min.js"></script>
 <script src="vendor/react.min.js"></script>
 <script data-manual src="prism.js"></script>
 <script src="vendor/bundle.js"></script>
</body>
</html>
<?php
    // xRender - XCL core log message
    } else {
        $output_style = '<style>body {background:#212325;color:#abc;font:normal 100 16px/1.2 sans-serif;margin:25vh auto; max-width:50vw;</style>';
        $output_msg = '<h1>Server Log</h1>'
            . '<hr>'
            . '<p>Date : ' . date("Y.m.d") . '</p>'
            . '<p>Time : ' . date("h:i:sa") . '</p>'
            . '<p>Domain : ' . $_SERVER['HTTP_HOST'] . '</p>'
            . '<p>Request : ' . basename($_SERVER["REQUEST_URI"], ".php") . '</p>'
            . '<p>Script : ' . basename($_SERVER['PHP_SELF'], ".php") . '</p>'
            . '<hr>'
            . '<h3>Register</h3>'
            . '<p>User IP : ' . $_SERVER['REMOTE_ADDR'] . '</p>'
            . '<hr>';
        $UserMsg = "$output_style $output_msg";
        // xRender - XCL core redirect URL
        exit ( $UserMsg."Contact please, the site administrator or webmaster.<hr>Redirecting...". header( "refresh:4; url=../../index.php"));
     }
}
?>
