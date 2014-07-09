<? require_once(APPPATH . "views/module/flight/search_widget.php"); ?>
<div id="flight-panel">
    <div class="block-left">
        <div id="index-panel" class="why-book-us">
            <div class="content">
                <h1>WHY BOOK WITH US ?</h1>
                <ul>
                    <li><span>Great prices</span></li>
                    <li><span>Safety with secure system</span></li>
                    <li><span>Money back guarantee</span></li>
                    <li><span>Response quickly</span></li>
                    <li><span>And 24/7 customer service</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="block-left">
        <div id="index-panel" class="flight-tool">
            <div class="content">
                <h1>TRAVEL TOOLS</h1>
                <ul>
                    <li><a>Flight request form</a></li>
                    <li><a>Check flight status</a></li>
                    <li><a>FAQs</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="block-left">
        <div id="index-panel" class="flight-service">
            <div class="content">
                <h1>SERVICES</h1>
                <ul>
                    <li><a>Your booking</a></li>
                    <li><a>Find a location</a></li>
                    <li><a>Executive services</a></li>
                    <li><a>Need a hotel?</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="template/jquery/js/jquery.pages.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".cheapFlights-holder").jPages({
                containerID: "cheapFlights",
                perPage: 7
            });
        });
    </script>
    <style>
        .cheapFlights-holder {
            width: 208px;
            position: absolute;
            bottom: 10px;
        }
        .cheapFlights-holder a {display: none;}
        .cheapFlights-holder .jp-previous {
            display: inline-block; float: left; background: url("template/jquery/images/metro/back.png") center center;
            cursor: pointer;
            text-indent: -10em;
            width: 24px; height: 24px; overflow: hidden;
            margin-top: 5px;
        }
        .cheapFlights-holder .jp-next {
            display: inline-block; float: right; background: url("template/jquery/images/metro/next.png") center center;
            cursor: pointer;
            text-indent: -10em;
            width: 24px; height: 24px; overflow: hidden;
            margin-top: 5px;
        }
        .cheapFlights-holder .jp-disabled {display: none;}
    </style>
    
    <div class="block-right">
        <div id="index-panel" class="prices-box-content">
            <h1 class="clearfix"><span class="ccy">$</span><span class="title">CHEAP FLIGHTS</span></h1>
            <div class="content clearfix">
                <div class="tit">FROM HO CHI MINH TO</div>
                <ul id="cheapFlights">
                    <?php foreach ($flights as $flight): ?>
                        <li class="clearfix"><a class="cheapflight-link" title="depart from Ho Chi Minh to <?php echo $airports[$flight->going_to]->name; ?>" href="<?= site_url("flights/depart") . "?from=" . $airports[$flight->leaving_from]->alias . "&to=" . $airports[$flight->going_to]->alias; ?>"><span class="left"><?php echo $airports[$flight->going_to]->name; ?></span><span class="right">$<?php echo number_format($flight->saverflex); ?></span><span class="clr"></span></a></li>
                    <?php endforeach; ?>

                    <?php /*<li class="clearfix last"><a class="viewmore" title="View more cheap flights" href="">View more</a></li>*/ ?>
                </ul>
                <div class="cheapFlights-holder"></div>
            </div>
        </div>
    </div>
</div>
