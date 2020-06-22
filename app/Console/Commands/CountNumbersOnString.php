<?php

namespace App\Console\Commands;

use App\Service\CountNumbers\IterableNumbers;
use App\Service\CountNumbers\NumbersCounter;
use App\Service\CountNumbers\NumbersOnFile;
use Illuminate\Console\Command;

class CountNumbersOnString extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count-numbers {--path-to-file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count numbers on file';

    /**
     * @var NumbersCounter
     */
    protected $counter;

    /**
     * @var IterableNumbers
     */
    protected $service;

    /**
     * CountNumbers constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->counter = new NumbersCounter();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        if($path = $this->option('path-to-file')){
            if( ! file_exists($path) ){
                throw new \Exception("File {$path} not found!");
            }
            $this->service = new NumbersOnFile($path);
        }

        if( ! $this->service ){
            throw new \Exception("Service not defined");
        }
        foreach ($this->service->getNumbers() as $numbers){
            if( ! is_array($numbers) ){
                throw new \InvalidArgumentException("Value is not array");
            }
            $this->counter->increaseAll($numbers);
        }
        foreach ($results = $this->counter->sortByCount()->getResult() as $number => $count){
            $this->info($number . ' -> ' . $count);
        }
    }
}
