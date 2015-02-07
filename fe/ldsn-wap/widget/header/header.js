

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



