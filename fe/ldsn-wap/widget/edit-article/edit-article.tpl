<section node-type="module-edit-article" class="module-edit-article">
	<div class="edit-article">
		  <p>标题: </p>
		  <p><input type="text" name="textTitle" class="textTitle"/></p>
		  <p>正文: <i id="upload-img" class="photo icon"></i></p>
		  <div id="editor" placeholder="这里输入内容" name="textContent" contenteditable="true" autofocus></div>
		  <div class="ui buttons">
			  <div class="ui button" node-type="edit-reset">取消</div>
			  <div class="or"></div>
			  <div class="ui positive button" node-type="edit-submit">保存</div>
		</div>
	</div>
</section>
{%script%}
	require("ldsn-wap:widget/edit-article/edit-article.js");
{%/script%}
{%script%}
	require("ldsn-wap:widget/upload-image/upload-image.js");
{%/script%}