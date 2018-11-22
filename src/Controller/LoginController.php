<?php

namespace src\Controller;

use src\Home;
use src\Entity\User;
use src\Manager\UserManager;
use src\Repository\UserRepository;

/**
 * Class DefaultController
 * @package src\Controller
 */
class DefaultController extends HomeController
{
    /**
     *
     */
    public function login(): void
    {

        if (isset($_SESSION['authenticated'])) {
            header("Location: /?p=chat.index");
            die();
        }

        $loginError = '';
        $registrationError = '';

        if (!empty($_POST)) {

            $app = Home::getInstance();
            $userManager = new UserManager($app->getDb());
            $userRepository = new UserRepository($app->getDb());

            // Si c'est un login
            if (isset($_POST['login'])) {
                $username = isset($_POST['username']) ? $_POST['username'] : NULL;
                $password = isset($_POST['password']) ? $_POST['password'] : NULL;

                $user = $userRepository->findByUsername($username);

                // On vérifie les identifiants
                $loginError = $this->checkIds($user, $password);
            }

            // Si c'est une nouvelle inscription
            if (isset($_POST['register'])) {
                if (null !== $_POST['username']
                    && null !== $_POST['password']
                    && null !== $_POST['password2']) {

                    if ($_POST['password'] == $_POST['password2']) {
                        // On encrypte le mots de passe
                        $user = new User([
                            "name" => $_POST['username'],
                            "password" => password_hash($_POST['password'], PASSWORD_BCRYPT)
                        ]);

                        // On vérifie si l'utilisateur n'existe pas déjà
                        $users = $userRepository->findAll();
                        foreach ($users as $existingUser) {
                            if ($existingUser->getUsername() == $user->getUsername()) {
                                $registrationError = 'Pseudo déjà existant';
                                $alreadyExist = true;
                            }
                        }

                        // S'il n'existe pas on le rajoute
                        if (!isset($alreadyExist)) {
                            $userManager->add($user);
                            $id = $app->getDb()->lastInsertId();
                            $user->setId($id);
                            $_SESSION['authenticated'] = $user->getId();
                            header("Location: /?p=chat.index");
                        }

                    } else {
                        $registrationError = 'Les mots de passe ne sont pas identiques';
                    }
                } else {
                    $registrationError = 'Remplissez les champs indiqués svp';
                }
            }

        }

        $this->render('login', [
            'loginError' => $loginError,
            'registrationError' => $registrationError
        ]);
    }

    /**
     * @param $user
     * @param $password
     * @return string
     */
    private function checkIds($user, $password): string
    {
        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['authenticated'] = $user->getId();
                header("Location: /?p=chat.index");
            } else {
                $loginError = 'Mot de passe incorrect';
            }
        } else {
            $loginError = 'Identifiants incorrect';
        }
        return $loginError;
    }
}
