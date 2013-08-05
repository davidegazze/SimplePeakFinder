<?php

function simple_peak_finder(&$x0, $sel=0, $thresh=null, $extrema=1) {
    // Reture all the point that are above a sel
    // A[i] where A[i] >= A[i-1] and A[i] >= A[i + 1].
    $numX0 = count($x0);
    $response = array();
    $response['value'] = array();
    $response['index'] = array();
    $index = -1;
    $value = -1;
    for($i=0; $i<$numX0; $i++) {
        $insert = false;
        switch($i) {
            case 0:
                if(($x0[$i]*$extrema) >= (($x0[$i+1]*$extrema)+$sel)) {
                    $value = $x0[$i];
                    $index = $i;
                    $insert = true;
                }
                else
                    $insert = false;
                break;
            case ($numX0-1):
                if(($x0[$i]*$extrema) >= (($x0[$i-1]*$extrema)+$sel)) {
                    $value = $x0[$i];
                    $index = $i;
                    $insert = true;
                }
                else
                    $insert = false;
                break;
            default:
                if((($x0[$i]*$extrema) >= (($x0[$i-1]*$extrema)+$sel)) && (($x0[$i]*$extrema) >= (($x0[$i+1]*$extrema)+$sel))) {
                    $value = $x0[$i];
                    $index = $i;
                    $insert = true;
                }
                else
                    $insert = false;
        }
        if($insert) {
            if($thresh !== null) {
                if($value > $thresh) {
                    $response['values'][] = $value;
                    $response['indexs'][] = $index;
                }
            }
            else {
                $response['values'][] = $value;
                $response['indexs'][] = $index;
            }
        }
    }
    return $response;
}

?>
