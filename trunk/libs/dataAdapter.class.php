<?


class DataAdapter {


	public static $allowedfields = array('text', 'join', 'largetext', 'photourl', 'date');
	/**
	 * 
	 */

	public static function dataFieldsAdapter($data, $fieldslist, $fieldaction = 'view', $rendered = false){
		$ret = array();
		foreach($data as $field => $value) {
			if (isset($fieldslist[$field])) {
				$type = $fieldslist[$field]['type'];
			
				if (in_array($type, self::$allowedfields)) {
					$typename = ucfirst($type);
					$classname = "Field_".$typename;
					$obj = new $classname();
				} else {
					$obj = new Field_Text();
				}
			
				$obj->setAllFieldsParams($field, $fieldslist[$field]);
				$obj->setValue($value);	
				$obj->setAction($fieldaction);
				if ($rendered == 'rendered') {
					$ret[$field] = $obj->renderSTR();
				} else {
					$ret[$field] = $obj;
				}
			}
		}
		return $ret;	
	}
	
	
	public static function dataFieldsAdapterEmpty($fieldslist, $fieldaction = 'view', $rendered = false){
		$ret = array();
		
		foreach($fieldslist as $field => $val) {
		
			$type = $fieldslist[$field]['type'];
			
			if (in_array($type, self::$allowedfields)) {
				$typename = ucfirst($type);
				$classname = "Field_".$typename;
				$obj = new $classname();
			} else {
				$obj = new Field_Text();
			}
			$obj->setAllFieldsParams($field, $fieldslist[$field]);
			$obj->setValue("");	
			$obj->setAction($fieldaction);
	
		
			if ($rendered == 'rendered') {
				$ret[$field] = $obj->renderSTR();
			} else {
				$ret[$field] = $obj;
			}
		}
		return $ret;	
	}	
	
	




}
