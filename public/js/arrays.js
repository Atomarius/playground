var empty = [];

var numbers = [
    'zero', 'one', 'two', 'three', 'four',
    'five', 'six', 'seven', 'eight', 'nine'
];

document.writeln(empty[1]);
document.writeln(numbers[1]);
document.writeln(empty.length.toString());
document.writeln(numbers.length.toString());

var numbers_object = {
    '0': 'zero', '1': 'one', '2': 'two',
    '3': 'three', '4': 'four', '5': 'five',
    '6': 'six', '7': 'seven', '8': 'eight',
    '9': 'nine'
};

var misc = [
    'string', 98.6, true, false, null, undefined,
    ['nested', 'array'], {object: true}, NaN, Infinity
];

document.writeln(misc.length.toString());

var myArray = [];
document.writeln(myArray.length.toString());

myArray[10] = true;
document.writeln(myArray.length.toString());

numbers.length = 3;
document.writeln(numbers.toString());

numbers[numbers.length] = 'shi';
document.writeln(numbers.toString());

numbers.push('go');
document.writeln(numbers.toString());

delete numbers[2];
document.writeln(numbers.toString());

numbers.splice(2, 1);
document.writeln(numbers.toString());

var i;
for (i = 0; i < myArray.length; i++) {
    document.writeln(myArray[i]);
}

var is_array = function (value) {
    return value && typeof value === 'object' && value.constructor === Array;
};

Array.method('reduce', function (func, val) {
    var i;
    for (i = 0; i < this.length; i++) {
        val = func(this[i], val);
    }
    return val;
});

var data = [4, 8, 15, 16, 23, 42];

var add = function (l, r) {
    return l + r;
};

var multiply = function (l, r) {
    return l * r;
};

document.writeln(data.reduce(add, 0));
document.writeln(data.reduce(multiply, 1));

data.total = function () {
    return this.reduce(add, 0);
};

document.writeln(data.total());

Array.dim = function (dimension, initial) {
    var a = [], i;
    for (i = 0; i < dimension; i++) {
        a[i] = initial;
    }
    return a;
};

var myArray = Array.dim(10, 0);
document.writeln(myArray.toString());

var matrix = [
    [0,1,2],
    [3,4,5],
    [6,7,8]
];

document.writeln(matrix[2][1]);

Array.matrix = function (m, n, initial) {
    var a, i, j, mat = [];
    for (i = 0; i < m; i++) {
        a = [];
        for (j = 0; j < n; j++) {
            a[j] = initial;
        }
        mat[i] = a;
    }
    return mat;
};
var myMatrix = Array.matrix(4, 4, 0);

document.writeln(myMatrix[3][3]);

Array.identity =function (n) {
    var i, mat = Array.matrix(n, n, 0);
    for (i = 0; i < n; i++) {
        mat[i][i] = 1;
    }
    return mat;
};

myMatrix = Array.identity(4);
document.writeln(myMatrix[3][3]);
