<?php
declare(strict_types=1);

namespace ProjectEuler;

$problem = new Problem31();
$problem->handle();

class Problem31
{
    private array $combos = [];

    public function handle(): void
    {
        for ($hundreds = 0; $hundreds <= 2; $hundreds++) {
            for ($fifties = 0; $fifties <= 4; $fifties++) {
                if ($hundreds * 100 + $fifties * 50 > 200) {
                    continue;
                }
                for ($twenties = 0; $twenties <= 10; $twenties++) {
                    if ($fifties * 50 + $twenties * 20 > 200) {
                        continue;
                    }
                    for ($tens = 0; $tens <= 20; $tens++) {
                        if ($twenties * 20 + $tens * 10 > 200) {
                            continue;
                        }
                        for ($fives = 0; $fives <= 40; $fives++) {
                            if ($tens * 10 + $fives * 5 > 200) {
                                continue;
                            }
                            for ($twos = 0; $twos <= 100; $twos++) {
                                if ($fives * 5 + $twos * 2 > 200) {
                                    continue;
                                }
                                for ($ones = 0; $ones <= 200; $ones++) {
                                    $target = 200;
                                    $result = $this->calculate($target, $ones, $twos, $fives, $tens, $twenties, $fifties, $hundreds);
                                    if ($result === 0) {
                                        $this->combos[] = [
                                            'ones' => $ones,
                                            'twos' => $twos,
                                            'fives' => $fives,
                                            'tens' => $tens,
                                            'twenties' => $twenties,
                                            'fifties' => $fifties,
                                            'hundreds' => $hundreds,
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $uniqueIdentifiers = array_map('serialize', $this->combos);
        var_dump($uniqueIdentifiers[0]);
        $this->combos = array_unique($uniqueIdentifiers);

        var_dump(count($this->combos) + 1);
    }

    private function calculate(int $target, int $ones, int $twos, int $fives, int $tens, int $twenties, int $fifties, int $hundreds): int
    {
        return $target - $ones - ($twos * 2) - ($fives * 5) - ($tens * 10) - ($twenties * 20) - ($fifties * 50) - ($hundreds * 100);
    }
}