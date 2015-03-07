<section node-type="module-edit-article" class="module-edit-article">
	<form action="#" method="post">
		  <p>标题: </p>
		  <p><input type="text" name="textTitle" /></p>
		  <p>正文: </p>
		  <p><textarea type="text" name="textContent"></textarea></p>
		  <p style="width:45%; float:left;"><input type="submit" value="提交" /></p>
		  <p style="width:45%; float:right;"><input type="reset" value="取消" /></p>
	</form>
</section>
{%script%}
	require("ldsn-wap:widget/edit-article/edit-article.js");
{%/script%}