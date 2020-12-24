<?php
$con = mysqli_connect('localhost', 'root', '', 'round45_project');

$tables = array();
$result = mysqli_query($con,"SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
	$tables[] = $row[0];
}

$return = '';

foreach ($tables as $table) {
	$result = mysqli_query($con, "SELECT * FROM ".$table);
	$num_fields = mysqli_num_fields($result);

	$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
	$return .= "\n\n".$row2[1].";\n\n";

	for ($i=0; $i < $num_fields; $i++) { 
		while ($row = mysqli_fetch_row($result)) {
			$return .= 'INSERT INTO '.$table.' VALUES(';
				for ($j=0; $j < $num_fields; $j++) { 
					$row[$j] = addslashes($row[$j]);
					if (isset($row[$j])) {
						$return .= '"'.$row[$j].'"';} else { $return .= '""';}
						if($j<$num_fields-1){ $return .= ','; }
					}
					$return .= ");\n";
}
}
$return .= "\n\n\n";

}

$filepath = "db_backup/backup".date('Y_m_d_H').".sql";
$handle = fopen($filepath, 'w+');
fwrite($handle, $return);
fclose($handle);

if(file_exists($filepath)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($filepath));
	flush();
	readfile($filepath);
	die();
} else {
	http_response_code(404);
	die();
}

echo "success";


?>