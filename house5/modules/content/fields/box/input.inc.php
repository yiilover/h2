	function box($field, $value) {
		if($this->fields[$field]['boxtype'] == 'checkbox') {
		//	if(!is_array($value) || empty($value)) return false;
			if(empty($value)) return false;
			if(!is_array($value)) return $value; // add by L 2012.3.29
			array_shift($value);
			$value = ','.implode(',', $value).',';
			return $value;
		} elseif($this->fields[$field]['boxtype'] == 'multiple') {
			if(is_array($value) && count($value)>0) {
				$value = ','.implode(',', $value).',';
				return $value;
			}
		} else {
			return $value;
		}
	}
