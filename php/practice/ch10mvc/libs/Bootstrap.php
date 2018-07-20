<?php
class Bootstrap{
	
	private $_url;
	private $_controller;
	
	public function init(){
		
		$this->setURL();
		if(!isset($this->_url['controller'])){
			$this->loadDefaultController(); // đối tượng mặc định là index trang home 
			//chưa có DB, khởi tạo đối tượng và chạy hàm index
			exit();
		}
		
		$this->loadExistController(); // khởi tạo đối tượng và loadmodel
		$this->callControllerMethod(); // chạy hàm trong đối tượng, là action truyền vào
	}
	
	// SET URL
	private function setURL(){
		$this->_url = isset($_GET) ? $_GET : null;
	} 
	
	// LOAD DEFAULT CONTROLLER
	private function loadDefaultController(){
		require_once (CONTROLLER_PATH . 'index.php');
		$this->_controller = new Index();
		$this->_controller->index();
	}
	
	// LOAD EXISTING CONTROLLER
	private function loadExistController(){
		$file = CONTROLLER_PATH . $this->_url['controller'] . '.php';
		if(file_exists($file)){
			require_once $file;
			$controllerName = ucfirst($this->_url['controller']);
			$this->_controller = new $controllerName();
			$this->_controller->loadModel($this->_url['controller']);
		}else{
			$this->error();
		}
	}
	
	// CALL METHODE
	private function callControllerMethod(){
		if(method_exists($this->_controller, $this->_url['action'] )==true){
			$this->_controller->{$this->_url['action']}();
		}else{
			$this->error();
		}
	}

	public function error(){
		require_once CONTROLLER_PATH . 'error.php';
		$error = new Error();
		$error->index();
	}
}