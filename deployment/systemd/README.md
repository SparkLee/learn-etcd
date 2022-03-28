# 用systemd管理etcd集群

一、参考：
- [etcd-io/etcd/contrib/systemd](https://github.com/etcd-io/etcd/tree/v3.5.2/contrib/systemd)
- [etcd3 multi-node cluster](https://github.com/etcd-io/etcd/blob/v3.5.2/contrib/systemd/etcd3-multinode/README.md)

二、部署etcd systemd配置文件
```shell
$ sudo cp etcd1.service /usr/lib/systemd/system/
$ sudo cp etcd2.service /usr/lib/systemd/system/
$ sudo cp etcd3.service /usr/lib/systemd/system/
```

三、启动etcd集群
```shell
$ sudo systemctl daemon-reload
$ sudo systemctl enable etcd1.service etcd2.service etcd3.service
$ sudo systemctl start etcd1.service etcd2.service etcd3.service
```

四、查看etcd进程
```shell
$ ps -ef|grep etcd
```

五、查看etcd服务状态/日志
```shell
# 查看服务状态
$ sudo systemctl status etcd1

# -l --full: Don't ellipsize unit names on output
#    --no-pager: Do not pipe output into a pager
$ sudo systemctl status etcd1 -l --no-pager

# 查看日志(systemd的日志由journald管理)
# -u --unit=UNIT: Show logs from the specified unit
# -f --follow: Follow the journal
#    --no-pager: Do not pipe output into a pager
$ sudo journalctl -u etcd1 --no-pager|less
$ sudo journalctl -f -u etcd1
```