<!DOCTYPE html>
{%html framework="common:static/lib/mod.js"%}
{%head%}
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>{%block name="title"%}{%/block%}</title>
    {%* global css *%}
    {%require name="common:static/css/reset.css"%}
    {%require name="common:static/semantic/css/semantic.css"%}

    {%* global js *%}
    {%require name="common:static/mod.js"%}
    {%require name="common:static/lib/html5.js"%}
    {%require name="common:static/lib/zepto.min.js"%}
    {%*
        {%require name="common:static/semantic/js/semantic.js"%}
    *%}

    {%block name="head"%}{%/block%}
{%/head%}
{%body%}
    {%block name="body"%}{%/block%}
{%/body%}
{%/html%}