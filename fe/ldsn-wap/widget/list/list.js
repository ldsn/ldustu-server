/**
 * 列表
 * @author fanmingfei
 * @date 2015-02-09
 * @version 1.0.0
 */

var apiCenter = require('common:widget/api/api.js');
var listTpl = require('ldsn-wap:widget/list/list.tpl.js');

var _pri = {
    node: {
        itemList: $('ul[node-type="module-list-item-list"]')
    },
    conf: {
        order: 'time'
    },
    api: {
        getList: apiCenter.getArcList

    },
    util: {
        getListErr: function () {
            confirm('服务器问题，获取数据失败！');
        }
    }
};


var _pub = {
    conf: {
        arcList: []
    },
    util: {
        
        /**
         * 获取文章列表
         * @param  {number} start 开始的id
         * @param  {number} count 取多少文章
         * @param  {nuber} cid   取哪个版块
         * @return {object}       获取到的数据
         */
        getList: function (startid, count, cid) {
            var sendData = {
                startid: startid,
                count: count,
                cid: cid
            };
            $.ajax({
                url: _pri.api.getList,
                dataType: 'json',
                data: sendData,
                success: function (data) {
                    return data;
                },
                error: function (xhr, errType, err) {
                    return false;
                }
            });
        },

        /**
         * 给文章排序
         * @param  {thring} order 排序方式
         */
        sort: function (order) {
            _pri.conf.order = order;
            _pub.conf.arcList.sort(function (a,b) {
                return b[order] - a[order];
            });
        },

        /**
         * 渲染列表
         * @param  {object} data 列表数据
         */
        render: function (data) {
            var tpl = '';
            data.forEach(function (item){
                tpl += ldev.tmpl(listTpl, data);
            });
            _pri.node.itemList.append($(tpl));
        }
    }
};

module.exports = _pub;