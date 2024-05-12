<?php

namespace App\Http\Middleware;

use App\Models\CourseUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCourseUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'admin')
        {
            return $next($request);
        }
        $courseId = $request->route('course')->id;
        $userId = Auth::id();

        $userCourse = CourseUser::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();
        if (!$userCourse) {
            return redirect()->back()->with('error', 'У вас нет доступа к этому курсу.');
        }
        return $next($request);
    }
}
