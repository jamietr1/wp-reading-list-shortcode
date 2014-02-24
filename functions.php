<?php
	// Parses my reading.txt file on Dropbox and presents it dynamically as 
	// HTML for inclusion on a page in WordPress
	function get_reading_list() {
        ob_start();
		$handle = fopen('<DROPBOX URL TO FILE GOES HERE>', "rb");
		$contents = stream_get_contents($handle);
		fclose($handle);
		$lines = explode("\n", $contents);
		echo "<ol>\n";
		foreach ($lines as $line) {
			if ($line == "") {
				continue;
			}
			$isFavorite = $isEbook = $isAudio = 0;
			$part = explode(" by ", $line);
			$title = $part[0];
			$author_date = $part[1];
			$second_part = explode(" (", $author_date);
			$author = $second_part[0];
			$date = substr($second_part[1],0,-1);
		
			// Process title symbols
			$pos = strpos($title, "*");
			if ($pos !== false) {
				$isFavorite = 1;
				$title = str_replace("*", "", $title);
			}
		
			$pos = strpos($title, "+");
			if ($pos !== false) {
				$isEbook = 1;
				$title = str_replace("+", "", $title);
			}
		
			$pos = strpos($title, "@");
			if ($pos !== false) {
				$isAudio = 1;
				$title = str_replace("@", "", $title);
			}
		
			if ($isFavorite == 1) {
				$title = "<strong>$title</strong>";
			}
		
			if ($isEbook == 1) {
				$title = "<span style=\"color: #0000ff;\">$title</span>";
			}
		
			if ($isAudio == 1) {
				$title = "<span style=\"color: #ff6600;\">$title</span>";
			}
		
			echo "<li>$title by $author ($date)</li>\n";
		
		}
		echo "</ol>\n";
        return ob_get_clean();
	}
	add_shortcode('ReadingList', 'get_reading_list');
		
?>