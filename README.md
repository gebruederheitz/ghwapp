# Wordpress Async Posts Provider

Helps you get your posts asynchronously to the frontend in your plugin or theme

Provides a simple interface ideal for custom pagination especially on hybrid 
setups using both synchronous server-side rendering and asynchronous AJAX-powered
loading of posts from a frontend script or framework using WP's own REST API.

# Installation

via composer:
```json
# composer.json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com/ghcore/ghwapp.git"
        }
    ],
    "require": {
        "ghcore/wp-async-posts-provider": "dev-main"
    }
}
```
```shell
> composer install
```


# Usage

## Using the container with default settings

Initialize the container (usually in your `functions.php`):

```php
<?php

use Ghcore\WpAsyncPostsProvider\Container;

new Container();
```

Make sure you have Composer autoload or an alternative class loader present.

You may pass any options provided by `ContainerSettings` as class properties in
a string-keyed array to the container to modify defaults:

```php
new Container([
    'rendererTemplatePath' => 'template-parts/fancy/excerpt',
    'defaultPartial' => 'fancy-tile',
]);
```

Instantiating the container will register all the relevant Wordpress hooks and 
set up the REST route for use with your frontend scripts / framework.

## Available options

The following options can be set by passing the container an array or defining
them in the YAML config file (with their respective default values):
```yaml
# The number of posts rendered server-side (on page 0).
 - initialPostCount: 8
# The number of posts per page _after_ page 0.
 - perPage: 6
# The classes used for the various functionalities. This is where you can provide
# your own classes implementing the respective interfaces to extend or
# modify functionality.
 - postFilterClass: PostFilter::class
 - asyncPostsClass: AsyncPosts::class
 - validatorClass: Validator::class
 - rendererClass: PostRenderer::class
# The template path passed to `get_template_part` by the renderer.
 - rendererTemplatePath: 'template-parts/content/content-excerpt' 
# The default template name passed as the second parameter to `get_template_part`
# by the renderer. This can be overwritten by the `partial` request parameter.
 - defaultPartial: 'small'
# The route used for retrieving paginated posts asynchronously. This will be
# prefixed with `/ghwapp/v1/` and the basic WP REST path.
 - route: '/posts/load-more'
```

## YAML configuration

## Basic usage

### Hybrid setup: Rendering "page zero"

If you want to deliver rendered HTML with the first couple of posts to the user,
you can use the PostFilter to automatically limit the number of posts initially 
returned by the main query on the front page (currently `is_home()`, will be 
customizable soon).  
Set the number of posts you want to be loaded initially by passing the 
`initialPostCount` option. Setting this value to `0` will disable the 
pre-filtering, and you will receive the default number of items on the main query
(which can be set through the Wordpress settings).

To determine whether or not there are any posts left to be loaded asynchronously
you can use the PostFilter's `shouldShowLoadMoreButton()` method:

```php
/** @var \Ghcore\WpAsyncPostsProvider\ContainerInterface $container */
global $container
?>
<div>
    <?php if ($container->getPostFilter()->shouldShowLoadMoreButton()): ?>
        <button id="load-more">Load more posts</button>
    <?php endif; ?>
</div>
```

## Usage on the front end

> todo


## Extending or modifying components

> todo

### Custom filtering using PostFilter

> todo



# Development

> todo
