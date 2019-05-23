const keys = {
	numbers: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"],
	operators: ["+", "-", "*", "/", "%"],
	actions: ["C", "c", "N", "n", "="],
};
keys.all = [].concat(keys.numbers, keys.operators, keys.actions);

const calc = {
	prev: "",
	current: "0",
	operator: "",
	result: ""
};

const app = document.getElementById("calc");
const display = {
	prev: app.querySelector("#display-prev"),
	operator: app.querySelector("#display-operator"),
	now: app.querySelector("#display-now")
};
const pad = app.querySelector("#buttons");
const buttons = pad.querySelectorAll("button");

// click on button
const goButton = (code) => {
	buttons.forEach(function (el) {
		if (code.toUpperCase() === el.getAttribute("data-value")) {
			// onPad()
			el.click();
		}
	});
}
// handle keyboard events
const onKeyboard = (e) => {
	if (keys.all.indexOf(e.key) > -1) {
		// button found
		goButton(e.key);
	}
	if (13 === e.which) {
		// enter button pressed  - =
		goButton("=");
	}
	if (27 === e.which) {
		// escape button pressed - C
		goButton("C");
	}
}

// handle 
const onPad = (el) => {
	const value = el.target.getAttribute("data-value");
	if (keys.numbers.indexOf(value) > -1) {
		if ("0" === calc.current) {
			calc.current = "" + value;
		} else {
			calc.current = "" + calc.current + value;
		}
	}
	if ("=" === value || keys.operators.indexOf(value) > -1) {
		if ("=" === value) {
			calc.operator = "+";
		} else {
			calc.operator = value;
		}
		calc.prev = "" + calc.prev + " " + calc.operator + " " + calc.current;
		calc.current = "0";
		calculate();
	}
	if ("N" === value) {
		calc.current = "" + (-1 * parseInt(calc.current));
	}
	if ("C" === value) {
		calc.operator = "";
		calc.prev = "";
		calc.current = "0";
	}

	render();
}

const calculate = () => {
	// calc.result = calc.current;

	const xhr = new XMLHttpRequest();
	xhr.open("POST", "/api.php", true);
	xhr.setRequestHeader("Content-Type", "text/plain");

	xhr.onreadystatechange = function () {
		// show result
		if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
		}
		const json = JSON.parse(this.responseText);
		if (false !== json.result && true !== json.result) {
			calc.result = json.result;
		}
		render();
	};

	xhr.send(calc.prev);
}

// render values on display
const render = () => {
	display.now.innerHTML = calc.current;
	display.operator.innerHTML = calc.operator;
	display.prev.innerHTML = calc.prev;
	if ("" != calc.result && "" != calc.operator) {
		display.prev.innerHTML += " = " + calc.result;
	}
}

document.addEventListener("keydown", onKeyboard);
buttons.forEach(btn => {
	btn.addEventListener("click", onPad);
});