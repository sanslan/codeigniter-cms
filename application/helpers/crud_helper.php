<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_single_entry( $cur_page, $num_rows, $per_page )
{
    if((($cur_page-1)*$per_page) + 1 == $num_rows)
        return TRUE;
    else
        return FALSE;
    
}