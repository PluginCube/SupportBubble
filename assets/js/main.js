jQuery(document).ready(function($) {
    let data = InstantSupport;

    let box = $('#instant-support');
    let btn = box.find('.it-button');
    let prompts = box.find('.it-prompts');
    let loader = prompts.find('.it-loader');

    // Show the box
    setTimeout(() => {
        box.show();
    }, 500);

    // show the prompts messages
    setTimeout(() => {

        setInterval(() => {
            prompts.fadeTo(500,1);

            if (data.prompts.length == 0) return;
    
            loader.show();
    
            prompts.find('span').text(null);
    
            setTimeout(() => {
                loader.hide();
    
                prompts.find('span').text(data.prompts[0]['message']);
    
                data.prompts.shift();
            }, 2500);
            
        }, 5000);
    }, 2000);
});