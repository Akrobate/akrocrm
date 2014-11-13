<?


class FieldText extends Fields {
	
	public function __construct() {
		$this->template = "core/fields/text/views/edit.php";
	}
	
	
	public function init() {
		if ($this->action == 'edit') {
			$this->template = "core/fields/text/views/edit.php";
		} else if ($this->action == 'view') {
			$this->template = "core/fields/text/views/view.php";
		}
	}



}
