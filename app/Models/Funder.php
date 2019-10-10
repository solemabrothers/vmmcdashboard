<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Funder
 * 
 * @property int $Funder_ID
 * @property string $Funder_name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $circumscissions
 * @property \Illuminate\Database\Eloquent\Collection $implementing_partners
 *
 * @package App\Models
 */
class Funder extends Eloquent
{
	protected $table = 'funder';
	protected $primaryKey = 'Funder_ID';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Funder_ID' => 'int'
	];

	protected $fillable = [
		'Funder_name'
	];

	public function circumscissions()
	{
		return $this->hasMany(\App\Models\Circumscission::class, 'Funder');
	}

	public function implementing_partners()
	{
		return $this->hasMany(\App\Models\ImplementingPartner::class, 'Funder_IP_ID');
	}
}
