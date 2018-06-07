<?php
// DEFINA O NOME DO SEU SITE

require_once("config.php");
$page = new Pagina();
if(strpos($_SERVER['REQUEST_URI'], 'historico')){
	$bans = new Historico();
}elseif (strpos($_SERVER['REQUEST_URI'], 'alertas')) {
	$bans = new Alerta();
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
						."<a href=\"".$page->pageVolta()."\" class=\"page-link\">Voltar</a>"
						."</li>";
					}else{
						echo "<li class=\"page-item disabled\">"
						."<a href=\"#\" class=\"page-link\">Voltar</a>"
						."</li>";
					}
				?>
			<li class="page-item disabled">
	     		 <a class="page-link" href="#"><?php echo $page->getPage() ?></a>
	    	</li>
			<?php
				if (count($bans->findAllLimit()) && ($paginas > $_GET['page']) ) {
					echo "<li class=\"page-item\">
						<a href=\"".$page->pageProxima()."\" class=\"page-link\">Próximo</a>
					</li>";
				}else{
					echo "<li class=\"page-item disabled\">
						<a href=\"".$page->pageProxima()."\" class=\"page-link\">Próximo</a>
					</li>";
				}
			?>
		</ul>
	</nav>
</div>