<?php


namespace App\Service\CountNumbers;


use App\Service\File\IterableStrings;

class NumbersOnFile implements IterableNumbers
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var IterableStrings
     */
    protected $listFile;

    /**
     * NumbersOnFile constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->listFile = app(IterableStrings::class, ['path' => $path]);
    }

    /**
     * @return \Generator
     */
    public function getNumbers(): \Generator
    {
        foreach ($this->listFile->getString() as $string){
            preg_match_all("/\d+/", $string, $matches);
            yield array_map(function ($value){
                return (int)$value;
            }, $matches[0]);
        }
    }

}