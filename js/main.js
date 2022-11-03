$(document).ready(function () {

    // .section1 스와이퍼
    const swiper = new Swiper('.section1 .swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        autoplay: {
            delay: 3000,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    // 메뉴열기 클릭
    $('.nav_btn').on('click', function () {
        const $gnb = $('#gnb');
        const $first = $gnb.find('[data-link="first"]');
        const $last = $gnb.find('[data-link="last"]');
        const wrapHei = $('#wrap').outerHeight();

        // #wrap의 높이값을 html, body 높이로 강제 지정 
        $('html, body').css({height: wrapHei, overflow: 'hidden'});

        //열기
        $(this).addClass('on').find('.blind').text('주메뉴 닫기');
        $(this).next().stop().fadeIn('fast');
        $gnb.css({visibility: 'visible'}).stop().animate({right: 0}, 300, function () {
            $first.focus();   //대상 엘리먼트에 포커스를 강제로 이동
        });

        //첫번째 a 태그에서 shift+tab을 눌러 header의 영역으로 포커스가 이동하지 못하게 제한
        $first.on('keydown', function (e) {
            console.log(e.keyCode);   //tab을 클릭하면 9를 반환
            if ( e.shiftKey && e.keyCode == 9) {
                e.preventDefault();   //포커스 이동을 강제로 제한
                $last.focus();        //처음 포커스로 이동, #gnbWrap을 벗어나지 않고 순환됨
            }
        });
        $last.on('keydown', function (e) {
            if (!e.shiftKey && e.keyCode == 9) {
                e.preventDefault();
                $('.nav_btn').focus();
            }
        });

        // 닫기
        $('.arrow, #dim').click(function () {
            $('html, body').removeAttr('style');
            $('.nav_btn').removeClass('on').find('.blind').text('주메뉴 열기');
            $('#dim').stop().fadeOut('fast');  //dim 보이기

            $gnb.stop().animate({right: '-391px'}, 300, function () {
                $(this).css({visibility: 'hidden'}).children('ul').stop().animate({maxHeight: 0}, 'fast', function () {});
            });
        });

        //네비 메뉴 클릭시 닫기 - 2022.10.31 임보라 추가
        $('#gnb ul li').not('.md_open_btn').click(function () {
            $('html, body').removeAttr('style');
            $('.nav_btn').removeClass('on').find('.blind').text('주메뉴 열기');
            $('#dim').stop().fadeOut('fast');  //dim 보이기

            $gnb.stop().animate({right: '-391px'}, 300, function () {
                $(this).css({visibility: 'hidden'}).children('ul').stop().animate({maxHeight: 0}, 'fast', function () {});
            });

        });

    });


    //디바이스 크기별 리사이징
    $(window).resize(function(){
        if (window.innerWidth > 1440) {  // 다바이스 크기가 1440이상일때
            $(document).on('scroll', function(){
                // 오감과 함께할 당신에게,
                $('h2 .to_left').css("left", Math.max(120 - 0.1*window.scrollY, 1) + "vw");
                $('h2 .to_right').css("right", Math.max(120 - 0.1*window.scrollY, 1) + "vw");
            });

        }else if (window.innerWidth > 768) {  // 다바이스 크기가 768이상일때
            $(document).on('scroll', function(){
                // 오감과 함께할 당신에게,
                $('h2 .to_left').css("left", Math.max(80 - 0.1*window.scrollY, 1) + "vw");
                $('h2 .to_right').css("right", Math.max(80 - 0.1*window.scrollY, 1) + "vw");
            });

        } else {
            $(document).on('scroll', function(){ //모바일
                // 오감과 함께할 당신에게,
                $('h2 .to_left').css("left", Math.max(40 - 0.1*window.scrollY, 1) + "vw");
                $('h2 .to_right').css("right", Math.max(40 - 0.1*window.scrollY, 1) + "vw");
            });
        }


    }).resize();



    // section3 타이핑효과
    $(".typed").typed({
        strings: ["Software Development", "Design Publishing", "UX UI Planning", "QA QC part", "Online Marketing"],
        typeSpeed: 100,
        loop: true,
    });

    function trick () {
        $('.txt_right p:first-of-type').fadeOut(function () {
            $(this).appendTo($('.txt_right')).fadeIn(100);
        });
    }
    setInterval(function () { trick()}, 3700);





    //section5 : 배열로 루프를 돌려볼까?
    const dataArray=['#nike', '#converse', '#ssf','#gs','#yongwon','#nf','#discovery','#mlb','#stretchangles','#tory','#thom','#amore','#toun28','#nexen','#cancer','#kb','#lotte']
    const portArray =['portfolio_nike.jpg', 'portfolio_converse.jpg', 'portfolio_ssf.jpg','portfolio_gsshop.jpg', 'portfolio_youngone.jpg', 'portfolio_thenorthface.jpg', 'portfolio_discovery.jpg', 'portfolio_mlb.jpg', 'portfolio_strechangels.jpg', 'portfolio_toryburch.jpg', 'portfolio_thombrown.jpg', 'portfolio_amore.jpg', 'portfolio_toun28.jpg','portfolio_nexentire.jpg','portfolio_cancercenter.jpg','portfolio_kbinsurance.jpg','portfolio_lotteinsurance.jpg']
    const appendTxt =['NIKE', 'CONVERSE', 'SSF SHOP', 'GS SHOP', 'YOUNGONE', 'THE NORTH FACE', 'DISCOVERY', 'MLB', 'STRETCHANGLES', 'TORY BURCH', 'THOM BROWN', 'AMORE PACIFIC', 'TOUN28', 'NEXEN TIRE', '국립암센터', 'KB 손해보험', 'lOTTE 손해보험'];

    for(let j = 0; j<portArray.length; j++){
        $('.section5 .swiper-wrapper').append('<div class="md_open_btn swiper-slide" aria-haspopup="dialog" title="대화상자" data-href="' +dataArray[j] + '">'+'<img src="'+'img/'+portArray[j]+'">'+'<span class="append_txt">'+ appendTxt[j]+'</span>'+'</div>');
    }


    var swiper2 = new Swiper(".section5 .swiper-container", {
        slidesPerView: 1,
        spaceBetween: 50,
        grabCursor: true,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
    });


    // 포트폴리오 부분
    // const $sticky_wrap = $('.sticky_wrap');
    // const stickyWrapY = $sticky_wrap.offset().top;  //.sticky_wrap이 상단 브라우저에서 떨어진 거리
    // const stickyWrapHei = $sticky_wrap.outerHeight(); //.sticky_wrap의 세로 높이(border 포함)
    // console.log(stickyWrapY, stickyWrapHei);  // 4920 4225

    // $(window).on('scroll', function () {
    //     const scrollY = $(this).scrollTop();    //스크롤바 이동거리
    //     const leftMove = scrollY - stickyWrapY; // absolute를 가지는 .hor_long의 left좌표
    //     console.log(leftMove);
    //     const hor_long = $('.hor_long').width();
    //     $sticky_wrap.css('height', hor_long);

    //     if (scrollY < stickyWrapY - $(window).height()/10) {  //.cnt_top이 보여지는 동안: left 0고정, 스크롤을 빨리 움직이는 사용자 때문에 조금만 빨리 animate()
    //     /* gsap.to('#box', {rotation: 27, x: 100, duration: 1});
    //     첫 번째 파라미터는 트윈 할 대상(Target)
    //     두 번째 속성(Properties) */
    //     gsap.to('.hor_long', {left: 0, duration: 0.5, ease: Power3.easeOut});
    //     } else if (scrollY < stickyWrapY + stickyWrapHei - $(window).height()) { //.cnt_btm이 보이지 전 : left=> 스크롤바의 이동거리-.sticky_wrap의수직위치
    //     gsap.to('.hor_long', {left: -leftMove, duration: 0.5, ease: Power3.easeOut});
    //     }
    // });


    // 더보기버튼
    $('.btn_more p').click(function () {
        $('.more').addClass('on');
    });



    // fade효과
    // 1) scroll 이벤트 선언
    $(window).on('scroll', function () {
        // 2) 스크롤바의 수직 이동거리를 변수에 저장(스크롤을 빨리 움직이는 사용자를 위해 값을 더해주기)
        const scrollY = $(this).scrollTop() + $(this).height()* 3/4;

        // 3) 스크롤바의 수직이동거리와 나(보여질 컨텐츠)의 위치가 가까워질 경우만 .fade.on 클래스명 추가
        $('.fade').each(function (idx, ele) {
            if (scrollY > $(this).offset().top) $(this).addClass('on');
            // 하단에서 상단으로 다시 올렸을때 효과가 반복되길 바란다면 추가
            else $(this).removeClass('on');
        });


        // 스크롤이 근처에 도달시 애니메이션 실행
        const scrollTop = $(this).scrollTop();
        $('.road').each(function (idx, ele) {
            const road1 = $('.road1').offset().top;
            const road2 = $('.road2').offset().top;
            if (scrollTop + 1100 >= road1) {
                $('.road1').addClass('on');
            } else{
                $('.road1').removeClass('on');
            }
            if (scrollTop + 1100 >= road2) {
                $('.road2').addClass('on');
            } else{
                $('.road2').removeClass('on');
            }
            // console.log(scrollTop, road1);
        });

        $('.illust').each(function (idx, ele) {
            const footer = $('footer').offset().top;
            if (scrollTop + 1200 >= footer) {
                $(this).addClass('on');
            }
            else{
                $(this).removeClass('on');
            }
        });

    });


    // 스크롤이 근처에 도달시 애니메이션 실행 - 2022.10.31 임보라 추가
    /*$(window).scroll(function(){
        let scrollVar = $(this).scrollTop();
        let header = $('.header');

            //헤더 불투명배경 추가
            if(scrollVar >= header.outerHeight()){
                header.addClass('bgOn');
            }else{
                header.removeClass('bgOn');
            }


        let logoImg = $('.logo img');
        let Change1Tp = $('.logoChange1').offset().top + -100;
        let Change1Bt = Change1Tp + $('.logoChange1').outerHeight();
        let Change2Tp = $('.logoChange2').offset().top + -100;
        let Change2Bt = Change2Tp + $('.logoChange2').outerHeight();
        let Change3Tp = $('.logoChange3').offset().top + -100;
        let Change3Bt = Change3Tp + $('.logoChange3').outerHeight();

        let sec6Top = $('.top_line').offset().top + -80;
        let sec7Top = $('.section7').offset().top + -300;

        console.log(Change2Tp)
        console.log(Change2Bt)
            //로고 - 겹침방지 , 로고 색 변경
            if(Change1Tp <= scrollVar && Change1Bt >= scrollVar){
                logoImg.addClass('brightness');
            }else if(Change2Tp <= scrollVar && Change2Bt >= scrollVar){
                logoImg.addClass('brightness');
            }else if(Change3Tp <= scrollVar && Change3Bt >= scrollVar){
                logoImg.addClass('brightness');
            }else if(scrollVar >= sec6Top && scrollVar <= sec7Top){
                logoImg.addClass('brightness');
            }
            else{
                logoImg.removeClass('brightness');
            }

    });*/

    // section7 fade효과 - 2022.10.31 임보라 추가
    AOS.init();


    // 스크롤이 시작하면 header변경
    $(window).scroll(function(){

        //메뉴버튼 흰색으로 변경
        const header = $('.header');
        let headerH = header.height();
        let scrollTop = $(this).scrollTop();
        let sec6Top = $('.section6').offset().top + -80;
        let sec7Top = $('.section7').offset().top + -300;

        if(scrollTop >=headerH){
            header.addClass('change');
            header.find('.logo img').attr('src','img/icon_logo_w.png');
            header.css('background-color', 'rgba(0,0,0,.98)')
        }else{
            header.removeClass('change');
            header.find('.logo img').attr('src','img/icon_logo.png');
            header.css('background-color', 'transparent')
        }
        if(scrollTop >= sec6Top && scrollTop <= sec7Top){
            header.removeClass('change');
            header.find('.logo img').attr('src','img/icon_logo.png');
            header.css('background-color', 'rgba(255,255,255,.98)')
        }


        //클라이언트 타이틀텍스트 크기 작게
        let sec6Title = $('#section6 h2');
        let sec6Y = $('.section6').offset().top + -500;
        if(scrollTop >= sec6Y){
            sec6Title.addClass('on');
        }else{
            sec6Title.removeClass('on');
        }
    });


    $('#number').on('input', function (){
        $(this).val($(this).val().replace(/[^0-9]$/,''));
    })

});


