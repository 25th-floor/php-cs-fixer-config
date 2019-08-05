<?php

declare(strict_types=1);

/*
 * 25th-floor GmbH
 *
 * @link      https://www.25th-floor.com
 * @copyright Copyright (c) 2019 25th-floor GmbH
 */

namespace TwentyFifth\PhpCsFixer\Tests\Unit;

use TwentyFifth\PhpCsFixer\Php71Config;

/**
 * @internal
 * @covers \TwentyFifth\PhpCsFixer\Php71Config
 */
final class Php71ConfigTest extends ConfigTest
{
    protected function createRuleSet()
    {
        return new Php71Config();
    }
}
