<?php
namespace App\Services;

class GreetingService
{
    public function welcome(string $name): string
    {
        return "Halo, {$name}. Selamat belajar persiapan Laravel!";
    }
}
