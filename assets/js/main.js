jQuery(document).ready(function($) {
    
    let data = InstantSupport,
        box = $('#instant-support'),
        btn = box.find('.it-button'),
        prompts = box.find('.it-prompts'),
        loader = prompts.find('.it-loader');

    
    /**
     * Show the box
     */
    setTimeout(() => {
        box.show();
    }, 500);


    /**
     * Prompt messages
     */
    setTimeout(() => {
        setInterval(() => {
            if ( data.prompts.length == 0 ) {
                return
            };

            prompts.fadeTo(500,1);
    
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