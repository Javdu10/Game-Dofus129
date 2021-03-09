<?php

namespace Azuriom\Plugin\Dofus129\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;

class Dofus129ServiceProvider extends BasePluginServiceProvider
{
    /**
     * The plugin's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // \Azuriom\Plugin\Dofus129\Middleware\ExampleMiddleware::class,
    ];

    /**
     * The plugin's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [];

    /**
     * The plugin's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // 'example' => \Azuriom\Plugin\Dofus129\Middleware\ExampleRouteMiddleware::class,
    ];

    /**
     * The policy mappings for this plugin.
     *
     * @var array
     */
    protected $policies = [
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        //$this->registerMiddlewares();

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadViews();

        $this->loadTranslations();

        //$this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        //$this->registerUserNavigation();

        $config = config('database.connections.mysql');
        config(['database.connections.dofus' => $config]);

    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'dofus129.ladder.pvm' => 'Ladder PVM',
            'dofus129.ladder.pvp' => 'Ladder PVP'
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'flyff' => [
                'name' => 'Dofus 1.29',
                'type' => 'dropdown',
                'icon' => 'fas fa-gamepad',
                'route' => 'dofus.admin.*',
                'items' => [
                    'dofus129.admin.index' => 'Settings',
                ],
            ],
        ];
    }

    /**
     * Return the user navigations routes to register in the user menu.
     *
     * @return array
     */
    protected function userNavigation()
    {
        return [
            //
        ];
    }
}
