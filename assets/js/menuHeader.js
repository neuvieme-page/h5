var input = document.querySelector('.menuHeader-input');
var clearInput = document.querySelector('.menuHeader-clearInput');
var results = document.querySelector('.menuHeader-list');
var pathInput = document.querySelector('.menuHeader-pathInput')
var path = pathInput.value;

clearInput.addEventListener('click', function() {
    input.value = '';
});

var ajax = function(method, url, callback) {
    var xhr = new XMLHttpRequest();

    xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('responseText :' + xhr.responseText);
            try {
                var data = JSON.parse(xhr.responseText);
                callback(data);
            } catch (err) {
                console.log(err.message);
                return;
            }
        }
    });
    
    xhr.open(method, url);
    xhr.send(null);
}

input.addEventListener('keypress', function() {
    if (input.value.length < 2) {
        return
    }
    ajax('GET', path, function(data) {
        var memo;
        results.innerHTML = '';
        for (let i = 0; i < data.length; i++) {
            memo = '';
            for (let a = 0; a < input.value.length; a++) {
                memo += data[i].title[a];
            }
            var memo_uppercase = memo.toUpperCase();
            var input_uppercase = input.value.toUpperCase();
            if (memo_uppercase == input_uppercase) {
                showItem(data[i]);
            }
        }
    });
});

function showItem(itemToShow) {
    results.innerHTML = '<li class="menuHeader-item">' +
        '<a class="menuHeader-link" href="">' +
        '<div class="menuHeader-flex">' +
        '<img class="menuHeader-item-img" src="' + itemToShow.image + '" alt="test">' +
        '<div class="menuHeader-item-texts">' +
        '<p>' + itemToShow.title + '<span> (' + itemToShow.year + ')</span></p>' +
        '<p>' + itemToShow.second_title + '</p>' +
        '</div>' +
        '</div>' +
        '<p class="menuHeader-item-category">' + 'FILM' + '</p>' +
        '</a>' +
        '</li>';
}