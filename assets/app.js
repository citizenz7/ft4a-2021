import './styles/app.scss';

import 'bootstrap';
import '@popperjs/core';

// start the Stimulus application
import './bootstrap';

/* Activation tooltip sur tout le site */
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});