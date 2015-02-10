 /**
 * 列表模板
 * @author fanmingfei
 * @date 2015-02-10
 * @version 1.0.0
 */

var listTpl = [
		'<li class="item">',
            '<header class="item-header">',
                '<img src="/static/ldsn-wap/lib/img/topic.png" class="user-topic"/>',
                '<section class="article-info">',
                    '<section class="article-from">',
                    '<%if (source){%>',
                        '<em><%=username%></em>转自<em><%=source%></em>',
                    '<%}else{%>',
                    '<em><%=username%></em>原创',
                    '<%}%>',
                    '</section>',
                    '<time><%=time%></time>',
                '</section>',
            '</header>',
            '<h2 class="article-title">',
                '<%=title%>',
            '</h2>',
            '<%if (image) {%>',
            '<img src="<%=image%>" class="article-image"/>',
            '<%}%>',
            '<article class="article-description">',
                '<%=description%>',
            '</article>',
            '<section class="article-handle-info">',
                '<ul>',
                    '<li>',
                        '<i class="thumbs up icon"></i>',
                        '<em><%=thumbs%></em>',
                    '</li>',
                    '<li>',
                        '<i class="edit sign icon"></i>',
                        '<em><%=comment%></em>',
                    '</li>',
                '</ul>',
            '</section>',
            '<footer class="article-footer">',
                '<section class="article-handle">',
                    '<click class="favour handle active">',
                        '<i class="thumbs up icon"></i>',
                        '<em class="opa">赞</em>',
                    '</click>',
                    '<click class="comment handle">',
                        '<i class="edit sign icon"></i>',
                        '<em class="opa">评论</em>',
                    '</click>',
                    '<click class="share handle">',
                        '<i class="share icon"></i>',
                        '<em class="opa">分享</em>',
                    '</click>',
                '</section>',
                '<ul class="article-comment">',
                '</ul>',
            '</footer>',
        '</li>'
        ];


module.exports = listTpl;