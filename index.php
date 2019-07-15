<?php

require_once('View.php');

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
?>


		
		<!-- Renvois d'informations
    	-Permet à l'utilisateur de voir s'il a créer un compte ou si ses identifiants sont inccorects 
    	-Regarde s'il reçoit $_GET['connexion'] dans l'URL. Si oui il affiche l'information, Si non alors n'affiche rien.
    	-Si reception de ErreurId alors affiche "Mot de passe incorrect.". Si reception de CompteCree alors affiche "Compte créé, vous pouvez vous connecter.".
    	-->
<?php


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
                        
			

$array = ['message'=>$message];

View::render('templates/login.html', $array);