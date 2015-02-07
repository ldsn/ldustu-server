/**
 * Copyright 2015 LDSN. All Rights Reserved.
 * 首页滑动
 * Smooth,
 * create by fanmingfei 2015-02-01
*/

var Smooth = require("common:widget/smooth/smooth.js");

var q = {
	ldsnMain: $('.ldsn-main'),
	ldsnBox: $('.ldsn-box')
}

var bindEvent = function () {

}

var renderDom = function () {
	$('.ldsn-content').css("height",$(window).height()-40);
	$('.ldsn-box').css("width",$(window).width()+300);
	$('.ldsn-main').css("width",$(window).width());
}



var init = function () {
	renderDom();
	bindEvent();
}

init()