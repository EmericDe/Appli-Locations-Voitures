<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./vue/StyleCSS/inscription.css"/>
		<link rel="stylesheet" href="./vue/StyleCSS/bootstrap.css"/>
		<!-- <script src="script.js"></script> -->
		<title>Locars</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  			<a class="navbar-brand" href="index.php?controle=Controller&action=index">Locars</a>
			<div class="collapse navbar-collapse" id="navbarColor02">
    			<ul class="navbar-nav mr-auto">
      				<li class="nav-item active">
        				<a class="nav-link" href="index.php?controle=Controller&action=index">Home</a>
      				</li>
      				<li class="nav-item">
        				<a class="nav-link" href="index.php?controle=Controller&action=inscript">S'inscrire</a>
      				</li>
      				<li class="nav-item">
        				<a class="nav-link" href="index.php?controle=Controller&action=connexion">Se connecter</a>
     				 </li>
    			</ul>
 			</div>
		</nav>
		<div class="fy">
		<h1>Formulaire d'inscription</h1>
		<form controle=Controller&action=inscript method="post">
			<input class="input-box" placeholder="Nom" type="text" name="nom" value="" /></br>
			<input class="input-box" placeholder="Email "type="text" name="email" value="" /></br>
			<input class="input-box" placeholder="Mot de passe" type="password" name="mdp" value="" /></br>  
			<button type="submit" class="signup-btn" value="S'inscrire">S'inscrire</button>
		</form>
		<div><?php echo $msg;?></div>
		<p style="padding: 5px; font-size: 12px;"> Faites attention à bien remplir les champs demandés</p>
		</div>
	</body>
</html>