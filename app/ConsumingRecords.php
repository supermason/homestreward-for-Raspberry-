<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ConsumeRecords
 *
 * @property integer $id 消费编号
 * @property integer $category_id 消费类型编号
 * @property float $amount 消费金额
 * @property string $remark 备注
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumingRecords whereUpdatedAt($value)
 */
class ConsumingRecords extends Model {

    //
    protected $fillable = ['amount', 'category_id', 'remark', 'who', 'consumption_date'];

}
