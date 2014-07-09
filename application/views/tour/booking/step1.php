<script type="text/javascript">
$(document).ready(function()
{
	$(".view-map").fancybox();
	
	var dateoptions = {
			numberOfMonths : 2,
			minDate: 0
		};
	
	$("#departure-date").datepicker(dateoptions);
	
	$("#departure-date").change(function(){
		updatePanel();
		var date = $(this).val().split('/');
		var holiday_link = "<?=site_url().'vietnam-holidays'?>" + "/" + date[2] ;
		$('#holiday_link').attr('href', holiday_link);
	});
	
	$("#classtype").change(function(){
		updatePanel();
	});
	
	$("#adults").change(function(){
		updatePanel();
	});
	
	$("#children").change(function(){
		updatePanel();
	});

	$("#infants").change(function(){
		updatePanel();
	});

	var options = [];
	$('input[type=checkbox]').on('change', function() {
		var className = $(this).attr('class');
	    if ($(this).is(':checked')) {
	    	console.log("check");
	    	$('.'+className).not(this).each(function(index, el) {
				$(this).prop('checked', false);
				var ind = options.indexOf($(this).val());
				if(ind != -1){
					options.splice(ind,1);		
				}
			});
	    	options.push($(this).val());
		    $("#options").val(options.toString());
		    console.log($("#options").val());
	    } else{
	    	var index = options.indexOf($(this).val());
	    	options.splice(index,1);
	    	$("#options").val(options.toString());
	    }

	    updatePanel();
	});


	$('input[name=tour_option]').on('change', function() {
	    
	});

	$(".confirm-btn").click(function(){
		var err = 0;

		var totalEntry = parseInt($('#adults').val()) + parseInt($('#children').val()) + parseInt($('#infants').val());
		
		for (var i=0; i<totalEntry; i++) {
			if ($("#fullname_"+i).val() == "") {
				$("#fullname_"+i).addClass("error");
				err++;
			} else {
				$("#fullname_"+i).removeClass("error");
			}
			if ($("#birthdate_"+i).val() == "") {
				$("#birthdate_"+i).addClass("error");
				err++;
			} else {
				$("#birthdate_"+i).removeClass("error");
			}
		}
		
		if ($("#fullname").val() == "") {
			$("#fullname").addClass("error");
			err++;
		} else {
			$("#fullname").removeClass("error");
		}
		if ($("#email").val() == "" || !isEmail($("#email").val())) {
			$("#email").addClass("error");
			err++;
		} else {
			$("#email").removeClass("error");
		}
		if ($("#phone").val() == "") {
			$("#phone").addClass("error");
			err++;
		} else {
			$("#phone").removeClass("error");
		}
		
		if (err == 0) {
			return true;
		}
		else {
			msgbox("Please fill-in all required fields(<span class='required'>*</span>) marked in red.");
			return false;
		}
	});

	initPanel();
	
	updatePanel();
});

function initPanel()
{
	var $content	= $(".booking-content");
	var $panel		= $("#booking-summary-panel");
	var $window		= $(window);
	var offset		= $panel.offset();

	$window.scroll(function() {
		if ($window.scrollTop() > offset.top) {
			$panel.css({
	            marginTop: Math.min($window.scrollTop() - offset.top, $content.height() - $panel.height())
	        });
	    } else {
	    	$panel.css({
	    		marginTop: 0
	        });
	    }
	});
}

function updatePanel()
{
	calEntries();
	calFees();
}

