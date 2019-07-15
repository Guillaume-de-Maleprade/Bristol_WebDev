<?php
/*
*Fichier d'autentification des utilisateurs.
*La page recoit $_POST['login'] et $_POST['password'].
*Si ID et MDP correct: le contenus des $_POST sont assignés aux $_SESSION et redirection 
*Si MDP et/ou ID incorrects: Redirection vers la page Index.php avec l'affichage d'un message d'erreur
*/

require_once('admin/db_connect.php');


/*
*Réaction en fonction des données reçues.
*Le pseudo existe, alors on vérifie le mot de passe.
*/

// On récupère tout le contenu de la table login/username
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
			session_start();
			//Si le pseudo est correct alors connexion, assignation des valeurs de $_SESSION['username'] ainsi que $_SESSION['role']. Enfin redirection
			$_SESSION['username']=htmlspecialchars($_POST["login"]);
       		$_SESSION['role']=GetRoleUtilisateur($login_utilisateurs[$i]);


			header("Location: suite.php");
			exit;
		}
	}
	$i++;
}

/*
*Si le password associé au pseudo est incorrect alors on renvoit l'utilisateur sur la page index.php en passant un paramètre d'erreur de connection "ErreurId" dans le lien.
*/
header("Location: index.php?connexion=ErreurId");
?>