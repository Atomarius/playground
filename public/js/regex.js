var parse_url = /^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^?#]*))?(?:#([^?#]*))?$/;

var url = "http://www.ora.com:80/goodparts?q#fragment";

var result = parse_url.exec(url);

var names = ['url', 'scheme', 'slash', 'host', 'port', 'path', 'query', 'hash'];

var blanks = '        ';
var i;
for (i = 0; i < names.length; i++) {
    document.writeln(names[i] + ':' + blanks.substr(names[i].length) + result[i]);
}

var parse_number = /^-?\d+(?:\.\d*)?(?:e[+\-]?\d+)?$/i;

var test = function (num) {
    document.writeln(parse_number.test(num).toString())
};

test('1');
test('number');
test('98.6');
test('132.21.86.100');
test('123.45E-67');
test('123.45D-67');

var my_regexp = new RegExp("\"(?:\\\\.|[^\\\\\\\"])*\"", 'g');

var make_a_matcher = function() {
    return /a/gi;
};

var x = make_a_matcher();
var y = make_a_matcher();

x.lastIndex = 10;

document.writeln(y.lastIndex);
document.writeln(x.lastIndex);

"into".match(/in|int/);