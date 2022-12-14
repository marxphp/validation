<?php

declare(strict_types=1);

/**
 * This file is part of MaxPHP.
 *
 * @link     https://github.com/marxphp
 * @license  https://github.com/marxphp/max/blob/master/LICENSE
 */

namespace Max\Validation;

class RuleParser
{
    public static function parse(string $rule): array
    {
        if (empty($rule)) {
            return [];
        }
        $parameters = [];
        if (str_contains($rule, ':')) {
            [$rule, $parameter] = explode(':', $rule, 2);
            $parameters         = static::parseParameters($rule, $parameter);
        }
        return [$rule, $parameters];
    }

    protected static function parseParameters($rule, $parameter): array
    {
        return static::ruleIsRegex($rule) ? [$parameter] : str_getcsv($parameter);
    }

    protected static function ruleIsRegex($rule): bool
    {
        return in_array(strtolower($rule), ['regex', 'not_regex', 'notregex'], true);
    }
}
