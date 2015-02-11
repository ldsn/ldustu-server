/**
     * 菜单js
     * @author yuxuan
     * @date 2015-02-08
     * @version 1.0.0
     */
 

    //私有方法
    var _pri = {
        //UI元素集合
        node: {
        	mod: $('menu[node-type="ldsn-share"]'),
        	
        },
    }

var _pub = {
        share: function  (bdText,bdDesc,bdUrl,bdPic) {
                  var shtml = "<div id='share_bg'></div><div class='bdsharebuttonbox' data-tag='share_1' id='share'><div class='bdshare'>\
                        <div class='share_mid'><a class='bds_qzone share_img' data-cmd='qzone'></a>\
                        <a class='bds_tsina share_img' data-cmd='tsina'></a>\
                        <a class='bds_sqq share_img' data-cmd='sqq'></a>\
                        <a class='bds_renren share_img' data-cmd='renren'></a>\
                        <a class='bds_weixin share_img' data-cmd='weixin'></a>\
                        <a class='bds_copy share_img' data-cmd='copy'></a></div></div>\
                        </div><button id='share_delete'>取消</button>";
                    var shareDiv = document.createElement('div');
                           shareDiv.id = "share_box";
                           document.body.appendChild(shareDiv);
                           document.getElementById("share_box").innerHTML = shtml;
                           if(document.getElementById('share_script')){
                                        document.getElementById('share_script').remove();
                                        delete _bd_share_config;
                                        delete _bd_share_is_recently_loaded;
                                        delete _bd_share_main;
                            }
                            window._bd_share_config = {
                                        common : {
                                                      bdText :bdText, 
                                                      bdDesc : bdDesc,  
                                                      bdUrl :bdUrl,   
                                                      bdPic : bdPic
                                                       },
                                          share : [{
                                                    "bdSize" : 32
                                           }]
                                      }
                            var script = document.createElement('script');
                                    script.src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5);
                                    script.id='share_script';
                                    document.body.appendChild(script);
                                    document.getElementById("share_bg").addEventListener("click",function () {
                                            document.getElementById("share_box").remove();
                                    })
                                    document.getElementById("share_delete").addEventListener("click",function () {
                                            document.getElementById("share_box").remove();
                                    })
                            var i = 0;
                            var int = setInterval(delete_css,1);
                            function delete_css () {
                                    i++;
                                    if(document.getElementsByTagName('link')[0].href.substr(7,21)=="bdimg.share.baidu.com"){
                                            document.getElementsByTagName('link')[0].remove();
                                            clearInterval(int);
                                    }
                             }
              }
    }
    module.exports = _pub;

