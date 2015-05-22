<?php
	$file_array = file("strings.txt");
	$content1 = '';
	$content2 = '';
	foreach ($file_array as $arr) {
		$arr_new = preg_split("/[\/,]+/", $arr);
		$content1 .= $arr_new[0].PHP_EOL;
		$content2 .= $arr_new[count($arr_new)-1];
	}
?>
<html>
	<head>
	</head>
	<body>
		<textarea id="textarea1" style="width: 45%; float: left; height: 500px;">
			<?php echo $content1; ?>
		</textarea>	
		<textarea id="textarea2" style="width: 45%; float: left; height: 500px;">
			<?php echo $content2; ?>
		</textarea>
	</body>
</html>