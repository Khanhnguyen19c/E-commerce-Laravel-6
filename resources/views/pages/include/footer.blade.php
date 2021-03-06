<html>


<head>
		<meta charset="utf-8">
		<title>SF TRAVEL</title>
		/* reset */

*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%;display: block;; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 "Open Sans", sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer;  height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
		</style>
		
	</head>
	<body>
	
		<header>
			<h1>Du L???ch An To??n Th??n Thi???n</h1>
			<address >
				<p>V??nh Long, Vi???t Nam.</p>
				<p>(+84) 77 28 79 116</p>
			</address>
			<span><img alt="" src="assets/img/logo1.png"></span>
		</header>
		<article>
			<h1>Recipient</h1>
			<address>
			<p>T??n Ng?????i ?????t : '.mb_strtoupper($customer->customer_name).'</td>
			
			<td>'.$customer->customer_email.'</td><br></p>
			</address>
			<table class="meta">
				<tr>
					<th><span>T??n kh??ch ?????t</span></th>
					<td><span >	<td>'.$shipping->shipping_name.'</td> </span></td>
				</tr>
				<tr>
				<th<span>S??? ??i???n tho???i</span></th>
					<td><span >'.$shipping->shipping_phone.'</span></td>
				</tr>
				<tr>
					<th><span >?????a Ch??? Ng?????i Nh???n</span></th>
					<td><span>'.$shipping->shipping_address.' </span></td>
				</tr>
				<tr>
					<th><span>H??nh Th???c</span></th>
					<td>'.$shipping->shipping_notes.'</td>
				</tr>
			</table>
			<table class="inventory">
		
					<tr>
						<th><span>T??n s???n ph???m</span></th>
						<th><span>M?? gi???m gi??</span></th>
						<th><span>Ph?? ship</span></th>
						<th><span>S??? l?????ng</span></th>
						<th><span>Gi?? s???n ph???m</span></th>
						<th><span>Th??nh ti???n</span></th>
					</tr>
				<tbody>';		
				$total = 0;
		
				foreach($order_details_product as $key => $product){
		
					$subtotal = $product->product_price*$product->product_save_quantity;
					$total+=$subtotal;
		
					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'kh??ng m??';
					}		
		
					$output.='		
					<tr>
					<td><span>'.$product->product_name.'</span></td>
					<td><span>'.$product_coupon.'</span></td>
					<td><span>'.number_format($product->product_feeship,0,',','.').'??'.'</span></td>
					<td><span>'.$product->product_save_quantity.'</span></td>
					<td><span>'.number_format($product->product_price,0,',','.').'??'.'</span></td>
					<td><span>'.number_format($subtotal,0,',','.').'??'.'</span></td>
					</tr>';
				}
		
				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
					$total_coupon = $total - $total_after_coupon;
				}else{
					$total_coupon = $total - $coupon_number;
				}
		
				$output.= '<tr>	
					
				</tbody>
			</table>
			<table class="balance">
				</tr>';
				$output.='				
					<th><span >Ph?? Sh??p</span></th>
					<td><span>'.number_format($product->product_feeship,0,',','.').'??'.'</span></td>
				</tr>
				<tr>
					<th><span >M?? Khuy???n M??i</span></th>
					<td><span data-prefix></span><span >'.$coupon_echo.'</span></td>
				</tr>
				<tr>
					<th><span >T???ng C???ng</span></th>
					<td><span>'.number_format($total_coupon + $product->product_feeship,0,',','.').'??'.'</span></td>
				</tr>
			</table>
			<br><br><br><br>
			<span>Ng?????i L???p B???ng: '.mb_strtoupper(session()->get('admin_name')).'</span>
		</article>
	
		<aside>
		<h1><span >Li??n H??? </span></h1>
			<div >
				<p align="center">Email : khanhlunn369@gmail.com || Web : www.sftravel.com || Phone : +84 77 28 79 116 </p>
			</div>
		</aside>
	</body>
</html>

	
		';