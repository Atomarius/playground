var Mammal = function (name) {
    this.name = name;
};
Mammal.prototype.get_name = function () {
    return this.name;
};
Mammal.prototype.says = function () {
    return this.saying || '';
};

var myMammal = new Mammal('Herb the Mammal');

document.writeln(myMammal.get_name());

var Cat = function (name) {
    this.name = name;
    this.saying = 'meow';
};

Cat.prototype = new Mammal();
Cat.prototype.purr = function (times) {
    var i, s = '';
    for (i = 0; i < times; i++) {
        s += s ? '-r' : 'r';
    }
    return s;
};

Cat.prototype.get_name = function () {
    return this.says() + ' ' + this.name + ' ' + this.says();
};

var myCat = new Cat('Henrietta');

document.writeln(myCat.says());
document.writeln(myCat.purr(5));
document.writeln(myCat.get_name());

Function.method('inherits', function(Parent) {
    this.prototype = new Parent();
    return this;
});

var Cat = function (name) {
    this.name = name;
    this.saying = 'meow';
}.inherits(Mammal).method('purr', function(times) {
    var i, s = '';
    for (i = 0; i < times; i++) {
        s += s ? '-r' : 'r';
    }
    return s;
}).method('get_name', function () {
    return this.says() + ' ' + this.name + ' ' + this.says();
});
var myCat = new Cat('Henrietta');
document.writeln(myCat.says());
document.writeln(myCat.purr(5));
document.writeln(myCat.get_name());

var myMammal = {
    name: 'Herb the Mammal',
    get_name: function () {
        return this.name;
    },
    says: function () {
        return this.saying || '';
    }
};

var myCat = Object.create(myMammal);
myCat.name = 'Henrietta';
myCat.saying = 'meow';
myCat.purr = function (times) {
    var i, s = '';
    for (i = 0; i < times; i++) {
        s += s ? '-r' : 'r';
    }
    return s;
};
myCat.get_name = function () {
    return this.says() + ' ' + this.name + ' ' + this.says();
};

document.writeln(myCat.says());
document.writeln(myCat.purr(5));
document.writeln(myCat.get_name());

var mammal = function (spec) {
    var that = {};

    that.get_name = function() {
        return spec.name;
    };

    that.says = function() {
        return spec.saying || '';
    };

    return that;
};

var myMammal = mammal({name: 'Herb'});
document.writeln(myMammal.get_name());

var cat = function (spec) {
    spec.saying = spec.saying || 'meow';
    var that = mammal(spec);
    that.purr = function (times) {
        var i, s = '';
        for (i = 0; i < times; i++) {
            s += s ? '-r' : 'r';
        }
        return s;
    };
    that.get_name = function () {
        return that.says() + ' ' + spec.name + ' ' + that.says();
    };
    return that;
};

var myCat = cat({name: 'Henrietta'});

Object.method('superior', function (name) {
    var that = this, method = that[name];
    return function () {
        return method.apply(that, arguments);
    };
});

var coolcat = function (spec) {
    var that = cat(spec), super_get_name = that.superior('get_name');
    that.get_name = function () {
        return 'like ' + super_get_name() + ' baby';
    };
    return that;
};

myCoolCat = coolcat({name: 'Bix'});
document.writeln(myCoolCat.get_name());

var eventuality = function(that) {
    var registry = {};
    that.fire = function (event) {
        var array, func, handler, i,
            type = typeof event === 'string' ? event : event.type;
        if (registry.hasOwnProperty(type)) {
            array = registry[type];
            for (i = 0; i > array.length; i++) {
                handler = array[i];
                func = handler.method;
                if (typeof func === 'string') {
                    func = this[func];
                }
                func.apply(this, handler.parameters || [event])
            }
        }
        return this;
    };
    that.on = function (type, method, parameters) {
        var handler = { method: method, parameters: parameters };
        if (registry.hasOwnProperty(type)) {
            registry[type].push(handler);
        } else {
            registry[type] = [handler];
        }
        return this;
    };
    return that;
};