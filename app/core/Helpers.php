<?php

function isActive(string $pageTitle, string $referens): string 
{
    
    return $pageTitle === $referens ? 'active' : '';

}

function component(string $name, array $data = [])
{
    extract($data, EXTR_SKIP);
    $path = __DIR__ . "/../components/{$name}.component.php";

    if (file_exists($path)) {
        require $path;
    }
}

function checkCookie($cookie) {

        $userModel = new UserModel();
        $session = $userModel->getSessionByToken($cookie);

        if ($session['expires_at'] > time()) {
            return true;
        }

        return false;
}

function addCookie($user) {
    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', time() + 3600 * 24 * 365);

    $userModel = new UserModel();
    $userModel->createSession($user['id'], $token, $expires);

    setcookie('remember_me', $token, [
        'expires' => time() + 3600 * 24 * 365,
        'path' => '/',
        'domain' => '.kpb.nu',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

function removeCookie() {

    setcookie('remember_me', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'domain' => '.kpb.nu',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    $userModel = new UserModel();
    $userModel->removeSession($_COOKIE['remember_me']);
    
}