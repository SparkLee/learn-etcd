# 使用goreman管理本地etcd多实例集群

### 用goreman启动etcd集群
一、启动etcd集群
```shell
$ chmod +x goreman
```

```shell
$ ./goreman start
```

或指定配置文件：
> 若使用默认配置文件(Procfile)，则无需指定。
```shell
$ ./goreman -f Procfile start
```

二、启用tls安全连接启动etcd集群
> 自动生成tls证书/密钥文件：[Automatic certificates](https://etcd.io/docs/v3.5/op-guide/clustering/#automatic-certificates)
```shell
$ ./goreman -f Procfile-tls start
```

三、使用etcd自发现模式启动etcd集群
> [etcd discovery](https://etcd.io/docs/v3.5/op-guide/clustering/#etcd-discovery)

获取服务发现URL：
> 通过etcd官方提供的dicovery服务创建一个指定集群大小的服务发现URL。
```shell
$ curl https://discovery.etcd.io/new?size=3

返回服务发现URL：https://discovery.etcd.io/4c40bf442c133d672518ee44a58d34a5
```

启动etcd集群
```shell
$ ./goreman -f Procfile-discovery start
```

### 用goreman停止/启动集群中的单个实例（节点）
```shell
# 停止
$ ./goreman run stop etcd3

# 启动
./goreman run start etcd3
```

### 查询etcd集群成员列表
```shell
$ ../etcd-v3.5.2-linux-amd64/etcdctl --endpoints=http://127.0.0.1:12379 member list

# 或指定多个节点地址（若有节点宕机，则自动尝试连接其他可用节点）
$ ../etcd-v3.5.2-linux-amd64/etcdctl --endpoints=http://127.0.0.1:12379,http://127.0.0.1:22379 member list
```
