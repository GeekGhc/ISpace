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
});