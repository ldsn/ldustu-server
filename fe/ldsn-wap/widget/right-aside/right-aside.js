/**
     * 菜单js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
    'use strict';
var Smooth = require("common:widget/smooth/smooth.js");

    //私有方法
    var _pri = {
        //UI元素集合
        node: {
          mod: $('section[node-type="ldsn-right"]'),
          rightClick:$("click[node-type='right-click']"),
          ldsnBox:$("section[node-type='ldsn-box']"),
          ldsnMainFrame:$("section[node-type='ldsn-main-frame']"),
        },
        //绑定元素事件
        bindUI: function () {
  _pri.node.rightClick.on("click",_pri.util.rightSlide);//右侧滑出事件
  _pri.node.ldsnMainFrame.on("click",_pri.util.clearRightSlide)//清除右侧
  _pri.node.ldsnMainFrame.swipeRight(function () {//右滑清除右侧
    var boxLeft = _pri.node.ldsnBox.css("margin-left");
    if(boxLeft=="-200px"){
            _pri.util.rightSlide
          }else{
            _pri.util.clearRightSlide
          }
  });
  _pri.node.ldsnBox.swipeLeft(_pri.util.rightSlide);//左滑呼出右侧
  },
        util: {
          rightSlide: function(){//右侧滑出事件函数
            _pri.node.ldsnBox.css("margin-left","-300px");
            _pri.node.ldsnMainFrame.css("display","block")
            _pri.node.rightClick.css("-webkit-transform","rotateY(180deg)")
          },
          clearRightSlide: function(){//右侧清除函数
            _pri.node.ldsnBox.css("margin-left","-200px");
            _pri.node.ldsnMainFrame.css("display","none")
             _pri.node.rightClick.css("-webkit-transform","rotateY(0deg)")
          },
          initMenu: function (){//页面初始化函数
        _pri.node.mod.css("height", $(window).height());
          }
        }
    }

    /**
     * 如果页面需要加载后运行某些函数
     * 需要定义init()代表初始化 并执行
     */
  
      var init = function () {
        _pri.util.initMenu();
        _pri.bindUI();
    }

    init();
