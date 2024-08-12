<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $captchaResponse = $request->header('captcha-response');

        if (!$captchaResponse) {
            return response()->json(['error' => 'Captcha response missing'], 400);
        }

        $secret = config('services.recaptcha.secret');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $captchaResponse,
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!$result['success']) {
            return response()->json(['error' => 'Invalid captcha'], 422);
        }

        return $next($request);
    }
}
