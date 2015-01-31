{%extends file="common/page/base.tpl"%} 
{%block name="head"%}
{%/block%}
{%block name="body"%}
<menu class="ldsn-menu">
{%block name="ldsn-menu"%}{%/block%}
</menu>
<section class="ldsn-main">
<header class="ldsn-header">
{%block name="ldsn-header"%}{%/block%}
</header>
<section class="ldsn-content">
{%block name="ldsn-content"%}{%/block%}
</section>
</section>
<section class="ldsn-right">
{%block name="ldsn-right-aside"%}{%/block%}
</section>
{%require name='ldsn-wap:page/layout/layout1.tpl'%}{%/block%}