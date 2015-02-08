/**
 * 检测hash改变
 * @author fanmingfei
 * @date 2015-02-08
 * @version 1.0.0
 */

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

