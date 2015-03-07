/**
     * 文章发布js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
 
   'use strict';
var qiniu = require("common:widget/qiniu/qiniu.js");
//var plupload = require("common:widget/qiniu/plupload.full.min.js");

    //私有方法
    var _pri = {
        //UI元素集合
        node: {
              mod: $('section[node-type="ldsn-edit-article"]'),
              editModule: $('section[node-type="module-edit-article"]'),
        },
        //绑定元素事件
        bindUI: function () {
             
                    },
        util: {
          initEdit: function (){//页面初始化函数
                        
                    }
              }
    }

    /**
     * 如果页面需要加载后运行某些函数
     * 需要定义init()代表初始化 并执行
     */
  
      var init = function () {
        _pri.util.initEdit();
        _pri.bindUI();
    }

    init();

