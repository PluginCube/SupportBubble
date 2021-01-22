import { writable, readable, get } from 'svelte/store';

export const bubble = writable(InstantSupport.settings.bubble);
export const menu = writable(InstantSupport.settings.menu);
export const ajaxurl = writable(InstantSupport.ajaxurl);

export const showBubble = writable(false)
export const showMenu = writable(false)
export const showPrompts = writable(false)
export const showIntegration = writable(false)
export const integration = writable(null)
