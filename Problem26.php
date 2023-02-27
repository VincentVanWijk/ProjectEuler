<?php

namespace ProjectEuler;

$problem = new Problem26();
$problem->handle();

class Problem26
{
    public int $value = 0;
    public int $maxCycle = 0;

    function handle()
    {
        for ($i = 2; $i < 1000; $i++) {
            $cycle = $this->getRecurringCycle($i);
            if ($cycle) {
                if ($cycle > $this->maxCycle) {
                    $this->maxCycle = $cycle;
                    $this->value = $i;
                }
            }
        }
        var_dump([
            'value' => $this->value,
            'maxCycle' => $this->maxCycle
        ]);

    }

    function getRecurringCycle($denominator): int
    {
        $numerator = 1;
        $remainder_map = [];
        $remainder = $numerator % $denominator;
        while (!array_key_exists($remainder, $remainder_map) && $remainder != 0) {
            $remainder_map[$remainder] = count($remainder_map);
            $remainder *= 10;
            $remainder %= $denominator;
        }
        if ($remainder == 0) {
            return 0; // non-repeating decimal
        } else {
            return count($remainder_map) - $remainder_map[$remainder];
        }
    }
}


