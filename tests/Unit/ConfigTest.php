<?php

declare(strict_types=1);

/*
 * 25th-floor GmbH
 *
 * @link      https://www.25th-floor.com
 * @copyright Copyright (c) 2019 25th-floor GmbH
 */

namespace TwentyFifth\PhpCsFixer\Tests\Unit;

use PhpCsFixer\Config;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
abstract class ConfigTest extends TestCase
{
    public function testPsr2Included() : void
    {
        $config = Config::create();

        self::assertContains('@PSR2', $config->getRules());
    }

    public function testAllConfiguredRulesAreBuiltIn() : void
    {
        $fixersNotBuiltIn = \array_diff(
            $this->configuredFixers(),
            $this->builtInFixers()
        );

        \sort($fixersNotBuiltIn);

        self::assertEmpty($fixersNotBuiltIn, \sprintf(
            'Failed to assert that fixers for the rules "%s" are built in',
            \implode('", "', $fixersNotBuiltIn)
        ));
    }

    public function testAllBuiltInRulesAreConfigured() : void
    {
        $fixersWithoutConfiguration = \array_diff(
            $this->builtInFixers(),
            $this->configuredFixers()
        );

        \sort($fixersWithoutConfiguration);

        self::assertEmpty($fixersWithoutConfiguration, \sprintf(
            'Failed to assert that built-in fixers for the rules "%s" are configured',
            \implode('", "', $fixersWithoutConfiguration)
        ));
    }

    /**
     * @dataProvider providerRuleNames
     *
     * @param array  $ruleNames
     * @param string $source
     */
    public function testRulesAreSortedByName($source, $ruleNames) : void
    {
        $sorted = $ruleNames;
        \sort($sorted);
        self::assertEquals($sorted, $ruleNames, \sprintf(
            'Failed to assert that the rules are sorted by name in %s',
            $source
        ));
    }

    /**
     * @return \Generator
     */
    public function providerRuleNames()
    {
        $values = [
            'rule set' => $this->createRuleSet()->getRules(),
        ];

        foreach ($values as $source => $rules) {
            yield [
                $source,
                \array_keys($rules),
            ];
        }
    }

    /**
     * @param string $header
     *
     * @throws \InvalidArgumentException
     *
     * @return Config
     */
    abstract protected function createRuleSet();

    /**
     * @return string[]
     */
    private function builtInFixers()
    {
        static $builtInFixers;

        if (null === $builtInFixers) {
            $fixerFactory = FixerFactory::create();
            $fixerFactory->registerBuiltInFixers();
            $builtInFixers = \array_map(static function (FixerInterface $fixer) {
                return $fixer->getName();
            }, $fixerFactory->getFixers());
        }

        return $builtInFixers;
    }

    /**
     * @return string[]
     */
    private function configuredFixers()
    {
        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they are not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = \array_map(static function () {
            return true;
        }, $this->createRuleSet()->getRules());

        return \array_keys(RuleSet::create($rules)->getRules());
    }
}
