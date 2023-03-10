<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-file-iterator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\FileIterator;

use function array_filter;
use function array_map;
use function preg_match;
use function realpath;
use function str_ends_with;
use function str_replace;
use function str_starts_with;
use FilterIterator;

final class Iterator extends FilterIterator
{
    public const PREFIX = 0;

    public const SUFFIX = 1;
    private string|false $basePath;
    private array $suffixes;
    private array $prefixes;
    private array $exclude;

    public function __construct(string $basePath, \Iterator $iterator, array $suffixes = [], array $prefixes = [], array $exclude = [])
    {
        $this->basePath = realpath($basePath);
        $this->prefixes = $prefixes;
        $this->suffixes = $suffixes;
        $this->exclude  = array_filter(array_map('realpath', $exclude));

        parent::__construct($iterator);
    }

    public function accept(): bool
    {
        $current  = $this->getInnerIterator()->current();
        $filename = $current->getFilename();
        $realPath = $current->getRealPath();

        if ($realPath === false) {
            return false;
        }

        return $this->acceptPath($realPath) &&
               $this->acceptPrefix($filename) &&
               $this->acceptSuffix($filename);
    }

    private function acceptPath(string $path): bool
    {
        // Filter files in hidden directories by checking path that is relative to the base path.
        if (preg_match('=/\.[^/]*/=', str_replace($this->basePath, '', $path))) {
            return false;
        }

        foreach ($this->exclude as $exclude) {
            if (str_starts_with($path, $exclude)) {
                return false;
            }
        }

        return true;
    }

    private function acceptPrefix(string $filename): bool
    {
        return $this->acceptSubString($filename, $this->prefixes, self::PREFIX);
    }

    private function acceptSuffix(string $filename): bool
    {
        return $this->acceptSubString($filename, $this->suffixes, self::SUFFIX);
    }

    private function acceptSubString(string $filename, array $subStrings, int $type): bool
    {
        if (empty($subStrings)) {
            return true;
        }

        $matched = false;

        foreach ($subStrings as $string) {
            if (($type === self::PREFIX && str_starts_with($filename, $string)) ||
                ($type === self::SUFFIX && str_ends_with($filename, $string))) {
                $matched = true;

                break;
            }
        }

        return $matched;
    }
}
