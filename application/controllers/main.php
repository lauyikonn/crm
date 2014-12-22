<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends Web_Controller {

	/** Module name **/
	public $name        = 'main';	
	function __construct() {
		parent::__construct();	
	}
	
	public function index(){
		$data = array(); 
		$this->_render_form('welcome',$data);
	}
	
	public function mock50kb(){
		$data = array(); 
		$this->_render_form('mock50kb',$data);
	}
	
	public function mock100kb(){
		$data = array(); 
		$this->_render_form('mock100kb',$data);
	}
	
	public function mock300kb(){
		$data = array(); 
		$this->_render_form('mock300kb',$data);
	}
	
	public function mock500kb(){
		$data = array(); 
		$this->_render_form('mock500kb',$data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */