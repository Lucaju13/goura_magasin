<?php 

	class connecter{
		
		private $serveur="eu-cluster-west-01.k8s.cleardb.net";
		private $user="b13ecdc045955c";
		private $password="96825929";
		private $bd="heroku_a1fb79493f3bff9";

		public function connexion(){
			$connexion=mysqli_connect($this->serveur,
									 $this->user,
									 $this->password,
									 $this->bd);
			return $connexion;
		}
	}
 ?>