<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use DI\Container;
use DI\Definition\Source\MutableDefinitionSource;
use DI\Proxy\ProxyFactory;
use Gebruederheitz\WpAsyncPostsProvider\Helper\PostRendererInterface;
use Gebruederheitz\SimpleSingleton\SingletonAble;
use Gebruederheitz\WpAsyncPostsProvider\Helper\ValidatorInterface;
use Gebruederheitz\SimpleSingleton\SingletonInterface;
use Psr\Container\ContainerInterface as PsrContainerInterface;

class AsyncPostsProvider extends Container implements
    ContainerInterface,
    PsrContainerInterface,
    SingletonInterface
{
    use SingletonAble;

    /** @var ContainerSettings */
    protected $settings;

    /** @var PostFilterInterface */
    protected $postFilter;

    /** @var AsyncPostsInterface */
    protected $asyncPosts;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var PostRendererInterface */
    protected $renderer;

    protected function __construct(
        MutableDefinitionSource $definitionSource = null,
        ProxyFactory $proxyFactory = null,
        PsrContainerInterface $wrapperContainer = null
    ) {
        parent::__construct(
            $definitionSource,
            $proxyFactory,
            $wrapperContainer,
        );
    }

    /**
     * @param array<string, mixed> $options
     */
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

    public function getPostFilter(): PostFilterInterface
    {
        return $this->postFilter;
    }

    public function setPostFilter(
        PostFilterInterface $postFilter
    ): ContainerInterface {
        $this->postFilter = $postFilter;

        return $this;
    }

    public function getAsyncPosts(): AsyncPostsInterface
    {
        return $this->asyncPosts;
    }

    public function setAsyncPosts(
        AsyncPostsInterface $asyncPosts
    ): ContainerInterface {
        $this->asyncPosts = $asyncPosts;

        return $this;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    public function setValidator(
        ValidatorInterface $validator
    ): ContainerInterface {
        $this->validator = $validator;

        return $this;
    }

    public function getRenderer(): PostRendererInterface
    {
        return $this->renderer;
    }

    public function setRenderer(
        PostRendererInterface $renderer
    ): ContainerInterface {
        $this->renderer = $renderer;

        return $this;
    }
}
