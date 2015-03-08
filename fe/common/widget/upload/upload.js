/**
 * 图片上传
 * author: fanmingfei
 * date: 2015-03-07
 * version: v1.0.0
 */

var Qiniu = require('common:widget/upload/qiniu.js');
/**
 * 文件上传插件
 * @param  {string} btnId   上传按钮id
 * @param  {object} event   事件
 *                          FilesAdded
 *                          // 文件添加进队列后,处理相关的事情
 *                          BeforeUpload
 *                          文件上传前
 *                          UploadProgress
 *                          文件上传中，可做滚动条
 *                          FileUploaded
 *                          单个文件上传后
 *                          Error
 *                          文件上传错误
 *                          UploadComplete
 *                          文件列表上传结束
 *                          Key
 *                          文件名字，需要带目录 folderName/fileName.suffix
 * @param  {string} maxSize 上传最大限制 1mb 2mb
 */
function upload(btnId, event, maxSize) {
var qiniu = new Qiniu();
var uploader = qiniu.uploader({
    runtimes: 'html5,flash,html4',    //上传模式,依次退化
    browse_button: btnId,       //上传选择的点选按钮，**必需**
    //uptoken_url: 'http://www.ldustu.com/some.php',
        //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    uptoken : '-whDl59QdzDoavrzKrQy1YOCRWG6Cho_N5i7IYlf:BhkPZz2AQfp1nIuiRq9pOw5Rokc=:eyJzY29wZSI6Imxkc252NiIsImRlYWRsaW5lIjoxNDI1Nzc0NTM4fQ==',
        //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    //unique_names: true,
        // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    // save_key: true,
        // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: 'http://ldsnv6.qiniudn.com/',
        //bucket 域名，下载资源时用到，**必需**
    //container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: maxSize || '3m',           //最大文件体积限制
    flash_swf_url: 'static/common/plupload/Moxie.swf',  //引入flash,相对路径
    max_retries: 3,                   //上传失败最大重试次数
    dragdrop: true,                   //开启可拖曳上传
    drop_element: 'container',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb',                //分块上传时，每片的体积
    auto_start: false,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
    init: {
        'FilesAdded': function(up, files) {
            plupload.each(files, function(file) {
                //uploader.stop();
                // 文件添加进队列后,处理相关的事情
            });
            if (event.FilesAdded instanceof Function) {
                event.FilesAdded.apply(null,arguments);
            }
        },
        'BeforeUpload': function(up, file) {
           // 每个文件上传前,处理相关的事情
            if (event.BeforeUpload instanceof Function) {
            	event.BeforeUpload.apply(null,arguments);
            }
        },
        'UploadProgress': function(up, file) {
           // 每个文件上传时,处理相关的事情
            if (event.UploadProgress instanceof Function) {
            	event.UploadProgress.apply(null,arguments);
            }
        },
        'FileUploaded': function(up, file, info) {
			// 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
            if (event.FileUploaded instanceof Function) {
            	event.FileUploaded.apply(null,arguments);
            }
			var res = $.parseJSON(info);
			var sourceLink = res.key;
			console.log(res)


        },
        'Error': function(up, err, errTip) {
               //上传出错时,处理相关的事情
            if (event.Error instanceof Function) {
            	event.Error.apply(null,arguments);
            }
        },
        'UploadComplete': function() {
           //队列文件处理完毕后,处理相关的事情
            if (event.UploadComplete instanceof Function) {
            	event.UploadComplete.apply(null,arguments);
            }
        },
        'Key': function(up, file) {
        	if (event.Key instanceof Function) {
        		return event.Key.apply(null,arguments);
        	}
        }
    }
});

}

module.exports = upload;