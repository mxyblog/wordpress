// JavaScript Document
(function( $ ){
    $.fn.reset_all = function() {
        if($(window).width()>1025) {
            $('#site-navigation').show().addClass('closed');
            $('#masthead .site-header-menu .menu-toggle').removeClass('open');    
        }else{
            if($('#site-navigation').hasClass('closed') ) {
                $('#site-navigation').hide();
            }
        }
        if($(window).width()>426 && $('#masthead .search-form').hasClass('float')) {
            $('#masthead .search-form').removeClass('float');
        }
    };

    $(document).ready(
        function(e)
        {
            $('body').reset_all();
            $('#masthead .site-header-menu .menu-toggle').bind(
                'click',function(){
                    if($(this).hasClass('open') ) {
                        $('#site-navigation').slideUp(300).addClass('closed')
                        $(this).removeClass('open');
                    }else{
                        $('#site-navigation').slideDown(300).removeClass('closed');
                        $(this).addClass('open');
                    }
                    return false;
                }
            );
            $('#search-toggle').bind('click',function(){
                    if($(window).width()<450 && !$('#masthead .search-form').hasClass('float')) {
                        $('#masthead .search-form').addClass('float');
                        $('#masthead .search-field').focus();
                    }else{
                        $('#masthead .search-form').removeClass('float');
                    }
                }
            );
        }
    );
    $(window).resize(
        function(){
            $('body').reset_all();
        }
    );
})( jQuery );