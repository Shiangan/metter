<?php
// 启用错误报告
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 调试输出，查看接收到的数据
    var_dump($_POST);
    var_dump($_FILES);

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
    $photos = $_FILES['photos'];
    $music = $_FILES['music'];

    // 保存到服务器的路径
    $photosPath = 'path/to/your/photo-directory/';
    $musicPath = 'path/to/your/music-directory/';

    // 检查路径是否存在，不存在则创建
    if (!is_dir($photosPath)) {
        mkdir($photosPath, 0777, true);
    }
    if (!is_dir($musicPath)) {
        mkdir($musicPath, 0777, true);
    }

    // 保存文件
    foreach ($photos['tmp_name'] as $key => $tmp_name) {
        $photoName = $photos['name'][$key];
        move_uploaded_file($tmp_name, $photosPath . $photoName);
    }
    
    if (!empty($music['name'])) {
        $musicName = $music['name'];
        move_uploaded_file($music['tmp_name'], $musicPath . $musicName);
    }

    // 生成 obituary 页面的内容
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
                <!-- 根据需要插入照片 -->
            </div>
        </body>
        </html>
    ";

    // 写入生成的 obituary.html 文件
    $obituaryFile = fopen("Obituary.html", "w") or die("無法打開檔案！");
    fwrite($obituaryFile, $obituaryContent);
    fclose($obituaryFile);

    // 成功后返回数据
    echo "Success";
} else {
    // 如果不是 POST 请求，返回错误信息
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
