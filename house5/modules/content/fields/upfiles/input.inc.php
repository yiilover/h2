	function upfiles($field, $value) {
		//ȡ��ͼƬ�б�
		$pictures = $_POST[$field.'_url'];
		//ȡ��ͼƬ˵��
		$pictures_alt = isset($_POST[$field.'_alt']) ? $_POST[$field.'_alt'] : array();
		$array = $temp = array();
		if(!empty($pictures)) {
			foreach($pictures as $key=>$pic) {
				$temp['url'] = $pic;
				$temp['alt'] = $pictures_alt[$key];
				$array[$key] = $temp;
			}
		}
		else
		{
			return addslashes($value);// add by L 2012/3/28 �������� ���õ�
		}
		$array = array2string($array);
		return $array;
	}
