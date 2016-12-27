var a = ['a', 'b', 'c'];
document.writeln(['a', 'b', 'c'].concat(['x', 'y', 'z'], true).toString());

a.push('d');
document.writeln(a.toString());

var m = ['aa', 'bb', 'a', 4, 8, 15, 16, 23, 42];
document.writeln(m.toString());
m.sort(function (a, b) {
    if (a === b) {
        return 0;
    }
    if (typeof a === typeof b) {
        return a < b ? -1 : 1;
    }
    return typeof a < typeof b ? -1 : 1;
});

document.writeln(m.toString());

var by = function(name) {
    return function(o, p) {
        var a, b;
        if (typeof o === 'object' && typeof p === 'object' && o && p) {
            a = o[name];
            b = p[name];
            if (a === b) {
                return 0;
            }
            if (typeof a === typeof b) {
                return a < b ? -1 : 1;
            }
            return typeof a < typeof b ? -1 : 1;
        } else {
            throw {
                name: 'Error',
                message: 'Expected an object when sorting by ' + name
            }
        }
    };
};

var s = [
    {first: 'Joe', last: 'Besser'},
    {first: 'Moe', last: 'Howard'},
    {first: 'Joe', last: 'DeRita'},
    {first: 'Shemp', last: 'Howard'},
    {first: 'Larry', last: 'Fine'},
    {first: 'Curly', last: 'Howard'}
];
document.writeln(s.toString());
s.sort(by('first'));
document.writeln(s.toString());