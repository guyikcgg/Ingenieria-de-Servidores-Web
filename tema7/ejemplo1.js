function isEven(n) {
    return n%2?false:true;
}

function fact(n) {
    var ret = 1;
    for (var i = 1; i <= n; i++) {
        ret *= i;
    }
    return ret;
}
