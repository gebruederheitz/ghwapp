<?php

namespace Ghcore\WpAsyncPostsProvider;

use WP_REST_Request;

interface AsyncPostsInterface
{
    public function restGetPaginatedPosts(WP_REST_Request $request): array;
}
