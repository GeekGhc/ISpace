$(function(){
   /*$('#search').on('click',function(){
       var q = $('#search-content').val();
      $(this).attr('href',"/search/?q="+q);
   });*/

  /* $("#search-content").bind('keypress',function (event) {
     if(event.code=="13"){
     alert($('#search-content').val());
     }
     })*/

    $("#search-content").keydown(function (event) {
        if(event.keyCode==13){
          /* alert("yes");
           location.href="www.baidu.com";*/
        }
    })
});