<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            redirect()->route('login')->with('error', 'İşleminize oturum açarak devam edebilirsiniz.
            Sitemize üye değilseniz pratik bir şekilde üye olarak kolay randevu sisteminden faydalanabilirsiniz.');
        }
    }
}
