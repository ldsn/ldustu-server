/**
     * 菜单js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
    'use strict';

var data = {
            "id": "3",              //文章id
            "uid": "1",             //用户id
            "cid": "1",             //分类id
            "visite": "0",          //访问数
            "favour": "10",         //点赞数
            "common": "10",         //评论数
            "username": "用户名",    //用户名
            "category": "新闻",      //版块名称
            "ismake": "1",          //审核
            "title": "",            //题目
            "description": "",      //简介
            "time": "" ,             //时间
            "image": "" ,             //时间
            "from": "人人都是产品经理"
}
var tmpl = require('ldsn-wap:widget/article/article.tpl.js');

    //私有方法
    var _pri = {
        //UI元素集合
        node: {
        	mod: $('section[node-type="module-article"]'),
        },
        //绑定元素事件
        bindUI: function () {
          $().on("click",_pri.util.openArticle)
	
	},
        util: {
              openArticle: function (){//页面初始化函数
              _pri.node.mod.addClass("article-box")
              _pri.node.mod.append(ldev.tmpl(_pri.tmpl.tmpl,data))
              },
        	initBox: function (){//页面初始化函数
                console.log(111)
        	}
        },
        tmpl: {
              tmpl: tmpl.join('')
        },
    }

    /**
     * 如果页面需要加载后运行某些函数
     * 需要定义init()代表初始化 并执行
     */
  
      var init = function () {
      	_pri.util.initBox();
      	_pri.bindUI();
       //_pri.util.openArticle();
    }

    init();
