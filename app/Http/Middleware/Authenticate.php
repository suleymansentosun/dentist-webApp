<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Redirect;

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
            if (request()->segment(1) == 'tr') {
                $request->session()->flash('error', 'İşleminize oturum açarak devam edebilirsiniz.
                Sitemize üye değilseniz pratik bir şekilde üye olarak kolay randevu sisteminden faydalanabilirsiniz.');
            } else {
                $request->session()->flash('error', 
                'You can continue your operation by logging in.
                If you are not a member of our site, 
                you can take advantage of the easy appointment system by practically becoming a member.');
            }
            
            return route('login', ['locale' => request()->segment(1)]);
        }
    }
}
