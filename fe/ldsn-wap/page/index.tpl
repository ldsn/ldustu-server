{%extends file="ldsn-wap/page/layout/layout1.tpl"%}

{%block name="title"%}鲁大学生网{%/block%}
{%block name="head"%}

{%/block%}

{%block name="ldsn-header"%}
	{%widget name="ldsn-wap:widget/header/header.tpl"%}
{%/block%}

{%block name="ldsn-menu"%}
	{%widget name="ldsn-wap:widget/menu/menu.tpl"%}
{%/block%}

{%block name="ldsn-content"%}
	{%widget name="ldsn-wap:widget/list/list.tpl"%}
	{%$aa%}
	{%widget name="ldsn-wap:widget/article/article.tpl"%}
{%/block%}
{%block name="ldsn-right-aside"%}
	{%widget name="ldsn-wap:widget/right-aside/right-aside.tpl"%}
{%/block%}