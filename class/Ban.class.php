<?php 
require_once("Crud.class.php");
Class Ban extends Crud {
	protected $table = "Punishments";
	// LIMITE DE REGISTRO POR PAGINAS
	private $limite = LIMIT_PAG;
	private $pagina;
	private $offset;

	private $name;
	private $uuid;
	private $reaseon;
	private $operator;
	private $start;
	private $punishmentType;
	private $end;
	private $calculation;
	private $contador;


	// VALOR NULL PADRAO;
	private $null = "none";

	public function __construct($name = "", $uuid= "" ,$reaseon= "", $operator= "", $punishmentType="", $start= "", $end="", $calculation = 0, $contador = 0){
		$this->name 			= $name;
		$this->uuid 			= $uuid;
		$this->reaseon 			= mb_strtoupper($reaseon, "UTF-8");
		$this->operator 		= $operator;
		$this->punishmentType 	= $punishmentType;
		$this->start 			= $start;
		$this->end 				= $end;
		$this->calculation 		= $calculation;
		$this->contador 		= $contador;
	}


	public function findAllOrderBy(){
		$sql	= "SELECT * FROM $this->table ORDER BY id DESC";
		$stmt	= DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	public function findNameOrderBy($nome){
		$sql	= "SELECT * FROM $this->table WHERE name LIKE :NOME ORDER BY id DESC";
		$stmt	= DB::prepare($sql);
		$stmt->bindValue(":NOME", "%".$nome."%");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function rowCount(){
		$sql	= "SELECT * FROM $this->table";
		$stmt	= DB::prepare($sql);
		try{
			$stmt->execute();
			return $stmt->rowCount();	
		} catch (PDOException $e) {
			if ($e->getCode() == '42S02' or $e->getCode() == 1146) {
			 	echo "ERRO: ".$e->getCode()." Table '".$this->table."' doesn't exist <br>";
			}else{
				echo $e->getMessage();	
			}
		}	}

	public function findAllLimit(){
		$page = new Pages();
		$pagina = $page->getPage();
		$this->offset = ($pagina * $this->limite) - $this->limite;
		if ($this->offset <= 0) {
			$sql	= "SELECT * FROM $this->table order by id DESC LIMIT $this->limite OFFSET 0";
			$stmt	= DB::prepare($sql);
		}else{
			$limit 	= $pagina * $this->limite;
			$sql	= "SELECT * FROM $this->table order by id DESC LIMIT $this->limite OFFSET $this->offset";
			$stmt	= DB::prepare($sql);
		}
		try{
			$stmt->execute();
			return $stmt->fetchAll();	
		} catch (PDOException $e) {
			if ($e->getCode() == '42S02' or $e->getCode() == 1146) {
			 	echo "ERRO: ".$e->getCode()." Table '".$this->table."' doesn't exist <br>";
			}else{
				echo $e->getMessage();	
			}
		}
		
	}

	public function getOffset(){
		return $this->offset;
	}

	public function __toString(){
		$startBan = date(DATE_FORMAT, intval($this->start/1000));
		$endBan = date(DATE_FORMAT, intval($this->end/1000)); 
		if ($this->end < 1 AND $this->punishmentType == "BAN") {
			$endBan 	= "<th style='color:red;'>".PERMANENT."</th>"; 
		}else{
			$endBan 	= "<th style='color:green'>".$endBan."</th>";
		}

		if ($this->operator == "CONSOLE") {
			$this->operator = "<th><span class=\"oi oi-terminal\"></span>&nbsp".$this->operator."</th>";
		}else{
			$this->operator = "<th><img class='img-avatar' data-html='true' title='<b><center>".strtoupper($this->operator)."</b></center>' data-content=\"<img src='https://minotar.net/armor/body/".$this->operator."/100'/>\" data-toggle='popover'  src='https://minotar.net/avatar/".$this->operator."/24'>".strtoupper($this->operator)."</th>";	
		}

		// MSG BUTTON		
		$msg = "<button class=\"btn btn-sm btn-light btn-block uppercase\" title='<center>".REASEON."</center>' data-toggle='popover' data-html='true' data-content='".$this->reaseon."' ><span class=\"oi oi-magnifying-glass\"></span></button>";
		return 
		"<th>".$this->contador."</th>".
		"<th><img class='img-avatar' data-html='true' title='<b><center>".strtoupper($this->name)."</b></center>' data-content=\"<img src='https://minotar.net/armor/body/".$this->name."/100'/>\" data-toggle='popover'  src='https://minotar.net/avatar/".$this->name."/24'>  ".strtoupper($this->name)."</th>".
		"<th>".$msg."</th>"
		.$this->operator
		."<th>".$startBan."</th>"
		.$endBan;
	}
}