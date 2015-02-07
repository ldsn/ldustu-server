/**
 * 鼠标滑动
 * author: fanmingfei
 */

"use strict";

	function _Smooth(dom) {
		var _this = this;
		_this.dom = dom;
	}



	_Smooth.prototype.move = function (func,callback) {
		var _this = this;

		var func = func,
		callback = callback,
		moveX,
		moveY,
		startX,
		startY,
		lastX,
		lastY,
		changeX,
		changeY,
		currentX,
		currentY,
		data = {},
		moving = false;


			_this.dom.addEventListener('touchstart', function (e) {
				startX = e.changedTouches[0].clientX;
				startY = e.changedTouches[0].clientY;
				lastX = e.changedTouches[0].clientX;
				lastY = e.changedTouches[0].clientY;
			});

			_this.dom.addEventListener('touchmove', function (e) {
				e.stopPropagation();
				e.preventDefault();

				moving = true;


				currentX = e.changedTouches[0].clientX;
				currentY = e.changedTouches[0].clientY;

				changeX = currentX - lastX;
				changeY = currentY - lastY;

				moveX = e.changedTouches[0].clientX - startX;
				moveY = e.changedTouches[0].clientY - startY;


				data = {
					moveX: moveX,
					moveY: moveY,
					changeX: changeX,
					changeY: changeY
				};

				if(func instanceof Function) {
					func(data,e);
				}

				lastX = e.changedTouches[0].clientX;
				lastY = e.changedTouches[0].clientY;

			}, false);

			_this.dom.addEventListener('touchend', function ( e) {
				if ( moving === false ) return;
				if(callback instanceof Function){
					callback(data,e);	
				}
				moving = false;
			}, false);

	};

	_Smooth.prototype.slide = function (func,xMove,yMove) {
		var _this = this;

		var func = func,
		xMove = xMove | 0,
		yMove = yMove | 0,
		startX,
		startY,
		moveX,
		moveY;

		_this.dom.addEventListener('touchstart', function (e) {
			e.preventDefault();
			e.stopPropagation();

			startX = e.changedTouches[0].clientX;
			startY = e.changedTouches[0].clientY;				
	
				
		}, false);
	
		_this.dom.addEventListener('touchend', function (e) {
			e.stopPropagation();
			e.preventDefault();
			
			moveX = e.changedTouches[0].clientX - startX;
			moveY = e.changedTouches[0].clientY - startY;


			if (moveX >= xMove && moveY >= yMove){
				var data = {
						moveX: moveX,
						moveY: moveY
					};
				func(data,e); 
			}
		}, false);
	};

	var smooth = _Smooth;

	module.exports = smooth;