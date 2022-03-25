# 使用goreman管理本地etcd多实例集群

### 用goreman启动etcd集群
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

### 用goreman停止/启动单个实例（节点）
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
