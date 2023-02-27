<?php
declare(strict_types=1);

namespace ProjectEuler;

$problem = new Problem28();
$problem->handle();

class Problem28
{
    public int $size = 5;
    public int $x = 0;
    public int $y = 0;
    public int $n = 0;
    public array $matrix = [];

    public function handle(): void
    {
        $this->setup();
        $this->buildMatrix();

        if (php_sapi_name() !== 'cli') {
            $this->display();
        } else {
            $this->addDiagonals();
        }
    }

    private function setup(): void
    {
        $this->matrix = $this->setGrid();
        $this->x = array_key_last($this->matrix[0]);
        $this->y = 0;
        $this->n = $this->size ** 2;
    }

    private function setGrid(): array
    {
        $matrix = [];
        for ($x = 0; $x < $this->size; $x++) {
            for ($y = 0; $y < $this->size; $y++) {
                $matrix[$x][$y] = 0;
            }
        }

        return $matrix;
    }

    public function buildMatrix(): void
    {
        while ($this->n > 0) {
            $this->goLeft();
            $this->goDown();
            $this->goRight();
            $this->goUp();
        }
    }

    private function goLeft(): void
    {
        while ($this->spotIsFree()) {
            $this->matrix[$this->y][$this->x] = $this->n;
            $this->x--;
            $this->n--;

            if ($this->n == 0) {
                return;
            }
        }
        $this->y++;
        $this->x++;
    }

    private function spotIsFree(): bool
    {
        return isset($this->matrix[$this->y][$this->x]) && $this->matrix[$this->y][$this->x] == 0;
    }

    private function goDown(): void
    {
        while ($this->spotIsFree()) {
            $this->matrix[$this->y][$this->x] = $this->n;
            $this->y++;
            $this->n--;

            if ($this->n == 0) {
                return;
            }
        }
        $this->x++;
        $this->y--;
    }

    private function goRight(): void
    {
        while ($this->spotIsFree()) {
            $this->matrix[$this->y][$this->x] = $this->n;
            $this->x++;
            $this->n--;

            if ($this->n == 0) {
                return;
            }
        }

        $this->x--;
        $this->y--;
    }

    private function goUp(): void
    {
        while ($this->spotIsFree()) {
            $this->matrix[$this->y][$this->x] = $this->n;
            $this->y--;
            $this->n--;

            if ($this->n == 0) {
                return;
            }
        }
        $this->x--;
        $this->y++;
    }

    private function display(): void
    {
        echo '<style>
                body{padding-left:50px;}
            </style>';

        foreach ($this->matrix as $y) {

            foreach ($y as $x) {
                echo $x . "\t";
            }
            echo PHP_EOL;
        }
    }

    private function addDiagonals(): void
    {
        $sum = -1;

        for ($i = 0; $i < count($this->matrix[0]); $i++) {
            $sum += $this->matrix[$i][$i];
        }

        $x = 0;
        for ($y = $this->size - 1; $y >= 0; $y--) {
            $sum += $this->matrix[$y][$x];
            $x++;
        }

        echo "Answer is: $sum\n";
    }
}