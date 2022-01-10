$(function() {

    var count = 1;
    var template = `
    <tr class="task">
      <td width="5%" height="30px"><div class="minus-button"><i class="fas fa-minus"></i></div></td>
      <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[${count}][order]" type="number" min="1"></td>
      <td width="40%" height="30px"><input class="form-content task-form text-form" name="taskData[${count}][task]" type="text"></td>
      <td width="25%" height="30px"><input class="form-content task-form" name="taskData[${count}][start]" type="date"></td>
      <td width="25%" height="30px"><input class="form-content task-form" name="taskData[${count}][end_schedule]" type="date"></td>
    </tr>
    `;

    $('body').on('click', '.plus-button', function () {
        $('.add-row').before(template);
        count++;
        makeTemplate(count);
    });

    $('body').on('click', '.minus-button', function () {
        $(this).parents('.task').remove();
    });

    function makeTemplate(count) {
        return template = `
        <tr class="task">
          <td width="5%" height="30px"><div class="minus-button"><i class="fas fa-minus"></i></div></td>
          <td width="5%" height="30px"><input class="form-content task-form order-form" name="taskData[${count}][order]" type="number" min="1"></td>
          <td width="40%" height="30px"><input class="form-content task-form text-form" name="taskData[${count}][task]" type="text"></td>
          <td width="25%" height="30px"><input class="form-content task-form" name="taskData[${count}][start]" type="date"></td>
          <td width="25%" height="30px"><input class="form-content task-form" name="taskData[${count}][end_schedule]" type="date"></td>
        </tr>
        `;
    };

});