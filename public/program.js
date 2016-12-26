document.writeln('Hello, World!');

var MYAPP = {};

MYAPP.stooge = {"first-name": "Jerome", "second-name": "Howard"};

document.writeln(MYAPP.stooge["first-name"]);

MYAPP.flight = {
    airline: "Oceanic",
    number: 815,
    departure: {
        IATA: "SYD",
        time: "2004-09-22 14:55",
        city: "Sydney"
    },
    arrival: {
        IATA: "LAX",
        time: "2004-09-23 10:42",
        city: "Los Angeles"
    }
};
MYAPP.flight.equipment = { model: 'Boeing 777' };
MYAPP.flight.status = 'overdue';

var add = function(l, r) { return l + r; };

document.writeln(typeof Object.create);

var myNumber = {
    value: 0,
    increment: function (inc) {
        this.value += typeof inc === 'number' ? inc : 1;
        return this;
    }
};

document.writeln(myNumber.increment().value);
document.writeln(myNumber.increment(2).value);

myNumber.double = function () {
    var that = this;
    var helper = function () {
        that.value = add(that.value, that.value);
        return that;
    };
    return helper();
};

document.writeln(myNumber.double().value);

var Quo = function (status) { this.status = status; };

Quo.prototype.getStatus = function () {
    return this.status;
};

var myQuo = new Quo("confused");

document.writeln(myQuo.getStatus());
document.writeln(add.apply(null, [3,4]));
document.writeln(Quo.prototype.getStatus.apply({status: "A-OK"}));

var sum = function () {
    var i, sum = 0;
    for (i = 0; i < arguments.length; i++) {
        sum += arguments[i];
    }
    return sum;
};

document.writeln(sum(4,8,15,16,23,42));

Function.prototype.method = function (name, func) { if (!this.prototype[name]) { this.prototype[name] = func; } return this; };

Number.method('integer', function () { return Math[this < 0 ? 'ceil' : 'floor'](this); });
document.writeln((-10 / 3).integer());
String.method('trim', function() { return this.replace(/^\s+|\s+$/g,''); });
document.writeln('"' + "   neat   ".trim() + '"');

var walk_the_DOM = function walk(node, func) {
    func(node);
    node = node.firstChild;
    while (node) {
        walk (node, func);
        node = node.nextSibling;
    }
};

var elementsByAttribute = function (att, value) {
    var results = [];

    walk_the_DOM(document.body,
        function (node) {
            var actual = node.nodeType === 1 && node.getAttribute(att);
            if (typeof actual === 'string' && (actual === value || typeof value !== 'string')) {
                results.push(node);
            }
        }
    )
};