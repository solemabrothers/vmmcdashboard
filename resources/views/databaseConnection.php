<?php
echo '<p>Hello World First</p>';

$server = '196.43.147.249';

// Connect to MSSQL
$link = mssql_connect($server, "mets", "1234Smc*");
if (!$link) {
    die('Something went wrong while connecting to MSSQL');
}

else{

    echo "connected ";

    mssql_select_db('METS') or die("Wrong DATAbase");

    //mssql_query("SELECT Seq_no from dbo.Trans_R WHERE Seq_no = 000001",$link) or         die("cannot execute the query");

    $query = mssql_query("SELECT * from METS.dbo.Circumcision");

    $result = mssql_fetch_array($query);

    echo $result['Circumcision'];

}


?>