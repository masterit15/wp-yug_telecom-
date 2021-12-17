// // Import jQuery module (npm i jquery)
import $ from 'jquery'
import detect from '../libs/browser.detect.min'
import gsap from 'gsap'

window.jQuery = $
window.$ = $
let owl_carousel = require('owl.carousel');
window.fn = owl_carousel;
const tl = gsap.timeline()
require('air-datepicker')
require('select2')
require('magnific-popup')
require('../libs/masonry.min.js')
window.onload = ()=>{
    $('.loader').fadeOut(200)
}

document.addEventListener('DOMContentLoaded', () => {

    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));
        return {
          'total': t,
          'days': days,
          'hours': hours,
          'minutes': minutes,
          'seconds': seconds
        };
    }
      
    function initializeClock(id, endtime) {
        var clock = document.getElementById(id);
        var daysSpan = clock.querySelector('.days');
        var hoursSpan = clock.querySelector('.hours');
        var minutesSpan = clock.querySelector('.minutes');
        var secondsSpan = clock.querySelector('.seconds');
      
        function updateClock() {
          var t = getTimeRemaining(endtime);

          if (t.total <= 0) {
            $('#countdown').html(`<div id="deadline-message">Урааа!</div>`)
            clearInterval(timeinterval);
            return true
          }

          daysSpan.innerHTML = t.days;
          hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
          minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
          secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        }
      
        updateClock();
        var timeinterval = setInterval(updateClock, 1000);
    }
      
    var deadline=$('.countdown').data('deadline'); //for Ukraine

    initializeClock('countdown', deadline);


    const sections = [...document.querySelectorAll('#top li')]//.filter(sec=> sec.id != 'offer')
    function chunkArray(array, chunk) {
        const newArray = [];
        for (let i = 0; i < array.length; i += chunk) {
            newArray.push(array.slice(i, i + chunk));
        }
        return newArray;
    }
    const sectionsArr = chunkArray(sections, 2);
    sectionsArr[1].reverse().forEach(section => {
        $('.menu li.logo').after($(section)) 
    });
    sectionsArr[0].forEach(section => { 
        $('.menu li.logo').before($(section)) 
    });
    function initPrintFuncktion(){
        $('.news_item_print').on('click', function(){
            PrintElem('.news_single')
        })
        function PrintElem(elem){
            let newsDate = document.querySelector(elem).querySelector('.news_item_date').innerHTML
            let newsView = document.querySelector(elem).querySelector('.news_item_view').innerHTML
            let newsTitle = document.querySelector(elem).querySelector('.news_item_title').innerHTML
            let newsContent = document.querySelector(elem).querySelector('.news_item_content').innerHTML
            let newsMedia = document.querySelector(elem).querySelector('.news_item_media').style.backgroundImage.match(/"((?:[^"]|(?<=\\)")*)"/)[1]
            console.log(newsMedia);
            let mywindow = window.open('', 'PRINT', 'height=400,width=600');
            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(
                `
                <div class="print_content">
                    <h1 class="title">${newsTitle}</h1>
                    <img class="media" src="${newsMedia}" width="500"/>
                    <p class="content">${newsContent}</p>
                    <ul>
                        <li><b>Дата публикации:</b> ${newsDate}</li>
                        <li><b>Количество просмотров:</b> ${newsView}</li>
                    </ul>
                </div>
                `

            );
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.focus();
            mywindow.print();
            mywindow.close();
            return true;
        }
    }
    initPrintFuncktion()
    $('.paralax').each(function(){
        var $paralax = $(this); // создаем объект
        $(window).on('scroll', function() {
            var y = ($(window).scrollTop() / $paralax.data('speed')); // вычисляем коэффициент 
            var yD = ($(window).scrollTop() / 1.4); // вычисляем коэффициент 
            // console.log(y);
            $paralax.css('transform', `translateY(${y}px)`);
            $('.offer_text h1').css('transform', `translateY(${yD}px)`);
        });
    });
    // слайдер альбомов
    function sortAlbum(){
        let card = [...$('.stack_card_item')];
        card.forEach((cd, i)=>{
            $('.stack_card_list').prepend($(cd))
        })
    }
    function galleriSlider(){
        var lastCard = $(".stack_card_list .stack_card_item").length - 1;
        sortAlbum()
        $('.stack_card_item:first').addClass('first')
        $('.next').on("click", function(){ 
            var prependList = function() {
                if( $('.stack_card_item').hasClass('activeNow') ) {
                    var $slicedCard = $('.stack_card_item').slice(lastCard).removeClass('transformThis activeNow');
                    $('ul.stack_card_list').prepend($slicedCard);
                    let total = Number($('ul.stack_card_list').data('total'))
                    let count = Number($('ul.stack_card_list').children().length)
                    let url = $('ul.stack_card_list').data('url')
                    if(total > count && $('.stack_card_item:last').prev().hasClass('first')){
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {action: 'next_album', id: $('.stack_card_item:last').prev().data('id')},
                            success: function (res) {
                                $('.stack_card_item.first').before(res).removeClass('first')
                                lastCard++
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        })
                    }
                    clickInit()
                }
            }
            $('li.stack_card_item').last().removeClass('transformPrev').addClass('transformThis').prev().addClass('activeNow');
            setTimeout(function(){prependList(); }, 150);
                    
        });

        $('.prev').on("click", function() {
            var appendToList = function() {
                if( $('.stack_card_item').hasClass('activeNow') ) {
                    var $slicedCard = $('.stack_card_item').slice(0, 1).addClass('transformPrev');
                    $('.stack_card_list').append($slicedCard);
                    clickInit()
                }}
            $('li.stack_card_item').removeClass('transformPrev').last().addClass('activeNow').prevAll().removeClass('activeNow');
            setTimeout(function(){appendToList();}, 150);
        });
        clickInit()
    }

    $('.filter_sort_btn').on('click', function(){
        let $wrapper = $('.stack_card_list');
        if(!$($wrapper).hasClass('full')){
            var result = $('.stack_card_item').sort(function (a, b) {

                var contentA =parseInt( $(a).data('id'));
                var contentB =parseInt( $(b).data('id'));
                return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
             });
             $($wrapper).html(result);
             
            $('.stack_card_list').addClass('full')
            $('.stack_card_actions').addClass('loadmore')
        }else{
            $wrapper.find('.stack_card_item').sort(function(a, b) {
                return +a.dataset.id - +b.dataset.id;
            })
            .appendTo($wrapper)
            $('.stack_card_actions').removeClass('loadmore')
            $('.stack_card_list').removeClass('full')
        }
        clickInit()
    })
    $('#loadmore_g').on('click', function(){
        let id = $('.stack_card_item:last').data('id')
        let total = Number($('ul.stack_card_list').data('total'))
        let count = Number($('ul.stack_card_list').children().length)
        if(total == count){
            $(this).addClass('disable')
        }else{
            $(this).removeClass('disable')
        }
        let url = $('ul.stack_card_list').data('url')
        if(total > count){
            $.ajax({
                url: url,
                type: 'POST',
                data: {action: 'next_album', id},
                success: function (res) {
                    $('.stack_card_item.first').after(res).removeClass('first')
                    clickInit()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            })
        }
    })
    // masonry 
    const $grid = $('.gallery_single').masonry({
        columnWidth: 260,
        fitWidth: true,
        horizontalOrder: true,
        itemSelector: '.gallery_item',
        percentPosition: true,
        transitionDuration: 0,
        gutter: 20
    });
    
    // popup gallery
    $('.gallery_single').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
          /*titleSrc: function(item) {
            return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
          }*/
        },
        callbacks: {
          elementParse: function(item) {
            if($(item.el).hasClass('popup-youtube')) {
                item.type = 'iframe';
            } else {
                item.type = 'image';
            }
          }
        },
    });
    function loadAlbumGllery(id){
        let url = $('.stack_card_list').data('url')
        $.ajax({
            url: url,
            type: 'POST',
            data: {action: 'single_gallery', id},
            beforeSend: function () {
                tl.to($('.gallery_item'), { scale: 0.7, opacity: 0, duration: 0.1, stagger: 0.1 })
            },
            success: function (res) {
                $('.gallery_single').html(res)
                let items = [...$('.gallery_item')]
                const even = n => !(n % 2)
                items.forEach(item=>{
                    let h = Math.floor(Math.random() * 343) + 144;
                    let height = even(h) ? 'height-343' : 'height-144'
                    $(item).addClass(height)
                    $grid.masonry()
                    .append( item )
                    .masonry( 'appended', item)
                    .masonry();
                })
                tl.to($('.gallery_item'), { scale: 1, opacity: 1, duration: 0.2, stagger: 0.1 })
            },
            complete: function () {

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })
    }
    function clickInit(){
        $('.stack_card_item:last, .full .stack_card_item').one('click', function(){{
            loadAlbumGllery($(this).data('id'))
        }})
    }
    galleriSlider()
    
    // закрываем элементы при клике вне блока
    $(document).on("click", function(event) {
        if (!$(event.target).hasClass('outsideclick') && $(event.target).closest(".outsideclick").length === 0) {
            $('.form_volunteer').parent().removeClass('active')
            $('.form').removeClass('show')
            $('.card_popup').removeClass('show')
            setTimeout(() => {
                $('.form').remove()
                $('.card_popup').remove()
            }, 200)
        }
    });
    // добавляем активный класс label при взаимодействии с полем ввода
    $('.input').on('input', function() {
        let label = $(this).closest('.group').children('.label');
        if ($(this).val().length > 0) {
            $(label).addClass('active')
        } else {
            $(label).removeClass('active')
        }
    })
    // определяем что за браузер
    const user = detect.parse(navigator.userAgent);
    if (user.browser.family == 'IE') {
        $('.header').addClass('damn_it_internet_explorer')
        alert('Ваш браузер Internet Explorer, сайт может отображается не коректно, скачайте нормальный браузер!')
    }

    function phoneFormat(){
        var phone = $('a[data-phone]')
        var lenPhone = $(phone).data('phone').length;
        var tt = $(phone).data('phone').split('');
        if(lenPhone == 12){
            tt.splice(2,"", " (");
            tt.splice(6,"", ") ");
            tt.splice(10,"", "-");
            tt.splice(13,"", "-");
        }else if(lenPhone == 13){
            tt.splice(3,"", " (");
            tt.splice(7,"", ") ");
            tt.splice(11,"", "-");
            tt.splice(14,"", "-");
        }
        $(phone).html(`<i class="far fa-phone"></i> ${tt.join('')}`)
    }
    phoneFormat()

    // кнопка мобильного меню
    $('#mobnav').on('click', function() {
        $(this).toggleClass('active')
        if ($(this).hasClass('active')) {
            // $('.header').addClass('full')
            setTimeout(() => {
                $('.nav_wrap_mob').slideDown(200)
            }, 100)
        } else {
            $('.nav_wrap_mob').slideUp(200)
        }
    })

    // плавный скрол до якоря по клику на ссылку
    $('.section_nav_link a').on('click', function() {
        let elId = $(this).attr('href').split('#')
        $('html, body').animate({
            scrollTop: $(`#${elId[1]}`).offset().top
        }, 800);
    })
    // табы
    $('.tabs_item').on('click', function() {
        // let items = $('.tabs_content').find('.card_item')
        // tl.set(items, {x: 100, y: 50, opacity: 1}, 1).reverse()
        $('.tabs_item').removeClass('active')
        $('.tabs_content').removeClass('active')
        let index = $(this).addClass('active').data('item')
        $('.tabs_content').fadeOut(200)
        let tabContent = $('.tabs_content[data-content="' + index + '"]').addClass('active').fadeIn(200)
        if(index == 2){ loadAlbumGllery($('.stack_card_item:last').data('id'))}else{$('.gallery_single').html('')}

    })
    // кнопки поделится
    $('.news_detail_socicon a').on('click', function() {
        let soc = $(this).data('soc')
        let purl = $(this).data('purl')
        let ptitle = $(this).data('ptitle')
        let pimg = $(this).data('pimg')
        let text = $(this).data('text')
        share(soc, purl, ptitle, pimg, text)
    })
    function share(soc, purl, ptitle, pimg, text) {
        let url = ''
        const Share = {
            vkontakte: function(purl, ptitle, pimg, text) {
                url = 'http://vkontakte.ru/share.php?';
                url += 'url=' + encodeURIComponent(purl);
                url += '&title=' + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&image=' + encodeURIComponent(pimg);
                url += '&noparse=true';
                Share.popup(url);
            },
            odnoklassniki: function(purl, text) {
                url = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
                url += '&st.comments=' + encodeURIComponent(text);
                url += '&st._surl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            facebook: function(purl, ptitle, pimg, text) {
                url = 'http://www.facebook.com/sharer.php?s=100';
                url += '&p[title]=' + encodeURIComponent(ptitle);
                url += '&p[summary]=' + encodeURIComponent(text);
                url += '&p[url]=' + encodeURIComponent(purl);
                url += '&p[images][0]=' + encodeURIComponent(pimg);
                Share.popup(url);
            },
            twitter: function(purl, ptitle) {
                url = 'http://twitter.com/share?';
                url += 'text=' + encodeURIComponent(ptitle);
                url += '&url=' + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            mailru: function(purl, ptitle, pimg, text) {
                url = 'http://connect.mail.ru/share?';
                url += 'url=' + encodeURIComponent(purl);
                url += '&title=' + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&imageurl=' + encodeURIComponent(pimg);
                Share.popup(url)
            },

            popup: function(url) {
                window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
            }
        };
        switch (soc) {
            case 'vk':
                Share.vkontakte(purl, ptitle, pimg, text)
                break;
            case 'fb':
                Share.facebook(purl, ptitle, pimg, text)
                break;
            case 'tw':
                Share.twitter(purl, ptitle, pimg, text)
                break;

        }

    }
    let filterParams = {
        current_page: 0,
        dateFrom: '',
        dateTo: '',
        action: 'newsFilter',
        type: 'post',
        sort: 'date',
    }
    // отслеживаем изменения параметров фильтра
    let filterProxied = new Proxy(filterParams, {
        get: function(target, prop) {
            // console.log({
            // 	type: "get",
            // 	target,
            // 	prop
            // });
            return Reflect.get(target, prop);
        },
        set: function(target, prop, value) {
            // console.log({
            // 	type: "set",
            // 	target,
            // 	prop,
            // 	value
            // });
            setTimeout(()=>{
                if(target.action = 'newsFilter'){
                    filterNews(target, '.news_list')
                }else{
                    filterNews(target, '.stack_card_list')
                }
            },10)
            
            return Reflect.set(target, prop, value);
        }
    });
    // сортировка новостей
    $('select.filter_sort').select2({
        minimumResultsForSearch: -1
    });
    $('select.filter_sort').on('select2:select', function (e) { 
        filterProxied.sort = e.target.value
        
    });
    // филтр по дате 
    $('.datepicker-news').datepicker({
        range: true,
        multipleDates: true,
        onSelect: function(formattedDate, date, inst) {
            if (formattedDate.includes(' - ')) {
                let dateArr = formattedDate.split(' - ')
                filterProxied.dateFrom = dateArr[0]
                filterProxied.dateTo = dateArr[1]
            } else {
                filterProxied.dateFrom = formattedDate
                filterProxied.dateTo = ''
            }
        }
    })
    $('.datepicker-gallery').datepicker({
        range: true,
        multipleDates: true,
        onSelect: function(formattedDate, date, inst) {
            filterProxied.type = 'gallery'
            if (formattedDate.includes(' - ')) {
                let dateArr = formattedDate.split(' - ')
                filterProxied.dateFrom = dateArr[0]
                filterProxied.dateTo = dateArr[1]
            } else {
                filterProxied.dateFrom = formattedDate
                filterProxied.dateTo = ''
            }
        }
    })
    
    // функция для запроса новостей
    function filterNews(params, container) {
        // params['ppp'] = $('.news_list').children().length > 4 ? $('.news_list').children().length : 4
        $.ajax({
            type: "POST",
            url: $('.news_list').data('action'),
            data: params,
            beforeSend: function() {
                // $('.loader').attr('data-filter', localStorage.petsType).fadeIn(100)
            },
            success: function(res) {
                if($(res).length < 3){
                    $(container).addClass('full')
                }
                if(res) { 
                    $(container).html(res)
                    $('#loadmore_gs').show();
                    
                }
                if(params.action == 'galleryFilter'){
                    sortAlbum()
                }
                initClickToOne()
                clickInit()
            },
            complete: function() {

            },
            error: function(err) {
                console.error('success', err);
            }
        });
    }
    // load more post
    let current_page = $('#loadmore_gs').data('paged')
    let max_pages = $('#loadmore_gs').data('total_pages')
    let ppp = $('#loadmore_gs').data('total_post')
    $('body').on('click', '#loadmore_gs', function(){
        let total = $(this).data('total_post')
        let count = $('.news_list').children('.news_item').length
        if(total == count){
            $(this).addClass('disable')
        }else{
            $(this).removeClass('disable')
        }
        if(total > count){
            $(this).text('Загрузка...');
            $.ajax({
                type: "POST",
                url: $('.news_list').data('action'),
                data: {action: 'newsFilter', current_page},
                beforeSend: function() {
                    // $('.loader').attr('data-filter', localStorage.petsType).fadeIn(100)
                },
                success: function(res) {
                    if(res) { 
                        $('#loadmore_gs').text('Показать еще')
                        $('.news_list').append(res)
                        current_page = $($(res)[0]).data('page')
                        let params = $('.news_list').find('span.params').data('params').split(',')
                        console.log(params);
                        initClickToOne()
                        if (current_page == max_pages) $("#loadmore_gs").hide();
                    } else {
                        $('#loadmore_gs').hide();
                    }
                },
                complete: function() {

                },
                error: function(err) {
                    console.error('success', err);
                }
            });
        }
      });
    $('.filter_sort_btn').on('click', function(){
        $(this).toggleClass('up')
        if($(this).hasClass('up')){
            $(this).html(`<i class="far fa-sort-size-up"></i>`)
        }else{
            $(this).html(`<i class="far fa-sort-size-down"></i>`)
        }
    })
    // carousel
    $('.owl-carousel').owlCarousel({
        items: 6,
        // autoWidth: true,
        responsiveClass:true,
        navText:['<i class="far fa-chevron-left"></i>','<i class="far fa-chevron-right"></i>'],
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            },
            1300:{
                items:6,
                nav:true,
                loop:false
            }
        }
    });
    // подгрузка поста по ID
    function initClickToOne (){
        $('.news_item_more').on('click', function(){
            let postId = $(this).data('id')
            let url = $(this).data('url')
            console.log(postId, url);
            $.ajax({
                url: url,
                type: 'POST',
                data: {action: 'single_news', id: postId},
                // contentType: false,
                // cache: false,
                // processData: false,
                beforeSend: function () {
                    // $('.feedback .loader').fadeIn(200)
                },
                success: function (res) {
                    $('.news_single').html(res)
                    initPrintFuncktion()
                },
                complete: function () {

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            })
        })
    }
    initClickToOne()
    // кнопки поделится
    $('.news_detail_socicon a').on('click', function() {
        let soc = $(this).data('soc')
        let purl = $(this).data('purl')
        let ptitle = $(this).data('ptitle')
        let pimg = $(this).data('pimg')
        let text = $(this).data('text')
        share(soc, purl, ptitle, pimg, text)
    })
    function share(soc, purl, ptitle, pimg, text) {
        let url = ''
        const Share = {
            vkontakte: function(purl, ptitle, pimg, text) {
                url = 'http://vkontakte.ru/share.php?';
                url += 'url=' + encodeURIComponent(purl);
                url += '&title=' + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&image=' + encodeURIComponent(pimg);
                url += '&noparse=true';
                Share.popup(url);
            },
            odnoklassniki: function(purl, text) {
                url = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
                url += '&st.comments=' + encodeURIComponent(text);
                url += '&st._surl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            facebook: function(purl, ptitle, pimg, text) {
                url = 'http://www.facebook.com/sharer.php?s=100';
                url += '&p[title]=' + encodeURIComponent(ptitle);
                url += '&p[summary]=' + encodeURIComponent(text);
                url += '&p[url]=' + encodeURIComponent(purl);
                url += '&p[images][0]=' + encodeURIComponent(pimg);
                Share.popup(url);
            },
            twitter: function(purl, ptitle) {
                url = 'http://twitter.com/share?';
                url += 'text=' + encodeURIComponent(ptitle);
                url += '&url=' + encodeURIComponent(purl);
                url += '&counturl=' + encodeURIComponent(purl);
                Share.popup(url);
            },
            mailru: function(purl, ptitle, pimg, text) {
                url = 'http://connect.mail.ru/share?';
                url += 'url=' + encodeURIComponent(purl);
                url += '&title=' + encodeURIComponent(ptitle);
                url += '&description=' + encodeURIComponent(text);
                url += '&imageurl=' + encodeURIComponent(pimg);
                Share.popup(url)
            },

            popup: function(url) {
                window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
            }
        };
        switch (soc) {
            case 'vk':
                Share.vkontakte(purl, ptitle, pimg, text)
                break;
            case 'fb':
                Share.facebook(purl, ptitle, pimg, text)
                break;
            case 'tw':
                Share.twitter(purl, ptitle, pimg, text)
                break;

        }

    }
})