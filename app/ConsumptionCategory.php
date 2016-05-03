<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ConsumptionCategory
 *
 * @property integer $id 消费类型编号
 * @property string $name 消费类型名称（可以自行填充）
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumptionCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumptionCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumptionCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsumptionCategory whereUpdatedAt($value)
 */
class ConsumptionCategory extends Model {

	//

    protected $fillable = ['name'];
}
