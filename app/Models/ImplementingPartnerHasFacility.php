<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ImplementingPartnerHasFacility
 * 
 * @property int $Implementing_Partner_IP_ID
 * @property int $Facility_Facility_ID
 * 
 * @property \App\Models\Facility $facility
 * @property \App\Models\ImplementingPartner $implementing_partner
 *
 * @package App\Models
 */
class ImplementingPartnerHasFacility extends Eloquent
{
	protected $table = 'implementing_partner_has_facility';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Implementing_Partner_IP_ID' => 'int',
		'Facility_Facility_ID' => 'int'
	];

	public function facility()
	{
		return $this->belongsTo(\App\Models\Facility::class, 'Facility_Facility_ID');
	}

	public function implementing_partner()
	{
		return $this->belongsTo(\App\Models\ImplementingPartner::class, 'Implementing_Partner_IP_ID');
	}
}
