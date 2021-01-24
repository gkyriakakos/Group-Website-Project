/*
  2) List Functions
  3) Task Functions
  4) Constants
  */
  class List{
  	constructor(name, lID, div){
  		this.name = name;
  		this.listid = lID;
  		this.tasks = [];
  		this.div = div;
  	}
  	insertTask(task){
  		this.tasks.push(task);
  	}
  }


  class Task{
  	constructor(name, desc = "", comp = 0, lID, tID, div){
  		this.name = name;
  		this.description = desc;
  		this.completed = comp;
  		this.listid = lID;
  		this.taskid = tID;
  		this.div = div;
  	}
  }


  var lists = [];

// List Related Functions//
function addList(listName = undefined, listid = undefined) {


   // gets the text from input box and only continues
   // to add the list if the string has text in it
   // TODO: need to add a check for duplicates
   if(listName === undefined){
   	listName = $("#newListInput").val().trim();
   	if (listName.length == 0) {return;}
   	$("#newListInput").val("").focus();
   }


   // creates a new <div> for the menu
   // adds all the tags and handlers that
   // the List needs and adds the new
   // List to the #listArea
   let $newList = $(createList(listName,listid));
   $($newList).click(function(event){loadList(lists.find(element => element.listid == listid));});
   $name = $(listNameInput);
   $saveButton = $(saveListButton).click(function(event){saveList($newList)});
   $deleteButton = $(deleteListButton).click(function(event){deleteList($newList)});
   $editButton = $(editTaskButton).click(function(event){editList($newList)});
   $($newList).find("form").append($name);
   $($newList).find("form").append($saveButton);
   $($newList).find("form").append($deleteButton);
   $($newList).append($editButton);

   lists.push(new List(listName, listid, $newList));

   $("#listScroll").append(lists[lists.length - 1].div);
 }

 function loadList(listItem = undefined){
   if(listItem == undefined){
    listItem = lists[0];
  }

  $("#SelectedlistId").val(listItem.listid);
  var $currentTitle = $("#toDoListTitleBlock");
  var newTitle = $(listItem.div).find('span').text();
  $currentTitle.html(newTitle);


  var $hidden = $("#listId");
  $($hidden).val($(listItem).attr('id'));


  $("#taskScroll").empty();
  listItem.tasks.forEach(task => {
    $("#taskScroll").append(task.div);
  });


}

function saveList($list){
	let newName  = $($($list).find("form").children().get(2)).val();
	$($($list).find("form")).submit(function(e) {

    e.preventDefault();

    let form = $($($list).find("form"));
    let url = form.attr('action');
    let $data = form.serializeArray();
    $data.push({name:"save-list"});

    $.ajax({
    	type: "POST",
    	url: url,
           data: $.param($data), 
         });
  });
  //saves all the tags from the list
  //into these variables
  let $span   = $($list).find("form").children().get(1);
  let $name   = $($list).find("form").children().get(2);
  let $save   = $($list).find("form").children().get(3);
  let $delete = $($list).find("form").children().get(4);
  let $edit   = $($list).children().get(1);


  
  $($span).css("display", "initial");
  $($name).css("display", "none");
  $($save).css("display", "none");
  $($delete).css("display", "none");
  $($edit).css("display", "initial");

  $($span).html(newName);

}


function editList($list){
	let $span   = $($list).find("form").children().get(1);
	let $name   = $($list).find("form").children().get(2);
	let $save   = $($list).find("form").children().get(3);
	let $delete = $($list).find("form").children().get(4);
	let $edit   = $($list).children().get(1);


	$($name).val($($span).html());

	$($span).css("display", "none");
	$($name).css("display", "initial");
	$($save).css("display", "initial");
	$($delete).css("display", "initial");
	$($edit).css("display", "none");
}

function deleteList($list){
  $($($list).find("form")).submit(function(e) {

    e.preventDefault();

    let form = $($($list).find("form"));
    let url = form.attr('action');
    let $data = form.serializeArray();
    $data.push({name:"delete-list"});

    $.ajax({
      type: "POST",
      url: url,
          data: $.param($data),
        });
    });
  let listId   = $($($list).find("form").children().get(0)).val();
  let index = lists.indexOf(lists.find(element => element.listid == listId));
  lists.splice(index,1);

  let $span   = $($list).find("form").children().get(1);
  let $name   = $($list).find("form").children().get(2);
  let $save   = $($list).find("form").children().get(3);
  let $delete = $($list).find("form").children().get(4);
  let $edit   = $($list).children().get(1);


  $($span).css("display", "none");
  $($name).css("display", "none");
  $($save).css("display", "none");
  $($delete).css("display", "none");
  $($edit).css("display", "none");

}

//Task Related Functions//

