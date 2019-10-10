<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Facility
 * 
 * @property int $Facility_ID
 * @property string $Facility_name
 * @property int $Districts_District_ID
 * 
 * @property \App\Models\District $district
 * @property \Illuminate\Database\Eloquent\Collection $circumscissions
 * @property \Illuminate\Database\Eloquent\Collection $implementing_partners
 * @property \Illuminate\Database\Eloquent\Collection $tt1summaries
 * @property \Illuminate\Database\Eloquent\Collection $tt2summaries
 *
 * @package App\Models
 */
class Facility extends Eloquent
{
	protected $table = 'facility';
	protected $primaryKey = 'Facility_ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Facility_ID' => 'int',
		'Districts_District_ID' => 'int'
	];

	protected $fillable = [
		'Facility_name',
		'Districts_District_ID'
	];

	public function district()
	{
		return $this->belongsTo(\App\Models\District::class, 'Districts_District_ID');
	}

	public function circumscissions()
	{
		return $this->hasMany(\App\Models\Circumscission::class, 'Facility_Facility_ID');
	}

	public function implementing_partners()
	{
		return $this->belongsToMany(\App\Models\ImplementingPartner::class, 'implementing_partner_has_facility', 'Facility_Facility_ID', 'Implementing_Partner_IP_ID');
	}

	public function tt1summaries()
	{
		return $this->hasMany(\App\Models\Tt1summary::class, 'Facility');
	}

	public function tt2summaries()
	{
		return $this->hasMany(\App\Models\Tt2summary::class, 'Facility');
	}
}
