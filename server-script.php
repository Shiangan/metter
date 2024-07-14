<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 接收表單數據
    $name = $_POST['name'];
    $birthdate = $_POST['birthdate'];
    $deathdate = $_POST['deathdate'];
    $age = $_POST['age'];
    $message = $_POST['message'];
    $ceremony_date = $_POST['ceremony_date'];
    $ceremony_time = $_POST['ceremony_time'];
    $ceremony_location = $_POST['ceremony_location'];

    // 處理照片上傳
    $photo_paths = [];
    if (isset($_FILES['photos'])) {
        $photos = $_FILES['photos'];
        for ($i = 0; $i < count($photos['name']); $i++) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($photos['name'][$i]);
            if (move_uploaded_file($photos['tmp_name'][$i], $target_file)) {
                $photo_paths[] = $target_file;
            }
        }
    }

    // 處理音樂上傳
    $music_path = "";
    if (isset($_FILES['music']) && $_FILES['music']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['music']['name']);
        if (move_uploaded_file($_FILES['music']['tmp_name'], $target_file)) {
            $music_path = $target_file;
        }
    }

    // 生成訃聞詳細頁面
    $detail_page = "
    <!DOCTYPE html>
    <html lang='zh-Hant'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>訃聞詳細信息</title>
        <style>
            body {
                font-family: 'Noto Sans TC', sans-serif;
                background: linear-gradient(to bottom, #f0f4f8, #d9e2ec);
                color: #333;
                margin: 0;
                padding: 0;
            }
            header {
                background-color: #4a90e2;
                color: #fff;
                text-align: center;
                padding: 1rem 0;
            }
            .container {
                max-width: 800px;
                margin: 2rem auto;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            h1, h2 {
                text-align: center;
            }
            .photos {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                margin: 1rem 0;
            }
            .photos img {
                max-width: 100%;
                margin: 0.5rem;
                border-radius: 8px;
            }
            audio {
                display: none;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>訃聞詳細信息</h1>
        </header>
        <div class='container'>
            <h2>姓名: $name</h2>
            <p>出生日期: $birthdate</p>
            <p>死亡日期: $deathdate</p>
            <p>享年: $age</p>
            <p>信息: $message</p>
            <h3>儀式信息</h3>
            <p>日期: $ceremony_date</p>
            <p>時間: $ceremony_time</p>
            <p>地點: $ceremony_location</p>
            <div class='photos'>";
            foreach ($photo_paths as $photo) {
                $detail_page .= "<img src='$photo' alt='照片'>";
            }
            $detail_page .= "</div>
        </div>
        <!-- 音樂播放器 -->
        <audio autoplay loop>
            <source src='$music_path' type='audio/mpeg'>
            您的瀏覽器不支援音樂播放。
        </audio>
    </body>
    </html>";

    // 將訃聞詳細頁面保存為HTML文件
    $filename = "details_" . uniqid() . ".html"; // 生成唯一的文件名
    $filepath = "generated_pages/" . $filename; // 文件保存路徑

    file_put_contents($filepath, $detail_page);

    // 重定向用戶到生成的訃聞詳細頁面
    header("Location: $filepath");
    exit;
}
?>
