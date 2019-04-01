jQuery(function(){
  $("#sortable").sortable();
  $("#sortable").disableSelection();

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  countTodos();

  //create todo
  $('.add-todo').on('keypress',function (e) {
        e.preventDefault
        if (e.which == 13) {
             if($(this).val() != ''){
             var todo = $(this).val();
              createTodo(todo); 
             }else{
                 // some validation
             }
        }
  });
  // mark task as done
  $('.todolist').on('change','#sortable li input[type="checkbox"]',function(){
      if($(this).prop('checked')){
          var doneItem = $(this).parent().parent().parent();
          $(this).parent().parent().parent().addClass('remove');
          done(doneItem);
      }
  });

  //delete done task from "already done"
  $('.todolist').on('click','.remove-item',function(){
      var element = $(this).parent();
      var task_id = element.attr("id").split("_", task_id)[1];

      $.ajax({
        type: "POST",
        url: "/task/delete/"+task_id+"/",
        success: function(data){
          console.log(data);
          if (data.response == "success") {
            element.remove();
          }
        },
      });
  });

  // count tasks
  function countTodos(){
      var count = $("#sortable li").length;
      $('.count-todos').html(count);
  }

  //create task
  function createTodo(text){
      $.ajax({
        type: "POST",
        url: "/task/create/",
        data: {'description': text},
        success: function(data){
          console.log(data);
          if (data.response == "success") {
            var markup = '<li id="task_'+data.task_id+'"class="ui-state-default"><div class="checkbox"><label><input type="checkbox" value="" />'+ text +'</label></div></li>';
            $('ul#sortable').prepend(markup);
            $('.add-todo').val('');
            countTodos();
          }
        },
      });
  }

  //mark task as done
  function done(element){
      var text = element.find('label').text();
      var task_id = element.attr("id").split("_", task_id)[1];
      $.ajax({
        type: "POST",
        url: "/task/complete/"+task_id+"/",
        success: function(data){
          console.log(data);
          if (data.response == "success") {
            var markup = '<li id="task_'+task_id+'">'+ text +'<button class="remove-item btn btn-default btn-xs pull-right">Löschen</button></li>';
            $('#done-items').prepend(markup);
            $('.remove').remove();
            countTodos();
          }
        },
      });
  }

});