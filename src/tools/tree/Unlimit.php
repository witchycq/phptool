<?php
namespace witchy\phptool\tree;

class Unlimit
{
    /**
     * 获取分级关系 function
     *
     * @param [type] $data  数据源
     * @param integer $parentId 父级id
     * @return  array 返回数据
     */
    public function category(&$data, $parentId = 0)
    {
        $category = array();
        foreach ($data as $key => $value) {
            if ($value['pid'] == $parentId) {
                unset($data[$key]);
                $value['child'] = $this->category($data, $value['id']);
                $category[] = $value;
            }
        }
        return $category;
    }
}
