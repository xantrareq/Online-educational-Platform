<?php

namespace App\Http\Middleware;

use App\Models\CourseUser;
use App\Models\LikedCourse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLiked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseId = $request->route('course')->id;
        $userId = Auth::id();

        $userCourse = LikedCourse::where(['user_id'=>$userId,'course_id'=>$courseId])->first();

        if ($userCourse === null) {
            return redirect()->back()->with('error', 'У вас нет доступа к этому курсу.');
        }
        if($userCourse->visible === 0)
        {
            return redirect()->back()->with('error', 'У вас нет доступа к этому курсу.');
        }
        return $next($request);
    }
}
