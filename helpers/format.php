<?php
	class format{
		public function formatDate($date){
			return  date('F j, Y, g:i a',strtotime($date));
		}
		
		public function textshorten($text, $limit=350){
			$text = $text. ' ';
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text.'....';
			return $text;
		}
	}
?>