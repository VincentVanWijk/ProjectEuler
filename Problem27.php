<?php
declare(strict_types=1);

namespace ProjectEuler;

$problem = new Problem27();
$problem->handle();

class Problem27
{
    public array $primes = [2, 3, 5, 7, 11, 13, 17, 19];
    public int $maxA = 0;
    public int $maxB = 0;
    public int $maxN = 0;

    public function handle(): void
    {
        for ($a = -1000; $a < 1000; $a++) {
            for ($b = -1000; $b <= 1000; $b++) {
                $n = 0;

                while ($this->isPrime($this->formula($a, $b, $n))) {
                    $n++;
                }

                if ($n > $this->maxN) {
                    $this->maxN = $n;
                    $this->maxA = $a;
                    $this->maxB = $b;
                }
            }
        }

        echo "MaxA: $this->maxA\n";
        echo "MaxB: $this->maxB\n";
        echo "MaxN: $this->maxN\n";
        $result = $this->maxA * $this->maxB;
        echo "result: $result";
    }

    private function formula($a, $b, $n): int
    {

        return abs(($n * $n) + ($a * $n) + $b);
    }

    private function isPrime($n): bool
    {
        if (in_array($n, $this->primes)) {
            return true;
        }

        for ($i = 2; $i < $n; $i++) {
            if ($n % $i == 0) {
                return false;
            }
        }

        $this->primes[] = $n;


        return true;
    }
}