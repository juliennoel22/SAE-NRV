document.addEventListener('DOMContentLoaded', function() {
    const errorDiv = document.querySelector('div.error');
    if (errorDiv) {
        errorDiv.classList.add('show');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const errorDiv = document.querySelector('div.error');
    const closeBtn = errorDiv.querySelector('.close');

    closeBtn.addEventListener('click', function() {
        errorDiv.classList.add('hide');
    });
});