function addTask(taskName = undefined, desc = undefined, completed = 0, listid = undefined, taskid = undefined) {


   // gets the text from input box and only continues
   // to add the task if the string has text in it
   // TODO: need to add a check for duplicates
   if(taskName === undefined){
   	taskName = $("#newTaskInput").val().trim();
   	if (taskName.length == 0) {return;}
   	$("#newTaskInput").val("").focus();
   }


   // creates a new <div> for the menu
   // adds all the tags and handlers that
   // the Task needs and adds the new 
   // Task to the #taskArea.
   let $newTask = $(createTask(taskName,listid,taskid,completed));

   $name = $(taskNameInput);
   $decription = $(taskDescInput).val(desc);

   $saveButton = $(saveTaskButton).click(function(event){saveTask($newTask)});
   $deleteButton = $(deleteTaskButton).click(function(event){deleteTask($newTask)});

   $editButton = $(editTaskButton).click(function(event){editTask($newTask)});

   $($newTask).find("form").append($name);
   $($newTask).find("form").append($decription);
   $($newTask).find("form").append($saveButton);
   $($newTask).find("form").append($deleteButton);
   $newTask.append($editButton);

   let tempList = lists.find(element => element.listid == listid);
   tempList.tasks.push(new Task(taskName, desc, completed, listid, taskid, $newTask));
 }

 function saveTask($task){
   let newName  = $($($task).find("form").children().get(4)).val();
   $($($task).find("form")).submit(function(e) {

    e.preventDefault();

    let form = $($($task).find("form"));
    let url = form.attr('action');
    let $data = form.serializeArray();
    $data.push({name:"save-task"});

    $.ajax({
      type: "POST",
      url: url,
           data: $.param($data),
         });

    
  });


   let $label  = $($task).find("form").children().get(3);
   let $name   = $($task).find("form").children().get(4);
   let $desc   = $($task).find("form").children().get(5);
   let $save   = $($task).find("form").children().get(6);
   let $delete = $($task).find("form").children().get(7);
   let $edit   = $($task).children().get(1);



   $($label).css("display", "initial");
   $($name).css("display", "none");
   $($desc).css("display", "none");
   $($save).css("display", "none");
   $($delete).css("display", "none");
   $($edit).css("display", "initial");


   $($label).html(newName);
	// $.post('edit_DB.php', {complete: comp , taskid:taskId});
}


function editTask($task){

	let $label   = $($task).find("form").children().get(3);
	let $name   = $($task).find("form").children().get(4);
	let $desc   = $($task).find("form").children().get(5);
	let $save   = $($task).find("form").children().get(6);
	let $delete = $($task).find("form").children().get(7);
	let $edit   = $($task).children().get(1);

	$($name).val($($label).html());

	$($label).css("display", "none");
	$($name).css("display", "initial");
	$($desc).css("display", "initial");
	$($save).css("display", "initial");
	$($delete).css("display", "initial");
	$($edit).css("display", "none");

}

function deleteTask($task){
  $($($task).find("form")).submit(function(e) {

    e.preventDefault();

    let form = $($($task).find("form"));
    let url = form.attr('action');
    let $data = form.serializeArray();
    $data.push({name:"delete-task"});
    console.log("Form: "+form +" URL:"+url+" Data: "+ $data);
    $.ajax({
      type: "POST",
      url: url,
          data: $.param($data),
        });
    });

  let $form = $(($task).find("form"));


  $($form).css("display", "none");
  
}


function toggleTask(task){
	let taskId = $($(task).children().get(1)).val();
	let comp = $($(task).children().get(2)).is(":checked");
	$.post('edit_DB.php', {complete: comp , taskid:taskId});
}



//Constants//
const editListButton   = '<button class="edit-list">&#9998;</button>';
const saveListButton   = '<input type = "submit" name = "save-list" style = "display: none" value = "SAVE" name = "saveList">';
const deleteListButton = '<input type = "submit" name = "delete-list" style = "display: none" value = "DELETE" name = "deleteList">';
const listNameInput    = '<input type="text" name = "name-list" style = "display: none">';  
function createList(name, listid){
	return `<div class="list-item-editable" id= "${listid}">
	<form method = "post" action = "edit_DB.php">
	<input type = "hidden" name = "id" value = "${listid}">
	<span>${name}</span>
	</form>
	</div>`;
}

const editTaskButton   = '<button class="edit-task">&#9998;</button>';
const saveTaskButton   = '<input  type = "submit" name = "save-task" style = "display: none" value = "SAVE" name = "saveTask">';
const deleteTaskButton = '<input  type = "submit" name = "delete-task" style = "display: none" value = "DELETE" name = "deleteTask">';
const taskNameInput    = '<input type="text" name = "name-task" style = "display: none">';
const taskDescInput    = '<input type="text" name = "task-description"style = "display: none">';
function createTask(name, listid,taskid,complete){
	return `<div class="task-item-editable" id="${listid}-${taskid}">
	<form method = "post" action = "edit_DB.php">
	<input type = "hidden" name = "listid" value = "${listid}">
	<input type = "hidden" name = "taskid" value = "${taskid}">
	<input type = "checkbox" name = "complete" id = "completed-${taskid}"`+(complete == 1? "checked":"")+` onChange = toggleTask(this.form)>
	<label for = "completed-${taskid}">${name}</label>
	</form>
	</div>`;
}