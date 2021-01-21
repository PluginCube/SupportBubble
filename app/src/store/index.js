import { writable, readable, get } from 'svelte/store';

export const bubble = writable(instant_support.settings.bubble);
export const menu = writable(instant_support.settings.menu);
export const ajaxurl = writable(instant_support.ajaxurl);

export const showBubble = writable(false)
export const showMenu = writable(false)
export const showPrompts = writable(false)
export const showIntegration = writable(false)
export const integration = writable(null)
