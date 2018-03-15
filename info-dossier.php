<ul>
<?php

$dossier = $_GET['dossier'];


foreach( GLOB("projets/$dossier/images/*.{jpg,png,gif}", GLOB_BRACE) as $image ){

	echo "<li><img src='$image'></li>\n";

}


$texte = file_get_contents( "projets/".$dossier."/texte.html" );

echo "<li class='texte'><div>$texte</div></li>\n";

?>
</ul>