function calEntries()
{
	var totalEntry = parseInt($('#adults').val()) + parseInt($('#children').val()) + parseInt($('#infants').val());
	var firstEntryHtml = $(".traveler_0").html();
	var child = $(".tbtraveler tr").length;
	if (child > totalEntry) {
		$(".tbtraveler tr").slice(totalEntry+1).remove();
	} else {
		for (var i=(child-1); i<totalEntry; i++) {
			var newEntry = firstEntryHtml.replace(/_0/g, "_"+i);
			$(".tbtraveler").append("<tr class='traveler_"+i+"'>"+newEntry+"</tr>");
			$(".travelernumber_"+i).html(i+1);
			if (i%2) {
				$(".traveler_"+i).addClass("even");
			}
		}
	}

	var dateoptions = {
			dateFormat : 'mm/dd/yy',
			changeMonth: true,
		    changeYear: true,
			yearRange: '1900:+0'
		};

	for (i=0; i<totalEntry; i++) {
		$("#birthdate_"+i).removeClass('hasDatepicker').datepicker(dateoptions);
		$("#supplement_"+i).unbind("change").change(function(){
			updatePanel();
		});
	}
}

function calFees()
{
	var p = {};
	p['tour_id']		= $('#tour_id').val();
	p['departure_id']	= $('#departure_id').val();
	p['departure_date'] = $("#departure-date").val();
	p['classtype']		= $('#classtype').val();
    p['adults']			= $('#adults').val();
    p['children']		= $('#children').val();
    p['infants']		= $('#infants').val();
    p['supplements']	= $("input:checkbox[class=supplement]:checked").length;
    p['tour_option']	= $("#options").val();

	
    $('.totalfee').html("...");

	$.ajax({
		type: "POST",
		url: "<?=BASE_URL_HTTPS.'/tours/cal-fees'?>",
		data: p,
		dataType: 'json',
		cache: false,
		success: function(result) {
			var adults		= $('#adults').val();
			var children	= $('#children').val();
			var infants		= $('#infants').val();
			var classtype	= $('#classtype').val();
			var supplement	= $("input:checkbox[class=supplement]:checked").length;
			var fee			= result[0];
			var suppl_fee	= result[1];
			var total_fee	= (fee * adults) + Math.round(fee * children * 0.7) + (suppl_fee * supplement);
			
			$('.classtype-txt').html(classtype);
			$('.adultnote').html(adults+" x $"+formatNumber(fee,0));
			$('.adultfee').html("$"+formatNumber(fee*adults,2));
			$('.childrennote').html(children+" x $"+formatNumber(Math.round(fee*0.7),0));
			$('.childrenfee').html("$"+formatNumber(Math.round(fee*0.7*children),2));
			$('.infantnote').html(infants+" x $0");
			$('.supplnote').html((supplement+" x $"+formatNumber(suppl_fee,0)));
			$('.supplfee').html("$"+formatNumber(suppl_fee*supplement,2));
			$('.totalfee').html("$"+formatNumber(total_fee,2));
		},
		async:false
	});

    var daily = '<?=($item->daily)?1:0?>';
    if (daily == '1') {
        departure_date = $("#departure-date").val();
        arr_departure_date = departure_date.split("/");
        $(".departure-date-txt").html(departure_date);
        if (arr_departure_date.length == 3) {
            var date = new Date(arr_departure_date[2], arr_departure_date[0], arr_departure_date[1]);
            date = addDays(date, parseInt('<?=($item->duration-1)?>'));
			$(".return-date-txt").html(formatDateString(date));
		} else {
			$(".return-date-txt").html("");
		}
    }
}

function addDays(date, days) {
    var result = new Date(date);
    result.setDate(date.getDate() + days);
    return result;
}

function formatDateString(date) {
	return ('0' + date.getMonth()).slice(-2) + '/' + ('0' + date.getDate()).slice(-2) + '/' + date.getFullYear();
}
</script>

