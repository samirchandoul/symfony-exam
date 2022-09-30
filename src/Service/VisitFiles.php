<?php

namespace App\Service;

class File
{
    public function __construct(
        public readonly string $name,
    ) {
    }
}

class Directory
{
    /**
     * @param string $name
     * @param (File|Directory)[] $children
     */
    public function __construct(
        public readonly string $name,
        public readonly array $children,
    ) {
    }
}

class VisitFiles
{
    /**
     * Traverse Files & Directories.
     *
     * Return a list of every files filtered by given function.
     *
     * @param TODO $root
     * @param TODO $filterFn
     *
     * @return TODO
     */
    public function visitFiles($root, callable $filterFn): void
    {
        // @TODO
    }

    public function usageExemple(): void
    {
        $this->visitFiles(
            null, // @TODO use a concrete root exemple
            function ($file) {
                $name = $file->name;
                for ($i = 0; $i < floor(strlen($name)); $i++) {
                    if ($name[$i] != $name[strlen($name) - $i - 1]) {
                        return false;
                    }
                }
                return true;
            }
        );
    }
}
