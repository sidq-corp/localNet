<?php 
	function writer($text){
		$f = fopen("audio/info.json", "a");
		fwrite($f, "$text\n");
		fclose($f);
	}

	function reader(){
		$f = fopen("audio/info.json", "r");
		$text = fread($f, filesize("audio/info.json"));
		fclose($f);
		return $text;
	}

	function add_sound($file_name, $sound_name, $sound_singer,
					   $rhythm, $melody, $bass, $adequacy, $ringing){
		$info = array(
			"file_name"    => $file_name,
			"sound_name"   => $sound_name,
			"sound_singer" => $sound_singer,
			"rhythm"       => $rhythm, 
			"melody"       => $melody,
			"bass"         => $bass,
			"adequacy"     => $adequacy,
			"ringing"      => $ringing
		);
		writer(json_encode($info));
	}

	function search_sound($rhythm, $melody, $bass, $adequacy, $ringing){
		$deltas = array();
		$good_deltas = array();
		$answer = array();
		$sounds = explode("\n", reader());

		for ($i = 0; $i < count($sounds); $i++){
			$temp_json = $sounds[$i];
			$temp = json_decode($temp_json, true);
			
			$s_rhythm = $temp['rhythm'];
			$s_melody = $temp['melody'];
			$s_bass = $temp['bass'];
			$s_adequacy = $temp['adequacy'];
			$s_ringing = $temp['ringing'];

			$delta_rhythm   = abs($rhythm   - $s_rhythm);
			$delta_melody   = abs($melody   - $s_melody);
			$delta_bass     = abs($bass     - $s_bass); 
			$delta_adequacy = abs($adequacy - $s_adequacy);
			$delta_ringing  = abs($ringing  - $s_ringing);

			$max_delta = max($delta_rhythm, $delta_melody, $delta_bass,
							 $delta_adequacy, $delta_ringing);

			array_push($deltas, $max_delta);
		}

		while(count($deltas) != 0){

			$min = min($deltas);
			$index = array_search($min, $deltas);
			unset($deltas[$index]);

			if($min < 70){
				array_push($good_deltas, $index);
			}

		}
		
		for ($i = 0; $i < count($good_deltas); $i++) { 
			$favorite_sound = json_decode($sounds[$good_deltas[$i]], true);

			$file_name    = $favorite_sound['file_name'];
			$sound_name   = $favorite_sound['sound_name'];
			$sound_singer = $favorite_sound['sound_singer'];

			array_push($answer, array($file_name, $sound_singer, $sound_name));
		}
		

		return $answer;
	}
	
	print_r(search_sound(34,234,23,234,230));	

?>