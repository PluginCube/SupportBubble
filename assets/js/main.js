jQuery(document).ready(function($) {
    let box = $('#instant-support');
    let btn = box.find('.instant-support-button');

    setTimeout(() => {
        box.show();
    }, 500);
});