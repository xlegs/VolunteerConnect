<?php

echo <<<EOT

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>VolunteerConnect</title>

	<link rel="stylesheet" type="text/css" href="Include/Global.css" />
	<script src="/Include/scripts.js"></script>
    <link rel="stylesheet" type="text/css" href="Include/VCNav.css">
    <link rel="stylesheet" type="text/css" href="Include/VCLogin.css">

</head>

<body>

<script>
function hello()
{
	a = document.getElementById('a').textContent;
	b = document.getElementById('b').textContent;
	c = document.getElementById('c').textContent;
	d = document.getElementById('d').textContent;
	alert("You have just registered for: \\n" + a + "\\n" + b + "\\n" + c + "\\n" + d);
}
</script>

EOT;

?>

<?php include('VCNav.php'); ?>