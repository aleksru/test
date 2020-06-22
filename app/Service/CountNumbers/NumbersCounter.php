<?php


namespace App\Service\CountNumbers;


class NumbersCounter
{
    /**
     * @var array
     */
    private $result = [];

    /**
     * @param int $number
     */
    public function increase(int $number): void
    {
        if( ! isset($this->result[$number]) ){
            $this->result[$number] = 0;
        }
        $this->result[$number] = ++$this->result[$number];
    }

    /**
     * @param array $numbers
     */
    public function increaseAll(array $numbers)
    {
        foreach ($numbers as $number){
            if( ! is_int($number) ){
                throw new \InvalidArgumentException('Item is not type int');
            }
            $this->increase($number);
        }
    }

    /**
     * @param string $ordering
     * @return NumbersCounter
     */
    public function sortByCount($ordering = 'DESC'): self
    {
        if($ordering === 'DESC'){
            arsort($this->result);
        }
        if($ordering === 'ASC'){
            asort($this->result);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }
}