var padKeys = [
	"1", "2", "3", "4", "5", "6", "7", "8", "9", "0",
	"+", "-", "*", "/",
	"C", "%", "="
];
var app = document.getElementById("calc");
var pad = app.querySelectorAll("#buttons");
var buttons = pad.querySelectorAll("button");

document.addEventListener("keypress", function(e) {
	if (padKeys.indexOf(e.key) > -1) {
		// button found
	}
	console.log(e);
});