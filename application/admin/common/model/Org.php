<?php
/**
 * 机构表模型
 */

namespace app\admin\common\model;


use think\Model;



class Org extends Model
{
    // 定义主键和数据表
    protected $pk = 'id';
    protected $table = 'think_org';

    // 定义自动时间戳和数据格式
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';


}