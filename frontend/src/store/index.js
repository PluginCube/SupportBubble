import { writable, readable, get } from 'svelte/store';

export const bubble = writable(SupportBubble.settings.bubble);
export const menu = writable(SupportBubble.settings.menu);
export const ajaxurl = writable(SupportBubble.ajaxurl);

export const showBubble = writable(false)
export const showMenu = writable(false)
export const showPrompts = writable(false)
export const showIntegration = writable(false)
export const integration = writable(null)
