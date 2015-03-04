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
              _pri.node.ldsnBox.swipeLeft(function (){
                    var menuLeft=_pri.node.ldsnBox.hasClass("slideonLock"); 
                    if(!menuLeft){//左滑呼出右侧
                        _pri.util.rightSlide()
                    }else {//清除右侧
                        _pri.util.leftSlide()
                    }
              });
              },
        util: {
          rightSlide: function(){//右侧滑出事件函数
                    _pri.node.ldsnBox.css("margin-left","-300px");
                    _pri.node.ldsnMainFrame.css("display","block")
                    _pri.node.rightClick.css("-webkit-transform","rotateY(180deg)")
                    _pri.node.ldsnBox.addClass("slideLock");
          },
          leftSlide: function(){//清除左侧滑出事件
                    _pri.node.ldsnBox.css("margin-left","-200px");
                    _pri.node.ldsnMainFrame.css("display","block")
                    _pri.node.ldsnBox.removeClass("slideonLock"); 
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
