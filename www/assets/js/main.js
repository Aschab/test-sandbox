$( document ).ready(function() {
    
	$('.task-row').hide();
	
	$('#input-submit').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		addTask();
	});
	
	loadTasks();
});

function addTask(){
	$('#input-form input').prop('disabled', true);	
	
	var is_done = $('#input-done').prop('checked');
	var formData = {task: $('#input-task').val() ,is_done: is_done };

	$.ajax("/rest/task.php",
		{
			type: 'POST',
			dataType : 'json',
			data : formData,
			success: function(result){
				loadTasks();
			},
			complete: function(){
				$('#input-form input').prop('disabled', false);
			}
	   }
   );
}

function deleteTask(id){
	$('.input-delete').prop('disabled', true);

	$.ajax("/rest/task.php/" + id,
		{
			type: 'DELETE',
		//	dataType : 'json',
			success: function(result){
				console.log(result);
				loadTasks();
			},
			complete: function(){
				$('.input-delete').prop('disabled', false);
			}
	   }
   );
}

function loadTasks(){
	var taskTr = $('.task-row');
	$('.task-data').remove();
	
	$.ajax("/rest/task.php",
	   {
	   		type: 'GET',
	   		dataType : 'json',
			success: function(result){
				if (result.success){
					result.data.forEach(function(row){
						var taskTrClone = $(taskTr).clone();
						$(taskTrClone).addClass('task-data').removeClass('task-row').show();
						$(taskTrClone).find('.task-item.id').html(row.id);
						$(taskTrClone).find('.task-item.task').html(row.task);
						$(taskTrClone).find('.task-item.done').html(row.is_done);
						$(taskTrClone).find('.task-item.created').html(row.created);
						$(taskTrClone).find('.task-item.modified').html(row.modified)
						$(taskTrClone).find('.input-delete').data('id', row.id);
						$('#task-list').append(taskTrClone);
					});
					$('.input-delete').on('click', function(e){
						deleteTask($(this).data('id'));
					});
				}
			}
	   }
   );
}