define([], function () {
    if (Config.modulename == 'admin' && Config.controllername == 'index' && Config.actionname == 'index') {

    require.config({
        paths: {
            'kefu': '../addons/kefu/js/kefu'
        },
        shim: {
            'kefu': {
                deps: ['css!../addons/kefu/css/kefu_admin_default.css'],
                exports: 'KeFu'
            }
        }
    });

    require(['kefu'], function (KeFu) {
        KeFu.initialize(document.domain, 'admin');
    });

} else {

    try {
        var parentConifg = window.parent.Config;
    } catch (err) {
        var parentConifg = false;
    }

    if (parentConifg && parentConifg.modulename == 'admin') {
        // 监听后台iframe内的快捷键打开会话窗口
        $(document).on('keyup', function (event) {

            if (window.parent.KeFu) {

                // console.log('当前按钮的code-iframe内:', event.keyCode);

                // 对打开会话窗口的监听
                // 打开会话窗口快捷键[ctrl + /],若需修改，请拿到对应键的keyCode替换下一行的191即可，191代表[/]键的keyCode
                if (event.keyCode === 191 && event.ctrlKey) {

                    if (window.parent.KeFu.last_sender) {
                        if (parseInt(window.parent.KeFu.last_sender) === window.parent.KeFu.session_id) {
                            // 展开分组
                            if (!window.parent.KeFu.group_show.dialogue) {
                                $('#heading_dialogue a').click();
                            }
                        } else {
                            window.parent.KeFu.changeSession(window.parent.KeFu.last_sender);
                            window.parent.KeFu.last_sender = null;
                        }
                    } else if (window.parent.KeFu.window_is_show) {
                        window.parent.KeFu.toggle_window('hide');
                    }

                    if (!window.parent.KeFu.window_is_show) {
                        window.parent.KeFu.toggle_window('show');
                    }
                    return ;
                }
            }

        });

    } else {

        require.config({
            paths: {
                'kefu': '../addons/kefu/js/kefu'
            },
            shim: {
                'kefu': {
                    deps: ['css!../addons/kefu/css/kefu_default.css'],
                    exports: 'KeFu'
                }
            }
        });

        require(['kefu'], function (KeFu) {
            KeFu.initialize(document.domain, 'index');
        });
    }
}
window.UMEDITOR_HOME_URL = Config.__CDN__ + "/assets/addons/umeditor/";
require.config({
    paths: {
        'umeditor': '../addons/umeditor/umeditor.min',
        'umeditor.config': '../addons/umeditor/umeditor.config',
        'umeditor.lang': '../addons/umeditor/lang/zh-cn/zh-cn',
    },
    shim: {
        'umeditor': {
            deps: [
                'umeditor.config',
                'css!../addons/umeditor/themes/default/css/umeditor.min.css'
            ],
            exports: 'UM',
        },
        'umeditor.lang': ['umeditor']
    }
});

require(['form', 'upload'], function (Form, Upload) {
    //监听上传文本框的事件
    $(document).on("edui.file.change", ".edui-image-file", function (e, up, me, input, callback) {
        for (var i = 0; i < this.files.length; i++) {
            Upload.api.send(this.files[i], function (data) {
                var url = data.url;
                me.uploadComplete(JSON.stringify({url: url, state: "SUCCESS"}));
            });
        }
        up.updateInput(input);
        me.toggleMask("Loading....");
        callback && callback();
    });
    var _bindevent = Form.events.bindevent;
    Form.events.bindevent = function (form) {
        _bindevent.apply(this, [form]);
        require(['umeditor', 'umeditor.lang'], function (UME, undefined) {

            //重写编辑器加载
            UME.plugins['autoupload'] = function () {
                var me = this;
                me.setOpt('pasteImageEnabled', true);
                me.setOpt('dropFileEnabled', true);
                var sendAndInsertImage = function (file, editor) {
                    try {
                        Upload.api.send(file, function (data) {
                            var url = Fast.api.cdnurl(data.url, true);
                            editor.execCommand('insertimage', {
                                src: url,
                                _src: url
                            });
                        });
                    } catch (er) {
                    }
                };

                function getPasteImage(e) {
                    return e.clipboardData && e.clipboardData.items && e.clipboardData.items.length == 1 && /^image\//.test(e.clipboardData.items[0].type) ? e.clipboardData.items : null;
                }

                function getDropImage(e) {
                    return e.dataTransfer && e.dataTransfer.files ? e.dataTransfer.files : null;
                }

                me.addListener('ready', function () {
                    if (window.FormData && window.FileReader) {
                        var autoUploadHandler = function (e) {
                            var hasImg = false,
                                items;
                            //获取粘贴板文件列表或者拖放文件列表
                            items = e.type == 'paste' ? getPasteImage(e.originalEvent) : getDropImage(e.originalEvent);
                            if (items) {
                                var len = items.length,
                                    file;
                                while (len--) {
                                    file = items[len];
                                    if (file.getAsFile)
                                        file = file.getAsFile();
                                    if (file && file.size > 0 && /image\/\w+/i.test(file.type)) {
                                        sendAndInsertImage(file, me);
                                        hasImg = true;
                                    }
                                }
                                if (hasImg)
                                    return false;
                            }

                        };
                        me.getOpt('pasteImageEnabled') && me.$body.on('paste', autoUploadHandler);
                        me.getOpt('dropFileEnabled') && me.$body.on('drop', autoUploadHandler);

                        //取消拖放图片时出现的文字光标位置提示
                        me.$body.on('dragover', function (e) {
                            if (e.originalEvent.dataTransfer.types[0] == 'Files') {
                                return false;
                            }
                        });
                    }
                });

            };
            $.extend(window.UMEDITOR_CONFIG.whiteList, {
                div: ['style', 'class', 'id', 'data-tpl', 'data-source', 'data-id'],
                span: ['style', 'class', 'id', 'data-id']
            });
            $(Config.umeditor.classname || '.editor', form).each(function () {
                var id = $(this).attr("id");
                $(this).removeClass('form-control');
                var options = $(this).data("umeditor-options");
                UME.list[id] = UME.getEditor(id, $.extend(true, {}, {
                    initialFrameWidth: '100%',
                    zIndex: 90,
                    autoHeightEnabled: true,
                    initialFrameHeight: 300,
                    xssFilterRules: false,
                    outputXssFilter: false,
                    inputXssFilter: false,
                    autoFloatEnabled: false,
                    imageUrl: '',
                    imagePath: Config.upload.cdnurl,
                    imageUploadCallback: function (file, fn) {
                        var me = this;
                        Upload.api.send(file, function (data) {
                            var url = data.url;
                            fn && fn.call(me, url, data);
                        });
                    }
                }, options || {}));
            });
        });
    }
});

});