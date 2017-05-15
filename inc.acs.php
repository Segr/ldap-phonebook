<?php
// For Parsec 2.5
function get_acs_location($user_id, $samname, $fname, $lname)
{
	$result = 0;
	
	$conn = odbc_connect("Driver={SQL Server};Address=192.168.0.1,1045;Network=DBMSSOCN;SERVER=192.168.0.1;DATABASE=ParsecDB;LANGUAGE=us_english", "sa", "parsec");
	if($conn)
	{
		$res = odbc_exec($conn, rpv("SELECT TOP 1 CAST(TranCode AS VARCHAR) FROM dbo.TransLog WHERE ((TranCode = 72) OR (TranCode = 73)) AND (TranUserID = #) ORDER BY TranDateTime DESC", $user_id));
		if($res)
		{
			$row = odbc_fetch_row($res);
			
			if(intval($row) == 72)
			{
				$result = 1;
			}

			odbc_free_result($res);
		}
		odbc_close($conn)
	}

	return $result;
}