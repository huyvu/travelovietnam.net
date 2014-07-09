<div id="toolbar-box">
    <div class="t">
        <div class="t">
            <div class="t"></div>
        </div>
    </div>
    <div class="m">
        <div class="toolbar" id="toolbar">
            <table class="toolbar">
                <tr>
                    <td class="button" id="toolbar-publish">
                        <a href="#" onclick="javascript:if (document.adminForm.boxchecked.value == 0) {
                                    alert('Please make a selection from the list to publish');
                                } else {
                                    submitbutton('publish')
                                }" class="toolbar">
                            <span class="icon-32-publish" title="Publish">
                            </span>
                            Publish
                        </a>
                    </td>
                    <td class="button" id="toolbar-unpublish">
                        <a href="#" onclick="javascript:if (document.adminForm.boxchecked.value == 0) {
                                    alert('Please make a selection from the list to unpublish');
                                } else {
                                    submitbutton('unpublish')
                                }" class="toolbar">
                            <span class="icon-32-unpublish" title="Unpublish">
                            </span>
                            Unpublish
                        </a>
                    </td>
                    <td class="button" id="toolbar-DO YOU WANT TO DELETE THERE ITEMS?">
                        <a href="#" onclick="javascript:if (document.adminForm.boxchecked.value == 0) {
                                    alert('Please make a selection from the list to delete');
                                } else {
                                    if (confirm('DO YOU WANT TO DELETE THERE ITEMS?')) {
                                        submitbutton('remove');
                                    }
                                }" class="toolbar">
                            <span class="icon-32-delete" title="Delete">
                            </span>
                            Delete
                        </a>
                    </td>
                    <td class="button" id="toolbar-new">
                        <a href="#" onclick="javascript:hideMainMenu();
                                submitbutton('add')" class="toolbar">
                            <span class="icon-32-new" title="New">
                            </span>
                            New
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="header icon-48-generic">
            FROM: <?= $airport->name ?> &rarr;
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
        <form method="POST" action="<?= site_url("administrator/update_flight") ?>" name="adminForm">
            <div id="editcell">
                <table class="adminlist">
                    <thead>
                        <tr>
                            <th width="5">
                                #			
                            </th>
                            <th width="20" align="center">
                                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?= sizeof($items) ?>);" />
                            </th>
                            <th width="120px">
                                To
                            </th>
                            <th width="120px">
                                Airline
                            </th>
                            <th>
                                Flight No.
                            </th>
                            <th>
                                Aircraft
                            </th>
                            <th>
                                Stops
                            </th>
                            <th>
                                Departure Time
                            </th>
                            <th>
                                Arrival Time
                            </th>
                            <th>
                                Saver Flex
                            </th>
                            <th>
                                Economy
                            </th>
                            <th>
                                Bussiness
                            </th>
                            <th width="80">
                                Published
                            </th>
                            <th width="80">
                                Created Date
                            </th>
                            <th width="5">
                                ID
                            </th>
                        </tr>
                    </thead>
                    <?
                    if (!empty($items) && sizeof($items)) {
                    $idx = 1;
                    foreach ($items as $item) {
                    ?>
                    <tr>
                        <td width="2%" align="center">
                            <?= $idx ?>
                        </td>
                        <td align="center">
                            <input type="checkbox" id="cb<?= $idx - 1 ?>" name="cid[]" value="<?= $item->id ?>" onclick="isChecked(this.checked);" />    			
                        </td>
                        <td>
                            <a href="<?= site_url("administrator/edit_flight/" . $item->id) ?>"><?= $this->m_flight->getAirport($item->going_to)->name ?></a>
                        </td>
                        <td>
                            <?= $item->airline ?>
                        </td>
                        <td>
<?= $item->flight ?>
                        </td>
                        <td>
<?= $item->aircraft ?>
                        </td>
                        <td align="center">
                            <?php if(!$item->stops): ?>
                                <?= $item->stops ?>
                            <?php else: ?>
                                <a title="add rate" href="<?=site_url("administrator/flight_stop/".$item->id)?>">
                                    <?= $item->stops ?>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td align="center">
<?= $item->departure_time ?>
                        </td>
                        <td align="center">
<?= $item->arrival_time ?>
                        </td>
                        <td align="center">
                            $<?= $item->saverflex ?>
                        </td>
                        <td align="center">
                            $<?= $item->economy ?>
                        </td>
                        <td align="center">
                            $<?= $item->business ?>
                        </td>
                        <td align="center" width="30px">
                            <? if ($item->active) { ?>
                            <a title="Publish Item" onclick="return listItemTask('cb<?= $idx - 1 ?>', 'unpublish')" href="javascript:void(0);" />
                            <img border="0" alt="Unpublished" src="<?= IMG_URL ?>admin/publish_g.png" /></a>
                            <? } else { ?>
                            <a title="Publish Item" onclick="return listItemTask('cb<?= $idx - 1 ?>', 'publish')" href="javascript:void(0);" />
                            <img border="0" alt="Published" src="<?= IMG_URL ?>admin/publish_x.png" /></a>
                            <? } ?>
                        </td>
                        <td align="center" width="10%">
<?= date("M/d/Y", strtotime($item->created_date)) ?>
                        </td>
                        <td align="center">
<?= $item->id ?>
                        </td>
                    </tr>
                    <?
                    $idx ++;
                    }
                    }
                    ?>
                </table>
            </div>
            <div class="clr"></div>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="airport" value="<?= $airport->alias ?>" />
        </form>
    </div>
    <div class="b">
        <div class="b">
            <div class="b"></div>
        </div>
    </div>
</div>
