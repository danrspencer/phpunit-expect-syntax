<?php

require_once 'Expector.php';

function expect($actual)
{
    return new Expector($actual);
}