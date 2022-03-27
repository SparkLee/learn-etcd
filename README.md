# learn-etcd
etcd学习项目

# etcd 安装

下载解压，运行二进制命令即可！

- [etcd 官方安装文档](https://etcd.io/docs/v3.5/install/)

# etcd 基础使用

一、etcd 服务器启动

linux：
```shell
$ chmod +x ./bin/etcd-v3.5.2-linux-amd64/etcd
$ ./bin/etcd-v3.5.2-linux-amd64/etcd
```

windows：
```shell
$ bin\etcd-v3.5.2-windows-amd64\etcd.exe
```

二、etcd 客户端连接

linux：
```shell
$ chmod +x ./bin/etcd-v3.5.2-linux-amd64/etcdctl
$ ./bin/etcd-v3.5.2-linux-amd64/etcdctl version
```

windows：
```shell
$ bin\etcd-v3.5.2-windows-amd64\etcdctl.exe version
```

三、etcd 管理客户端连接

linux：
```shell
$ chmod +x ./bin/etcd-v3.5.2-linux-amd64/etcdutl
$ ./bin/etcd-v3.5.2-linux-amd64/etcdutl version
```

windows：
```shell
$ bin\etcd-v3.5.2-windows-amd64\etcdutl.exe version
```

# etcd 数据持久化

不指定数据目录(data-dir)的情况下，etcd 默认在当前目录下创建 default.etcd 目录并将其做为etcd的数据目录
```shell
$ ll default.etcd
```

# etcd Key-value 命令

- [Key-value commands](bin/etcd-v3.5.2-linux-amd64/README-etcdctl.md)

一、KV CRUD（增查改删）命令
```shell
$ cd bin/etcd-v3.5.2-linux-amd64/

# 增
$ ./etcdctl put name "李 威"

# 查
$ ./etcdctl get name

# 改
$ ./etcdctl put name SparkLee

# 删
$ ./etcdctl del name
```

# 使用goreman管理本地etcd多实例集群
[使用goreman管理本地etcd多实例集群](bin/goreman_v0.3.11_linux_amd64/README-zh.md)

# 用systemd管理etcd集群
[用systemd管理etcd集群](systemd/README.md)