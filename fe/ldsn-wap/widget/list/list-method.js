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
        order: 'time',
        arcList: [],
        currentCategory: null,
        pageSize: 20,
        currentPage: 0
    },
    api: {
        getList: apiCenter.getArcList

    },
    tmpl: {
        listTpl: listTpl.join('')
    },
    util: {
        getListErr: function (data) {
            if (data.error != '0') {
                var con = confirm('出现问题，是否刷新？');
                if (con) {
                    location.reload()
                } else {
                    return;
                }
            }
        },

        /**
         * 获取文章列表
         * @param  {number} start 开始的id
         * @param  {number} count 取多少文章
         * @param  {nuber} cid   取哪个版块
         * @return {object}       获取到的数据
         */
        getList: function (startid, count, cid, order) {
            var sendData = {
                startid: startid,
                count: count,
                cid: cid || '',
                order: order || '',
            };
            $.ajax({
                url: _pri.api.getList,
                dataType: 'json',
                data: sendData,
                ansyc: false,
                success: function (data) {
                    _pri.util.getListErr(data);
                    return data.data;
                },
                error: function (xhr, errType, err) {
                    var data = {error:-1,data:err};
                    _pri.util.getListErr(data);
                }
            });
        },

        /**
         * 给文章排序
         * @param  {string} order 排序方式
         */
        sort: function (order) {
            _pri.conf.order = order || _pri.conf.order;
            _pri.conf.arcList.sort(function (a,b) {
                return b[order] - a[order];
            });
        },

        /**
         * 渲染列表
         * @param  {object} data 列表数据
         */
        render: function (dataList) {
            var data = dataList || _pri.conf.arcList;
            var tpl = '';
            data.forEach(function (item){
                 tpl += ldev.tmpl(_pri.tmpl.listTpl, item);
            });
            _pri.node.itemList.append($(tpl));
        }


    }
};


var _pub = {

        /**
         * 更新排序
         * @param  {string} order 按照什么排序 time common favour ...
         */
        sort: function (order) {
            _pri.conf.currentPage = 0;
            var data = _pri.util.getList(0, _pri.conf.pageSize, _pri.conf.currentCategory, _pri.conf.order);
            _pri.node.itemList.empty();
            _pri.conf.arcList = [];
            _pri.conf.arcList = _pri.conf.arcList.concat(data);
            _pri.util.render();
        },

        /**
         * 到达板块
         * @param  {number} cid 将要到达的板块id
         */
        toCategory: function (cid) {
            _pri.conf.currentPage = 0;
            _pub.cof.currentCategory = cid;
            _pri.util.getList(0, _pri.conf.pageSize, cid);
            _pri.node.itemList.empty();
            _pri.conf.arcList = [];
            _pri.conf.arcList = _pri.conf.arcList.concat(data);
            _pri.util.render();
        },

        /**
         * 刷新当前板块
         */
        refresh: function() {
            _pri.conf.currentPage = 0;
            _pri.util.getList(0, _pri.conf.pageSize, _pub.conf.currentCategory);
            _pri.node.itemList.empty();
            _pri.conf.arcList = [];
            _pri.conf.arcList = _pri.conf.arcList.concat(data);
            _pri.util.render();
        },

        /**
         * 去首页
         */
        toIndex: function () {
            _pri.conf.currentPage = 0;
            _pri.util.getList(0,_pri.conf.pageSize);
            _pri.node.itemList.empty();
            _pri.conf.arcList = [];
            _pri.conf.arcList = _pri.conf.arcList.concat(data);
            _pri.util.render();

        },

        getMore: function () {
            _pri.conf.currentPage ++;
            var data = _pri.util.getList(_pri.conf.currentPage * _pri.conf.pageSize, _pri.conf.pageSize, _pri.conf.currentCategory, _pri.conf.order);
            _pri.util.render(data);
        }
};

module.exports = _pub;