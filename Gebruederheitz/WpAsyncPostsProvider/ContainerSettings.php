<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRenderer;
use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Gebruederheitz\WpAsyncPostsProvider\Helper\Validator;
use Gebruederheitz\WpAsyncPostsProvider\Helper\ValidatorInterface;

class ContainerSettings
{
    /** @var int */
    protected $initialPostCount = 8;

    /** @var int */
    protected $perPage = 6;

    /** @var class-string<PostFilterInterface> */
    protected $postFilterClass = PostFilter::class;

    /** @var class-string<AsyncPostsInterface>  */
    protected $asyncPostsClass = AsyncPosts::class;

    /** @var class-string<ValidatorInterface>  */
    protected $validatorClass = Validator::class;

    /** @var class-string<PostRendererInterface>  */
    protected $rendererClass = PostRenderer::class;

    /** @var string */
    protected $rendererTemplatePath = 'template-parts/content/content-excerpt';

    /** @var string */
    protected $defaultPartial = 'small';

    /** @var string */
    protected $route = '/posts/load-more';

    /**
     * @param array<string, mixed> $options
     */
    public function __construct(array $options)
    {
        /** @phpstan-ignore-next-line */
        foreach ($this as $property => $value) {
            if (isset($options[$property])) {
                $this->{$property} = $options[$property];
            }
        }
    }

    public function getInitialPostCount(): int
    {
        return $this->initialPostCount;
    }

    public function setInitialPostCount(
        int $initialPostCount
    ): ContainerSettings {
        $this->initialPostCount = $initialPostCount;

        return $this;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage): ContainerSettings
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @return class-string<PostFilterInterface>
     */
    public function getPostFilterClass(): string
    {
        return $this->postFilterClass;
    }

    /**
     * @param class-string<PostFilterInterface> $postFilterClass
     */
    public function setPostFilterClass(
        string $postFilterClass
    ): ContainerSettings {
        $this->postFilterClass = $postFilterClass;

        return $this;
    }

    /**
     * @return class-string<AsyncPostsInterface>
     */
    public function getAsyncPostsClass(): string
    {
        return $this->asyncPostsClass;
    }

    /**
     * @param class-string<AsyncPostsInterface> $asyncPostsClass
     */
    public function setAsyncPostsClass(
        string $asyncPostsClass
    ): ContainerSettings {
        $this->asyncPostsClass = $asyncPostsClass;

        return $this;
    }

    /**
     * @return class-string<ValidatorInterface>
     */
    public function getValidatorClass(): string
    {
        return $this->validatorClass;
    }

    /**
     * @param class-string<ValidatorInterface> $validatorClass
     */
    public function setValidatorClass(string $validatorClass): ContainerSettings
    {
        $this->validatorClass = $validatorClass;

        return $this;
    }

    /**
     * @return class-string<PostRendererInterface>
     */
    public function getRendererClass(): string
    {
        return $this->rendererClass;
    }

    /**
     * @param class-string<PostRendererInterface> $rendererClass
     */
    public function setRendererClass(string $rendererClass): ContainerSettings
    {
        $this->rendererClass = $rendererClass;

        return $this;
    }

    public function getRendererTemplatePath(): string
    {
        return $this->rendererTemplatePath;
    }

    public function setRendererTemplatePath(
        string $rendererTemplatePath
    ): ContainerSettings {
        $this->rendererTemplatePath = $rendererTemplatePath;

        return $this;
    }

    public function getDefaultPartial(): string
    {
        return $this->defaultPartial;
    }

    public function setDefaultPartial(string $defaultPartial): ContainerSettings
    {
        $this->defaultPartial = $defaultPartial;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): ContainerSettings
    {
        $this->route = $route;

        return $this;
    }
}
