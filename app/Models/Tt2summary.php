<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tt2summary
 * 
 * @property int $IOD
 * @property int $FacilityType
 * @property \Carbon\Carbon $CallDate
 * @property \Carbon\Carbon $SummaryDate
 * @property int $FacilityContactPerson
 * @property int $NumberTT2Administered
 * @property int $NumberTT2Below13
 * @property int $NumberTT2Between13And49
 * @property int $NumberTT2Above49
 * @property int $NumberMildPain
 * @property int $Facility
 * @property int $NumberTT2Between13And25
 * @property int $NumberTT2Between26And29
 * @property int $NumberTT2Below10
 * @property int $NumberTT2Between10And14
 * @property int $NumberTT2Between15And19
 * @property int $NumberTT2Between20And24
 * @property int $NumberTT2Between26And30
 * @property int $NumberTT2Between31And34
 * @property int $NumberTT1Between35And39
 * @property int $NumberTT2Between40And44
 * @property int $NumberMildAEFI
 * @property int $NumberModerateAEFI
 * @property int $NumberSevereAEFI
 * @property int $Implementing_Partner
 * 
 * @property \App\Models\Facility $facility
 * @property \App\Models\ImplementingPartner $implementing_partner
 *
 * @package App\Models
 */
class Tt2summary extends Eloquent
{
	protected $table = 'tt2summary';
	protected $primaryKey = 'IOD';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'IOD' => 'int',
		'FacilityType' => 'int',
		'FacilityContactPerson' => 'int',
		'NumberTT2Administered' => 'int',
		'NumberTT2Below13' => 'int',
		'NumberTT2Between13And49' => 'int',
		'NumberTT2Above49' => 'int',
		'NumberMildPain' => 'int',
		'Facility' => 'int',
		'NumberTT2Between13And25' => 'int',
		'NumberTT2Between26And29' => 'int',
		'NumberTT2Below10' => 'int',
		'NumberTT2Between10And14' => 'int',
		'NumberTT2Between15And19' => 'int',
		'NumberTT2Between20And24' => 'int',
		'NumberTT2Between26And30' => 'int',
		'NumberTT2Between31And34' => 'int',
		'NumberTT1Between35And39' => 'int',
		'NumberTT2Between40And44' => 'int',
		'NumberMildAEFI' => 'int',
		'NumberModerateAEFI' => 'int',
		'NumberSevereAEFI' => 'int',
		'Implementing_Partner' => 'int'
	];

	protected $dates = [
		'CallDate',
		'SummaryDate'
	];

	protected $fillable = [
		'FacilityType',
		'CallDate',
		'SummaryDate',
		'FacilityContactPerson',
		'NumberTT2Administered',
		'NumberTT2Below13',
		'NumberTT2Between13And49',
		'NumberTT2Above49',
		'NumberMildPain',
		'Facility',
		'NumberTT2Between13And25',
		'NumberTT2Between26And29',
		'NumberTT2Below10',
		'NumberTT2Between10And14',
		'NumberTT2Between15And19',
		'NumberTT2Between20And24',
		'NumberTT2Between26And30',
		'NumberTT2Between31And34',
		'NumberTT1Between35And39',
		'NumberTT2Between40And44',
		'NumberMildAEFI',
		'NumberModerateAEFI',
		'NumberSevereAEFI',
		'Implementing_Partner'
	];

	public function facility()
	{
		return $this->belongsTo(\App\Models\Facility::class, 'Facility');
	}

	public function implementing_partner()
	{
		return $this->belongsTo(\App\Models\ImplementingPartner::class, 'Implementing_Partner');
	}
}
