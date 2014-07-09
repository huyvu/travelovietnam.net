<?
$search = $this->session->userdata("flight_search");
if (empty($search)) {
    $search = new stdClass();
    $search->airline = "Vietnam Airlines";
    $search->direction = 'return';
    $search->leavingFrom = '';
    $search->goingTo = '';
    $search->departDate = date("m/d/Y", strtotime("+1 days"));
    $search->returnDate = date("m/d/Y", strtotime("+4 days"));
    $search->adults = 1;
    $search->children = 0;
    $search->infants = 0;
    $search->classtype = 'Economy';
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            numberOfMonths: 2,
            minDate: 0
        };
        $("#flight-departuredate").datepicker(options);
        $("#flight-returndate").datepicker(options);

        $(".flight-direction").click(function() {
            if ($('input[name=flight-direction]:checked').val() == "oneway") {
                $(".flight-returndate").hide();
            } else {
                $(".flight-returndate").show();
            }
        });
		
        $("#flight-fromcity").change(function() {
            var p = {};
            p['fromcity'] = $("#flight-fromcity").val();
            $("#flight-tocity").load("<?= site_url('flights/ajax_get_city') ?>", p, function() {
            });
        });
		
        $("#search-button").click(function() {
            loading("Searching for flights...");
            return true;
        });

        $(".cheapflight-link").click(function() {
            loading("Searching for flights...");
            return true;
        });

        $("#flight-fromcity").val('<?= $search->leavingFrom ?>');
        var p = {};
        p['fromcity'] = $("#flight-fromcity").val();
        $("#flight-tocity").load("<?= site_url('flights/ajax_get_city') ?>", p, function() {
            $("#flight-tocity").val('<?= $search->goingTo ?>');
        });

        $("#return").attr('checked', Boolean('<?= (($search->direction == "return") ? true : false) ?>'));
        $("#oneway").attr('checked', Boolean('<?= (($search->direction == "oneway") ? true : false) ?>'));
        if ($('input[name=flight-direction]:checked').val() == "oneway") {
            $(".flight-returndate").hide();
        } else {
            $(".flight-returndate").show();
        }

        $("#flight-departuredate").val('<?= date("m/d/Y", strtotime($search->departDate)) ?>');
        $("#flight-returndate").val('<?= date("m/d/Y", strtotime($search->returnDate)) ?>');
        $("#flight-adults").val('<?= $search->adults ?>');
        $("#flight-children").val('<?= $search->children ?>');
        $("#flight-infants").val('<?= $search->infants ?>');
        $("#flight-classtype").val('<?= $search->classtype ?>');
    });
</script>

