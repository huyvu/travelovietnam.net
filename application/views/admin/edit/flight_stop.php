<?php
$airports = $this->m_flight->getAirports();

$departure_time1		= isset($item->departure_time1) ? $item->departure_time1 : "";
$arrival_time1			= isset($item->arrival_time1) ? $item->arrival_time1 : "";
$duration1			= isset($item->duration1) ? $item->duration1 : "";
$leaving_from1			= isset($item->leaving_from1) ? $item->leaving_from1 : "";
$going_to1			= isset($item->going_to1) ? $item->going_to1 : "";
$airline1			= isset($item->airline1) ? $item->airline1 : "";
$flight1			= isset($item->flight1) ? $item->flight1 : "";
$layover1			= isset($item->layover1) ? $item->layover1 : "";

$departure_time2		= isset($item->departure_time2) ? $item->departure_time2 : "";
$arrival_time2			= isset($item->arrival_time2) ? $item->arrival_time2 : "";
$duration2			= isset($item->duration2) ? $item->duration2 : "";
$leaving_from2			= isset($item->leaving_from2) ? $item->leaving_from2 : "";
$going_to2			= isset($item->going_to2) ? $item->going_to2 : "";
$airline2			= isset($item->airline2) ? $item->airline2 : "";
$flight2			= isset($item->flight2) ? $item->flight2 : "";
$layover2			= isset($item->layover2) ? $item->layover2 : "";

$departure_time3		= isset($item->departure_time3) ? $item->departure_time3 : "";
$arrival_time3			= isset($item->arrival_time3) ? $item->arrival_time3 : "";
$duration3			= isset($item->duration3) ? $item->duration3 : "";
$leaving_from3			= isset($item->leaving_from3) ? $item->leaving_from3 : "";
$going_to3			= isset($item->going_to3) ? $item->going_to3 : "";
$airline3			= isset($item->airline3) ? $item->airline3 : "";
$flight3			= isset($item->flight3) ? $item->flight3 : "";
$layover3			= isset($item->layover3) ? $item->layover3 : "";
?>

<div id="toolbar-box">
    <div class="t">
        <div class="t">
            <div class="t"></div>
        </div>
    </div>
    <div class="m">
        <div id="toolbar" class="toolbar">
            <table class="toolbar">
                <tbody>
                    <tr>
                        <td id="toolbar-save" class="button">
                            <a class="toolbar" onclick="javascript: submitbutton('save')" href="#">
                                <span title="Save" class="icon-32-save">
                                </span>
                                Save
                            </a>
                        </td>
                        <td id="toolbar-cancel" class="button">
                            <a class="toolbar" onclick="javascript: submitbutton('cancel')" href="#">
                                <span title="Cancel" class="icon-32-cancel">
                                </span>
                                Cancel
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="header icon-48-generic">
            Flight Stop: <small><small>[ Edit ]</small></small>
        </div>
        <div class="clr"></div>
    </div>
    <div class="b">
        <div class="b">
            <div class="b"></div>
        </div>
    </div>
</div>
<div class="clr"></div>
<div id="element-box">
    <div class="t">
        <div class="t">
            <div class="t"></div>
        </div>
    </div>
    <div class="m">
        <script type="text/javascript" language="javascript">
            function submitbutton(pressbutton)
            {
                var form = document.adminForm;
                if (pressbutton == 'cancel')
                {
                    submitform(pressbutton);
                    return;
                }

                if (form.name.value == "")
                {
                    alert("PLEASE INPUT THE NAME");
                    return;
                }
                submitform(pressbutton);
            }
        </script>
        <form id="adminForm" name="adminForm" method="post" action="<?= site_url("administrator/update_flight_stop") ?>">
            <input type="hidden" name="task" value="" />
            <? if (isset($item)) { ?>
            <input type="hidden" name="action" id="action" value="edit"/>
            <input type="hidden" name="id" id="id" value="<?= (isset($item->id) ? $item->id : 0) ?>"/>
            <? } else { ?>
            <input type="hidden" name="action" id="action" value="new"/>
            <? } ?>
            
            <input type="hidden" name="route_id" value="<?php echo $route_id; ?>"/>
            
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tbody>
                    <tr>
                        <td valign="top">
                            <table class="adminform">
                                <tbody>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Departure Time 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $departure_time1 ?>" maxlength="255" id="departure_time1" name="departure_time1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Arrival Time 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $arrival_time1 ?>" maxlength="255" id="arrival_time1" name="arrival_time1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Duration 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $duration1 ?>" maxlength="255" id="duration1" name="duration1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Leaving From 1:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="leaving_from1">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$leaving_from1?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Going To 1:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="going_to1">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$going_to1?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Airline 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $airline1 ?>" maxlength="255" id="airline1" name="airline1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Flight 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $flight1 ?>" maxlength="255" id="flight1" name="flight1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Layover 1:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $layover1 ?>" maxlength="255" id="layover1" name="layover1" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"></td></tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Departure Time 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $departure_time2 ?>" maxlength="255" id="departure_time2" name="departure_time2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Arrival Time 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $arrival_time2 ?>" maxlength="255" id="arrival_time2" name="arrival_time2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Duration 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $duration2 ?>" maxlength="255" id="duration2" name="duration2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Leaving From 2:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="leaving_from2">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$leaving_from2?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Going To 2:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="going_to2">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$going_to2?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Airline 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $airline2 ?>" maxlength="255" id="airline2" name="airline2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Flight 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $flight2 ?>" maxlength="255" id="flight2" name="flight2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Layover 2:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $layover2 ?>" maxlength="255" id="layover2" name="layover2" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"></td></tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Departure Time 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $departure_time3 ?>" maxlength="255" id="departure_time3" name="departure_time3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Arrival Time 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $arrival_time3 ?>" maxlength="255" id="arrival_time3" name="arrival_time3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Duration 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $duration3 ?>" maxlength="255" id="duration3" name="duration3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Leaving From 3:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="leaving_from3">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$leaving_from3?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Going To 3:</label>
                                        </td>
                                        <td width="90%">
                                            <select name="going_to3">
                                            <?php foreach ($airports as $airport): ?>
                                                <option value="<?php echo $airport->code; ?>" <?php echo $airport->code==$going_to3?'selected':''; ?>><?php echo $airport->name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Airline 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $airline3 ?>" maxlength="255" id="airline3" name="airline3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Flight 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $flight3 ?>" maxlength="255" id="flight3" name="flight3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="10%">
                                            <label for="name">Layover 3:</label>
                                        </td>
                                        <td width="90%">
                                            <input type="text" value="<?= $layover3 ?>" maxlength="255" id="layover3" name="layover3" class="inputbox" style="width: 100%" />
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"></td></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div class="clr"></div>
    </div>
    <div class="b">
        <div class="b">
            <div class="b"></div>
        </div>
    </div>
</div>
<div class="clr"></div>
