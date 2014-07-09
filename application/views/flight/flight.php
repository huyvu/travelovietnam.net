<?php
$this->load->model('m_flight');
$leaving_from = $this->m_flight->getAirport($route->leaving_from);
$going_to = $this->m_flight->getAirport($route->going_to);
?>

<div class="GFTNC2ACHIC <?php echo $direction!='out'?'return':'';?>">
    <div class="GFTNC2ACOIC">
        <?php echo $leaving_from->name; ?> - <?php echo $going_to->name; ?>
    </div>
</div>

<div class="GFTNC2ACKIC">
    <?php if($route->stops): ?>
        <?php
        $stop = $this->m_flight->getStop($route->id);
        $leaving_from1 = $this->m_flight->getAirport($stop->leaving_from1);
        $going_to1 = $this->m_flight->getAirport($stop->going_to1);
        ?>
        <table>
            <tr>
                <td><?php echo $stop->departure_time1; ?> – <?php echo $stop->arrival_time1; ?></td>
                <td style="width: 20px;"></td>
                <td>
                    <img title="<?= $route->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <?php echo $leaving_from1->name; ?> to <?php echo $going_to1->name; ?> 
                    <span><?php echo $leaving_from1->code; ?>-<?php echo $going_to1->code; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span><?php echo $stop->duration1; ?></span>
                </td>
                <td style="width: 20px;"></td>
                <td><span><?php echo $stop->flight1; ?></span></td>
            </tr>
            <tr>
                <td>
                    <?php echo $stop->layover1; ?> layover
                </td>
                <td style="width: 20px;"></td>
                <td><?php echo $going_to1->name; ?> <?php echo $going_to1->code; ?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
        </table>

        <?php
        $leaving_from2 = $this->m_flight->getAirport($stop->leaving_from2);
        $going_to2 = $this->m_flight->getAirport($stop->going_to2);
        ?>

        <table>
            <tr>
                <td><?php echo $stop->departure_time2; ?> – <?php echo $stop->arrival_time2; ?></td>
                <td style="width: 20px;"></td>
                <td>
                    <img title="<?= $route->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <?php echo $leaving_from2->name; ?> to <?php echo $going_to2->name; ?> 
                    <span><?php echo $leaving_from2->code; ?>-<?php echo $going_to2->code; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span><?php echo $stop->duration2; ?></span>
                </td>
                <td style="width: 20px;"></td>
                <td><span><?php echo $stop->flight2; ?></span></td>
            </tr>
            <?php if($route->stops > 1): ?>
            <tr>
                <td>
                    <?php echo $stop->layover2; ?> layover
                </td>
                <td style="width: 20px;"></td>
                <td><?php echo $going_to2->name; ?> <?php echo $going_to2->code; ?></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <?php endif; ?>
        </table>

        <?php if($route->stops > 2): ?>
            <?php
            $leaving_from3 = $this->m_flight->getAirport($stop->leaving_from3);
            $going_to3 = $this->m_flight->getAirport($stop->going_to3);
            ?>
                <table>
                    <tr>
                        <td><?php echo $stop->departure_time3; ?> – <?php echo $stop->arrival_time3; ?></td>
                        <td style="width: 20px;"></td>
                        <td>
                            <img title="<?= $route->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <?php echo $leaving_from3->name; ?> to <?php echo $going_to3->name; ?> 
                            <span><?php echo $leaving_from3->code; ?>-<?php echo $going_to3->code; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><?php echo $stop->duration3; ?></span>
                        </td>
                        <td style="width: 20px;"></td>
                        <td><span><?php echo $stop->flight3; ?></span></td>
                    </tr>                    
                </table>
        <?php endif; ?>
    <?php else: ?>
        <table>
            <tr>
                <td><?php echo $route->departure_time; ?> – <?php echo $route->arrival_time; ?></td>
                <td style="width: 20px;"></td>
                <td>
                    <img title="<?= $route->airline ?>" src="<?= IMG_URL ?>vietnamairlines.png"> <?php echo $leaving_from->name; ?> to <?php echo $going_to->name; ?> 
                    <span><?php echo $leaving_from->code; ?>-<?php echo $going_to->code; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span><?php echo $route->duration; ?></span>
                </td>
                <td style="width: 20px;"></td>
                <td><span><?php echo $route->flight; ?></span></td>
            </tr>
        </table>
    <?php endif; ?>
</div>
