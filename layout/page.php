<?php
// DEFINA O NOME DO SEU SITE

require_once("config.php");
$page = new Pages();
if(strpos($_SERVER['REQUEST_URI'], 'history')){
	$bans = new Historic();
	$nPage = "history.php?page=";
}else{
	$bans = new Ban();
	$nPage = "index.php?page=";
}
?>
<div class="btn-block">
	<nav>
		<ul class="pagination pagination-sm  justify-content-center">
			<?php $page->listPages();?>
		</ul>
	</nav>
</div>