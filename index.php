<?php include "striga.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Striga </title>
    </head>
    <body>
        <section><h1>Primeira tag HTML5</h1></section>
    	<form action="index.php" method="post">
        String: <input type="text" name="msg">
        <input type="submit">
        </form>
        <?php
        	if (isset($_POST['msg'])){
				ga($_POST['msg']);
			}
        ?>
    </body>
</html>
