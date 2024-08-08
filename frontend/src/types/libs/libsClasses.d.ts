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
    getAll(access_token:string): Promise<any[]>;
    sendOrder(order:OrderEntity[], access_token:string): Promise<any>;
}

interface IRestCarts {
    axiosInstance: AxiosInstance;
    getAll(access_token:string): Promise<any>;
    Create(cart:string, access_token:string): Promise<CartEntity>;
    Delete(id:string, access_token:string): any;
    markItRead(carts:any[], access_token:string): any;
}