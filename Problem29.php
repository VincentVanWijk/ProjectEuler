<?php
declare(strict_types=1);

namespace ProjectEuler;

$problem = new Problem29();
$problem->handle();

class Problem29
{
    public array $values = [];

    public function handle(): void
    {
        for ($a = 2; $a <= 100; $a++) {
            for ($b = 2; $b <= 100; $b++) {
                $this->values[] = $a ** $b;
            }
        }

        echo count(array_unique($this->values));
    }
}