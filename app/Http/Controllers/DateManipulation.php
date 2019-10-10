<?php

namespace App\Http\Controllers;

use App\Models\Circumscission;
use App\Models\District;
use App\Models\Facility;
use Carbon\Carbon;
use Doctrine\DBAL\Driver\PDOConnection;
use Illuminate\Http\Request;
use DB;
use PDO;
use Illuminate\Database\SqlServerConnection;
use Doctrine\DBAL\Driver\SQLSrv;

use App\AnalysisGraphs;

class DateManipulation extends Controller
{
   public function index()
   {

       $servername ='196.43.147.249';
       $connectioninfo = array("Database"=>'METS',"UID"=>'mets',"PWD"=>'1234Smc*');

       $connection = sqlsrv_connect($servername,$connectioninfo);
       $pdo = new PDO('sqlsrv:Server=196.43.147.249;Database=METS','mets','1234Smc*');
       $sql = "SELECT * FROM METS.dbo.Circumcision";
       $stmt = $pdo->prepare($sql);
       $stmt->execute();

       $fp = fopen('D:/Projects/mets_vmmc/Documents/export.txt', 'w');
       while ($row = $stmt->fetch(PDO::FETCH_NUM)){
           fputcsv($fp, array_values($row));
       }
       fclose($fp);

    }
public function getMysqlData()
{
    $con = mysqli_connect('localhost','openmrs','openmrs','mets_vmmc');
    $sql = 'LOAD DATA INFILE "D:/Projects/mets_vmmc/Documents/export.txt"
      IGNORE INTO TABLE Circumcision   FIELDS TERMINATED by  \',\' OPTIONALLY ENCLOSED BY \'"\'  LINES TERMINATED BY \'\n\'
      (OID, FacilityType, Funder, ImplementingPartner,
      CallDate, SummaryDate, FacilityContactPerson, NerveCentreContact, NumberCircumcised, NumberCircumcisedBelow13,
       NumberCircumcisedBetween13And49, NumberCircumcisedAbove49, NumberMildPain, NumberModeratePain,
       NumberSeverePain,
        NumberMildExcessiveBleeding, NumberModerateExcessiveBleeding, NumberSevereExcessiveBleeding,
         NumberMildSwellingHaematoma, NumberModerateSwellingHaematoma, NumberSevereSwellingHaematoma,
         NumberMildAnaestheticRelatedEvent, NumberModerateAnaestheticRelatedEvent, NumberSevereAnaestheticRelatedEvent,
         NumberMildExcessiveSkinRemoved, NumberModerateExcessiveSkinRemoved, NumberSevereExcessiveSkinRemoved,
         NumberMildInfection, NumberModerateInfection, NumberSevereInfection, NumberMildDamageToPenis,
         NumberModerateDamageToPenis, NumberSevereDamageToPenis, NumberDied, AdminChallenges,
         MobilizationChallenges, LogisticChallenges, OtherChallenges, ChallengesSpecify, Facility, OptimisticLockField,
          NumberCircumcisedBetween13And25, NumberCircumcisedBetween26And49, NumberCircumcisedBelow10,
           NumberCircumcisedBetween10And14, NumberCircumcisedBetween15And19, NumberCircumcisedBetween20And24,
            NumberCircumcisedBetween25And29, NumberCircumcisedBetween30And34, NumberCircumcisedBetween35And39,
             NumberCircumcisedBetween40And44, NumberCircumcisedBetween45And49, NumberCircumcisedBetween50And54,
              NumberCircumcisedBetween55And59, NumberCircumcised60andabove, NumberSurgicalType, NumberDeviceType,
               NumberHIVNegative, NumberHIVPositive)
              ';
     $statement = mysqli_query($con,$sql)or die(mysqli_error($con));
    }

    public function insertdata()
    {
       try{
            $pdo = new PDO('sqlsrv:Server=196.43.147.249;Database=METS','mets','1234Smc*');
             $sql = "SELECT * FROM METS.dbo.Circumcision LIMIT 200 ";
             $stmt = $pdo->prepare($sql);
             $stmt->execute();

            $json_users = array();
            while ($row = $stmt->fetchObject()){
            $json_users[] = $row;
            }
       return $json_users;
        }
        catch(Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        
    }
}

