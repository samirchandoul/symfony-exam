<?php

namespace App\Service;


class Directory
{
    /**
     * @param string $name
     * @param (File|Directory)[] $children
     */
    public function __construct(
        public string $name,
        public array $children,
    ) {
    }
}




