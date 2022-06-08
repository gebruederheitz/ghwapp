<?php

namespace Gebruederheitz\WpAsyncPostsProvider;

use WP_REST_Request;

interface AsyncPostsInterface
{
    /**
     * @return array{posts: array<mixed>, more: bool}
     */
    public function restGetPaginatedPosts(WP_REST_Request $request): array;
}
