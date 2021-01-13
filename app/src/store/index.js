import { writable, readable, get } from 'svelte/store';

export const button = writable(instant_support.button);
export const menu = writable(instant_support.menu);
export const prompts = writable(instant_support.prompts);

export const showButton = writable(false)
export const showMenu = writable(false)
export const showPrompts = writable(false)

export const showIntegration = writable(false)
export const integration = writable(null)
