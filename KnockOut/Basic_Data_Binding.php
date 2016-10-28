<!DOCTYPE html PUBLIC "-W3C//DTD XHTML 1.0 Strict//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- // http://learn.knockoutjs.com/#/?tutorial=intro -->
<html xmlns="http: //www.w3.org/1999/xhtml" xml: lang="en" lang="en">
<head>
    <title>Knockout Test</title>
 
    
</head>

<body>
    <!-- This is a *view* - HTML markup that defines the appearance of your UI -->
	<p>First name: <strong data-bind="text: firstName"></strong></p>
	<p>Last name: <strong data-bind="text: lastName"></strong></p>

	<p>First name: <input data-bind="value: firstName" /></p>
	<p>Last name: <input data-bind="value: lastName" /></p>

	<p>Full name: <strong data-bind="text: fullName"></strong></p>
	<button data-bind="click: capitalizeLastName">Go caps</button>
	<!-- <script src="/includes/knockoutjs-3.4.0/knockoutjs.js" type="text/javascript"></script> --> 
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js" type="text/javascript"></script> -->
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-3.3.0.js" type="text/javascript"></script>
 
    <script type="text/javascript">
		// This is a simple *viewmodel* - JavaScript that defines the data and behavior of your UI
		function AppViewModel() {
    		this.firstName = ko.observable("Bert");
    		this.lastName = ko.observable("Bertington");

    		this.fullName = ko.computed(function() {
        		return this.firstName() + " " + this.lastName();    
    		}, this);

    		this.capitalizeLastName = function() {
	        	var currentVal = this.lastName();        // Read the current value
    	    	this.lastName(currentVal.toUpperCase()); // Write back a modified value
    		};	
		}

		// Activates knockout.js
		ko.applyBindings(new AppViewModel());
	</script>
</body>

</html>