<div class="inner content-13x20">
	<div id="breadcrumbs">
		<a class="pathway" title="Home" href="<?=site_url("tours/vietnam")?>">Home</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="Vietnam Tours" href="<?=site_url("tours/search")?>">Vietnam Tours</a>
		<img alt="" src="<?=IMG_URL?>arrow.png">
		<a class="pathway" title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
		<img alt="" src="<?=IMG_URL?>arrow.png"> Booking
	</div>
	<h1 class="page-title">STEP 1: PLAN YOUR TRIP</h1>
	<div class="left" style="width: 680px">
		<form action="<?=PROTOCOL.$_SERVER['SERVER_NAME']."/tours/booking/review.html"?>" method="POST">
			<div id="booking">
				<div class="booking-content">
					<div class="planning-information">
						<div class="planning-information-content" style="padding-left: 0px">
							<div style="background-color: #F5F5F5">
								<div class="left">
									<div class="thumbnail">
										<a class="view-map" title="<?=$item->name?>" href="<?=$item->map?>"><img width="185px" src="<?=$item->map?>"></a>
									</div>
								</div>
								<div class="left">
									<div class="tour-information" style="width: 435px">
										<div class="tour-name">
											<a title="<?=$item->name?>" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")?>"><?=$item->name?></a>
										</div>
										<div class="sub-title"><?=$item->sub_title?></div>
										<ul class="tour-info">
											<li><b>Code:</b> <?=$item->code?></li>
											<li><b>Duration:</b> <?=($item->duration > 1) ? $item->duration." days - ".($item->duration-1)." nights" : $item->duration." day"?></li>
											<? if (!empty($booking->departure_id)) {
												$departure = $this->m_tour_departure->load($booking->departure_id);
											?>
											<li><b>Start:</b> <?=date('M d, Y', strtotime($departure->start))?></li>
											<li><b>Finish:</b> <?=date('M d, Y', strtotime($departure->finish))?></li>
											<? } ?>
										</ul>
										<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}")."#itinerary"?>">&raquo; Itinerary</a>
								    	</div>
								    	<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/vietnam/{$item->city_alias}/{$item->category_alias}/{$item->alias}/tripnote")?>">&raquo; Trip notes</a>
								    	</div>
								    	<div class="ref-link">
								    		<a title="" target="_blank" href="<?=site_url("tours/booking-conditions")?>">&raquo; Booking conditions</a>
								    	</div>
									</div>
								</div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
					
					<? if ($item->daily) {
							$rate_info = new stdClass();
							$rate_info->tour_id = $booking->tour_id;
							$rates = $this->m_tour_rate->getItems($rate_info, 1);
					?>
					<div class="planning-information">
						<div class="title">When do you want to travel?</div>
						<div class="planning-information-content">
							<label>Departure date <span class="required">*</span>:</label>
							<span class="calendar">
								<input type="text" id="departure-date" name="departure_date" class="calendar" value="<?=date('m/d/Y', strtotime($booking->departure_date))?>" alt="mm/dd/yyyy" placeholder="mm/dd/yyyy">
							</span>
						</div>
					</div>
					<div class="planning-information">
						<div class="title">Which travel type do you refer?</div>
						<div class="planning-information-content">
							<label>Tour class <span class="required">*</span>:</label>
							<select id="classtype" name="classtype" style="width: 150px">
								<?
									$ratenames = array();
									foreach ($rates as $rate) {
										if (!in_array($rate->name, $ratenames)) {
											$ratenames[] = $rate->name;
											?>
											<option value="<?=$rate->name?>"><?=$rate->name?></option>
											<?
										}
									}
								?>
							</select>
							<script>$("#classtype").val("<?=$booking->classtype?>");</script>
						</div>
					</div>
					<? } ?>
					<?
						$arrduration = array();
						$arrtype = array();
						$hassupplement = false;
						
						if ($item->daily) {
							foreach ($rates as $rate) {
								if ($rate->single_supplement) {
									$hassupplement = true;
								} else {
									if (!in_array($rate->group_size, $arrduration)) {
										$arrduration[$rate->group_size] = $rate->group_size;
									}
									if (!in_array($rate->name, $arrtype)) {
										$arrtype[$rate->name] = $rate->name;
									}
								}
							}
						} else {
							$hassupplement = (!empty($departure->supplement));
						}
						
						$arrduration_txt = array();
						$arrduration_key = array_keys($arrduration);
						$arrduration_len = sizeof($arrduration_key);
						for ($k=0; $k<$arrduration_len; $k++) {
							$curr = $arrduration_key[$k];
							$next = ((($k+1) < $arrduration_len) ? $arrduration_key[$k+1] : NULL);
							if (NULL == $next) {
								$arrduration_txt[$curr] = $curr." plus";
							}
							else if (($curr+1) < $next) {
								$arrduration_txt[$curr] = $curr."-".($next-1)." pax/s";
							} else {
								$arrduration_txt[$curr] = $curr.(($curr>1)?" pax/s":" pax");
							}
						}
					?>
					<div class="planning-information">
						<div class="title">How many traveller in your group?</div>
						<div class="planning-information-content">
							<div class="left">
								<label>Adults <span class="required">*</span>:</label>
								<select id="adults" name="adults">
									<? for ($i=1; $i <= 20; $i++) { ?>
									<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
								</select>
								<script>$("#adults").val("<?=$booking->adults?>");</script>
							</div>
							<div class="left" style="margin-left: 30px">
								<label>Children (5-10 yrs):</label>
								<select id="children" name="children">
									<? for ($i=0; $i <= 20; $i++) { ?>
									<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
								</select>
								<script>$("#children").val("<?=$booking->children?>");</script>
							</div>
							<div class="left" style="margin-left: 30px">
								<label>Infants (< 5 yrs):</label>
								<select id="infants" name="infants">
									<? for ($i=0; $i <= 20; $i++) { ?>
									<option value="<?=$i?>"><?=$i?></option>
									<? } ?>
								</select>
								<script>$("#infants").val("<?=$booking->infants?>");</script>
							</div>
							<div class="clr"></div>
							<div id="tour-view-detailed">
								<div class="tour-view-rates">
									<div class="con_pri_inc">
										<? if ($item->daily) { ?>
										<div class="pricetable" style="margin-top: 30px">
											<table width="100%" cellspacing="0" cellpadding="0" border="0">
												<tbody>
													<tr class="th">
														<td class="first">Group Size</td>
														<? foreach ($arrduration as $duration => $val) { ?>
														<td><?=$arrduration_txt[$val]?></td>
														<? } ?>
														<? if ($hassupplement) { ?>
														<td>Single Supp'</td>
														<? } ?>
													</tr>
													<tr>
														<?
															$irow = 0;
															foreach ($arrtype as $type => $valtype) {
																if ($irow++) {
																	echo '</tr><tr>';
																}
																echo '<td class="first">'.$valtype.'</td>';
																foreach ($arrduration as $duration => $valduration) {
																	$hasrate = 0;
																	foreach ($rates as $rate) {
																		if ($rate->name == $valtype && $rate->group_size == $valduration && !$rate->single_supplement) {
																			echo '<td>$'.number_format($rate->price,0,'.',',').'</td>';
																			$hasrate = 1;
																			break;
																		}
																	}
																	if (!$hasrate) {
																		echo '<td>-</td>';
																	}
																}
																if ($hassupplement) {
																	$hasrate = 0;
																	foreach ($rates as $rate) {
																		if ($rate->name == $valtype && $rate->single_supplement) {
																			echo '<td>+ $'.number_format($rate->price,0,'.',',').'</td>';
																			$hasrate = 1;
																			break;
																		}
																	}
																	if (!$hasrate) {
																		echo '<td>-</td>';
																	}
																}
															}
														?>
													</tr>
												</tbody>
											</table>
										</div>
										<? } ?>
										<ul class="price-type">
											<li><span>Children under 5 years old: free of charge</span></li>
											<li><span>Children from 5 to 10 years old: 70% of adult's rate</span></li>
											<li><span>Children above 10 years old: full adult's rate</span></li>
											<?if ($item->daily) :?>
											<li><span style="color:red">Note: 10% ~ 20% extra charge for all trip depart during <a id="holiday_link" target="blank" href="<?=site_url().'vietnam-holidays'?>">Vietnam National Holidays</a></span></li>
											<?endif?>
										</ul>
									</div>
									<div class="clr"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="planning-information">
						<div class="title">Traveller Information</div>
						<div class="planning-information-content">
							<table class="tbtraveler" width="100%" cellpadding="0" cellspacing="0">
								<thead>
									<tr>
										<th>
											No.
										</th>
										<th>
											Full name
										</th>
										<th>
											Gender
										</th>
										<th>
											Birth date
										</th>
										<th>
											Nationality
										</th>
										<? if ($hassupplement) { ?>
										<th>
											Supplement <img class="help" alt="" src="<?=IMG_URL?>tour/icon/info.png" title="Would you like to take your own room? <br/>You have to pay more for this case" rel="tooltip">
										</th>
										<? } ?>
									</tr>
								</thead>
								<tbody class="selected">
									<? for ($i = 0; $i < $booking->travelers; $i++) { ?>
									<tr class="traveler_<?=$i?> <?=(($i%2)?"even":"")?>">
										<td class="travelernumber_<?=$i?> center">
											<?=$i+1?>
										</td>
										<td>
											<input type="text" id="fullname_<?=$i?>" name="fullname_<?=$i?>" value="<?=(!empty($booking->paxs[$i]->fullname) ? $booking->paxs[$i]->fullname : '')?>" style="width: 120px">
										</td>
										<td>
											<select id="gender_<?=$i?>" name="gender_<?=$i?>" style="width: 80px">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
											<script>$("#gender_<?=$i?>").val("<?=(!empty($booking->paxs[$i]->gender) ? $booking->paxs[$i]->gender : '')?>");</script>
										</td>
										<td>
											<span class="calendar"><input type="text" id="birthdate_<?=$i?>" name="birthdate_<?=$i?>" class="birthdate" value="<?=(!empty($booking->paxs[$i]->birthdate) ? date('m/d/Y', strtotime($booking->paxs[$i]->birthdate)) : '')?>" placeholder="mm/dd/yyyy"></span>
										</td>
										<td>
											<select id="nationality_<?=$i?>" name="nationality_<?=$i?>" style="width: 150px">
												<? foreach ($nations as $nation) { ?>
													<option value="<?=$nation->name?>"><?=$nation->name?></option>
												<? } ?>
											</select>
											<script>$("#nationality_<?=$i?>").val("<?=(!empty($booking->paxs[$i]->nationality) ? $booking->paxs[$i]->nationality : '')?>");</script>
										</td>
										<? if ($hassupplement) { ?>
										<td class="center">
											<input type="checkbox" id="supplement_<?=$i?>" name="supplement_<?=$i?>" class="supplement">
										</td>
										<? } ?>
									</tr>
									<? } ?>
								</tbody>
							</table>
						</div>
					</div>

					<?$opt_categories = $this->m_tour_option_category->getItems()?>
					<?if ($this->m_tour_option->getItems($booking->tour_id)) :?>
					<div class='planning-information tour_options'>
						<div class='title'>Tour options</div>
						<?foreach($opt_categories as $cat) {
							$options = $this->m_tour_option->getItems($booking->tour_id, $cat->id);
							if ($options != NULL) {
								echo "<fieldset>";
								echo "<legend><span>{$cat->name}</span></legend>";
								foreach ($options as $option) {
									echo "<input type='checkbox' class='tour_option-{$cat->id}' name='tour_option' id='tour_option-{$option->id}' value='{$option->id}'><label for='tour_option-{$option->id}'>{$option->name}</label><br/>";
								}	
								echo "</fieldset>";
							}
						}?>
					</div>
					<?endif?>

					<div class="planning-information">
						<div>
							<div class="title">Your Contact Information</div>
							<div class="planning-information-content">
								<p>Who do we send a booking confirmation and receipt to?</p>
								<table class="tbl-contact-information">
									<tr>
										<td><label>Full Name <span class="required">*</span></label></td>
										<td>:</td>
										<td>
											<select id="title" name="title">
												<option <?php if($booking->title == 'Mr') echo 'selected' ?> value="Mr">Mr</option>
												<option <?php if($booking->title == 'Ms') echo 'selected' ?> value="Ms">Ms</option>
												<option <?php if($booking->title == 'Mrs') echo 'selected' ?> value="Mrs">Mrs</option>
											</select>
											<input type="text" name="fullname" id="fullname" value="<?=$booking->fullname?>">
										</td>
									</tr>
									<tr>
										<td><label>Email Address <span class="required">*</span></label></td><td>:</td>
										<td><input type="text" name="email" id="email" value="<?=$booking->email?>"></td>
									</tr>
									<tr>
										<td><label>Phone No. <span class="required">*</span></label></td><td>:</td>
										<td><input type="text" name="phone" id="phone" value="<?=$booking->phone?>"></td>
									</tr>
									<tr valign="top">
										<td style="vertical-align: top;"><label>Special Request</label></td><td style="vertical-align: top;">:</td>
										<td><textarea rows="6" cols="34" name="message"><?=$booking->message?></textarea></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="clr"></div>
					</div>
				</div>
				<div class="planning-button center">
					<input type="submit" class="button confirm-btn" value="CHECK OUT &raquo;" />
				</div>
			</div>
			<input type="hidden" name="tour_id" id="tour_id" value="<?=$booking->tour_id?>" />
			<input type="hidden" name="departure_id" id="departure_id" value="<?=$booking->departure_id?>" />
			<input type="hidden" name="options" id="options" value="" />
		</form>
	</div>
	<div class="right">
		<div id="booking-summary-panel">
			<div class="summary-panel-title">SUMMARY</div>
			<div class="summary-panel-detail">
				<? $l = 0; ?>
				<ul>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-tour-code">Tour code</div>
						<div class="right value"><?=$item->code?></div>
						<div class="clr"></div>
					</li>
					<li class="<?=(!$item->daily)?"none":""?> li-<?=(($l++)%2)?>">
						<div class="left i-class-type">Class type</div>
						<div class="right"><span class="value classtype-txt"></span></div>
						<div class="clr"></div>
					</li>
					<? if (!$item->daily) { $l++; } ?>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-departure-date">Start</div>
						<div class="right">
							<span class="value departure-date-txt">
							<? if (!$item->daily) {
								echo date('D, M d, Y', strtotime($booking->departure_date));
							} ?>
							</span>
						</div>
						<div class="clr"></div>
					</li>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-departure-date">Finish</div>
						<div class="right">
							<span class="value return-date-txt">
							<? if (!$item->daily) {
								echo date('D, M d, Y', strtotime($booking->departure_date." +".($item->duration-1)."days"));
							} ?>
							</span>
						</div>
						<div class="clr"></div>
					</li>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-adult" style="width: 100px">Adults</div>
						<div class="left"><span class="adultnote"></span></div>
						<div class="right"><span class="price adultfee"></span></div>
						<div class="clr"></div>
					</li>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-children" style="width: 100px">Children</div>
						<div class="left"><span class="childrennote"></span></div>
						<div class="right"><span class="price childrenfee"></span></div>
						<div class="clr"></div>
					</li>
					<li class="li-<?=(($l++)%2)?>">
						<div class="left i-infant" style="width: 100px">Infants</div>
						<div class="left"><span class="infantnote"></span></div>
						<div class="right"><span class="price infantfee">Free</span></div>
						<div class="clr"></div>
					</li>
					<li class="<?=(!$hassupplement)?"none":""?> li-<?=(($l++)%2)?>">
						<div class="left i-supplement" style="width: 100px">Supplements</div>
						<div class="left"><span class="supplnote"></span></div>
						<div class="right"><span class="price supplfee"></span></div>
						<div class="clr"></div>
					</li>
					<? if (!$hassupplement) { $l++; } ?>
					<li class="summary-panel-total li-<?=(($l++)%2)?>">
						<div class="left value">TOTAL</div>
						<div class="right"><span class="price red totalfee"></span></div>
						<div class="clr"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

