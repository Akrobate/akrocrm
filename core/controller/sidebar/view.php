<?php

class Sidebar_View extends CoreController {

	public function init() {
		$listContent = "Modules ";
		$this->assign('content', $listContent);
		
		$this->assign('moduleslist', $this->modules);
		
	}
		
		
	public function setModulesList($modules) {
		$this->modules = $modules;
	}
}
