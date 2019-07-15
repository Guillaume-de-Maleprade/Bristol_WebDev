<?php
/*
*Fichier d'autentification des utilisateurs.
*La page recoit $_POST['login'] et $_POST['password'].
*Si ID et MDP correct: le contenus des $_POST sont assignés aux $_SESSION et redirection vers choix.php
*Si MDP et/ou ID incorrects: Redirection vers la page Index.php avec l'affichage d'un message d'erreur
*/

/*
*Initialisation de la connexion de la base de donnée et vérification des erreurs.
*Lancement de la session.
*/
//Appel du fichier contenant les variables
require_once('admin/db_connect.php');


/*
*Réaction en fonction des données reçues.
*Le pseudo existe, alors on vérifie le mot de passe.
*/
// On récupère tout le contenu de la table utilisateur
$login_utilisateurs = GetTousLesUtilisateurs();

// On vérifie sur dans toute la base de donnée de l'utilisateur
$i = 0;
while(isset($login_utilisateurs[$i]))
{
	//Si le login transmit en $_POST["login"] existe ? Avec protection par htmlspecialchars.
	if($login_utilisateurs[$i] == htmlspecialchars($_POST["login"]))
	{
		//Si le password associé au pseudo est correct ?
		if(password_verify(htmlspecialchars($_POST["password"]),GetPasswordUtilisateur($login_utilisateurs[$i])))
		{
			session_start()
			//Si le pseudo est correct alors connexion, assignation des valeurs de $_SESSION['login'] ainsi que $_SESSION['password'] et $_SESSION['id']. Enfin redirection vers choix.php
			$_SESSION['username']=htmlspecialchars($_POST["login"]);
       		$_SESSION['role']=GetRoleUtilisateur($login_utilisateurs[$i]);


			header("Location: suite.php");
			exit;
		}
	}
	$i++;
}

/*
*Si le password accocié au pseudo est incorrect alors on renvois l'utilisateur sur la page index.php en passant un paramètre d'erreur de connection "ErreurId" dans le liens.
*/
header("Location: index.php?connexion=ErreurId");
?>