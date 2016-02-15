(function($){
  $(document).on('submit', '#payment', function(e){
    e.preventDefault();
    var $form = $(e.currentTarget);
    var data = $form.serialize();
    
    $form.find('button[type="submit"]')
      .attr('disabled', 'disabled')
      .html('Submitting...')
      ;
    $form.find('input').attr('disabled', 'disabled');
    $.post( $form.attr('action'), data )
      .done( function( response ){
        var $response = $('<div>'+response+'</div>')
          .css({'display':'none'})
          .appendTo( 'body' );
          
        $response.find('form').submit();
        //$('main').append( $response );
        
      })
      .fail( function(){
        
      })
  });
})(jQuery);