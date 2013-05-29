<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>index</title>

		<script src="http://code.jquery.com/jquery.js"></script>
		<style>
			body {
				margin: auto;
				text-align: center;
				width: 1002px;
			}
			a {
				text-decoration: none;
				color: #000000;
			}
			ul {
				padding: 0px;
				margin: 0px;
			}
			li {
				list-style: none;
				margin: 5px;
				float: left;
				width: 200px;
			}
		</style>
	</head>
	<body>


<style>
	.pay_l, .pay_r {
		width: 48%;
		float: left;
		border: 1px solid #CCCCCC;
		margin: 2px;
	}
	.pay_t {
		display: block;
		text-align: left;
		width: 100%;
		clear: both;
	}
	.pay_l p, .pay_r p {
		margin: 0px;
		padding: 5px;
	}
	.pay_l li, .pay_r li {
		width: 80%;
		float: left;
	}
	input[type='text'] {
		width: 70%;
		border: 1px solid #CCCCCC;
		display: inline-block;
	}
</style>
<body>
	<h3>填写收货人信息和账单地址</h3>
	<form method="post" action="__URL__/index1" id="from1">
		<div>
			<div class="pay_t">
				1. Shipping Information
			</div>
			<div class="pay_l">
				<p>
					Shipping Address
				</p>
				<p>
					Exact and complete information is appreciated, or it will fail to delivery to you.
				</p>

				<ul>
					<li>
						<span class="name">First Name:<i class="fixed_red">*</i></span>
						<input id="C_FirstName" name="C_FirstName" value="<?php echo ($customer["C_FirstName"]); ?>" type="text">

					</li>

					<li>
						<span class="name">Last Name:<i class="fixed_red">*</i></span>
						<input id="C_SecondName" name="C_SecondName" value="<?php echo ($customer["C_SecondName"]); ?>" type="text">

					</li>

					<li>
						<span class="name">Address:<i class="fixed_red">*</i></span>
						<input id="C_Address" name="C_Address" size="80" value="<?php echo ($customer["C_Address"]); ?>" type="text">

					</li>

					<li>
						<span class="name">City:<i class="fixed_red">*</i></span>
						<input id="C_City"  name="C_City" value="<?php echo ($customer["C_City"]); ?>" type="text">

					</li>

					<li>
						<span class="name">Country:<i class="fixed_red">*</i></span>
						<select onchange="print_state('sys_state',this.selectedIndex);" id="sys_country" name="C_Country">
							<option value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia And Herzegowina">Bosnia And Herzegowina</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="China">China</option><option value="Chile">Chile</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo The Democratic Republic">Congo The Democratic Republic</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d Ivoire (Ivory Coast)">Cote d Ivoire (Ivory Coast)</option><option value="Croatia">Croatia</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Dominican Republic">Dominican Republic</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Estonia">Estonia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Includes Monaco)">France (Includes Monaco)</option><option value="French Guiana">French Guiana</option><option value="Gambia">Gambia</option><option value="Germany">Germany</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guyana">Guyana</option><option value="Guam">Guam</option><option value="Haiti">Haiti</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Japan">Japan</option><option value="Jamaica">Jamaica</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kuwait">Kuwait</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia">Macedonia</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Pakistan">Pakistan</option><option value="Palestinian Territory Occupied">Palestinian Territory Occupied</option><option value="Panama">Panama</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Paraguay">Paraguay</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian">Russian</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Scotland">Scotland</option><option value="Serbia">Serbia</option><option value="Singapore">Singapore</option><option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option selected="selected" value="South Africa">South Africa</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor Leste">Timor Leste</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguai">Uruguai</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Wales">Wales</option><option value="Yugoslavia">Yugoslavia</option><option value="Zambia">Zambia</option>
						</select>
					</li>
					<li>
						<span class="name">State/province:<i class="fixed_red">*</i></span>
						<input id="sys_state" name="C_State"  size="50" type="text" value="<?php echo ($customer["C_State"]); ?>">
					</li>
					<li>
						<span class="name">Post/Zip Code:<i class="fixed_red">*</i></span>
						<input id="C_PostCode" name="C_PostCode" value="<?php echo ($customer["C_PostCode"]); ?>" type="text">
					</li>
					<li>
						<span class="name">TEL:<i class="fixed_red">*</i></span>
						<input id="C_Tel" name="C_Tel" value="<?php echo ($customer["C_Tel"]); ?>" type="text">
					</li>

					<li>
						<span class="name">Email:<i class="fixed_red">*</i></span>
						<input id="C_Email" name="C_Email" value="<?php echo ($customer["C_Email"]); ?>" type="text">

					</li>
				</ul>
			</div>
			<div class="pay_r">
				<p>
					<span class="pay_t1">Billing Address</span>
				</p>
				<p>
					<input id="copyinfo" onclick="" type="checkbox">
					&nbsp; My billing address is the same as my shipping address.
				</p>
				<ul>
					<li>
						<span class="name">First Name:<i class="fixed_red">*</i></span>
						<input type="text" id="B_FirstName" name="B_FirstName" value="" />

					</li>

					<li>
						<span class="name">Last Name:<i class="fixed_red">*</i></span>
						<input type="text" id="B_SecondName" name="B_SecondName" value="" />

					</li>

					<li>
						<span class="name">Address:<i class="fixed_red">*</i></span>
						<input type="text" id="B_Address" name="B_Address" size="80" value="" />

					</li>

					<li>
						<span class="name">City:<i class="fixed_red">*</i></span>
						<input type="text" id="B_City" name="B_City" value=""  />

					</li>

					<li>
						<span class="name">Country:<i class="fixed_red">*</i></span>
						<select onchange="print_state('sys_state_billing',this.selectedIndex);" id="sys_country_billing" name="B_Country">
							<option value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia And Herzegowina">Bosnia And Herzegowina</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="China">China</option><option value="Chile">Chile</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo The Democratic Republic">Congo The Democratic Republic</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d Ivoire (Ivory Coast)">Cote d Ivoire (Ivory Coast)</option><option value="Croatia">Croatia</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Dominican Republic">Dominican Republic</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Estonia">Estonia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Includes Monaco)">France (Includes Monaco)</option><option value="French Guiana">French Guiana</option><option value="Gambia">Gambia</option><option value="Germany">Germany</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guatemala">Guatemala</option><option value="Guyana">Guyana</option><option value="Guam">Guam</option><option value="Haiti">Haiti</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Japan">Japan</option><option value="Jamaica">Jamaica</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kuwait">Kuwait</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia">Macedonia</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Montenegro">Montenegro</option><option value="Morocco">Morocco</option><option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nigeria">Nigeria</option><option value="Norway">Norway</option><option value="Pakistan">Pakistan</option><option value="Palestinian Territory Occupied">Palestinian Territory Occupied</option><option value="Panama">Panama</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Paraguay">Paraguay</option><option value="Qatar">Qatar</option><option value="Romania">Romania</option><option value="Russian">Russian</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Scotland">Scotland</option><option value="Serbia">Serbia</option><option value="Singapore">Singapore</option><option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option selected="selected" value="South Africa">South Africa</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor Leste">Timor Leste</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguai">Uruguai</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Wales">Wales</option><option value="Yugoslavia">Yugoslavia</option><option value="Zambia">Zambia</option>
						</select>
					</li>
					<li>
						<span class="name">State/province:<i class="fixed_red">*</i></span>
						<input type="text" id="sys_state_billing" name="B_State"  value="" size="50" />

					</li>

					<li>
						<span class="name">Post/Zip Code:<i class="fixed_red">*</i></span>
						<input type="text" id="B_PostCode" name="B_PostCode" value="" id="Text2" />

					</li>

					<li>
						<span class="name">TEL:<i class="fixed_red">*</i></span>
						<input type="text" id="B_Tel" name="B_Tel" value=""/>

					</li>

					<li>
						<span class="name">Email:<i class="fixed_red">*</i></span>
						<input type="text" id="B_Email" name="B_Email"  value=""/>
					</li>
				</ul>

			</div>
			<input type="submit" value="下一步" />
		</div>
		<script>
			$("input[type='checkbox']").click(function() {
				if ($(this).prop("checked")) {
					$("input[name='B_Username']").val($("input[name='C_Username']").val());
					$("input[name='B_FirstName']").val($("input[name='C_FirstName']").val());
					$("input[name='B_SecondName']").val($("input[name='C_SecondName']").val());
					$("input[name='B_Address']").val($("input[name='C_Address']").val());
					$("input[name='B_City']").val($("input[name='C_City']").val());
					$("input[name='B_PostCode']").val($("input[name='C_PostCode']").val());
					$("input[name='B_Tel']").val($("input[name='C_Tel']").val());
					$("input[name='B_Email']").val($("input[name='C_Email']").val());
					$("input[name='B_Country']").val($("input[name='C_Country']").val());
					$("input[name='B_State']").val($("input[name='C_State']").val());

				} else {
					$(".pay_r input").each(function() {
						$(this).val('');
					})
				}
			})
		</script>
</body>
</html>