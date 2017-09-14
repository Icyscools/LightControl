<!DOCTYPE HTML>
<head>
	<title> Light Controller </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Include css file -->
	<link rel="stylesheet" type="text/css" href="styles.css">

</head>
<style>
 	.menu {
 		float: left;
 	}

 	.describe {
 		float: right;
 	}

 	.btn1, .btn2, .btn3, .btn4, .btn5, .btn6 {
 		cursor: pointer;
	}

 	#load {
 		width: 60px;
 		height: 60px;

 		animation: spin 2s linear 0s infinite normal;
 	}

 	@-moz-keyframes spin {
	    from { -moz-transform: rotate(0deg); }
	    to { -moz-transform: rotate(360deg); }
	}
	@-webkit-keyframes spin {
	    from { -webkit-transform: rotate(0deg); }
	    to { -webkit-transform: rotate(360deg); }
	}
	@keyframes spin {
	    from {transform:rotate(0deg);}
	    to {transform:rotate(360deg);}
	}

 </style>
<body>
	<div class="wrapper" id="wrapper" onclick="closeSelection()"></div>

	<div class="menu">
		<div class="nav-container">
			<div class="selection" id="select">
				<button class="btn1 btn-link" id="name--1" onclick="toggleOnNavbar(1);"></button> <br>
				<button class="btn2 btn-link" id="name--2" onclick="toggleOnNavbar(2);"></button> <br>
				<button class="btn3 btn-link" id="name--3" onclick="toggleOnNavbar(3);"></button> <br>
				<button class="btn4 btn-link" id="name--4" onclick="toggleOnNavbar(4);"></button> <br>
				<button class="btn5 btn-link" id="name--5" onclick="toggleOnNavbar(5);"></button> <br>
				<button class="btn6 btn-link" id="name--6" onclick="toggleOnNavbar(6);"></button> <br>
			</div>
			<div class="nav-list-menu">
				<button class="icon-menu btn-list-link" onclick="showedSelection()">
					<span style="font-size: 5vh; padding-top: 2.75vh"> ≡ </span>
				</button>
			</div>
			<div class="subject-name">Light controller</div>
		</div>
	</div>

	<div class="content">
		<div class="describe-box" id="room">
			<div id="success">
				<div class="text">
					Room name: <span id="r-name"></span> <br>
					Current state: <span id="r-state"></span>
				</div>
				<div class="switch" style="padding-top: 3.775vh;">
					<button class="btn-light" id="btn-switch-open" onclick="sendDataToDatabase(1)">Turn on</button>
					<button class="btn-light" id="btn-switch-close" onclick="sendDataToDatabase(2)">Turn off</button>
				</div>
			</div>
			<div id="failed" style="display:none">
				<span id="reason">Can't connect to server</span>
			</div>
		</div>
	</div>

	<div class="footer">
		<div class="footer-container" style="margin:0 auto;font-size:2.2vmin;letter-spacing: 0.2vmin">
			<div style="float:left;padding-left:2vw">
				<div style="margin-top:1.5vh;font-size: 0.85em">จัดทำโดย
					<ul style="margin:0;padding-left:2.25vw;font-size: 0.82em">
						<li><span title="Web Developer">นายวรเมธ งามขำ</span></li>
						<li><span title="Electronics Engineer">นายศุภัช ตั้งสุณาวรรณ</span></li>
						<li><span title="Architect">น.ส.พิชญ์สินี ตันไพบูลย์</span></li>
					</ul>
				</div>
			</div>
			<div style="float:right;padding-right:2vw">
				<div style="padding-top:3.75vh;font-size:0.875em;">
					โครงงานระบบเปิด-ปิดเครื่องใช้ไฟฟ้า<br>
					ผ่านระบบอินเตอร์เน็ต
				</div>
			</div>
		</div>
	</div>

	<!-- Jquery -->
	<script src="core/jquery-3.2.1.min.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="core/bootstrap/js/bootstrap.min.js"></script>
	<script src="script.js"></script>

</body>