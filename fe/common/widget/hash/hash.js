/*
 * from jquery hash
 *
 */


var hash = function(name, value) {
    // jQuery doesn't support a is string judgement, so I made it by myself.
    function isString(obj) {
        return typeof obj == "string" || Object.prototype.toString.call(obj) === "[object String]";
    }
    if (!isString(name) || name == "") {
        return;
    }

    var clearReg = new RegExp("(&" + name + "=[^&]*)|(\\b" + name + "=[^&]*&)|(\\b" + name + "=[^&]*)", "ig");
    var getReg   = new RegExp("&*\\b" + name + "=[^&]*", "i");
    if (typeof value == "undefined") {
        // get name-value pair's value
        // var result = location.hash.match(getReg);

        // when get hash from location.hash in Firefox, it's already uri decoded(that is percent decoded)
        // different from Chrome, Chrome's location.hash is not.
        // and to get around this cross-browser compatibility issue,
        // when we want the value through **getReg**,
        // we use the hash in **location.href** which is consistent in all browsers and the hash is not decoded
        var location_hash = location.href.replace(/^[^#]*#?(.*)$/, '$1');

        var result = location_hash.match(getReg);

        return result ? decodeURIComponent($.trim(result[0].split("=")[1])) : null;
    }
    else if (value === null) {
        // remove a specific name-value pair
        location.hash = location.hash.replace(clearReg, "");
    }
    else {
        value = value + "";

        // clear all relative name-value pairs
        var temp = location.hash.replace(clearReg, "");

        // build a new hash value-pair to save it
        temp += ((temp.indexOf("=") != -1) ? "&" : "") + name + "=" + encodeURIComponent(value);
        location.hash = temp;
    }
};


var _pri = {
    util: {
        changeEvent: function () {
            console.log(1);
        },
        changeCheck: function () {
            var fnDelay = 100,
                hash = window.location.hash;

            //判断是否支持hashchange事件
            if(typeof window.onhashchange === 'object'  || typeof window.onhashchange === 'undefined'){
                window.setInterval(function(){
                    var newhash = window.location.hash;
                    if(newhash !== hash){
                        _pri.util.changeEvent();
                        hash = newhash;
                    }
                }, fnDelay);
            }else{
                window.onhashchange = _pri.util.changeEvent();
            }
        }
    }
};

var init = function () {
    _pri.util.changeCheck();
};

init();

module.exports = hash;


