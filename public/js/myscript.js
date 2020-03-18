$(function () {
    $(document).on('click', '#start_button', function () {
        var id = $(this).data('id');
        $('#stop_button').css('display', 'block');
        $('#start_button').css('display', 'none');
        $.ajax({
            type: 'POST',
            url: 'index/start',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function(response) {                
                $('#start_text').html(response);
                console.log(response);
                location.reload(true);
            }
      });
    });
});

  $(function () {
    $(document).on('click', '#stop_button', function () {
        var id = $(this).data('id');
        $('#stop_button').css('display', 'none');
        $('#start_button').css('display', 'block');
        $.ajax({
            type: 'POST',
            url: 'index/stop',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function(response) {
                $('#stop_text').html(response);
                console.log(response);
                location.reload(true);
            }
      });
    });
  });

  $(function () {
    $(document).on('click', '#select_month', function () {
        var category_id = $("#select_month option:selected").val();
        console.log(category_id);
    });
  });

$(function () {
    $(document).on('click', '#show_report', function () {
        $('tr').css('display', 'table');
        $('#show_report').css('display', 'none');
        $('#hide_report').css('display', 'block');
    });
});

$(function () {
    $(document).on('click', '#hide_report', function () {
        $('tr').css('display', 'none');
        $('#show_report').css('display', 'block');
        $('#hide_report').css('display', 'none');
        $('.showOnlyToday').css('display', 'table');
    });
});

$(function () {
    $(document).on('click', '#changeLateTime', function () {
        var x = document.getElementById("typeTime").value;
        $.ajax({
            type: 'POST',
            url: '/admin/changelate',
            data: {
                settime: x,
            },
            dataType: 'json',
            success: function(response) {                
                console.log(response);
                $.each(response, function (index, value) {
                    $('.td'+value['user_id']).html(value['late']);
                });
                alert('Success!');
                location.reload(true);
            }
      });
    });
});

$(function () {
    $(document).on('click', '#user', function () {
        if($(this).is(":checked")){
            var id = $(this).data('id');
            var active = 1;
        }
        else if($(this).is(":not(:checked)")){
            var id = $(this).data('id');
            var active = 0;
        }
        $.ajax({
            type: 'POST',
            url: '/admin/changeStatus',
            data: {
                id: id,
                active: active,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                alert('Success!');
                location.reload(true);
            }
      });
    });
});

$(function () {
    $(document).on('click', '#checkbox', function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: '/admin/deleteLate',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(response) {       
                alert('Success!');
                location.reload(true);
            }
      });
    });
});

//checkbox for change repeat every year
$(function () {
    $(document).on('click', '#every_year', function () {
        var id = $(this).data('id');
        if($(this).is(":checked")){
            var id = $(this).data('id');
            var active = 1;
        }
        else if($(this).is(":not(:checked)")){
            var id = $(this).data('id');
            var active = 0;
        }
            $.ajax({
                type: 'POST',
                url: '/admin/repeatNotWork',
                data: {
                    id: id,
                    active: active,
                },
                dataType: 'json',
                success: function(response) {       
                    alert('Updated!');
                }
          });
        
        });
});

//delete notWorking day
$(function () {
    $(document).on('click', '#delete_notWork', function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: '/admin/deleteNotWork',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(response) {       
                alert('Deleted!');
                location.reload(true);
            }
      });
        
    });
});

//add notWorking day
$(function () {
    $(document).on('click', '#btnNotWork', function () {
        var date = $('#fname').val();
        if($('#checkNotWork').is(":checked")){
            var active = 1;
        }
        else if($('#checkNotWork').is(":not(:checked)")){
            var active = 0;
        }

        $.ajax({
            type: 'POST',
            url: '/admin/addNotWork',
            data: {
                date: date,
                active: active,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);       
                alert('Added!');
                location.reload(true);
            }
        });
        
    });
});

//change start&stop time
$(function () {
    $(document).on('change', '#edit_start', function () {
        var id = $(this).data('id');
        var time = $(this).val();
        $.ajax({
            type: 'POST',
            url: '/admin/updateTime',
            data: {
                id: id,
                time: time,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                location.reload(true);
            }
        });
        
    });
});