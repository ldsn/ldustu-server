<section style="display:block" node-type="module-edit-article" class="module-edit-article">
	<form action="#" method="post">
		  <p>标题: </p>
		  <p><input type="text" name="textTitle" /></p>
		  <p>正文: </p>
		  <div id="upload-img" style="width:40px;height:40px;background:#ccc"></div>
		  <p><textarea type="text" name="textContent"></textarea></p>
		  <p style="width:45%; float:left;"><input type="submit" value="提交" /></p>
		  <p style="width:45%; float:right;"><input type="reset" value="取消" /></p>
	</form>
</section>
{%script%}
	require("ldsn-wap:widget/edit-article/edit-article.js");
{%/script%}
{%script%}
	require("ldsn-wap:widget/upload-image/upload-image.js");
{%/script%}