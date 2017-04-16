<?php
namespace PhpLint;

use Symfony\Component\Finder\Finder as SymfonyFinder;

class Finder
{
    private $finder;
    public function __construct($patch, $extension, $ignorePatch, $ignorePattern)
    {
        $this->finder = new SymfonyFinder();
        $this->finder
            ->files()
            ->ignoreUnreadableDirs()
            ->name('*'.$extension)
            ->in($patch);
        if ($ignorePatch) {
            $this->finder->notPath($ignorePatch);
        }
        if ($ignorePattern) {
            $this->finder->exclude($ignorePattern);
        }
    }
    public function files() {
        return $this->finder->files();
    }
}