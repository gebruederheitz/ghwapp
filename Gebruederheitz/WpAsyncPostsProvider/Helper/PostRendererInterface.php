<?php

namespace Gebruederheitz\WpAsyncPostsProvider\Helper;

use WP_Post;

interface PostRendererInterface
{
    /**
     * @param array<WP_Post>  $posts
     * @param array<mixed>    $templateArgs
     */
    public function render(
        array $posts,
        string $templateName,
        array $templateArgs = []
    ): string;

    public function getDefaultTemplate(): string;
}
