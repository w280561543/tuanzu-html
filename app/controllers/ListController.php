<?php
class ListController extends ControllerBase {
	public function indexAction() {
		$this -> view -> obj = $this -> request -> hasQuery('filter') ? json_encode($this -> request -> getQuery('filter')) : 'undefined';
	}

}
?>