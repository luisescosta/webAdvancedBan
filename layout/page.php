<?php
// DEFINA O NOME DO SEU SITE

require_once("config.php");
$page = new Pages();
if(strpos($_SERVER['REQUEST_URI'], 'history')){
	$bans = new Historic();
}else{
	$bans = new Ban();
}
?>
<div class="btn-block">
	<nav>
		<ul class="pagination pagination-sm  justify-content-center">			
				<?php 
					if($page->pageVolta()){
						echo "<li class=\"page-item\">"
						."<a href=\"".$page->pageVolta()."\" class=\"page-link\">".VOLT."</a>"
						."</li>";
					}else{
						echo "<li class=\"page-item disabled\">"
						."<a href=\"#\" class=\"page-link\">".VOLT."</a>"
						."</li>";
					}
				?>
			<li class="page-item disabled">
	     		 <a class="page-link" href="#"><?php echo $page->getPage() ?></a>
	    	</li>
			<?php
				if (count($bans->findAllLimit()) && ($paginas > $_GET['page']) ) {
					echo "<li class=\"page-item\">
						<a href=\"".$page->pageProxima()."\" class=\"page-link\">".PROX."</a>
					</li>";
				}else{
					echo "<li class=\"page-item disabled\">
						<a href=\"".$page->pageProxima()."\" class=\"page-link\">".PROX."</a>
					</li>";
				}
			?>
		</ul>
	</nav>
</div>