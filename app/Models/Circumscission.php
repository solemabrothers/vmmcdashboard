<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 19 Jun 2018 10:36:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Circumscission
 * 
 * @property int $IOD
 * @property int $Funder
 * @property int $ImplementingPartner
 * @property \Carbon\Carbon $Call_Date
 * @property \Carbon\Carbon $Summary_Date
 * @property int $NumberCircumcised
 * @property int $NumberCircumcisedBelow13
 * @property int $NumberCircumcisedBetween13And49
 * @property int $NumberCircumcisedAbove49
 * @property int $NumberMildPain
 * @property int $NumberSeverePain
 * @property int $NumberMildExcessiveBleeding
 * @property int $NumberModerateExcessiveBleeding
 * @property int $NumberSevereExcessiveBleeding
 * @property int $NumberMildSwellingHaematoma
 * @property int $NumberModerateSwellingHaematoma
 * @property int $NumberSevereSwellingHaematoma
 * @property int $NumberMildAnaestheticRelatedEvent
 * @property int $NumberModerateAnaestheticRelatedEvent
 * @property int $NumberSevereAnaestheticRelatedEvent
 * @property int $NumberMildExcessiveSkinRemoved
 * @property int $NumberModerateExcessiveSkinRemoved
 * @property int $NumberSevereExcessiveSkinRemoved
 * @property int $NumberMildInfection
 * @property int $NumberModerateInfection
 * @property int $NumberSevereInfection
 * @property int $NumberMildDamageToPenis
 * @property int $NumberModerateDamageToPenis
 * @property int $NumberSevereDamageToPenis
 * @property int $NumberDied
 * @property int $AdminChallenges
 * @property int $LogisticsChallenges
 * @property int $MObilisationChallenges
 * @property int $OtherChallenges
 * @property int $NumberCircumcisedBetween13And25
 * @property int $NumberCircumcisedBetween26And29
 * @property int $NumberCircumcisedBelow10
 * @property int $NumberCircumcisedBetween10And14
 * @property int $NumberCircumcisedBetween15And19
 * @property int $NumberCircumcisedBetween20And24
 * @property int $NumberCircumcisedBetween26And30
 * @property int $NumberCircumcisedBetween31And34
 * @property int $NumberCircumcisedBetween35And39
 * @property int $NumberCircumcisedBetween40And44
 * @property int $Facility_Facility_ID
 * @property int $NumberDiviceType
 * @property int $NumberHIVPostive
 * @property int $NumberHIVNegative
 * @property int $NumberHIVPositive
 * 
 * @property \App\Models\Facility $facility
 * @property \App\Models\Funder $funder
 * @property \App\Models\ImplementingPartner $implementing_partner
 *
 * @package App\Models
 */
class Circumscission extends Eloquent
{
	protected $table = 'circumscission';
	public $incrementing = false;
	public $timestamps = false;
    protected $connection = 'sqlsrv';

