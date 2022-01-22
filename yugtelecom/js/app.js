
import gsap from "gsap"
import IMask from 'imask'
import ymaps from 'ymaps';
const tl = gsap.timeline()
const ratesList = document.querySelector('.rates_list')
const popularRates = document.querySelector('.popular')
const title = document.querySelectorAll('.title')
const loader = document.querySelector('.loader')
const offer_wrap = document.querySelector('.offer_wrap')
const burger = document.querySelector('.burger')
const mobileMenu = document.querySelector('.nav_wrap_mob')
let lastScrollTop = 0;
let accardeonItems = document.querySelectorAll('.accardeon_list_item')
const ratesBtns = document.querySelectorAll('.rates_list_item_btn')
if (document.querySelector('#y_maps')) {
  var myMap;
  var myPolygon;
  const mapContainer = document.querySelector('#y_maps')
  var poligons = JSON.parse(mapPoligons)
  function sendCoords() {
    const url = mapContainer.dataset.action
    const formdata = new FormData();
    formdata.append('action', 'handler_map');
    formdata.append('poligons', JSON.stringify(poligons));
    const params = new URLSearchParams(formdata);
    fetch(url, {
      method: 'POST',
      body: params
    })
      .then((response) => {
        return response.json()
      })
      .then((res) => {
        document.querySelector('.map_actions_message').innerHTML = ''
        document.querySelector('.map_actions_message').innerHTML = res.message
        setTimeout(() => {
          document.querySelector('.map_actions_message').innerHTML = ''
        }, 5000)
      })
      .catch(function (err) {
        console.warn('Какя то ошибка.', err)
      });
  }
  function savePolyGonLine(coords, id = null) {
    if (!id) {
      let id = poligons.length > 0 ? poligons[poligons.length - 1].id + 1 : 1
      poligons.push({ id, coords })
      sendCoords()
    } else {
      let i = poligons.findIndex(p => Number(p.id) == Number(id))
      poligons[i].coords = coords
      sendCoords()
    }
  }
  ymaps
    .load('https://api-maps.yandex.ru/2.1/?apikey=256e028a-94b5-496f-b948-394772dc151a&lang=ru_RU')
    .then(maps => {
      myMap = new maps.Map('y_maps', {
        center: [42.225084, 43.970862],
        zoom: 12,
        controls: []
      });
      if (document.querySelector('.add_polygon')) {
        document.querySelector('.add_polygon').addEventListener('click', addPolyGonLine, false)
      }
      function addPolyGonLine() {
        myPolygon = new maps.Polygon([], {}, {
          editorDrawingCursor: "crosshair",
          fillOpacity: 0.7,
          fillColor: '#84d570',
          strokeColor: '#84d570',
          interactivityModel: 'default#transparent',
          strokeWidth: 2,
          strokeOpacity: 1,
          draggable: true,
          editorMenuManager: function (items) {
            items.push({
              title: "Сохранить результат",
              onClick: function () {
                savePolyGonLine(myPolygon.geometry.getCoordinates())
                myPolygon.editor.stopEditing();
                myPolygon.editor.startEditing();
              }
            },
              {
                title: "Удалить область",
                onClick: function () {
                  myMap.geoObjects.remove(myPolygon)
                }
              });
            return items;
          }
        });
        myPolygon.editor.options.set({
          // Задаём для меток вершин опции с постфиксами, привязанными к текущему состоянию вершины.
          // Класс макета для меток на вершинах ломаной линии.
          vertexLayout: 'default#image',
          // URL графического файла.
          vertexIconImageHref: '/wp-content/themes/yugtelecom/images/dist/button3.png',
          // Размеры слоя с картинкой.
          vertexIconImageSize: [16, 16],
          // Смещение картинки относительно точки привязки.
          vertexIconImageOffset: [-8, -8],

          // Опции с данным постфиксом применяются при наведении на вершину указателя мыши.
          vertexLayoutHover: 'default#image',
          vertexIconImageSizeHover: [28, 28],
          vertexIconImageOffsetHover: [-14, -14],

          // Опции с данным постфиксом применяются, когда для вершины открыто контекстное меню.
          vertexLayoutActive: 'default#image',
          vertexIconImageHrefActive: '/wp-content/themes/yugtelecom/images/dist/button4.png',
          vertexIconImageSizeActive: [16, 16],
          vertexIconImageOffsetActive: [-8, -8],

          // Опции с данным постфиксом применяются при перетаскивании вершины.
          vertexLayoutDrag: 'default#image',
          vertexIconImageHrefDrag: '/wp-content/themes/yugtelecom/images/dist/button4.png',
          vertexIconImageSizeDrag: [16, 16],
          vertexIconImageOffsetDrag: [-8, -8],

          // Задаём для промежуточных меток опции с постфиксами, привязанными к текущему состоянию промежуточных меток.
          edgeLayout: 'default#image',
          edgeIconImageHref: '/wp-content/themes/yugtelecom/images/dist/button1.png',
          edgeIconImageSize: [16, 16],
          edgeIconImageOffset: [-8, -8],

          // Опции с данным постфиксом применяются при наведении на промежуточную метку указателя мыши.
          edgeLayoutHover: 'default#image',
          edgeIconImageSizeHover: [28, 28],
          edgeIconImageOffsetHover: [-14, -14],

          // Опции с данным постфиксом применяются при перетаскивании промежуточной метки.
          edgeLayoutDrag: 'default#image',
          edgeIconImageHrefDrag: '/wp-content/themes/yugtelecom/images/dist/button2.png',
          edgeIconImageSizeDrag: [16, 16],
          edgeIconImageOffsetDrag: [-8, -8]
        });
        myMap.geoObjects.add(myPolygon);
        myPolygon.editor.startDrawing();
      }
      poligons.forEach(p => {
        let polygon = new maps.Polygon(p.coords
          , {
            hintContent: "Карта покрытия сети"
          }, {
          fillColor: '#84d570',
          fillOpacity: 0.7,
          strokeColor: '#84d570',
          // Делаем полигон прозрачным для событий карты.
          interactivityModel: 'default#transparent',
          strokeWidth: 2,
          strokeOpacity: 1,
          editorMenuManager: function (items) {
            items.push({
              title: "Сохранить изменения",
              onClick: function () {
                savePolyGonLine(polygon.geometry.getCoordinates(), p.id)
              }
            },
              {
                title: "Удалить область",
                onClick: function () {
                  myMap.geoObjects.remove(polygon)
                  poligons = poligons.filter(pol => pol.id != p.id)
                  sendCoords()
                }
              });

            return items;
          }
        });

        polygon.editor.options.set({
          // Задаём для меток вершин опции с постфиксами, привязанными к текущему состоянию вершины.
          // Класс макета для меток на вершинах ломаной линии.
          vertexLayout: 'default#image',
          // URL графического файла.
          vertexIconImageHref: '/wp-content/themes/yugtelecom/images/dist/button3.png',
          // Размеры слоя с картинкой.
          vertexIconImageSize: [16, 16],
          // Смещение картинки относительно точки привязки.
          vertexIconImageOffset: [-8, -8],

          // Опции с данным постфиксом применяются при наведении на вершину указателя мыши.
          vertexLayoutHover: 'default#image',
          vertexIconImageSizeHover: [28, 28],
          vertexIconImageOffsetHover: [-14, -14],

          // Опции с данным постфиксом применяются, когда для вершины открыто контекстное меню.
          vertexLayoutActive: 'default#image',
          vertexIconImageHrefActive: '/wp-content/themes/yugtelecom/images/dist/button4.png',
          vertexIconImageSizeActive: [16, 16],
          vertexIconImageOffsetActive: [-8, -8],

          // Опции с данным постфиксом применяются при перетаскивании вершины.
          vertexLayoutDrag: 'default#image',
          vertexIconImageHrefDrag: '/wp-content/themes/yugtelecom/images/dist/button4.png',
          vertexIconImageSizeDrag: [16, 16],
          vertexIconImageOffsetDrag: [-8, -8],

          // Задаём для промежуточных меток опции с постфиксами, привязанными к текущему состоянию промежуточных меток.
          edgeLayout: 'default#image',
          edgeIconImageHref: '/wp-content/themes/yugtelecom/images/dist/button1.png',
          edgeIconImageSize: [16, 16],
          edgeIconImageOffset: [-8, -8],

          // Опции с данным постфиксом применяются при наведении на промежуточную метку указателя мыши.
          edgeLayoutHover: 'default#image',
          edgeIconImageSizeHover: [28, 28],
          edgeIconImageOffsetHover: [-14, -14],

          // Опции с данным постфиксом применяются при перетаскивании промежуточной метки.
          edgeLayoutDrag: 'default#image',
          edgeIconImageHrefDrag: '/wp-content/themes/yugtelecom/images/dist/button2.png',
          edgeIconImageSizeDrag: [16, 16],
          edgeIconImageOffsetDrag: [-8, -8]
        });
        // Включаем режим редактирования.

        // 3. Добавляем полигон на карту
        myMap.geoObjects.add(polygon);

        polygon.events.add("geometrychange", function (newValue) {
          polygon.options.set("strokeColor", newValue ? '#FF0000' : '#84d570');
        });

        if (document.querySelector('.edit_polygon')) {
          document.querySelector('.edit_polygon').addEventListener('click', () => {
            polygon.editor.startEditing();
          }, false)
        }
      })
    })
    .catch(error => console.log('Ошибка, не могу подгрузить карту', error));
}
function getRecaptcha(input) {
  grecaptcha.ready(function () {
    grecaptcha.execute('6LcK86odAAAAAMBrh7sttKbex2LwIL1OWJn3qo3c', { action: 'submit' }).then(function (token) {
      input.value = token
    });
  });
}
// форматируем номера телефонов на всем сайте
function phoneFormat() {
  let a = [...document.getElementsByTagName("a")]
  a.forEach(link => {
    if (link.getAttribute("href").indexOf("tel:") !== -1) {
      let phone = link.getAttribute("href").split(':')[1]
      let phoneLength = phone.length
      let tt = phone.split('')
      if (phoneLength == 11) {
        tt.splice(1, "", " (")
        tt.splice(5, "", ") ")
        tt.splice(9, "", "-")
        tt.splice(12, "", "-")
      } else if (phoneLength == 12) {
        tt.splice(2, "", " (")
        tt.splice(6, "", ") ")
        tt.splice(10, "", "-")
        tt.splice(13, "", "-")
      } else if (phoneLength == 13) {
        tt.splice(3, "", " (")
        tt.splice(7, "", ") ")
        tt.splice(11, "", "-")
        tt.splice(14, "", "-")
      }
      link.classList.add('vadik_kaprizny_designer')
      link.innerHTML = tt.join('')
    }
  });
}
phoneFormat()
// стилизуем заголовки по дизайну
title.forEach(tl => {
  let wordsArr = tl.innerHTML.split(' ')
  let span = `<span>${wordsArr[wordsArr.length - 1]}</span>`
  wordsArr.pop()
  wordsArr.push(span)
  tl.innerHTML = wordsArr.join(' ')
})
//  изменение для карточки популярного тарифа
if (popularRates) {
  let popularText = `<span class="popular_text">
                      <svg width="24" height="22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.76l-7.053 3.948 1.575-7.928L.587 8.292l8.027-.952L12 0l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928L12 17.76z" fill="#F4AE86"/></svg>
                      самый популярный
                    </span>`
  popularRates.insertAdjacentHTML('afterbegin', popularText)
}
// анимация стрелок скорости тарифа 
function animateSpeed() {
  let path = document.querySelectorAll('.speed_arrow')
  path.forEach((p, i) => {
    let speed = p.closest('.rates_list_item').dataset.speed
    let step = 800
    p.style.transform = `rotate(0deg)`
    setTimeout(() => {
      p.style.transform = `rotate(240deg)`
    }, 300)
    setTimeout(() => {
      p.style.transform = `rotate(${speed}deg)`
    }, step)
    setTimeout(() => {
      p.classList.add('ag-speedometer_needle')
    }, 1200)
    step += 800
  })
}
// запуск при прокрутке до тарифных планов анимация стрелок скорости тарифа 
window.addEventListener('scroll', () => {
  if (elementInViewport(ratesList)) {
    animateSpeed()
  }
})
// запуск при загрузке анимация стрелок скорости тарифа 
window.addEventListener('load', () => {
  if (elementInViewport(ratesList)) {
    animateSpeed()
  }
})
// отслеживание в зоне видимости ли елемент
function elementInViewport(el) {
  if (!el) return
  var top = el.offsetTop
  var left = el.offsetLeft
  var width = el.offsetWidth
  var height = el.offsetHeight
  while (el.offsetParent) {
    el = el.offsetParent
    top += el.offsetTop
    left += el.offsetLeft
  }
  return (
    top >= window.pageYOffset &&
    left >= window.pageXOffset &&
    (top + height) <= (window.pageYOffset + window.innerHeight) &&
    (left + width) <= (window.pageXOffset + window.innerWidth)
  );
}
// подкрузка формы заявки на подключение
function getForm(url) {
  offer_wrap.style.display = 'none'
  loader.style.display = 'block'
  if (document.querySelector('.application')) {
    document.querySelector('.application').remove()
  }
  return new Promise((resolve, reject) => {
    fetch(url).then(function (response) {
      return response.text()
    }).then(function (html) {
      tl.kill()
      tl.to(loader, { opacity: 0, duration: .3 }).then(res => {
        loader.style.display = 'none'
        loader.style.opacity = 1
        let offer = document.querySelector('.offer')
        offer.insertAdjacentHTML('beforeend', html)
        let form = offer.querySelector('.application')
        tl.to(form, { opacity: 1, translateY: '0px', duration: .2 })
        let rateItems = form.querySelectorAll('.rates_dd_item')
        let rateInput = form.querySelector('#rates')
        let tokenInput = form.querySelector('#token')
        let menu = form.querySelector('.rates_dd_list')
        rateInput.addEventListener('click', (e) => {
          tl.to(menu, { opacity: 1, height: 'auto', duration: .2 }).then(() => {
            document.addEventListener('click', (e) => {
              if (!menu.contains(e.target) && !form.querySelector('#rates').contains(e.target)) {
                tl.to(menu, { opacity: 0, height: '0px', duration: .2 })
              }
            })
          })
        })
        rateItems.forEach(rateItem => {
          rateItem.addEventListener('click', () => {
            tl.to(menu, { opacity: 0, height: '0px', duration: .2 })
            form.querySelector('#rates').value = rateItem.innerHTML
            form.querySelector('#rate').value = rateItem.dataset.rate
            rateItem.closest('.rates_dd')?.querySelector('.err') && rateItem.closest('.rates_dd').querySelector('.err').remove()
          })
        })
        let phone = IMask(
          form.querySelector('#phone'), {
          mask: '+{7} (000) 000-00-00',
          lazy: false,
          placeholderChar: '0'
        });
        resolve('form_done')
        getRecaptcha(tokenInput)
        let required = form.querySelectorAll('input[required]')
        required.forEach(req => {
          req.addEventListener('input', () => {
            if (req.value != '' && req.value != '+7 (000) 000-00-00') {
              req.nextElementSibling && req.nextElementSibling.remove()
              form.querySelector('.send').disabled = false
            } else {
              req.insertAdjacentHTML('afterend', '<span class="err">Это поле не заполнено</span>');
              form.querySelector('.send').disabled = true
            }
          })
        })
        form.querySelector('.send').addEventListener('click', (event) => {
          event.preventDefault()
          form.style.display = 'none'
          loader.style.display = 'block'
          let name = form.querySelector('#name').value
          let address = form.querySelector('#address').value
          let phone = form.querySelector('#phone').value
          let rates = form.querySelector('#rates').value
          let url = form.dataset.action
          let data = { action: 'handler', name, address, phone, rates }
          const formdata = new FormData();
          formdata.append('action', 'handler');
          formdata.append('name', form.querySelector('#name').value);
          formdata.append('address', form.querySelector('#address').value);
          formdata.append('phone', form.querySelector('#phone').value);
          formdata.append('rates', form.querySelector('#rates').value);
          formdata.append('rate', form.querySelector('#rate').value);
          formdata.append('token', form.querySelector('#token').value);
          const params = new URLSearchParams(formdata);
          fetch(url, {
            method: 'POST',
            body: params
          })
            .then((response) => {
              return response.json()
            })
            .then((res) => {
              tl.to(loader, { opacity: 0, duration: .2 }).then(r => {
                loader.style.display = 'none'
                document.querySelector('.offer').insertAdjacentHTML('beforeend', res.message)
                tl.to('.message', { opacity: 1, translateY: '0px', duration: .2 })
                document.querySelector('.close').addEventListener('click', () => {
                  document.querySelector('.message').remove()
                  loader.style.display = 'block'
                  loader.style.opacity = 1
                  tl.to('.message', { opacity: 0, translateY: '-450px', duration: .2 }).then(() => {
                    loader.style.display = 'none'
                    offer_wrap.style.display = 'block'
                    tl.to(offer_wrap, { opacity: 1, translateY: '0px', duration: .2 })
                  })
                })
              })
            })
        })
      })
    }).catch(function (err) {
      console.warn('Какя то ошибка.', err)
    });
  })
}
document.querySelector('.offer_btn')?.addEventListener('click', (e) => {
  getForm(e.target.dataset.action)
})
// плавная прокрутка до элемента
function smoothScroll(target, speed) {
  return new Promise((resolve, reject) => {
    let scrollContainer = target;
    do { //find scroll container
      scrollContainer = scrollContainer.parentNode;
      if (!scrollContainer) return;
      scrollContainer.scrollTop += 1;
    } while (scrollContainer.scrollTop == 0);

    let targetY = 0;
    do { //find the top of target relatively to the container
      if (target == scrollContainer) break;
      targetY += target.offsetTop;
    } while (target = target.offsetParent);

    scroll = function (c, a, b, i) {
      i++; if (i > speed) return;
      c.scrollTop = a + (b - a) / speed * i;
      setTimeout(function () { scroll(c, a, b, i); }, 15);
      if (i == speed) {
        resolve('done')
      }
    }
    // start scrolling
    scroll(scrollContainer, scrollContainer.scrollTop + 30, targetY, 0);
  })
}
// отрабатываем клик при выборе тарифа
ratesBtns.forEach(ratesBtn => {
  ratesBtn.addEventListener('click', (e) => {
    smoothScroll(document.querySelector('.offer'), 20).then(res => {
      getForm(e.target.dataset.action).then(form => {
        let items = [...document.querySelectorAll('.rates_dd_item')]
        let item = items.filter(item => item.dataset.rate == e.target.dataset.rate)
        document.querySelector('#rates').value = item[0].innerHTML
        document.querySelector('#rate').value = item[0].dataset.rate
      })
    })
  })
})
accardeonItems.forEach(accardeonItem => {
  accardeonItem.addEventListener('click', (e) => {
    let content = e.target.parentElement.querySelector('.accardeon_list_item_content')
    if (e.target.classList.contains('active')) {
      tl.to(content, { opacity: 0, height: '0', duration: .2 })
      e.target.classList.remove('active')
    } else {
      e.target.classList.add('active')
      tl.to(content, { opacity: 1, height: 'auto', duration: .2 })
    }
  })
})
burger.addEventListener('click', () => {
  burger.classList.toggle('active')
  if (burger.classList.contains('active')) {
    mobileMenu.classList.add('active')
  } else {
    mobileMenu.classList.remove('active')
  }
})
window.addEventListener("scroll", function () {
  let st = window.pageYOffset || document.documentElement.scrollTop;
  if (st > lastScrollTop) {
    document.querySelector('.social').classList.add('show')
  } else {
    document.querySelector('.social').classList.remove('show')
  }
  lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}, false);