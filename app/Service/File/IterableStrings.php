<?php


namespace App\Service\File;


interface IterableStrings
{
    function getString() : \Generator;
}