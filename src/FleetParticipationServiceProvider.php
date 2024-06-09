<?php

namespace KasperFM\Seat\FleetParticipation;

use Illuminate\Routing\Router;
use Seat\Services\AbstractSeatPlugin;
use Seat\Web\Http\Middleware\Locale;

/**
 * Class FleetParticipationServiceProvider
 * @package KasperFM\Seat\FleetParticipation
 */
class FleetParticipationServiceProvider extends AbstractSeatPlugin
{
    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        // Include the Routes
        $this->add_routes();

        // Add the views for the plugin
        $this->add_views();

        // Register migrations
        $this->add_migrations();
    }

    public function register()
    {
        // Merge the config with anything in the main app
        // Web package configurations
        $this->mergeConfigFrom(
            __DIR__ . '/Config/fleetparticipation.config.php', 'fleetparticipation.config');

        $this->registerPermissions(
            __DIR__ . '/Config/fleetparticipation.permissions.php', 'fleetparticipation');

        // Menu Configurations
        $this->mergeConfigFrom(
            __DIR__ . '/Config/fleetparticipation.sidebar.php', 'package.sidebar');

    }

    private function add_migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    /**
     * Include the routes
     */
    public function add_routes()
    {
        if (!$this->app->routesAreCached())
            include __DIR__ . '/Routes/web.php';
    }

    /**
     * Set the path and namespace for the views
     */
    public function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'fleetparticipation');
    }

    public function getName(): string
    {
        return 'Seat-FleetParticipation';
    }

    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/kasperfm/seat-fleetparticipation';
    }

    public function getPackagistPackageName(): string
    {
        return 'seat-fleetparticipation';
    }

    public function getPackagistVendorName(): string
    {
        return 'kasperfm';
    }
}