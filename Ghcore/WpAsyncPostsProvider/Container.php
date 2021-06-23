<?php

namespace Ghcore\WpAsyncPostsProvider;

use Ghcore\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Ghcore\WpAsyncPostsProvider\Helper\ValidatorInterface;

class Container implements ContainerInterface
{
    protected ContainerSettings     $settings;
    protected PostFilterInterface   $postFilter;
    protected AsyncPostsInterface   $asyncPosts;
    protected ValidatorInterface    $validator;
    protected PostRendererInterface $renderer;

    public function __construct(array $options = null)
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
    }

    public function getSettings(): ContainerSettings
    {
        return $this->settings;
    }

    public function getPostFilter():PostFilterInterface
    {
        return $this->postFilter;
    }

    public function setPostFilter(PostFilterInterface $postFilter): Container
    {
        $this->postFilter = $postFilter;

        return $this;
    }

    public function getAsyncPosts(): AsyncPostsInterface
    {
        return $this->asyncPosts;
    }

    public function setAsyncPosts(AsyncPostsInterface $asyncPosts): Container
    {
        $this->asyncPosts = $asyncPosts;

        return $this;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function setValidator(ValidatorInterface $validator): Container
    {
        $this->validator = $validator;

        return $this;
    }

    public function getRenderer(): PostRendererInterface
    {
        return $this->renderer;
    }

    public function setRenderer(PostRendererInterface $renderer): Container
    {
        $this->renderer = $renderer;

        return $this;
    }
}
