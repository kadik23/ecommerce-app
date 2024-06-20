const DEFAULT_TOAST_DURATION = 3000;

export default class ToastsManager implements IToastsManager {
    toasts: ToastMessage[] = [];

    constructor() {
        this.toasts = [];
    }

    alertSuccess(message: string, duration_in_seconds?: number): void {
        this.toasts.push({ message, type: "success" });
        this.setToastRemoval(duration_in_seconds);
    }

    alertError(message: string, duration_in_seconds?: number): void {
        this.toasts.push({ message, type: "error" });
        this.setToastRemoval(duration_in_seconds);
    }

    alertInfo(message: string, duration_in_seconds?: number): void {
        this.toasts.push({ message, type: "info" });
        this.setToastRemoval(duration_in_seconds);
    }

    private setToastRemoval(duration_in_seconds?: number): void {
        const duration = duration_in_seconds ? 1000 * duration_in_seconds : DEFAULT_TOAST_DURATION;
        setTimeout(() => {
            this.toasts.shift();
        }, duration);
    }
}
