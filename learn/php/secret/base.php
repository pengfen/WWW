<?php

/**
    Base64 编码加密技术

    base64_encode(string $data) 使用 base64 对 data 进行编码
    $data 要编码的数据

    base64_decode(string $data[, bool $strict=false]) 对使用 MIMI base64 编码的数据进行解码
    $strict 如果输入的数据超出了 base64 字母表 则返回 false
*/
    $data = "base编码";
    echo base64_encode($data);
    echo "<hr/>";

    echo base64_decode("");
    echo "<hr/>";

    <img src="data:image/jpeg;base64,base编码"/>
    <img src="data:;base64,base编码"/>
