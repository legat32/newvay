<html>
<body>
<input id="address" name="address" type="text" size="100"/>
<input id="address-region" name="reg" type="text" size="50"/>
<link href="https://dadata.ru/static/css/suggestions.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!--[if lt IE 10]>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
<![endif]-->
<script type="text/javascript" src="https://dadata.ru/static/js/jquery.suggestions-4.2.min.js"></script>
<script type="text/javascript">
    /*
	$("#address").suggestions({
        serviceUrl: "https://dadata.ru/api/v1/suggest/address",
        token: "1a85eb31e8a63ce56ad07518d2147ecb8e3a5cb6",
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });
	*/
	
	
	$("#address").suggestions({
		serviceUrl: "https://dadata.ru/api/v1/suggest/address",
		token: "1a85eb31e8a63ce56ad07518d2147ecb8e3a5cb6",
		selectOnSpace: true,
		maxHeight: 610,
		//onSearchStart: self.forceMoscow,
		//onSearchComplete: self.trimResults,
		//formatResult: self.formatResult,
		onSelect: function(suggestion) {
			if (suggestion.data) {
				//this.value = self.formatSelected(suggestion);
				self.showSelected(suggestion);
				}
			}
		});


	function showSelected(suggestion) {
		var address = suggestion.data;
		//$("#address-postal_code").val(address.postal_code);
		$("#address-region").val( address.region_type + " " + address.region);
		/*
		$("#address-city").val(join([
			join([address.area_type, address.area], " "),
			join([address.city_type, address.city], " "),
			join([address.settlement_type, address.settlement], " ")
		]));
		$("#address-street").val(
			join([address.street_type, address.street], " ")
		);
		$("#address-house").val(
			join([address.house_type, address.house], " ")
		);
		*/
		} 
		
		
	function forceMoscow(params) {
    var query = params["query"];
    var pattern = /Москва/i;
    if (!pattern.test(query)) {
        query = "Москва " + query;
    }
    params["query"] = query;
}

		
	function trimResults(query, suggestions) {
		//suggestions.splice(0,3);
		//alert(suggestions[0].data.region);
		suggestions = suggestions.splice(0,1);
		alert(suggestions.length);
		/*suggestions.forEach(function (suggestion) {
			suggestion.value = suggestion.value.replace("Россия, ", "");
			})
		*/
		} 

	
</script>
</body>
</html>