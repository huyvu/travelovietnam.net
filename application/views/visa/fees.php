<div class="left">
	<? require_once(APPPATH."views/module/visa/apply_form.php"); ?>
	<? require_once(APPPATH."views/module/visa/support_online.php"); ?>
	<? require_once(APPPATH."views/module/visa/confidence.php"); ?>
</div>
<div class="right" style="width: 710px">
	<div id="view-container">
		<div id="breadcrumbs">
			<a class="pathway" title="Home" href="<?=BASE_URL?>">Home</a>
			<img alt="" src="<?=IMG_URL?>arrow.png">
			<a class="pathway" title="Visa" href="<?=site_url("visa")?>">Visa</a>
			<img alt="" src="<?=IMG_URL?>arrow.png"> Vietnam Visa Fees
			<? require_once(APPPATH."views/module/social.php"); ?>
		</div>
		<h1 class="headtitle">VIETNAM VISA FEES</h1>
        <div class="servicefees">
			<h3>A. VIETNAM VISA FEES INFORMATION</h3>
			<div class="infomation">
				<p>There are 2 types of fees that you should pay to get Vietnam visa: Service Fee and Stamping Fee.</p>
				<p><strong>1. Service fee</strong></p>
				<p>Is the fee that the applicants have to pay for us  in order to process the visa approval letter for applicants to get visa stamp at the airports in Vietnam.</p>
				<p><strong>2. Stamping fee</strong></p>
				<p>Is the fee that the applicants must pay in cash at the landing visa office at the arrival airport. This is 45 USD/person for single entry or 65 USD/person for multiple entries.</p>
				<p>More Details, please check bellow:</p>
				<p style="text-align: right">Currency: <strong>USD</strong></p>
				<table>
					<tr>
						<th rowspan="3" style="width: 170px;">Visa types</th>
						<th colspan="7"><strong>Service fee</strong> cost/pax</th>
						<th rowspan="3" style="width: 130px;">
							<strong>Stamping fee</strong><br />
							Cost/pax<br /><font color="red">Will be paid at the Airport</font>
						</th>
					</tr>
					<tr>
						<th colspan="5">Normal Service (24 - 48 hours)</th>
						<th rowspan="2" style="width: 80px;">URGENT <br>(4-8 hours)</th>
						<th rowspan="2" style="width: 80px;">EMERGENCY <br>(1-4 hours)</th>
					</tr>
					<tr>
						<th width="35px">1 pax</th>
						<th width="35px">2 pax</th>
						<th width="35px">3-5 pax</th>
						<th width="35px">6-9 pax</th>
						<th width="35px">10 - upwards</th>
					</tr>
					<tr>
						<td style="text-align: left">1 month single</td>
						<td>20</td>
						<td>18</td>
						<td>16</td>
						<td>14</td>
						<td>12</td>
						<td rowspan="5">
							Plus<br>20 USD/pax
						</td>
						<td rowspan="5">
							Plus<br>50 USD/pax
						</td>
						<td>45 USD</td>
					</tr>
					<tr>
						<td style="text-align: left">1 month multiple</td>
						<td>25</td>
						<td>23</td>
						<td>21</td>
						<td>19</td>
						<td>17</td>
						<td>65 USD</td>
					</tr>
					<tr>
						<td style="text-align: left">3 months single</td>
						<td>30</td>
						<td>28</td>
						<td>26</td>
						<td>24</td>
						<td>22</td>
						<td>45 USD</td>
					</tr>
					<tr>
						<td style="text-align: left">3 months multiple</td>
						<td>60</td>
						<td>58</td>
						<td>56</td>
						<td>54</td>
						<td>52</td>
						<td>65 USD</td>
					</tr>
					<tr>
						<td style="text-align: left">3 months at Embassy</td>
						<td>38</td>
						<td>36</td>
						<td>34</td>
						<td>32</td>
						<td>30</td>
						<td>Updating</td>
					</tr>
				</table>
			</div>
		</div>
	
		<div class="clear"></div>
		<br/><br/>
		
		<div class="servicefees bts">
			<h3>B. EXTRA SERVICE</h3>
			<div class="infomation">
				<p><strong>1. Airport Fast Track</strong></p>
				<table width="100%">
					<tbody>
						<tr class="trbgnormal">
							<th width="150" class="tdleft">No Person</th>
							<th class="tdcenter" colspan="2">1-4 paxs</th>
							<th class="tdcenter" colspan="2">5-10 paxs</th>
						</tr>
						<tr class="trbgnormal">
							<th class="tdleft" rowspan="2">Airport Fast Track</th>
							<th class="tdcenter">Airport- HCM</th>
							<th class="tdcenter">Airport- Hanoi</th>
							<th class="tdcenter">Airport- HCM</th>
							<th class="tdcenter">Airport- Hanoi</th>
						</tr>
						<tr class="trbgnormal">
							<td class="tdcenter dg">15 USD/pax</td>
							<td class="tdcenter dg">20 USD/pax</td>
							<td class="tdcenter dg">12 USD/pax</td>
							<td class="tdcenter dg">15 USD/pax</td>
						</tr>
					</tbody>
				</table>
				<br>
				<p><strong>2. Airport Pick up</strong></p>
				<table width="100%">
					<tbody>
						<tr class="trbgnormal">
							<th class="tdleft" rowspan="2">Tranfer/pick up</th>
							<th class="tdcenter" colspan="2">Airport- HCM</th>
							<th class="tdcenter" colspan="2">Airport- Hanoi</th>
						</tr>
						<tr class="trbgnormal">
							<td class="tdcenter dg">Taxi/Cap</td>
							<td class="tdcenter dg">Private Car</td>
							<td class="tdcenter dg">Taxi/Cap</td>
							<td class="tdcenter dg">Private Car</td>
						</tr>
						<tr class="trbgbold">
							<td class="tdleft">4 seats</td>
							<td class="tdcenter">10 USD/car</td>
							<td class="tdcenter">25 USD/car</td>
							<td class="tdcenter">20 USD/car</td>
							<td class="tdcenter">30 USD/car</td>
						</tr>
						<tr class="trbgbold">
							<td class="tdleft">7 seats</td>
							<td class="tdcenter">10 USD/car</td>
							<td class="tdcenter">30 USD/car</td>
							<td class="tdcenter">20 USD/car</td>
							<td class="tdcenter">35 USD/car</td>
						</tr>
						<tr class="trbgbold">
							<td class="tdleft">16 seats</td>
							<td class="tdcenter">No</td>
							<td class="tdcenter">50 USD/van</td>
							<td class="tdcenter">No</td>
							<td class="tdcenter">60 USD/van</td>
						</tr>
						<tr class="trbgbold">
							<td class="tdleft">24 seats</td>
							<td class="tdcenter">No</td>
							<td class="tdcenter">85 USD/van</td>
							<td class="tdcenter">No</td>
							<td class="tdcenter">90 USD/bus</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br/>
		<div class="center">
			<a class="red-btn" href="<?=BASE_URL_HTTPS."/visa/apply"?>">APPLY VISA NOW &gt;&gt;</a>
		</div>
	</div>
</div>
<div class="clr"></div>
