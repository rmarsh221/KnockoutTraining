<?php 
  
require_once("config.php"); 

// Set table name for SQL statements.
$library = 'testcol';
 
$conn = db2_connect(DB_NAME, USERNAME, PASSWORD);

$sql = "SELECT RRN(t) AS ID, TASKNAME, TASKDONE
          FROM $library.LOADDATA t
          ORDER BY TASKNAME
          FETCH FIRST 25 ROWS ONLY"; // echo $sql;

if ($conn) {
    $stmt = db2_exec($conn, $sql);
    $i=0; 
	$item = Array();
    while ($row = db2_fetch_object($stmt)) {
    	if ($row->TASKDONE == '1') {
			$isDone = true;
		} else {
			$isDone = false;
		};
		$thing = Array("title"=>$row->TASKNAME,"isDone"=>$isDone);
		array_push($item, $thing);
		// JSON format example:
		// [{"title":"Wire the money to Panama","isDone":true},
		//  {"title":"Get hair dye, beard trimmer, dark glasses and \"passport\"","isDone":false},
		//  {"title":"Book taxi to airport","isDone":false},
		//  {"title":"Arrange for someone to look after the cat","isDone":false}]
        $i++;
    }
    echo json_encode($item);
}
?>