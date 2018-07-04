<?php 
Class Pages {
	
	private $page;
	private $pages;
	
	public function clearUrl(){
		$uri = $_SERVER['REQUEST_URI'];
		$url = preg_replace('/[0-9]+/', '', $uri);
		$url = str_replace("?page=", "", $url);
		return $url;
	}
	public function clearGet(){
		$uri = $_SERVER['REQUEST_URI'];
		$page = preg_replace('/[^0-9]/', '', $uri);
		$page = str_replace("?page=", "", $page);
		return $page;
	}

	public function pageVolta(){
		$url = $this->clearUrl();
		if ($this->page >= 2) {
			return $url = $this->clearUrl()."?page=".($this->page-1);
		}
	}

	public function pageProxima(){
		$url = $this->clearUrl();
		if ($this->page < $this->pages) {
			return $url = $this->clearUrl()."?page=".($this->page+1);
		}
	}


	// GET PAGE
	public function __construct(){
		if(strpos($_SERVER['REQUEST_URI'], 'history')){
			$ban = new Historic();
		}else{
			$ban = new Ban();
		}
		// EXISTE ALGO NO GET;
		if (isset($_GET['page'])) {
			// GET NUMEROCO E MAIOR QUE 0; 
			if (is_numeric($_GET['page']) AND $_GET['page'] > 0 ) {
				$this->pages = ceil(($ban->rowCount() / LIMIT_PAG));
				
				if($this->pages < $_GET['page']){
					if(strpos($_SERVER['REQUEST_URI'], 'history')){
						return header("Location: history.php?page=".$this->pages);
					}else{
						return header("Location: index.php?page=".$this->pages);						
					}
				}
			return $this->page = $_GET['page'];
			}
			// GET NÃO NUMERO OU <= 1;
			else{
				return header("Location: index.php?page=1");
			}
		}
		else{
			// SEM VALOR NO GET;
			return $_GET['page'] = 1;
			// return $this->page = 1;
		}
	}

	// PAGINATION
	public function listPages(){
		// BUTTON << 
		if ($this->page > 1) {
			echo "<li class=\"page-item\">"
					."<a href=\"".$this->clearUrl()."?page=1"."\" class=\"page-link\">&laquo;</a>"
				."</li>";
		}
		
		// BUTTON PREVIOUS
		if ($this->pageVolta()) {
			echo "<li class=\"page-item\">"
					."<a href=\"".$this->pageVolta()."\" class=\"page-link\">".VOLT."</a>"
				."</li>";
		}

		// NUMEROS ATE PAGINA ATUAL
		for ($i=($this->page-4); $i < $this->page; $i++) { 
			if ($i > 0) {
				echo "<li class=\"page-item\">"
						."<a href=\"".$this->clearUrl()."?page=".$i."\" class=\"page-link\">".$i."</a>"
					."</li>";
			};	
		}

		// PAGINA ATUAL
		echo "<li class=\"page-item disabled\">"
				."<a href=\"#\" class=\"page-link\">".$this->page."</a>"
			."</li>";
		
		// PAGINA ATUAL PRA FRENTE
		for ($i=($this->page+1); $i < $this->page+5; $i++) { 
			if ($i <= $this->pages) {
				echo "<li class=\"page-item\">"
						."<a href=\"".$this->clearUrl()."?page=".$i."\" class=\"page-link\">".$i."</a>"
					."</li>";
			};	
		}

		// BUTTON NEXT
		if ($this->pageProxima()) {
			echo "<li class=\"page-item\">"
					."<a href=\"".$this->pageProxima()."\" class=\"page-link\">".PROX."</a>"
				."</li>";
		}

		// BUTTON >>
		if ($this->page < $this->pages) {
			echo "<li class=\"page-item\">"
					."<a href=\"".$this->clearUrl()."?page=".$this->pages."\" class=\"page-link\">&raquo;</a>"
				."</li>";
		}
	}

	public function __toString(){
		return $this->page;
	}

	public function getPage(){
		return $this->page;
	}
	public function getPages(){
		return $this->pages;
	}

}