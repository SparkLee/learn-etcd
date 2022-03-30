<?php declare(strict_types=1);

namespace Tests;

use Etcd\Client;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    protected Client $etcdClient;

    protected function setUp(): void
    {
        $this->etcdClient = new Client('127.0.0.1:2379', 'v3');
    }
}
