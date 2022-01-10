$(function() {
    var now = new Date();
    var timestamp = now.getFullYear()+
                    (String(now.getMonth()+101).substring(1,3))+
                    (String(now.getDate()+100).substring(1,3))+
                    (String(now.getHours()+100).substring(1,3))+
                    (String(now.getMinutes()+100).substring(1,3))+
                    (String(now.getSeconds()+100).substring(1,3));
    $('body').on('click', '.check', function () {
        var clickedDom = this;
        $.ajax(location.origin + '/api/task/' + $(this).parent().data('taskId'),
          {
              type: 'put',
              data: {end: timestamp}
          })
          .done(function (data) {
              $(clickedDom).siblings('.end').text(data.end);
              $(clickedDom).css('color', '#000');
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
          });
    });
});