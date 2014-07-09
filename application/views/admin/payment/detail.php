<style>
.tbl-report {
	border-collapse: collapse;
}
.tbl-report td {
	border: 1px solid #DDDDDD;
	padding: 4px;
}
.tbl-report .red {
	color: red;
}
</style>
<table class="tbl-report">
	<tr>
		<td>Transaction Exists</td>
		<? if ($vpc_DRExists == "Y") { ?>
		<td>YES</td>
		<? } else { ?>
		<td class="red">NO</td>
		<? } ?>
	</tr>
	<tr>
		<td>Addition Data</td>
		<td><?=$vpc_AdditionData?></td>
	</tr>
	<tr>
		<td>Amount</td>
		<td><?=$vpc_Amount/100?></td>
	</tr>
	<tr>
		<td>Command</td>
		<td><?=$vpc_Command?></td>
	</tr>
	<tr>
		<td>Currency Code</td>
		<td><?=$vpc_CurrencyCode?></td>
	</tr>
	<tr>
		<td>Locale</td>
		<td><?=$vpc_Locale?></td>
	</tr>
	<tr>
		<td>Merchant Txn Reference</td>
		<td><?=$vpc_MerchTxnRef?></td>
	</tr>
	<tr>
		<td>Merchant</td>
		<td><?=$vpc_Merchant?></td>
	</tr>
	<tr>
		<td>Message</td>
		<td><?=$vpc_Message?></td>
	</tr>
	<tr>
		<td>Order Info</td>
		<td><?=$vpc_OrderInfo?></td>
	</tr>
	<tr>
		<td>Transaction No</td>
		<td><?=$vpc_TransactionNo?></td>
	</tr>
	<tr>
		<td>Txn Response Code</td>
		<? if ($vpc_TxnResponseCode == "0") { ?>
		<td>Transaction successful</td>
		<? } else { ?>
		<td class="red">Transaction failed</td>
		<? } ?>
	</tr>
	<tr>
		<td>Version</td>
		<td><?=$vpc_Version?></td>
	</tr>
</table>