<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訃聞提交</title>
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
        form {
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
        input, textarea, button {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #4a90e2;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #357ABD;
        }
        /* 隱藏音樂播放器界面 */
        audio {
            display: none;
        }
    </style>
</head>
<body>
    <h1>訃聞提交表單</h1>

    <!-- 音樂播放器 -->
    <audio autoplay loop>
        <source src="path/to/your/music-file.mp3" type="audio/mpeg">
        您的瀏覽器不支援音樂播放。
    </audio>

    <form id="submissionForm">
        <!-- 表單字段 -->
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="birthdate">出生日期:</label>
        <input type="date" id="birthdate" name="birthdate" required><br><br>

        <label for="deathdate">死亡日期:</label>
        <input type="date" id="deathdate" name="deathdate" required><br><br>

        <label for="age">享年:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="message">信息:</label>
        <textarea id="message" name="message" required></textarea><br><br>

        <label for="ceremony_date">儀式日期:</label>
        <input type="date" id="ceremony_date" name="ceremony_date" required><br><br>

        <label for="ceremony_time">儀式時間:</label>
        <input type="time" id="ceremony_time" name="ceremony_time" required><br><br>

        <label for="ceremony_location">儀式地點:</label>
        <input type="text" id="ceremony_location" name="ceremony_location" required><br><br>

        <label for="photos">照片:</label>
        <input type="file" id="photos" name="photos[]" multiple><br><br>

        <label for="music">音樂:</label>
        <input type="file" id="music" name="music"><br><br>

        <button type="button" onclick="submitForm()">提交</button>
    </form>

    <script>
        function submitForm() {
            // 模擬表單提交
            // 可以在這裡進行表單驗證

            // 獲取表單元素
            var form = document.getElementById('submissionForm');

            // 獲取表單數據，可以使用FormData API
            var formData = new FormData(form);

            // 發送POST請求到伺服器端
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'path/to/your/server-script.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // 成功處理返回的數據
                        console.log(xhr.responseText);
                        alert('表單提交成功！');
                    } else {
                        // 處理錯誤情況
                        alert('發生錯誤：' + xhr.status);
                    }
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
