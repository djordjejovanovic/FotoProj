<?php
if (count($errors) > 0) {
	echo "<div class=\"error\">";
}

foreach ($errors as $error) {
	echo "<script type='text/javascript'>alert('$error');</script>";
}

echo "</div>";
?>