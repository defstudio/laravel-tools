<?php /** @noinspection PhpUnhandledExceptionInspection */

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

if (!function_exists('user')) {
    function user(): User
    {
        $user = Auth::user();

        if($user === null){
            throw new AuthorizationException("User not authenticated");
        }

        return $user;
    }
}

if (!function_exists('back')) {
    function back($status = 302, $headers = [], $fallback = false): RedirectResponse
    {
        if (request()->has('referer')) {
            return app('redirect')->to(request()->referer, $status, $headers);
        }
        return app('redirect')->back($status, $headers, $fallback);
    }
}
