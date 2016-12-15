var type = $('.module-type').attr('content');
$(function(){
   $('#search').on('click',function(){
       var q = $('#search-content').val();
      $(this).attr('href',"/search/?q="+q);
   });
    module(type);
});
function module(type){
    $('#'+type).addClass('active');
}