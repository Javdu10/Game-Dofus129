<?php

namespace Azuriom\Plugin\Dofus129\Providers;

use Azuriom\Models\Setting;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Azuriom\Plugin\Dofus129\Models\Account;
use Azuriom\Plugin\Dofus129\Models\GameAndWebRelation;
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

        if(!setting()->has('dofus129_accounts_nameCol'))
            $this->createDofusSettings();

        $this->setupConnections();

        $this->gameAccountCreationOnRegistration();
    }

    protected function setupConnections()
    {
        $config = config('database.connections.mysql');
        $config['host'] = setting('dofus129_database_host', $config['host']);
        $config['port'] = setting('dofus129_database_port', $config['port']);
        $config['username'] = setting('dofus129_database_username', $config['username']);
        $config['password'] = setting('dofus129_database_password', $config['password']);

        $config['database'] = setting('dofus129_accounts_databaseName');
        config(['database.connections.dofus_accounts' => $config]);

        $config['database'] = setting('dofus129_characters_databaseName');
        config(['database.connections.dofus_characters' => $config]);
    }

    protected function gameAccountCreationOnRegistration(){
        if(setting('dofus129_create_account_on_registration') == 0)
            return;
        
        Event::listen(function (Registered $event) {
            $account = new Account();
            $account->{setting('dofus129_accounts_nameCol')} = request()->input('name');
            $account->{setting('dofus129_accounts_pseudoCol')} = request()->input('name');
            $account->{setting('dofus129_accounts_passwordCol')} = $this->customHashForPassword(request()->input('password'));
            $account->{setting('dofus129_accounts_questionCol')} = 'Type : "Yes"';
            $account->{setting('dofus129_accounts_answerCol')} = 'Yes';
            $account->save();

            GameAndWebRelation::create([
                'azuriom_id' => $event->user->id,
                'dofus_id' => $account->{setting('dofus129_accounts_primaryKey')}
            ]);
        });
    }

    protected function customHashForPassword($password)
    {
        $value = eval('return '.setting('dofus129_customHashalgo'));
        return eval('return '.setting('dofus129_customHashalgo'));
    }

    protected function createDofusSettings()
    {
        Setting::updateSettings([
            'dofus129_create_account_on_registration' => 0,
            'dofus129_customHashalgo' => 'hash("sha512", hash("md5", $password));',

            'dofus129_accounts_databaseName' => 'accounts_database',
            'dofus129_accounts_tableName' => 'accounts_table',
            'dofus129_accounts_primaryKey' => 'accounts_primaryKey',
            'dofus129_accounts_foreignKey' => 'accounts_foreignKey',
            'dofus129_accounts_nameCol' => 'accounts_name',
            'dofus129_accounts_passwordCol' => 'accounts_password',
            'dofus129_accounts_pseudoCol' => 'accounts_pseudo',
            'dofus129_accounts_questionCol' => 'accounts_question',
            'dofus129_accounts_answerCol' => 'accounts_answer',
            //'dofus129_accounts_loggedCol' => ['nullable', 'string'],

            'dofus129_characters_databaseName' => 'characters_database',
            'dofus129_characters_tableName' => 'characters_table',
            'dofus129_characters_primaryKey' => 'characters_primaryKey',
            'dofus129_characters_nameCol' => 'characters_name',
            'dofus129_characters_sexeCol' => 'characters_sexe',
            'dofus129_characters_classCol' => 'characters_class',
            'dofus129_characters_levelCol' => 'characters_level',
            'dofus129_characters_experienceCol' => 'characters_experience',
            'dofus129_characters_alignementCol' => 'characters_alignement',
            'dofus129_characters_honorCol' => 'characters_honor',
        ]);
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
