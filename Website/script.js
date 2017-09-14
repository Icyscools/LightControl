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


var selection_toggle;
var flag_switch_toggle = false;

/*
 *	Setting data to display
 *  (etc. room name)
 *
 */
window.onload = function startup() {
	$.ajax({
		url: "data.php",
		type: "POST",
		success: function(data) {
			var obj = jQuery.parseJSON(data);

			for(var i = 1; i <= 6; i++) {
				if(typeof(obj[i]['name']) != 'undefined' && obj[i]['name'] != null) {
					$('#name--'+i).empty();
					$('#name--'+i).append(obj[i]['name']);
				} else {
					continue;
				}
			}
		},
		error: function() {
			$('#reason').empty();
			$('#reason').append("Can't connect to server");
		}
	});
	

	setInterval(loadingDataFromDatabase, 500);   // 1000 = 1 second
}

/*
 * Toggle white line when click nav-link
 * width < 768px  : aside line
 * width >= 768px : underline
 *
 */
function toggleOnNavbar(id) {
	$('welcome').hide();
	if(typeof(selection_toggle) != 'undefined' && selection_toggle != null) {
		$('#name--' + selection_toggle).removeClass("toggle-nav");
	}

	$('#name--' + id).addClass("toggle-nav");
	selectRoom(id);

	selection_toggle = id;

	if(screen.width < 768) {
		closeSelection();
	}
}

/*
 * Setup data when click nav-link
 *
 */
function selectRoom(id) {
	if($('#room').hasClass("data-room"+selection_toggle)) {
		$('#room').removeClass("data-room"+selection_toggle);
	}
	
	$('#room').addClass("data-room"+id);

	loadingDataFromDatabase();
	flag_switch_toggle = true;
}

function closeSelection() {
	$('#select').removeClass("open");
	$('#wrapper').removeClass("open-selection");
	$('#content').removeClass("open-selection");
}

function showedSelection() {
	if($('#select').hasClass("open")) {
		$('#select').removeClass("open");
		$('#wrapper').removeClass("open-selection");
		$('#content').removeClass("open-selection");
	} else {
		$('#select').addClass("open");
		$('#wrapper').addClass("open-selection");
		$('#content').addClass("open-selection");
	}
}

function activedBtn(state) {
	if(state == 1) {
		$('#btn-switch-open').addClass("actived-btn");
		$('#btn-switch-close').removeClass("actived-btn");
	} else {
		$('#btn-switch-close').addClass("actived-btn");
		$('#btn-switch-open').removeClass("actived-btn");
	}
}

function loadingDataFromDatabase() {
	if(typeof(selection_toggle) != 'undefined' && selection_toggle != null && flag_switch_toggle !== true) {
		$.ajax({
			url: "data.php",
			type: "POST",
			success: function(data) {
				var obj = jQuery.parseJSON(data);

				$('#r-name').empty();
				$('#r-state').empty();

				$('#r-name').append($('#name--'+selection_toggle).text());
				if(obj[selection_toggle]['state'] == '1') {
					$('#r-state').append("On");

					$('#r-state').addClass("on");
					$('#r-state').removeClass("off");

					$('#btn-switch-open').addClass("actived-btn");
					$('#btn-switch-close').removeClass("actived-btn");
				} else {
					$('#r-state').append("Off");

					$('#r-state').addClass("off");
					$('#r-state').removeClass("on");

					$('#btn-switch-close').addClass("actived-btn");
					$('#btn-switch-open').removeClass("actived-btn");
				}
			},
			error: function() {
				$('#r-name').empty();
				$('#r-state').empty();
				$('#r-name').append("Error");
				$('#r-state').append("Error");
			}
		});
	} 
	
	flag_switch_toggle = false;
}

function sendDataToDatabase(state) {
	if (typeof(selection_toggle) != 'undefined' && selection_toggle != null && state != "") {
		if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    xmlhttp = new XMLHttpRequest();
		} else {
		    // code for IE6, IE5
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		       
		        loadingDataFromDatabase();
		        flag_switch_toggle = true;

		        console.log($('#name--'+selection_toggle).text() + " change to " + state);
		        activedBtn(state);
		    }
		};

		xmlhttp.open("GET","activate.php?id="+selection_toggle+"&state="+state,true);
		xmlhttp.send();
	}
}