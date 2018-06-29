<?php
/**
*	CONFIG LANGUAGE
*	@param {String} PT_BR, PT-BR, pt-br, pt_br or EN, en
*/
const LANGUAGE = "en";


/**
*	CONFIG MYSQL
*	@param  {string}
*	DB_NAME DATA BASE NAME
*	DB_HOST HOST NAME
*	DB_USER USER NAME
*	DB_PASS PASSWORD
*/
// const DB_HOST 	= "sql2.freemysqlhosting.net"; 
// const DB_NAME 	= "sql2242296";
// const DB_USER 	= "sql2242296";
// const DB_PASS 	= "vU2*aT3*";
// const DB_PORT 	= "3306";


const DB_HOST 	= "localhost"; 
const DB_NAME 	= "advancedban";
const DB_USER 	= "root";
const DB_PASS 	= "root";
const DB_PORT 	= "3306";

/**
*	CONFIG LIMIT PAGINATION
*	@param {Int}
*/
define("LIMIT_PAG"	, 10);

if (LANGUAGE == "PT_BR" OR LANGUAGE == "PT-BR" OR LANGUAGE == "pt-br" OR LANGUAGE == "pt_br") {
	// PT_BR - PORTUGUÊS
	
	// BUTTON MENU
	define("BTN_HISTORIC", "Histórico&nbsp&nbsp&nbsp&nbsp&nbsp");

	// TABLE
	define("NICK"		, "NICK");
	define("TB_INDEX" 	,"LISTA DE BANIDOS");
	define("TB_HISTORY", "HISTÓRICO DE BANIDOS");
	define("SEARCH" 	, "Procurar");
	define("RASEON" 	, "MOTIVO");
	define("BY" 		, "POR");
	define("TYPE"		, "TIPO");
	define("DATE"		, "DATA");
	define("TIME" 		, "TEMPO");
	define("PROX" 		, "Proximo");
	define("VOLT" 		, "Voltar");

	// TYPE IN TABLE
	define("PERMANENT"	, "PERMANENTE");
	define("TEMPORARY"	, "TEMPORARIO");

	// DATATE FORMAT
	define("DATE_FORMAT", "d/m/Y - H:i:s");

}else{
	// EN - ENGLISH

	// BUTTON MENU
	define("BTN_HISTORIC", "Historic&nbsp&nbsp&nbsp&nbsp&nbsp");

	// TABLE
	define("NICK"		, "NICK");
	define("TB_INDEX" 	, "BANNED LIST");
	define("TB_HISTORY", "HISTORY LIST");
	define("SEARCH" 	, "Search");
	define("RASEON" 	, "REASEON");
	define("BY" 		, "BY");
	define("TYPE"		, "TYPE");
	define("DATE"		, "DATE");
	define("TIME" 		, "EXPIRES");
	define("PROX" 		, "Next");
	define("VOLT" 		, "Previous");

	// TYPE IN TABLE
	define("PERMANENT"	, "PERMANENT");
	define("TEMPORARY"	, "TEMPORARY");

	// DATATE FORMAT
	define("DATE_FORMAT", "Y/m/d - h:i A");

}


