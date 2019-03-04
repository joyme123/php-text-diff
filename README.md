php text diff的实现, 基于最长公共子序列, 时间复杂度是O(m*n),m,n分别为两个字符串的长度。

## 安装

`composer require joyme123/textdiff`

## 使用

```
<?php
require_once("vendor/autoload.php");

use TextDiff\TextDiff;

$textDiff = new TextDiff();
$diffResult = $textDiff->diff('ABCD', 'AEBF');    // array result

var_dump($diffResult);

echo $textDiff->diff('湖山秋景远，千色变其中', '湖光秋色', true);   // html result
```

**数组形式的diff结果**
```
array(6) {
  [0] =>
  array(2) {
    [0] =>
    string(1) "A"       // 值
    [1] =>
    string(1) "u"       // u是unchange,代表这个值没有改变
  }
  [1] =>
  array(2) {
    [0] =>
    string(1) "E"       
    [1] =>
    string(1) "a"       // a是append,代表这个值时候新增的
  }
  [2] =>
  array(2) {
    [0] =>
    string(1) "B"
    [1] =>
    string(1) "u"
  }
  [3] =>
  array(2) {
    [0] =>
    string(1) "C"
    [1] =>
    string(1) "d"       // d是delete,代表这个值是删除的
  }
  [4] =>
  array(2) {
    [0] =>
    string(1) "D"
    [1] =>
    string(1) "d"
  }
  [5] =>
  array(2) {
    [0] =>
    string(1) "F"
    [1] =>
    string(1) "a"
  }
}
```

**html的输出结果**
```
<span class="text-unchange">湖</span><S class="text-delete">山</S><B class="text-new">光</B><span class="text-unchange">秋</span><S class="text-delete">景</S><S class="text-delete">远</S><S class="text-delete">，</S><S class="text-delete">千</S><span class="text-unchange">色</span><S class="text-delete">变</S><S class="text-delete">其</S><S class="text-delete">中</S>
```

预览结果为:

![预览结果](html_preview.png)

**性能测试**

```
text A: 464个字符, text B: 447个字符

time：2.8289349079132
```

该算法的性能很差，时间复杂度是O(m*n)，因此尽量不要对长字符串进行diff。