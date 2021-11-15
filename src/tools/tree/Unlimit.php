<?php

namespace witchy\phptool\tree;

class Unlimit
{
    /**
     * (引用)获取树状数据
     *
     * @param array $data           数据源集合
     * @param integer $parent_id    父级id
     * @param string $p_key         父级ID key  默认p_id
     * @return array                返回多维数组
     */
    public function tree(&$data,  $parent_id = 0,  $p_key = 'p_id')
    {
        $return_data = array();
        foreach ($data as $key => $value) {
            if ($value[$p_key] == $parent_id) {
                // unset($data[$key]);
                if (!empty($this->tree($data, $value['id']))) {
                    $value['children'] = $this->tree($data, $value['id']);
                }
                $return_data[] = $value;
            }
        }
        return $return_data;
    }


    /**
     * (递归)获取指定结点的所有子级结点ID
     *
     * @param array $array  数据源集合
     * @param integer $id   结点id
     * @param string $p_key 父级ID key  默认p_id
     * @return array        一维数组
     */
    public function getAllChild($array,  $id = 0,  $p_key = 'p_id')
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
     * (递归)通过某个结点获取所有父级结点ID
     * @param array $data       数据集合
     * @param int $child_id     子id
     * @param array $p_key      父级ID key  默认p_id
     * @return array            一维数组
     */
    public function getParentByChild($data,  $child_id,  $p_key = 'p_id')
    {
        $arr = array();
        foreach ($data as $item) {
            if ($item['id'] == $child_id) {
                $arr[] = $item['id'];
                if ($item[$p_key] != 0) {
                    $arr = array_merge($arr, $this->getParentByChild($data, $item[$p_key]));
                }
            }
        }
        return $arr;
    }
}
