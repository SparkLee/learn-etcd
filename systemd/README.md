# 用systemd管理etcd集群

一、参考：
- [etcd-io/etcd/contrib/systemd](https://github.com/etcd-io/etcd/tree/v3.5.2/contrib/systemd)
- [etcd3 multi-node cluster](https://github.com/etcd-io/etcd/blob/v3.5.2/contrib/systemd/etcd3-multinode/README.md)

二、部署etcd systemd配置文件
```shell
$ cp etcd1.service /usr/lib/systemd/system/
$ cp etcd2.service /usr/lib/systemd/system/
$ cp etcd3.service /usr/lib/systemd/system/
```

三、启动etcd集群
```shell
$ sudo systemctl daemon-reload
$ sudo systemctl enable etcd1.service etcd2.service etcd3.service
$ sudo systemctl start etcd1.service etcd2.service etcd3.service
```