{%extends file="ldsn-wap/page/layout/layout1.tpl"%}

{%block name="title"%}鲁大学生网{%/block%}
{%block name="head"%}
{%require name="ldsn-wap:static/message.js"%}
{%require name="ldsn-wap:static/index/index.css"%}
{%require name="common:static/plupload/moxie.js" %}
{%require name="common:static/plupload/plupload.min.js"%}
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
{%/block%}

{%block name="ldsn-header"%}
	{%widget name="ldsn-wap:widget/header/header.tpl"%}
{%/block%}

{%block name="ldsn-menu"%}
	{%widget name="ldsn-wap:widget/menu/menu.tpl"%}
{%/block%}

{%block name="ldsn-content"%}
	{%widget name="ldsn-wap:widget/list/list.tpl"%}
	{%widget name="ldsn-wap:widget/article/article.tpl"%}
{%/block%}
{%block name="ldsn-right-aside"%}
	{%widget name="ldsn-wap:widget/right-aside/right-aside.tpl"%}
{%/block%}
{%block name="ldsn-share"%}
	{%widget name="ldsn-wap:widget/share/share.tpl"%}
{%/block%}
{%block name="ldsn-edit-article"%}
	{%widget name="ldsn-wap:widget/edit-article/edit-article.tpl"%}
{%/block%}
{%block name="else"%}
<div style="display: none">
<script src="http://s95.cnzz.com/stat.php?id=1254184808&web_id=1254184808" language="JavaScript"></script>
</div>
{%/block%}