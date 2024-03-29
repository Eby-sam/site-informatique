<?php

namespace App\Controller;

abstract class AbstractController {
    abstract public function index();

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render(string $template, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $template . '.html.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.html.php';
        exit;
    }


    /**
     * Return true if a form were submitted.
     * @return bool
     */
    public function isFormSubmitted(): bool
    {
        return isset($_POST['save']);
    }


    /**
     * Return a form field value or default
     * @param string $field
     * @param $default
     * @return string
     */
    public function getFormField(string $field, $default = null): string
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }

        return $_POST[$field];
    }


    /**
     * @return bool
     */
    public static function isUserConnected(): bool
    {
        return isset($_SESSION['user']) && null !== ($_SESSION['user'])->getId();
    }


    /**
     * @return void
     */
    public function redirectIfNotConnected(): void
    {
        if(!self::isUserConnected()) {
            $this->render('home/index');
        }
    }

    /**
     * @return void
     */
    public function redirectIfConnected(): void
    {
        if(self::isUserConnected()) {
            $this->render('home/index');
        }
    }

    /**
     * @param string $param
     * @return string
     */
    public function sanitizeString(string $param): string
    {
        return $param;
    }

    /**
     * @param int $param
     * @return int
     */
    public function sanitizeInt(int $param): int
    {
        return $param;
    }
}
