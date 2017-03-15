<?php

/**
    理解和使用 curl

    curl 的概念
         curl (client url library functions) 由 daniel stenberg 创建
         官方定义为 curl is a command line tool for transferring data with url syntax 即使用url 语法传输数据的命令行工具
    curl 的使用场景
         网页资源 ---> 编写网页爬虫
         webservice 数据接口资源 ---> 动态获取接口数据 比如天气 号码归属地等等
         FTP 服务器里面的文件资源 ---> 下载 FTP 服务器里面的文件
         其他资源 ---> 所有网络上的资源都可以用 curl 访问和下载到
    在 PHP 中使用 curl
    curl 实战

    确认 PHP 支持 cURL
    windows linux
    cmd php -i
    linus php -i | grep curl

    添加 cURL 支持

    php 中使用 cURL
    初始化 cURL curl_init()
    向服务器发送请求 curl_exec()
    接收服务器数据
    关闭cURL curl_close()
*/