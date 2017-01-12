$(function(){
    $("#search-content").keydown(function (event) {
        if(event.keyCode==13){
            var content = $(this).val();
           location.href="/search/post?q="+content;
        }
    })

    $('.section-content').css('min-height',"480px");
});