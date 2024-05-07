<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::id(); // Получаем ID текущего пользователя

        if ($userId == null) {
            // Если записи нет, перенаправляем пользователя обратно с сообщением об ошибке
            return redirect()->back()->with('error', 'Вы не авторизованы.');
        }

        return $next($request);
    }
}
