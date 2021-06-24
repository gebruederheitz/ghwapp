<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRenderer;
use Gebruederheitz\WpAsyncPostsProvider\Helper\Validator;

class ContainerSettings
{
    protected $initialPostCount     = 8;
    protected $perPage              = 6;
    protected $postFilterClass      = PostFilter::class;
    protected $asyncPostsClass      = AsyncPosts::class;
    protected $validatorClass       = Validator::class;
    protected $rendererClass        = PostRenderer::class;
    protected $rendererTemplatePath = 'template-parts/content/content-excerpt';
    protected $defaultPartial       = 'small';
    protected $route                = '/posts/load-more';

    public function __construct(array $options)
    {
        foreach ($this as $property => $value) {
            if (isset($options[$property])) {
                $this->{$property} = $options[$property];
            }
        }
    }

    /**
     * @return int
     */
    public function getInitialPostCount(): int
    {
        return $this->initialPostCount;
    }

    /**
     * @param int $initialPostCount
     *
     * @return ContainerSettings
     */
    public function setInitialPostCount(int $initialPostCount
    ): ContainerSettings {
        $this->initialPostCount = $initialPostCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     *
     * @return ContainerSettings
     */
    public function setPerPage(int $perPage): ContainerSettings
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostFilterClass(): string
    {
        return $this->postFilterClass;
    }

    /**
     * @param string $postFilterClass
     *
     * @return ContainerSettings
     */
    public function setPostFilterClass(string $postFilterClass
    ): ContainerSettings {
        $this->postFilterClass = $postFilterClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getAsyncPostsClass(): string
    {
        return $this->asyncPostsClass;
    }

    /**
     * @param string $asyncPostsClass
     *
     * @return ContainerSettings
     */
    public function setAsyncPostsClass(string $asyncPostsClass
    ): ContainerSettings {
        $this->asyncPostsClass = $asyncPostsClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getValidatorClass(): string
    {
        return $this->validatorClass;
    }

    /**
     * @param string $validatorClass
     *
     * @return ContainerSettings
     */
    public function setValidatorClass(string $validatorClass): ContainerSettings
    {
        $this->validatorClass = $validatorClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getRendererClass(): string
    {
        return $this->rendererClass;
    }

    /**
     * @param string $rendererClass
     *
     * @return ContainerSettings
     */
    public function setRendererClass(string $rendererClass): ContainerSettings
    {
        $this->rendererClass = $rendererClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getRendererTemplatePath(): string
    {
        return $this->rendererTemplatePath;
    }

    /**
     * @param string $rendererTemplatePath
     *
     * @return ContainerSettings
     */
    public function setRendererTemplatePath(
        string $rendererTemplatePath
    ): ContainerSettings {
        $this->rendererTemplatePath = $rendererTemplatePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultPartial(): string
    {
        return $this->defaultPartial;
    }

    /**
     * @param string $defaultPartial
     *
     * @return ContainerSettings
     */
    public function setDefaultPartial(string $defaultPartial): ContainerSettings
    {
        $this->defaultPartial = $defaultPartial;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     *
     * @return ContainerSettings
     */
    public function setRoute(string $route): ContainerSettings
    {
        $this->route = $route;

        return $this;
    }
}
