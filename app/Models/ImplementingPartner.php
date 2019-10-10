<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ImplementingPartner
 * 
 * @property int $IP_ID
 * @property string $Implementing_Partner_name
 * @property int $Funder_IP_ID
 * 
 * @property \App\Models\Funder $funder
 * @property \Illuminate\Database\Eloquent\Collection $circumscissions
 * @property \Illuminate\Database\Eloquent\Collection $facilities
 * @property \Illuminate\Database\Eloquent\Collection $tt1summaries
 * @property \Illuminate\Database\Eloquent\Collection $tt2summaries
 *
 * @package App\Models
 */
class ImplementingPartner extends Eloquent
{
	protected $table = 'implementing_partner';
	protected $primaryKey = 'IP_ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IP_ID' => 'int',
		'Funder_IP_ID' => 'int'
	];

	protected $fillable = [
		'Implementing_Partner_name',
		'Funder_IP_ID'
	];

	public function funder()
	{
		return $this->belongsTo(\App\Models\Funder::class, 'Funder_IP_ID');
	}

	public function circumscissions()
	{
		return $this->hasMany(\App\Models\Circumscission::class, 'ImplementingPartner');
	}

	public function facilities()
	{
		return $this->belongsToMany(\App\Models\Facility::class, 'implementing_partner_has_facility', 'Implementing_Partner_IP_ID', 'Facility_Facility_ID');
	}

	public function tt1summaries()
	{
		return $this->hasMany(\App\Models\Tt1summary::class, 'Implementing_Partner');
	}

	public function tt2summaries()
	{
		return $this->hasMany(\App\Models\Tt2summary::class, 'Implementing_Partner');
	}
}
