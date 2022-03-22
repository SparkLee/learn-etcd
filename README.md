# learn-etcd
etcd学习项目

# etcd 安装

下载解压，运行二进制命令即可！

[etcd 官方安装文档](https://etcd.io/docs/v3.5/install/)

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