/**
 * 图片上传
 * author: fanmingfei
 * date: 2015-03-07
 * version: v1.0.0
 */

var upload = require('common:widget/upload/upload.js'),
    toast = require('ldsn-wap:widget/toast/toast.js');
var event ={
    'FilesAdded': function(up, files, uploader) {
        plupload.each(files, function(file) {
            if(file.type != 'image/jpeg' && file.type != 'image/jpg' && file.type != 'image/png' && file.type != 'image/gif'){
                toast('error', '文件类型错误，请上传图片文件', false);
            }
        });
    },
    'BeforeUpload': function(up, file, uploader) {
           // 每个文件上传前,处理相关的事情
    },
    'UploadProgress': function(up, file, uploader) {

           // 每个文件上传时,处理相关的事情
    },
    'FileUploaded': function(up, file, info, uploader) {
        
    },
    'Error': function(up, err, errTip, uploader) {
           //上传出错时,处理相关的事情
    },
    'UploadComplete': function(uploader) {
           //队列文件处理完毕后,处理相关的事情
    },
    'Key': function(up, file, uploader) {
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
