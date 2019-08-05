<?php

declare(strict_types=1);

/*
 * 25th-floor GmbH
 *
 * @link      https://www.25th-floor.com
 * @copyright Copyright (c) 2019 25th-floor GmbH
 */

namespace TwentyFifth\PhpCsFixer\Tests\Unit;

use TwentyFifth\PhpCsFixer\Php73Config;

/**
 * @internal
 * @covers \TwentyFifth\PhpCsFixer\Php73Config
 */
final class Php73ConfigTest extends ConfigTest
{
    protected function createRuleSet()
    {
        return new Php73Config();
    }
}
