<?php
class AuthController
{
    public function showLogin(): void
    {
        require __DIR__ . '/../views/login.php';
    }

    public function showDashboard(): void
    {
        require __DIR__ . '/../views/dashboard.php';
    }

    public function showHome(): void
    {
        require __DIR__ . '/../views/home.php';
    }
}
