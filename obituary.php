<?php
$data = json_decode(file_get_contents('obituary_data.json'), true);
?>

<!doctype html>
<html lang="zh-Hant">
<head>
  <meta charset="utf-8">
  <title>訃聞 - 祥安生命禮儀公司</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: 'Arial, sans-serif';
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #4a4a4a;
      color: white;
      padding: 1rem 0;
      text-align: center;
    }

    section {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .tribute {
      text-align: center;
      margin-bottom: 2rem;
    }

    .tribute h2 {
      color: #4a4a4a;
    }

    .tribute p {
      color: #777;
    }

    .slideshow-container {
      max-width: 100%;
      position: relative;
      margin: auto;
    }

    .slides {
      display: none;
    }

    .slides img {
      width: 100%;
      border-radius: 8px;
    }

    .active {
      display: block;
    }

    footer {
      text-align: center;
      padding: 1rem 0;
      color: #777;
    }
  </style>
  <script>
    let slideIndex = 0;
    function showSlides() {
      const slides = document.getElementsByClassName("slides");
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}
      slides[slideIndex-1].style.display = "block";
      setTimeout(showSlides, 3000);
    }
  </script>
</head>
<body onload="showSlides()">
  <header>
    <h1>訃聞</h1>
  </header>

  <section>
    <div class="tribute">
      <h2><?php echo $data['name']; ?></h2>
      <p>享年 <?php echo $data['age']; ?> 歲</p>
      <p>出生日期: <?php echo $data['birthdate']; ?></p>
      <p>逝世日期: <?php echo $data['deathdate']; ?></p>
    </div>

    <div class="tribute-content">
      <h2>訃聞內容</h2>
      <p><?php echo nl2br($data['message']); ?></p>
      <p>家屬謹訂於 <?php echo $data['ceremony_date']; ?> 舉行告別式，時間 <?php echo $data['ceremony_time']; ?>，地點：<?php echo $data['ceremony_location']; ?>。</p>
    </div>

    <div class="slideshow-container">
      <h2>照片輪播</h2>
      <?php foreach ($data['photos'] as $photo): ?>
        <div class="slides">
          <img src="<?php echo $photo; ?>" alt="照片">
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section>
    <h2>背景音樂</h2>
    <audio controls autoplay loop>
      <source src="<?php echo $data['music']; ?>" type="audio/mpeg">
      您的瀏覽器不支援音頻元素。
    </audio>
  </section>

  <footer>
    <p>© 2024 祥安生命禮儀公司 | 地址: 台北市某某路123號 | 聯絡電話: 0938-179-858</p>
  </footer>
</body>
</html>
