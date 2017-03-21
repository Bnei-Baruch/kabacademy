(function() {
  jQuery("document").ready(function() {
    jQuery("#tabs").tabs();
    jQuery("#saveMyAccount").on('click', setUpdateProfile);

  });

  function setUpdateProfile() {
    var data = {
      action: 'setUpdateProfileRregistrationFormShortcode',
      userData: jQuery('#editMyAccount').find('form').serialize()
    };

    jQuery.ajax({
      type: "POST",
      url: ajaxurl,
      data: data,
      dataType: 'json'
    }).done(function(data) {
      document.location.reload();
    })
  }
}())