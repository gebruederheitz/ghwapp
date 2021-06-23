<?php

namespace Ghcore\WpAsyncPostsProvider\Helper;

interface ValidatorInterface
{
    public function validatePaginationReturnType(string $input): bool;
}
