<?php
	declare (strict_types = 1);
	class Connection{
		protected $database;
		
		public function __construct(){
			$this->database = $this->connect();
		}
		
		private function connect(){
			try{
				$host = "localhost";	// "127.0.0.1"
				$dbname = "bdfilmes";
				$user = "root";
				$password = "";
				
				$connection = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
				
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connection->exec('SET CHARACTER SET UTF8');
				
			}catch(PDOexception $error){
				echo $error->getMessage();
			}
			
			return $connection;
		}
		
		// Retorna um array
		protected function ConsultaSimples(string $query):array{
			return $this->database->query($query)->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>
