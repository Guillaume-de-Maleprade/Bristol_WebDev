<?php

/*
*Fichier index.php Base du site
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*Création des variables sessions utiles.
*Interface de connexion
*Renvois d'informations
*
*
*/

/*
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*/
//Appel du fichier contenant les variables

//require_once('fonction.php');
//$id_bdd = Id_bdd();

//Vérification de la connexion à la bdd
try
{
	//$bdd = new PDO($id_bdd['nsd'],$id_bdd['id'],$id_bdd['mdp']);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>		
		<!-- Renvois d'informations
    	-Permet à l'utilisateur de voir s'il a créer un compte ou si ses identifiants sont inccorects 
    	-Regarde s'il reçoit $_GET['connexion'] dans l'URL. Si oui il affiche l'information, Si non alors n'affiche rien.
    	-Si reception de ErreurId alors affiche "Mot de passe incorrect.". Si reception de CompteCree alors affiche "Compte créé, vous pouvez vous connecter.".
    	-->
<?php

$gabarit=file_get_contents("gabarits/login.html");

			if (isset($_GET['connexion']))
			{
				if($_GET['connexion'] == 'ErreurId')
				{
					$message='Mot de passe incorrect.';
				}
			}
			else
			{
				$message='';
			}
                        
$gabarit=str_replace("(message)",$message,$gabarit);
echo $gabarit;
			
?>
