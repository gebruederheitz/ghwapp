<?php

namespace Ghcore\WpAsyncPostsProvider\Traits;

const REST_API_VERSION = '1';

trait withREST
{
    public static $restNamespace = 'ghwapp/v' . REST_API_VERSION;

    public static function initRestApi()
    {
        // Register REST API route
        add_action('rest_api_init', [static::class, 'registerRestRoutes']);
    }

    public function initInstanceRestApi ()
    {
        add_action('rest_api_init', [$this, 'registerInstanceRestRoutes']);
    }

    /**
     * Loops over items provided through getRestRoutes() and registers a REST API
     * route for each.
     */
    public static function registerRestRoutes ()
    {
        foreach (static::getRestRoutes() as $options) {
            register_rest_route(self::$restNamespace, $options['route'], $options['config']);
        }
    }

    public function registerInstanceRestRoutes()
    {
        foreach ($this->getInstanceRestRoutes() as $options) {
            register_rest_route(self::$restNamespace, $options['route'], $options['config']);
        }
    }

    /**
     * Make this function return an array of configurations to have the REST API
     * routes automatically set up.
     *
     * [
     *   'route' => (string) '/route/for/api/calls',
     *   'config' => (array) WPRestCondigArray
     *   'name' => (string) 'A Human-Readable Name for the endpoint',
     * ];
     *
     * @return array
     */
    abstract protected static function getRestRoutes (): array;
    abstract protected function getInstanceRestRoutes(): array;

    /**
     * Get the endpoint to use for REST API calls to retrieve posts with
     * these custom filters
     *
     * @return string[] The full URLs to the class' REST endpoints
     */
    public static function getRestEndpoints(): array
    {
        $out = [];
        foreach (static::getRestRoutes() as $options) {
            $out[$options['name']] = get_rest_url(null, self::$restNamespace . $options['route']);
        }
        return $out;
    }

}
