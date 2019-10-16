<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Region
 * 
 * @property int $Region_ID
 * @property string $Region_name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $districts
 *
 * @package App\Models
 */
class Region extends Eloquent
{
	protected $table = 'region';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Region_ID' => 'int'
	];

	public function districts()
	{
		return $this->hasMany(\App\Models\District::class, 'Region_Region_ID');
	}
}
