type ToastMessageType = "error" | "success" | "info";

interface ToastMessage {
    id?: number;
    message: string;
    type: MessageType;
};