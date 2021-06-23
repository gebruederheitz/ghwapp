<?php

namespace Ghcore\WpAsyncPostsProvider\Helper;

class Validator implements ValidatorInterface
{
    /**
     * Validation callback for the return type parameter ("return"), which can
     * be either 'html' or 'json'.
     *
     * @param string $input
     *
     * @return bool  TRUE if $input is a valid parameter value
     */
    public function validatePaginationReturnType(string $input): bool
    {
        return $input === 'html' || $input === 'json';
    }
}
