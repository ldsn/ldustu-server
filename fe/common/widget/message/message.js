/**
 * 事件监听
 * @author fanmingfei
 * @date 2015-02-08
 * @version 1.0.0
 */

'use strict';

var _pri = {
    events:{}
};

var _pub = {
    util: {

        /**
         * 创建监听事件
         * @param {String} eventName 创建监听事件
         */
        create: function(eventName) {
            if (typeof eventName != "string") {
                throw(eventName + 'is not a string!');
                return;
            }
            if (_pri.events.hasOwnProperty(eventName)) {
                throw(eventName + 'is exist!');
                return;
            }
            _pri.events[eventName] = [];
        },

        /**
         * 添加监听事件
         * @param {String} eventName 监听事件的名称
         * @param {Function} func 监听事件的函数
         */
        listen: function (eventName,func) {
            if (typeof eventName != "string") {
                throw(eventName + 'is not a string!');
                return;
            }
            if (!_pri.events.hasOwnProperty(eventName)) {
                throw(eventName + 'is not exist!');
                return;
            }
            if (!(func instanceof Function)) {
                throw('2th param is not function!');
                return;
            }

            _pri.events[eventName].push(func);

        },

        /**
         * 触发监听事件
         * @param {string} eventName 所触发的事件名称
         */
        trigger: function (eventName) {
            if (typeof eventName != "string") {
                throw(eventName + 'is not a string!');
                return;
            }
            if (!_pri.events.hasOwnProperty(eventName)) {
                throw(eventName + 'is not exist!');
                return;
            }

            var args = [].slice.call(arguments);

            _pri.events[eventName].forEach(function (eventFunc) {
                eventFunc.apply(undefined, args);
            });
        }

    }
};

module.exports = _pub.util;