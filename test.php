<!DOCTYPE html>
<html>
	<body>
		<h1>My first PHP page</h1>
	</body>
</html>

<?php
print_r($_GET);
echo($_GET['user_id']);


$value = '1234';
echo "'1234' Is data type - ".gettype($value);
?>