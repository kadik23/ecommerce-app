interface OrderEntity {
    id?: string;
    dateOrder?: Date;
    quantity: number;
    paymentMethod?: string;
    deliveryMethod?: string;
    orderBy: number;
    Product: string;
    deleted_at?: Date;
}