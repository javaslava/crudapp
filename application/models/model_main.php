<?php
class Model_main extends Model{
	
	private $query = 'SELECT pict_src, text FROM logo_slides WHERE visible=1 ORDER BY id';
	
	public function get_data(){
		return parent::requestResult($this -> query);
	}
	
	public function get_slider(){
		return 'application/views/start_slide_view.php';
	}
}