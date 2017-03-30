<?php
class ListController extends ControllerBase {
	public function indexAction() {
		$currentPage = $this -> request -> hasQuery('p')?$this -> request -> getQuery('p', "int"):1;
		$builder = $this -> modelsManager -> createBuilder()
			-> from('TuanzuRoom')
			-> columns(array('TuanzuRoom.id, TuanzuRoom.number, TuanzuRoom.tab, TuanzuRoom.title, TuanzuRoom.price, TuanzuRoom.titlepic, ts.street'))
			-> innerJoin('TuanzuSuite', 'ts.id = TuanzuRoom.suite_id', 'ts')
			-> where('TuanzuRoom.member_id is NULL AND TuanzuRoom.status = 0 AND TuanzuRoom.price <> 0')
			-> orderBy('TuanzuRoom.price ASC');

		$paginator = new Phalcon\Paginator\Adapter\QueryBuilder(array(
			'builder' => $builder,
			'limit'   => 16,
			'page'    => $currentPage
		));
		if($this -> request -> hasQuery('filter')) {
			$this -> view -> obj = json_encode($this -> request -> getQuery('filter'));
		} else {
			$this -> view -> obj = 'undefined';
		}
//		var_dump($paginator -> getPaginate());exit;
		$this -> view -> page = $paginator -> getPaginate();
	}

}
?>