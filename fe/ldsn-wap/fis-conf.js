var receiver = "http://tp.com:8989/fisp.php";

fis.config.merge({
	namespace : 'ldsn-wap',
    pack : {
    },
	deploy: {
	        //使用fis release --dest static来使用这个配置
	        remote: [
	            {
	                //如果配置了receiver，fis会把文件逐个post到接收端上
	                receiver: receiver,
	                //从产出的结果的static目录下找文件
	                from: '/static',
	                //上传目录从static下一级开始不包括static目录
	                subOnly: true,
	                //保存到远端机器的/home/fis/www/static目录下
	                //这个参数会跟随post请求一起发送
	                to: '/home/wwwroot/tp.com/static',
	                // replace : {
	                //     from : /(\"|\'|\(|bdstatic\.com)\/static\/([^\(\s\r\n\)\{\}\"\']+?(\.(png|jpg|gif|css|js|swf)|\/\"|\/\'))(\?t\=\d+)?/ig,
	                //     to : function(m){
	                //         // 如果加了md5，就不需要时间戳
	                //         if(/(\_[a-zA-Z0-9]{7}\.(png|jpg|gif|css|js)|\/\"|\/\')$/i.test(arguments[2])){
	                //             return arguments[1] + staticPath + arguments[2];
	                //         } else {
	                //             return arguments[1] + staticPath + arguments[2] + '?t=' + currentTime;
	                //         }
	                //     }
	                // },
	                //某些后缀的文件不进行上传
	                exclude: /.*\.(?:svn|cvs|tar|rar|psd).*/
	            },{
	                //如果配置了receiver，fis会把文件逐个post到接收端上
	                receiver: receiver,
	                //从产出的结果的static目录下找文件
	                from: '/config',
	                //上传目录从static下一级开始不包括static目录
	                subOnly: true,
	                //保存到远端机器的/home/fis/www/static目录下
	                //这个参数会跟随post请求一起发送
	                to: '/home/wwwroot/tp.com/configs',
	                // replace : {
	                //     from : /(\"|\'|\(|bdstatic\.com)\/static\/([^\(\s\r\n\)\{\}\"\']+?(\.(png|jpg|gif|css|js|swf)|\/\"|\/\'))(\?t\=\d+)?/ig,
	                //     to : function(m){
	                //         // 如果加了md5，就不需要时间戳
	                //         if(/(\_[a-zA-Z0-9]{7}\.(png|jpg|gif|css|js)|\/\"|\/\')$/i.test(arguments[2])){
	                //             return arguments[1] + staticPath + arguments[2];
	                //         } else {
	                //             return arguments[1] + staticPath + arguments[2] + '?t=' + currentTime;
	                //         }
	                //     }
	                // },
	                //某些后缀的文件不进行上传
	                exclude: /.*\.(?:svn|cvs|tar|rar|psd).*/
	            },{
	                //如果配置了receiver，fis会把文件逐个post到接收端上
	                receiver: receiver,
	                //从产出的结果的static目录下找文件
	                from: '/plugin',
	                //上传目录从static下一级开始不包括static目录
	                subOnly: true,
	                //保存到远端机器的/home/fis/www/static目录下
	                //这个参数会跟随post请求一起发送
	                to: '/home/wwwroot/tp.com/Application/Smarty/Plugins/',
	                // replace : {
	                //     from : /(\"|\'|\(|bdstatic\.com)\/static\/([^\(\s\r\n\)\{\}\"\']+?(\.(png|jpg|gif|css|js|swf)|\/\"|\/\'))(\?t\=\d+)?/ig,
	                //     to : function(m){
	                //         // 如果加了md5，就不需要时间戳
	                //         if(/(\_[a-zA-Z0-9]{7}\.(png|jpg|gif|css|js)|\/\"|\/\')$/i.test(arguments[2])){
	                //             return arguments[1] + staticPath + arguments[2];
	                //         } else {
	                //             return arguments[1] + staticPath + arguments[2] + '?t=' + currentTime;
	                //         }
	                //     }
	                // },
	                //某些后缀的文件不进行上传
	                exclude: /.*\.(?:svn|cvs|tar|rar|psd).*/
	            },{
	                //如果配置了receiver，fis会把文件逐个post到接收端上
	                receiver: receiver,
	                //从产出的结果的static目录下找文件
	                from: '/template',
	                //上传目录从static下一级开始不包括static目录
	                subOnly: true,
	                //保存到远端机器的/home/fis/www/static目录下
	                //这个参数会跟随post请求一起发送
	                to: '/home/wwwroot/tp.com/Application/Home/View/',
	                // replace : {
	                //     from : /(\"|\'|\(|bdstatic\.com)\/static\/([^\(\s\r\n\)\{\}\"\']+?(\.(png|jpg|gif|css|js|swf)|\/\"|\/\'))(\?t\=\d+)?/ig,
	                //     to : function(m){
	                //         // 如果加了md5，就不需要时间戳
	                //         if(/(\_[a-zA-Z0-9]{7}\.(png|jpg|gif|css|js)|\/\"|\/\')$/i.test(arguments[2])){
	                //             return arguments[1] + staticPath + arguments[2];
	                //         } else {
	                //             return arguments[1] + staticPath + arguments[2] + '?t=' + currentTime;
	                //         }
	                //     }
	                // },
	                //某些后缀的文件不进行上传
	                exclude: /.*\.(?:svn|cvs|tar|rar|psd).*/
	            },]
        },
});
