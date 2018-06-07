<?php 
require_once("Crud.php");
Class Ban extends Crud {
	protected $table = "punishments";
	// LIMITE DE REGISTRO POR PAGINAS
	private $limite = LIMIT_PAG;
	private $pagina;
	private $offset;

	private $name;
	private $uuid;
	private $raseon;
	private $operator;
	private $start;
	private $punishmentType;
	private $end;
	private $calculation;
	private $contador;


	// VALOR NULL PADRAO;
	private $null = "none";

	public function __construct($name = "", $uuid= "" ,$raseon= "", $operator= "", $punishmentType="", $start= "", $end="", $calculation = 0, $contador = 0){
		$this->name 			= $name;
		$this->uuid 			= $uuid;
		$this->raseon 			= $raseon;
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
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function findAllLimit(){
		$page = new Pagina();
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
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getOffset(){
		return $this->offset;
	}

	public function __toString(){
		$startBan = date(DATE_FORMAT, intval($this->start/1000));
		$endBan = date(DATE_FORMAT, intval($this->end/1000)); 
		if ($this->end < 1 AND $this->punishmentType == "BAN") {
			$bantype 	= "<th style='color:red;'>".PERMANENT."</th>"; 
			$endBan 	= "<th style='color:red;'>".PERMANENT."</th>"; 
		}else{
			$bantype 	= "<th style='color:green;'>".TEMPORARY."</th>";
			$endBan 	= "<th style='color:green'>".$endBan."</th>";
		}

		// MSG BUTTON		
		$msg = "<button class=\"btn btn-sm btn-light btn-block\" title='<center>".RASEON."</center>' data-toggle='popover' data-html='true' data-content='".strtoupper($this->raseon)."' ><span class=\"oi oi-magnifying-glass\"></span></button>";
		return 
		"<th>".$this->contador."</th>".
		"<th><img class='img-avatar' data-html='true' data-content=\"<img src='https://minotar.net/armor/body/".$this->name."/100'/>\" data-toggle='popover'  src='https://minotar.net/avatar/".$this->name."/24'>  ".strtoupper($this->name)."</th>".
		"<th>".$msg."</th>".
		"<th>".$this->operator."</th>".
		$bantype.
		"<th>".$startBan."</th>".
		$endBan;
	}
}