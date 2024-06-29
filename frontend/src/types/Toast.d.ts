type ToastMessageType = "error" | "success" | "info";

interface ToastMessage {
    toasts?: any;
    id?: number;
    message: string;
    type: MessageType;
};