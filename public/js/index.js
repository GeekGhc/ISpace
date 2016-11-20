$(function(){
   $('#search').on('click',function(){
       var q = $('#search-content').val();
      $(this).attr('href',"/search/?q="+q);
   })
});