jQuery(document).ready(function($) {
    let data = InstantSupport;

    let box = $('#instant-support');
    let btn = box.find('.it-button');
    let prompts = box.find('.it-prompts');
    let loader = prompts.find('.it-loader');

    // Deley for better UX
    setTimeout(() => {
        box.show();
    }, 500);

    // Prompt messages
    // prompts.children().each(function (i) {
    //     delay = i == 0 ? 1000 : i * 1250 + 1000;
        
    //     loader.show();

    //     setTimeout(() => {
    //         $(this).show();

    //         loader.hide();
    //     }, delay)
    // });

    setInterval(() => {
        if (data.prompts.length == 0) return;

        loader.show();

        prompts.find('span').text(null);

        setTimeout(() => {
            loader.hide();

            prompts.find('span').text(data.prompts[0]['message']);

            data.prompts.shift();
        }, 2500);
        
    }, 5000);
});