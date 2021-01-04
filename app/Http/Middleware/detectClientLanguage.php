<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class detectClientLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        App::setLocale('en');

        if (Session::has('locale')) {
            App::setLocale(Session::get('locale')[0]);
        } else {
            $availableLangs = config('app.available_locales');
            $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLangs as $lang) {
                if (in_array($lang, $userLangs)) {
                    App::setLocale($lang);
                    Session::push('locale', $lang);
                    break;
                }
            }
        }

        switch ($request->path()) {
            case '/':
                return redirect('/' . App::getLocale());
                break;
            case 'home':
                return redirect(App::getLocale() . '/home');
                break;
        }        
    }
}
