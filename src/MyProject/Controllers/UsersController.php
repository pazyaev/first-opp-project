<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\UnprocessableEntityException;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\EmailSender;


class UsersController extends AbstractController
{
    public function signUp()
    {
        $title = 'Регистрация';

        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);
                
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
    
        $this->view->renderHtml('users/signUp.php', ['title' => $title]);
    }

    public function activate(int $userId, string $activationCode): void
    {
        $user = User::getById($userId);
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
        if ($isCodeValid) {
            $user->activate();
            UserActivationService::deleteActivationCode($activationCode);
            $this->view->renderHtml('users/activationSuccess.php');
        }
    }

    public function login()
    {
        $title = 'Авторизация';

        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /MainController/main');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php', ['title' => $title]);

    }

    public function logout()
    {
        $title = 'Выход';

        UsersAuthService::deleteToken();
        header('Location: /MainController/main');
    }
}