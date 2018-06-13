$(document).ready(function(){
      
  $('.emailInvite').click(function () {
    let $this = $(this);
    let email = $this.data('email'),
    type = $this.data('type');

    $.ajax({
      type: "POST",
      url: "send.php",
      data: {email: email, type: type},
      beforeSend: function() {

        $( $this ).fadeOut(0).after( '\
          <div class="cssload-fond ' + email + '">\
              <div class="cssload-container-general">\
                  <div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_1"> </div></div>\
                  <div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_2"> </div></div>\
                  <div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_3"> </div></div>\
                  <div class="cssload-internal"><div class="cssload-ballcolor cssload-ball_4"> </div></div>\
              </div>\
          </div>\
        ' );
      },
      complete: function(){
        $( '.cssload-fond ' + email ).remove();
      },
      success: function(response){
        response = JSON.parse(response);
        $this.parent().parent().css( "background-color", "#eaeaea" );
        $this.parent().html('<span style="color: green; padding: 5px 10px 0 0; display:block;">' + response.message + '</span>');
      }
    });
    return false;
  });

});
