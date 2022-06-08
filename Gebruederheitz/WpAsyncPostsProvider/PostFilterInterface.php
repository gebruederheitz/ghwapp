<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use WP_Query;
use WP_Post;

interface PostFilterInterface
{
    /**
     * @param array<string, mixed>  $queryParams
     *
     * @return array<WP_Post>
     */
    public function getPaginatedPostsData(
        int $pageNumber,
        array $queryParams = [],
        int $postsPerPage = 6,
        bool &$more = null,
        ?int $initialOffset = null
    ): array;

    public function shouldShowLoadMoreButton(): bool;

    public function onPreGetPosts(WP_Query $query): void;
}
