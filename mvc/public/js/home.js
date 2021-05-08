var x=0,y;
$(document).ready(function(){
    $('.navbar i').click(function(){
        $('ul').toggleClass('show');
    });
    $('.square .fa-sort-down').click(function(){
        $('.square i').toggleClass('fa-sort-up');
        $('.add-form').slideToggle();

        if(x==0)
        {
            $('.square').css({'bottom':'0', 'transition':'0.4s'});
            x = 1;
        }
        if(document.body.clientWidth < 650)
        {
            y='104px';
        }
        else
        {
            y='149px';
        }
        $('.fa-sort-down').click(function(){
            $('.square').css({'bottom':'0', 'transition':'0.4s'});
        });
        $('.fa-sort-up').click(function(){
            $('.square').css({'bottom': y, 'transition':'0.4s'});
        });
    });

})
