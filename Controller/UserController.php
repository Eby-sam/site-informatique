<?php

use App\Controller\AbstractController;
use App\Model\Entity\User;
use App\Model\Manager\UserManager;

class UserController extends AbstractController
{
    /**
     * UserController entry point - default action.
     */
    public function index()
    {
        $this->render('user/users-list', [
            'users_list' => UserManager::getAll()
        ]);
    }

    /**
     * Fetch and display some users statistics.
     * @return void
     */
    public function showStats()
    {
        $this->render('user/statistics', [
            'users_count' => UserManager::getUsersCount(),
        ]);
    }


    /**
     * Display a specific user information.
     * @param int $id
     * @return void
     */
    public function showUser(int $id)
    {
        if(!UserManager::userExists($id)) {
            $this->index();
        }
        else {
            $this->render('user/show-user', [
                'user' => UserManager::getUser($id),
            ]);
        }
    }

    /**
     * User logout.
     * @return void
     */
    public function logout(): void
    {
        if(self::isUserConnected()) {
            $_SESSION['pseudo'] = null;
            $_SESSION['messages'] = null;
            $_SESSION['success'] = null;
            session_destroy();
        }
        $this->render('home/index');
    }


    /**
     * User login
     * @return void
     */
    public function login()
    {
        self::redirectIfConnected();

        if($this->isFormSubmitted()) {
            $errorMessage = "Le pseudo ou le password est mauvais";
            $mail = $this->sanitizeString($this->getFormField('mail'));
            $password = $this->getFormField('password');

            $user = UserManager::getUserByMail($mail);
            if (null === $user) {
                $_SESSION['errors'][] = $errorMessage;
            }
            else {
                echo $password . " " . $user->getPassword();
                if ($password === $user->getPassword()) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                    $this->render('home/index');
                }
                else {
                    $_SESSION['errors'][] = $errorMessage;
                }
            }
        }
        $this->render('user/login');
    }
}