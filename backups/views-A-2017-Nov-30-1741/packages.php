<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb beibc">
                <li><a href="<?= Yii::$app->params['SITE_URL'] ?>"><i class="fa fa-2x fa-home"></i></a></li>
                <li><a href="#"><h4>Pricing</h4></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="main_inner_head light-head">
        <h3>Supply Pricing</h3>
    </div>
    <div class="row mt-30">
        <div class="pricing-table">
            <table class="table pricing-table">
                <tr>
                    <th rowspan="1">CATEGORY</th>
                    <th rowspan="1">SUB-CATEGORY</th>
                    <th rowspan="1">CAPACITY (TONS/KN/KVA/Cu.Mtr)</th>
                    <th rowspan="1">PRICE TAG ( <i class="fa fa-inr" aria-hidden="true"></i> ) </th>
                    <th rowspan="1">VALIDITY</th>
                    <th colspan="1">ACTION</th>
                </tr>
<!--                                <tr><td class="bold">Supply</td><td class="bold">Sell</td></tr>-->
                <tr class="red_bg_table">
                    <td rowspan="2" class="bold">CRANES</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>0 - 50</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="red_bg_table">
                    <td>ALL SUB-CATEGORIES </td>
                    <td>51 & above</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="yellow_bg_table">
                    <td rowspan="4" class="bold">PILING RIGS</td>
                    <td>CONVENTIONAL  </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="yellow_bg_table">
                    <td>TRUCK MOUNTED   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="yellow_bg_table">
                    <td>ROTORY & HYDRAULIC   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="yellow_bg_table">
                    <td>DIAPHRAGM WALL   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="grey_bg_table">
                    <td rowspan="2" class="bold">EXCAVATORS</td>
                    <td>BACK-HOE LOADER   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="grey_bg_table">
                    <td>REMAINING SUB-CATEGORIES   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="red_bg_table">
                    <td class="bold">DUMPERS</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
                <tr class="yellow_bg_table">
                    <td class="bold">GENERATORS</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>
<!--                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>-->
                </tr>
            </table>
            <div class="tmslist">
                <h4>Terms & conditions for Equipment pricing (HIRE & SUPPLY) :</h4>
                <ul class="">
                    <li>The Registration Fee is for one Equipment only.</li>
                    <li>Upto 7 images can be uploaded for one Equipment.</li>
                    <li>The Registration Fee is valid for one year, from the date of Registration.</li>
                    <li>The Fee is Non-Refundable & Non-Transferable.</li>
                    <li>BEI guarantees a minimum of 12 Enquiries in an year, irrespective of the number of Hires for the Registered Equipment.</li>
                    <li>Only Paid customers will receive Enquiries for their Equipments.</li>
                    <li>A one time Commission of 10% of First Month’s rent will be charged by BEI for the one year period.</li>
                    <li>BEI reserves the right to Accept or Reject any Equipment based on various factors such as  Authenticity, Legitimacy, Information provided etc.</li>
                </ul>
            </div>
        </div>

    </div>
    <div class="main_inner_head light-head">
        <h3>Sale Pricing</h3>
    </div>
    <div class="row mt-30">
        <div class="pricing-table">
            <table class="table pricing-table">
                <tr>
                    <th rowspan="1">CATEGORY</th>
                    <th rowspan="1">SUB-CATEGORY</th>
                    <th rowspan="1">CAPACITY (TONS/KN/KVA/Cu.Mtr)</th>
                    <th rowspan="1">PRICE TAG ( <i class="fa fa-inr" aria-hidden="true"></i> ) </th>
                    <th rowspan="1">VALIDITY</th>
                    <th colspan="1">ACTION</th>
                </tr>
