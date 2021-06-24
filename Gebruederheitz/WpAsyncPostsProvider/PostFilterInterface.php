<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use WP_Query;

interface PostFilterInterface
{
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
