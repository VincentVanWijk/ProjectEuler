<?php
declare(strict_types=1);

namespace ProjectEuler;

$problem = new Problem30();
$problem->handle();

class Problem30
{
    public array $values = [];
    public array $digits = [];

    public function handle(): void
    {
        for ($n = 2; $n < 1000000; $n++) {
            $nDigits = array_map(function ($item) {
                return intval($item);
            }, str_split((string)$n));

            $this->digits[$n] = $nDigits;
        }

        foreach ($this->digits as $n => $digits) {
            $sum = 0;
            foreach ($digits as $digit) {
                $sum += $digit ** 5;
            }

            if ($sum === $n) {
                $this->values[] = $n;
            }
        }

        $answer = array_sum($this->values);
        echo "Answer is: $answer";
    }
}