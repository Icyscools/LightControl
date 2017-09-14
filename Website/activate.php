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

	if(empty($_GET['all'])) {

		$id = $_GET['id'];
		$state = $_GET['state'];

		$link = mysqli_connect("localhost", "root");
		mysqli_set_charset($link,'utf8');
		$sql = "use lightcontrol";
		$result = mysqli_query($link, $sql);

		if($state == 1) {
			$sql = "UPDATE light SET state=1 WHERE id=\"".$id."\"";
			echo $id." change state to on";
		} else {
			$sql = "UPDATE light SET state=0 WHERE id=\"".$id."\"";
			echo $id." change state to off";
		}

		$result = mysqli_query($link, $sql) or die("error!");

		mysqli_close($link);
	
	} else {
		$state = $_GET['all'];

		for($i = 1; $i <= 6; $i++) {
			$link = mysqli_connect("localhost", "root");
			mysqli_set_charset($link,'utf8');
			$sql = "use lightcontrol";
			$result = mysqli_query($link, $sql);

			if($state == 1) {
				$sql = "UPDATE light SET state=1 WHERE id=\"".$i."\"";
				echo $i." change state to on";
			} else {
				$sql = "UPDATE light SET state=0 WHERE id=\"".$i."\"";
				echo $i." change state to off";
			}

			$result = mysqli_query($link, $sql) or die("error!");

			mysqli_close($link);
		}
	}

	//header("location: http://$host/lightcontrol");
?>