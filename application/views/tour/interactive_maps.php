<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>site.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" media="screen,all" href="<?=CSS_URL?>tour.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
	<script type="text/javascript" src="<?=TPL_URL?>jquery/js/gmap3.js"></script>
	<style>
	      #container {
	        position:relative;
	        height:700px;
	      }
	      #googleMap {
	        border: 1px dashed #C0C0C0;
	        width: 75%;
	        height: 700px;
	      }
	      
	      /* cluster */
	      .cluster {
	      	color: #FFFFFF;
	      	text-align:center;
	      	font-family: Verdana;
	      	font-size:14px;
	      	font-weight:bold;
	      	text-shadow: 0 0 2px #000;
	        -moz-text-shadow: 0 0 2px #000;
	        -webkit-text-shadow: 0 0 2px #000;
	      }
	      .cluster-1 {
	        background: url(images/m1.png) no-repeat;
	        line-height:50px;
	      	width: 50px;
	      	height: 40px;
	      }
	      .cluster-2 {
	        background: url(images/m2.png) no-repeat;
	        line-height:53px;
	      	width: 60px;
	      	height: 48px;
	      }
	      .cluster-3 {
	        background: url(images/m3.png) no-repeat;
	        line-height:66px;
	      	width: 70px;
	      	height: 56px;
	      }
	      
	      /* infobulle */
	      .infobulle {
	        overflow: hidden; 
	        cursor: default; 
	        clear: both; 
	        position: relative; 
	        height: 34px; 
	        padding: 0pt; 
	        background-color: rgb(57, 57, 57);
	        border-radius: 4px 4px; 
	        -moz-border-radius: 4px 4px;
	        -webkit-border-radius: 4px 4px;
	        border: 1px solid #2C2C2C;
	      }
	      .infobulle .bg {
	        font-size:1px;
	        height:16px;
	        border:0px;
	        width:100%;
	        padding: 0px;
	        margin:0px;
	        background-color: #5E5E5E;
	      }
	      .infobulle .text {
	        color:#FFFFFF;
	        font-family: Verdana;
	        font-size:11px;
	        font-weight:bold;
	        line-height:25px;
	        padding:4px 20px;
	        text-shadow:0 -1px 0 #000000;
	        white-space: nowrap;
	        margin-top: -17px;
	      }
	      .infobulle.drive .text {
	        background: url(images/drive.png) no-repeat 2px center;
	        padding:4px 20px 4px 36px;
	      }
	      .arrow {
	        position: absolute; 
	        left: 45px; 
	        height: 0pt; 
	        width: 0pt; 
	        margin-left: 0pt; 
	        border-width: 10px 10px 0pt 0pt; 
	        border-color: #2C2C2C transparent transparent; 
	        border-style: solid;
	      }
	</style>
</head>
<body style="background: none">
	<div id="tour-request-form">
		<h1>Interactive Maps</h1>
		<p class="desc">
			A map of Vietnam can be very helpful for planning your Vietnam holiday. In addition to various Vietnam maps that provide information about particular destinations, explore the following interactive maps of Vietnam designed to help you plan your explorations of different destinations across the kingdom.
		</p>
		<script type="text/javascript">
			var cityList = [
				     			{lat:21.0333,lng:105.87,data:{drive:false,zip:70000,city:"Ha Noi"}},
				     			{lat:16.42,lng:107.6,data:{drive:false,zip:70000,city:"Hue"}},
				     			{lat:12.18,lng:109.2,data:{drive:false,zip:70000,city:"Nha Trang"}},
				     			{lat:10.8167,lng:106.645,data:{drive:false,zip:70000,city:"Ho Chi Minh"}}
			     			];
        
			$(function() {
				$("#map").width("100%").height("360px").gmap3({
					map:{
						options:{
							center:[16, 105],
							zoom: 5,
							mapTypeId: google.maps.MapTypeId.TERRAIN
						}
					},
					marker: {
						values: cityList,
						cluster:{
							radius:100,
							// This style will be used for clusters with more than 0 markers
							0: {
									content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
									width: 53,
									height: 52
								},
							// This style will be used for clusters with more than 20 markers
							20: {
									content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
									width: 56,
									height: 55
								},
							// This style will be used for clusters with more than 50 markers
							50: {
									content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
									width: 66,
									height: 65
								},
							events: {
								click: function(cluster) {
									var map = $(this).gmap3("get");
									map.setCenter(cluster.main.getPosition());
									map.setZoom(map.getZoom() + 1);
								}
							}
						},
						options: {
							icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
						},
						events:{
							mouseover: function(marker, event, context){
								$(this).gmap3(
									{clear:"overlay"},
									{
										overlay:{
											latLng: marker.getPosition(),
											options:{
												content:  "<div class='infobulle"+(context.data.drive ? " drive" : "")+"'>" +
															"<div class='bg'></div>" +
															"<div class='text'>" + context.data.city + " (" + context.data.zip + ")</div>" +
															"</div>" +
															"<div class='arrow'></div>",
												offset: {
													x:-46,
													y:-73
												}
											}
										}
									});
							},
							mouseout: function(){
								$(this).gmap3({clear:"overlay"});
							}
						}
					}
				});
			});
		</script>
		<div id="map" class="googlemap"></div>
	</div>
</body>
</html>