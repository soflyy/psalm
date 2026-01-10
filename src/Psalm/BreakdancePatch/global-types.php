<?php

/* PSALM HAS BEEN MODIFIED TO INCLUDE THIS FILE IN PSALM.PHP RIGHT BEFORE RUNNING THE PROJECT ANALYZER */

/* LOAD THE GLOBAL TYPES */

// $GLOBAL_TYPE_COMMENT = generate_global_type_comment(
//     array_merge(
//         glob("../plugin/psalm-types/*.php"),
//         glob("../plugin/psalm-types/*/*.php"),
//     )
// );

global $GLOBAL_TYPES_STRING;
$GLOBAL_TYPES_STRING = generate_global_types_string(
    array_merge(
        glob("../plugin/psalm-types/*.php") ?: [],
        glob("../plugin/psalm-types/*/*.php") ?: [],
    )
);

// make is a fuckin g
$GLOBAL_TYPES_STRING_LINE_LENGTH = substr_count($GLOBAL_TYPES_STRING ?? "", "\n") + 4;

function generate_global_types_string($filenames)
{
    return array_reduce($filenames, function ($acc, $item) {
        return $acc . "\n\n" . str_replace("?>", "", str_replace("<?php", "", file_get_contents($item)));
    }, "");
}
