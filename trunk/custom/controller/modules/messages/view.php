<?php

	class Modules_Messages_View extends CoreController {

		public function init() {
	
			$id = request::get('id');
			
			$this->assign('id', $id);
			$mainmodule = $this->getModule();
			$this->assign('mainmodule', ucfirst($mainmodule));
			
			$fields = OrmNode::getFieldsFor($mainmodule);
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
				
					$subpannelobj = new List_Subpanel();
					$subpannelobj->setFilter($key . " = " . $id);
					$subpannelobj->setModule($modulename);
					$subpannelobj->setAction('view');
					
					$lists[] = array('content'=>$subpannelobj->renderSTR(), 'title'=> ucfirst($modulename));
				}
			}
			$this->assign('sublists', $lists);
		}
	}