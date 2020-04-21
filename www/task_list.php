<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<script  src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
	<script  src="assets/js/main.js"></script>
</head>
	
<body>

	<h1>Task list</h1>
	
	<table id = "task-list">
		<tr>
			<th>Id</th>
			<th>Task</th>
			<th>Is done?</th>
			<th>Created</th>
			<th>Modified</th>
			<th>Options</th>
		</tr>
		<tr class = "task-row">
			<td class="task-item id"></td>
			<td class="task-item task"></td>
			<td class="task-item done"></td>
			<td class="task-item created date"></td>
			<td class="task-item modified date"></td>
			<td class="task-item delete"><input type="submit" class="input-delete" value="Delete"></td>
		</tr>
	</table>
	<hr>
	<form id="input-form">
		<label for="input-task">Task</label>
		<input type ="text" id="input-task">
		<label for="input-done">Is done?</label>
		<input type ="checkbox" id="input-done">
		<input type="submit" id="input-submit" value="Add new task">
	</form>

</body>
</html>
