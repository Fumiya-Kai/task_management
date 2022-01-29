$(function() {

    var count = $('.task').length;
    var template = `
    <tr class="task">
      <td width="5%" height="30px"><div class="minus-button-new"><i class="fas fa-minus"></i></div></td>
      <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[${count}][order]" type="number" min="1"></td>
      <td width="30%" height="30px"><input class="form-content task-form text-form" name="taskData[${count}][task]" type="text"></td>
      <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][start]" type="date"></td>
      <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][end_schedule]" type="date"></td>
      <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][end]" type="date"></td>
    </tr>
    `;

    $('body').on('click', '.plus-button', function () {
        $('.add-row').before(template);
        count++;
        makeTemplate(count);
    });

    $('body').on('click', '.minus-button', function () {
        var clickedDom = this;
        $.ajax(location.origin + '/api/task/' + $(this).parents('.task').next('.task-id').val(),
          {
              type: 'delete',
          })
          .done(function (data) {
            $(clickedDom).parents('.task').next('.task-id').remove();
            $(clickedDom).parents('.task').remove();
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
          });
    });

    $('body').on('click', '.minus-button-new', function () {
        $(this).parents('.task').remove();
    });

    function makeTemplate(count) {
        return template = `
        <tr class="task">
          <td width="5%" height="30px"><div class="minus-button-new"><i class="fas fa-minus"></i></div></td>
          <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[${count}][order]" type="number" min="1"></td>
          <td width="30%" height="30px"><input class="form-content task-form text-form" name="taskData[${count}][task]" type="text"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][start]" type="date"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][end_schedule]" type="date"></td>
          <td width="20%" height="30px"><input class="form-content task-form" name="taskData[${count}][end]" type="date"></td>
        </tr>
        `;
    };

});