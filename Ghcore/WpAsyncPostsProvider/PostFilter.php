<?php

namespace Ghcore\WpAsyncPostsProvider;

use WP_Post;
use WP_Query;

class PostFilter implements PostFilterInterface
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        if ($this->getInitialPostCount() != 0) {
            add_action('pre_get_posts', [$this, 'onPreGetPosts']);
        }
    }

    /**
     * Callback for the 'pre_get_posts' action hook.
     *
     * @param  WP_Query  $query
     */
    public function onPreGetPosts(WP_Query $query): void
    {
        if (!is_admin() && $query->is_main_query()) {
            /* @TODO: customizable filter */
            if ($query->is_home()) {
                $query->set(
                    'posts_per_page',
                    $this->getInitialPostCount()
                );
            }
        }
    }

    /**
     * @return bool
     */
    public function shouldShowLoadMoreButton(): bool
    {
        $initialCount = $this->getInitialPostCount();
        $count = count(
            get_posts(
                [
                    'posts_per_page' => ($initialCount + 1),
                    'fields' => 'ids',
                ]
            )
        );

        return $count > $initialCount;
    }

    /**
     * Filters posts for pagination and returns an array of WP_Post objects. The
     * 0-index page is what's shown on page load (i.e. the
     * latest CustomTaxonomies::$initialTilesDisplayed number of items). The
     * reference parameter "more" will indicate whether the current filter can
     * provide more posts (i.e. whether there are further pages). You will need
     * to pass your own query parameters as the second function parameter
     * $queryParams; otherwise it will return all the latest posts.
     *
     * @param int   $pageNumber   The page number queried. 0 will return the
     *                            same as a page template without loading more
     *                            items.
     * @param array $queryParams  The category to filter for.
     * @param int   $postsPerPage The number of posts to return – this should
     *                            not change between subsequent requests on the
     *                            same page.
     * @param bool|null $more   Will be set to a boolean value indicating
     *                            whether there are further pages to be queried.
     * @param ?int $initialOffset The number of posts on page 0. Defaults to
     *                            CustomTaxonomies::$initialTilesDisplayed.
     *
     * @return WP_Post[]          An array of WP_Post objects.
     */
    public function getPaginatedPostsData(
        int $pageNumber,
        array $queryParams = [],
        int $postsPerPage = 6,
        bool &$more = null,
        ?int $initialOffset = null
    ): array {
        $more = false;
        $offset = 0;
        $postsToReturn = $postsPerPage;
        $initialCount = $this->getInitialPostCount();

        if ($pageNumber > 0) {
            $initialOffset = $initialOffset ?: $initialCount;
            $offset = $initialOffset + (($pageNumber - 1) * $postsPerPage);
        } else {
            // for page index 0, only show the first posts (offset 0) until $initialTilesDisplayed
            $postsToReturn = $initialOffset ?: $initialCount;
        }

        // Baker's dozen: get one more post than we need to see if there are more
        $postsToGet = $postsToReturn + 1;

        $defaultQueryParams = [
            'post_type' => 'post',
            'numberposts' => $postsToGet,
            'offset' => $offset,
        ];

        $queryParamsUsed = array_merge_recursive($defaultQueryParams, $queryParams);

        $posts = get_posts($queryParamsUsed);

        if (count($posts) > $postsToReturn) {
            // Remove the additional post from the returned data and set the flag
            $more = true;
            array_pop($posts);
        }

        return $posts;
    }

    private function getInitialPostCount(): int
    {
        return $this->container->getSettings()->getInitialPostCount();
    }
}
