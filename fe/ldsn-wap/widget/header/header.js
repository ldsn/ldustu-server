    /**
     * 页面标题修改
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
    'use strict';

    //私有方法
    var _pri = {
        //UI元素集合
        node: {
        	mod: $('section[node-type="module-header"]'),
        	header: $('h1[node-type="header-title"]')
        }
    }

    var _pub = {
        setTitle: function (title) {
        	_pri.node.mod.find(_pri.node.header).text(title);
        }
    }

    module.exports = _pub;