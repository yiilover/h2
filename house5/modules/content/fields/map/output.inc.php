	function map($field, $value) {
		$str = '';
		$setting = string2array($this->fields[$field]['setting']);
		$setting[width] = $setting[width] ? $setting[width] : '600';
		$setting[height] = $setting[height] ? $setting[height] : '400';
		list($lngX, $latY,$zoom) = explode('|', $value);
		return $value;
	}
