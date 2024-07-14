// script.js

// 獲取表單元素
var form = document.getElementById('submissionForm');

// 定義表單提交函數
function submitForm() {
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

    // 發送表單數據
    xhr.send(formData);
}

// 在窗口加載後添加事件監聽器，用於提交表單
window.onload = function() {
    var submitButton = document.querySelector('#submissionForm button[type="button"]');
    submitButton.addEventListener('click', submitForm);
};
