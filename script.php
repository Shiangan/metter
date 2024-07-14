<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单提交的数据
    $name = $_POST['name'];
    // 获取其他表单字段

    // 生成要写入到 obituary.php 的内容
    $obituaryContent = "
        <!DOCTYPE html>
        <html lang=\"zh-Hant\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>{$name} 的訃聞</title>
            <style>
                /* 样式略 */
            </style>
        </head>
        <body>
            <div class=\"container\">
                <h1>{$name} 的訃聞</h1>
                <!-- 显示其他表单字段的内容 -->
            </div>
        </body>
        </html>
    ";

    // 写入生成的 obituary.php 文件
    $obituaryFile = fopen("obituary.php", "w") or die("无法打开文件！");
    fwrite($obituaryFile, $obituaryContent);
    fclose($obituaryFile);

    // 成功后重定向到 obituary.php 页面
    header("Location: obituary.php");
    exit();
}
?>
