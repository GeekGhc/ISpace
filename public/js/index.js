$(function(){
    $("#search-content").keydown(function (event) {
        if(event.keyCode==13){
            var content = $(this).val();
           location.href="/search/post?q="+content;
        }
    })

    $('.section-content').css('min-height',"580px");
    $('.notify-section-content').css('min-height',"480px");
    $('.favorite-section-content').css('min-height',"440px");

    $('.vjs-menu-item').on('click',function () {
        $('.vjs-menu-item').removeClass('aria-selected');
        $(this).addClass('aria-selected');
    })

    $(document).scroll(function (event) {
        if($(document).scrollTop()>=234){
            $('#backToTop').fadeIn(400)
        }else{
            $('#backToTop').fadeOut(400)
        }
    })
    $('#backToTop').on('click',function(){
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    });
});