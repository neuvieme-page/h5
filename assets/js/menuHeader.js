var input = document.querySelector('.menuHeader-input');
var clearInput = document.querySelector('.menuHeader-clearInput');
var results = document.querySelector('.menuHeader-list');

var ajax = function(method, url, fn) {
    const xhr = new XMLHttpRequest();
    xhr.addEventListener('load', function() {
        if (xhr.readyState === 4) {
            fn(JSON.parse(xhr.response));
        }
    });
    xhr.open(url, method);
    xhr.send();
} 

clearInput.addEventListener('click', function() {
    input.value = '';
});

input.addEventListener('keypress', function() {
    if (input.value.length < 2) {
        return
    }

    ajax('GET', '../../api/search.php', function(data) {
        results.innerHTML = '';
        var memo;
        for (let i = 0; i < data.length; i++) {
            for (let a = 0; a < input.value.length; a++) {
                memo +=  data[i].title[a]
            }
            if (memo == input.value) {
                showItem(data[i]);
            }
        }
    });
});

function showItem(itemToShow) {
    results.innerHTML = '<li class="menuHeader-item">';
    results.innerHTML += '<div class="menuHeader-flex">';
    results.innerHTML += '<img class="menuHeader-item-img" src="<?php bloginfo("template_directory");?>/assets/images/' + content.jpg + '" alt="">';
    results.innerHTML += '<div class="menuHeader-item-texts">';
    results.innerHTML += '<p>' + Lacoste + '</p>';
    results.innerHTML += '<p>' + Xmas + '</p>';
    results.innerHTML += '</div>';
    results.innerHTML += '</div>';
    results.innerHTML += '<p class="menuHeader-item-category">' + FILM + '</p>';
    results.innerHTML += '</li>';
}