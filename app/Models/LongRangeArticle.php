<?php
/**
 * Created by PhpStorm.
 * User: ALG
 * Date: 2019/3/7
 * Time: 18:28
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LongRangeArticle extends Model
{
    /*
     * 置操作表
     */
    protected $table = 'articles';

    /*
     * 置数据信息
     */
    protected $connection = 'mysql_data';

    /*
     * 全字段可写
     */
    protected $guarded = [];
}