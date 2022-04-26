<?php
	declare (strict_types = 1);
	require_once "connection.php";
	
	class Filmes extends Connection{
		
		public function __construct(){
			parent::__construct();
		}
		// Função que insere os dados.
		public function inserir(string $nome, string $genero, string $classificacao){
			error_reporting(0);
			try {
				$query= "INSERT INTO filmes VALUES(null,:nome,:genero,:classificacao);";
				$result = $this->database->prepare($query);
				$result->execute(array(':nome' => $nome, ':genero' => $genero, ':classificacao' => $classificacao));		
				echo "SALVO";
			} catch (PDOException $error) {
				echo "ERROR";
			}
		}
		
		// Função que remove os dados.
		public function remover(int $id){
			error_reporting(0);
			try {
				$query = "DELETE FROM filmes WHERE idFilme=:id";
				$result = $this->database->prepare($query);
				$result->execute(array(':id' => $id));		
				echo "SALVO";
			} catch (PDOException $error) {
				echo "ERROR";
			}
		}

		// Função que edita os dados.
		public function editar(int $id, string $nome, string $genero, string $classificacao){
			error_reporting(0);
			try {
				$query = "UPDATE filmes SET nome=:nome, genero=:genero, classificacao=:classificacao WHERE idFilme=:id";	// 	no video o final da query tem ponto e virgula.
				$result = $this->database->prepare($query);
				$result->execute(array(':id' => $id, ':nome' => $nome, ':genero' => $genero, ':classificacao' => $classificacao));
				if ($result->rowCount()) {
					echo "SALVO";
				} else {
					echo "DADOS IGUAIS";
				}	
			} catch (PDOException $error) {
				echo "ERROR";
			}	
			
		}

		//Metodo que mostra todos o registros.
		public function getAll():array{
			$query = "SELECT * FROM filmes ORDER BY nome";
			return $this->consultaSimples($query);
		}
		
		public function showTable(array $array):string{
			$html = "";
			if (count($array)) {
				$html = '   <table class="table table-striped" id="table">
							<thead>
								<th class="d-none"></th>
								<th>Nome</th>
								<th>Genero</th>
								<th>Classificação</th>
								<th>Opções</th>
							</thead>
	
							<tbody>
						 ';
				foreach ($array as $value) {
					$html .= '  <tr>
							<td class="d-none">' . $value['idFilme'] . '</td>
							<td>' . $value['nome'] . '</td>
							<td>' . $value['genero'] . '</td>
							<td>' . $value['classificacao'] . '</td>
							<td class="text-center">
								<button title="Editar este Filme" class="editar btn btn-secondary" data-toggle="modal" data-target="#ventanaModal">
									 <i class="fa fa-pencil-square-o"></i>
								</button><br/><br/>
	
								<button title="Remover este Filme" type="button" class="remover btn btn-danger" style="cursor: pointer" data-toggle="modal" data-target="#ventanaModal">
									<i class="fa fa-trash-o"></i>
								</button>
							</td>
							</tr>
							 ';
				}
				$html .= '  </tbody>
						</table>';
			} else {
				$html = '<h4 class="text-center">Não há filmes...</h4>';
			}
			return $html;
	
		}
	}
?>
