<?php

namespace App\Service;

class VisitFiles
{
    /**
     * Traverse Files & Directories.
     *
     * Return a list of every files filtered by given function.
     *
     * @param String $root
     * @param callable $filterFn
     *
     * @return void
     */
    public function visitFiles(String $root, callable $filterFn): void
    {
        $directory = new Directory();
        $directory->name = $root;
        foreach($directory->children as $filename){
            if($filterFn($filename)){
                echo $filename, '<br>';
            }
        }
    }

    public function usageExemple(): void
    {
        $this->visitFiles(
            ' __DIR__', // @TODO use a concrete root exemple
            function (File $file) {
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

