interface IToastsManager {
    toasts: ToastMessage[];
    alertSuccess(message: string, duration_in_seconds?: number): void;
    alertError(message: string, duration_in_seconds?: number): void;
    alertInfo(message: string, duration_in_seconds?: number): void;
}

interface IRestProducts {
    axiosInstance: AxiosInstance;
    getAll(): void;
}