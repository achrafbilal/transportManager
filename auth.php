<?php
// if (session_status() === PHP_SESSION_NONE) 
session_start();
$uri = explode('/', $_SERVER['REQUEST_URI']);

require_once('./components/navbar.php');
if (isset($_SESSION['user'])) {
    if ($uri[1] === 'logout') {
        unset($_SESSION['user']);
        header('Location: /login');
        die;
    } else
        switch ($_SESSION['user']['role_id']) {
            case 1:
                if (count($uri) > 1) {

                    switch (explode('?', $uri[1])[0]) {
                        case 'containers':
                            require_once('./admin/containers.php');
                            break;
                        case 'travels':
                            require_once('./admin/travels.php');
                            break;
                        case 'users':
                            require_once('./admin/users.php');
                            break;
                        case 'new-container':
                            require_once('./admin/create-container.php');
                            break;
                        case 'edit-container':
                            require_once('./admin/edit-container.php');
                            break;
                    }
                    exit;
                }

                require_once('./admin/travels.php');
                break;
            case 2:
                if (count($uri) > 1) {
                    switch ($uri[1]) {
                        case 'travels':
                            require_once('./client/travels.php');
                            break;
                        case 'new-travel':
                            require_once('./client/create-travel.php');
                            break;
                    }
                } else {
                    require_once('./client/travels.php');
                    exit;
                }
                break;
        }
} elseif (count($uri) > 1) {
    switch ($uri[1]) {
        case 'register':
            require_once('./auth/register.php');
            break;
        default:
            require_once('./auth/login.php');
    }
} else {
    require_once('./auth/login.php');
}
