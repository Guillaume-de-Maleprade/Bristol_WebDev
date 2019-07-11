$(window).ready(function() {
  $('input').blur(function() {
    let input = $(this);
    if (input.val())
      input.addClass('used');
    else
      input.removeClass('used');
  });
});
