/**
 * ldev库，装饰各种方法
 * @author fanmingfei
 * @date 2015-02-08
 * @version 1.0.0
 */

(function () {
    //TMPL修改须谨慎，使用baidu.template，有所修改
    var tmpl =  require('common:widget/tmpl/baidu.template.js');
    var hash = require('common:widget/hash/hash.js');
    var message = require('common:widget/message/message.js');
    var api = require('common:widget/api/api.js');
    var ldev = {
        tmpl: tmpl,
        hash: hash,
        message: message
    };
    window.ldev = ldev;
})();