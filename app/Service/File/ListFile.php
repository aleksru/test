<?php


namespace App\Service\File;


class ListFile implements IterableStrings
{
    /**
     * @var string
     */
    protected $path;

    /**
     * ListFile constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return \Generator
     * @throws \Exception
     */
    public function getString(): \Generator
    {
        $handle = @fopen($this->path, "r");
        if ($handle) {
            while (($buffer = fgets($handle)) !== false) {
                yield $buffer;
            }
            if ( ! feof($handle) ) {
                throw new \Exception("Ошибка: fgets() неожиданно потерпел неудачу\n");
            }
            fclose($handle);
        }else{
            throw new \Exception("Ошибка: fopen() не удалось открыть файл {$this->path}\n");
        }
    }

}