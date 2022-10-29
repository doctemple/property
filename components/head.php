<!DOCTYPE html>
<html lang="en">
<head>
    <title>iCare by SP Computer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-transform" >
    <meta http-equiv="Cache-Control" content="no-siteapp" >
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" >
    <meta name="renderer" content="webkit" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="viewport-fit=cover, user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="shortcut icon" href="./favicon.svg" type="image/x-icon">
    <link rel="icon" href="./favicon.svg" type="image/x-icon">

  
    <meta http-equiv="Pragma" content="no-cache" >
    <meta http-equiv="Expires" content="0" >


    <link rel="stylesheet" type="text/css" href="css/bootstrap-4.3.1.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css?key=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/timepicker.css">
    <link rel="stylesheet" href="css/icheck-bootstrap.min.css" />
    <script type="text/javascript" src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-4.3.1.min.js"></script>
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.js"></script>
    <script type="text/javascript" src="js/timepicker.js"></script>
    <script type="text/javascript" src="js/chart.js/Chart.js"></script>
    <script type="text/javascript" src="js/add.js"></script>
    <script type="text/javascript" src="js/tickets.js"></script>
    <script type="text/javascript" src="js/wat.js"></script>
    <script type="text/javascript" src="js/qrcode.js"></script>
    <script type="text/javascript" src="js/JsBarcode.all.min.js"></script>
    <script type="text/javascript" src="js/jSignature.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

    <script type="text/javascript">
		(function(document,navigator,standalone) {
			// prevents links from apps from oppening in mobile safari
			// this javascript must be the first script in your <head>
			if ((standalone in navigator) && navigator[standalone]) {
				var curnode, location=document.location, stop=/^(a|html)$/i;
				document.addEventListener('click', function(e) {
					curnode=e.target;
					while (!(stop).test(curnode.nodeName)) {
						curnode=curnode.parentNode;
					}
					// Condidions to do this only on links to your own app
					// if you want all links, use if('href' in curnode) instead.
					if(
						'href' in curnode && // is a link
						(chref=curnode.href).replace(location.href,'').indexOf('#') && // is not an anchor
						(	!(/^[a-z\+\.\-]+:/i).test(chref) ||                       // either does not have a proper scheme (relative links)
							chref.indexOf(location.protocol+'//'+location.host)===0 ) // or is in the same protocol and domain
					) {
						e.preventDefault();
						location.href = curnode.href;
					}
				},false);
			}
		})(document,window.navigator,'standalone');
	</script>
    
</head>
<body ng-app="myApp" ng-controller="myCtrl">
<div id="debug" class="box collapse bg-dark text-success" style="width:99%; position:absolute; top:6vh;  z-index:5;"> 
        <div class="row">
            <div class="col"><strong>SESSION</strong><br><?php echo nl2br(print_r($_SESSION,'r')); ?></div>
            <div class="col"><strong>REQUEST</strong><br><?php echo nl2br(print_r($_REQUEST,'r')); ?></div>
        </div>
</div>