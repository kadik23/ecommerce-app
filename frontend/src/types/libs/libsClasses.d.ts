interface IToastsManager {
    toasts: ToastMessage[];
    alertSuccess(message: string, duration_in_seconds?: number): void;
    alertError(message: string, duration_in_seconds?: number): void;
    alertInfo(message: string, duration_in_seconds?: number): void;
}

interface IRestProducts {
    axiosInstance: AxiosInstance;
    getAll(): Promise<void>;
}

interface IRestUserSession {
    axiosInstance: AxiosInstance;
    login(userCredentials: UserCredentials): Promise<void>;
    register(user: UserEntity): Promise<void>;
    logout(): Promise<void>;
    getInfo(): Promise<void>;
    updateUserInfo(user: UserEntity): Promise<UserEntity>;
    getCurrentUser(access_token: string): Promise<UserEntity>;
}

interface IUploadImage {
    axiosInstance: AxiosInstance;
    UploadImage(file: File): Promise<any>;
}

interface IRestOrders {
    axiosInstance: AxiosInstance;
    getAll(): Promise<OrderEntity[]>;
}

interface IRestCarts {
    axiosInstance: AxiosInstance;
    getAll(): Promise<CartEntity[]>;
}