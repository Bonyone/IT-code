
document.addEventListener('DOMContentLoaded', function () {
    var video = document.getElementById('myVideo');
    var contentContainer = document.getElementById('content-container');

    window.addEventListener('load', function () {
        video.play();

        // Устанавливаем таймер для плавного исчезновения видео через 6 секунд
        setTimeout(function () {
            video.style.opacity = '0';
        }, 6000);

        // После окончания видео, перейти на главную страницу
        video.addEventListener('ended', function () {
            window.location.href = "index.php";
        });
    });
});

function changeLanguage(lang) {
    alert('Изменение языка на ' + lang);
}

function openContactPage() {
    alert('Открывается страница "Võta ühendust"');
}

window.addEventListener('scroll', function () {
    document.body.classList.toggle('scrolled', window.scrollY > 0);
});





