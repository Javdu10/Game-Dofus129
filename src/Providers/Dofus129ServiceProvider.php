<?php

namespace Azuriom\Plugin\Dofus129\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Azuriom\Plugin\Dofus129\Game\Dofus;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Models\GameAndWebRelation;
use Azuriom\Providers\GameServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class Dofus129ServiceProvider extends BasePluginServiceProvider
{
    protected array $middleware = [];

    protected array $middlewareGroups = [];

    protected array $routeMiddleware = [
        // 'example' => \Azuriom\Plugin\Dofus129\Middleware\ExampleRouteMiddleware::class,
    ];

    protected array $policies = [
        // User::class => UserPolicy::class,
    ];

    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerMiddlewares();

        GameServiceProvider::registerGames(['dofus129' => Dofus::class]);
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddlewares();

        $this->loadViews();

        $this->loadTranslations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        if (is_installed()) {
            $this->setupConnections();
            $this->gameAccountCreationOnRegistration();
        }
    }

    protected function setupConnections()
    {
        $config = config('database.connections.'.setting('dofus129_database_driver'));
        $config['host'] = setting('dofus129_database_host', $config['host']);
        $config['port'] = setting('dofus129_database_port', $config['port']);
        $config['username'] = setting('dofus129_database_username', $config['username']);
        $config['password'] = setting('dofus129_database_password', $config['password']);

        $config['database'] = setting('dofus129_accounts_databaseName');
        config(['database.connections.dofus_accounts' => $config]);

        $config['database'] = setting('dofus129_characters_databaseName');
        config(['database.connections.dofus_characters' => $config]);
        DB::purge();
    }

    protected function gameAccountCreationOnRegistration()
    {
        if (setting('dofus129_create_account_on_registration', 0) === 0) {
            return;
        }

        Event::listen(function (Registered $event) {
            $account = new Account();
            $account->setTable(setting('dofus129_accounts_tableName'));
            $account->setKeyName(setting('dofus129_accounts_primaryKey'));

            $account->{setting('dofus129_accounts_nameCol')} = request()->input('name');
            $account->{setting('dofus129_accounts_pseudoCol')} = request()->input('name');
            $account->{setting('dofus129_accounts_passwordCol')} = $this->customHashForPassword(request()->input('password'));
            $account->{setting('dofus129_accounts_questionCol')} = 'Type : "Yes"';
            $account->{setting('dofus129_accounts_answerCol')} = 'Yes';
            $account->save();

            GameAndWebRelation::create([
                'azuriom_id' => $event->user->id,
                'dofus_id' => $account->{setting('dofus129_accounts_primaryKey')},
            ]);
        });
    }

    protected function customHashForPassword($password)
    {
        return eval('return '.setting('dofus129_customHashalgo'));
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
            'dofus129.ladder.pvp' => 'Ladder PVP',
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
