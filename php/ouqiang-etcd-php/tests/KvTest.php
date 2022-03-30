<?php declare(strict_types=1);

namespace Tests;

final class KvTest extends TestCase
{
    /**
     * request:  curl -X POST http://127.0.0.1:2379/v3/kv/put -d '{"key": "Zm9v", "value": "YmFy"}'
     * response: {"header":{"cluster_id":"14841639068965178418","member_id":"10276657743932975437","revision":"35","raft_term":"3"}}
     */
    public function test_should_set_value()
    {
        $response = $this->etcdClient->put('foo', 'bar');

        $this->assertNotEmpty($response['header']['cluster_id']);
        $this->assertNotEmpty($response['header']['member_id']);
        $this->assertNotEmpty($response['header']['revision']);
        $this->assertNotEmpty($response['header']['raft_term']);
    }

    /**
     * request:  curl -X POST http://127.0.0.1:2379/v3/kv/put -d '{"key": "Zm9v", "value": "YmFy", "prev_kv": true}'
     * response: {
     *             "header":{"cluster_id":"14841639068965178418","member_id":"10276657743932975437","revision":"38","raft_term":"3"},
     *             "prev_kv":{"key":"Zm9v","create_revision":"12","mod_revision":"37","version":"26","value":"YmFy"}
     *           }
     */
    public function test_should_set_value_and_return_the_previous_value()
    {
        $this->etcdClient->put('foo', 'bar');
        $response = $this->etcdClient->put('foo', 'SparkLee', ['prev_kv' => true]);

        $header = $response['header'];
        $this->assertNotEmpty($header['cluster_id']);
        $this->assertNotEmpty($header['member_id']);
        $this->assertNotEmpty($header['revision']);
        $this->assertNotEmpty($header['raft_term']);

        $prevKv = $response['prev_kv'];
        $this->assertNotEmpty($prevKv['create_revision']);
        $this->assertNotEmpty($prevKv['mod_revision']);
        $this->assertNotEmpty($prevKv['version']);
        $this->assertSame('foo', $prevKv['key']);
        $this->assertSame('bar', $prevKv['value']);
    }
}

