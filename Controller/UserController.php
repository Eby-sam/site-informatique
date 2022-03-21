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
            'min_age' => UserManager::getMinAge()
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


    // TODO
    public function editUser(int $id, string $category) {
        echo "edit piaf";
        var_dump([
            '$id' => $id,
            '$category' => $category,
        ]);
    }


    /**
     * Route handling users deletion.
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        if(UserManager::userExists($id)) {
            $user = UserManager::getUser($id);
            $deleted = UserManager::deleteUser($user);
        }
        $this->index();
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
            $mail = $this->sanitizeString($this->getFormField('email'));
            $password = $this->getFormField('password');

            $user = UserManager::getUserByMail($mail);
            if (null === $user) {
                $_SESSION['errors'][] = $errorMessage;
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                    $this->redirectIfConnected();
                }
                else {
                    $_SESSION['errors'][] = $errorMessage;
                }
            }
        }

        $this->render('user/login');
    }
}