/**
* Template Name: NiceAdmin - v2.4.1
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  function manageWorkspace(url,method,user,name,title,_this){
      Swal.fire({
          title: title,
          input: 'text',
          showCancelButton: true,
          confirmButtonText: name,
          showLoaderOnConfirm: true,
          inputValue:_this.data('name'),
      }).then((result) => {
          if (result.isConfirmed) {

              if (result.value === "") {
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops...',
                      text: 'You need to write something!',
                  })
              }else {
                  let data;
                  if (user){
                       data={user_id:user,name:result.value}
                  } else{
                      data={name:result.value}
                  }
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url: url,
                      type: method,
                      data:data,
                  }).done( function(result) {
                      let timerInterval
                      Swal.fire({
                          title: 'Working...',
                          html: '<b></b> ',
                          timer: 1000,
                          timerProgressBar: true,
                          didOpen: () => {
                              Swal.showLoading()
                              const b = Swal.getHtmlContainer().querySelector('b')
                              timerInterval = setInterval(() => {
                                  b.textContent = Swal.getTimerLeft()
                              }, 100)
                          },
                          willClose: () => {
                              clearInterval(timerInterval)
                          }
                      }).then((result) => {
                          Swal.fire({
                              icon: 'success',
                              title: name+'d',
                              text: 'Workspace was '+name+'d!',
                          })
                          window.location.reload();
                      })
                  }).fail(function (error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: error.responseJSON.message,
                      })
                  })
              }

          }
      })

  }
  function accessWorkspace(url,method,user,name,title,_this){
      Swal.fire({
          title: title,
          input: 'email',
          showCancelButton: true,
          confirmButtonText: name,
          showLoaderOnConfirm: true,
          inputValue:_this.data('email'),
      }).then((result) => {
          if (result.isConfirmed) {
              if (result.value === "") {
                  Swal.fire({
                      icon: 'info',
                      title: 'Oops...',
                      text: 'You need to write something!',
                  })
              }else {
                  let data;
                  if (user){
                       data={user_id:user,name:result.value}
                  } else{
                      data={email:result.value}
                  }
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      url: url,
                      type: method,
                      data:data,
                  }).done( function(result) {
                      let timerInterval
                      Swal.fire({
                          title: 'Working...',
                          html: '<b></b> ',
                          timer: 1000,
                          timerProgressBar: true,
                          didOpen: () => {
                              Swal.showLoading()
                              const b = Swal.getHtmlContainer().querySelector('b')
                              timerInterval = setInterval(() => {
                                  b.textContent = Swal.getTimerLeft()
                              }, 100)
                          },
                          willClose: () => {
                              clearInterval(timerInterval)
                          }
                      }).then((result) => {
                          Swal.fire({
                              icon: 'success',
                              title: name+'d',
                              text: 'Workspace was '+name+'d!',
                          })
                          window.location.reload();
                      })
                  }).fail(function (error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: error.responseJSON.message,
                      })
                  })
              }

          }
      })

  }
    $(document).on('click','.delete-item',function (e) {
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                cancelButton: 'btn btn-danger',
                confirmButton: 'btn btn-success',
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {

                $('.delete_item').attr('action',$(this).data('url')).submit();
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    })
        .on('click','.create_workspace',function (e) {
            e.preventDefault();
            let _this=$(this),
                user= _this.data('user_id'),
                url=_this.attr('href'),
                method='POST',
                name='Create',
                title='Make Workspace Name';
            manageWorkspace(url,method,user,name,title,_this);

    }).on('click','.action-workspace-edit',function (e) {
            e.preventDefault()
            let _this=$(this),
                user=null,
                url=_this.attr('href'),
                method='PUT',
                name='Update',
                title='Edit Workspace Name';
            manageWorkspace(url,method,user,name,title,_this);

        }).on('click','.create-task',function () {
        $('.select2').select2({
            dropdownParent: $(".modal-create")
        });

    }).on('click','.action-workspace-access',function (e) {
            e.preventDefault()
            let _this=$(this),
                user=null,
                url=_this.attr('href'),
                method='PUT',
                name='Access',
                title='Access Workspace Name';
            accessWorkspace(url,method,user,name,title,_this);

        }).on('click','.create-task',function () {
        $('.select2').select2({
            dropdownParent: $(".modal-create")
        });

    }).on('click','.edit-task',function (e) {
        e.preventDefault();
        let url =$(this).attr('href')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            type: "GET",
        }).done( function(result) {
            $('.modal-edit').html(result);
            $('#editTask').modal('show');

            $('.select2-edit').select2({
                dropdownParent: $(".modal-edit")
            });
        }).fail(function (error) {
        })
    })
        .on('click','.add_end_time',function (e) {
        e.preventDefault();
        let url =$(this).data('url')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "GET",
        }).done( function(result) {
            $('.modal-finish').html(result);
            $('#finishTask').modal('show');
        }).fail(function (error) {
        });
    }).on('click','.task_show',function (e) {
        e.preventDefault();
        let url =$(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: "GET",
        }).done( function(result) {
            $('.modal-info').html(result);
            $('#infoTask').modal('show');
        }).fail(function (error) {
        });
    });


    $(function() {
        $('input[name="task_range"]').daterangepicker({
            drops: 'up',
            opens: 'left',
            timePicker:true
        }, function(start, end, label) {
            $('#task_start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#task_end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));

            var start_Task = moment($('#task_start_date').val(), 'YYYY-MM-DD HH:mm:ss');
            var end_Task = moment($('#task_end_date').val(), 'YYYY-MM-DD HH:mm:ss');

            var duration = moment.duration(end_Task.diff(start_Task));

            var days = Math.floor(duration.asDays());
            var hours = duration.hours();
            var minutes = duration.minutes();

            var formattedDuration = `${days}d ${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;

             $('#task_duration').val(formattedDuration);
        });

    });

})();


