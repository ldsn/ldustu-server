<<<<<<< HEAD
    /**
     * 简介
     * @author 作者姓名
     * @date 2015-02-04
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
        	//_pri.node.mod.find(_pri.node.header).text(title);
        }
    }

    module.export = _pub.setTitle;
=======


var dom = $('.module-header')
var q = {
	menuBtn: dom.find('.menu'),
	rightBtn: dom.find('.right-aside'),
	rightArrow: dom.find('.right-aside .arrow'),
	menu: $('.ldsn-menu'),
	ldsnBox: $('.ldsn-box'),
	rightAside: $('.ldsn-right'),
	mainFrame: $('.ldsn-main-frame')
}

var bindEvent = function () {
	q.menuBtn.click(function () {
		q.mainFrame.toggleClass('dis');
		if(q.ldsnBox.hasClass('menu')) {
			q.ldsnBox.css({
				"-webkit-transform":'translateX(200px)',
				"transform":'translateX(200px)'
			})
		} else if (!q.ldsnBox.hasClass('menu')) {
			q.ldsnBox.css({
				"-webkit-transform":'translateX(0px)',
				"transform":'translateX(0px)'
			})
		}
		q.ldsnBox.toggleClass('menu');
	})
	q.rightBtn.click(function () {
		q.ldsnBox.toggleClass('right');
		q.rightArrow.toggleClass('right');
		q.mainFrame.toggleClass('dis');
	})
	q.mainFrame.click(function () {
		if(q.ldsnBox.hasClass('menu')) {
			q.ldsnBox.toggleClass('menu');
			q.mainFrame.toggleClass('dis')
		} else if (q.ldsnBox.hasClass('right')) {
			q.ldsnBox.toggleClass('right');
			q.rightArrow.toggleClass('right');
			q.mainFrame.toggleClass('dis');
		}
	})
}


var init = function () {
	bindEvent();
}

init();



var setHeader = function (param) {
    $('.header').text(param)
}



>>>>>>> 48f00c670423fe978b2027494482afd14376df12
