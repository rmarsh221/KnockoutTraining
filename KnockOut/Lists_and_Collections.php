<!DOCTYPE html PUBLIC "-W3C//DTD XHTML 1.0 Strict//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- // http://learn.knockoutjs.com/#/?tutorial=intro -->
<html xmlns="http: //www.w3.org/1999/xhtml" xml: lang="en" lang="en">
<head>
    <title>Knockout Test</title>
 
    
</head>

<body>
<h2>Your seat reservations (<span data-bind="text: seats().length"></span>)</h2>

<button data-bind="click: addSeat, enable: seats().length < 5">Reserve another seat</button>
<table>
    <thead><tr>
        <th align="right">Passenger name</th><th align="right">Meal</th><th align="right">Surcharge</th><th align="right"></th>
    </tr></thead>
    <!-- Todo: Generate table body -->
    <tbody data-bind="foreach: seats">
    <tr>
        <td><input data-bind="value: name" /></td>
        <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'"></select></td>
        <td align="right" data-bind="text: formattedPrice"></td>
        <td><button href="#" data-bind="click: $root.removeSeat">Remove</button></td>
    </tr>    
</tbody>
</table>
<h4 data-bind="visible: totalSurcharge() > 0">
    Total surcharge: $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
</h4>

    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-3.3.0.js" type="text/javascript"></script>
 
    <script type="text/javascript">
        // Class to represent a row in the seat reservations grid
        function SeatReservation(name, initialMeal) {
            var self = this;
            self.name = name;
            self.meal = ko.observable(initialMeal);
    
            self.formattedPrice = ko.computed(function() {
                var price = self.meal().price;
                return price ? "$" + price.toFixed(2) : "$0.00";        
            });
        }

        // Overall viewmodel for this screen, along with initial state
        function ReservationsViewModel() {
            var self = this;

        // Non-editable catalog data - would come from the server
        self.availableMeals = [
            { mealName: "Standard (sandwich)", price: .50 },
            { mealName: "Premium (lobster)", price: 34.95 },
            { mealName: "Ultimate (whole zebra)", price: 290 }
        ];    

        // Editable data
        self.seats = ko.observableArray([
            new SeatReservation("Steve", self.availableMeals[1]),
            new SeatReservation("Bert", self.availableMeals[0])
        ]);
        
        // Operations
        self.addSeat = function() {
            self.seats.push(new SeatReservation("Ray", self.availableMeals[2]));
        }
        self.removeSeat = function(seat) { self.seats.remove(seat) }
        
        // ko.computed property
        self.totalSurcharge = ko.computed(function() {
           var total = 0;
           for (var i = 0; i < self.seats().length; i++)
               total += self.seats()[i].meal().price;
           return total;
    });
    }

        ko.applyBindings(new ReservationsViewModel());
    </script>
</body>

</html>