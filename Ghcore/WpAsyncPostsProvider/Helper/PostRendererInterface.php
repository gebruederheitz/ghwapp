<?php

namespace Ghcore\WpAsyncPostsProvider\Helper;

interface PostRendererInterface
{
    public function render(array $posts, string $templateName, array $templateArgs): string;
}
