<?php

namespace Dmattern\Jaccard;

class Similar {
    public static function calculate(
        string $first,
        string $second,
        string $separator = ' ',
    ): float
    {
        if (empty($separator)) {
            throw new \InvalidArgumentException('Separator cannot be empty');
        }
        $first = explode($separator, $first);
        $second = explode($separator, $second);
        $intersection = array_intersect($first, $second);
        $uniqueUnion = array_unique(array_merge($first, $second));
        return count($intersection) / count($uniqueUnion);
    }
}
