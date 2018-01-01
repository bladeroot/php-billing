<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\tests\unit\target;

use hiqdev\php\billing\target\TargetCollection;
use hiqdev\php\billing\target\Target;

/**
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class TargetTest extends \PHPUnit\Framework\TestCase
{
    protected $id1 = 1;

    protected $id2 = 2;

    protected function setUp()
    {
        $this->atarget = new Target(null,       null);
        $this->aserver = new Target(null,       'server');
        $this->server1 = new Target($this->id1, 'server');
        $this->server2 = new Target($this->id2, 'server');
        $this->servers = new TargetCollection([$this->server1, $this->server2]);
        $this->adomain = new Target(null,       'domain');
        $this->domain1 = new Target($this->id1, 'domain');
        $this->domain2 = new Target($this->id2, 'domain');
        $this->domains = new TargetCollection([$this->domain1, $this->domain2]);
    }

    protected function tearDown()
    {
    }

    public function testMatches()
    {
        $atarget = new Target(null,       null);
        $aserver = new Target(null,       'server');
        $server1 = new Target($this->id1, 'server');
        $server2 = new Target($this->id2, 'server');
        $servers = new TargetCollection([$this->server1, $this->server2]);
        $adomain = new Target(null,       'domain');
        $domain1 = new Target($this->id1, 'domain');
        $domain2 = new Target($this->id2, 'domain');
        $domains = new TargetCollection([$this->domain1, $this->domain2]);

        $this->checkMatches([
            $this->atarget, $atarget,
            $this->aserver, $aserver,
            $this->server1, $server1,
            $this->servers, $servers,
        ]);
        $this->checkMatches([
            $this->atarget, $atarget,
            $this->aserver, $aserver,
            $this->server2, $server2,
            $this->servers, $servers,
        ]);

        $this->checkDoesntMatch([
            $this->server1, $this->server2, $this->adomain,
        ]);

        $this->checkDoesntMatch([
            $this->domain1, $this->domain2, $this->servers,
        ]);
    }

    protected function checkDoesntMatch(array $targets)
    {
        $this->checkMatches($targets, false);
    }

    protected function checkMatches(array $targets, bool $expect = true)
    {
        foreach ($targets as $k => $v) {
            foreach ($targets as $j => $w) {
                if ($k === $j) {
                    $this->assertTrue($v->matches($w));
                } else {
                    $this->checkSingleMatch($expect, $v, $w);
                }
            }
        }
    }

    protected function checkSingleMatch(bool $expect, $lhs, $rhs)
    {
        $check = $lhs->matches($rhs);
        if ($check !== $expect) {
            var_dump('no match', $expect, $lhs, $rhs);
        }
        $this->assertSame($expect, $check);
    }
}
