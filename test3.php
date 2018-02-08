<style>.upload{
    padding: 4px 10px;
    height: 20px;
    line-height: 20px;
    position: relative;
    border: 1px solid #999;
    text-decoration: none;
    color: #fff;
	background: #996de9;
	border-radius: 5px;
}
.change{
    position: absolute;
    overflow: hidden;
    right: 0;
    top: 0;
    opacity: 0;
}
.upload:hover{background: #fff;color: #996de9;border-color: #996de9;}</style>
<form action="./index/heater.line/bar1" method="post" enctype="multipart/form-data">
    <a href="javascript:;" class="upload">选择文件<input class="change button" type="file" name="heater"/></a><br/><button type="submit" class="btn btn-theme" style="margin-top: 20px;margin-bottom: 50px;"><em class="fa fa-fw fa-paper-plane-o"></em>解析文件</button>
</form>