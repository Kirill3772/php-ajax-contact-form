<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Example AJAX and PHP form</title>
	<link rel="stylesheet" href="/test/mailstyle.css"/>
</head>
<body>
	<div id="logo-wrap">
		<img src="/images/articulate-seo-logo.gif" href="http://articulateseo.com" alt="" id="logo"/>
	</div>
	<form method="POST">
                    <label>First name: <input type="text" name="fname" id="fname"></label>
                    <label>E-mail: <input type="text" name="email" id="email"></label>
                    <label>Describe your project: <textarea rows="5" cols="40" name="message" id="message"></textarea></label>
                    <input type="button" id="submit" value="Submit">
                    <span id="response">LOADING</span>
                    <span id="connect-err"></span>
                </form>
<script type="text/javascript" src="/test/testmail.js"></script>
<div id="copyright" class="relative">&copy; Kirill Sukharev <?php echo date("Y"); ?></div>
</body>
</html>
