<?php 
Class Pages {
	
	private $page;

	public function clearUrl(){
		$uri = $_SERVER['REQUEST_URI'];
		$url = preg_replace('/[0-9]+/', '', $uri);
		$url = str_replace("?page=", "", $url);
		return $url;
	}

	public function pageVolta(){
		$url = $this->clearUrl();
		if ($this->page >= 2) {
			return $url = $this->clearUrl()."?page=".($this->page-1);
		}
	}

	public function pageProxima(){
		$url = $this->clearUrl();
		return $url = $this->clearUrl()."?page=".($this->page+1);
	}


	// GET PAGA
	public function __construct(){
		if(strpos($_SERVER['REQUEST_URI'], 'history')){
			$ban = new Historic();
		}else{
			$ban = new Ban();
		}
		// EXISTE ALGO NO GET;
		if (isset($_GET['page'])) {
			if (is_numeric($_GET['page']) AND $_GET['page'] > 0 ) {
				$paginas = ceil(($ban->rowCount() / LIMIT_PAG));
				if($paginas < $_GET['page']){
					if(strpos($_SERVER['REQUEST_URI'], 'history')){
						header("Location: history.php?page=".$paginas);
					}else{
						header("Location: index.php?page=".$paginas);						
					}
				}// GET NUMEROCO E MAIOR QUE 0;
			return $this->page = $_GET['page'];
			}
			else{
				// GET NÃO NUMERO OU <= 1;
				return $this->page = 1;
			}
		}
		else{
			// SEM VALOR NO GET;
			return $_GET['page'] = 1;
			// return $this->page = 1;
		}
	}

	public function __toString(){
		return $this->page;
	}

	public function getPage(){
		return $this->page;
	}
}