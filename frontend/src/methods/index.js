import * as store from 'store'
import { get } from 'svelte/store';

export const ajax = async (action, data = {}, type = 'POST') => {
    return await jQuery.ajax({
        url: get(store.ajaxurl),
        type: type,
        data: {
            action,
            ... data    
        }
    });
}

export const bubbleClick = () => {  
    store.showPrompts.set(false)

    if (get(store.bubble).behaviour == 'menu') {
        store.showMenu.set(!get(store.showMenu))
    } else {
        menuItemClick(get(store.menu)['items'][0]);
    }
}

export const menuItemClick = (item) => {    
    switch (item.type) {
        case 'link':
            item.url.indexOf('://') === -1 
                ? 'http://' + item.url
                : item.url
            
            window.open(item.url, '_blank')
        break;

        case 'email':
            window.location.href =  'mailto:' + item.email;
        break;

        default:                
            store.showMenu.set(false)
            store.showIntegration.set(true)
            store.integration.set(item)
        break;
    }
}