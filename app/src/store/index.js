import { writable, readable, get } from 'svelte/store';

export const bubble = writable(instant_support.bubble);
export const menu = writable(instant_support.menu);
export const forms = writable(instant_support.forms);

export const showBubble = writable(false)
export const showMenu = writable(false)
export const showPrompts = writable(false)

export const showIntegration = writable(false)
export const integration = writable(null)
