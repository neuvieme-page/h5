function initSearch() {
  var input = document.querySelector('.menuHeader-input');
  var clearInput = document.querySelector('.menuHeader-clearInput');
  var results = document.querySelector('.menuHeader-list');
  var pathInput = document.querySelector('.menuHeader-pathInput');
  var path;
  var searchBtn = document.querySelector('.searchBtn');
  console.log(searchBtn);
  if (pathInput) {
    path = pathInput.value;
  }
  var formWrapper = document.querySelector('.menuHeader');
  var closePopin = document.querySelector('.closePopin');
  if (closePopin) {
    closePopin.addEventListener('click', function(e) {
      document.body.classList.remove('showForm');
    });
  }
  if (clearInput) {
    clearInput.addEventListener('click', function() {
      input.value = '';
      results.innerHTML = '';
      formWrapper.classList.remove('typing');
    });
  }

  if (searchBtn) {
    searchBtn.addEventListener('click', function(e) {
      console.log('click');
      document.body.classList.add('showForm');
    });
  }

  var ajax = function(method, url, callback) {
    var xhr = new XMLHttpRequest();

    xhr.addEventListener('readystatechange', function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        //console.log('responseText :' + xhr.responseText);
        try {
          var data = JSON.parse(xhr.responseText);
          callback(data);
        } catch (err) {
          console.log(err.message);
          return;
        }
      }
    });

    xhr.open(method, url + '?s=' + input.value);
    xhr.send(null);
  };

  if (input) {
    input.addEventListener('keypress', function() {
      if (input.value.length < 2) {
        formWrapper.classList.remove('typing');
        return;
      } else {
        formWrapper.classList.add('typing');
      }
      ajax('GET', path, function(data) {
        results.innerHTML = '';
        for (var i = 0; i < data.length; i++) {
          showItem(data[i]);
        }
      });
    });
  }
  function showItem(itemToShow) {
    console.log(itemToShow);
    var _item =
      '<li class="menuHeader-item">' +
      '<a class="menuHeader-link" href="">' +
      '<div class="menuHeader-flex">' +
      '<img class="menuHeader-item-img" src="' +
      itemToShow.image +
      '" alt="test">' +
      '<div class="menuHeader-item-texts">' +
      '<p>' +
      itemToShow.title +
      '<span> (' +
      itemToShow.year +
      ')</span></p>' +
      '<p>' +
      itemToShow.second_title +
      '</p>' +
      '</div>' +
      '</div>' +
      '<p class="menuHeader-item-category">' +
      'FILM' +
      '</p>' +
      '</a>' +
      '</li>';
    results.innerHTML += _item;
  }
}

window.setTimeout(initSearch, 500);
