<?php
class IndexController extends ControllerBase {
	public function indexAction() {}

	public function joinAction() {}

	public function faqAction() {}
	
	public function aboutAction() {}
	
	public function fdAction() {}

	public function notFoundAction() {
		echo '<h1>404 Not Found!</h1>';
		$this -> response -> setStatusCode(404, "Not Found");
		exit;
	}

}
?>