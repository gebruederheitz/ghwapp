<?php

namespace Gebruederheitz\WpAsyncPostsProvider\Helper;

use Gebruederheitz\WpAsyncPostsProvider\ContainerInterface;
use WP_Post;

class PostRenderer implements PostRendererInterface
{
    /** @var ContainerInterface */
    protected $container;

    /** @var string */
    protected const DEFAULT_TEMPLATE = 'tile';

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getDefaultTemplate(): string
    {
        return self::DEFAULT_TEMPLATE;
    }

    /**
     * Renders an array of WP_Post objects through the page template into a
     * string value.
     *
     * @param WP_Post[]    $posts        An array of posts to be rendered.
     * @param string       $templateName The sub-template of the configured
     *                                   template path to use
     * @param array<mixed> $templateArgs Additional arguments passed to the
     *                                   rendered template
     *
     * @return string    The resulting HTML string.
     */
    public function render(
        array $posts,
        string $templateName = self::DEFAULT_TEMPLATE,
        array $templateArgs = []
    ): string {
        global $post;

        ob_start();
        foreach ($posts as $currentPost) {
            $post = $currentPost;
            get_template_part(
                $this->container->getSettings()->getRendererTemplatePath(),
                $templateName,
                $templateArgs,
            );
        }
        $rendered = ob_get_contents();
        ob_end_clean();

        if (!is_string($rendered)) {
            $rendered = '';
        }

        return $rendered;
    }
}
