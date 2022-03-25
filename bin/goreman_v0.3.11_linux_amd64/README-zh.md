# 使用goreman管理本地etcd多实例集群

### 用goreman启动etcd集群
```shell
$ goreman start
```

或指定配置文件：
> 若使用默认配置文件(Procfile)，则无需指定。
```shell
$ goreman -f Procfile start
```