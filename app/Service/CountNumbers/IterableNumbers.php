<?php


namespace App\Service\CountNumbers;


interface IterableNumbers
{
    function getNumbers(): \Generator;
}