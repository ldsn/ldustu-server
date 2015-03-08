/**
 * 图片上传
 * author: fanmingfei
 * date: 2015-03-07
 * version: v1.0.0
 */

var upload = require('common:widget/upload/upload.js'),
    toast = require('ldsn-wap:widget/toast/toast.js');
var event ={
    'FilesAdded': function(up, files) {
        console.log(up)
        plupload.each(files, function(file) {
            if(file.type != 'image/jpeg' && file.type != 'image/jpg' && file.type != 'image/png' && file.type != 'image/gif'){
                toast('error', '文件类型错误，请上传图片文件', false);
            }
        });
        up.start();
    },
    'BeforeUpload': function(up, file) {
       // 每个文件上传前,处理相关的事情
        toast('tip', '正在上传中，请稍后', false);
    },
    'UploadProgress': function(up, file) {
        // 每个文件上传时,处理相关的事情
        if(file.percent) {
            toast('tip', '正在上传中 ' + file.percent+'%', false);
        } else {
            toast('tip', '正在上传中，请稍后', false);
        }
    },
    'FileUploaded': function(up, file, info) {
        var domain = up.getOption('domain')
        var res = $.parseJSON(info);
        var sourceLink = domain + res.key + '?imageView2/2/w/400/q/50';
        var img = document.createElement('img');
        img.src = sourceLink;
        $(img).appendTo('#editor');
        $('<div><br/></div>').appendTo('#editor');
    },
    'Error': function(up, err, errTip) {
           //上传出错时,处理相关的事情
    },
    'UploadComplete': function() {
           //队列文件处理完毕后,处理相关的事情
    },
    'Key': function(up, file) {
        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
        // 该配置必须要在 unique_names: false , save_key: false 时才生效
        if(file.type == 'image/jpeg' || file.type == 'image/jpg' || file.type == 'image/png' || file.type == 'image/gif'){
          var nameSuffix = file.name.substring(file.name.lastIndexOf('.'));
          var key = 'userUpload/' + Date.parse(new Date()) + nameSuffix;
          // do something with key here
          return key
        }
    }
};
upload('upload-img', event);
