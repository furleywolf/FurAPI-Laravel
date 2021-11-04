<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>图片上传器</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <style type="text/css">
        * {
            padding: 0px;
            margin: 0px;
            font-size: 16px;
            font-family: "Microsoft YaHei";
        }

        body {
            padding-bottom: 164px;
        }

        .invisible {
            display: none;
        }

        .footer {
            position: fixed;
            left: 0px;
            bottom: 0px;
            width: 100%;
            height: 100px;
            background-color: #eee;
            z-index: 9999;
        }

        footer div {
            text-align: center;
            margin: 50px 0;
            font: normal 14px/24px 'MicroSoft YaHei';
        }

        @media all and (max-width: 767px) {
            .m-fix-100 {
                width: 100% !important;
            }

            .m-bar-content {
                padding: 0.3rem !important;
            }

            .m-bar {
                display: none;
            }

            .m-title {
                font-size: 2.5rem;
            }

            .m-footer {
                margin-top: 20px;
            }
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            //返回?号后面的参数名与参数值的数组
            var params = (function oneValues() {
                var query = location.search.substr(1)
                query = query.split('&')
                var params = {}
                for (let i = 0; i < query.length; i++) {
                    let q = query[i].split('=')
                    if (q.length === 2) {
                        params[q[0]] = q[1]
                    }
                }
                return params
            }());

            $("#do-check").click(function () {
                var picUrl = $('#pic-url').val();
                var picTitle = $('#pic-title').val();
                var picDesc = $('#pic-desc').val();
                var picTag = $('#pic-tag').val();
                var picType = $('#picTypeSelect').val();
                var picFrom = $('#pic-from').val();
                var picFromUrl = $('#pic-fromurl').val();

                var picData = {};
                var token = params.token;
                picData.picUrl = picUrl;
                picData.picTitle = picTitle;
                picData.picDesc = picDesc;
                picData.picTag = picTag;
                picData.picFrom = picFrom;
                picData.picFromUrl = picFromUrl;
                picData.picClass = "acg";
                if (picType == 1) {
                    picData.imgType = "pc";
                } else if (picType == 2) {
                    picData.imgType = "m";
                } else if (picType == 3) {
                    picData.imgType = "fursuit";
                    picData.picClass = "fursuit";
                } else {
                    alert('请选择类型');
                    return;
                }

                picData.picTag = picData.picTag.split(',');

                if (!isEmpty(picUrl) && !isEmpty(picTitle)) {
                    doCheck(token, picData);
                } else {
                    alert('请至少填写URL和标题');
                    return;
                }
            })
        });

        function doCheck(token, picData) {
            setResult(0);
            var url = "https://pic.kemono.cool/api/v1/putPic/" + token + "/" + picData.imgType;
            $.post(url,
                {
                    url: picData.picUrl,
                    imgType: picData.imgType,
                    title: picData.picTitle,
                    description: picData.picDesc,
                    tag: picData.picTag,
                    imgtype: picData.picClass,
                    from: picData.picFrom,
                    fromurl: picData.picFromUrl,
                },
                function (data, status) {
                    if (data.code === 200) {
                        setResult(1);
                    } else {
                        setResult(3);
                    }
                });
        }

        function setResult(type, picType, picRate) {
            if (type === 0) {
                $("#result-alert").attr('class', 'alert alert-warning w-50 m-fix-100 m-auto');
                $("#result-alert").html('提交中，请稍后......');
            } else if (type === 1) {
                $("#result-alert").attr('class', 'alert alert-success w-50 m-fix-100 m-auto');
                $("#result-alert").html('提交成功！');
            } else if (type === 3) {
                $("#result-alert").attr('class', 'alert alert-warning w-50 m-fix-100 m-auto');
                $("#result-alert").html('服务器异常或URL有误');
            }
        }

        function isEmpty(obj) {
            return (typeof obj === 'undefined' || obj === null || obj === "");
        }
    </script>
</head>
<!-- Frontend by Jmeow -->

<body>

<div
    class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm m-bar-content">
    <h5 class="my-0 mr-md-auto font-weight-normal m-bar">图片上传器</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">使用说明</a>
        <a class="p-2 text-dark" href="#">关于</a>
        <!-- <a class="btn btn-outline-primary" href="#">登录</a> -->
    </nav>
</div>

<div class="pricing-header px-3 py-3 pt-md-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 m-title">图片上传器</h1>
    <p class="lead">可以上传喜爱的图片到Bot图库</p>
    <p class="lead">在上传前，请确保你的图片是公开发布的或已被授权转载的</p>
    <p class="lead">以下表格内容请尽量填写</p>
</div>

<div class="container">
    <div class="w-50 m-auto m-fix-100">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">图片URL：</span>
            </div>
            <input type="text" id="pic-url" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div style="margin-top: 10px;">
            <p class="text-center">如果没有图片URL可以去百度免费图床<BR>如果你使用Chrome，可以尝试<a href = "https://chrome.google.com/webstore/detail/%E5%8D%B3%E5%88%BB%E5%9B%BE%E5%BA%8A/dckaeinoeaogebmhijpkpmacifmpgmcb">这款扩展</a></p>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">图片名称：</span>
            </div>
            <input type="text" id="pic-title" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">图片描述：</span>
            </div>
            <input type="text" id="pic-desc" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">图片来源：</span>
            </div>
            <input type="text" id="pic-from" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">图片来源URL：</span>
            </div>
            <input type="text" id="pic-fromurl" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="picTypeSelect">图片类型：</label>
            </div>
            <select class="custom-select" id="picTypeSelect">
                <option selected>请选择你的图片类型...</option>
                <option value="1">二次元图-横板</option>
                <option value="2">二次元图-竖版</option>
                <option value="3">Fursuit图片</option>
            </select>
        </div>
        <div class="center input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">标签(使用英文逗号分割)：</span>
            </div>
            <input type="text" id="pic-tag" class="form-control" aria-label="Sizing example input"
                   aria-describedby="inputGroup-sizing-default">
        </div>
        <button id="do-check" type="button" class="w-100 btn btn-danger justify-content-center">上传</button>
    </div>

    <!-- 检查结果 -->
    <div style="margin-top: 10px;">
        <div id="result-alert" class="alert alert-success w-50 m-fix-100 m-auto invisible" role="alert">

        </div>
    </div>

</div>

<footer class="border-top footer">
    <div class="m-footer">
        <p>Crafted By <a href="https://www.jmeow.org/" target="_blank">JmeowTechnology</a></p>
    </div>
</footer>
</div>
</body>

</html>
