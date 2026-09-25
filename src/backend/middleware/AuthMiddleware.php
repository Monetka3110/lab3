<?php
// Проверяет токен и роль пользователя (employee / manager)
class AuthMiddleware
{
    public function handle(array $request, string $requiredRole = 'employee'): array { /* TODO */ return $request; }
}