	protected $casts = [
		'IOD' => 'int',
		'Funder' => 'int',
		'ImplementingPartner' => 'int',
		'NumberCircumcised' => 'int',
		'NumberCircumcisedBelow13' => 'int',
		'NumberCircumcisedBetween13And49' => 'int',
		'NumberCircumcisedAbove49' => 'int',
		'NumberMildPain' => 'int',
		'NumberSeverePain' => 'int',
		'NumberMildExcessiveBleeding' => 'int',
		'NumberModerateExcessiveBleeding' => 'int',
		'NumberSevereExcessiveBleeding' => 'int',
		'NumberMildSwellingHaematoma' => 'int',
		'NumberModerateSwellingHaematoma' => 'int',
		'NumberSevereSwellingHaematoma' => 'int',
		'NumberMildAnaestheticRelatedEvent' => 'int',
		'NumberModerateAnaestheticRelatedEvent' => 'int',
		'NumberSevereAnaestheticRelatedEvent' => 'int',
		'NumberMildExcessiveSkinRemoved' => 'int',
		'NumberModerateExcessiveSkinRemoved' => 'int',
		'NumberSevereExcessiveSkinRemoved' => 'int',
		'NumberMildInfection' => 'int',
		'NumberModerateInfection' => 'int',
		'NumberSevereInfection' => 'int',
		'NumberMildDamageToPenis' => 'int',
		'NumberModerateDamageToPenis' => 'int',
		'NumberSevereDamageToPenis' => 'int',
		'NumberDied' => 'int',
		'AdminChallenges' => 'int',
		'LogisticsChallenges' => 'int',
		'MObilisationChallenges' => 'int',
		'OtherChallenges' => 'int',
		'NumberCircumcisedBetween13And25' => 'int',
		'NumberCircumcisedBetween26And29' => 'int',
		'NumberCircumcisedBelow10' => 'int',
		'NumberCircumcisedBetween10And14' => 'int',
		'NumberCircumcisedBetween15And19' => 'int',
		'NumberCircumcisedBetween20And24' => 'int',
		'NumberCircumcisedBetween26And30' => 'int',
		'NumberCircumcisedBetween31And34' => 'int',
		'NumberCircumcisedBetween35And39' => 'int',
		'NumberCircumcisedBetween40And44' => 'int',
		'Facility_Facility_ID' => 'int',
		'NumberDiviceType' => 'int',
		'NumberHIVPostive' => 'int',
		'NumberHIVNegative' => 'int',
		'NumberHIVPositive' => 'int'
	];

	protected $dates = [
		'Call_Date',
		'Summary_Date'
	];

	protected $fillable = [
		'Funder',
		'ImplementingPartner',
		'Call_Date',
		'Summary_Date',
		'NumberCircumcised',
		'NumberCircumcisedBelow13',
		'NumberCircumcisedBetween13And49',
		'NumberCircumcisedAbove49',
		'NumberMildPain',
		'NumberSeverePain',
		'NumberMildExcessiveBleeding',
		'NumberModerateExcessiveBleeding',
		'NumberSevereExcessiveBleeding',
		'NumberMildSwellingHaematoma',
		'NumberModerateSwellingHaematoma',
		'NumberSevereSwellingHaematoma',
		'NumberMildAnaestheticRelatedEvent',
		'NumberModerateAnaestheticRelatedEvent',
		'NumberSevereAnaestheticRelatedEvent',
		'NumberMildExcessiveSkinRemoved',
		'NumberModerateExcessiveSkinRemoved',
		'NumberSevereExcessiveSkinRemoved',
		'NumberMildInfection',
		'NumberModerateInfection',
		'NumberSevereInfection',
		'NumberMildDamageToPenis',
		'NumberModerateDamageToPenis',
		'NumberSevereDamageToPenis',
		'NumberDied',
		'AdminChallenges',
		'LogisticsChallenges',
		'MObilisationChallenges',
		'OtherChallenges',
		'NumberCircumcisedBetween13And25',
		'NumberCircumcisedBetween26And29',
		'NumberCircumcisedBelow10',
		'NumberCircumcisedBetween10And14',
		'NumberCircumcisedBetween15And19',
		'NumberCircumcisedBetween20And24',
		'NumberCircumcisedBetween26And30',
		'NumberCircumcisedBetween31And34',
		'NumberCircumcisedBetween35And39',
		'NumberCircumcisedBetween40And44',
		'NumberDiviceType',
		'NumberHIVPostive',
		'NumberHIVNegative',
		'NumberHIVPositive'
	];

	public function facility()
	{
		return $this->belongsTo(\App\Models\Facility::class, 'Facility_Facility_ID');
	}

	public function funder()
	{
		return $this->belongsTo(\App\Models\Funder::class, 'Funder');
	}

	public function implementing_partner()
	{
		return $this->belongsTo(\App\Models\ImplementingPartner::class, 'ImplementingPartner');
	}
}
