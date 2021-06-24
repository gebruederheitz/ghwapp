<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use DI\Container;
use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Gebruederheitz\WpAsyncPostsProvider\Traits\Singleton;
use Gebruederheitz\WpAsyncPostsProvider\Helper\ValidatorInterface;
use Gebruederheitz\WpAsyncPostsProvider\Traits\SingletonInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

class AsyncPostsProvider extends Container
    implements ContainerInterface, PsrContainerInterface, SingletonInterface

{
    use Singleton;

    protected ContainerSettings     $settings;
    protected PostFilterInterface   $postFilter;
    protected AsyncPostsInterface   $asyncPosts;
    protected ValidatorInterface    $validator;
    protected PostRendererInterface $renderer;

    public function init(array $options = []): ContainerInterface
    {
        $this->settings = new ContainerSettings($options);

        $postFilterClass = $this->settings->getPostFilterClass();
        $this->postFilter = new $postFilterClass($this);

        $asyncPostsClass = $this->settings->getAsyncPostsClass();
        $this->asyncPosts = new $asyncPostsClass($this);

        $validatorClass = $this->settings->getValidatorClass();
        $this->validator = new $validatorClass();

        $rendererClass = $this->settings->getRendererClass();
        $this->renderer = new $rendererClass($this);

        return $this;
    }

    public function getSettings(): ContainerSettings
    {
        return $this->settings;
    }

    public function getPostFilter():PostFilterInterface
    {
        return $this->postFilter;
    }

    public function setPostFilter(PostFilterInterface $postFilter): AsyncPostsProvider
    {
        $this->postFilter = $postFilter;

        return $this;
    }

    public function getAsyncPosts(): AsyncPostsInterface
    {
        return $this->asyncPosts;
    }

    public function setAsyncPosts(AsyncPostsInterface $asyncPosts): AsyncPostsProvider
    {
        $this->asyncPosts = $asyncPosts;

        return $this;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function setValidator(ValidatorInterface $validator): AsyncPostsProvider
    {
        $this->validator = $validator;

        return $this;
    }

    public function getRenderer(): PostRendererInterface
    {
        return $this->renderer;
    }

    public function setRenderer(PostRendererInterface $renderer): AsyncPostsProvider
    {
        $this->renderer = $renderer;

        return $this;
    }
}
