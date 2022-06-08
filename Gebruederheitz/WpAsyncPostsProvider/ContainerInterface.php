<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Gebruederheitz\WpAsyncPostsProvider\Helper\ValidatorInterface;

interface ContainerInterface
{
    /**
     * @param array<string, mixed> $options
     */
    public function init(array $options = []): ContainerInterface;

    public function getSettings(): ContainerSettings;

    public function getPostFilter(): PostFilterInterface;

    public function setPostFilter(
        PostFilterInterface $postFilter
    ): ContainerInterface;

    public function getAsyncPosts(): AsyncPostsInterface;

    public function setAsyncPosts(
        AsyncPostsInterface $asyncPosts
    ): ContainerInterface;

    public function getValidator(): ValidatorInterface;

    public function setValidator(
        ValidatorInterface $validator
    ): ContainerInterface;

    public function getRenderer(): PostRendererInterface;

    public function setRenderer(
        PostRendererInterface $renderer
    ): ContainerInterface;
}
