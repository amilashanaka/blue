<?php

// read a CSV file returning an array of rows
function read_csv($filename){
	$rows = array();

	foreach(file($filename, FILE_IGNORE_NEW_LINES) as $line){
		$rows[] = str_getcsv($line);
	}

	return $rows;
}
// write to csv
function write_csv($filename, $rows){
	$file = fopen($filename, "w");

	foreach ($rows as $row) {
		fputcsv($file, $row);
	}

	fclose($file);
}
// a function that will only be executed if data ws received from the GET
function execute_update(){
	// variables for the name of setting that needs to be changed and the new value for it
	$setting_name = $_GET['setting_name'];
	$setting_value = $_GET['setting_value'];
	// variable to check whether a value was changed in the settings array
	$found_and_changed = 0;
	// to access a variable outside of the function we need to declare the varibale global within the function
	global $data;

	// check if there is any data back from the csv file, it may be that it is empty
	if($data){
		foreach ($data as $key => $value) {
			if($value[0] === $setting_name){
				$data[$key][1] = $setting_value;
				$found_and_changed = 1;
			}
		}
	}
	
	// check if a setting with the name given was found and if not create the new setting
	if(!$found_and_changed){
		$new_entry = count($data);
		$data[$new_entry][0] = $setting_name;
		$data[$new_entry][1] = $setting_value;
	}

	write_csv("settings/interface_settings.csv", $data);

	$message = array();
	$message['message'] = "Success!";
	echo json_encode($message);
}

// read the csv and add the data to an array
$data = read_csv("settings/interface_settings.csv");


/////////////////////////////////////////////////////////
///////////// setting names of elements /////////////////
/////////////////////////////////////////////////////////

// read the CSV for the SET Names of elements and then update it with the new data
$data_names = read_csv("settings/interface_names.csv");

function set_new_name(){
	$id_of_el = $_GET['id_of_el'];
	$new_name_of_el = $_GET['new_name_of_el'];
	if ($new_name_of_el==''){$new_name_of_el=' ';}
	$found_and_changed = 0;
	global $data_names;
	// check if there is any data back from the csv file, it may be that it is empty
	if($data_names){
		foreach ($data_names as $key => $value) {
			if($value[0] === $id_of_el){
				$data_names[$key][1] = $new_name_of_el;
				$found_and_changed = 1;
			}
		}
	}
	if(!$found_and_changed){
		$new_entry = count($data_names);
		$data_names[$new_entry][0] = $id_of_el;
		$data_names[$new_entry][1] = $new_name_of_el;
	}
	write_csv("settings/interface_names.csv", $data_names);
	$message = array();
	$message['message'] = "Success!";
	echo json_encode($message);
}


if(isset($_GET['setting_name']) && isset($_GET['setting_value'])) {
	execute_update();
} elseif(isset($_GET['get_screen_update'])){
	echo json_encode($data);
} elseif (isset($_GET['get_screen_names_update'])) {
	echo json_encode($data_names);
} elseif (isset($_GET['id_of_el']) && isset($_GET['new_name_of_el'])) {
	set_new_name();
} else {
	$message = array();
	$message['message'] = "Nothing to update!";
	echo json_encode($message);
}

?>