<!--                                <tr><td class="bold">Supply</td><td class="bold">Sell</td></tr>-->
                <tr class="red_bg_table">
                    <td rowspan="2" class="bold">CRANES</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>0 - 50</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="red_bg_table">
                    <td>ALL SUB-CATEGORIES </td>
                    <td>51 & above</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="yellow_bg_table">
                    <td rowspan="4" class="bold">PILING RIGS</td>
                    <td>CONVENTIONAL  </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="yellow_bg_table">
                    <td>TRUCK MOUNTED   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="yellow_bg_table">
                    <td>ROTORY & HYDRAULIC   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="yellow_bg_table">
                    <td>DIAPHRAGM WALL   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="grey_bg_table">
                    <td rowspan="2" class="bold">EXCAVATORS</td>
                    <td>BACK-HOE LOADER   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="grey_bg_table">
                    <td>REMAINING SUB-CATEGORIES   </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(10000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="red_bg_table">
                    <td class="bold">DUMPERS</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
                <tr class="yellow_bg_table">
                    <td class="bold">GENERATORS</td>
                    <td>ALL SUB-CATEGORIES </td>
                    <td>ALL CAPACITIES</td>
                    <td><?php echo number_format(5000, 2); ?></td>
                    <td>1 YEAR</td>
<!--                    <td><?php
                        if (Yii::$app->user->isGuest)
                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                        else
                            echo '<a href="addproduct?product_type=hire&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                        ?></td>-->
                                        <td><?php
                    if (Yii::$app->user->isGuest)
                        echo '<a href="login" class="btn btn-bei">Order Now</a>';
                    else
                        echo '<a href="addproduct?product_type=sale&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                    ?></td>
                </tr>
            </table>
            <div class="tmslist">
                <h4>Terms & conditions for Equipment pricing (BUY & SELL) :</h4>
                <ul class="">
                    <li>The Registration Fee is for one Equipment only.</li>
                    <li>Upto 7 images can be uploaded for one Equipment.</li>
                    <li>The Registration Fee is valid for one year, from the date of Registration.</li>
                    <li>The Fee is Non-Refundable & Non-Transferable.</li>
                    <li>BEI guarantees a minimum of 12 Enquiries in an year.</li>
                    <li>Only Paid customers will receive Enquiries for their Equipments.</li>
                    <li>A commission of 2% of Sale value will be charged by BEI.</li>
                    <li>BEI reserves the right to Accept or Reject any Equipment based on various factors such as  Authenticity, Legitimacy, Information provided etc.</li>

                </ul>

            </div>
        </div>

    </div>
        <?php if(strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']) >= strtotime(date('Y-m-d'))){ ?>
        <div class="main_inner_head light-head">
		<h3>Promotional Offer on Supply / Sale</h3>
	</div>
	<div class="row mt-30">
		<div class="pricing-table">
			<table class="table pricing-table">
				<tr>
                                    <th rowspan="2">CATEGORY</th>
                                    <th rowspan="2">SUB-CATEGORY</th>
                                    <th rowspan="2">CAPACITY (TONS/KN/KVA/Cu.Mtr)</th>
                                    <th rowspan="2">PRICE TAG ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
                                    <th rowspan="2">VALIDITY</th>
                                    <th colspan="2">ACTION</th>
				</tr>
                                <tr><td class="bold">Supply</td><td class="bold">Sell</td></tr>
				<tr class="red_bg_table">
					<td rowspan="2" class="bold">CRANES</td>
					<td>ALL SUB-CATEGORIES </td>
					<td>0 - 50</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=1&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="red_bg_table">
					<td>ALL SUB-CATEGORIES </td>
					<td>51 & above</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=1&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td rowspan="4" class="bold">PILING RIGS</td>
					<td>CONVENTIONAL  </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=5&sub_category=30&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td>TRUCK MOUNTED   </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=5&sub_category=31&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td>ROTORY & HYDRAULIC   </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=5&sub_category=29&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td>DIAPHRAGM WALL   </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=5&sub_category=32&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="grey_bg_table">
					<td rowspan="2" class="bold">EXCAVATORS</td>
					<td>BACK-HOE LOADER   </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=3&sub_category=17&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="grey_bg_table">
					<td>REMAINING SUB-CATEGORIES   </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=3&package_amount=10000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="red_bg_table">
					<td class="bold">DUMPERS</td>
					<td>ALL SUB-CATEGORIES </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=2&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td class="bold">GENERATORS</td>
					<td>ALL SUB-CATEGORIES </td>
					<td>ALL CAPACITIES</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=hire&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="addproduct?product_type=sale&category=5&package_amount=5000" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
			</table>
			
                    
                    
		</div>
		
	</div>
        <?php } ?>
	<div class="main_inner_head light-head">
		<h3>Advertisement</h3>
	</div>
	<div class="row mt-30">
		<table class="table pricing-table">
				<tr>
					<th>CATEGORY</th>
					<th>SLABS ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
					<th>VALIDITY</th>
                                        <th>ACTION</th>
				</tr>
				<tr class="red_bg_table">
					<td>1 MONTH</td>
					<td><?php echo number_format(50000,2); ?></td>
					<td>1 MONTH</td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="'.Yii::$app->params['SITE_URL'].'?package=1" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="yellow_bg_table">
					<td>3 MONTHS</td>
                                        <td><?php echo number_format(150000,2); ?></td>
					<td>3 MONTHS + 1 MONTHS</td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="'.Yii::$app->params['SITE_URL'].'?package=2" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="grey_bg_table">
					<td>6 MONTHS</td>
                                        <td><?php echo number_format(300000,2); ?></td>
					<td>6 MONTHS + 3 MONTHS</td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="'.Yii::$app->params['SITE_URL'].'?package=3" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				<tr class="red_bg_table">
					<td>8 MONTHS</td>
                                        <td><?php echo number_format(400000,2); ?></td>
					<td>8 MONTHS + 4 MONTHS</td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="'.Yii::$app->params['SITE_URL'].'?package=4" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
			</table>
            
            <div class="tmslist">                    
                    
                    <h4>Terms & conditions for Equipment pricing (ADS) :</h4>
                    <ul class="">
                        <li>The Fee is for one Advertisement only.</li>
                        <li>The Fee is valid for the specified duration from the date of registration.</li>
                        <li>The Fee is Non-Refundable & Non-Transferable.</li>
                        <li>Upto 7 images can be uploaded for one Advertisement.</li>
                        <li>Objectionable images will be rejected and Advertisement may be Black-listed.</li>
                        <li>Correct and Accurate URL should be provided  in order to be able to redirect it upon clicking the Advt image.</li>
                        <li>Pictures will be scrolled every 5 seconds.</li>
                        <li>BEI reserves the right to Accept or Reject any Advertisement based on various factors such as  Authenticity, Legitimacy, Information provided etc.</li>
                        
                    </ul>
		</div>
	</div>
        <?php if(strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO']) >= strtotime(date('Y-m-d'))){ ?>
        <div class="main_inner_head light-head">
		<h3>Promotional Offer on Advertisement</h3>
	</div>
	<div class="row mt-30">
		<table class="table pricing-table">
				<tr>
					<th>CATEGORY</th>
					<th>SLABS ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
					<th>VALIDITY</th>
                                        <th>ACTION</th>
				</tr>
				<tr class="red_bg_table">
					<td>PROMOTIONAL</td>
					<td>FREE</td>
					<td><?= date('F dS, Y',strtotime(Yii::$app->params['PROMOTIONAL_OFFER_UPTO'])) ?></td>
                                        <td><?php 
                                        if(Yii::$app->user->isGuest)
                                            echo '<a href="login" class="btn btn-bei">Order Now</a>';
                                        else
                                            echo '<a href="'.Yii::$app->params['SITE_URL'].'?package=0" class="btn btn-bei">Order Now</a>';
                                        ?></td>
				</tr>
				
			</table>
	</div>
        <?php } ?>
	<h4 class="text-dei"><i>*All the above prices are excluding taxes, GST of 18% will be added on all the prices above on submission</i></h4>
</div>