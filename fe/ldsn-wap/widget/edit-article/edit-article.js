/**
     * 文章发布js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
 
   'use strict';
    //私有方法
    var _pri = {
        //UI元素集合
        node: {
              mod: $('section[node-type="ldsn-edit-article"]'),
              editModule: $('section[node-type="module-edit-article"]'),
              editReset:$('div[node-type="edit-reset"]'),
              editSubmit:$('div[node-type="edit-submit"]'),
        },
        //绑定元素事件
        bindUI: function () {
            _pri.node.editReset.on("click",function(){
                _pri.node.editModule.css("display","none")
            })
            _pri.node.editSubmit.on("click",function(){
                _pri.util.articleRelease();
            })
                    },
        util: {
              articleRelease:function(){
                    var articleTitle = $(".textTitle").val();
                    var articleContent = $("#editor").html();
                    if(articleTitle==""){
                        alert("请填写文章标题!");
                    }else if(articleContent==""){
                        alert("请填写文章内容!")
                    }else{
                        if(articleContent.indexOf("<img") >= 0){
                                var imgSrc = $("#editor").find("img")[0].src;
                                console.log([articleTitle,articleContent,imgSrc])
                        }else{
                                console.log([articleTitle,articleContent])
                        }
                    }
                    $.ajax({
                            dataType:'json',
                            data:'id=10',
                            jsonp:'callback',
                            url:'http://www.ldustu.com/',
                            success:function(){
                            
                            },
                    });
              },
              initEdit: function (){//页面初始化函数
                        
                    }
              }
    }
 
    /**
     * 如果页面需要加载后运行某些函数
     * 需要定义init()代表初始化 并执行
     */
  
      var init = function () {
        _pri.util.initEdit();
        _pri.bindUI();
    }
    init();