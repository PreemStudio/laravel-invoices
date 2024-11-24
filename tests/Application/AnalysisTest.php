<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Application;

use BaseCodeOy\PackagePowerPack\TestBench\AbstractAnalysisTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class AnalysisTest extends AbstractAnalysisTestCase
{
    protected static function getIgnored(): array
    {
        return [
            'Spatie\Snapshots\assertMatchesSnapshot',
            'Spatie\Snapshots\assertMatchesHtmlSnapshot',
        ];
    }
}
