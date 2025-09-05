// var https = "http://www.meetes.cn";
var https = "";

var ratio = window.devicePixelRatio || 1;
// 缩略图大小
var thumbnailWidth = 100 * ratio;
var thumbnailHeight = 100 * ratio;


//初始化信息
function upImgLcm(url1, click) {
    var imgSrc = "";
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: 'Uploader.swf',

        // 文件接收服务端。
        server: https + url1,
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: click,

        //只上传一个
        fileNumLimit: 1,

        // 只允许选择图片文件。
        accept: {
            title: '请选择图片',
            extensions: 'gif,jpg,jpeg,bmp,png,ico',
            mimeTypes: 'image/*'
        }

    });
    return uploader;
}

/**
 * 图片上传封装
 * @param {url} url 图片上传地址
 * @param {string} class1 
 * @param {string} class2 用来存放item的类
 * @param {string} class3 记录到表单中
 */
function imgUp(url, class1, class2, class3) {
    var imgSrc;
    var uploader = upImgLcm(url, class1);
    //当文件被加入队列之前触发
    uploader.on("beforeFileQueued", function () {
        //取到所有文件队列
        var files = uploader.getFiles();

        //如果有文件说明是再次上传，清除掉缩略图再重置以前的队列
        if (files.length) {
            $("#" + files[files.length - 1].id).remove(); //清掉缩略图
            uploader.reset(); //清掉队列
        }
    });
    // 当有文件添加进来的时候
    uploader.on('fileQueued', function (file) {

        var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail img-thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '</div>'
            ),
            $img = $li.find('img');

        $(class2).append($li);

        // 创建缩略图
        uploader.makeThumb(file, function (error, src) {
            if (error) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr('src', src);
        }, thumbnailWidth, thumbnailHeight);
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on('uploadProgress', function (file, percentage) {
        var $li = $('#' + file.id),
            $percent = $li.find('.progress .progress-bar');
        // 避免重复创建
        if (!$percent.length) {
            $percent = $('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo($li).find('.progress-bar');
        }
        $li.find('p.state').text('上传中');
        $percent.css('width', percentage * 100 + '%');
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on('uploadSuccess', function (file, response) {
        // 服务端返回错误
        if (response.status == 'error') {
            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="error"></div>').appendTo($li);
            }
            $error.text('上传失败');
            $('#' + file.id).append('<i class="fa fa-times-circle remove-picture" onclick="removePicture($(this))"></i>');
            return false;
        }
        // 服务端返回成功
        $(class3).val(response.data.id);

        var $li = $('#' + file.id),
            $success = $li.find('div.success');

        // 避免重复创建
        if (!$success.length) {
            $success = $('<div class="success"></div>').appendTo($li);
        }
        $('#' + file.id).append('<i class="fa fa-times-circle remove-picture" onclick="removePicture($(this))"></i>');
        $success.text('上传成功');
    });
    // 文件上传失败，现实上传出错。
    uploader.on('uploadError', function (file) {
        var $li = $('#' + file.id),
            $error = $li.find('div.error');

        // 避免重复创建
        if (!$error.length) {
            $error = $('<div class="error"></div>').appendTo($li);
        }
        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on('uploadComplete', function (file) {
        $('#' + file.id).find('.progress').remove();
    });

}

// 删除当前选中的图片
function removePicture(obj){
	obj.parent().remove();
}
