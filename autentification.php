<?php
/*
*Fichier d'autentification des utilisateurs.
*La page recoit $_POST['login'] et $_POST['password'].
*Si ID et MDP correct: le contenus des $_POST sont assignés aux $_SESSION et redirection 
*Si MDP et/ou ID incorrects: Redirection vers la page Index.php avec l'affichage d'un message d'erreur
*/

require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/Class/User.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/Bristol_WebDev/tools/logger.php');

/*
*Réaction en fonction des données reçues.
*/

//Si le login transmit en $_POST["login"] existe ? Avec protection par htmlspecialchars.

if(User::readByUserName(htmlspecialchars($_POST["login"]))){
	$User=User::readByUserName(htmlspecialchars($_POST["login"]));

	//Si le password associé au pseudo est correct ? Avec protection par htmlspecialchars.
	echo $User->password;
    if(password_verify(htmlspecialchars($_POST["password"]), $User->password)){

		session_start();
		//Si le pseudo est correct alors connexion, assignation des valeurs de $_SESSION['username'] ainsi que $_SESSION['role']. Enfin redirection
		$_SESSION['username']=$User->username;
  		$role = $User->getRole();
        $_SESSION['role'] = $role;

        switch ($role){
            case 'Staff':
                header("Location: /Bristol_WebDev/user.php?page=user_add");
                break;
            case 'Student':
                header("Location: /Bristol_WebDev/student.php?page=mark_list");
                break;
        }

		exit;
	}
	/*
	*Si le password associé au pseudo est incorrect alors on renvoit l'utilisateur sur la page index.php en passant un paramètre d'erreur de connection "ErreurPass" dans le lien.
	*/
	header("Location: index.php?connexion=ErreurPass");
	exit;
}

/*
*Si le username associé est invalide alors on renvoit l'utilisateur sur la page index.php en passant un paramètre d'erreur de connection "ErreurUser" dans le lien.
*/
header("Location: index.php?connexion=ErreurUser");

?>