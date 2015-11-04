<?php
	class DbConnection
	{
		public $actobj='';
		public function getPost($key)
		{
			if(isset($_POST[$key]))
				return $_POST[$key];
			else
				return '';
		}

		public function getAll($options='')
		{ 
			$res = ($options === '')?$this->actobj->find('all'):$this->actobj->find('all',$options);
			if(!$res) {	return null;	}
			return $this->json_to_array($res);
		}

		public function save($class,$data)
		{
			$this->actobj=new $class($data);
			$this->actobj->save();
			$ins=$this->actobj->id;
			return $ins;
		}
		
		public function query($class,$qry)
		{
			$this->actobj=$class::find($qry);
			$c=$this->actobj->delete();
			if($c)
				return true;
			else
				return false;
		}

		private function json_to_array($json)
		{
			$arr=array();
			foreach($json as $k=>$v) {
				$arr[] = json_decode($v->to_json(), true);
			}
			return $arr;
		}
	}
?>
