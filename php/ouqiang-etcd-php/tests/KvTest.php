<?php declare(strict_types=1);

namespace Tests;

use GuzzleHttp\Exception\ClientException;

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

    /**
     * request:  curl -X POST http://127.0.0.1:2379/v3/lease/grant -d '{"TTL": 10, "ID": 123}'
     * response: {
     *             "header":{"cluster_id":"14841639068965178418","member_id":"10276657743932975437","revision":"88","raft_term":"3"},
     *             "ID":"123",
     *             "TTL":"10"
     *           }
     *
     * request:  curl -X POST http://127.0.0.1:2379/v3/kv/put -d '{"key": "Zm9v", "value": "YmFy", "lease": 123}'
     * response: {"header":{"cluster_id":"14841639068965178418","member_id":"10276657743932975437","revision":"91","raft_term":"3"}}
     */
    public function test_should_set_value_with_a_lease()
    {
        $leaseId = 123;
        try {
            $this->etcdClient->grant(10, $leaseId);
        } catch (ClientException $e) {
            // 若lease租约已经存在，重复新增会报错：
            // Client error: `POST http://127.0.0.1:2379/v3/lease/grant` resulted in a `400 Bad Request` response:
            // {"error":"etcdserver: lease already exists","code":9,"message":"etcdserver: lease already exists"}
        }
        $response = $this->etcdClient->put('foo', 'bar', ['lease' => $leaseId]);

        $this->assertNotEmpty($response['header']['cluster_id']);
        $this->assertNotEmpty($response['header']['member_id']);
        $this->assertNotEmpty($response['header']['revision']);
        $this->assertNotEmpty($response['header']['raft_term']);

        $response = $this->etcdClient->get('foo');
        $this->assertSame((string)$leaseId, $response['kvs'][0]['lease']);
    }

    /**
     * request:  curl -X POST http://127.0.0.1:2379/v3/kv/range -d '{"key": "Zm9v"}'
     * response: {
     *             "header":{"cluster_id":"14841639068965178418","member_id":"10276657743932975437","revision":"84","raft_term":"3"},
     *             "kvs":[{"key":"Zm9v","create_revision":"69","mod_revision":"84","version":"16","value":"YmFy"}],
     *             "count":"1"
     *           }
     */
    public function test_should_get_key_value()
    {
        $this->etcdClient->put('foo', 'bar');
        $response = $this->etcdClient->get('foo');

        $header = $response['header'];
        $this->assertNotEmpty($header['cluster_id']);
        $this->assertNotEmpty($header['member_id']);
        $this->assertNotEmpty($header['revision']);
        $this->assertNotEmpty($header['raft_term']);

        $kv = $response['kvs'][0];
        $this->assertSame('foo', $kv['key']);
        $this->assertSame('bar', $kv['value']);
        $this->assertNotEmpty($kv['create_revision']);
        $this->assertNotEmpty($kv['mod_revision']);
        $this->assertNotEmpty($kv['version']);

        $this->assertSame("1", $response['count']);
    }
}

