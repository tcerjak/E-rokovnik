<?php 
function query($query)
{
	global $dbc;
	$run_query = mysqli_query($dbc, $query);
	return $run_query;
}

function query_r($query)
{
	global $dbc;
	$array_result = [];
	$run_query = mysqli_query($dbc, $query);
	if (mysqli_num_rows($run_query) != 0) 
	{
		while ($result = mysqli_fetch_array($run_query, MYSQLI_NUM)) {
			$array_result[] = $result;
		}
	}
	return $array_result;
}

function safe_insert($insert)
{
	global $dbc;
	$result = mysqli_real_escape_string($dbc, $insert);
	return $result;
}