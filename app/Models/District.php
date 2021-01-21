<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class District
 * 
 * @property int $District_ID
 * @property string $District_name
 * @property int $Region_Region_ID
 * 
 * @property \App\Models\Region $region
 * @property \Illuminate\Database\Eloquent\Collection $facilities
 *
 * @package App\Models
 */
class District extends Eloquent
{
	protected $primaryKey = 'District_ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'District_ID' => 'int',
		'Region_Region_ID' => 'int'
	];

	protected $fillable = [
		'District_name',
		'Region_Region_ID'
	];

	public function region()
	{
		return $this->belongsTo(\App\Models\Region::class, 'Region_Region_ID');
	}

	public function facilities()
	{
		return $this->hasMany(\App\Models\Facility::class, 'Districts_District_ID');
	}
}
