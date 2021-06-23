<?php

namespace Ghcore\WpAsyncPostsProvider;

use Ghcore\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Ghcore\WpAsyncPostsProvider\Helper\ValidatorInterface;

interface ContainerInterface
{
    public function getSettings(): ContainerSettings;

    public function getPostFilter(): PostFilterInterface;

    public function setPostFilter(PostFilterInterface $postFilter): ContainerInterface;

    public function getAsyncPosts(): AsyncPostsInterface;

    public function setAsyncPosts(AsyncPostsInterface $asyncPosts): ContainerInterface;

    public function getValidator(): ValidatorInterface;

    public function setValidator(ValidatorInterface $validator): ContainerInterface;

    public function getRenderer(): PostRendererInterface;

    public function setRenderer(PostRendererInterface $renderer): Container;
}