<div id="flight-search-widget">
    <div class="widget-content">
        <form action="<?= site_url("flights/search") ?>" method="POST">
            <div class="clearfix">
                <div class="left">
                    <p class="text-form w250">
                        <label class="title">From:</label>
                        <select id="flight-fromcity" name="flight-fromcity" style="width: 250px">
                            <option selected value="">Select</option>
                            <optgroup label="Vietnam">
                                <option value='BMV'>Buon Ma Thuot (BMV)</option>
                                <option value='CAH'>Ca Mau (CAH)</option>
                                <option value='VCA'>Can Tho (VCA)</option>
                                <option value='VCL'>Chu Lai (VCL)</option>
                                <option value='VCS'>Con Dao (VCS)</option>
                                <option value='DLI'>Da Lat (DLI)</option>
                                <option value='DAD'>Da Nang (DAD)</option>
                                <option value='DIN'>Dien Bien (DIN)</option>
                                <option value='VDH'>Dong Hoi (VDH)</option>
                                <option value='HAN'>Ha Noi (HAN)</option>
                                <option value='HPH'>Hai Phong (HPH)</option>
                                <option value='SGN'>Ho Chi Minh City (SGN)</option>
                                <option value='HUI'>Hue (HUI)</option>
                                <option value='NHA'>Nha Trang (NHA)</option>
                                <option value='PQC'>Phu Quoc (PQC)</option>
                                <option value='PXU'>Pleiku (PXU)</option>
                                <option value='UIH'>Quy Nhon (UIH)</option>
                                <option value='VKG'>Rach Gia (VKG)</option>
                                <option value='THD'>Thanh Hoa (THD)</option>
                                <option value='TBB'>Tuy Hoa (TBB)</option>
                                <option value='VII'>Vinh (VII)</option>
                            </optgroup>
                            <optgroup label="Australia">
                                <option value='MEL'>Melbourne (MEL)</option>
                                <option value='SYD'>Sydney (SYD)</option>
                            </optgroup>
                            <optgroup label="Europe">
                                <option value='AMS'>Amsterdam (AMS) </option>
                                <option value='BCN'>Barcelona (BCN) </option>
                                <option value='FRA'>Frankfurt (FRA)</option>
                                <option value='LON'>London (LON)</option>
                                <option value='MOW'>Moscow (MOW)</option>
                                <option value='NCE'>Nice (NCE)</option>
                                <option value='PAR'>Paris (PAR)</option>
                                <option value='PRG'>Prague (PRG) </option>
                                <option value='ROM'>Rome (ROM) </option>
                            </optgroup>
                            <optgroup label="Indochina">
                                <option value='LPQ'>Luang Prabang (LPQ)</option>
                                <option value='PNH'>Phnom Penh (PNH)</option>
                                <option value='REP'>Siem Riep (REP)</option>
                                <option value='VTE'>Vientiane (VTE)</option>
                            </optgroup>
                            <optgroup label="North East Asia">
                                <option value='BJS'>Beijing (BJS)</option>
                                <option value='PUS'>Busan (PUS)</option>
                                <option value='CTU'>Chengdu (CTU)</option>
                                <option value='FUK'>Fukuoka (FUK)</option>
                                <option value='CAN'>Guangzhou (CAN)</option>
                                <option value='HKG'>Hong Kong (HKG)</option>
                                <option value='KHH'>Kaohsiung (KHH)</option>
                                <option value='NGO'>Nagoya (NGO)</option>
                                <option value='OSA'>Osaka (OSA)</option>
                                <option value='SEL'>Seoul (SEL)</option>
                                <option value='SHA'>Shanghai (SHA)</option>
                                <option value='TPE'>Taipei (TPE)</option>
                                <option value='TYO'>Tokyo (TYO)</option>
                            </optgroup>
                            <optgroup label="South East Asia">
                                <option value='BKK'>Bangkok (BKK)</option>
                                <option value='JKT'>Jakarta (JKT) </option>
                                <option value='KUL'>Kuala Lumpur (KUL)</option>
                                <option value='MNL'>Manila (MNL)</option>
                                <option value='SIN'>Singapore (SIN)</option>
                                <option value='RGN'>Yangon (RGN)</option>
                            </optgroup>
                            <optgroup label="United States of America">
                                <option value='ATL'>Atlanta Hartsfield (ATL)</option>
                                <option value='AUS'>Austin (AUS)</option>
                                <option value='BOS'>Boston, Logan (BOS)</option>
                                <option value='CHI'>Chicago IL (CHI)</option>
                                <option value='DFW'>Dallas Fort Worth (DFW)</option>
                                <option value='DEN'>Denver (DEN)</option>
                                <option value='HNL'>Honolulu (HNL)</option>
                                <option value='LAX'>Los Angeles (LAX)</option>
                                <option value='MIA'>Miami (MIA)</option>
                                <option value='MSP'>Minneapolis/St.Paul (MSP)</option>
                                <option value='PHL'>Philadelphia (PHL)</option>
                                <option value='PDX'>Portland (PDX)</option>
                                <option value='SFO'>San Francisco (SFO)</option>
                                <option value='SEA'>Seattle, Tacoma (SEA)</option>
                                <option value='STL'>St Louis, Lambert (STL)</option>
                                <option value='WAS'>Washington (WAS)</option>
                            </optgroup>
                        </select>
                    </p>
                </div>
                <p class="text-form w50">
                    <img alt="" src="<?= IMG_URL ?>icon-flight-direct.png" style="margin-top: 26px"/>
                </p>
                <div class="right" style="margin-right: 20px">
                    <p class="text-form w250">
                        <label class="title">To:</label>
                        <select id="flight-tocity" name="flight-tocity" style="width: 260px">
                            <option selected value="">Select</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="clearfix" style="margin-top: 18px">
                <div class="left">
                    <p class="text-form w120">
                        <label>Departing:</label>
                        <span class="calendar"><input type="text" id="flight-departuredate" name="flight-departuredate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" /></span>
                    </p>
                    <p class="text-form w120">
                        <input type="radio" id="return" name="flight-direction" value="return" class="flight-direction left" checked="checked"/><label class="left" for="return" style="padding-right: 10px">return</label>
                        <input type="radio" id="oneway" name="flight-direction" value="oneway" class="flight-direction left" /><label class="left" for="oneway">oneway</label>
                        <span class="calendar flight-returndate"><input type="text" id="flight-returndate" name="flight-returndate" placeholder="mm/dd/yyyy" alt="mm/dd/yyyy" /></span>
                    </p>
                </div>
                <div class="right">
                    <p class="text-form left">
                        <label>&nbsp;</label>
                        <img alt="" src="<?= IMG_URL ?>icon-adult.png" class="left"/>
                        <input type="text" id="flight-adults" name="flight-adults" value="1" class="left numofpax"/><br/>
                        <label class="sub-title">12+ yrs.</label>
                    </p>
                    <p class="text-form left">
                        <label>&nbsp;</label>
                        <img alt="" src="<?= IMG_URL ?>icon-children.png" class="left"/>
                        <input type="text" id="flight-children" name="flight-children" value="0" class="left numofpax"/><br/>
                        <label class="sub-title">2-11 yrs.</label>
                    </p>
                    <p class="text-form left">
                        <label>&nbsp;</label>
                        <img alt="" src="<?= IMG_URL ?>icon-infant.png" class="left"/>
                        <input type="text" id="flight-infants" name="flight-infants" value="0" class="left numofpax"/><br/>
                        <label class="sub-title"><2 yrs.</label>
                    </p>
                    <p class="text-form w120 right">
                        <label>Class</label>
                        <select id="flight-classtype" name="flight-classtype">
                            <option value="Economy">Economy</option>
                            <option value="Business">Business</option>
                            <option value="FirstClass">First Class</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="clearfix" style="margin-top: 18px;">
                <div class="search-button">
                    <input type="submit" id="search-button" class="org-btn-large" value="SEARCH FLIGHT"/>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="flight-search-widget-overlay"></div>