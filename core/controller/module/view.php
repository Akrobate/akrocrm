<?php

	class Module_View extends CoreController {

		public function init() {
	
			$id = request::get('id');
			$fields = OrmNode::getFieldsFor($this->getModule());
			$data = array();
			$orm = new OrmNode();
			$content = $orm->getData($this->getModule(), $id);
			$data = OrmNode::dataFieldsAdapter($content, $fields, 'view', 'rendered');		
			$this->assign('fields', $data);
			
			// On recupere les subpannels
			$modulesjoins = ModuleManager::getJoinsOnModule($this->getModule());
			$lists = array();
		
			foreach ($modulesjoins as $modulename=>$module) {
				foreach($module as $key=>$val) {
					$listobj = new List_View();
					$listobj->setFilter($key . " = " . $id);
					$listobj->setModule($modulename);
					$listobj->setAction('view');
					$lists[] = $listobj->renderSTR();		
				}
			}
			$this->assign('sublists', $lists);
		}
	}
