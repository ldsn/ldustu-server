/**
     * 菜单js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
    'use strict';
var Smooth = require("common:widget/smooth/smooth.js");

var data = [
        {
            "cid": 1,
            "name": "新闻"
        },
        {
            "cid": 2,
            "name": "娱乐"
        },
        {
            "cid": 4,
            "name": "搞笑"
        },
        {
            "cid": 5,
            "name": "趣事"
        },
        {
            "cid": 7,
            "name": "频道"
        }
    ]
    //私有方法
    var _pri = {
        //UI元素集合
        node: {
        	mod: $('menu[node-type="ldsn-menu"]'),
        	menuList:$('section[node-type="menu-list"]'),
        	menuClick:$("click[node-type='menu-click']"),
              rightClick:$("click[node-type='right-click']"),
        	ldsnBox:$("section[node-type='ldsn-box']"),
              editClick:$('click[node-type="right-click"]'),
        	ldsnMainFrame:$("section[node-type='ldsn-main-frame']"),
              editArticle:$("section[node-type='module-edit-article']")
        },
        //绑定元素事件
        bindUI: function () {
<<<<<<< HEAD
        	_pri.node.menuClick.on("click",_pri.util.leftSlide);//菜单点击事件
        	// _pri.node.ldsnMainFrame.on("click",_pri.util.clearLeftSlide)//清除菜单
        	_pri.node.ldsnBox.swipeRight(_pri.util.leftSlide);
            _pri.node.ldsnBox.swipeLeft(_pri.util.clearLeftSlide);
            _pri.node.editClick.on("click",function(){
                _pri.node.editArticle.css("display","block");
                window.checkPlupload = false;
                var script = document.createElement("script");
                script.src="/static/common/plupload/plupload.min.js";
                script.type="text/javascript";
                document.body.appendChild(script);
                window.setInterval(function () {
                    if(window.checkPlupload) {
                        require("ldsn-wap:widget/upload-image/upload-image.js");
                    }
                },40)
            }) 
        },
=======
            	_pri.node.menuClick.on("click",_pri.util.leftSlide);//菜单点击事件
            	_pri.node.ldsnMainFrame.on("click",_pri.util.clearLeftSlide)//清除菜单
            	_pri.node.ldsnBox.swipeRight(_pri.util.leftSlide);
              _pri.node.ldsnBox.swipeLeft(_pri.util.clearLeftSlide);
              _pri.node.editClick.on("click",function(){
                      _pri.util.editClick()
                  }) 
            	},
>>>>>>> 7f59d14b16f914234a6dadc7772c90a82c8c81a3
        util: {
        	leftSlide: function(){//左滑事件函数
        		_pri.node.ldsnBox.css("margin-left","0px");
                            _pri.node.ldsnMainFrame.css("display","block")
        	},
        	clearLeftSlide: function(){//清除菜单函数
        		_pri.node.ldsnBox.css("margin-left","-200px");
        		_pri.node.ldsnMainFrame.css("display","none")
        	},
              editClick:function(){
                            _pri.node.editArticle.css("display","block")
                           var script = document.createElement("script");
                                  script.src="/static/common/plupload/moxie.js";
                            var script1 = document.createElement("script");
                                  script1.src="/static/common/plupload/plupload.min.js";
                            document.body.appendChild(script)
                            document.body.appendChild(script1)
              },
        	initMenu: function (){//页面初始化函数
    		_pri.node.mod.css("height", $(window).height());
                            _pri.node.ldsnBox.css("transition","margin-left 1s");
	    	for(var i = 0; i < data.length; i++){
	    		_pri.node.menuList.append("<click cid='"+data[i].cid+"'>"+data[i].name+"</click>");
	    	}
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
