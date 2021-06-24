<?php

namespace Ghcore\WpAsyncPostsProvider;

use Ghcore\WpAsyncPostsProvider\Traits\withREST;
use WP_REST_Request;

class AsyncPosts implements AsyncPostsInterface
{
    use withREST;

    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->initInstanceRestApi();
    }

    private function getInitialPostCount(): int
    {
        return $this->container->getSettings()->getInitialPostCount();
    }

    private function getPostsPerPage(): int
    {
        return $this->container->getSettings()->getPerPage();
    }

    /**
     * REST API callback for the route '/posts/load-more'. Will return the
     * queried posts in the "posts" response parameter either as a rendered HTML
     * string (default) or as a JSON array of WP_Post objects (with parameter
     * "return" set to "json"). Will also indicate whether there are more posts
     * available to be shown after this current "page" through the "more"
     * response parameter.
     *
     * @param  WP_REST_Request  $request
     *
     * @return array  An associative array with
     *                 "posts" => (array)
     *                and
     *                 "more" => (bool).
     */
    public function restGetPaginatedPosts(WP_REST_Request $request): array
    {
        $request->sanitize_params();

        $pageNumber   = $request->get_param('page');
        $returnType   = $request->get_param('return');
        $templateUsed = $request->get_param('partial');

        $initialPostCount = $this->getInitialPostCount();
        $perPage = $this->getPostsPerPage();
        $more = null;

        $posts = $this->container->getPostFilter()->getPaginatedPostsData(
            $pageNumber,
            [],
            $perPage,
            $more,
            $initialPostCount
        );

        return [
            "posts" => $returnType === 'json'
                ? $posts
                : $this->container->getRenderer()->render($posts, $templateUsed),
            "more"  => $more,
        ];
    }

    /**
     * Dummy callback for withRest static REST API route registration
     *
     * @return array
     */
    protected static function getRestRoutes(): array
    {
        return [];
    }

    /**
     * withRest callback defining the available instance REST API routes.
     *
     * @return array[]
     */
    protected function getInstanceRestRoutes (): array
    {
        return [
            [
                "name" => "Get Paginated Post (Load More)",
                "route" => $this->container->getSettings()->getRoute(),
                "config" => [
                    'methods' => 'GET',
                    'callback' => [$this, 'restGetPaginatedPosts'],
                    'permission_callback' => function () {
                        // public route
                        return true;
                    },
                    'args' => [
                        'page' => [
                            'description' => 'Which page to show',
                            'default' => 0,
                            'type' => 'number',
                        ],
                        'return' => [
                            'description' => 'Whether to return JSON data or rendered HTML posts',
                            'default' => 'html',
                            'type' => 'string',
                            'sanitize_callback' => 'sanitize_text_field',
                            'validate_callback' => [$this->container->getValidator(), 'validatePaginationReturnType'],
                        ],
                        'partial' => [
                            'description' => 'The template part that should be used by the renderer',
                            'default' => $this->container->getSettings()->getDefaultPartial(),
                            'type' => 'string',
                            'sanitize_callback' => 'sanitize_text_field',
                        ],
                    ],
                ],
            ],
        ];
    }

}
