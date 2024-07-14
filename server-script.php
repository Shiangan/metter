<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 表单提交的数据
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $deathdate = $_POST['deathdate'];
    $age = $_POST['age'];
    $message = $_POST['message'];
    $ceremony_date = $_POST['ceremony_date'];
    $ceremony_time = $_POST['ceremony_time'];
    $ceremony_location = $_POST['ceremony_location'];

    // 处理上传的照片和音乐文件
    // 请根据需要自行处理文件上传，并保存到服务器指定的目录

    // 生成 obituary 页面内容
    $obituaryContent = "
        <!DOCTYPE html>
        <html lang=\"zh-Hant\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>{$name} 的訃聞</title>
            <style>
                body {
                    font-family: 'Noto Sans TC', sans-serif;
                    background: linear-gradient(to bottom, #f0f4f8, #d9e2ec);
                    color: #333;
                    margin: 0;
                    padding: 2rem;
                }
                h1 {
                    text-align: center;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 2rem;
                    background: rgba(255, 255, 255, 0.9);
                    border-radius: 8px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
                label {
                    display: block;
                    margin-bottom: 0.5rem;
                    font-weight: bold;
                }
                p {
                    margin-bottom: 1rem;
                }
                img {
                    max-width: 100%;
                    border-radius: 8px;
                    margin-bottom: 1rem;
                }
            </style>
        </head>
        <body>
            <div class=\"container\">
                <h1>{$name} 的訃聞</h1>
                <p>姓名: {$name}</p>
                <p>出生日期: {$birthdate}</p>
                <p>死亡日期: {$deathdate}</p>
                <p>享年: {$age}</p>
                <p>信息: {$message}</p>
                <h3>儀式信息</h3>
                <p>日期: {$ceremony_date}</p>
                <p>時間: {$ceremony_time}</p>
                <p>地點: {$ceremony_location}</p>
                <!-- 照片部分 -->
                <!-- 这里可以根据需要插入照片 -->
            </div>
        </body>
        </html>
    ";

    // 写入生成的 obituary.html 文件
    $obituaryFile = fopen("obituary.html", "w") or die("无法打开文件！");
    fwrite($obituaryFile, $obituaryContent);
    fclose($obituaryFile);

    // 成功后重定向到 obituary.html 页面
    header("Location: obituary.html");
    exit();
}
?>
