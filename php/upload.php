<?php
	ini_set('max_input_time', 60);
	phpinfo();
	print_r($_FILES);
	include('audio_handler.php');
	if(isset($_GET['rhythm']) and isset($_GET['melody']) and isset($_GET['bass']) and 
	isset($_GET['adequacy']) and isset($_GET['ringing']) and isset($_FILES)){
		if(isset($_FILES['sound_file'])){
			if($_FILES['sound_file']['error'] == 0){
				$destiation_dir = dirname(__FILE__) .'/'.$_FILES['sound_file']['name']; 
				echo $destiation_dir;
				move_uploaded_file($_FILES['sound_file']['tmp_name'], $destiation_dir );
			} 
		}else{
			echo "no";
		}
	}else{
		echo "nope";
	}
?>