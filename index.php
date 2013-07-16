<?php include "striga.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> F </title>
    </head>
    <body>
    	<form action="index.php" method="post">
        String: <input type="text" name="msg">
        <input type="submit">
        </form>
        <?php
        	if (isset($_POST['msg'])){
				Pop($_POST['msg']);
			}
        ?>
    </body>
</html>
