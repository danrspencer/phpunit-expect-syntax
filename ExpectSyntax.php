<?php

require_once 'Expector.php';

function expect($actual, $functionName = null)
{
    return new Expector($actual, $functionName);
}
