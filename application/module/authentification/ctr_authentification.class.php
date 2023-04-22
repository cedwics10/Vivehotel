<?php
class Ctr_authentification extends Ctr_controleur
{
    /**
     * __construct
     *
     * @param string $action nom de l'action appelé dans le constructeur
     * @return void Lance l'action a_$action en tant que page web
     */
    public function __construct($action)
    {
        parent::__construct("authentification", $action);
        $a = "a_$action";
        $this->$a();
    }

    /**
     * a_inscription
     *
     * @return void Page d'inscription au site
     */
    public function a_inscription()
    {
        extract($_POST);
        if (isset($_SESSION["cli_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        if (isset($btSubmit)) {
            //vérifier que $cli_email est unique
            if (!Utilisateur::estEmailUnique($cli_email)) {
                $_SESSION["message"][] = "$cli_email : cette adresse mail est déjà prise. Veuillez en saisir une autre.";
                require $this->gabarit;
                exit;
            }

            //vérifier que $cli_mdp==$cli_mdp2
            if ($cli_mdp != $cli_mdp2) {
                $_SESSION["message"][] = "La vérification du mot de passe à échouer. Veuillez vérifier votre mot de passe.";
                require $this->gabarit;
                exit;
            }

            //Tous est ok : enregistrement du nouvel Utilisateur
            $_POST["cli_id"] = 0;
            $_POST["cli_mdp"] = password_hash($_POST["cli_mdp"], PASSWORD_DEFAULT);
            $_POST["cli_profil"] = "client";
            (new Utilisateur)->save($_POST);
            $_SESSION["message"][] = "procédez à votre réservation !  $cli_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur la réservation
            header("location:" . hlien("_reservation"));

            //Tous est ok : enregistrement du nouvel utilisateur
            $_POST["per_id"] = 0;
            $_POST["per_mdp"] = password_hash($_POST["per_mdp"], PASSWORD_DEFAULT);
            $_POST["per_profil"] = "client";
            (new Utilisateur)->save($_POST);
            $_SESSION["message"][] = "Bravo $per_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur l'accueil
            header("location:" . hlien("_default"));
        } else {
            //affichage du formulaire
            extract((new Utilisateur())->emptyRecord());
            require $this->gabarit;
        }
    }

    /**
     * a_connexion
     *
     * @return void Page de connexion pour les membres inscrits
     */
    public function a_connexion()
    {
        if (isset($_SESSION["cli_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        extract($_POST);
        if (isset($btSubmit)) {
            //récupérer en bdd l'Utilisateur qui posséde $cli_email
            $row = Utilisateur::selectByEmail($cli_email);

            if ($row === false) {
                $_SESSION["message"][] = "$cli_email n'existe pas. Vérifiez votre saisie";
                require $this->gabarit;
                exit;
            }

            //vérification du mot de passe
            if (!password_verify($cli_mdp, $row["cli_mdp"])) {
                $_SESSION["message"][] = "Mot de passe incorrect.";
                require $this->gabarit;
                exit;
            }

            //Connexion réussie
            extract($row);
            $_SESSION["cli_id"] = $cli_id;
            $_SESSION["cli_nom"] = $cli_nom;
            $_SESSION["cli_identifiant"] = $cli_identifiant;
            $_SESSION["cli_email"] = $cli_email;
            $_SESSION["cli_profil"] = $cli_profil;
            $_SESSION["message"][] = "bienvenu $cli_identifiant $cli_nom.";
            header("location:" . hlien("_default"));
        } else {
            $cli_email = "";
            require $this->gabarit;
        }
    }

    /**
     * a_deconnexion
     *
     * @return void Page de déconnexion pour les membres inscrits
     */
    public function a_deconnexion()
    {
        $_SESSION = [];
        $_SESSION["message"][] = "Vous êtes bien déconnecté.";
        header("location:" . hlien("_default"));
    }

    /**
     * a_connexion_personnel
     *
     * @return void Page de connexion du personnel
     */
    public function a_connexion_personnel()
    {
        array_map('trim', $_POST);

        if (isset($_SESSION["per_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        extract($_POST);
        if (isset($btSubmit)) {
            //récupérer en bdd le personnel  qui possède $per_email
            $row = Personnel::selectByEmail($per_email);

            if ($row === false) {
                $_SESSION["message"][] = "$per_email n'existe pas. Vérifiez votre saisie";
                require $this->gabarit;
                exit;
            }


            extract($row);

            $_SESSION["per_id"] = $per_id;
            $_SESSION["per_nom"] = $per_nom;
            $_SESSION["per_identifiant"] = $per_identifiant;
            $_SESSION["per_email"] = $per_email;
            $_SESSION["per_profil"] = $per_profil;
            $_SESSION["per_role"] = $per_role;

            $_SESSION["per_hotel"] = Personnel::selectHotel($per_id);
            $_SESSION["message"][] = "bienvenu $per_nom.";
            header("location:" . hlien("_default"));
        } else {
            $per_email = "";
            require $this->gabarit;
        }
    }
}
