<?php
$this->load->model('m_flight');
$leaving_from = $this->m_flight->getAirport($search->leavingFrom);
$going_to = $this->m_flight->getAirport($search->goingTo);
?>

<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script>
<script type="text/javascript" src="<?= JS_URL ?>book.flight.select.js"></script>

<?php require_once(APPPATH . "views/module/flight/search_widget.php"); ?>
<div id="pagecontent">
    <div id="content">
        <div>
            <?php /*<div class="right icon-lowest-fare" tooltip="Lowest fares"></div>*/ ?>
            <div class="right icon-map" tooltip="Map">Flight map</div>
            <div class="clr"></div>
        </div>
        <div class="flight-map" style="display: none;">
            <div id="map-canvas" style="width: 100%; height: 500px; margin-bottom: 10px;"></div>
        </div>
        <form id="frmBooking" action="<?= site_url("flights/booking") ?>" method="POST">
            <div id="filters" class="none">
                <div class="filter-container">
                    <div class="filter-controls">
                        <div class="control-container left">
                            <div><span>Price</span></div>
                            <div class="pop-liner">
                                <div class="pop-mid">
                                    <div id="flight-rate"></div>
                                </div>
                            </div>
                        </div>
                        <div class="control-container left" style="margin-left: 55px">
                            <div><span>Outbound time</span></div>
                            <div class="pop-liner">
                                <div class="pop-mid">
                                    <div id="outbound-time" class="flight-duration"></div>
                                </div>
                            </div>
                        </div>
                        <div class="control-container right">
                            <div><span>Return time</span></div>
                            <div class="pop-liner">
                                <div class="pop-mid">
                                    <div id="return-time" class="flight-duration"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
            <div id="flight-carts">
                <div class="direct">
                    <div class="title">Outbound flight</div>
                    <div class="dest"><?= $this->util->getAirportCity($search->leavingFrom) ?> to <?= $this->util->getAirportCity($search->goingTo) ?></div>
                    <div class="time"><?= date('l, F d', strtotime($search->departDate)) ?></div>
                    <div class="clr"></div>
                </div>
                <div class="cart-header">
                    <div class="departure">Departure</div>
                    <div class="duration">Dur.</div>
                    <div class="arrival">Arrival</div>
                    <div class="airline">Airline</div>
                    <div class="flight">Flight</div>
                    <div class="stops">Stops</div>
                    <div class="price">Bussiness</div>
                    <div class="price">Economy</div>
                    <div class="price">SaverFlex</div>
                    <div class="clr"></div>
                </div>
                <? foreach($flights as $flight) {
                if ($flight->inout == "out") {
                ?>
                <div class="flight-cart" id="flight<?php echo $flight->id; ?>">
                    <div class="departure"><?= $flight->departTime ?></div>
                    <div class="duration"><div class="arrow"><span><?= $flight->duration ?></span></div></div>
                    <div class="arrival"><?= $flight->arrivalTime ?></div>
                    <div class="airline"><img title="<?= $flight->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <span><?= $flight->airline ?></span></div>
                    <div class="flight"><?= $flight->flightNumber ?></div>
                    <div class="stops"><?= ($flight->stops == 0) ? "Nonstop" : (($flight->stops > 1) ? $flight->stops . " stops" : $flight->stops . " stop") ?></div>
                    <div class="price">
                        <? if ($flight->business == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='departclass' id='".$flight->id."_business' value='".$flight->id."_business'>";
                        echo "<label for='".$flight->id."_business'>$".$flight->business."</label>";
                        }?>
                    </div>
                    <div class="price">
                        <? if ($flight->economy == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='departclass' id='".$flight->id."_economy' value='".$flight->id."_economy'>";
                        echo "<label for='".$flight->id."_economy'>$".$flight->economy."</label>";
                        }?>
                    </div>
                    <div class="price">
                        <? if ($flight->saverFlex == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='departclass' id='".$flight->id."_saverflex' value='".$flight->id."_saverflex'>";
                        echo "<label for='".$flight->id."_saverflex'>$".$flight->saverFlex."</label>";
                        }?>
                    </div>
                    <div class="clr"></div>
                    
                    <input class="id" type="hidden" value="<?php echo $flight->id; ?>" />
                    <input class="link" type="hidden" value="<?php echo site_url("flights/flight/" . $flight->id); ?>" />
                    <div class="show" style="display: none;"></div>
                </div>
                <? }
                } ?>
                <br>
                <div class="direct">
                    <div class="title">Return flight</div>
                    <div class="dest"><?= $this->util->getAirportCity($search->goingTo) ?> to <?= $this->util->getAirportCity($search->leavingFrom) ?></div>
                    <div class="time"><?= date('l, F d', strtotime($search->returnDate)) ?></div>
                    <div class="clr"></div>
                </div>
                <div class="cart-header">
                    <div class="departure">Departure</div>
                    <div class="duration">Dur.</div>
                    <div class="arrival">Arrival</div>
                    <div class="airline">Airline</div>
                    <div class="flight">Flight</div>
                    <div class="stops">Stops</div>
                    <div class="price">Bussiness</div>
                    <div class="price">Economy</div>
                    <div class="price">SaverFlex</div>
                    <div class="clr"></div>
                </div>
                <? foreach($flights as $flight) {
                if ($flight->inout == "in") {
                ?>
                <div class="flight-cart" id="flight<?php echo $flight->id; ?>">
                    <div class="departure"><?= $flight->departTime ?></div>
                    <div class="duration"><div class="arrow"><span><?= $flight->duration ?></span></div></div>
                    <div class="arrival"><?= $flight->arrivalTime ?></div>
                    <div class="airline"><img title="<?= $flight->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <span><?= $flight->airline ?></span></div>
                    <div class="flight"><?= $flight->flightNumber ?></div>
                    <div class="stops"><?= ($flight->stops == 0) ? "Nonstop" : (($flight->stops > 1) ? $flight->stops . " stops" : $flight->stops . " stop") ?></div>
                    <div class="price">
                        <? if ($flight->business == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='returnclass' id='".$flight->id."_business' value='".$flight->id."_business'>";
                        echo "<label for='".$flight->id."_business'>$".$flight->business."</label>";
                        }?>
                    </div>
                    <div class="price">
                        <? if ($flight->economy == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='returnclass' id='".$flight->id."_economy' value='".$flight->id."_economy'>";
                        echo "<label for='".$flight->id."_economy'>$".$flight->economy."</label>";
                        }?>
                    </div>
                    <div class="price">
                        <? if ($flight->saverFlex == "SOLD OUT") {
                        echo "SOLD OUT";
                        } else {
                        echo "<input type='radio' name='returnclass' id='".$flight->id."_saverflex' value='".$flight->id."_saverflex'>";
                        echo "<label for='".$flight->id."_saverflex'>$".$flight->saverFlex."</label>";
                        }?>
                    </div>
                    <div class="clr"></div>
                    
                    <input class="id" type="hidden" value="<?php echo $flight->id; ?>" />
                    <input class="link" type="hidden" value="<?php echo site_url("flights/flight/" . $flight->id . '/return'); ?>" />
                    <div class="show" style="display: none;"></div>
                </div>
                <? }
                } ?>
            </div>
            <div style="margin-top: 10px">
                <div class="left">
                    <div><a title="Baggage information" href="#">Baggage information</a></div>
                    <div><a title="Taxes and fees information" href="#">Taxes and fees information</a></div>
                </div>
                <div class="cart-button right">
                    <input type="submit" class="org-btn-large btn-next" value="Continue" />
                </div>
                <div class="clr"></div>
            </div>
        </form>
    </div>
    <div class="clr"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
    $(document).ready(function() {
        geoclient = new google.maps.Geocoder();
        geoclient.geocode({'address': '<?php echo $leaving_from->name; ?>'}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                $("#formLocationLat").val(results[0].geometry.location.lat());
                $("#formLocationLng").val(results[0].geometry.location.lng());
            }
        });
        geoclient.geocode({'address': '<?php echo $going_to->name; ?>'}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                $("#toLocationLat").val(results[0].geometry.location.lat());
                $("#toLocationLng").val(results[0].geometry.location.lng());
            }
        });
    });
    function initialize() {
        var mapOptions = {
            zoom: 6,
            center: new google.maps.LatLng(16.059671,108.213902),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var latLngs = [];
        latLngs.push(new google.maps.LatLng( $("#formLocationLat").val(), $("#formLocationLng").val()));
        latLngs.push(new google.maps.LatLng( $("#toLocationLat").val(), $("#toLocationLng").val()));

        // Zoom To Fit All Markers on Google Maps API v3
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, LtLgLen = latLngs.length; i < LtLgLen; i++) {
          bounds.extend(latLngs[i]);
        }
        map.fitBounds(bounds);

        new google.maps.Marker({
            map: map,
            draggable: false,
            position: latLngs[0]
        });
        new google.maps.Marker({
            map: map,
            draggable: false,
            position: latLngs[1]
        });

        var lineSymbol = {
            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
        };

        var flightPlanCoordinates = [
            latLngs[0],
            latLngs[1]
        ];

        line = new google.maps.Polyline({
            path: flightPlanCoordinates,
            strokeColor: '#77bf44',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            geodesic: true,
            icons: [{
                icon: lineSymbol,
                repeat: '100px'
            }],
            map: map
        });
        animate();
    }
    function animate() {
        var count = 0;
        window.setInterval(function() {
          count = (count + 1) % 200;

          var icons = line.get('icons');
          icons[0].offset = (count / 2) + '%';
          line.set('icons', icons);
      }, 1000);
    }
</script>
</script>
<input type="hidden" id="formLocationLat" value="" />
<input type="hidden" id="formLocationLng" value="" />

<input type="hidden" id="toLocationLat" value="" />
<input type="hidden" id="toLocationLng" value="" />

<script type="text/javascript">
    $(document).ready(function() {
        $(".flight-cart").click(function(e) {
            if($(e.target).is('input') || $(e.target).is('label')) return;
            
            var id = $(this).find('input.id').val();
            var link = $(this).find('input.link').val();
            var divshow = $(this).find('.show');
            if(divshow.html()) {
                divshow.toggle("slow");
            } else {
                $.ajax({
                    url: link,
                    success: function(data) {
                        var show = $('#flight'+id).find('.show');
                        show.html(data);
                        show.show("slow");
                    },
                    error: function(xhr, textStatus, thrownError) {
                        alert(xhr.statusText + ': ' + xhr.responseText);
                    }
                });
            }
        });
        $(".icon-map").click(function() {
            $(".flight-map").toggle();
            $(this).toggleClass('active');
            //google.maps.event.addDomListener(window, 'load', initialize);
            if(!$("#map-canvas").html())
                initialize();
        });
    });
</script>

