var country_arr = new Array("Afghanistan", "Albania", "Algeria", "American Samoa", "Angola", "Anguilla", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia And Herzegowina", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cayman Islands", "Central African Republic", "Chad", "China", "Chile", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo The Democratic Republic", "Cook Islands", "Costa Rica", "Cote d Ivoire (Ivory Coast)", "Croatia", "Cyprus", "Czech Republic", "Denmark", "Dominican Republic", "Egypt", "El Salvador", "Estonia", "Falkland Islands (Malvinas)", "Fiji", "Finland", "France (Includes Monaco)", "French Guiana", "Gambia", "Germany", "Gibraltar", "Greece", "Greenland", "Grenada", "Guatemala", "Guyana", "Guam", "Haiti", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Ireland", "Israel", "Italy", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kuwait", "Laos", "Latvia", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Malaysia", "Maldives", "Malta", "Marshall Islands", "Martinique", "Mauritius", "Mexico", "Montenegro", "Morocco", "Myanmar (Burma)", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nigeria", "Norway", "Pakistan", "Palestinian Territory Occupied", "Panama", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Paraguay", "Qatar", "Romania", "Russian", "Saudi Arabia", "Scotland", "Serbia", "Singapore", "Slovak Republic", "Slovenia", "South Africa", "Spain", "Sri Lanka", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor Leste", "Tunisia", "Turkey", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguai", "Venezuela", "Vietnam", "Wales", "Yugoslavia", "Zambia");

var us = "Armed Forces America|Armed Forces Europe|Armed Forces Pacific|Alabama|Alaska|Arizona|Arkansas|California|Colorado|Connecticut|Delaware|District of Columbia|Florida|Georgia|Hawaii|Idaho|Illinois|Indiana|Iowa|Kansas|Kentucky|Louisiana|Maine|Maryland|Massachusetts|Michigan|Minnesota|Mississippi|Missouri|Montana|Nebraska|Nevada|New Hampshire|New Jersey|New Mexico|New York|North Carolina|North Dakota|Ohio|Oklahoma|Oregon|Pennsylvania|Rhode Island|South Carolina|South Dakota|Tennessee|Texas|Utah|Vermont|Virginia|Washington|West Virginia|Wisconsin|Wyoming";

var uk = "Aberdeenshire|Anglesey|Angus|Antrim|Argyll|Armagh|Avon|Ayrshire|Banffshire|Bedfordshire|Berkshire|Berwickshire|BuckinghamShire|Bute|Caithness|Cambridgeshire|Carmarthenshire|Cheshire|Clackmannanshire|Cleveland|Clwvd|Comwall|Cumbria|Denbighshire|Derbyshire|Devon|Dorset|Down|Dumfriesshire|Dumbartonshire|Durham|Dyfed|East Lothian|East Sussex|Essex|Fermanagh|Fife|Flintshire|Glamorgan|Gloucestershire|Greater London|Greater Manchester|Gwent|Gwynedd|Hampshire|Herefordshire|Hertfordshire|Inverness-shire|Isle of Islay|Isle of Lewis|Isle of Man|Isle of Skye|Isle of Wight|Isles of Scilly|Kent|Kincardineshire|Kinross-shire|Kirkcudbrightshire|Lanarkshire|Lancashire|Leicestershire|Lincolnshire|Londonderry|Merseyside|Mid Glamorgan|Middlesex|Midlothian|Moray|Nairnshire|Norfolk|North Humberside|North Yorkshire|Northamptonshire|Northumberland|Nottinghamshire|Orkney|Oxfordshire|Peeblesshire|Pembrokeshire|Perthshire|Powys|Renfrewshire|Roxburghshire|Rutland|Selkirkshire|Shetland|Shropshire|Somerset|South Glamorgan|South Humberside|South Yorkshire|Staffordshire|Stirlingshire|Suffolk|Surrey|Sutherland|Tyne and Wear|Tyrone|Warwickshire|West Glamorgan|West Lothian|West Midlands|West Sussex|West Yorkshire|Wigtownshire|Wiltshire|Worcestershire";

function print_country(country_id) {
	// given the id of the <select> tag as function argument, it inserts <option> tags
	var option_str = document.getElementById(country_id);
	option_str.length = 0;
	option_str.options[0] = new Option('Select Country', '');
	option_str.selectedIndex = 0;
	for (var i = 0; i < country_arr.length; i++) {
		option_str.options[option_str.length] = new Option(country_arr[i], country_arr[i]);
	}
}

function print_state(state_id, state_index) {
	var state = $("#" + state_id);
	//140美国 139英国
	if (state_index != 139 && state_index != 140) {
		state.before("<input name=\"" + state_id + "\" id=\"" + state_id + "\"   type=\"text\" />");
	} else {
		state.before("<select name=\"" + state_id + "\" id=\"" + state_id + "\"></select>");
		var option_str = document.getElementById(state_id);
		option_str.length = 0;
		option_str.options[0] = new Option('Select State', '');
		option_str.selectedIndex = 0;
		var state_arr;
		//140美国 139英国判断是要取那里国家下的数组
		if ( state_index = 139) {
			state_arr = uk.split("|");
		} else {
			state_arr = us.split("|");
		}

		for (var i = 0; i < state_arr.length; i++) {
			option_str.options[option_str.length] = new Option(state_arr[i], state_arr[i]);
		}
	}
	state.remove();
}
