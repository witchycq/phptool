## php常用工具包

###1. 无限极分类 
```
use witchy\phptool\tree\Unlimit;

...
/**
 * 获取指定结点的树状数据(多维数组)
 */
$obj = new Unlimit();
$getAllChild_result = $obj->getAllChild($data);

/**
 * 获取指定结点的所有子节点 包含自己
 */
$getAllChild_result = $obj->getAllChild($data, 1);

/**
 * 获取指定结点的所有父节点 包含自己
 */
$getParentByChild_result = $obj->getParentByChild($data, 6);

/**
 * 获取指定结点的一级结点数据
 */
$one = $obj->getOne($data, 1);

```

###2. 测试用例
定位到和vender同级的目录

 ./vendor/bin/phpunit tests/TreeTest.php
