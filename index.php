<?php
require_once("config.php");
$punishments = new Ban();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php require_once("layout/header.php")?>
</head>
<body>
	<div class="container">
		<div class="row mt-4">
			<?php require_once("layout/menu.php")?>
			<div class="col-md-10">
				<div class="card">
					<div class="card-header bg-dark">
						<div class="row">
							<div class="col-md-6">
								<div class="titulo">
									<?php echo TB_INDEX?>
								</div>
							</div><!-- ./col-md-06 -->
							<div class="col-md-3 offset-md-3">
							<!-- SEARCH -->
								<div class="form-group">
									<form method="post">
										<div class="input-group input-group-sm">
										<input type="text" class="form-control" name="search" id="search" placeholder="<?php echo SEARCH?>"/>
										<span class="input-group-append">
											<button class="btn btn-sm btn btn-outline"><span class="oi oi-magnifying-glass"></span></button>
										</span>
										</div>
									</form>
								</div>
							</div><!-- ./SEACH -->
						</div><!-- ./row -->
					</div><!-- ./card-header  -->
						<div class="card-body">
							<table class="table table-hover border">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col"><?php echo NICK 	?></th>
										<th scope="col"><?php echo RASEON 	?></th>
										<th scope="col"><?php echo BY 		?></th>
										<th scope="col"><?php echo TYPE 	?></th>
										<th scope="col"><?php echo DATE 	?></th>
										<th scope="col"><?php echo TIME 	?></th>					
									</tr>
								</thead>
								<tbody>
									<?php 
										if (isset($_POST['search']) && $_POST['search'] != "" && $_POST['search'] != " ") {
											$array = $punishments->findNameOrderBy($_POST['search']);
											$rowCount = 1;
										}else{
											$array = $punishments->findAllLimit();
											$rowCount = $punishments->rowCount();
											$pg = true;
										}
										// COUNT
										($punishments->getOffset() <= 0) ? $contador = 0 : $contador = $punishments->getOffset();
										foreach ($array as $value):
											$contador++;
											$punishments = new Ban($value->name, $value->uuid, $value->reason, $value->operator, $value->punishmentType, $value->start, $value->end, $value->calculation, $contador);	
										?>
									<tr>
										<?php echo $punishments; ?>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
							<?php
							if (isset($pg)) {
								$paginas = ceil(($rowCount / LIMIT_PAG));
								require_once("layout/page.php");
							}
							?>
						</div><!-- ./card-body -->
					</div><!-- ./card -->
				</div><!-- ./col-md-12 -->
		</div><!-- ./row -->
	</div><!-- ./container -->
</body>
<?php require_once("layout/footer.php")?>
</html>
