ERROR

<?php

	$pos=false;

	if (isset($_GET['message'])) {
		$pos = strpos($_GET['message'], 'Duplicate entry');

		if ($pos!==false)
			echo "The name <b>".$_GET['name']."</b> already exists in the database./n";
		else
			echo "An error occured - please try again";
	}
	else
		echo "An error occured - please try again";

?>