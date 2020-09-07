<?php

/**
 * Calculate percentage of address is completed
 *
 * @param $address
 * @return float|int
 */
function calculate_address($address)
{
    if (!$address)
    {
        return 0;
    }

    $columns        = preg_grep('/(.+ed_at)|(.*id)|(.*_type)|(is_*)/',array_keys($address->toArray()),PREG_GREP_INVERT);
    $delete_columns = ["created_at","updated_at","image1","image2","image3","image4",'oppo'];

    $columns = \array_diff($columns,$delete_columns);

    $per_column = 100 / count($columns);
    $total      = 0;

    foreach ($address->toArray() as $key => $value)
    {
        //check column if not null or empty
        if ($value !== null && $value !== [] && in_array($key,$columns) && $value !== '')
        {
            $total += $per_column;
        } else
        {
            $emp[] = $key;
        }
    }

    return $total;
}
