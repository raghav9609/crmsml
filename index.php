<?php
$password_field_text = '';
require_once(dirname(__FILE__) . '/include/constant.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Admin Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo $head_url; ?>/assets/css/adminstylesheet.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $head_url; ?>/assets/css/header.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
        <link rel="icon" href="<?php echo $head_url; ?>/assets/images/favicon.png" type="image/x-icon">
		<?php
		if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
		$_SERVER['HTTPS'] == 1) ||
		isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
		{
			$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: ' . $redirect);
			exit();
		}
		?>
    </head>
    <body leftmargin="0" topmargin="0">
       <style>.loginbox{background: radial-gradient(#ffffff, #fcfdff);width:40%;box-sizing:border-box;border:1px solid #ddd;border-radius:12px;padding:30px 60px;margin:0 auto;min-height:200px;margin-top:40px}.container{padding-left:20px;padding-right:20px}.text-center{text-align:center}label{font-weight:700;display:block;font-size:13px;margin-top:10px}input{margin:0!important;width:100%!important;border:1px solid #ddd;padding-left:10px!important;padding-right:10px!important;height:34px!important;margin-top:4px!important;box-sizing:border-box;background:#fffbf7;border-radius:4px}#rmsg{font-size:12px;padding-top:6px;padding-bottom:16px}.messagelab{font-size:14px;margin-top:0;margin-bottom:28px;color: #a7a7a7;}#err{margin-top:20px;margin-bottom:10px;text-align:left;font-size:12px}#submit{background: #1a3960;height: 40px !important;}@media screen and (max-width:560px){.loginbox{width:100%;padding:20px}}</style>
		<div class="container">
			<div class="text-center">
				<img src="<?php echo $head_url;?>/assets/images/logo_new.png" alt="Logo" style="margin-top:6%;width:10%;height:10%;background-color: #ffffff;" />
			</div>
			<div class="loginbox">
				<div class="text-center">
					<h2 style="margin-top: 0;margin-bottom:0;"> Login</h2>
					<p class="messagelab">Use a valid username and password <br>to Login to system</p>
				</div>
				<label for="user">Enter your Login Id</label>
				<input name="user" id="user" value="" autocomplete="off" maxlength="50" type="text" size="20" placeholder="CRM Login Id..." />
				<label for="password" class="otp">Enter <span id="pwd_text">OTP</span></label>
				<input maxlength="30" name="password" id="password" type="password" size="20" autocomplete="off" placeholder="OTP..." />
				
				<br><span id="rmsg" class="fRight green"><?php echo $password_field_text; ?></span>
				<div id="err"></div>
				<input type="button" id="submit" class="buttonsub cursor" name="submit" value="Enter Login Id" />
			</div>
		</div>
        <script src="<?php echo $head_url; ?>/assets/js/jquery-1.10.2.js"></script>
        <script src="<?php echo $head_url; ?>/assets/js/login.js?v=1"></script>
    </body>
</html>