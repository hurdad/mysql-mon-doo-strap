<?php

class DesktopController extends DooController {

	function index(){
		$data['title'] = 'MySQL Monitor';
		$this->renderc('db_stats', $data);
	}

}
?>
