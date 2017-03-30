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
		if($this -> request -> hasQuery('filter')) {
			$filter = $this -> request -> getQuery('filter');
//			var_dump($filter);exit;
			if(isset($filter['district'])) {
				//$builder -> addWhere('ts.district LIKE "' . $filter['district'] . '"');
				//var_dump($builder);exit;
			}
			if(isset($filter['line'])) {
				//$builder -> addWhere('ts.line LIKE "' . $filter['line'] . '"');
			}
			if(isset($filter['price'])) {
				$price = explode('-',$filter['price']);
				$builder -> betweenWhere('TuanzuRoom.price',$price[0],$price[1]);
			}
			$this -> view -> obj = json_encode($this -> request -> getQuery('filter'));
		} else {
			$this -> view -> obj = 'undefined';
		}

		$paginator = new Phalcon\Paginator\Adapter\QueryBuilder(array(
			'builder' => $builder,
			'limit'   => 16,
			'page'    => $currentPage
		));
		$this -> view -> page = $paginator -> getPaginate();
	}

}
?>