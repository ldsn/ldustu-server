{%extends file="ldsn-wap/page/layout/layout1.tpl"%}

{%block name="title"%}鲁大学生网{%/block%}
{%block name="head"%}

{%/block%}

{%block name="header-module"%}
	{%widget name="ldsn-wap:widget/header/header.tpl"%}
{%/block%}

{%block name="menu-module"%}
	{%widget name="ldsn-wap:widget/menu/menu.tpl"%}
{%/block%}

{%block name="ldsn-content"%}
	{%widget name="ldsn-wap:widget/list/list.tpl"%}
	{%widget name="ldsn-wap:widget/article/article.tpl"%}
{%/block%}