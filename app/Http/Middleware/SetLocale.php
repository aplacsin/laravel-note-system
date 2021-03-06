<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class SetLocale
{
    private Factory $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale($request->segment(1));
        optional($request->route())->forgetParameter('locale');
        $this->factory->share('currentRoute', $this->generateUrl($request));

        return $next($request);
    }


    private function generateUrl(Request $request): array
    {
        $parameters = $request->route()->parameters;
        $routeName = $request->route()->getName();
        $filteredParameters = array_values($parameters);
        $availableLocale = config('localization.available_locales');

        $routes = [];
        foreach($availableLocale as $locale) {

            $routes[] = [
                'locale' => $locale,
                'url' => route($routeName, [$locale, ...$filteredParameters])
            ];
        }

        return $routes;
    }
}
