document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const deceasedName = urlParams.get('deceasedName');
    const birthDate = urlParams.get('birthDate');
    const deathDate = urlParams.get('deathDate');
    const funeralDate = urlParams.get('funeralDate');
    const funeralLocation = urlParams.get('funeralLocation');
    const hall = urlParams.get('hall');
    const textStyle = urlParams.get('textStyle');
    const sendFlowerBasket = urlParams.get('sendFlowerBasket');
    const gender = urlParams.get('gender');
    const musicChoice = urlParams.get('musicChoice');

    const age = calculateAge(birthDate, deathDate);
    const ageTerm = getAgeTerm(age);

    let obituaryText = '';

    if (textStyle === 'traditional') {
        obituaryText = `
            <p>我們摯愛的${gender === 'male' ? '先生' : '女士'}${deceasedName}於${deathDate}逝世，${ageTerm}${age}歲</p>
            <p>出殯日期: ${funeralDate}</p>
            <p>出殯地點: ${funeralLocation}</p>
            <p>禮廳: ${hall}</p>
        `;
    } else {
        obituaryText = `
            <h2>${deceasedName}</h2>
            <p>${deathDate}逝世，${ageTerm}${age}歲</p>
            <p>出殯日期: ${funeralDate}</p>
            <p>出殯地點: ${funeralLocation}</p>
            <p>禮廳: ${hall}</p>
        `;
    }

    document.getElementById('obituary-content').innerHTML = obituaryText;

    if (sendFlowerBasket === 'yes') {
        document.getElementById('flower-basket-section').innerHTML = `
            <h2>花籃</h2>
            <p>由公司統一製作花籃，給予無限祝福。</p>
        `;
    }

    const music = new Audio(`path/to/${musicChoice}.mp3`);
    music.loop = true;
    music.play();

    const messagesContainer = document.getElementById('messages-container');
    const messageInput = document.getElementById('message-input');

    window.addMessage = function() {
        const message = messageInput.value;
        if (message.trim() !== '') {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            messagesContainer.appendChild(messageElement);
            messageInput.value = '';
        }
    };

    function calculateAge(birthDate, deathDate) {
        const birth = new Date(birthDate);
        const death = new Date(deathDate);
        return death.getFullYear() - birth.getFullYear();
    }

    function getAgeTerm(age) {
        if (age < 30) return '得年';
        if (age < 60) return '享年';
        if (age < 90) return '享壽';
        if (age < 100) return '享耆壽';
        return '享嵩壽';
    }
});
