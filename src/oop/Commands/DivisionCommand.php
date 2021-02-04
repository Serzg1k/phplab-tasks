<?php

namespace src\oop\Commands;

class DivisionCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args) || $args[1] === 0) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] / $args[1];
    }
}