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