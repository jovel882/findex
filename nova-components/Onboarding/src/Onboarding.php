<?php

namespace Findex\Onboarding;

use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Onboarding extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('onboarding', __DIR__.'/../dist/js/tool.js');
        Nova::style('onboarding', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the menu that renders the navigation links for the tool.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function menu(Request $request)
    {
        return MenuSection::make('Onboarding')
            ->path('/onboarding')
            ->icon('server');
    }
    public function getOnboardingText(Request $request)
    {
        return response()->json([
            'Menu usuario.',
            'Primer registro de usuario.',
            'Botón para crear usuario.',
        ]);
    }
}
