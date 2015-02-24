/**
 * 评论
 * @author fanmingfei
 * @date 2015-02-11
 * @version 1.0.0
 */

var api = require('common:widget/api/api.js'),
	commentTmpl = require('ldsn-wap:widget/comment/comment.tpl.js');

var _pri = {
	node: {
		moduleArticle: $('section[node-type="module-article"]');
	},
	api: {
		getComment: api.getComment,
	},
	tmpl: {
		commentTmpl: commentTmpl;
	},
    util: {
        getErr: function (data) {
            if (data.error != '0') {
                var con = confirm('出现问题，是否刷新？');
                if (con) {
                    location.reload()
                } else {
                    return;
                }
            }
        },
		getComment: function (aid, start, count, order, callback) {
			var data = {
				aid: aid,
				start: start,
				count: count,
				order: order || 'desc'
			};
			$.ajax({
				url:_pri.api.getComment,
				dataType: 'json',
				data: data,
                success: function (data) {
                    _pri.util.getErr(data);
                    callback(data.data);
                },
                error: function (xhr, errType, err) {
                    var data = {error:-1,data:err};
                    _pri.util.getErr(data);
                }
			});
		},
		renderArticle: function (data) {
			data.forEach(item) {
				_pri.node.moduleArticle.find('.article-comment').append(_pri.tmpl.commentTmpl,item);
			}
		}

	}
};

var _pub = function () {
	util: {
		renderArticle: function (aid, start, count, order) {
			_pri.util.getComment(aid, start, count, order, _pri.util.renderArticle);
		}
	}
};