// Automatically close the notification after 5 seconds
setTimeout(function() {
    var notification = document.getElementById('notification');
    notification.classList.remove('show');
    notification.classList.add('hide');
    setTimeout(function() {
      notification.remove();
    }, 400); // Delay removal to allow fade-out effect
  }, 3000); // 3000 milliseconds = 3 seconds