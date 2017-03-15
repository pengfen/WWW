<?php
header("Content-type:text/html;charset=utf-8");

/**
    PHP �в��� JSON ����Ҫ����

    ʲô��������͹�������
    $array_1 = array( 'name', 'age' );
    $array_2 = array( 1=>'name', 2=>'age' );

    json_encode() String json_encode(mixed $value [, int $options = 0]); ���� value ֵ�� JSON ��ʽ
    json_decode() mixed json_decode( string $json [, bool $assoc]);
    Ĭ��һ�� JSON ��ʽ���ַ������Ұ���ת��Ϊ PHP ����

    �������鶨��
    $array_1 = array( 'name', 'age');
    �������� ["name","age"] ����

    �ز����鶨��
    $array_2 = array(1=>'name', 2=>'age');
    �������� {"1":"name", "2":"age"} ����
*/
function createHtmlTag($tag = "") {
    echo "<h1>$tag</h1><br/>";
}

createHtmlTag("Hello");

createHtmlTag("JSON和serialize 对比");

$member = array("username","age");

var_dump($member);

$jsonObj = json_encode($member);

$serializeObj = serialize($member);

createHtmlTag($jsonObj);

createHtmlTag($serializeObj);


$asocArray=array("username"=>"ericwolf");
createHtmlTag(var_dump($asocArray));