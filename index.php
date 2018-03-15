<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Racontards du numérique</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<section id="apropos">
		<h1>Titre</h1>
	</section>

	<section id="liste">

		<ul id="titres">
			<?php 

			foreach( GLOB("projets/*") as $dossier ){

				$json = json_decode( file_get_contents("$dossier/data.json") );
				$identifiant = str_replace("projets/", "",$dossier );


				echo "<li id='$identifiant'><h2>{$json->titre}</h2></li>\n";

			}


			?>
		</ul>
		
	</section>

	<div class="conteneur">
		<div class="viewer">
			<ul>
			</ul>
		</div>
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script>
		
		$(document).ready(function(){

			// quand on clique sur un élément de la liste #titres
			$("#titres li").click(function(){
				
				// on récupère l'attribut id
				var identifiant = $(this).attr("id");

				// on fait une requete AJAX vers le fichier info-dossier.php
				$.ajax({
					method: "GET",
					url: "info-dossier.php",
					data: { dossier: identifiant }
				})
				.done(function( msg ) {

					var contenu = msg;

					$('.viewer').html(contenu);
					$(".viewer>ul>li").not(":first-child").hide();					
					$(".conteneur").show();
				});

			})


			$(".conteneur")
			.hide()
			.click(function(){
				$(this).hide();
			});

			

			$(".viewer").mousemove(function(event){

				// $(".viewer li").length => nombre d'éléments li dans la balise ul de .viewer
				let largeur = $(".viewer").width() / $(".viewer>ul>li").length;

				// event.originalEvent.offsetX => position X de la souris dans le viewer
				let index = Math.floor( event.originalEvent.offsetX /largeur);

				console.log(event.originalEvent.offsetX, $(".viewer>ul>li").length, index);

				$(".viewer>ul>li").hide();
				$(".viewer>ul>li").eq( index ).show();
			});
		});

	</script>
	
</body>
</html>