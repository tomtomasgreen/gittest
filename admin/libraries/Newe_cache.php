<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Newe_cache {
	
	private $_cachepath;
	
	public function __construct() {
		$this->_cachepath = APPPATH . 'cache/';
	}
	
	public function write($name, $data) {
		$dataStr = '<?php return ' . var_export ( $data, TRUE ) . ';';
		$file = $this->_cachepath . $name . '.php';
		$count = file_put_contents($file, $dataStr);
		return $count;
	}
	
	public function read($name) {
		$file = $this->_cachepath . $name . '.php';
		$data = array();
		if(file_exists($file)) {
			$data = include $file;
		}
		return $data;
	}
	
}
