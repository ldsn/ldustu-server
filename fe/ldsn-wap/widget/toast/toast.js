/**
 * 提示窗
 * author: fanmingfei
 * date: 2015-03-07
 */

var _pri = {
	node: {
		toast: $('section[node-type="module-toast"]'),
		close: $('section[node-type="module-toast"]').find('i[node-type="close"]'),
		text: $('section[node-type="module-toast"]').find('span[node-type="text"]')
	},
	bindUI: function () {
		_pri.node.close.on('click', _pri.util.hide);
	},
	util: {
		slideClose: function (flag) {
			if(flag){
				_pri.node.close.addClass('show');
			} else {
				_pri.node.close.removeClass('show')
			}
		},
		setType: function (type) {
			_pri.node.toast.removeClass();
			_pri.node.toast.addClass('module-toast');
			_pri.node.toast.addClass(type);
		},
		show: function (close) {
			_pri.node.toast.addClass('show');
			if (close) {
				setTimeout(function () {
					_pri.util.hide();
				},3000);
			}
		},
		hide: function () {
			_pri.node.toast.removeClass('show');
		}
	}
}

var init = function () {
	_pri.bindUI();
}

init();

var _pub = {

	/**
	 * 弹出
	 * @param  {string} type  提示类型 success tip error
	 * @param  {string} text  提示文本
	 * @param  {bool} close 是否手动关闭
	 */
	alert: function (type, text, close) {
		_pri.util.slideClose(close);
		_pri.util.setType(type);
		_pri.node.text.text(text);
		_pri.util.show(!close);
	}
}

module.exports = _pub.alert;
