
function confirmDelete(id) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Record has been deleted!", {
            icon: "success",
            buttons: false
          });
          $('#delete'+id).submit();
        }
      });
}
function confirmDefault(id) {
  swal({
      title: "Are you sure?",
      text: "Do you really want to set this template as default?",
      icon: "warning",
      buttons: true,
      dangerMode: false,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("This template has been set as default!", {
          icon: "success",
          buttons: false
        });
        $('#setDefault'+id).submit();
      }
    });
}

function confirmPush() {
  swal({
    title: "Are you sure?",
    text: "Do you really want to push AQI alerts to all subscribed users?",
    icon: "warning",
    buttons: true,
    dangerMode: false,
  })
  .then((willPush) => {
    if (willPush) {
      swal("Sent!", {
        icon: "success",
        buttons: false
      });
      $('#push').submit();
    }
  });
}
function confirmPost() {
  swal({
    title: "Are you sure?",
    text: "Do you really want to post an update to Facebook now?",
    icon: "warning",
    buttons: true,
    dangerMode: false,
  })
  .then((willPost) => {
    if (willPost) {
      swal("Posted!", {
        icon: "success",
        buttons: false
      });
      $('#fbupdate').submit();
    }
  });
}

