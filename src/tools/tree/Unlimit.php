<?php

namespace witchy\phptool\tree;

class Unlimit
{
    /**
     * 获取树状数据 引用方式
     *
     * @param [type] $data  数据源
     * @param integer $parentId 父级id
     * @return  array 返回数据
     */
    public function tree(array &$data, int $parent_id = 0, string $p_key = 'pid')
    {
        $category = array();
        foreach ($data as $key => $value) {
            if ($value[$p_key] == $parent_id) {
                // unset($data[$key]);
                if (!empty($this->tree($data, $value['id']))) {
                    $value['child'] = $this->tree($data, $value['id']);
                }
                $category[] = $value;
            }
        }
        return $category;
    }


    /**
     * 获取指定结点的所有子级结点ID
     *
     * @param $array
     * @param $id
     * @return array
     */
    function getAllChild(array $array, int $id = 0, string $p_key = 'pid')
    {
        $arr = array();
        foreach ($array as $v) {
            if ($v[$p_key] == $id) {
                $arr[] = $v['id'];
                $arr = array_merge($arr, $this->getAllChild($array, $v['id']));
            };
        };
        return $arr;
    }


    /**
     * 通过某个结点获取所有父级结点ID
     * @param int $child_id 子id
     * @param array $pc_data 父子数据集合
     * @param array $p_key 父级key pid
     * @return array
     */
    function getParentByChild(int $child_id, array $data, int $p_key = 'pid')
    {
        $arr = array();
        foreach ($data as $item) {
            if ($item['id'] == $child_id) {
                $arr[] = $item['id'];
                if ($item[$p_key] != 0) {
                    $arr = array_merge($arr, $this->getParentByChild($item[$p_key], $data));
                }
            }
        }
        return $arr;
    }
}
