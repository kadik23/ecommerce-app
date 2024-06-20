import { ref } from 'vue';

const listeners = ref(new Map());

const eventBus = {
    emit(event: string, payload?: any) {
        if (listeners.value.has(event)) {
            listeners.value.get(event).forEach((callback: Function) => callback(payload));
        }
    },
    on(event: string, callback: Function) {
        if (!listeners.value.has(event)) {
            listeners.value.set(event, []);
        }
        listeners.value.get(event).push(callback);
    },
    off(event: string, callback: Function) {
        if (listeners.value.has(event)) {
            const callbacks = listeners.value.get(event).filter((cb: Function) => cb !== callback);
            if (callbacks.length > 0) {
                listeners.value.set(event, callbacks);
            } else {
                listeners.value.delete(event);
            }
        }
    }
};

export default eventBus;
