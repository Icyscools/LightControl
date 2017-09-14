<?php
/*
	MIT License

	Copyright (c) 2017 Woramat Ngamkham

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all
	copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	SOFTWARE.
*/

	
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	$host  = $_SERVER['HTTP_HOST'];
	//$room_id = $_GET['rid'];
	$resultArray = array();

	$link = mysqli_connect("localhost", "root");
	mysqli_set_charset($link,'utf8');
	$sql = "use lightcontrol";
	$result = mysqli_query($link, $sql);

	if(false){
	} else {
		for($i = 1; $i <= 6; $i++) {
			$sql = "SELECT * FROM light WHERE id=".$i;
			$result = mysqli_query($link, $sql) or die(mysqli_error());
			
			$intNumField = mysqli_num_fields($result);

			while($obResult = mysqli_fetch_array($result)) {
				$id = $obResult['id'];
				$sequential = array("name" => $obResult['name'], "state" =>$obResult['state']);
				$arrCol[$i] = $sequential;
				$objName = mysqli_fetch_field($result);
			
				//$arrCol["name"] = $obResult['name'];
				//$arrCol["col"] = $obResult['state'];
			}
		}
		mysqli_close($link);
	}

	//update last time
	$date = new DateTime();
	$time = $date->format('Y-m-d H:i:s');

	$link = mysqli_connect("localhost", "root");
	mysqli_set_charset($link,'utf8');
	$sql = "use lightcontrol";
	$result = mysqli_query($link, $sql);
	$sql = "UPDATE update_time SET last_update=now() WHERE i=1";
	mysqli_close($link);

	$resultArray = array("1" => $arrCol['1'], "2" => $arrCol['2'], "3" => $arrCol['3'], "4" => $arrCol['4'], "5" => $arrCol['5'], "6" => $arrCol['6']);

	echo json_encode($resultArray);
?>