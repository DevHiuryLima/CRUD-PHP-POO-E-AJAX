<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8" />
	<title>Cadastro de Filmes</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	
	<script src="js/jquery.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/ajax.js"></script>
</head>
<body>
<div  class="cuadro">
	<h3 class="text-uppercase text-center mt-2">Cadastre Seus Filmes</h3>
	<div class="form-group">
		<button id="btn_inserir" class="btn btn-default" style="cursor: pointer" title="Inserir novo filme" data-toggle="modal" data-target="#ventanaModal"><i class="fa fa-user"></i></button>
	</div>
	
	<div id="div_tabela">

	</div>
	
	<div class="d-flex justify-content-center paginas" >
		<nav aria-label="Page navigation example" class="">
		  <ul class="pagination" id="pagination">

		  </ul>
		</nav>
	</div>
	
</div>



<div class="modal fade" id="ventanaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
	
			<div id="alerta"></div>

			
				<div class="modal-header">
					<h5 class="modal-title h4 text-center text-uppercase">Cadastrar, alterar ou deletar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
					</button>
				</div>
				

				
				<div class="modal-body">
					
				<div class="form-group d-none" id="gif">
					<label><img src="images/ajax-loader.gif"/> Procesando...</label>
				</div>
				
				<div class="form-group">
					<input type="hidden" id="opcao"/>
					<input type="hidden" id="id"/>
				</div>

				<div class="form-group">
					<label for="">Nome: </label>
					<input type="text" id="txt_nome" class="form-control" placeholder="Insira o nome"/>
				</div>
				
				<div class="form-group">
					<label for="">Genero: </label>
					<input type="text" id="txt_genero" class="form-control" placeholder="Insira o genero"/>
				</div>
				
				<div class="form-group">
					<label for="">Classificação: </label>
					<input type="text" id="txt_classificacao" class="form-control" placeholder="Insira a classificação"/>
				</div>
			</div>
				

			
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="btn_salvar">Confirmar</button>
			</div>
		
		</div>
	</div>
</div>
</body>
</html>
