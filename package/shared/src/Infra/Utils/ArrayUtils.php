<?php

function andWhereTableArray($records, $conditions) {
    return array_filter($records, function ($record) use ($conditions) {
        foreach ($conditions as $key => $value) {
            if (!isset($record[$key]) || $record[$key] != $value) {
                return false;
            }
        }
        return true;
    });
}

function innerJoinTableArrays(array $a, array $b, string $on): array
{
    if (empty($a) || empty($b)) { return array_merge($a, $b); }

    $a = sortTableArrayByColumn($a, $on);
    $b = sortTableArrayByColumn($b, $on);

    return array_filter(array_map(function ($element1, $element2) use ($on) {
        if ($element1[$on] == $element2[$on]) {
            return array_merge($element1, $element2);
        }
        return null;
    }, $a, $b));
}

function sortTableArrayByColumn($array, $column): array
{
    usort($array, function ($element1, $element2) use ($column) {
        if ($element1[$column] == $element2[$column]) {
            return 0;
        }
    
        if ($element1[$column] < $element2[$column]) {
            return -1;
        }
    
        if ($element1[$column] > $element2[$column]) {
            return 1;
        }
    });
    return $array;
}