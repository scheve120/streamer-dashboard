/*
* Here starts the Jquary
* This configurates the event actions
*/

jQuery(function($) {

  // Try to get jQuery collection with DIV.account-forms.
  var $accountForms = $('.account-forms');
  // If jQuery collection has no elements.
  if ($accountForms.length === 0) {
    // Exit!
    return;
  }

  var $buttons = $accountForms.find('nav button');
  // Bind click event to all buttons in NAV element in DIV.account-forms.
  $buttons.click(function(e) {
    var btnClass = $(this).attr('class').split(" ")[0]; // Setting button class

    $buttons.removeClass('active');
    $(this).addClass('active');

    $accountForms.find('section').removeClass('active');
    $accountForms.find('section').filter('.' + btnClass).addClass('active');

  });

  if (typeof(form_key) === 'undefined' || form_key === '') {
    // Trigger click event on first button in NAV element.
    $buttons.first().trigger('click');
  }
  else {
    $buttons.filter('.' + form_key).trigger('click');
  }
});
