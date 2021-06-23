<?php

namespace Ghcore\WpAsyncPostsProvider;

interface AsyncPostsInterface
{
    public function restGetPaginatedPosts(WP_REST_Request $request): array;
}
