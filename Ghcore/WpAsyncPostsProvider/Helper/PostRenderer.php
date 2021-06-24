<?php

namespace Ghcore\WpAsyncPostsProvider\Helper;

use Ghcore\WpAsyncPostsProvider\ContainerInterface;
use WP_Post;

class PostRenderer implements PostRendererInterface
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Renders an array of WP_Post objects through the page template into a
     * string value.
     *
     * @param  WP_Post[]  $posts         An array of posts to be rendered.
     * @param  string     $templateName  The sub-template of the configured
     *                                   template path to use
     *
     * @return string    The resulting HTML string.
     */
    public function render(
        array $posts,
        string $templateName = 'tile',
        array $templateArgs = []
    ): string
    {
        global $post;

        ob_start();
        foreach ($posts as $currentPost) {
            $post = $currentPost;
            get_template_part(
                $this->container->getSettings()->getRendererTemplatePath(),
                $templateName,
                $templateArgs
            );
        }
        $rendered = ob_get_contents();
        ob_end_clean();

        return $rendered;
    }
}
