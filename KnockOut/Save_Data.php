<?php

  	require_once("config.php"); 
  	require_once("adodb/adodb.inc.php");
  	session_start();

	$table = 'testcol.LOADDATA';

  	//$json =  '{"tasks":
  	// 	[{"title":"FINISH DOCUMENTATION FOR WEB PROJECT","isDone":false},
  	//   {"title":"GET A HAIRCUT","isDone":false},
  	//   {"title":"MAKE RESERVATIONS FOR VACATION","isDone":false},
  	//   {"title":"TASK 1","isDone":false,"_destroy":true},
  	//   {"title":"TASK 2","isDone":true,"_destroy":true},
  	//   {"title":"TASK 3","isDone":false},
  	//   {"title":"TASK 4","isDone":false}]}';
  	$json = file_get_contents('php://input');
  	$input = json_decode($json);
	//$count = count($input->tasks);
  	//echo "count:".$count;
  	//print_r($input);
  	//echo "title:".$input->tasks[3]->title;
  	//echo "isDone":.$input->tasks[3]->isDone;
  	//echo "_destroy:".$input->tasks[3]->_destroy;

 	// Connect to the db 
    $db =& ADONewConnection('db2');
	if(!$db->PConnect(HOST, USERNAME, PASSWORD, DB_NAME)) {
    	throw new Exception($db->ErrorMsg(), $db->ErrorNo());
    } 
    
    // Delete all the records from the table.
    $sql = "DELETE FROM $table";
    $res = $db->Execute($sql);
	if(!$res) throw new Exception($db->ErrorMsg(), $db->ErrorNo());
  
	$db =& ADONewConnection('db2');
	if(!$db->PConnect(HOST, USERNAME, PASSWORD, DB_NAME)) {
    	throw new Exception($db->ErrorMsg(), $db->ErrorNo());
    }   
    
    // Add back all except the records selected for deletion.
  	$i=0; 
  	while ($i < count($input->tasks)) {
  		if ($input->tasks[$i]->_destroy != '1') {;
    		if ($input->tasks[$i]->isDone == true) {
				$taskdone = "'1'";
			} else {
				$taskdone = "'0'";
			};
      		$taskname = "'".trim($input->tasks[$i]->title)."'";
			$sql = "INSERT into $table values($taskname,$taskdone)";
    		//echo $sql;
    		$res = $db->Execute($sql);
			if(!$res) throw new Exception($db->ErrorMsg(), $db->ErrorNo());
     	}
    	$i++;
	}                          
?>