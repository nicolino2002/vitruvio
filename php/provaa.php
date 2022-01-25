<?php

$file_name=$_POST['file1'];
$file_to_download = '../uploads/-7904-'.$file_name;
$client_file = $file_name;

$download_rate = 200; // 200Kb/s

$f = null;

try {
	if (!file_exists($file_to_download)) {
		throw new Exception('File ' . $file_to_download . ' does not exist');
	}

	if (!is_file($file_to_download)) {
		throw new Exception('File ' . $file_to_download . ' is not valid');
	}

	header('Cache-control: private');
	header('Content-Type: application/octet-stream');
	header('Content-Length: ' . filesize($file_to_download));
	header('Content-Disposition: filename=' . $client_file);

	// flush the content to the web browser
	flush();
	$f = fopen($file_to_download, 'r');
	while (!feof($f)) {
		print fread($f, round($download_rate * 1024));
		flush();
		sleep(1);
	}
} catch (\Throwable $e) {
	echo $e->getMessage();
} finally {
	if ($f) {
		fclose($f);
	}
}
?>
