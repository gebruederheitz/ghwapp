<?php

namespace Gebruederheitz\WpAsyncPostsProvider\Helper;

interface ValidatorInterface
{
    public function validatePaginationReturnType(string $input): bool;
}
