function fnLoadBaseIndex() {          
  $('.loader').css('display','block');
  setTimeout(function() {
    $('.loader').css('display','none');
    $.get("parts/baseMain.php", function(e) {
      $(".main-content .main-content-body").html(e);
    })
  }, 2000);      
}

function fnLoadBaseMartians(base_id) {
  $('.loader').css('display','block');
  setTimeout(function() {
    $('.loader').css('display','none');
    $.get("parts/martianMain.php", {
      base_id: base_id
    }, function(e) {
      $(".main-content .main-content-body").html(e);
    });
  }, 2000);   
}

function fnEditBase(base_id) {
  var myModal = new bootstrap.Modal($('#modal-base'), {
    backdrop: "static",
    focus: true
  });
  myModal.show();
  $('#modal-base .modal-body').html("<h6>Loading Form...</h6>");
  setTimeout(function() {
    $.get("parts/baseForm.php", {
      base_id: base_id
    }, function(e) {
      $('#modal-base .modal-body').html(e);
    });
  }, 1000);
}

function fnDeleteBase(base_id) {
  Swal.fire({
    title: 'Delete Base',
    text: "Are you sure?",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Proceed',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      var url = "deleteBase.php";
      const data = new URLSearchParams();
      data.append('base_id', base_id);

      return fetch(url, { method: 'post', body: data, })
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.text();
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        }
      );
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.value == "success") {
        fnLoadBaseIndex();
        $('.modal-backdrop').remove();
        $.toast({
          heading: 'Information',
          text: 'Base has been deleted!',
          icon: 'success',
          loader: true,        // Change it to false to disable loader
          loaderBg: '#9EC600',  // To change the background
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      } else {
        $.toast({
          heading: 'Error',
          text: 'Message: ' + result.value,
          icon: 'error',
          loader: true,        
          loaderBg: '#000',  
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      }
    }
  });
}

function fnEditMartian(martian_id, base_id) {
  var myModal = new bootstrap.Modal($('#modal-martian'), {
    backdrop: "static",
    focus: true
  });
  myModal.show();
  $('#modal-martian .modal-body').html("<h6>Loading Form...</h6>");
  setTimeout(function() {
    $.get("parts/martianForm.php", {
      martian_id: martian_id,
      base_id: base_id
    }, function(e) {
      $('#modal-martian .modal-body').html(e);
    });
  }, 1000);
}

function fnDeleteMartian(martian_id, base_id) {
  Swal.fire({
    title: 'Delete Martian',
    text: "Are you sure?",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Proceed',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      var url = "deleteMartian.php";
      const data = new URLSearchParams();
      data.append('martian_id', martian_id);

      return fetch(url, { method: 'post', body: data, })
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.text();
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        }
      );
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    console.log(result);
    if (result.isConfirmed) {
      if (result.value == "success") {
        $('.modal-backdrop').remove();
        fnLoadBaseMartians(base_id);        
        $.toast({
          heading: 'Information',
          text: 'Martian has been deleted!',
          icon: 'success',
          loader: true,        // Change it to false to disable loader
          loaderBg: '#9EC600',  // To change the background
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      } else {
        $.toast({
          heading: 'Error',
          text: 'Message: ' + result.value,
          icon: 'error',
          loader: true,        
          loaderBg: '#000',  
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      }
    }
  });
}

function fnAddVisitors(martian_id, base_id) {
  var myModal = new bootstrap.Modal($('#modal-visitor-add'), {
    backdrop: "static",
    focus: true
  });
  myModal.show();
  $('#modal-visitor-add .modal-body').html("<h6>Loading Form...</h6>");
  setTimeout(function() {
    $.get("parts/visitorForm.php", {
      martian_id: martian_id,
      base_id: base_id
    }, function(e) {
      $('#modal-visitor-add .modal-body').html(e);
    });
  }, 1000);
}

function fnViewVisitors(martian_id, base_id) {
  var myModal = new bootstrap.Modal($('#modal-visitor'), {
    backdrop: "static",
    focus: true
  });
  myModal.show();
  $('#modal-visitor .modal-body').html("<h6>Loading Visitor...</h6>");
  setTimeout(function() {
    $.get("parts/visitorMain.php", {
      martian_id: martian_id,
      base_id: base_id
    }, function(e) {
      $('#modal-visitor .modal-body').html(e);
    });
  }, 1000);
}

function fnDeleteVisitor(visitor_id, base_id) {
  Swal.fire({
    title: 'Delete Visitor',
    text: "Are you sure?",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Proceed',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      var url = "deleteVisitor.php";
      const data = new URLSearchParams();
      data.append('visitor_id', visitor_id);

      return fetch(url, { method: 'post', body: data, })
        .then(response => {
          if (!response.ok) {
            throw new Error(response.statusText)
          }
          return response.text();
        })
        .catch(error => {
          Swal.showValidationMessage(
            `Request failed: ${error}`
          )
        }
      );
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.value == "success") {
        $('#modal-visitor').hide();
        $('.modal-backdrop').remove();
        fnLoadBaseMartians(base_id);
        
        $.toast({
          heading: 'Information',
          text: 'Visitor has been deleted!',
          icon: 'success',
          loader: true,        // Change it to false to disable loader
          loaderBg: '#9EC600',  // To change the background
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      } else {
        $.toast({
          heading: 'Error',
          text: 'Message: ' + result.value,
          icon: 'error',
          loader: true,        
          loaderBg: '#000',  
          hideAfter: 3000,
          position: 'bottom-right', 
        });
      }
    }
  });
}