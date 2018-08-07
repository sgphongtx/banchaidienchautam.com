<?php
	$rs = mysqli_query($conn,"SELECT * FROM tbl_currency WHERE code<>'USD'");
	while ($row = mysqli_fetch_assoc($rs)) {
		$currency[] = $row;
	}

	foreach ($currency as $result) {
		$data_crc[] = "USD" . $result['code'] . '=X';
	}

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, 'http://download.finance.yahoo.com/d/quotes.csv?s=' . implode(',', $data_crc) . '&f=sl1&e=.csv');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);

	$content = curl_exec($curl);

	curl_close($curl);

	$lines = explode("\n", trim($content));

	foreach ($lines as $line) {
		$currency = substr($line, 4, 3);
		$value    = substr($line, 11, 6);
		if ((float)$value) {	
			$sql = "UPDATE tbl_currency SET value='".(float)$value."', date_modified='".date("Y-m-d H:i:s")."' WHERE code='$currency' AND code<>'USD'";
			mysqli_query($conn,$sql);
		}
	}
	header("location:" . url_direct("get","currency") );